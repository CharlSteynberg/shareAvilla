<?php
/**
 * The metabox of the plugin.
 *
 * @link       https://shapedplugin.com/
 * @since      1.0.0
 * @package    Woo_Category_Slider
 * @subpackage Woo_Category_Slider/admin/partials
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

/**
 * The metabox main class.
 */
class SP_WCS_Metaboxs {
	/**
	 * Metabox banner.
	 *
	 * @param [type] $prefix
	 * @return void
	 */
	public static function metabox_banner( $prefix ) {

		//
		// Create a metabox.
		//
		SP_WCS::createMetabox(
			$prefix,
			array(
				'title'        => __( 'Category Slider for WooCommerce', 'woo-category-slider' ),
				'post_type'    => 'sp_wcslider',
				'show_restore' => false,
				'context'      => 'normal',
				'priority'     => 'default',
			)
		);

		//
		// Create a section.
		//
		SP_WCS::createSection(
			$prefix,
			array(
				'fields' => array(
					array(
						'type'  => 'heading',
						'image' => plugin_dir_url( __DIR__ ) . 'img/woo-category-slider-logo.svg',
						'after' => '<i class="fa fa-life-ring"></i> Support',
						'link'  => 'https://shapedplugin.com/support/?user=lite',
						'class' => 'wcsp-admin-header',
					),
					array(
						'type'  => 'shortcode',
						'class' => 'wcsp-admin-shortcode',
					),
				), // End of fields array.
			)
		);
	}

	/**
	 * Metabox.
	 *
	 * @param [type] $prefix
	 * @return void
	 */
	public static function metabox( $prefix ) {

		//
		// Create a metabox.
		//
		SP_WCS::createMetabox(
			$prefix,
			array(
				'title'        => __( 'Shortcode Section', 'woo-category-slider' ),
				'post_type'    => 'sp_wcslider',
				'show_restore' => false,
				'theme'        => 'light',
				'context'      => 'normal',
				'priority'     => 'default',
				'class'        => 'sp_wcsp_shortcode_generator',
			)
		);
		SP_WCS_General::section( $prefix );
		SP_WCS_Display::section( $prefix );
		SP_WCS_Thumbnail::section( $prefix );
		SP_WCS_Slider::section( $prefix );
		SP_WCS_Typography::section( $prefix );
	}
}
