<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Icon_Box')) {
	class g5plusFramework_Shortcode_Icon_Box
	{
		function __construct()
		{
			add_shortcode('wolverine_icon_box', array($this, 'icon_box_shortcode'));
		}
		function icon_box_shortcode($atts)
		{
			/**
			 * Shortcode attributes
			 * @var $layout_style
			 * @var $color_scheme
			 * @var $icon_type
			 * @var $icon_fontawesome
			 * @var $icon_wolverine
			 * @var $icon_openiconic
			 * @var $icon_typicons
			 * @var $icon_entypoicons
			 * @var $icon_linecons
			 * @var $icon_entypo
			 * @var $icon_image
			 * @var $link
			 * @var $title
			 * @var $description
			 * @var $el_class
			 * @var $css_animation
			 * @var $duration
			 * @var $delay
			 */
			$iconClass='';
			$atts = vc_map_get_attributes( 'wolverine_icon_box', $atts );
			extract( $atts );
			$g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            if($icon_type!='' && $icon_type!='image')
            {
                vc_icon_element_fonts_enqueue( $icon_type );
                $iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : '';
            }
            //parse link
            $link = ( $link == '||' ) ? '' : $link;
            $link = vc_build_link( $link );

            $a_href='#';
            $a_target = '_self';
            $a_title = $title;

            if ( strlen( $link['url'] ) > 0 ) {
                $a_href = $link['url'];
                $a_title = $link['title'];
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            ob_start();?>
			<div class="wolverine-icon-box <?php echo esc_attr($layout_style) ?> <?php if($layout_style!='style2' && $layout_style!='style3') { echo esc_attr($color_scheme);} ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <?php if($layout_style=='style2'):
	                if($title!=''):?>
                    <h3><a title="<?php echo esc_attr($a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" href="<?php echo  esc_url($a_href) ?>"><?php echo esc_html($title) ?></a></h3>
		            <?php endif;
                endif;?>
                <a class="ibox-icon" title="<?php echo esc_attr($a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" href="<?php echo  esc_url($a_href) ?>">
                    <?php if ( $icon_type != '' ) :
                        if ( $icon_type == 'image' ) :
                            $img = wp_get_attachment_image_src( $icon_image, 'full' );?>
                            <img src="<?php echo esc_url($img[0])?>"/>
                        <?php else :?>
                            <i class="<?php echo esc_attr($iconClass) ?>"></i>
                        <?php endif;
                    endif;?>
                </a>
                <?php if($layout_style!='style2'):
					if($title!=''):?>
                    <h3><a title="<?php echo esc_attr($a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" href="<?php echo  esc_url($a_href) ?>"><?php echo esc_html($title) ?></a></h3>
					<?php endif;
                endif;
                if($description!=''):?>
                <p><?php echo wp_kses_post($description) ?></p>
                <?php endif;?>
			</div>
            <?php
            $content = ob_get_clean();
            return $content;
		}
	}
    new g5plusFramework_Shortcode_Icon_Box();
}