<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/31/2015
 * Time: 3:20 PM
 */
if ( ! defined( 'ABSPATH' ) ) die( '-1' );
if (!class_exists('g5plusFramework_Shortcode_Navigation_FullPage')) {
	class g5plusFramework_Shortcode_Navigation_FullPage{
		function __construct() {
			add_shortcode('wolverine_navigation_fullpage', array($this, 'navigation_fullpage' ));
		}
		function navigation_fullpage($atts) {
			$opt_enable_minifile_js = g5plus_framework_get_option('enable_minifile_js');
			$min_suffix = $opt_enable_minifile_js == 1 ? '.min' :  '';

			wp_enqueue_script('wolverine-navigation-fullpage', PLUGIN_G5PLUS_FRAMEWORK_URL  . 'includes/shortcodes/navigation-fullpage/assets/js/nav-fullpage' . $min_suffix . '.js', false, true);

			$align = $navigation = $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
			$atts = vc_map_get_attributes( 'wolverine_navigation_fullpage', $atts );
			extract(shortcode_atts(array(
				'align'       => 'left',
				'navigation'        => '' ,
				'el_class'      => '',
				'css_animation' => '',
				'duration'      => '',
				'delay'         => ''
			), $atts));
			$navigation = (array) vc_param_group_parse_atts( $navigation );
			if (!$navigation || count($navigation) == 0 ) {
				return;
			}
			$class= array('shortcode-nav-fullpage-wrap');
			$class[] = $el_class;
			$class[] = $align;
			$class[] = g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);

			$class_name = join(' ',$class);
			ob_start();
			?>
			<div class="<?php echo esc_attr($class_name); ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
				<ul class="nav-full-page">
					<?php foreach ( $navigation as $data ) {
						$title = isset( $data['title'] ) ? $data['title'] : '';
						$id = isset( $data['id'] ) ? $data['id'] : '';
						if ($id == '') continue;
						?>
						<li>
							<a href="#<?php echo wp_kses_post($id);?>" title="<?php echo esc_attr($title) ?>"><span><?php echo esc_html($title); ?></span></a>
						</li>
					<?php } ?>
				</ul>
			</div>
			<?php
			$content =  ob_get_clean();
			return $content;


		}
	}
	new g5plusFramework_Shortcode_Navigation_FullPage();
}