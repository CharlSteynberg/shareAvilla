<?php
/**
 * The file that defines the woo category slider shortcode.
 *
 * @link       https://shapedplugin.com/
 * @since      1.1.0
 *
 * @package    Woo_Category_Slider
 * @subpackage Woo_Category_Slider/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woo category slider shortcode class
 */
class Woo_Category_Slider_Shortcode {

	/**
	 * Holds the class object.
	 *
	 * @since 1.0.0
	 * @var object
	 */
	public static $instance;

	/**
	 * Post ID.
	 *
	 * @var string $post_id The post id of the slider.
	 */
	public $post_id;

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 1.0.0
	 * @static
	 * @return Woo_Category_Slider_Shortcode Shortcode instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Woo_Category_Slider_Shortcode constructor.
	 */
	public function __construct() {
		add_shortcode( 'woocatslider', array( $this, 'sp_wcsp_shortcode_attr' ) );
	}

	/**
	 * A shortcode for rendering the slider.
	 *
	 * @param integer $attributes The ID the shortcode.
	 * @return void
	 */
	public function sp_wcsp_shortcode_attr( $attributes ) {

		if ( empty( $attributes['id'] ) ) {
			return;
		}
		$post_id = $attributes['id'];

		$shortcode_meta = get_post_meta( $post_id, 'sp_wcsp_shortcode_options', true );

		//
		// GENERAL SETTINGS.
		//
		$layout_preset = isset( $shortcode_meta['wcsp_layout_presets'] ) ? $shortcode_meta['wcsp_layout_presets'] : '';

			// Columns.
		$column        = isset( $shortcode_meta['wcsp_number_of_column'] ) ? $shortcode_meta['wcsp_number_of_column'] : '';
		$large_desktop = isset( $column['large_desktop'] ) ? $column['large_desktop'] : '';
		$desktop       = isset( $column['desktop'] ) ? $column['desktop'] : '';
		$laptop        = isset( $column['laptop'] ) ? $column['laptop'] : '';
		$tablet        = isset( $column['tablet'] ) ? $column['tablet'] : '';
		$mobile        = isset( $column['mobile'] ) ? $column['mobile'] : '';

		$child_categories = isset( $shortcode_meta['wcsp_child_categories'] ) ? $shortcode_meta['wcsp_child_categories'] : '';

			// Filter Categories.
		$filter_categories = isset( $shortcode_meta['wcsp_filter_categories'] ) ? $shortcode_meta['wcsp_filter_categories'] : 'all';
		$cat_list          = isset( $shortcode_meta['wcsp_categories_list'] ) ? $shortcode_meta['wcsp_categories_list'] : '';

		$hide_empty_cat      = isset( $shortcode_meta['wcsp_hide_empty_categories'] ) && true == $shortcode_meta['wcsp_hide_empty_categories'] ? '1' : '0';
		$number_of_total_cat = isset( $shortcode_meta['wcsp_number_of_total_categories'] ) ? $shortcode_meta['wcsp_number_of_total_categories']['all'] : '12';
		$order_by            = isset( $shortcode_meta['wcsp_order_by'] ) ? $shortcode_meta['wcsp_order_by'] : 'date';
		$order               = isset( $shortcode_meta['wcsp_order'] ) ? $shortcode_meta['wcsp_order'] : 'DESC';
		$preloader           = isset( $shortcode_meta['wcsp_preloader'] ) ? $shortcode_meta['wcsp_preloader'] : '';

		//
		// SLIDER CONTROLS.
		//
		$auto_play             = isset( $shortcode_meta['wcsp_auto_play'] ) ? $shortcode_meta['wcsp_auto_play'] : true;
		$auto_play_speed       = isset( $shortcode_meta['wcsp_auto_play_speed']['all'] ) ? $shortcode_meta['wcsp_auto_play_speed']['all'] : 3000;
		$standard_scroll_speed = isset( $shortcode_meta['wcsp_standard_scroll_speed']['all'] ) ? $shortcode_meta['wcsp_standard_scroll_speed']['all'] : 600;
		$pause_on_hover        = isset( $shortcode_meta['wcsp_pause_on_hover'] ) ? $shortcode_meta['wcsp_pause_on_hover'] : '';
		$infinite_loop         = isset( $shortcode_meta['wcsp_infinite_loop'] ) ? $shortcode_meta['wcsp_infinite_loop'] : true;

			// Slide to scroll.
		$slide_to_scroll      = isset( $shortcode_meta['wcsp_slide_to_scroll'] ) ? $shortcode_meta['wcsp_slide_to_scroll'] : '';
		$large_desktop_scroll = isset( $slide_to_scroll['large_desktop'] ) ? $slide_to_scroll['large_desktop'] : '';
		$desktop_scroll       = isset( $slide_to_scroll['desktop'] ) ? $slide_to_scroll['desktop'] : '';
		$laptop_scroll        = isset( $slide_to_scroll['laptop'] ) ? $slide_to_scroll['laptop'] : '';
		$tablet_scroll        = isset( $slide_to_scroll['tablet'] ) ? $slide_to_scroll['tablet'] : '';
		$mobile_scroll        = isset( $slide_to_scroll['mobile'] ) ? $slide_to_scroll['mobile'] : '';

			// Navigation.
		$navigation = isset( $shortcode_meta['wcsp_navigation'] ) ? $shortcode_meta['wcsp_navigation'] : '';
		$nav_colors = isset( $shortcode_meta['wcsp_nav_colors'] ) ? $shortcode_meta['wcsp_nav_colors'] : '';
		$nav_border = isset( $shortcode_meta['wcsp_nav_border'] ) ? $shortcode_meta['wcsp_nav_border'] : '';

			// Pagination.
		$pagination               = isset( $shortcode_meta['wcsp_pagination'] ) ? $shortcode_meta['wcsp_pagination'] : '';
		$pagination_colors        = isset( $shortcode_meta['wcsp_pagination_colors'] ) ? $shortcode_meta['wcsp_pagination_colors'] : '';
		$pagination_number_colors = isset( $shortcode_meta['wcsp_pagination_number_colors'] ) ? $shortcode_meta['wcsp_pagination_number_colors'] : '';

			// Miscellaneous.
		$touch_swipe = isset( $shortcode_meta['wcsp_touch_swipe'] ) ? $shortcode_meta['wcsp_touch_swipe'] : false;
		$slider_mouse_wheel   = isset( $shortcode_meta['wcsp_slider_mouse_wheel'] ) && $shortcode_meta['wcsp_slider_mouse_wheel'] ? 'true' : 'false';

		$auto_height = isset( $shortcode_meta['wcsp_auto_height'] ) ? $shortcode_meta['wcsp_auto_height'] : true;

		//
		// DISPLAY OPTIONS.
		//
		$section_title        = isset( $shortcode_meta['wcsp_section_title'] ) && true == $shortcode_meta['wcsp_section_title'] ? true : false;
		$section_title_margin = isset( $shortcode_meta['wcsp_section_title_margin'] ) ? $shortcode_meta['wcsp_section_title_margin'] : '';
		$space_between_cat    = isset( $shortcode_meta['wcsp_space_between_cat'] ) ? $shortcode_meta['wcsp_space_between_cat']['all'] : '';
		$content_position     = isset( $shortcode_meta['wcsp_cat_content_position'] ) ? $shortcode_meta['wcsp_cat_content_position'] : 'thumb_above_cont_below';

			// Category content.
		$cat_name                   = isset( $shortcode_meta['wcsp_cat_name'] ) ? $shortcode_meta['wcsp_cat_name'] : '';
		$cat_product_count          = isset( $shortcode_meta['wcsp_cat_product_count'] ) ? $shortcode_meta['wcsp_cat_product_count'] : '';
		$cat_product_count_position = isset( $shortcode_meta['wcsp_cat_product_count_position'] ) ? $shortcode_meta['wcsp_cat_product_count_position'] : '';
		$cat_product_count_before   = isset( $shortcode_meta['wcsp_cat_product_count_before'] ) ? $shortcode_meta['wcsp_cat_product_count_before'] : '';
		$cat_product_count_after    = isset( $shortcode_meta['wcsp_cat_product_count_after'] ) ? $shortcode_meta['wcsp_cat_product_count_after'] : '';
		$cat_description            = isset( $shortcode_meta['wcsp_cat_description'] ) ? $shortcode_meta['wcsp_cat_description'] : '';
		$cat_shop_now_button        = isset( $shortcode_meta['wcsp_cat_shop_now_button'] ) ? $shortcode_meta['wcsp_cat_shop_now_button'] : '';
		$cat_shop_now_button_text   = isset( $shortcode_meta['wcsp_cat_shop_now_button_text'] ) ? $shortcode_meta['wcsp_cat_shop_now_button_text'] : '';
		$cat_shop_button_color      = isset( $shortcode_meta['wcsp_cat_shop_button_color'] ) ? $shortcode_meta['wcsp_cat_shop_button_color'] : '';
		$cat_shop_button_border     = isset( $shortcode_meta['wcsp_cat_shop_button_border'] ) ? $shortcode_meta['wcsp_cat_shop_button_border'] : '';
		$cat_link_target            = isset( $shortcode_meta['wcsp_cat_link_target'] ) ? $shortcode_meta['wcsp_cat_link_target'] : '';

		//
		// THUMBNAIL SETTINGS.
		//
		$thumbnail          = isset( $shortcode_meta['wcsp_thumbnail'] ) ? $shortcode_meta['wcsp_thumbnail'] : true;
		$thumbnail_size     = isset( $shortcode_meta['wcsp_thumbnail_size'] ) ? $shortcode_meta['wcsp_thumbnail_size'] : '';
		$thumb_width_height = isset( $shortcode_meta['wcsp_cat_thumb_width_height'] ) ? $shortcode_meta['wcsp_cat_thumb_width_height'] : '';
		$thumb_width        = isset( $thumb_width_height['top'] ) ? $thumb_width_height['top'] : '';
		$thumb_height       = isset( $thumb_width_height['right'] ) ? $thumb_width_height['right'] : '';
		$thumb_crop         = isset( $thumb_width_height['style'] ) ? true : false;
		$border_box_shadow  = isset( $shortcode_meta['wcsp_cat_border_box_shadow'] ) ? $shortcode_meta['wcsp_cat_border_box_shadow'] : '';
		$thumb_border       = isset( $shortcode_meta['wcsp_cat_thumb_border'] ) ? $shortcode_meta['wcsp_cat_thumb_border'] : '';
		$thumb_margin       = isset( $shortcode_meta['wcsp_thumb_margin'] ) ? $shortcode_meta['wcsp_thumb_margin'] : '';

		wp_enqueue_style( 'sp-wcs-font-awesome' );
		wp_enqueue_style( 'woo-category-slider-grid' );

		/**
		 * Filter Category.
		 */
		switch ( $filter_categories ) {
			case 'specific':
				$filter_cat_arg = array(
					'include' => $cat_list,
				);
				break;
			default:
				$filter_cat_arg = array();
				break;
		}
		/**
		 * Child Category.
		 */
		switch ( $child_categories ) {
			case 'beside_parent':
				$parent_cat = array();
				break;
			default:
				$parent_cat = array(
					'parent' => 0,
				);
				break;
		}

		$number_of_total_child_cat = isset( $shortcode_meta['wcsp_child_categories'] ) && 'child_only' == $child_categories ? $number_of_total_cat : '';
		$number_of_total_cat       = isset( $shortcode_meta['wcsp_child_categories'] ) && 'child_only' == $child_categories ? 100 : $number_of_total_cat;
		$cat_arg                   = array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => $hide_empty_cat,
			'orderby'    => $order_by,
			'order'      => $order,
			'number'     => $number_of_total_cat,
		);

