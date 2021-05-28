<?php

/**
 * Advanced settings section in settings page.
 *
 * @link       https://shapedplugin.com/
 * @since      1.0.0
 *
 * @package    Woo_Category_Slider
 * @subpackage Woo_Category_Slider/admin/partials/section/settings
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

// Cannot access directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This class is responsible for Advanced Settings in Settings page.
 *
 * @since 1.1.0
 */
class SP_WCS_Advanced {
	/**
	 * Settings section.
	 *
	 * @param [type] $prefix
	 * @return void
	 */
	public static function section( $prefix ) {

		SP_WCS::createSection(
			$prefix,
			array(
				'title'  => 'Advanced Settings',
				'icon'   => 'fa fa-cogs',
				'fields' => array(
					array(
						'id'       => 'wcsp_delete_all_data',
						'type'     => 'checkbox',
						'title'    => __( 'Clean-up Data on Deletion', 'woo-category-slider' ),
						'help' => __( 'Check this box if you would like Category Slider for WooCommerce to completely remove all of its data when the plugin is deleted.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Enqueue or Dequeue CSS', 'woo-category-slider' ),
					),
					array(
						'id'         => 'wcsp_swiper_css',
						'type'       => 'switcher',
						'title'      => __( 'Swiper CSS', 'woo-category-slider' ),
						// 'subtitle'   => __( 'Enqueue/Dequeue swiper CSS.', 'woo-category-slider' ),
						'text_on'    => __( 'Enqueue', 'woo-category-slider' ),
						'text_off'   => __( 'Dequeue', 'woo-category-slider' ),
						'text_width' => 95,
						'default'    => true,
					),
					array(
						'id'         => 'wcsp_fa_css',
						'type'       => 'switcher',
						'title'      => __( 'Font Awesome CSS', 'woo-category-slider' ),
						// 'subtitle'   => __( 'Enqueue/Dequeue font awesome CSS.', 'woo-category-slider' ),
						'text_on'    => __( 'Enqueue', 'woo-category-slider' ),
						'text_off'   => __( 'Dequeue', 'woo-category-slider' ),
						'text_width' => 95,
						'default'    => true,
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Enqueue or Dequeue JS', 'woo-category-slider' ),
					),
					array(
						'id'         => 'wcsp_swiper_js',
						'type'       => 'switcher',
						'title'      => __( 'Swiper JS', 'woo-category-slider' ),
						// 'subtitle'   => __( 'Enqueue/Dequeue swiper JS.', 'woo-category-slider' ),
						'text_on'    => __( 'Enqueue', 'woo-category-slider' ),
						'text_off'   => __( 'Dequeue', 'woo-category-slider' ),
						'text_width' => 95,
						'default'    => true,
					),
				),
			)
		);
	}
}
