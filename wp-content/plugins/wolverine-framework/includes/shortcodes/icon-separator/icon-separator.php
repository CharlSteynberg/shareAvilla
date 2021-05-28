<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Icon_Separator')) {
	class g5plusFramework_Shortcode_Icon_Separator
	{
		function __construct()
		{
			add_shortcode('wolverine_icon_separator', array($this, 'icon_separator_shortcode'));
		}
		function icon_separator_shortcode($atts)
		{
			/**
			 * Shortcode attributes
			 * @var $icon_type
			 * @var $icon_fontawesome
			 * @var $icon_wolverine
			 * @var $icon_openiconic
			 * @var $icon_typicons
			 * @var $icon_entypoicons
			 * @var $icon_linecons
			 * @var $icon_entypo
			 * @var $el_class
			 * @var $css_animation
			 * @var $duration
			 * @var $delay
			 */
			$iconClass='';
			$atts = vc_map_get_attributes( 'wolverine_icon_separator', $atts );
			extract( $atts );
			$g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            if($icon_type!='')
            {
                vc_icon_element_fonts_enqueue( $icon_type );
                $iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
            }
            ob_start();?>
            <div class="wolverine-icon-separator <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <span><i class="<?php echo esc_attr($iconClass) ?>"></i></span>
            </div>
            <?php
            $content = ob_get_clean();
            return $content;
		}
	}
    new g5plusFramework_Shortcode_Icon_Separator();
}