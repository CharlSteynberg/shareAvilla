jQuery(document).ready( function() {

    ThrivePopup.setup({
        publicKey: yoco_params.publicKey,
        amountInCents: yoco_params.amountInCents,
        currency: yoco_params.currency,
        triggerElement: yoco_params.triggerElement,
        email: yoco_params.client_email,
        firstName: yoco_params.client_fn,
        lastName: yoco_params.client_ln,
        description: `order ${yoco_params.order_id} from ${yoco_params.client_fn} ${yoco_params.client_ln} (${yoco_params.client_email})`,
        metadata: {
            billNote: `order ${yoco_params.order_id} from ${yoco_params.client_fn} ${yoco_params.client_ln} (${yoco_params.client_email})`,
            productType: "wc_plugin",
            customerFirstName: yoco_params.client_fn,
            customerLastName: yoco_params.client_ln
        },
        callback: function (token) {
            /***
             *
             * @type {{action: string, order_id, nonce: string, token: *}}
             */
            jQuery('body').prepend('<div class="loader-while-charging"><div class="yoco-overlay-pulsating-circle"></div></div>')
            var str = {
                'action': 'store_yoco_token',
                'token': token,
                'order_id': yoco_params.order_id,
                'nonce': yoco_params.nonce,
            };
            jQuery.ajax({
                url: yoco_params.url,
                type: "post",
                data: str,
                success: function (data) {
                   window.location.reload();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    })

    jQuery('#yoco_pay_now')[0].click();
});
