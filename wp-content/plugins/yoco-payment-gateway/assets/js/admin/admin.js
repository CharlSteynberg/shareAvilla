jQuery(document).ready(function() {
  let mode = jQuery('#woocommerce_class_yoco_wc_payment_gateway_mode').val()
  checkMode(mode)
  jQuery('#woocommerce_class_yoco_wc_payment_gateway_mode').on(
    'change',
    function() {
      checkMode(this.value)
    }
  )
  jQuery.ajax({
    url: yoco_params.url,
    type: 'post',
    data: {
      action: 'plugin_health_check',
      nonce: yoco_params.nonce
    },
    success: function(data) {
      health_panel(data)
    },
    error: function(error) {
      console.log(error)
    }
  })

  jQuery('#woocommerce_class_yoco_wc_payment_gateway_live_secret_key').on(
      'keyup',
      function() {
        checkKeyLength(this.value, 'Secret', 'woocommerce_class_yoco_wc_payment_gateway_live_secret_key', 'Live')
      }
  )
  jQuery('#woocommerce_class_yoco_wc_payment_gateway_live_public_key').on(
      'keyup',
      function() {
        checkKeyLength(this.value, 'Public', 'woocommerce_class_yoco_wc_payment_gateway_live_public_key', 'Live')
      }
  );

  jQuery('#woocommerce_class_yoco_wc_payment_gateway_test_secret_key').on(
      'keyup',
      function() {
        checkKeyLength(this.value, 'Secret', 'woocommerce_class_yoco_wc_payment_gateway_test_secret_key', 'Test')
      }
  )
  jQuery('#woocommerce_class_yoco_wc_payment_gateway_test_public_key').on(
      'keyup',
      function() {
        checkKeyLength(this.value, 'Public', 'woocommerce_class_yoco_wc_payment_gateway_test_public_key', 'Test')
      }
  )
})

function health_panel(data) {
  let message = []
  let keys = ['SSL', 'KEYS', 'CURRENCY']
  for (let i in keys) {
    if (get_message(data, keys[i]) !== '') {
      message.push(get_message(data, keys[i]))
    }
  }

  if (message.length > 0) {
    let div_health = document.createElement('div')
    div_health.setAttribute('id', 'div_health')
    if (document.getElementById('#span_test')) {
      jQuery('#span_test').after(div_health)
    } else {
      jQuery('.wc-admin-breadcrumb').after(div_health)
    }
    document.getElementById('div_health').appendChild(makeUL(message))
    jQuery('#woocommerce_class_yoco_wc_payment_gateway_enabled').prop(
      'disabled',
      false
    )
  }
}

function makeUL(array) {
  let list = document.createElement('ul')

  for (let i = 0; i < array.length; i++) {
    let item = document.createElement('li')
    item.appendChild(document.createTextNode(array[i]))
    list.appendChild(item)
  }
  return list
}

function get_message(data, key) {
  switch (key) {
    case 'SSL':
      if (data.SSL === false) {
        return 'To process live transactions, your store should be running with an SSL certificate. The plugin is disabled'
      }
      break;
    case 'KEYS':
      if (data.KEYS === false) {
        return 'Your Yoco PUBLIC and/or PRIVATE KEYS are missing. Please add them below and click on "Save changes"'
      }
      break;
    case 'CURRENCY':
      if (data.CURRENCY === false) {
        return 'Yoco only supports South African Rand / ZAR currency for transactions. Please change your default currency to South Africa Rand.'
      }
      break;
    default:
      break;
  }
  return ''
}

function hide_show_keyfields(env, cmd) {
  let base_component = '#woocommerce_class_yoco_wc_payment_gateway_'
  let fields = ['secret_key', 'public_key']

  fields.forEach(function(field) {
    component = base_component + env + '_' + field
    switch (cmd) {
      case 'hide':
        jQuery(component)
          .closest('tr')
          .hide()
        break;
      case 'show':
        jQuery(component)
          .closest('tr')
          .show()
        break;
      default:
        break;
    }
  });
}

