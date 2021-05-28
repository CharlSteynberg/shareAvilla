<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 5:50 PM
 */
/*================================================
BODY CLASS
================================================== */
if (!function_exists('g5plus_body_class_name')) {
	function g5plus_body_class_name($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE) $classes[] = 'ie';
		else $classes[] = 'unknown';
		if($is_iphone) $classes[] = 'iphone';

		global $g5plus_header_layout;
		$prefix = 'g5plus_';
		$g5plus_header_layout = g5plus_rwmb_meta($prefix . 'header_layout');

		if (($g5plus_header_layout === '') || ($g5plus_header_layout == '-1')) {
			$g5plus_header_layout = g5plus_get_option('header_layout','header-2');
		}

		$classes[] = 'footer-static';
		$home_preloader = g5plus_get_option('home_preloader');
		if ($home_preloader != 'none' && !empty($home_preloader)) {
			$classes[] = 'site-loading';
		}

		$layout_style = g5plus_rwmb_meta($prefix.'layout_style');
		if(!isset($layout_style) || $layout_style == '-1' || $layout_style == '') {
			$layout_style = g5plus_get_option('layout_style','wide');
		}

		if ($layout_style != 'wide') {
			$classes[] =  $layout_style;
		}


		$page_class_extra =  g5plus_rwmb_meta($prefix.'page_class_extra');
		if (!empty($page_class_extra)) {
			$classes[] = $page_class_extra;
		}

		$classes[] = $g5plus_header_layout;
		switch ($g5plus_header_layout) {
			case 'header-7':
				$classes[] = 'header-left';
				break;
		}

		$header_layout_float = g5plus_rwmb_meta($prefix . 'header_layout_float');

		if (($header_layout_float === '') || ($header_layout_float == '-1')) {
			$header_layout_float = g5plus_get_option('header_layout_float',0);
		}
		if ($header_layout_float == '1') {
			$classes[] = 'header-float';
		}

		$enable_rtl_mode = g5plus_get_option('enable_rtl_mode',0);
		if (is_rtl() || $enable_rtl_mode == '1' || isset($_GET['RTL'])) {
			$classes[] = 'site-rtl';
		}

		if (class_exists( 'WooCommerce' )) {
			$classes[] = 'woocommerce';
		}

		return $classes;
	}
	add_filter('body_class','g5plus_body_class_name');
}
/*================================================
SITE LOADING
================================================== */
if (!function_exists('g5plus_site_loading')) {
	function g5plus_site_loading(){
        g5plus_get_template('site-loading');
	}
	add_action('g5plus_before_page_wrapper','g5plus_site_loading',5);
}
/*================================================
PAGE HEADING
================================================== */
if (!function_exists('g5plus_page_heading')) {
	function g5plus_page_heading() {
		g5plus_get_template('page-heading');
	}
	add_action('g5plus_before_page','g5plus_page_heading',5);
}
/*================================================
ARCHIVE HEADING
================================================== */
if (!function_exists('g5plus_archive_heading')) {
	function g5plus_archive_heading() {
		g5plus_get_template('archive-heading');
	}
	add_action('g5plus_before_archive','g5plus_archive_heading',5);
}

if (!function_exists('g5plus_archive_product_heading')) {
    function g5plus_archive_product_heading() {
        g5plus_get_template('archive-product-heading');
    }
    add_action('g5plus_before_archive_product','g5plus_archive_product_heading',5);
}

/*================================================
ABOVE HEADER
================================================== */
if (!function_exists('g5plus_page_top_drawer')) {
	function g5plus_page_top_drawer() {
		g5plus_get_template('top-drawer-template');
	}
	add_action('g5plus_before_page_wrapper_content','g5plus_page_top_drawer',10);
}

/*================================================
TOP BAR
================================================== */
if (!function_exists('g5plus_page_top_bar')) {
	function g5plus_page_top_bar() {
		g5plus_get_template('top-bar-template');
	}
	add_action('g5plus_before_page_wrapper_content','g5plus_page_top_bar',10);
}

/*================================================
HEADER
================================================== */
if (!function_exists('g5plus_page_header')) {
	function g5plus_page_header() {
		g5plus_get_template('header-template');
	}
	add_action('g5plus_before_page_wrapper_content','g5plus_page_header',15);
}