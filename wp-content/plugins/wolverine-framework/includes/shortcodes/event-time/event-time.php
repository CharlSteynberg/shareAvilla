<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Event_Time')) {
	class g5plusFramework_Shortcode_Event_Time
	{
		function __construct()
		{
			add_shortcode('wolverine_event_time', array($this, 'event_time_shortcode'));
		}
		function event_time_shortcode($atts)
		{
			/**
			 * Shortcode attributes
			 * @var $color_scheme
			 * @var $title
			 * @var $location
			 * @var $month
			 * @var $day
			 * @var $time
			 * @var $link
			 * @var $el_class
			 * @var $css_animation
			 * @var $duration
			 * @var $delay
			 */
			$atts = vc_map_get_attributes( 'wolverine_event_time', $atts );
			extract( $atts );
			$g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
			//parse link
			$link = ( $link == '||' ) ? '' : $link;
			$link = vc_build_link( $link );

			$a_href='#';
			$a_target = '_self';
			$a_title = '';

			if ( strlen( $link['url'] ) > 0 ) {
				$a_href = $link['url'];
				$a_title = $link['title'];
				$a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
			}
			ob_start();?>
			<div class="wolverine-event-time  <?php echo esc_attr($color_scheme); ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
				<div class="event-time-date-box">
					<span><?php echo esc_html($day) ?></span>
					<p><?php echo esc_html($month) ?></p>
				</div>
				<div class="event-time-detail">
					<h6><?php echo esc_attr($title) ?></h6>
					<p><i class="wicon icon-outline-vector-icons-pack-96"></i><?php echo esc_html($time) ?></p>
					<p><i class="wicon icon-outline-vector-icons-pack-22"></i><?php echo esc_html($location) ?></p>
				</div>
				<?php if($a_title!=''):?>
				<a title="<?php echo esc_attr($a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" href="<?php echo  esc_url($a_href) ?>"><?php echo esc_html($a_title) ?></a>
				<?php endif;?>
			</div>
			<?php
			$content = ob_get_clean();
			return $content;
		}
	}
	new g5plusFramework_Shortcode_Event_Time();
}