jQuery(document).ready( function() {
    if (typeof YocoSDK == "undefined") {
      handleYocoSDKFatalError()
      return;
    }

    jQuery('body').addClass('.overlay')

    var yoco = new window.YocoSDK({
        publicKey: yoco_params.publicKey
    })
    jQuery('header').addClass('pop-up-close')
    var configuration = jQuery.extend({},
      yoco_params.popUpConfiguration,
      {
      onClose: function () {
        window.location.href = yoco_params.checkout_url
      },
      callback: function (result) {
          jQuery('body').addClass('processing')
            .block({
              message: '<div class="yoco_woocommerce_loader"></div>',
              blockMsgClass: 'yoco_woocommerce_block_msg',
              overlayCSS: {
                background: '#000000',
                opacity: 0.79,
              },
            });

          if (result.error) {
            handleYocoSDKFatalError()
            console.error(error)
            return;
          }
          var str = {
              'action': 'charge_yoco_token',
              'token': result.id,
              'order_id': yoco_params.order_id,
              'nonce': yoco_params.nonce,
          };
          jQuery.ajax({
              url: yoco_params.url,
              type: "post",
              data: str,
              success: function (data) {
                  if (data.redirect) {
                    window.location = data.redirect
                    return
                  }
                  window.location.reload()
              },
              error: function (error) {
                  jQuery('body').removeClass('processing').unblock();
                  handleYocoSDKFatalError()
                  console.error(error)
              }
          });
    }})
    yoco.showPopup(configuration)
});

/**
 * Show a notice and retry button in the event of a fatal SDK error.
 */
function handleYocoSDKFatalError() {
  let div_error = document.createElement('div');
  div_error.className = 'row';
  div_error.innerHTML = '<div class="row"><ul class="woocommerce-error"><li>' +
    yoco_params.frontendResourcesError + '</li></ul>' +
    '<a href="javascript:void(0);" class="yoco_button" id="yoco_retry_button" role="button">' +
    yoco_params.frontendResourcesErrorAction + '</a></div>';
  jQuery('.woocommerce .order_details').after(div_error)
  jQuery('#yoco_retry_button').click(function () {
    location.reload();
  });
}
