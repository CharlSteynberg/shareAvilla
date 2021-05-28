jQuery(document).ready(function ($) {

    $('.wpl-wcs-slider-config').each(function (index) {

        var wpl_wcs_id = $(this).attr('id');

        if (wpl_wcs_id != '') {

            jQuery('#' + wpl_wcs_id).slick({
                infinite: true,
                prevArrow: "<div class=\'slick-prev\'><i class=\'fa fa-angle-left\'></i></div>",
			 	nextArrow: "<div class=\'slick-next\'><i class=\'fa fa-angle-right\'></i></div>",
            });
        }
    });
});