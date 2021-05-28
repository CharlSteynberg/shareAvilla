<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Cover_Box')) {
    class g5plusFramework_Shortcode_Cover_Box
    {
        function __construct()
        {
            add_shortcode('wolverine_cover_box_ctn', array($this, 'cover_box_ctn_shortcode'));
            add_shortcode('wolverine_cover_box_sc', array($this, 'cover_box_sc_shortcode'));
        }
        function cover_box_ctn_shortcode($atts, $content)
        {
	        /**
	         * Shortcode attributes
	         * @var $active_index
	         * @var $el_class
	         * @var $css_animation
	         * @var $duration
	         * @var $delay
	         */
	        $atts = vc_map_get_attributes( 'wolverine_cover_box_ctn', $atts );
	        extract( $atts );
	        $opt_enable_minifile_js = g5plus_framework_get_option('enable_minifile_js','0');
	        $min_suffix = ($opt_enable_minifile_js == 1) ? '.min' :  '';
	        wp_enqueue_script('wolverine_cover_box',plugins_url('wolverine-framework/includes/shortcodes/cover-box/assets/js/cover-box' . $min_suffix . '.js'),array(),false, true);
	        $g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            ob_start();?>
            <div data-act="<?php echo esc_attr($active_index) ?>" class="wolverine-cover-box <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <div class="row">
                    <?php echo do_shortcode($content); ?>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }
        function cover_box_sc_shortcode($atts,$content = nul)
        {
	        /**
	         * Shortcode attributes
	         * @var $image
	         * @var $sub_title
	         * @var $title
	         * @var $link
	         */
	        $atts = vc_map_get_attributes( 'wolverine_cover_box_sc', $atts );
	        extract( $atts );
            //parse link
            $link = ( $link == '||' ) ? '' : $link;
            $link = vc_build_link( $link );

	        $a_title='';
	        $a_target='_self';
	        $a_href='#';

            if ( strlen( $link['url'] ) > 0 ) {
                $a_href = $link['url'];
                $a_title = $link['title'];
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            ob_start();?>
            <div class="box-item box-image">
                <a title="<?php echo esc_attr($a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" href="<?php echo  esc_url($a_href) ?>">
                    <?php $img_id = preg_replace( '/[^\d]/', '', $image );
                    $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '370x247') );
                    echo wp_kses_post($img['thumbnail']);?>
                </a>
            </div>
            <div class="box-item box-content">
	            <div class="box-content-inner">
		            <?php if($sub_title!=''):?>
	                <h5><?php echo esc_html($sub_title) ?></h5>
		            <?php endif;
		            if($title!=''):?>
	                <h4><?php echo esc_html($title) ?></h4>
		            <?php endif;?>
	                <p><?php echo wp_strip_all_tags($content) ?></p>
		            <?php if($a_title!=''):?>
	                <a class="wolverine-button style1 button-1x" title="<?php echo esc_attr($a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" href="<?php echo  esc_url($a_href) ?>"><?php echo esc_html($a_title) ?></a>
		            <?php endif;?>
	            </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }
    }
    new g5plusFramework_Shortcode_Cover_Box();
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_wolverine_cover_box_ctn extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_wolverine_cover_box_sc extends WPBakeryShortCode {
    }
}