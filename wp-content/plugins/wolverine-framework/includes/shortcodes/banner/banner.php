<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Banner')) {
	class g5plusFramework_Shortcode_Banner
	{
		function __construct()
		{
			add_shortcode('wolverine_banner', array($this, 'banner_shortcode'));
		}
		function banner_shortcode($atts)
		{
			/**
			 * Shortcode attributes
			 * @var $layout_style
			 * @var $icon_type
			 * @var $icon_fontawesome
			 * @var $icon_wolverine
			 * @var $icon_openiconic
			 * @var $icon_typicons
			 * @var $icon_entypoicons
			 * @var $icon_linecons
			 * @var $icon_entypo
			 * @var $image
			 * @var $link
			 * @var $title
			 * @var $sub_title
			 * @var $height
			 * @var $el_class
			 * @var $css_animation
			 * @var $duration
			 * @var $delay
			 */
            $iconClass='';
			$atts = vc_map_get_attributes( 'wolverine_banner', $atts );
			extract( $atts );
			$g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            if($icon_type!='')
            {
                vc_icon_element_fonts_enqueue( $icon_type );
                $iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : '';
            }
            //parse link
            $link = ( $link == '||' ) ? '' : $link;
            $link = vc_build_link( $link );

            $a_href='#';
            $a_title = $title;
            $a_target = '_self';

            if ( strlen( $link['url'] ) > 0 ) {
                $a_href = $link['url'];
                $a_title = $link['title'];
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            if (!empty($height))
            {
                $style = ' style="height:'.$height.'px;"';
            }
            if (!empty($image)) {
                $bg_images_attr = wp_get_attachment_image_src($image, "full");
                if (isset($bg_images_attr)) {
                    if (!empty($height))
                    {
                        $style = ' style="height:'.$height.'px; background-image: url(' . $bg_images_attr[0] . ')"';
                    }
                    else
                    {
                        $style = ' style="background-image: url(' . $bg_images_attr[0] . ')"';
                    }
                }
            }
            ob_start();?>
			<div<?php echo wp_kses_post($style)?> class="wolverine-banner <?php echo esc_attr($layout_style) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <div class="overlay-banner">
                    <a title="<?php echo esc_attr($a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" href="<?php echo  esc_url($a_href) ?>">
                        <div class="content-middle">
                            <div class="content-middle-inner">
                                <?php if (!empty($iconClass)):?>
                                    <i class="<?php echo esc_attr($iconClass) ?>"></i>
                                <?php endif;
								if (!empty($title)):?>
                                <h2><?php echo esc_html($title) ?></h2>
								<?php endif;
                                if (!empty($sub_title)):?>
                                <p><?php echo esc_html($sub_title) ?></p>
                                <?php endif;?>
                            </div>
                        </div>
                    </a>
                </div>
			</div>
            <?php
            $content = ob_get_clean();
            return $content;
		}
	}
    new g5plusFramework_Shortcode_Banner();
}