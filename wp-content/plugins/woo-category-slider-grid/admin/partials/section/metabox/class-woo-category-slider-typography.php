<?php
/**
 * Typography settings tab.
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
 * This class is responsible for Typography settings tab.
 *
 * @since 1.0.0
 */
class SP_WCS_Typography {
	/**
	 * Typography section.
	 *
	 * @param [type] $prefix
	 * @return void
	 */
	public static function section( $prefix ) {

		SP_WCS::createSection(
			$prefix,
			array(
				'title'           => __( 'Typography', 'woo-category-slider' ),
				'icon'            => 'fa fa-font',
				'enqueue_webfont' => true,
				'fields'          => array(
					array(
						'type'    => 'notice',
						'style'   => 'normal',
						'content' => __( 'To unlock the following typography(900+ Google Fonts) options, <a href="https://shapedplugin.com/plugin/woocommerce-category-slider-pro/?ref=115" target="_blank"><b>Upgrade to Pro!</b></a>', 'woo-category-slider' ),
					),
					array(
						'id'       => 'wpsp_section_title_font_load',
						'type'     => 'switcherf',
						'title'    => __( 'Load Slider Section Title Font', 'woo-category-slider' ),
						'subtitle' => __( 'On/Off google font for the slider section title.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'id'           => 'wpsp_section_title_typography',
						'type'         => 'typography',
						'title'        => __( 'Slider Section Title Font', 'woo-category-slider' ),
						'subtitle'     => __( 'Set slider section title font properties.', 'woo-category-slider' ),
						'default'      => array(
							'color'          => '#444444',
							'font-family'    => 'Open Sans',
							'font-weight'    => '600',
							'font-size'      => '20',
							'line-height'    => '20',
							'letter-spacing' => '0',
							'text-align'     => 'left',
							'text-transform' => 'none',
							// 'subset'         => 'latin-ext',
							'type'           => 'google',
							'unit'           => 'px',
						),
						'preview'      => 'always',
						'preview_text' => 'Slider Section Title',
					),
					array(
						'id'       => 'wcsp_cat_name_font_load',
						'type'     => 'switcherf',
						'title'    => __( 'Load Category Name Font', 'woo-category-slider' ),
						'subtitle' => __( 'On/Off google font for the category name.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'id'           => 'wcsp_cat_name_typography',
						'type'         => 'typography',
						'title'        => __( 'Category Name Font', 'woo-category-slider' ),
						'subtitle'     => __( 'Set category name font properties.', 'woo-category-slider' ),
						'hover-color'  => true,
						'default'      => array(
							'color'          => '#444444',
							'hover-color'    => '#444444',
							'font-family'    => 'Lato',
							'font-style'     => '700',
							'font-size'      => '16',
							'line-height'    => '22',
							'letter-spacing' => '0',
							'text-align'     => 'center',
							'text-transform' => 'none',
							// 'subset'         => 'latin-ext',
							'type'           => 'google',
						),
						'preview'      => 'always',
						'preview_text' => 'Kids Fashion',
					),
					array(
						'id'       => 'wcsp_product_count_font_load',
						'type'     => 'switcherf',
						'title'    => __( 'Load Product Count Font', 'woo-category-slider' ),
						'subtitle' => __( 'On/Off google font for the product count.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'id'           => 'wcsp_product_count_typography',
						'type'         => 'typography',
						'title'        => __( 'Product Count Font', 'woo-category-slider' ),
						'subtitle'     => __( 'Set product count font properties.', 'woo-category-slider' ),
						'default'      => array(
							'color'          => '#777777',
							'font-family'    => 'Open Sans',
							'font-style'     => '400',
							'font-size'      => '14',
							'line-height'    => '20',
							'letter-spacing' => '0',
							'text-align'     => 'center',
							'text-transform' => 'none',
							// 'subset'         => 'latin-ext',
							'type'           => 'google',
						),
						'preview'      => 'always',
						'preview_text' => '23 Products',
					),
					array(
						'id'       => 'wcsp_child_cat_font_load',
						'type'     => 'switcherf',
						'title'    => __( 'Load Child Category Font', 'woo-category-slider' ),
						'subtitle' => __( 'On/Off google font for the child category.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'id'           => 'wcsp_child_cat_typography',
						'type'         => 'typography',
						'title'        => __( 'Child Category Font', 'woo-category-slider' ),
						'subtitle'     => __( 'Set child category font properties.', 'woo-category-slider' ),
						'hover-color'  => true,
						'default'      => array(
							'color'          => '#636363',
							'hover-color'    => '#cc2b5e',
							'font-family'    => 'Open Sans',
							'font-style'     => '400',
							'font-size'      => '14',
							'line-height'    => '18',
							'letter-spacing' => '0',
							'text-align'     => 'center',
							'text-transform' => 'none',
							// 'subset'         => 'latin-ext',
							'type'           => 'google',
						),
						'preview'      => 'always',
						'preview_text' => 'Child Category',
					),
					array(
						'id'       => 'wcsp_custom_text_font_load',
						'type'     => 'switcherf',
						'title'    => __( 'Load Custom Text Font', 'woo-category-slider' ),
						'subtitle' => __( 'On/Off google font for the custom text.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'id'           => 'wcsp_custom_text_typography',
						'type'         => 'typography',
						'title'        => __( 'Custom Text Font', 'woo-category-slider' ),
						'subtitle'     => __( 'Set custom text font properties.', 'woo-category-slider' ),
						'default'      => array(
							'color'          => '#535353',
							'font-family'    => 'Lato',
							'font-style'     => '400',
							'font-size'      => '14',
							'line-height'    => '18',
							'letter-spacing' => '0',
							'text-align'     => 'center',
							'text-transform' => 'uppercase',
							// 'subset'         => 'latin-ext',
							'type'           => 'google',
						),
						'preview'      => 'always',
						'preview_text' => 'Black Friday Offer 50% Off',
					),
					array(
						'id'       => 'wcsp_description_font_load',
						'type'     => 'switcherf',
						'title'    => __( 'Load Description Font', 'woo-category-slider' ),
						'subtitle' => __( 'On/Off google font for the description.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'id'           => 'wcsp_description_typography',
						'type'         => 'typography',
						'title'        => __( 'Description Font', 'woo-category-slider' ),
						'subtitle'     => __( 'Set description font properties.', 'woo-category-slider' ),
						'default'      => array(
							'color'          => '#444444',
							'font-family'    => 'Open Sans',
							'font-style'     => '300',
							'font-size'      => '14',
							'line-height'    => '18',
							'letter-spacing' => '0',
							'text-align'     => 'center',
							'text-transform' => 'none',
							// 'subset'         => 'latin-ext',
							'type'           => 'google',
						),
						'preview'      => 'always',
						'preview_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer semper congue ultricies. Suspendisse a congue magna. Fusce at lacinia risus.',
					),
					array(
						'id'       => 'wcsp_shop_now_font_load',
						'type'     => 'switcherf',
						'title'    => __( 'Load Shop Now Button Font', 'woo-category-slider' ),
						'subtitle' => __( 'On/Off google font for the shop now button.', 'woo-category-slider' ),
						'default'  => false,
					),
					array(
						'id'           => 'wcsp_shop_now_typography',
						'type'         => 'typography',
						'title'        => __( 'Shop Now Button Font', 'woo-category-slider' ),
						'subtitle'     => __( 'Set shop now button font properties.', 'woo-category-slider' ),
						'hover-color'  => true,
						'default'      => array(
							'color'          => '#ffffff',
							'hover-color'    => '#ffffff',
							'font-family'    => 'Lato',
							'font-style'     => '700',
							'font-size'      => '15',
							'line-height'    => '20',
							'letter-spacing' => '0',
							'text-align'     => 'center',
							'text-transform' => 'none',
							// 'subset'         => 'latin-ext',
							'type'           => 'google',
						),
						'preview'      => 'always',
						'preview_text' => 'Shop Now',
					),

				), // End of fields array.
			)
		); // Typography settings section end.
	}
}
