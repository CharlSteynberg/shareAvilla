<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; }  // if direct access.

/**
 * Scripts and styles
 */
class SP_WQV_Front_Scripts {

	/**
	 * @var null
	 * @since 1.0
	 */
	protected static $_instance = null;

	/**
	 * Instance
	 *
	 * @return SP_WQV_Front_Scripts
	 * @since 1.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
	}

	/**
	 * Plugin Scripts and Styles
	 */
	public function front_scripts() {
		// CSS Files.
		wp_enqueue_style( 'wqv-magnific-popup', SP_WQV_URL . 'public/assets/css/magnific-popup.css', array(), SP_WQV_VERSION );
		wp_enqueue_style( 'wqv-perfect-scrollbar', SP_WQV_URL . 'public/assets/css/perfect-scrollbar.css', array(), SP_WQV_VERSION );
		wp_enqueue_style( 'wqv-flaticon', SP_WQV_URL . 'public/assets/css/flaticon.css', array(), SP_WQV_VERSION );
		wp_enqueue_style( 'wqv-style', SP_WQV_URL . 'public/assets/css/style.css', array(), SP_WQV_VERSION );
		wp_enqueue_style( 'wqv-custom', SP_WQV_URL . 'public/assets/css/custom.css', array(), SP_WQV_VERSION );

		include SP_WQV_PATH . '/includes/custom-css.php';
		wp_add_inline_style( 'wqv-custom', $custom_css );

		// JS Files.
		wp_enqueue_script( 'wc-add-to-cart-variation' );
		wp_enqueue_script( 'wqv-perfect-scrollbar-js', SP_WQV_URL . 'public/assets/js/perfect-scrollbar.min.js', array( 'jquery' ), SP_WQV_VERSION, true );
		wp_enqueue_script( 'wqv-magnific-popup-js', SP_WQV_URL . 'public/assets/js/magnific-popup.min.js', array( 'jquery' ), SP_WQV_VERSION, true );
		wp_enqueue_script( 'wqv-config-js', SP_WQV_URL . 'public/assets/js/config.js', array( 'jquery', 'wc-add-to-cart-variation' ), SP_WQV_VERSION, true );
		wp_localize_script( 'wqv-config-js', 'wqv_vars', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		));
	}

}
new SP_WQV_Front_Scripts();
