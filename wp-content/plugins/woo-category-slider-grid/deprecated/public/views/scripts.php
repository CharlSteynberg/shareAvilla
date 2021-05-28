<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Scripts and styles
 */
class WPL_WCS_Front_Scripts {

	/**
	 * @var null
	 * @since 1.0
	 */
	protected static $_instance = null;

	/**
	 * @return WPL_WCS_Front_Scripts
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
	 * Google Fonts
	 */
	public function wpl_wcs_google_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		* Translators: If there are characters in your language that are not supported
		* by Roboto, translate this to 'off'. Do not translate into your own language.
		*/
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'woo-category-slider' ) ) {
			$fonts[] = 'Roboto:400,500';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return esc_url_raw( $fonts_url );
	}

	/**
	 * Plugin Scripts and Styles
	 */
	function front_scripts() {
		// CSS Files.
		wp_register_style( 'wpl-wcs-slick', WPL_WCS_URL . 'public/assets/css/slick.css', array(), WPL_WCS_VERSION );
		wp_enqueue_style( 'wpl-wcs-style', WPL_WCS_URL . 'public/assets/css/style.css', array(), WPL_WCS_VERSION );
		wp_enqueue_style( 'wpl-wcs-responsive', WPL_WCS_URL . 'public/assets/css/responsive.css', array(), WPL_WCS_VERSION );

		// JS Files.
		wp_register_script( 'wpl-wcs-slick-js', WPL_WCS_URL . 'public/assets/js/slick.min.js', array( 'jquery' ), WPL_WCS_VERSION, true );
		wp_register_script( 'wpl-wcs-slick-config', WPL_WCS_URL . 'public/assets/js/slick-config.js', array( 'jquery' ), WPL_WCS_VERSION, true );

	}

}

new WPL_WCS_Front_Scripts();
