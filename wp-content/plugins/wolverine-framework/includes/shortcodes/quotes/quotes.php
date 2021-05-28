<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Quotes')) {
    class g5plusFramework_Shortcode_Quotes
    {
        function __construct()
        {
            add_shortcode('wolverine_quotes_ctn', array($this, 'quotes_ctn_shortcode'));
            add_shortcode('wolverine_quotes_sc', array($this, 'quotes_sc_shortcode'));
        }
        protected $layoutstyle = '';
        function quotes_ctn_shortcode($atts, $content)
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
	        $iconClass='';
	        $atts = vc_map_get_attributes( 'wolverine_quotes_ctn', $atts );
	        extract( $atts );
	        $g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);

            $this->layoutstyle=$layout_style;
            if($icon_type!='' && $icon_type!='image')
            {
                vc_icon_element_fonts_enqueue( $icon_type );
                $iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-quote-right';
            }
            $data_carousel='"singleItem":true, "pagination":false, "navigation": false';
            $stoponhover = ($stoponhover == 'yes') ? 'true' : 'false';
            $autoheight = ($autoheight == 'yes') ? 'true' : 'false';

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
            <div class="wolverine-quotes <?php echo esc_attr($layout_style) ?> <?php echo esc_attr($color_scheme) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <div class="container">
                    <?php if($layout_style=='style1'):?>
                        <div class="quotes-slider-wapper">
                            <div data-plugin-options='{<?php echo esc_attr($data_carousel) ?>}' class="owl-carousel">
                                <?php echo do_shortcode($content); ?>
                            </div>
                            <div class="quotes-icon">
                                <?php if ( $icon_type != '' ) :
                                    if ( $icon_type == 'image' ) :
                                        $img = wp_get_attachment_image_src( $icon_image, 'full' );?>
                                        <img src="<?php echo esc_url($img[0])?>"/>
                                    <?php else :?>
                                        <i class="<?php echo esc_attr($iconClass) ?>"></i>
                                    <?php endif;
                                endif;?>
                            </div>
                        </div>
                    <?php else:?>
                        <div class="row quotes-slider">
                            <a class="custom-owl-prev"><i class="fa fa-angle-left"></i></a>
                            <a class="custom-owl-next"><i class="fa fa-angle-right"></i></a>
                            <div class="col-lg-2 col-lg-offset-1 hidden-md hidden-sm hidden-xs">
                                <div class="quotes-icon">
                                    <?php if ( $icon_type != '' ) :
                                        if ( $icon_type == 'image' ) :
                                            $img = wp_get_attachment_image_src( $icon_image, 'full' );?>
                                            <img src="<?php echo esc_url($img[0])?>"/>
                                        <?php else :?>
                                            <i class="<?php echo esc_attr($iconClass) ?>"></i>
                                        <?php endif;
                                    endif;?>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-12 col-sm-12 quotes-slider">
                                <div data-plugin-options='{<?php echo esc_attr($data_carousel) ?>}' class="owl-carousel">
                                    <?php echo do_shortcode($content); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }
        function quotes_sc_shortcode($atts,$content = nul)
        {
            $author='';
            extract(shortcode_atts(array(
                'author'           => ''
            ), $atts));
            $layout_style=$this->layoutstyle;
            ob_start();
            if($layout_style=='style1'):?>
            <p><?php echo wp_kses_post($content); ?></p>
            <?php else:?>
                <div class="quotes-item">
                    <p><?php echo wp_strip_all_tags($content); ?></p>
	                <?php if($author!=''):?>
                    <span><?php echo esc_html($author); ?></span>
	                <?php endif;?>
                </div>
            <?php endif;
            $output = ob_get_clean();
            return $output;
        }
    }
    new g5plusFramework_Shortcode_Quotes();
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_wolverine_quotes_ctn extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_wolverine_quotes_sc extends WPBakeryShortCode {
    }
}