<?php

	$construction_realestate_hi_first_color = get_theme_mod('construction_realestate_hi_first_color');
	
	$construction_realestate_custom_css ='';

	/*----------------- Global First Color -----------*/
	$construction_realestate_custom_css .='input[type="submit"], .slide-button a, .main-menu-navigation, .primary-navigation ul ul a:hover, .primary-navigation ul ul a:focus, #comments input[type="submit"].submit, #sidebar input[type="submit"], #sidebar .tagcloud a:hover, .footer-wp .tagcloud a:hover, a.button, .copyright-wrapper, .footer-wp input[type="submit"], .pagination a:hover, .pagination .current, .woocommerce span.onsale, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, nav.woocommerce-MyAccount-navigation ul li , #comments a.comment-reply-link, #scrollbutton i, .footer-wp input[type="submit"], #sidebar button, .footer-wp button{';
			$construction_realestate_custom_css .='background-color: '.esc_attr($construction_realestate_hi_first_color).';';
	$construction_realestate_custom_css .='}';

	$construction_realestate_custom_css .=' p.logged-in-as a, p.f_para, #header .socialbox i:hover, #sidebar .textwidget p a, span.posted_in a, #sidebar .widget_calendar tbody a, .cat-box ul.post-categories a:hover, span.entry-date a:hover, span.entry-author a:hover, .footer-wp h3, .footer-wp li a:hover, #about h2, .woocommerce-message::before, .woocommerce-info a, td.product-name a, a.shipping-calculator-button, .textwidget p a{';
		$construction_realestate_custom_css .='color: '.esc_attr($construction_realestate_hi_first_color).';';
	$construction_realestate_custom_css .='}';

	$construction_realestate_custom_css .='.slide-button a, #comments input[type="submit"].submit, a.button, #scrollbutton i{';
		$construction_realestate_custom_css .='border-color: '.esc_attr($construction_realestate_hi_first_color).';';
	$construction_realestate_custom_css .='}';

	$construction_realestate_custom_css .='.woocommerce-message{';
		$construction_realestate_custom_css .='border-top-color: '.esc_attr($construction_realestate_hi_first_color).';';
	$construction_realestate_custom_css .='}';

	$construction_realestate_custom_css .='.footer-wp h3{';
		$construction_realestate_custom_css .='border-bottom-color: '.esc_attr($construction_realestate_hi_first_color).';';
	$construction_realestate_custom_css .='}';

	/*------------------Width Layout -----------------*/
	$construction_realestate_theme_lay = get_theme_mod( 'construction_realestate_width_layout_options','Default');
    if($construction_realestate_theme_lay == 'Default'){
		$construction_realestate_custom_css .='body{';
			$construction_realestate_custom_css .='max-width: 100%;';
		$construction_realestate_custom_css .='}';
	}else if($construction_realestate_theme_lay == 'Container Layout'){
		$construction_realestate_custom_css .='body{';
			$construction_realestate_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$construction_realestate_custom_css .='}';
	}else if($construction_realestate_theme_lay == 'Box Layout'){
		$construction_realestate_custom_css .='body{';
			$construction_realestate_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$construction_realestate_custom_css .='}';
	}

	/*--------------Slider Content Layout --------------*/
	$construction_realestate_theme_lay = get_theme_mod( 'construction_realestate_slider_content_layout','Center');
    if($construction_realestate_theme_lay == 'Left'){
		$construction_realestate_custom_css .='#slider .inner_carousel,#slider .carousel-caption{';
			$construction_realestate_custom_css .='text-align:left; left:15%; right:45%;';
		$construction_realestate_custom_css .='}';
	}else if($construction_realestate_theme_lay == 'Center'){
		$construction_realestate_custom_css .='#slider .inner_carousel, .slide-button {';
			$construction_realestate_custom_css .='left:30%; right:30%;';
		$construction_realestate_custom_css .='}';
	}else if($construction_realestate_theme_lay == 'Right'){
		$construction_realestate_custom_css .='#slider .inner_carousel,#slider .carousel-caption{';
			$construction_realestate_custom_css .='text-align:right; left:45%; right:15%;';
		$construction_realestate_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/
	$construction_realestate_theme_lay = get_theme_mod( 'construction_realestate_slider_opacity','0.7');
	if($construction_realestate_theme_lay == '0'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0';
		$construction_realestate_custom_css .='}';
		}else if($construction_realestate_theme_lay == '0.1'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0.1';
		$construction_realestate_custom_css .='}';
		}else if($construction_realestate_theme_lay == '0.2'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0.2';
		$construction_realestate_custom_css .='}';
		}else if($construction_realestate_theme_lay == '0.3'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0.3';
		$construction_realestate_custom_css .='}';
		}else if($construction_realestate_theme_lay == '0.4'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0.4';
		$construction_realestate_custom_css .='}';
		}else if($construction_realestate_theme_lay == '0.5'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0.5';
		$construction_realestate_custom_css .='}';
		}else if($construction_realestate_theme_lay == '0.6'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0.6';
		$construction_realestate_custom_css .='}';
		}else if($construction_realestate_theme_lay == '0.7'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0.7';
		$construction_realestate_custom_css .='}';
		}else if($construction_realestate_theme_lay == '0.8'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0.8';
		$construction_realestate_custom_css .='}';
		}else if($construction_realestate_theme_lay == '0.9'){
		$construction_realestate_custom_css .='#slider img{';
			$construction_realestate_custom_css .='opacity:0.9';
		$construction_realestate_custom_css .='}';
		}

	/*-------------- Woocommerce Button  -------------------*/
	$construction_realestate_woocommerce_button_padding_top = get_theme_mod('construction_realestate_woocommerce_button_padding_top',13);
	$construction_realestate_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
		$construction_realestate_custom_css .='padding-top: '.esc_attr($construction_realestate_woocommerce_button_padding_top).'px; padding-bottom: '.esc_attr($construction_realestate_woocommerce_button_padding_top).'px;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_woocommerce_button_padding_right = get_theme_mod('construction_realestate_woocommerce_button_padding_right',13);
	$construction_realestate_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
		$construction_realestate_custom_css .='padding-left: '.esc_attr($construction_realestate_woocommerce_button_padding_right).'px; padding-right: '.esc_attr($construction_realestate_woocommerce_button_padding_right).'px;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_woocommerce_button_border_radius = get_theme_mod('construction_realestate_woocommerce_button_border_radius');
	$construction_realestate_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
		$construction_realestate_custom_css .='border-radius: '.esc_attr($construction_realestate_woocommerce_button_border_radius).'px;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_related_product_enable = get_theme_mod('construction_realestate_related_product_enable',true);
	if($construction_realestate_related_product_enable == false){
		$construction_realestate_custom_css .='.related.products{';
			$construction_realestate_custom_css .='display: none;';
		$construction_realestate_custom_css .='}';
	}

	$construction_realestate_woocommerce_product_border_enable = get_theme_mod('construction_realestate_woocommerce_product_border_enable',true);
	if($construction_realestate_woocommerce_product_border_enable == false){
		$construction_realestate_custom_css .='.products li{';
			$construction_realestate_custom_css .='border: none;';
		$construction_realestate_custom_css .='}';
	}

	$construction_realestate_woocommerce_product_padding_top = get_theme_mod('construction_realestate_woocommerce_product_padding_top',10);
	$construction_realestate_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$construction_realestate_custom_css .='padding-top: '.esc_attr($construction_realestate_woocommerce_product_padding_top).'px; padding-bottom: '.esc_attr($construction_realestate_woocommerce_product_padding_top).'px;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_woocommerce_product_padding_right = get_theme_mod('construction_realestate_woocommerce_product_padding_right',10);
	$construction_realestate_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$construction_realestate_custom_css .='padding-left: '.esc_attr($construction_realestate_woocommerce_product_padding_right).'px; padding-right: '.esc_attr($construction_realestate_woocommerce_product_padding_right).'px;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_woocommerce_product_border_radius = get_theme_mod('construction_realestate_woocommerce_product_border_radius');
	$construction_realestate_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$construction_realestate_custom_css .='border-radius: '.esc_attr($construction_realestate_woocommerce_product_border_radius).'px;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_woocommerce_product_box_shadow = get_theme_mod('construction_realestate_woocommerce_product_box_shadow');
	$construction_realestate_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$construction_realestate_custom_css .='box-shadow: '.esc_attr($construction_realestate_woocommerce_product_box_shadow).'px '.esc_attr($construction_realestate_woocommerce_product_box_shadow).'px '.esc_attr($construction_realestate_woocommerce_product_box_shadow).'px #eee;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_woo_product_sale_top_bottom_padding = get_theme_mod('construction_realestate_woo_product_sale_top_bottom_padding', 0);
	$construction_realestate_woo_product_sale_left_right_padding = get_theme_mod('construction_realestate_woo_product_sale_left_right_padding', 0);
	$construction_realestate_custom_css .='.woocommerce span.onsale{';
		$construction_realestate_custom_css .='padding-top: '.esc_attr($construction_realestate_woo_product_sale_top_bottom_padding).'px; padding-bottom: '.esc_attr($construction_realestate_woo_product_sale_top_bottom_padding).'px; padding-left: '.esc_attr($construction_realestate_woo_product_sale_left_right_padding).'px; padding-right: '.esc_attr($construction_realestate_woo_product_sale_left_right_padding).'px; display:inline-block;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_woo_product_sale_border_radius = get_theme_mod('construction_realestate_woo_product_sale_border_radius',100);
	$construction_realestate_custom_css .='.woocommerce span.onsale {';
		$construction_realestate_custom_css .='border-radius: '.esc_attr($construction_realestate_woo_product_sale_border_radius).'%;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_woo_product_sale_position = get_theme_mod('construction_realestate_woo_product_sale_position', 'Right');
	if($construction_realestate_woo_product_sale_position == 'Right' ){
		$construction_realestate_custom_css .='.woocommerce ul.products li.product .onsale{';
			$construction_realestate_custom_css .=' left:auto; right:0;';
		$construction_realestate_custom_css .='}';
	}elseif($construction_realestate_woo_product_sale_position == 'Left' ){
		$construction_realestate_custom_css .='.woocommerce ul.products li.product .onsale{';
			$construction_realestate_custom_css .=' left:0; right:auto;';
		$construction_realestate_custom_css .='}';
	}

	// footer setting
	$construction_realestate_footer_bg_color = get_theme_mod('construction_realestate_footer_bg_color');
	$construction_realestate_custom_css .='.footer-wp{';
		$construction_realestate_custom_css .='background-color: '.esc_attr($construction_realestate_footer_bg_color).';';
	$construction_realestate_custom_css .='}';

	$construction_realestate_footer_bg_image = get_theme_mod('construction_realestate_footer_bg_image');
	if($construction_realestate_footer_bg_image != false){
		$construction_realestate_custom_css .='.footer-wp{';
			$construction_realestate_custom_css .='background: url('.esc_attr($construction_realestate_footer_bg_image).');';
		$construction_realestate_custom_css .='}';
	}

	/*------------- Back to Top  -------------------*/
	$construction_realestate_back_to_top_border_radius = get_theme_mod('construction_realestate_back_to_top_border_radius');
	$construction_realestate_custom_css .='#scrollbutton i{';
		$construction_realestate_custom_css .='border-radius: '.esc_attr($construction_realestate_back_to_top_border_radius).'px !important;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_scroll_icon_font_size = get_theme_mod('construction_realestate_scroll_icon_font_size', 22);
	$construction_realestate_custom_css .='#scrollbutton i{';
		$construction_realestate_custom_css .='font-size: '.esc_attr($construction_realestate_scroll_icon_font_size).'px;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_top_bottom_scroll_padding = get_theme_mod('construction_realestate_top_bottom_scroll_padding', 12);
	$construction_realestate_custom_css .='#scrollbutton i{';
		$construction_realestate_custom_css .='padding-top: '.esc_attr($construction_realestate_top_bottom_scroll_padding).'px !important; padding-bottom: '.esc_attr($construction_realestate_top_bottom_scroll_padding).'px !important;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_left_right_scroll_padding = get_theme_mod('construction_realestate_left_right_scroll_padding', 17);
	$construction_realestate_custom_css .='#scrollbutton i{';
		$construction_realestate_custom_css .='padding-left: '.esc_attr($construction_realestate_left_right_scroll_padding).'px !important; padding-right: '.esc_attr($construction_realestate_left_right_scroll_padding).'px !important;';
	$construction_realestate_custom_css .='}';

	/*----------- Preloader Color Option  ----------------*/
	$construction_realestate_preloader_bg_color_option = get_theme_mod('construction_realestate_preloader_bg_color_option');
	$construction_realestate_preloader_icon_color_option = get_theme_mod('construction_realestate_preloader_icon_color_option');
	$construction_realestate_custom_css .='.frame{';
		$construction_realestate_custom_css .='background-color: '.esc_attr($construction_realestate_preloader_bg_color_option).';';
	$construction_realestate_custom_css .='}';

	$construction_realestate_custom_css .='.dot-1,.dot-2,.dot-3{';
		$construction_realestate_custom_css .='background-color: '.esc_attr($construction_realestate_preloader_icon_color_option).';';
	$construction_realestate_custom_css .='}';

	// preloader type
	$construction_realestate_theme_lay = get_theme_mod( 'construction_realestate_preloader_type','First Preloader Type');
    if($construction_realestate_theme_lay == 'First Preloader Type'){
		$construction_realestate_custom_css .='.dot-1, .dot-2, .dot-3{';
			$construction_realestate_custom_css .='';
		$construction_realestate_custom_css .='}';
	}else if($construction_realestate_theme_lay == 'Second Preloader Type'){
		$construction_realestate_custom_css .='.dot-1, .dot-2, .dot-3{';
			$construction_realestate_custom_css .='border-radius:0 !important;';
		$construction_realestate_custom_css .='}';
	}

	// menu settings
	$construction_realestate_menu_font_size_option = get_theme_mod('construction_realestate_menu_font_size_option', 15);
	$construction_realestate_custom_css .='.primary-navigation a{';
		$construction_realestate_custom_css .='font-size: '.esc_attr($construction_realestate_menu_font_size_option).'px;';
	$construction_realestate_custom_css .='}';

	// Responsive Media
	$construction_realestate_slider = get_theme_mod( 'construction_realestate_display_slider',false);
	if($construction_realestate_slider == true && get_theme_mod( 'construction_realestate_slider_hide_show', false) == false){
    	$construction_realestate_custom_css .='#slider{';
			$construction_realestate_custom_css .='display:none;';
		$construction_realestate_custom_css .='} ';
	}
    if($construction_realestate_slider == true){
    	$construction_realestate_custom_css .='@media screen and (max-width:575px) {';
		$construction_realestate_custom_css .='#slider{';
			$construction_realestate_custom_css .='display:block;';
		$construction_realestate_custom_css .='} }';
	}else if($construction_realestate_slider == false){
		$construction_realestate_custom_css .='@media screen and (max-width:575px){';
		$construction_realestate_custom_css .='#slider{';
			$construction_realestate_custom_css .='display:none;';
		$construction_realestate_custom_css .='} }';
	}

	$construction_realestate_sliderbutton = get_theme_mod( 'construction_realestate_display_slider_button',true);
	if($construction_realestate_sliderbutton == true && get_theme_mod( 'construction_realestate_show_slider_button',true) != true){
    	$construction_realestate_custom_css .='.slide-button{';
			$construction_realestate_custom_css .='display:none;';
		$construction_realestate_custom_css .='} ';
	}
    if($construction_realestate_sliderbutton == true){
    	$construction_realestate_custom_css .='@media screen and (max-width:575px) {';
		$construction_realestate_custom_css .='.slide-button{';
			$construction_realestate_custom_css .='display:block;';
		$construction_realestate_custom_css .='} }';
	}else if($construction_realestate_sliderbutton == false){
		$construction_realestate_custom_css .='@media screen and (max-width:575px){';
		$construction_realestate_custom_css .='.slide-button{';
			$construction_realestate_custom_css .='display:none;';
		$construction_realestate_custom_css .='} }';
	}

	$construction_realestate_sidebar = get_theme_mod( 'construction_realestate_display_sidebar',true);
    if($construction_realestate_sidebar == true){
    	$construction_realestate_custom_css .='@media screen and (max-width:575px) {';
		$construction_realestate_custom_css .='#sidebar{';
			$construction_realestate_custom_css .='display:block;';
		$construction_realestate_custom_css .='} }';
	}else if($construction_realestate_sidebar == false){
		$construction_realestate_custom_css .='@media screen and (max-width:575px) {';
		$construction_realestate_custom_css .='#sidebar{';
			$construction_realestate_custom_css .='display:none;';
		$construction_realestate_custom_css .='} }';
	}

	$construction_realestate_scroll = get_theme_mod( 'construction_realestate_display_scrolltop', true);
	if($construction_realestate_scroll == true && get_theme_mod( 'construction_realestate_hide_show_scroll',true) != true){
    	$construction_realestate_custom_css .='#scrollbutton i{';
			$construction_realestate_custom_css .='display:none;';
		$construction_realestate_custom_css .='} ';
	}
    if($construction_realestate_scroll == true){
    	$construction_realestate_custom_css .='@media screen and (max-width:575px) {';
		$construction_realestate_custom_css .='#scrollbutton i{';
			$construction_realestate_custom_css .='display:block;';
		$construction_realestate_custom_css .='} }';
	}else if($construction_realestate_scroll == false){
		$construction_realestate_custom_css .='@media screen and (max-width:575px){';
		$construction_realestate_custom_css .='#scrollbutton i{';
			$construction_realestate_custom_css .='display:none;';
		$construction_realestate_custom_css .='} }';
	}

	$construction_realestate_preloader = get_theme_mod( 'construction_realestate_display_preloader',true);
	if($construction_realestate_preloader == true && get_theme_mod( 'construction_realestate_preloader',true) != true){
    	$construction_realestate_custom_css .='.frame{';
			$construction_realestate_custom_css .='display:none;';
		$construction_realestate_custom_css .='} ';
	}
    if($construction_realestate_preloader == true){
    	$construction_realestate_custom_css .='@media screen and (max-width:575px) {';
		$construction_realestate_custom_css .='.frame{';
			$construction_realestate_custom_css .='display:block;';
		$construction_realestate_custom_css .='} }';
	}else if($construction_realestate_preloader == false){
		$construction_realestate_custom_css .='@media screen and (max-width:575px){';
		$construction_realestate_custom_css .='.frame{';
			$construction_realestate_custom_css .='display:none;';
		$construction_realestate_custom_css .='} }';
	}

	$construction_realestate_fixed_header = get_theme_mod( 'construction_realestate_display_fixed_header',false);
	if($construction_realestate_fixed_header == true && get_theme_mod( 'construction_realestate_sticky_header',false) != true){
    	$construction_realestate_custom_css .='.fixed-header{';
			$construction_realestate_custom_css .='position:static;';
		$construction_realestate_custom_css .='} ';
	}
    if($construction_realestate_fixed_header == true){
    	$construction_realestate_custom_css .='@media screen and (max-width:575px) {';
		$construction_realestate_custom_css .='.fixed-header .toggle-menu, .fixed-header{';
			$construction_realestate_custom_css .='position:fixed;';
		$construction_realestate_custom_css .='} }';
	}else if($construction_realestate_fixed_header == false){
		$construction_realestate_custom_css .='@media screen and (max-width:575px){';
		$construction_realestate_custom_css .='.fixed-header .toggle-menu, .fixed-header{';
			$construction_realestate_custom_css .='position:static;';
		$construction_realestate_custom_css .='} }';
	}

	//  comment form width
	$construction_realestate_comment_form_width = get_theme_mod( 'construction_realestate_comment_form_width');
	$construction_realestate_custom_css .='#comments textarea{';
		$construction_realestate_custom_css .='width: '.esc_attr($construction_realestate_comment_form_width).'%;';
	$construction_realestate_custom_css .='}';

	$construction_realestate_title_comment_form = get_theme_mod('construction_realestate_title_comment_form', 'Leave a Reply');
	if($construction_realestate_title_comment_form == ''){
		$construction_realestate_custom_css .='#comments h2#reply-title {';
			$construction_realestate_custom_css .='display: none;';
		$construction_realestate_custom_css .='}';
	}

	$construction_realestate_comment_form_button_content = get_theme_mod('construction_realestate_comment_form_button_content', 'Post Comment');
	if($construction_realestate_comment_form_button_content == ''){
		$construction_realestate_custom_css .='#comments p.form-submit {';
			$construction_realestate_custom_css .='display: none;';
		$construction_realestate_custom_css .='}';
	}

	// slider height
	$construction_realestate_option_slider_height = get_theme_mod('construction_realestate_option_slider_height');
	$construction_realestate_custom_css .='#slider img{';
		$construction_realestate_custom_css .='height: '.esc_attr($construction_realestate_option_slider_height).'px;';
	$construction_realestate_custom_css .='}';

	// site tagline font size
	$construction_realestate_site_title_font_size = get_theme_mod('construction_realestate_site_title_font_size', 30);
	$construction_realestate_custom_css .='#header .logo .site-title a{';
	$construction_realestate_custom_css .='font-size: '.esc_attr($construction_realestate_site_title_font_size).'px;';
	$construction_realestate_custom_css .='}';