function checkMode(mode) {
  if (mode === 'test') {
    let spantest = document.createElement('span');
    spantest.setAttribute('id', 'span_test')

    spantest.innerHTML = `
    <span style="">
     YOCO TEST MODE - Currently in test mode</span>`
    jQuery('.wc-admin-breadcrumb').after(spantest)
    jQuery('#woocommerce_class_yoco_wc_payment_gateway_enabled').prop(
      'disabled',
      false
    )
    hide_show_keyfields('live', 'hide')
    hide_show_keyfields('test', 'show')
    checkKeyLength(jQuery('#woocommerce_class_yoco_wc_payment_gateway_test_secret_key').val(), 'Secret', 'woocommerce_class_yoco_wc_payment_gateway_test_secret_key', 'Test')
    checkKeyLength(jQuery('#woocommerce_class_yoco_wc_payment_gateway_test_public_key').val(), 'Public', 'woocommerce_class_yoco_wc_payment_gateway_test_public_key', 'Test')
    // enable_save_changes();
  } else {
    jQuery('#span_test').remove()
    hide_show_keyfields('live', 'show')
    hide_show_keyfields('test', 'hide')
    checkKeyLength(jQuery('#woocommerce_class_yoco_wc_payment_gateway_live_secret_key').val(), 'Secret', 'woocommerce_class_yoco_wc_payment_gateway_live_secret_key', 'Live')
    checkKeyLength(jQuery('#woocommerce_class_yoco_wc_payment_gateway_live_public_key').val(), 'Public', 'woocommerce_class_yoco_wc_payment_gateway_live_public_key', 'Live')
  }
}

function disable_save_changes() {
    jQuery('.woocommerce-save-button').attr('disabled', true)
}

function check_disable_save_changes() {
    if ((jQuery('#key_error_Secret').length == 0 && jQuery('#key_error_Public').length) == 0) {
        enable_save_changes()
    } else {
        disable_save_changes()
    }
}

function enable_save_changes() {
    jQuery('.woocommerce-save-button').attr('disabled', false)
}

function add_error_class_to_key(id, key_type, error_type, env, mode) {
    let p_id = 'key_error_' + key_type + '_' + error_type
    if (error_type === 'length') {
      if (!jQuery('#' + p_id).length) {
        jQuery('#' + id).after('<p id="' + p_id + '" class="key_error">The ' + env + ' ' + key_type + ' key does not match required character count, please input again</p>')
      }
    }
    if (error_type === 'key_mismatch') {
       if (!jQuery('#' + p_id).length) {
        jQuery('#' + id).after('<p id="' + p_id + '" class="key_error">The ' + env + ' ' + key_type + ' key is for the ' + mode + ' environment</p>')
       }
    }
}

function remove_error_class_from_key(key_type, remove_error_type) {
  let p_id = 'key_error_' + key_type + '_' + remove_error_type
  if (jQuery('#' + p_id).length) {
    jQuery('#' + p_id).remove()
  }
}

function checkKeyLength(key, key_type, id, env) {
  const key_len = {
    'Public': 28,
    'Secret': 36
  }

  let valid_key = true

  if (key_len[key_type] != key.length) {
    add_error_class_to_key(id, key_type, 'length', env, '')
    disable_save_changes()
    valid_key = false
  } else {
    remove_error_class_from_key(key_type, 'length')
  }

  if (env === 'Live') {
    if (key.includes('_test_')) {
      add_error_class_to_key(id, key_type, 'key_mismatch', env, 'Test')
      disable_save_changes()
      valid_key = false
    } else {
      remove_error_class_from_key(key_type, 'key_mismatch')
    }
  }

  if (env === 'Test') {
    if (key.includes('_live_')) {
      add_error_class_to_key(id, key_type, 'key_mismatch', env, 'Live')
      disable_save_changes()
      valid_key = false
    } else {
      remove_error_class_from_key(key_type, 'key_mismatch')
    }
  }
  if (valid_key) {
    check_disable_save_changes()
  }
}
