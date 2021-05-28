<?php
$custom_css                = sp_wqv_get_option( 'wqv_custom_css' );
$quick_view_button_border  = sp_wqv_get_option( 'wqv_quick_view_button_border' );
$quick_view_button_padding = sp_wqv_get_option( 'wqv_quick_view_button_padding' );
$quick_view_button_bg      = sp_wqv_get_option( 'wqv_quick_view_button_color' );
$popup_close_icon_color    = sp_wqv_get_option( 'wqv_popup_close_btn_color' );
$popup_close_icon_size     = sp_wqv_get_option( 'wqv_popup_close_icon_size' );
$add_to_cart_btn_color     = sp_wqv_get_option( 'wqv_add_to_cart_btn_color' );
$add_to_cart_btn_padding   = sp_wqv_get_option( 'wqv_add_to_cart_btn_padding' );
$rating_start_color        = sp_wqv_get_option( 'wqv_rating_start_color' );
$popup_box_bg              = sp_wqv_get_option( 'wqv_popup_box_bg' );

/**
 * Custom CSS
 */
$custom_css .= '
#wqv-quick-view-content .wqv-product-info .woocommerce-product-rating .star-rating::before{
	color: ' . $rating_start_color['color1'] . ';
	opacity: 1;
}
#wqv-quick-view-content .wqv-product-info .woocommerce-product-rating .star-rating span:before{
	color: ' . $rating_start_color['color2'] . ';
}
#wqv-quick-view-content .wqv-product-info .single_add_to_cart_button.button:not(.components-button):not(.customize-partial-edit-shortcut-button){
	color: ' . $add_to_cart_btn_color['color1'] . ';
	background: ' . $add_to_cart_btn_color['color3'] . ';
	padding: ' . $add_to_cart_btn_padding['top'] . 'px ' . $add_to_cart_btn_padding['right'] . 'px ' . $add_to_cart_btn_padding['bottom'] . 'px ' . $add_to_cart_btn_padding['left'] . 'px;
	line-height: 40px;
}
#wqv-quick-view-content .wqv-product-info .single_add_to_cart_button.button:not(.components-button):not(.customize-partial-edit-shortcut-button):hover {
	color: ' . $add_to_cart_btn_color['color2'] . ';
	background: ' . $add_to_cart_btn_color['color4'] . ';
}
a#sp-wqv-view-button.button.sp-wqv-view-button,
#wps-slider-section .button.sp-wqv-view-button,
#wpsp-slider-section .button.sp-wqv-view-button {
	background: ' . $quick_view_button_bg['color3'] . ';
	color: ' . $quick_view_button_bg['color1'] . ';
	border: ' . $quick_view_button_border['width'] . 'px ' . $quick_view_button_border['style'] . ' ' . $quick_view_button_border['color'] . ';
	padding: ' . $quick_view_button_padding['top'] . 'px ' . $quick_view_button_padding['right'] . 'px ' . $quick_view_button_padding['bottom'] . 'px ' . $quick_view_button_padding['left'] . 'px;
}
a#sp-wqv-view-button.button.sp-wqv-view-button:hover,
#wps-slider-section .button.sp-wqv-view-button:hover,
#wpsp-slider-section .button.sp-wqv-view-button:hover {
	background: ' . $quick_view_button_bg['color4'] . ';
	color: ' . $quick_view_button_bg['color2'] . ';
	border-color: ' . $quick_view_button_border['hover_color'] . ';
}
#wqv-quick-view-content.sp-wqv-content {
	background: ' . $popup_box_bg . ';
}
.mfp-bg.mfp-wqv{
	background: ' . sp_wqv_get_option( 'wqv_popup_overlay_bg' ) . ';
	opacity: 1;
}
.mfp-wqv #wqv-quick-view-content .mfp-close{
	font-size: 0;
	width: auto;
	height: auto;
	opacity: 1;
	cursor: pointer;
	top: 0;
	right: 0;
}
.mfp-wqv #wqv-quick-view-content .mfp-close:before{
	position: absolute;
	top: 5px;
	right: 5px;
	color: ' . $popup_close_icon_color['color1'] . ';
	font-size: ' . $popup_close_icon_size . 'px;
	line-height: 1;
	padding: 5px;
}
.mfp-wqv #wqv-quick-view-content .mfp-close:hover:before{
	color: ' . $popup_close_icon_color['color2'] . ';
}
';