		$cat_args    = array_merge( $cat_arg, $filter_cat_arg, $parent_cat );
		$wcs_terms   = get_categories( $cat_args );
		$output      = '';
		$data_slider = '';
		if ( 'slider' == $layout_preset ) {
			wp_enqueue_style( 'sp-wcs-swiper' );
			wp_enqueue_script( 'sp-wcs-swiper-js' );
			wp_enqueue_script( 'sp-wcs-swiper-config' );
			$data_slider = 'data-slider=\'{
				"auto_play": ' . $auto_play . ',
				"auto_play_speed": ' . $auto_play_speed . ',
				"standard_scroll_speed": ' . $standard_scroll_speed . ',
				"pause_on_hover": ' . $pause_on_hover . ',
				"auto_height": ' . $auto_height . ',
				"infinite_loop": ' . $infinite_loop . ',
				"large_desktop": ' . $large_desktop . ',
				"space_between_cat": ' . $space_between_cat . ',
				"large_desktop_scroll": ' . $large_desktop_scroll . ',
				"pagination": "' . $pagination . '",
				"navigation": "' . $navigation . '",
				"touch_swipe": ' . $touch_swipe . ',
				"mouse_wheel": ' . $slider_mouse_wheel . ',
				"breakpoints": {
					"desktop": ' . $desktop . ',
					"laptop": ' . $laptop . ',
					"tablet": ' . $tablet . ',
					"mobile": ' . $mobile . ',
					"desktop_scroll": ' . $desktop_scroll . ',
					"laptop_scroll": ' . $laptop_scroll . ',
					"tablet_scroll": ' . $tablet_scroll . ',
					"mobile_scroll": ' . $mobile_scroll . '
				}
			}\'';
		}

		/**
		 * Layout Class.
		 */
		$container_class = '';
		$item_class      = '';
		$wrapper_class   = '';
		$area_class      = '';
		switch ( $layout_preset ) {
			case 'slider':
				$wrapper_class   .= ' swiper-wrapper';
				$container_class .= ' swiper-container';
				$item_class      .= ' swiper-slide';
				break;
		}

		// Dynamic CSS.
		require SP_WCS_PATH . '/public/dynamic-style.php';
		ob_start();
		$output .= $dynamic_style;

		$nav_top_right = '';
		if ( 'show' == $navigation && 'slider' == $layout_preset || 'hide_mobile' == $navigation && 'slider' == $layout_preset ) {
			$nav_top_right = 'nav-top-right';
		}
		// Slider Area Starts.
		$output .= '<div id="sp-wcsp-slider-area-' . $post_id . '" class="sp-wcsp-slider-area sp-wcsp-slider-area-' . $post_id . ' ' . $nav_top_right . ' content-position-' . $content_position . $area_class . '" ' . $data_slider . '>';
		if ( $section_title ) {
			$output .= '<h3 class="sp-wcsp-section-title">' . get_the_title( $post_id ) . '</h3>';
		}

		/**
		 * Preloader Class.
		 */
		$preloader_class = '';
		if ( $preloader ) {
			wp_enqueue_script( 'sp-wcs-preloader' );
			require SP_WCS_PATH . 'public/preloader.php';
			$preloader_class = ' wcsp-preloader';
		}

		require SP_WCS_PATH . 'public/layout/slider.php';
		ob_end_clean();
		wp_reset_postdata();

		return $output;

	}

}
