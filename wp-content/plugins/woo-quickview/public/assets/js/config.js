jQuery(document).ready(function (jQuery) {

	/**
	 * Product Quick View
	 */
    var wqv_products = [],
        wqv_ids = [];
    jQuery('.sp-wqv-view-button').each(function () {
        var product_id = jQuery(this).attr('data-id');
        if (- 1 === jQuery.inArray(product_id, wqv_ids)) {
            wqv_ids.push(product_id);
            wqv_products.push({ src: wqv_vars.ajax_url + '?product_id=' + product_id });
        }
    });

    jQuery('body').on('click', '.sp-wqv-view-button', function (e) {
        var product_id = jQuery(this).attr('data-id');
        if (- 1 === jQuery.inArray(product_id, wqv_ids)) {
            wqv_ids.push(product_id);
            wqv_products.push({ src: wqv_vars.ajax_url + '?product_id=' + product_id });
        }
        var effect = jQuery(this).attr('data-effect');
        var data_wqv_json = jQuery(this).data('wqv');
        data_wqv = JSON.parse(data_wqv_json);

        var index = wqv_get_key(wqv_products, 'src', wqv_vars.ajax_url + '?product_id=' + product_id);

        jQuery.magnificPopup.open({
            items: wqv_products,
            type: 'ajax',
            mainClass: 'mfp-wqv',
            autoFocusLast: false,
            ajax: {
                settings: {
                    type: 'GET',
                    data: {
                        action: 'wqv_popup_content'
                    }
                }
            },
            showCloseBtn: data_wqv.close_button,
            closeMarkup: '<button title="%title%" type="button" class="mfp-close wqvicon-cancel"></button>',
            removalDelay: 160, //delay removal by X to allow out-animation
            callbacks: {
                beforeOpen: function() {
					if ( typeof effect !== typeof undefined && effect !== false ) {
                        this.st.mainClass = 'mfp-wqv ' + effect;
					} else {
                        this.st.mainClass = 'mfp-wqv ' + wqv_vars.effect;
					}
				},
                
                ajaxContentAdded: function () {
                    if ( typeof wc_add_to_cart_variation_params !== 'undefined' ) {
                        var form_variation = jQuery('.sp-wqv-content').find('.variations_form');
                        form_variation.each(function () {
                            jQuery(this).wc_variation_form();
                        });
                    }

                    const ps = new PerfectScrollbar('.wqv-product-content', {});
                }
            },
            
        }, index );
        e.preventDefault();
    });    

});

function wqv_get_key(array, key, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
            return i;
        }
    }
    return - 1;
}