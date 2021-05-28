<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woo Quick View- route class
 *
 * @since 1.0
 */
class SP_WQV_Router {

	/**
	 * @var SP_WQV_Router single instance of the class
	 *
	 * @since 1.0
	 */
	protected static $_instance = null;


	/**
	 * @since 1.0
	 *
	 * @static
	 *
	 * @return SP_WQV_Router
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
		include_once SP_WQV_PATH . 'includes/loader.php';
	}

	/**
	 * Function
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	function sp_wqv_function() {
		include_once SP_WQV_PATH . 'includes/functions.php';
	}

	/**
	 * Function
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	function sp_wqv_framework() {
		include_once SP_WQV_PATH . 'admin/views/framework/sp-framework.php';
	}

}
