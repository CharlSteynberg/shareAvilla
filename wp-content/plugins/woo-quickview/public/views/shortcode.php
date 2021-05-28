<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WooCommerce Quick View - Shortcode class
 *
 * @since 1.0
 */

class SP_WQV_Shortcode {
	/**
	 * @var SP_WQV_Shortcode single instance of the class
	 *
	 * @since 1.0
	 */
	protected static $_instance = null;


	/**
	 * SP_WQV_Shortcode Instance
	 *
	 * @since 1.0
	 * @static
	 * @return self Main instance
	 */
	public static function getInstance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * SP_WQV_Shortcode constructor.
	 */
	public function __construct() {
		add_shortcode( 'woo_quick_view', array( $this, 'wqv_shortcode' ) );
	}

	/**
	 * Quick view shortcode
	 *
	 * @param [type] $atts
	 * @return void
	 */
	public function wqv_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'id'     => null,
		), $atts, 'woo_quick_view' );

		if ( ! $atts['id'] ) {
			global $woocommerce, $product;
			if ( $woocommerce->version >= '3.0' ) {
				$atts['id'] = $product->get_id();
			} else {
				$atts['id'] = $product->id;
			}
		}

		$close_button            = sp_wqv_get_option( 'wqv_popup_close_button' );
		$quick_view_button_text  = sp_wqv_get_option( 'wqv_quick_view_button_text' );

		$outline = '';
		if ( $atts['id'] ) {
			$outline .= '<a href="#" id="sp-wqv-view-button" class="button sp-wqv-view-button" data-id="' . esc_attr( $atts['id'] ) . '" data-effect="' . sp_wqv_get_option( 'wqv_popup_effect' ) . '" data-wqv=\'{"close_button": "' . $close_button . '" } \'>' . $quick_view_button_text . '</a>';
		}
		return $outline;
	}

}

new SP_WQV_Shortcode();
