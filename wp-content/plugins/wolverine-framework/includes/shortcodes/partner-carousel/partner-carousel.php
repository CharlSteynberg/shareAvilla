<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Partner_Carousel')) {
	class g5plusFramework_Shortcode_Partner_Carousel
	{
		function __construct()
		{
			add_shortcode('wolverine_partner_carousel', array($this, 'partner_carousel_shortcode'));
		}

        function partner_carousel_shortcode($atts)
        {
	        /**
	         * Shortcode attributes
	         * @var $images
	         * @var $opacity
	         * @var $custom_links
	         * @var $custom_links_target
	         * @var $img_size
	         * @var $column
	         * @var $autoplay
	         * @var $pagination
	         * @var $navigation
	         * @var $el_class
	         * @var $css_animation
	         * @var $duration
	         * @var $delay
	         */
	        $atts = vc_map_get_attributes( 'wolverine_partner_carousel', $atts );
	        extract( $atts );
	        $g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            if ($images == '') $images = '-1,-2,-3';

            $custom_links = explode(',', $custom_links);

            $images = explode(',', $images);
            $i = -1;

            $autoplay = ($autoplay == 'yes') ? 'true' : 'false';
            $pagination = ($pagination == 'yes') ? 'true' : 'false';
            $navigation = ($navigation == 'yes') ? 'true' : 'false';
            $data_plugin_options = 'data-plugin-options=\'{"items" : ' . esc_attr($column) . ', "autoPlay": ' . esc_attr($autoplay) . ',"pagination": ' . esc_attr($pagination) . ',"navigation": ' . esc_attr($navigation) . '}\'';
            if($opacity!='')
            {
                $opacity=' opacity'.$opacity;
            }
            ob_start();?>
            <div class="wolverine-partner-carousel<?php echo esc_attr($opacity) ?> <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <div class="owl-carousel" <?php echo wp_kses_post($data_plugin_options); ?>>
                    <?php foreach ($images as $attach_id):
                        $i++;
                        if ($attach_id > 0) {
                            $post_thumbnail = wpb_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $img_size));
                        } else {
                            $post_thumbnail = array();
                            $post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url('vc/no_image.png') . '" />';
                            $post_thumbnail['p_img_large'][0] = vc_asset_url('vc/no_image.png');
                        }
                        $thumbnail = $post_thumbnail['thumbnail'];
                        if (isset($custom_links[$i]) && $custom_links[$i] != ''):?>
                            <div class="content-middle-inner">
                                <a href="<?php echo esc_url($custom_links[$i]) ?>" target="<?php echo esc_attr($custom_links_target) ?>">
                                    <?php echo wp_kses_post($thumbnail) ?>
                                </a>
                            </div>
                        <?php else:?>
                            <div class="content-middle-inner"><?php echo wp_kses_post($thumbnail) ?></div>
                        <?php endif;
                    endforeach;?>
                </div>
            </div>
            <?php
            $content = ob_get_clean();
            return $content;
        }
	}
    new g5plusFramework_Shortcode_Partner_Carousel();
}