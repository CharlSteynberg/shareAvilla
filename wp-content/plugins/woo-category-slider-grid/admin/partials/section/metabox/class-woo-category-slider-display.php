<?php
/**
 * Display settings tab.
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
 * This class is responsible for Display settings tab.
 *
 * @since 1.0.0
 */
class SP_WCS_Display {
	/**
	 * Display section.
	 *
	 * @param string $prefix Section prefix.
	 * @return void
	 */
	public static function section( $prefix ) {

		SP_WCS::createSection(
			$prefix,
			array(
				'title'  => __( 'Display Options', 'woo-category-slider' ),
				'icon'   => 'fa fa-th-large',
				'fields' => array(
					array(
						'id'         => 'wcsp_section_title',
						'type'       => 'switcher',
						'title'      => __( 'Section Title', 'woo-category-slider' ),
						'subtitle'   => __( 'Show/Hide category showcase section title.', 'woo-category-slider' ),
						'text_on'    => __( 'Show', 'woo-category-slider' ),
						'text_off'   => __( 'Hide', 'woo-category-slider' ),
						'text_width' => 80,
						'default'    => true,
					),
					array(
						'id'         => 'wcsp_section_title_color',
						'type'       => 'color',
						'title'      => __( 'Section Title Color', 'woo-category-slider' ),
						'subtitle'   => __( 'Set color for category showcase section title.', 'woo-category-slider' ),
						'default'    => '#444444',
						'dependency' => array(
							'wcsp_section_title',
							'==',
							'true',
						),
					),
					array(
						'id'          => 'wcsp_section_title_margin',
						'type'        => 'spacing',
						'class'       => 'wcsp-section-title-margin',
						'title'       => __( 'Margin from Section Title', 'woo-category-slider' ),
						'subtitle'    => __( 'Set margin for category showcase section title.', 'woo-category-slider' ),
						'output_mode' => 'margin',
						'units'       => array(
							esc_html__( 'px', 'woo-category-slider' ),
							esc_html__( 'em', 'woo-category-slider' ),
						),
						'default'     => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '30',
							'left'   => '0',
							'unit'   => 'px',
						),
						'dependency'  => array(
							'wcsp_section_title',
							'==',
							'true',
						),
					),
					array(
						'id'          => 'wcsp_space_between_cat',
						'type'        => 'spacing',
						'class'       => 'wcsp-space-between-cat',
						'title'       => __( 'Space Between Categories', 'woo-category-slider' ),
						'subtitle'    => __( 'Set space between categories.', 'woo-category-slider' ),
						'output_mode' => 'margin',
						'all'         => true,
						'all_text'    => false,
						'units'       => array(
							esc_html__( 'px', 'woo-category-slider' ),
						),
						'default'     => array(
							'all'  => '20',
							'unit' => 'px',
						),
					),
					array(
						'id'          => 'wcsp_cat_content_position',
						'class'       => 'wcsp_cat_content_position',
						'type'        => 'image_select',
						'title'       => __( 'Category Content Position', 'woo-category-slider' ),
						'subtitle'    => __( 'Select a position for the category content.', 'woo-category-slider' ),
						'desc'        => __( 'To unlock more amazing category Content Positions and Settings, <a href="https://shapedplugin.com/plugin/woocommerce-category-slider-pro/?ref=115" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-category-slider' ),
						'option_name' => true,
						'options'     => array(
							'thumb-above-cont-below' => array(
								'image'       => SP_WCS_URL . 'admin/img/below-c.svg',
								'option_name' => __( 'Below Content', 'woo-category-slider' ),
							),
							'cont-above-thumb-below' => array(
								'image'       => SP_WCS_URL . 'admin/img/above-c.svg',
								'option_name' => __( 'Above Content', 'woo-category-slider' ),
								'pro_only'    => true,
							),
							'left-thumb-right-cont'  => array(
								'image'       => SP_WCS_URL . 'admin/img/right-c.svg',
								'option_name' => __( 'Right Content', 'woo-category-slider' ),
								'pro_only'    => true,
							),
							'left-cont-right-thumb'  => array(
								'image'       => SP_WCS_URL . 'admin/img/left-c.svg',
								'option_name' => __( 'Left Content', 'woo-category-slider' ),
								'pro_only'    => true,
							),
							'cont-over-thumb'        => array(
								'image'       => SP_WCS_URL . 'admin/img/overlay-c.svg',
								'option_name' => __( 'Overlay Content', 'woo-category-slider' ),
								'pro_only'    => true,
							),

						),
						'default'     => 'thumb-above-cont-below',
					),
					array(
						'id'       => 'wcsp_make_it_card_style',
						'type'     => 'checkbox',
						'title'    => __( 'Make it Card Style', 'woo-category-slider' ),
						'subtitle' => __( 'By checking it, you can bring a material feel into your design through customization.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'id'          => 'wcsp_cat_border',
						'type'        => 'border',
						'title'       => __( 'Border', 'woo-category-slider' ),
						'subtitle'    => __( 'Set category content border for the slider item.', 'woo-category-slider' ),
						'hover_color' => true,
						'default'     => array(
							'top'         => '1',
							'left'        => '1',
							'right'       => '1',
							'bottom'      => '1',
							'color'       => '#e2e2e2',
							'hover_color' => '#e2e2e2',
						),
						'dependency'  => array(
							'wcsp_make_it_card_style',
							'==',
							'true',
						),
					),
					array(
						'id'         => 'wcsp_cat_background',
						'type'       => 'color_group',
						'title'      => __( 'Background', 'woo-category-slider' ),
						'subtitle'   => __( 'Set color for the category content background.', 'woo-category-slider' ),
						'options'    => array(
							'background'       => __( 'Background', 'woo-category-slider' ),
							'hover_background' => __( 'Hover Background', 'woo-category-slider' ),
						),
						'default'    => array(
							'background'       => '#f8f8f8',
							'hover_background' => '#f8f8f8',
						),
						'dependency' => array(
							'wcsp_make_it_card_style',
							'==',
							'true',
						),
					),
					array(
						'id'          => 'wcsp_cat_padding',
						'type'        => 'spacing',
						'class'       => 'wcsp-cat-padding',
						'title'       => __( 'Inner Padding', 'woo-category-slider' ),
						'subtitle'    => __( 'Set category content inner padding.', 'woo-category-slider' ),
						'output_mode' => 'padding',
						'unit'        => true,
						'units'       => array( 'px' ),
						'default'     => array(
							'top'    => '16',
							'right'  => '16',
							'bottom' => '16',
							'left'   => '16',
							'unit'   => 'px',
						),
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Category Content', 'woo-category-slider' ),
					),
					array(
						'id'         => 'wcsp_cat_icon',
						'class'      => 'pro_only_field',
						'type'       => 'switcher',
						'title'      => __( 'Category Icon', 'woo-category-slider' ),
						'subtitle'   => __( 'Show/Hide category icon.', 'woo-category-slider' ),
						'text_on'    => __( 'Show', 'woo-category-slider' ),
						'text_off'   => __( 'Hide', 'woo-category-slider' ),
						'text_width' => 80,
						'default'    => false,
					),
					array(
						'id'         => 'wcsp_cat_name',
						'type'       => 'switcher',
						'title'      => __( 'Category Name', 'woo-category-slider' ),
						'subtitle'   => __( 'Show/Hide category name.', 'woo-category-slider' ),
						'text_on'    => __( 'Show', 'woo-category-slider' ),
						'text_off'   => __( 'Hide', 'woo-category-slider' ),
						'text_width' => 80,
						'default'    => true,
					),
					array(
						'id'         => 'wcsp_cat_name_color',
						'type'       => 'color',
						'title'      => __( 'Category Name Color', 'woo-category-slider' ),
						'subtitle'   => __( 'Set category name color.', 'woo-category-slider' ),
						'default'    => '#444444',
						'dependency' => array(
							'wcsp_cat_name',
							'==',
							'true',
						),
					),
					array(
						'id'          => 'wcsp_cat_name_margin',
						'type'        => 'spacing',
						'class'       => 'wcsp-cat-name-margin',
						'title'       => __( 'Category Name Margin', 'woo-category-slider' ),
						'subtitle'    => __( 'Set category name margin.', 'woo-category-slider' ),
						'output_mode' => 'margin',
						'units'       => array(
							esc_html__( 'px', 'woo-category-slider' ),
							esc_html__( 'em', 'woo-category-slider' ),
						),
						'default'     => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '6',
							'left'   => '0',
							'unit'   => 'px',
						),
						'dependency'  => array(
							'wcsp_cat_name',
							'==',
							'true',
						),
					),
					array(
						'id'         => 'wcsp_cat_product_count',
						'type'       => 'switcher',
						'title'      => __( 'Product Count', 'woo-category-slider' ),
						'subtitle'   => __( 'Show/Hide product count.', 'woo-category-slider' ),
						'text_on'    => __( 'Show', 'woo-category-slider' ),
						'text_off'   => __( 'Hide', 'woo-category-slider' ),
						'text_width' => 80,
						'default'    => true,
						'dependency' => array( 'wcsp_cat_name', '==', 'true' ),
					),
					array(
						'id'         => 'wcsp_cat_product_count_position',
						'type'       => 'radio',
						'title'      => __( 'Product Count Position', 'woo-category-slider' ),
						'subtitle'   => __( 'Set product count position.', 'woo-category-slider' ),
						'options'    => array(
							'beside_cat' => __( 'Beside category name', 'woo-category-slider' ),
							'under_cat'  => __( 'Under category name', 'woo-category-slider' ),
						),
						'default'    => 'beside_cat',
						'dependency' => array( 'wcsp_cat_name|wcsp_cat_product_count', '==|==', 'true|true' ),
					),
					array(
						'id'         => 'wcsp_cat_product_count_before',
						'type'       => 'text',
						'title'      => __( 'Product Count Before', 'woo-category-slider' ),
						'subtitle'   => __( 'Set product count before text.', 'woo-category-slider' ),
						'default'    => ' (',
						'dependency' => array( 'wcsp_cat_name|wcsp_cat_product_count', '==|==', 'true|true' ),
					),
					array(
						'id'         => 'wcsp_cat_product_count_after',
						'type'       => 'text',
						'title'      => __( 'Product Count After', 'woo-category-slider' ),
						'subtitle'   => __( 'Set product count after text.', 'woo-category-slider' ),
						'default'    => ')',
						'dependency' => array( 'wcsp_cat_name|wcsp_cat_product_count', '==|==', 'true|true' ),
					),
					array(
						'id'         => 'wcsp_product_count_color',
						'type'       => 'color',
						'title'      => __( 'Product Count Color', 'woo-category-slider' ),
						'subtitle'   => __( 'Set product count color.', 'woo-category-slider' ),
						'default'    => '#777777',
						'dependency' => array(
							'wcsp_cat_product_count_position|wcsp_cat_product_count|wcsp_cat_name',
							'==|==|==',
							'under_cat|true|true',
						),
					),
					array(
						'id'          => 'wcsp_product_count_margin',
						'type'        => 'spacing',
						'title'       => __( 'Product Count Margin', 'woo-category-slider' ),
						'subtitle'    => __( 'Set product count margin.', 'woo-category-slider' ),
						'output_mode' => 'margin',
						'units'       => array(
							esc_html__( 'px', 'woo-category-slider' ),
							esc_html__( 'em', 'woo-category-slider' ),
						),
						'default'     => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '6',
							'left'   => '0',
							'unit'   => 'px',
						),
						'dependency'  => array(
							'wcsp_cat_product_count_position|wcsp_cat_product_count|wcsp_cat_name',
							'==|==|==',
							'under_cat|true|true',
						),
					),
					array(
						'id'         => 'wcsp_cat_custom_text',
						'class'      => 'pro_only_field',
						'attributes' => array( 'disabled' => 'disabled' ),
						'type'       => 'switcher',
						'title'      => __( 'Custom Text', 'woo-category-slider-pro' ),
						'subtitle'   => __( 'Show/Hide custom text.', 'woo-category-slider-pro' ),
						'text_on'    => __( 'Show', 'woo-category-slider-pro' ),
						'text_off'   => __( 'Hide', 'woo-category-slider-pro' ),
						'text_width' => 80,
						'default'    => false,

					),
					array(
						'id'         => 'wcsp_cat_description',
						'type'       => 'switcher',
						'title'      => __( 'Description', 'woo-category-slider' ),
						'subtitle'   => __( 'Show/Hide description.', 'woo-category-slider' ),
						'text_on'    => __( 'Show', 'woo-category-slider' ),
						'text_off'   => __( 'Hide', 'woo-category-slider' ),
						'text_width' => 80,
						'default'    => true,
					),
					array(
						'id'         => 'wcsp_description_color',
						'type'       => 'color',
						'title'      => __( 'Description Color', 'woo-category-slider' ),
						'subtitle'   => __( 'Set description color.', 'woo-category-slider' ),
						'default'    => '#444444',
						'dependency' => array(
							'wcsp_cat_description',
							'==',
							'true',
						),
					),
					array(
						'id'          => 'wcsp_description_margin',
						'type'        => 'spacing',
						'class'       => 'wcsp-description-margin',
						'title'       => __( 'Description Margin', 'woo-category-slider' ),
						'subtitle'    => __( 'Set description margin.', 'woo-category-slider' ),
						'output_mode' => 'margin',
						'units'       => array(
							esc_html__( 'px', 'woo-category-slider' ),
							esc_html__( 'em', 'woo-category-slider' ),
						),
						'default'     => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '14',
							'left'   => '0',
							'unit'   => 'px',
						),
						'dependency'  => array(
							'wcsp_cat_description',
							'==',
							'true',
						),
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Shop Now Button', 'woo-category-slider' ),
					),
					array(
						'id'         => 'wcsp_cat_shop_now_button',
						'type'       => 'switcher',
						'title'      => __( 'Shop Now Button', 'woo-category-slider' ),
						'subtitle'   => __( 'Show/Hide shop now button.', 'woo-category-slider' ),
						'text_on'    => __( 'Show', 'woo-category-slider' ),
						'text_off'   => __( 'Hide', 'woo-category-slider' ),
						'text_width' => 80,
						'default'    => true,
					),
					array(
						'id'         => 'wcsp_cat_shop_now_button_text',
						'type'       => 'text',
						'title'      => __( 'Shop Now Button Label', 'woo-category-slider' ),
						'subtitle'   => __( 'Type shop now button label.', 'woo-category-slider' ),
						'default'    => 'Shop Now',
						'dependency' => array( 'wcsp_cat_shop_now_button', '==', 'true' ),
					),
					array(
						'id'         => 'wcsp_cat_shop_button_color',
						'type'       => 'color_group',
						'title'      => __( 'Shop Now Button Color', 'woo-category-slider' ),
						'subtitle'   => __( 'Set shop now button color.', 'woo-category-slider' ),
						'options'    => array(
							'color'            => __( 'Color', 'woo-category-slider' ),
							'hover_color'      => __( 'Hover Color', 'woo-category-slider' ),
							'background'       => __( 'Background', 'woo-category-slider' ),
							'hover_background' => __( 'Hover Background', 'woo-category-slider' ),
						),
						'default'    => array(
							'color'            => '#ffffff',
							'hover_color'      => '#ffffff',
							'background'       => '#cc2b5e',
							'hover_background' => '#af2435',
						),
						'dependency' => array( 'wcsp_cat_shop_now_button', '==', 'true' ),
					),
					array(
						'id'          => 'wcsp_cat_shop_button_border',
						'type'        => 'border',
						'title'       => __( 'Shop Now Button Border', 'woo-category-slider' ),
						'subtitle'    => __( 'Set border for the shop now button.', 'woo-category-slider' ),
						'all'         => true,
						'hover_color' => true,
						'default'     => array(
							'all'         => '0',
							'color'       => '#cc2b5e',
							'hover_color' => '#af2435',
						),
						'dependency'  => array( 'wcsp_cat_shop_now_button', '==', 'true' ),
					),
					array(
						'id'          => 'wcsp_cat_button_margin',
						'type'        => 'spacing',
						'class'       => 'wcsp-cat-button-margin',
						'title'       => __( 'Button Margin', 'woo-category-slider' ),
						'subtitle'    => __( 'Set shop now button margin.', 'woo-category-slider' ),
						'output_mode' => 'margin',
						'units'       => array(
							esc_html__( 'px', 'woo-category-slider' ),
							esc_html__( 'em', 'woo-category-slider' ),
						),
						'default'     => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '5',
							'left'   => '0',
							'unit'   => 'px',
						),
						'dependency'  => array( 'wcsp_cat_shop_now_button', '==', 'true' ),
					),
					array(
						'id'         => 'wcsp_cat_link_target',
						'type'       => 'select',
						'title'      => __( 'Link Target', 'woo-category-slider' ),
						'subtitle'   => __( 'Set link target.', 'woo-category-slider' ),
						'options'    => array(
							'_self'     => __( '_self', 'woo-category-slider' ),
							'_blank'    => __( '_blank', 'woo-category-slider' ),
							'_parent'   => __( '_parent', 'woo-category-slider' ),
							'_top'      => __( '_top', 'woo-category-slider' ),
							'framename' => __( 'framename', 'woo-category-slider' ),
						),
						'default'    => '_self',
						'dependency' => array( 'wcsp_cat_shop_now_button', '==', 'true' ),
					),

				), // End of fields array.
			)
		); // Display Options section end.
	}
}
