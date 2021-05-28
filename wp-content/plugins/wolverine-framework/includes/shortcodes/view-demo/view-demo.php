<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_View_Demo')) {
    class g5plusFramework_Shortcode_View_Demo
    {
        function __construct()
        {
            add_shortcode('wolverine_view_demo', array($this, 'view_demo_shortcode'));
        }

        function view_demo_shortcode($atts)
        {
	        /**
	         * Shortcode attributes
	         * @var $text
	         * @var $image
	         * @var $link
	         * @var $el_class
	         * @var $css_animation
	         * @var $duration
	         * @var $delay
	         */
	        $atts = vc_map_get_attributes( 'wolverine_view_demo', $atts );
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
            <div class="wolverine-view-demo <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <img alt="<?php echo esc_attr($text); ?>" class="demo-bg-img img-responsive" src="<?php echo esc_attr(THEME_URL) ?>/assets/images/bg-view-demo.jpg">
                <div class="demo-image">
                    <?php $img = wp_get_attachment_image_src( $image, 'full' );?>
                    <img alt="<?php echo esc_attr($text); ?>" class="img-responsive" src="<?php echo esc_url($img[0])?>"/>
                    <div class="overlay-view-demo">
                        <div class="content-middle">
                            <div class="content-middle-inner">
                                <a class="wolverine-button button-2x" href="<?php echo esc_url($a_href); ?>" target="<?php echo esc_attr($a_target); ?>"><?php echo esc_html($a_title); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
	            <?php if($text!=''):?>
                <h3><a href="<?php echo esc_url($a_href); ?>" target="<?php echo esc_attr($a_target); ?>"><?php echo esc_html($text); ?></a></h3>
	            <?php endif;?>
            </div>
            <?php
            $content = ob_get_clean();
            return $content;
        }
    }
    new g5plusFramework_Shortcode_View_Demo();
}
