<?php
/**
 * General settings tab.
 *
 * @link       https://shapedplugin.com/
 * @since      1.0.0
 *
 * @package    Woo_Category_Slider
 * @subpackage Woo_Category_Slider/admin/partials/section/metabox
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

// Cannot access directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This class is responsible for General settings tab.
 *
 * @since 1.0.0
 */
class SP_WCS_General {
	/**
	 * General section.
	 *
	 * @param [type] $prefix
	 * @return void
	 */
	public static function section( $prefix ) {

		SP_WCS::createSection(
			$prefix,
			array(
				'title'  => __( 'General Settings', 'woo-category-slider' ),
				'icon'   => 'fa fa-cog',
				'class'  => 'active',
				'fields' => array(
					array(
						'id'          => 'wcsp_layout_presets',
						'type'        => 'image_select',
						'title'       => __( 'Layout Preset', 'woo-category-slider' ),
						'subtitle'    => __( 'Choose a layout preset.', 'woo-category-slider' ),
						'desc'        => __( 'To unlock Grid and Block layouts, <a href="https://shapedplugin.com/plugin/woocommerce-category-slider-pro/?ref=115" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-category-slider' ),
						'class'       => 'wcsp_layout_presets',
						'option_name' => true,
						'options'     => array(
							'slider' => array(
								'image'       => SP_WCS_URL . 'admin/img/slider.svg',
								'option_name' => __( 'Slider', 'woo-category-slider' ),
							),
							'grid'   => array(
								'image'       => SP_WCS_URL . 'admin/img/grid.svg',
								'option_name' => __( 'Grid', 'woo-category-slider' ),
								'pro_only'    => true,
							),
							'block'  => array(
								'image'       => SP_WCS_URL . 'admin/img/block.svg',
								'option_name' => __( 'Block', 'woo-category-slider' ),
								'pro_only'    => true,
							),
						),
						'default'     => 'slider',
					),
					array(
						'id'       => 'wcsp_slider_mode',
						'type'     => 'button_setf',
						'class'    => 'pro_option',
						'title'    => __( 'Slider Mode', 'woo-category-slider' ),
						'subtitle' => __( 'Set a mode for the slider.', 'woo-category-slider' ),
						'options'  => array(
							'standard' => array(
								'text'     => __( 'Standard', 'woo-category-slider' ),
								'pro_only' => false,
							),
							'ticker'   => array(
								'text'     => __( 'Ticker', 'woo-category-slider' ),
								'pro_only' => true,
							),
						),
						'default'  => 'standard',
					),
					array(
						'id'       => 'wcsp_number_of_column',
						'type'     => 'column',
						'title'    => __( 'Category Column(s)', 'woo-category-slider' ),
						'subtitle' => __( 'Set number of column(s) in different devices for responsive view.', 'woo-category-slider' ),
						'min'      => '1',
						'default'  => array(
							'large_desktop' => '4',
							'desktop'       => '3',
							'laptop'        => '2',
							'tablet'        => '2',
							'mobile'        => '1',
						),
						'help'     => '<i class="fa fa-television"></i> LARGE DESKTOP - Screens larger than 1280px.<br/>
							<i class="fa fa-desktop"></i> DESKTOP - Screens smaller than 1280px.<br/>
							<i class="fa fa-laptop"></i> LAPTOP - Screens smaller than 980px.<br/>
							<i class="fa fa-tablet"></i> TABLET - Screens smaller than 736px.<br/>
							<i class="fa fa-mobile"></i> MOBILE - Screens smaller than 480px.<br/>',
					),
					array(
						'id'       => 'wcsp_child_categories',
						'type'     => 'button_setf',
						'class'    => 'pro_option',
						'title'    => __( 'Category Type', 'woo-category-slider' ),
						'subtitle' => __( 'Select a category type.', 'woo-category-slider' ),
						'options'  => array(
							'hide'             => array(
								'text'     => __( 'Parent', 'woo-category-slider' ),
								'pro_only' => false,
							),
							'parent_and_child' => array(
								'text'     => __( 'Parent and Child', 'woo-category-slider' ),
								'pro_only' => false,
							),
						),
						'default'  => 'hide',
					),
					array(
						'id'         => 'wcsp_parent_and_child_categories',
						'type'       => 'custom_group',
						'title'      => __( 'Parent and Child', 'woo-category-slider' ),
						'desc'       => __( 'To display Parent with Child or Child Categories and to unlock more amazing settings, <a href="https://shapedplugin.com/plugin/woocommerce-category-slider-pro/?ref=115" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-category-slider' ),
						'dependency' => array( 'wcsp_child_categories', '==', 'parent_and_child' ),
					),
					array(
						'id'         => 'wcsp_parent_child_display_type',
						'type'       => 'button_setf',
						'class'      => 'pro_option',
						'title'      => __( 'Parent and Child Display Type', 'woo-category-slider' ),
						'subtitle'   => __( 'Select an display type for parent and child categories.', 'woo-category-slider' ),
						'options'    => array(
							'individualize_each' => array(
								'text'     => __( 'Individualize Each', 'woo-category-slider' ),
								'pro_only' => true,
							),
							'child_only'         => array(
								'text'     => __( 'Child Only', 'woo-category-slider' ),
								'pro_only' => true,
							),
							'under_parent'       => array(
								'text'     => __( 'Child Under Parent', 'woo-category-slider' ),
								'pro_only' => true,
							),
						),
						'default'    => 'individualize_each',
						'dependency' => array( 'wcsp_child_categories', '==', 'parent_and_child' ),
					),
					array(
						'id'         => 'wcsp_filter_categories',
						'type'       => 'selectf',
						'title'      => __( 'Filter Categories', 'woo-category-slider' ),
						'subtitle'   => __( 'Select an option to filter the categories.', 'woo-category-slider' ),
						'options'    => array(
							'all'      => array(
								'text'     => __( 'All', 'woo-category-slider' ),
								'pro_only' => false,
							),
							'specific' => array(
								'text'     => __( 'Specific', 'woo-category-slider' ),
								'pro_only' => false,
							),
							'exclude'  => array(
								'text'     => __( 'Exclude (Pro)', 'woo-category-slider' ),
								'pro_only' => true,
							),
						),
						'default'    => 'all',
						'dependency' => array( 'wcsp_child_categories', '==', 'hide' ),

					),
					array(
						'id'          => 'wcsp_categories_list',
						'type'        => 'select',
						'title'       => __( 'Choose Category(s)', 'woo-category-slider' ),
						'subtitle'    => __( 'Choose the specific category(s) to show.', 'woo-category-slider' ),
						'options'     => 'sp_wcsp_categories',
						'attributes'  => array(
							'style' => 'width: 280px;',
						),
						'multiple'    => 'multiple',
						'placeholder' => __( 'Select Category(s)', 'woo-category-slider' ),
						'chosen'      => true,
						'dependency'  => array(
							'wcsp_filter_categories|wcsp_child_categories',
							'==|==',
							'specific|hide',
						),
					),
					array(
						'id'       => 'wcsp_hide_empty_categories',
						'type'     => 'checkbox',
						'title'    => __( 'Hide Empty Categories', 'woo-category-slider' ),
						'subtitle' => __( 'Check to hide empty categories from the slider.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'id'              => 'wcsp_number_of_total_categories',
						'type'            => 'spacing',
						'title'           => __( 'Total Categories to Show', 'woo-category-slider' ),
						'subtitle'        => __( 'Total number of categories to display.', 'woo-category-slider' ),
						'all'             => true,
						'all_text'        => false,
						'all_placeholder' => false,
						'unit'            => false,
						'min'             => '1',
						'default'         => array(
							'all' => '12',
						),
					),
					array(
						'id'       => 'wcsp_order_by',
						'type'     => 'select',
						'title'    => __( 'Order by', 'woo-category-slider' ),
						'subtitle' => __( 'Select an order by option.', 'woo-category-slider' ),
						'options'  => array(
							'ID'         => __( 'ID', 'woo-category-slider' ),
							'name'       => __( 'Name', 'woo-category-slider' ),
							'date'       => __( 'Date', 'woo-category-slider' ),
							'menu_order' => __( 'Drag & Drop', 'woo-category-slider' ),
							'count'      => __( 'Count number of product', 'woo-category-slider' ),
							'none'       => __( 'None', 'woo-category-slider' ),
						),
						'default'  => 'date',
					),
					array(
						'id'       => 'wcsp_order',
						'type'     => 'select',
						'title'    => __( 'Order', 'woo-category-slider' ),
						'subtitle' => __( 'Select an order option.', 'woo-category-slider' ),
						'options'  => array(
							'ASC'  => __( 'Ascending', 'woo-category-slider' ),
							'DESC' => __( 'Descending', 'woo-category-slider' ),
						),
						'default'  => 'DESC',
					),
					array(
						'id'         => 'wcsp_preloader',
						'type'       => 'switcher',
						'title'      => __( 'Preloader', 'woo-category-slider' ),
						'subtitle'   => __( 'Slider will be hidden until page load completed.', 'woo-category-slider' ),
						'text_on'    => __( 'Enabled', 'woo-category-slider' ),
						'text_off'   => __( 'Disabled', 'woo-category-slider' ),
						'text_width' => 100,
						'default'    => true,
					),

				), // Fields array end.
			)
		); // End of General section.
	}
}
