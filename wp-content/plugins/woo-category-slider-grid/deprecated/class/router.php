<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woo Category Slider - route class
 *
 * @since 1.0
 */
class WPL_WCS_Router {

	/**
	 * @var WPL_WCS_Router single instance of the class
	 *
	 * @since 1.0
	 */
	protected static $_instance = null;


	/**
	 * @since 1.0
	 *
	 * @static
	 *
	 * @return WPL_WCS_Router
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Include the required files
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	function includes() {
		include_once WPL_WCS_PATH . 'includes/free/loader.php';
	}

	/**
	 * Function
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	function wpl_wcs_function() {
		include_once WPL_WCS_PATH . 'includes/functions.php';
	}

}
