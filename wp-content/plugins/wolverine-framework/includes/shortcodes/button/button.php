<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_ShortCode_Button')) {
	class g5plusFramework_ShortCode_Button
	{
		function __construct()
		{
			add_shortcode('wolverine_button', array($this, 'button_shortcode'));
		}

		function button_shortcode($atts)
		{
			/**
			 * Shortcode attributes
			 * @var $layout_style
			 * @var $custom_background
			 * @var $custom_text
			 * @var $custom_border
			 * @var $size
			 * @var $link
			 * @var $el_class
			 * @var $css_animation
			 * @var $duration
			 * @var $delay
			 */
			$atts = vc_map_get_attributes( 'wolverine_button', $atts );
			extract( $atts );
			$g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            //parse link
            $link = ( $link == '||' ) ? '' : $link;
            $link = vc_build_link( $link );
            $a_title='';
			$a_target='_self';
            $a_href='#';
            if ( strlen( $link['title'] ) > 0 ) {
                $a_href = $link['url'];
                $a_title = $link['title'];
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            ob_start();
            if($layout_style=='custom'):?>
            <a style="background-color: <?php echo esc_attr($custom_background)?>; color: <?php echo esc_attr($custom_text)?>; border-color: <?php echo esc_attr($custom_border)?>"  class="wolverine-button <?php echo esc_attr($layout_style) ?> <?php echo esc_attr($size) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?> href="<?php echo esc_url($a_href); ?>" title="<?php echo esc_attr($a_title); ?>" target="<?php echo esc_attr($a_target); ?>"><?php echo esc_html($a_title); ?></a>
            <?php else: ?>
            <a  class="wolverine-button <?php echo esc_attr($layout_style) ?> <?php echo esc_attr($size) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?> href="<?php echo esc_url($a_href); ?>" title="<?php echo esc_attr($a_title); ?>" target="<?php echo esc_attr($a_target); ?>"><?php echo esc_html($a_title); ?></a>
            <?php endif;
            $content = ob_get_clean();
            return $content;
		}
	}
    new g5plusFramework_ShortCode_Button();
}