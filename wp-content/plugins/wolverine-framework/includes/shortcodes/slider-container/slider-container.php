<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Slider_Container')) {
	class g5plusFramework_Shortcode_Slider_Container
	{
		function __construct()
		{
			add_shortcode('wolverine_slider_container', array($this, 'slider_container_shortcode'));
		}

		function slider_container_shortcode($atts, $content)
		{
			/**
			 * Shortcode attributes
			 * @var $navigation
			 * @var $pagination
			 * @var $singleitem
			 * @var $stoponhover
			 * @var $autoplay
			 * @var $items
			 * @var $itemsdesktop
			 * @var $itemsdesktopsmall
			 * @var $itemstablet
			 * @var $itemstabletsmall
			 * @var $itemsmobile
			 * @var $itemsscaleup
			 * @var $autoheight
			 * @var $slidespeed
			 * @var $paginationspeed
			 * @var $rewindspeed
			 * @var $el_class
			 * @var $css_animation
			 * @var $duration
			 * @var $delay
			 */
			$atts = vc_map_get_attributes( 'wolverine_slider_container', $atts );
			extract( $atts );
			$g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            $data_carousel='';

            $pagination = ($pagination == 'yes') ? 'true' : 'false';
            $navigation = ($navigation == 'yes') ? 'true' : 'false';
            $singleitem = ($singleitem == 'yes') ? 'true' : 'false';
            $stoponhover = ($stoponhover == 'yes') ? 'true' : 'false';
            $autoheight = ($autoheight == 'yes') ? 'true' : 'false';

            $data_carousel.=',"navigation":'.$navigation;
            $data_carousel.=',"pagination":'.$pagination;
            $data_carousel.=',"singleItem":'.$singleitem;
            $data_carousel.=',"stopOnHover":'.$stoponhover;
            $data_carousel.=',"autoHeight":'.$autoheight;
            if($autoplay!='')
            {
                $data_carousel.=',"autoPlay":'.$autoplay;
            }
            if($items!='')
            {
                $data_carousel.=',"items":'.$items;
            }
            if($itemsdesktop!='')
            {
                if($itemsdesktop!='false')
                {
                    $data_carousel.=',"itemsDesktop":['.$itemsdesktop.']';
                }
                else
                {
                    $data_carousel.=',"itemsDesktop":'.$itemsdesktop;
                }
            }
            if($itemsdesktopsmall!='')
            {
                if($itemsdesktopsmall!='false')
                {
                    $data_carousel.=',"itemsDesktopSmall":['.$itemsdesktopsmall.']';
                }
                else
                {
                    $data_carousel.=',"itemsDesktopSmall":'.$itemsdesktopsmall;
                }

            }
            if($itemstablet!='')
            {
                if($itemstablet!='false')
                {
                    $data_carousel.=',"itemsTablet":['.$itemstablet.']';
                }
                else
                {
                    $data_carousel.=',"itemsTablet":'.$itemstablet;
                }
            }
            if($itemstabletsmall!='')
            {
                if($itemstabletsmall!='false')
                {
                    $data_carousel.=',"itemsTabletSmall":['.$itemstabletsmall.']';
                }
                else
                {
                    $data_carousel.=',"itemsTabletSmall":'.$itemstabletsmall;
                }
            }
            if($itemsmobile!='')
            {
                if($itemsmobile!='false')
                {
                    $data_carousel.=',"itemsMobile":['.$itemsmobile.']';
                }
                else
                {
                    $data_carousel.=',"itemsMobile":'.$itemsmobile;
                }
            }
            if($itemsscaleup!='')
            {
                $data_carousel.=',"itemsScaleUp":'.$itemsscaleup;
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
            $data_carousel=substr($data_carousel,1);
            ob_start();?>
            <div data-plugin-options='{<?php echo esc_attr($data_carousel) ?>}' class="wolverine-slider-container owl-carousel <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
            <?php echo do_shortcode($content) ?>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
		}
	}
    new g5plusFramework_Shortcode_Slider_Container();
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_wolverine_slider_container extends WPBakeryShortCodesContainer {
    }
}
?>