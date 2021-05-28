<?php
define( 'HOME_URL', trailingslashit( home_url() ) );
define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URL', trailingslashit( get_template_directory_uri() ) );


if (!function_exists('g5plus_get_option')) {
	function g5plus_get_option($key,$default = '') {
		global $g5plus_wolverine_options;
		return (isset($g5plus_wolverine_options) && isset($g5plus_wolverine_options[$key])) ? $g5plus_wolverine_options[$key] : $default;
	}
}

if (!function_exists('g5plus_include_theme_options')) {
	function g5plus_include_theme_options() {
		require_once( THEME_DIR . 'includes/options-config.php' );
	}
	g5plus_include_theme_options();
}

if (!function_exists('g5plus_include_library')) {
	function g5plus_include_library() {
        require_once(THEME_DIR . 'g5plus-framework/g5plus-framework.php');
		require_once(THEME_DIR . 'includes/register-require-plugin.php');
		require_once(THEME_DIR . 'includes/theme-setup.php');
		require_once(THEME_DIR . 'includes/sidebar.php');
		require_once(THEME_DIR . 'includes/meta-boxes.php');
		require_once(THEME_DIR . 'includes/admin-enqueue.php');
		require_once(THEME_DIR . 'includes/theme-functions.php');
		require_once(THEME_DIR . 'includes/theme-action.php');
		require_once(THEME_DIR . 'includes/theme-filter.php');
		require_once(THEME_DIR . 'includes/frontend-enqueue.php');

		if( class_exists('Vc_Manager')) {
			require_once(THEME_DIR . 'includes/vc-functions.php');
		}
    }
	g5plus_include_library();
}


if (!function_exists('woo_custom_add_to_cart'))
{
	function woo_custom_add_to_cart( $cart_item_data )
	{
		global $woocommerce;
		$woocommerce->cart->empty_cart();
		return $cart_item_data;
	}

	add_filter("woocommerce_add_cart_item_data","woo_custom_add_to_cart");
}
