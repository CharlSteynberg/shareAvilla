<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Testimonial')) {
    class g5plusFramework_Shortcode_Testimonial
    {
        function __construct()
        {
            add_shortcode('wolverine_testimonial_ctn', array($this, 'testimonial_ctn_shortcode'));
            add_shortcode('wolverine_testimonial_sc', array($this, 'testimonial_sc_shortcode'));
        }
        protected $layoutstyle = '';
        function testimonial_ctn_shortcode($atts, $content)
        {
	        /**
	         * Shortcode attributes
	         * @var $layout_style
	         * @var $color_scheme
	         * @var $title
	         * @var $navigation
	         * @var $stoponhover
	         * @var $autoplay
	         * @var $autoheight
	         * @var $slidespeed
	         * @var $paginationspeed
	         * @var $rewindspeed
	         * @var $el_class
	         * @var $css_animation
	         * @var $duration
	         * @var $delay
	         */
	        $atts = vc_map_get_attributes( 'wolverine_testimonial_ctn', $atts );
	        extract( $atts );
	        $g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);

            $this->layout_style=$layout_style;
            $data_carousel='"singleItem":true, "pagination":false';
            $navigation = ($navigation == 'yes') ? 'true' : 'false';
            $stoponhover = ($stoponhover == 'yes') ? 'true' : 'false';
            $autoheight = ($autoheight == 'yes') ? 'true' : 'false';

            $data_carousel.=',"navigation":'.$navigation;
            $data_carousel.=',"stopOnHover":'.$stoponhover;
            $data_carousel.=',"autoHeight":'.$autoheight;
            if($autoplay!='')
            {
                $data_carousel.=',"autoPlay":'.$autoplay;
            }
            if($slidespeed!='')
            {
                $data_carousel.=',"slideSpeed":'.$slidespeed;
            }
            if($paginationspeed!='')
            {
                $data_carousel.=',"paginationSpeed":'.$paginationspeed;
            }
            if($rewindspeed!='')
            {
                $data_carousel.=',"rewindSpeed":'.$rewindspeed;
            }
            ob_start();?>
            <div class="wolverine-testimonial <?php echo esc_attr($layout_style) ?> <?php echo esc_attr($color_scheme) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <?php if($title!=''):?>
                <h3><?php echo esc_html($title) ?></h3>
                <?php endif;?>
                <div data-plugin-options='{<?php echo esc_attr($data_carousel) ?>}' class="owl-carousel">
                    <?php echo do_shortcode($content); ?>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }
        function testimonial_sc_shortcode($atts,$content = nul)
        {
            $author=$image='';
            extract(shortcode_atts(array(
                'image'            => '',
                'author'           => ''
            ), $atts));
            $layout_style=$this->layout_style;
            ob_start();?>
            <div class="testimonial-item">
                <?php if($layout_style=='style1'):?>
                    <p><?php echo wp_kses_post($content) ?></p>
	                <?php if($author!=''):?>
                    <span><?php echo esc_html($author) ?></span>
	                <?php endif;?>
                <?php else:?>
                    <div class="testimonial-avatar">
                        <?php $img_id = preg_replace( '/[^\d]/', '', $image );
                        if($layout_style=='style4')
                        {
	                        $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '270x385'  ) );
                        }
                        else
                        {
	                        $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '170'  ) );
                        }
                        echo wp_kses_post($img['thumbnail']);
                        ?>
                    </div>
                    <div class="testimonial-info">
                        <p><?php echo wp_strip_all_tags($content) ?></p>
	                    <?php if($author!=''):?>
                        <span><?php echo esc_html($author) ?></span>
		                <?php endif;?>
                    </div>
                <?php endif;?>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }
    }
    new g5plusFramework_Shortcode_Testimonial();
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_wolverine_testimonial_ctn extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_wolverine_testimonial_sc extends WPBakeryShortCode {
    }
}