<?php
/**
 * This file render the shortcode to the frontend
 *
 * @package Woo-category-slider
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Category Slider for WooCommerce - Shortcode Render class
 *
 * @since 1.0
 */
if ( ! class_exists( 'WPL_WCS_Shortcode_Render' ) ) {
	class WPL_WCS_Shortcode_Render {

		/**
		 * WPL_WCS_Shortcode_Render single instance of the class
		 *
		 * @since 1.0
		 */
		protected static $_instance = null;


		/**
		 * WPL_WCS_Shortcode_Render Instance
		 *
		 * @since 1.0
		 *
		 * @static
		 * @return self Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * WPL_WCS_Shortcode_Render constructor.
		 */
		public function __construct() {
			add_shortcode( 'woo_cat_slider', array( $this, 'shortcode_render' ) );
		}

		/**
		 * @param $attributes
		 *
		 * @return string
		 * @since 1.0
		 */
		public function shortcode_render( $attributes ) {

			if ( empty( $attributes['id'] ) ) {
				return;
			}
			$post_id = $attributes['id'];

			$shortcode_data                = get_post_meta( $post_id, 'wpl_wcs_shortcode_options', true );
			$layout                        = ( isset( $shortcode_data['layout'] ) ? $shortcode_data['layout'] : '' );
			$theme                         = ( isset( $shortcode_data['theme'] ) ? $shortcode_data['theme'] : '' );
			$display_categories            = ( isset( $shortcode_data['display_categories'] ) ? $shortcode_data['display_categories'] : '' );
			$cat_list                      = ( isset( $shortcode_data['cat_list'] ) ? $shortcode_data['cat_list'] : '' );
			$number_of_total_cat           = ( isset( $shortcode_data['number_of_total_cat'] ) ? $shortcode_data['number_of_total_cat'] : '' );
			$number_of_cat                 = ( isset( $shortcode_data['number_of_cat'] ) ? $shortcode_data['number_of_cat'] : '' );
			$number_of_cat_desktop         = ( isset( $shortcode_data['number_of_cat_desktop'] ) ? $shortcode_data['number_of_cat_desktop'] : '' );
			$number_of_cat_small_desktop   = ( isset( $shortcode_data['number_of_cat_small_desktop'] ) ? $shortcode_data['number_of_cat_small_desktop'] : '' );
			$number_of_cat_tablet          = ( isset( $shortcode_data['number_of_cat_tablet'] ) ? $shortcode_data['number_of_cat_tablet'] : '' );
			$number_of_cat_mobile          = ( isset( $shortcode_data['number_of_cat_mobile'] ) ? $shortcode_data['number_of_cat_mobile'] : '' );
			$pagination_bg                 = ( isset( $shortcode_data['pagination_bg'] ) ? $shortcode_data['pagination_bg'] : '' );
			$pagination_active_bg          = ( isset( $shortcode_data['pagination_active_bg'] ) ? $shortcode_data['pagination_active_bg'] : '' );
			$navigation_bg                 = ( isset( $shortcode_data['navigation_bg'] ) ? $shortcode_data['navigation_bg'] : '' );
			$navigation_color              = ( isset( $shortcode_data['navigation_color'] ) ? $shortcode_data['navigation_color'] : '' );
			$navigation_border_color       = ( isset( $shortcode_data['navigation_border_color'] ) ? $shortcode_data['navigation_border_color'] : '' );
			$navigation_hover_bg           = ( isset( $shortcode_data['navigation_hover_bg'] ) ? $shortcode_data['navigation_hover_bg'] : '' );
			$navigation_hover_color        = ( isset( $shortcode_data['navigation_hover_color'] ) ? $shortcode_data['navigation_hover_color'] : '' );
			$navigation_hover_border_color = ( isset( $shortcode_data['navigation_hover_border_color'] ) ? $shortcode_data['navigation_hover_border_color'] : '' );
			$slider_speed                  = ( isset( $shortcode_data['slider_speed'] ) ? $shortcode_data['slider_speed'] : '' );
			$cat_order_by                  = ( isset( $shortcode_data['cat_order_by'] ) ? $shortcode_data['cat_order_by'] : '' );
			$cat_order                     = ( isset( $shortcode_data['cat_order'] ) ? $shortcode_data['cat_order'] : '' );
			$slider_title_color            = ( isset( $shortcode_data['slider_title_color'] ) ? $shortcode_data['slider_title_color'] : '' );
			$category_info_bg              = ( isset( $shortcode_data['category_info_bg'] ) ? $shortcode_data['category_info_bg'] : '' );
			$cat_name_color                = ( isset( $shortcode_data['cat_name_color'] ) ? $shortcode_data['cat_name_color'] : '' );
			$cat_name_color2               = ( isset( $shortcode_data['cat_name_color2'] ) ? $shortcode_data['cat_name_color2'] : '' );
			$product_count_color           = ( isset( $shortcode_data['product_count_color'] ) ? $shortcode_data['product_count_color'] : '' );
			$product_count_color2          = ( isset( $shortcode_data['product_count_color2'] ) ? $shortcode_data['product_count_color2'] : '' );
			$shop_now_bg                   = ( isset( $shortcode_data['shop_now_bg'] ) ? $shortcode_data['shop_now_bg'] : '' );
			$shop_now_color                = ( isset( $shortcode_data['shop_now_color'] ) ? $shortcode_data['shop_now_color'] : '' );
			$shop_now_hover_bg             = ( isset( $shortcode_data['shop_now_hover_bg'] ) ? $shortcode_data['shop_now_hover_bg'] : '' );
			$shop_now_hover_color          = ( isset( $shortcode_data['shop_now_hover_color'] ) ? $shortcode_data['shop_now_hover_color'] : '' );
			$category_info_overlay         = ( isset( $shortcode_data['category_info_overlay'] ) ? $shortcode_data['category_info_overlay'] : '' );
			$auto_play                     = ( isset( $shortcode_data['auto_play'] ) && true == $shortcode_data['auto_play'] ? 'true' : 'false' );
			$auto_play_speed               = ( isset( $shortcode_data['auto_play_speed'] ) ? $shortcode_data['auto_play_speed'] : '' );
			$swipe                         = ( isset( $shortcode_data['swipe'] ) && true == $shortcode_data['swipe'] ? 'true' : 'false' );
			$mouse_draggable               = ( isset( $shortcode_data['mouse_draggable'] ) && true == $shortcode_data['mouse_draggable'] ? 'true' : 'false' );
			$pagination                    = ( isset( $shortcode_data['pagination'] ) && true == $shortcode_data['pagination'] ? 'true' : 'false' );
			$navigation                    = ( isset( $shortcode_data['navigation'] ) && true == $shortcode_data['navigation'] ? 'true' : 'false' );
			$rtl                           = ( isset( $shortcode_data['rtl'] ) && true == $shortcode_data['rtl'] ? 'true' : 'false' );
			$pause_on_hover                = ( isset( $shortcode_data['pause_on_hover'] ) && true == $shortcode_data['pause_on_hover'] ? 'true' : 'false' );
			$slider_title                  = ( isset( $shortcode_data['slider_title'] ) && true == $shortcode_data['slider_title'] ? 'true' : 'false' );
			$cat_name                      = ( isset( $shortcode_data['cat_name'] ) && true == $shortcode_data['cat_name'] ? 'true' : 'false' );
			$product_count                 = ( isset( $shortcode_data['product_count'] ) && true == $shortcode_data['product_count'] ? 'true' : 'false' );
			$shop_now                      = ( isset( $shortcode_data['shop_now'] ) && true == $shortcode_data['shop_now'] ? 'true' : 'false' );
			$hide_empty_cat                = ( isset( $shortcode_data['hide_empty_cat'] ) && true == $shortcode_data['hide_empty_cat'] ? '1' : '0' );
			$include_child_cat             = ( isset( $shortcode_data['include_child_cat'] ) && true == $shortcode_data['include_child_cat'] ? 'true' : 'false' );
			$cat_image                     = ( isset( $shortcode_data['cat_image'] ) && true == $shortcode_data['cat_image'] ? 'true' : 'false' );

			wp_enqueue_style( 'sp-wcs-font-awesome' );

			if ( 'specific_cat' == $display_categories ) {
				if ( 'false' == $include_child_cat && '' !== $cat_list ) {
					$cat_args = array(
						'taxonomy'         => 'product_cat',
						'term_taxonomy_id' => $cat_list,
						'hide_empty'       => $hide_empty_cat,
						'parent'           => 0,
						'orderby'          => $cat_order_by,
						'order'            => $cat_order,
						'number'           => $number_of_total_cat,
					);
				} else {
					$cat_args = array(
						'taxonomy'         => 'product_cat',
						'term_taxonomy_id' => $cat_list,
						'hide_empty'       => $hide_empty_cat,
						'orderby'          => $cat_order_by,
						'order'            => $cat_order,
						'number'           => $number_of_total_cat,
					);
				}
			} else {
				if ( 'false' == $include_child_cat ) {
					$cat_args = array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => $hide_empty_cat,
						'parent'     => 0,
						'orderby'    => $cat_order_by,
						'order'      => $cat_order,
						'number'     => $number_of_total_cat,
					);
				} else {
					$cat_args = array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => $hide_empty_cat,
						'orderby'    => $cat_order_by,
						'order'      => $cat_order,
						'number'     => $number_of_total_cat,
					);
				}
			}

			$terms = get_terms( $cat_args );

			$outline = '';

			$outline .= '<style>';

			if ( 'slider' == $layout ) {
				$outline .= '#wpl-wcs-slider-' . $post_id . ' .slick-dots li button{
					background: ' . $pagination_bg . ';
				}
				#wpl-wcs-slider-' . $post_id . ' .slick-dots li.slick-active button{
					background: ' . $pagination_active_bg . ';
				}
				#wpl-wcs-slider-' . $post_id . ' .slick-prev, 
				#wpl-wcs-slider-' . $post_id . ' .slick-next{
					background: ' . $navigation_bg . ';
					color: ' . $navigation_color . ';
					border: 1px solid ' . $navigation_border_color . ';
				}
				#wpl-wcs-slider-' . $post_id . ' .slick-prev:hover, 
				#wpl-wcs-slider-' . $post_id . ' .slick-next:hover{
					background: ' . $navigation_hover_bg . ';
					color: ' . $navigation_hover_color . ';
					border: 1px solid ' . $navigation_hover_border_color . ';
				}';
			}
			if ( 'true' == $slider_title ) {
				$outline .= '.wpl-wcs-slider-section-' . $post_id . ' h2.wpl-wcs-slider-section-title{
					color: ' . $slider_title_color . ';
				}';
			}
			if ( 'true' == $navigation && 'true' !== $slider_title ) {
				$outline .= '.wpl-wcs-slider-section-' . $post_id . '.wpl-wcs-slider-section{
					padding-top: 45px;
				}';
			}
			if ( 'theme_three' == $theme || 'theme_two' == $theme ) {
				$outline .= '.wpl-wcs-slider-section-' . $post_id . ' .wpl-wcs-cat-info{
					background: ' . $category_info_bg . ';
				}';
			}
			if ( 'theme_four' == $theme || 'theme_one' == $theme ) {
				$outline .= '.wpl-wcs-slider-section-' . $post_id . ' .wpl-wcs-cat-info{
					background: ' . $category_info_overlay . ';
				}';
			}
			if ( 'theme_three' == $theme && 'true' == $cat_name || 'theme_two' == $theme && 'true' == $cat_name ) {
				$outline .= '.wpl-wcs-slider-section-' . $post_id . ' .wpl-wcs-cat-info .wpl-wcs-cat-name{
					color: ' . $cat_name_color . ';
				}';
			}
			if ( 'theme_four' == $theme && 'true' == $cat_name || 'theme_one' == $theme && 'true' == $cat_name ) {
				$outline .= '.wpl-wcs-slider-section-' . $post_id . ' .wpl-wcs-cat-info .wpl-wcs-cat-name{
					color: ' . $cat_name_color2 . ';
				}';
			}
			if ( 'theme_three' == $theme && 'true' == $product_count ) {
				$outline .= '.wpl-wcs-slider-section-' . $post_id . ' .wpl-wcs-cat-info .wpl-wcs-product-count{
					color: ' . $product_count_color . ';
				}';
			}
			if ( 'theme_four' == $theme && 'true' == $product_count ) {
				$outline .= '.wpl-wcs-slider-section-' . $post_id . ' .wpl-wcs-cat-info .wpl-wcs-product-count{
					color: ' . $product_count_color2 . ';
				}';
			}
			if ( 'theme_three' == $theme && 'true' == $shop_now || 'theme_four' == $theme && 'true' == $shop_now ) {
				$outline .= '.wpl-wcs-slider-section-' . $post_id . ' a.wpl-wcs-shop-now{
					color: ' . $shop_now_color . ';
					background: ' . $shop_now_bg . ';
				}
				.wpl-wcs-slider-section-' . $post_id . ' a.wpl-wcs-shop-now:hover{
					color: ' . $shop_now_hover_color . ';
					background: ' . $shop_now_hover_bg . ';
				}';
			}

			$outline .= '</style>';

			if ( 'slider' == $layout ) {
				wp_enqueue_style( 'wpl-wcs-slick' );
				wp_enqueue_script( 'wpl-wcs-slick-js' );
				wp_enqueue_script( 'wpl-wcs-slick-config' );
			}
			$outline .= '<div class="wpl-wcs-slider-section wpl-wcs-slider-section-' . $post_id . ' wpl-wcs-' . $theme . '">';
			if ( 'true' == $slider_title ) {
				$outline .= '<h2 class="wpl-wcs-slider-section-title">' . get_the_title( $post_id ) . '</h2>';
			}

			$outline .= '<div id="wpl-wcs-slider-' . $post_id . '" class="wpl-wcs-section';
			if ( 'slider' == $layout ) {
				$outline .= ' wpl-wcs-slider-config';
			} elseif ( 'grid' == $layout ) {
				$outline .= ' wpl-wcs-grid-config';
			}
			$outline .= '" data-slick=\'{"slidesToShow": ' . $number_of_cat . ', "slidesToScroll": 1, "dots": ' . $pagination . ', "pauseOnHover": ' . $pause_on_hover . ', "speed": ' . $slider_speed . ', "arrows": ' . $navigation . ', "autoplay": ' . $auto_play . ', "autoplaySpeed": ' . $auto_play_speed . ', "swipe": ' . $swipe . ', "draggable": ' . $mouse_draggable . ', "rtl": ' . $rtl . ', "responsive": [ {"breakpoint": 1280, "settings": { "slidesToShow": ' . $number_of_cat_desktop . ' } }, {"breakpoint": 980, "settings": { "slidesToShow": ' . $number_of_cat_small_desktop . ' } }, {"breakpoint": 736, "settings": { "slidesToShow": ' . $number_of_cat_tablet . ' } }, {"breakpoint": 480, "settings": { "slidesToShow": ' . $number_of_cat_mobile . ' } } ] }\' >';

			if ( $terms ) {
				foreach ( $terms as $term ) {

					$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
					if ( 'theme_three' == $theme || 'theme_four' == $theme ) {
						$thumbnail_img = wp_get_attachment_image_url( $thumbnail_id, 'wpl-wcs-cat-img' );
					} elseif ( 'theme_one' == $theme ) {
						$thumbnail_img = wp_get_attachment_image_url( $thumbnail_id, 'wpl-wcs-cat-img-two' );
					}

					$outline .= '<div class="wpl-wcs-cat-item ';
					if ( 'grid' == $layout ) {
						$outline .= 'wpl-wcs-col-xl-' . $number_of_cat . ' wpl-wcs-col-lg-' . $number_of_cat_desktop . ' wpl-wcs-col-md-' . $number_of_cat_small_desktop . ' wpl-wcs-col-sm-' . $number_of_cat_tablet . ' wpl-wcs-col-xs-' . $number_of_cat_mobile . '';
					}
					$outline .= '">';

					$outline .= '<div class="wpl-wcs-cat-item-content">';

					if ( 'theme_two' !== $theme ) {
						if ( 'true' !== $cat_image ) {
							// empty text.
						} else {
							if ( $thumbnail_img ) {
								$outline .= '<a href="' . esc_url( get_term_link( $term->term_id ) ) . '">';
								$outline .= '<img src="' . $thumbnail_img . '" alt="' . esc_html( $term->name ) . '" class="wpl-wcs-cat-image" />';
								$outline .= '</a>';
							}
						}
					}

					$outline .= '<div class="wpl-wcs-cat-info">';
					if ( 'true' == $cat_name ) {
						$outline .= '<a class="wpl-wcs-cat-name" href="' . esc_url( get_term_link( $term->term_id ) ) . '">';
						$outline .= esc_html( $term->name );

						if ( 'theme_one' == $theme && 'true' == $product_count || 'theme_two' == $theme && 'true' == $product_count ) {
							$outline .= ' (' . esc_html( $term->count ) . ')';
						}
						$outline .= ' </a>';
					}
					if ( 'theme_three' == $theme && 'true' == $product_count || 'theme_four' == $theme && 'true' == $product_count ) {
						$outline .= '<div class="wpl-wcs-product-count">' . esc_html( $term->count ) . ' Products</div>';
					}
					if ( 'theme_three' == $theme && 'true' == $shop_now || 'theme_four' == $theme && 'true' == $shop_now ) {
						$outline .= '<a class="wpl-wcs-shop-now" href="' . esc_url( get_term_link( $term->term_id ) ) . '">Shop Now</a>';
					}

					$outline .= '</div>';
					$outline .= '</div>'; // wpl-wcs-cat-item-content.
					$outline .= '</div>'; // wpl-wcs-cat-item.
				}
			}
			$outline .= '</div>'; // wpl-wcs-section.
			$outline .= '</div>'; // wpl-wcs-slider-section.

			wp_reset_postdata();

			return $outline;

		}

	}

	new WPL_WCS_Shortcode_Render();
}
