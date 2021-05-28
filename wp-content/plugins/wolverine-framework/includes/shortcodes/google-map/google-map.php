<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/31/2015
 * Time: 3:20 PM
 */
if ( ! defined( 'ABSPATH' ) ) die( '-1' );
if (!class_exists('g5plusFramework_Shortcode_Google_Map')) {
	class g5plusFramework_Shortcode_Google_Map{
		function __construct() {
			add_shortcode('wolverine_google_map', array($this, 'google_map' ));
		}
		function google_map($atts) {
			$location_x = '';
			$location_y = '';
			$marker_title = '';
			$map_height = '';
			$map_zoom = '';
			$map_style = '';
			$el_class='';
			$css_animation=$duration=$delay=$api_url='';
			$atts = vc_map_get_attributes( 'wolverine_google_map', $atts );
			extract( $atts );
			$opt_enable_minifile_js = g5plus_framework_get_option('enable_minifile_js');
			$min_suffix = ($opt_enable_minifile_js == 1) ? '.min' :  '';
			wp_enqueue_script('wolverine-google-api',$api_url, array(), false, true);
			wp_enqueue_script('wolverine-google-maps', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/google-map/assets/js/google-map' . $min_suffix . '.js', false, true);

			$g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
			ob_start();
			?>
			<div class="wolverine-google-map<?php echo esc_attr($g5plus_animation) ?>"  data-location-x="<?php echo esc_attr($location_x) ?>" data-location-y="<?php echo esc_attr($location_y) ?>"
			     data-marker-title="<?php echo esc_attr($marker_title) ?>" style="height:<?php echo esc_attr($map_height) ?>"
				 data-map-zoom="<?php echo esc_attr($map_zoom) ?>" data-map-style="<?php echo esc_attr($map_style) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>></div>
			<?php
			$content = ob_get_clean();
			return $content;
		}
	}
	new g5plusFramework_Shortcode_Google_Map();
}