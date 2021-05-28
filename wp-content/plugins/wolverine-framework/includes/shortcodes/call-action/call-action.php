<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Call_Action')) {
	class g5plusFramework_Shortcode_Call_Action
	{
		function __construct()
		{
			add_shortcode('wolverine_call_action', array($this, 'call_action_shortcode'));
		}

		function call_action_shortcode($atts)
		{
			/**
			 * Shortcode attributes
			 * @var $layout_style
			 * @var $text
			 * @var $sub_text
			 * @var $link
			 * @var $el_class
			 * @var $css_animation
			 * @var $duration
			 * @var $delay
			 */
			$atts = vc_map_get_attributes( 'wolverine_call_action', $atts );
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
            ob_start();?>
            <div class="wolverine-call-action <?php echo esc_attr($layout_style) ?> <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <?php if($layout_style!='style5' && $layout_style!='style6'):?>
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12 wolverine-call-action-left">
                        <div class="content-middle">
                            <div class="content-middle-inner">
                                <h6><?php echo esc_attr($text) ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 wolverine-call-action-right">
                        <div class="content-middle">
                            <div class="content-middle-inner">
                                <a class="wolverine-button button-2x" href="<?php echo esc_url($a_href); ?>" target="<?php echo esc_attr($a_target); ?>"><?php echo esc_html($a_title); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else :?>
                    <div class="container">
	                    <?php if($text!=''):?>
                        <h2><?php echo esc_html($text); ?></h2>
		                <?php endif;?>
						<?php if($sub_text!=''):?>
                        <p><?php echo esc_html($sub_text); ?></p>
						<?php endif;?>
						<?php if($a_title!=''):?>
                        <a class="wolverine-button button-2x" href="<?php echo esc_url($a_href); ?>" target="<?php echo esc_attr($a_target); ?>"><?php echo esc_html($a_title); ?></a>
						<?php endif;?>
                    </div>
                <?php endif;?>
            </div>
            <?php
            $content = ob_get_clean();
            return $content;
		}
	}
    new g5plusFramework_Shortcode_Call_Action();
}