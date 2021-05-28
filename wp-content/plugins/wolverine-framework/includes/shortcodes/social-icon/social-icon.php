<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 8/17/15
 * Time: 11:37 AM
 */

// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Social_Icon')) {
    class g5plusFramework_Shortcode_Social_Icon
    {
        function __construct()
        {
            add_shortcode('g5plusframework_social_icon', array($this, 'social_icon_shortcode'));
        }
        function social_icon_shortcode($atts)
        {
            $layout_type = $social_icons = $html = $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type' => 'icon',
                'social_icons' => '',
                'el_class' => '',
                'css_animation' => '',
                'duration' => '',
                'delay' => ''
            ), $atts));
            $g5plus_animation .= ' ' . esc_attr($el_class);
            $g5plus_animation .= g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            $arr_icon = explode(',',$social_icons);
            ob_start();
            ?>
            <div class="social  <?php echo esc_attr($layout_type) ?> <?php echo esc_attr($g5plus_animation) ?> <?php echo esc_attr($el_class) ?>">
                <?php
                    for($i=0;$i < count($arr_icon);$i++){
                        $url = g5plus_framework_get_option($arr_icon[$i],'#');
                        $social_info = g5plusFramework_Shortcode_Social_Icon::get_social_icon($arr_icon[$i]);
                    ?>
                        <a href="<?php echo esc_url($url) ?>" target="_blank">
                                <i class="<?php echo esc_attr($social_info['icon']) ?>"></i>
                            <?php if($layout_type==='icon-text'){ ?>
                                <span class="secondary-font"><?php echo wp_kses_post($social_info['title'])?></span>
                            <?php } ?>
                        </a>
                    <?php }?>
            </div>
            <?php
            $ret = ob_get_clean();
            return $ret;
        }

        public static function get_social_icon($social)
        {
            switch ($social)
            {
                case 'facebook_url':{
                    return array(
                        'icon' => 'fa fa-facebook',
                        'title' => 'Facebook'
                    );
                }
                case 'twitter_url':{
                    return array(
                        'icon' => 'fa fa-twitter',
                        'title' => 'Twitter'
                    );
                }
                case 'dribbble_url':{
                    return array(
                        'icon' => 'fa fa-dribbble',
                        'title' => 'Dribble'
                    );
                }
                case 'vimeo_url':{
                    return
                        array(
                            'icon' => 'fa fa-vimeo-square',
                            'title' => 'Vimeo'
                        );

                }
                case 'pinterest_url':{
                    return array(
                        'icon' => 'fa fa-pinterest-p',
                        'title' => 'Pinterest'
                    );
                }
                case 'googleplus_url':{
                    return array(
                        'icon' => 'fa fa-google-plus',
                        'title' => 'Google+')
                        ;
                }
                case 'linkedin_url':{
                    return array(
                        'icon' => 'fa fa-linkedin',
                        'title' => 'Linkin');
                }
                case 'youtube_url':{
                    return array(
                        'icon' => 'fa fa-youtube',
                        'title' => 'Youtube');
                }
                case 'instagram_url':{
                    return array(
                        'icon' => 'fa fa-instagram',
                        'title' => 'Instagram');
                }
            }
	        return array(
		        'icon' => 'fa fa-facebook',
		        'title' => 'Facebook'
	        );
        }
    }
    new g5plusFramework_Shortcode_Social_Icon();
}