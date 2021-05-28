<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/28/2015
 * Time: 5:44 PM
 */
if (!class_exists('g5plusFramework_Shortcodes')) {
    class g5plusFramework_Shortcodes
    {

        private static $instance;

        public static function init()
        {
            if (!isset(self::$instance)) {
                self::$instance = new g5plusFramework_Shortcodes;
                add_action('init', array(self::$instance, 'includes'), 0);
                add_action('init', array(self::$instance, 'register_vc_map'), 10);
            }
            return self::$instance;
        }

        public function includes()
        {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
            if (!is_plugin_active('js_composer/js_composer.php')) {
                return;
            }
            $cpt_disable = g5plus_framework_get_option('cpt-disable');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/slider-container/slider-container.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/heading/heading.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/button/button.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/vertical-progress-bar/vertical-progress-bar.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/icon-box/icon-box.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/image-box/image-box.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/feature/feature.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/icon-separator/icon-separator.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/partner-carousel/partner-carousel.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/post/post.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/call-action/call-action.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/counter/counter.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/testimonial/testimonial.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/quotes/quotes.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/our-commitment/our-commitment.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/banner/banner.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/cover-box/cover-box.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/event-time/event-time.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/view-demo/view-demo.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/social-icon/social-icon.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/navigation-fullpage/navigation-fullpage.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/google-map/google-map.php');

            if ( !is_array($cpt_disable) || (array_key_exists('ourteam', $cpt_disable) && ($cpt_disable['ourteam'] == '0' || $cpt_disable['ourteam'] == ''))) {
                include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/ourteam/ourteam.php');
            }
            if (!is_array($cpt_disable)  || (array_key_exists('pricingtable', $cpt_disable) && ($cpt_disable['pricingtable'] == '0' || $cpt_disable['pricingtable'] == ''))) {
                include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/pricingtable/pricingtable.php');
            }
            if (!is_array($cpt_disable) || (array_key_exists('portfolio', $cpt_disable) && ($cpt_disable['portfolio'] == '0' || $cpt_disable['portfolio'] == ''))) {
                include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/portfolio/portfolio.php');
            }

            if (!is_array($cpt_disable) || (array_key_exists('food', $cpt_disable) && ($cpt_disable['food'] == '0' || $cpt_disable['food'] == ''))) {
                include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/food/food.php');
            }

            if (!is_array($cpt_disable) || (array_key_exists('gallery', $cpt_disable) && ($cpt_disable['gallery'] == '0' || $cpt_disable['gallery'] == ''))) {
                include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/gallery/gallery.php');
            }

            if (!is_array($cpt_disable) || (array_key_exists('countdown', $cpt_disable) && ($cpt_disable['countdown'] == '0' || $cpt_disable['countdown'] == ''))) {
                include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/countdown/countdown.php');
            }

            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/product/product.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/product/product-categories.php');
            include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/blog/blog.php');
        }

        public static function g5plus_get_css_animation($css_animation)
        {
            $output = '';
            if ($css_animation != '') {
                wp_enqueue_script('vc_waypoints');
                $output = ' wpb_animate_when_almost_visible g5plus-css-animation ' . $css_animation;
            }
            return $output;
        }

        public static function g5plus_get_style_animation($duration, $delay)
        {
            $styles = array();
            if ($duration != '0' && !empty($duration)) {
                $duration = (float)trim($duration, "\n\ts");
                $styles[] = "-webkit-animation-duration: {$duration}s";
                $styles[] = "-moz-animation-duration: {$duration}s";
                $styles[] = "-ms-animation-duration: {$duration}s";
                $styles[] = "-o-animation-duration: {$duration}s";
                $styles[] = "animation-duration: {$duration}s";
            }
            if ($delay != '0' && !empty($delay)) {
                $delay = (float)trim($delay, "\n\ts");
                $styles[] = "opacity: 0";
                $styles[] = "-webkit-animation-delay: {$delay}s";
                $styles[] = "-moz-animation-delay: {$delay}s";
                $styles[] = "-ms-animation-delay: {$delay}s";
                $styles[] = "-o-animation-delay: {$delay}s";
                $styles[] = "animation-delay: {$delay}s";
            }
            if (count($styles) > 1) {
                return 'style="' . implode(';', $styles) . '"';
            }
            return implode(';', $styles);
        }

        public static function  substr($str, $txt_len, $end_txt = '...')
        {
            if (empty($str)) return '';
            if (strlen($str) <= $txt_len) return $str;

            $i = $txt_len;
            while ($str[$i] != ' ') {
                $i--;
                if ($i == -1) break;
            }
            while ($str[$i] == ' ') {
                $i--;
                if ($i == -1) break;
            }

            return substr($str, 0, $i + 1) . $end_txt;
        }


        public function register_vc_map()
        {

            $cpt_disable = g5plus_framework_get_option('cpt-disable');

            if (function_exists('vc_map')) {
                $add_css_animation = array(
                    'type' => 'dropdown',
                    'heading' => __('CSS Animation', 'wolverine'),
                    'param_name' => 'css_animation',
                    'value' => array(__('No', 'wolverine') => '', __('Fade In', 'wolverine') => 'wpb_fadeIn', __('Fade Top to Bottom', 'wolverine') => 'wpb_fadeInDown', __('Fade Bottom to Top', 'wolverine') => 'wpb_fadeInUp', __('Fade Left to Right', 'wolverine') => 'wpb_fadeInLeft', __('Fade Right to Left', 'wolverine') => 'wpb_fadeInRight', __('Bounce In', 'wolverine') => 'wpb_bounceIn', __('Bounce Top to Bottom', 'wolverine') => 'wpb_bounceInDown', __('Bounce Bottom to Top', 'wolverine') => 'wpb_bounceInUp', __('Bounce Left to Right', 'wolverine') => 'wpb_bounceInLeft', __('Bounce Right to Left', 'wolverine') => 'wpb_bounceInRight', __('Zoom In', 'wolverine') => 'wpb_zoomIn', __('Flip Vertical', 'wolverine') => 'wpb_flipInX', __('Flip Horizontal', 'wolverine') => 'wpb_flipInY', __('Bounce', 'wolverine') => 'wpb_bounce', __('Flash', 'wolverine') => 'wpb_flash', __('Shake', 'wolverine') => 'wpb_shake', __('Pulse', 'wolverine') => 'wpb_pulse', __('Swing', 'wolverine') => 'wpb_swing', __('Rubber band', 'wolverine') => 'wpb_rubberBand', __('Wobble', 'wolverine') => 'wpb_wobble', __('Tada', 'wolverine') => 'wpb_tada'),
                    'description' => __('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'wolverine'),
                    'group' => __('Animation Settings', 'wolverine')
                );

                $add_duration_animation = array(
                    'type' => 'textfield',
                    'heading' => __('Animation Duration', 'wolverine'),
                    'param_name' => 'duration',
                    'value' => '',
                    'description' => __('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'wolverine'),
                    'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
                    'group' => __('Animation Settings', 'wolverine')
                );

                $add_delay_animation = array(
                    'type' => 'textfield',
                    'heading' => __('Animation Delay', 'wolverine'),
                    'param_name' => 'delay',
                    'value' => '',
                    'description' => __('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'wolverine'),
                    'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
                    'group' => __('Animation Settings', 'wolverine')
                );

                $add_el_class = array(
                    'type' => 'textfield',
                    'heading' => __('Extra class name', 'wolverine'),
                    'param_name' => 'el_class',
                    'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wolverine'),
                );
                $custom_colors = array(
                    __( 'Informational', 'wolverine' ) => 'info',
                    __( 'Warning', 'wolverine' ) => 'warning',
                    __( 'Success', 'wolverine' ) => 'success',
                    __( 'Error', 'wolverine' ) => "danger",
                    __( 'Informational Classic', 'wolverine' ) => 'alert-info',
                    __( 'Warning Classic', 'wolverine' ) => 'alert-warning',
                    __( 'Success Classic', 'wolverine' ) => 'alert-success',
                    __( 'Error Classic', 'wolverine' ) => "alert-danger",
                );
                $target_arr = array(
                    __('Same window', 'wolverine') => '_self',
                    __('New window', 'wolverine') => '_blank'
                );
                $wolverine_icons = array(
                    array('wicon icon-outline-vector-icons-pack-1' => 'icon-outline-vector-icons-pack-1'),array('wicon icon-outline-vector-icons-pack-2' => 'icon-outline-vector-icons-pack-2'),array('wicon icon-outline-vector-icons-pack-3' => 'icon-outline-vector-icons-pack-3'),array('wicon icon-outline-vector-icons-pack-4' => 'icon-outline-vector-icons-pack-4'),array('wicon icon-outline-vector-icons-pack-5' => 'icon-outline-vector-icons-pack-5'),array('wicon icon-outline-vector-icons-pack-6' => 'icon-outline-vector-icons-pack-6'),array('wicon icon-outline-vector-icons-pack-7' => 'icon-outline-vector-icons-pack-7'),array('wicon icon-outline-vector-icons-pack-14' => 'icon-outline-vector-icons-pack-14'),array('wicon icon-outline-vector-icons-pack-15' => 'icon-outline-vector-icons-pack-15'),array('wicon icon-outline-vector-icons-pack-16' => 'icon-outline-vector-icons-pack-16'),array('wicon icon-outline-vector-icons-pack-17' => 'icon-outline-vector-icons-pack-17'),array('wicon icon-outline-vector-icons-pack-18' => 'icon-outline-vector-icons-pack-18'),array('wicon icon-outline-vector-icons-pack-19' => 'icon-outline-vector-icons-pack-19'),array('wicon icon-outline-vector-icons-pack-20' => 'icon-outline-vector-icons-pack-20'),array('wicon icon-outline-vector-icons-pack-27' => 'icon-outline-vector-icons-pack-27'),array('wicon icon-outline-vector-icons-pack-28' => 'icon-outline-vector-icons-pack-28'),array('wicon icon-outline-vector-icons-pack-29' => 'icon-outline-vector-icons-pack-29'),array('wicon icon-outline-vector-icons-pack-30' => 'icon-outline-vector-icons-pack-30'),array('wicon icon-outline-vector-icons-pack-31' => 'icon-outline-vector-icons-pack-31'),array('wicon icon-outline-vector-icons-pack-32' => 'icon-outline-vector-icons-pack-32'),array('wicon icon-outline-vector-icons-pack-33' => 'icon-outline-vector-icons-pack-33'),array('wicon icon-outline-vector-icons-pack-40' => 'icon-outline-vector-icons-pack-40'),array('wicon icon-outline-vector-icons-pack-41' => 'icon-outline-vector-icons-pack-41'),array('wicon icon-outline-vector-icons-pack-42' => 'icon-outline-vector-icons-pack-42'),array('wicon icon-outline-vector-icons-pack-43' => 'icon-outline-vector-icons-pack-43'),array('wicon icon-outline-vector-icons-pack-44' => 'icon-outline-vector-icons-pack-44'),array('wicon icon-outline-vector-icons-pack-45' => 'icon-outline-vector-icons-pack-45'),array('wicon icon-outline-vector-icons-pack-46' => 'icon-outline-vector-icons-pack-46'),array('wicon icon-outline-vector-icons-pack-53' => 'icon-outline-vector-icons-pack-53'),array('wicon icon-outline-vector-icons-pack-54' => 'icon-outline-vector-icons-pack-54'),array('wicon icon-outline-vector-icons-pack-55' => 'icon-outline-vector-icons-pack-55'),array('wicon icon-outline-vector-icons-pack-56' => 'icon-outline-vector-icons-pack-56'),array('wicon icon-outline-vector-icons-pack-57' => 'icon-outline-vector-icons-pack-57'),array('wicon icon-outline-vector-icons-pack-58' => 'icon-outline-vector-icons-pack-58'),array('wicon icon-outline-vector-icons-pack-59' => 'icon-outline-vector-icons-pack-59'),array('wicon icon-outline-vector-icons-pack-66' => 'icon-outline-vector-icons-pack-66'),array('wicon icon-outline-vector-icons-pack-67' => 'icon-outline-vector-icons-pack-67'),array('wicon icon-outline-vector-icons-pack-68' => 'icon-outline-vector-icons-pack-68'),array('wicon icon-outline-vector-icons-pack-69' => 'icon-outline-vector-icons-pack-69'),array('wicon icon-outline-vector-icons-pack-70' => 'icon-outline-vector-icons-pack-70'),array('wicon icon-outline-vector-icons-pack-71' => 'icon-outline-vector-icons-pack-71'),array('wicon icon-outline-vector-icons-pack-72' => 'icon-outline-vector-icons-pack-72'),array('wicon icon-outline-vector-icons-pack-79' => 'icon-outline-vector-icons-pack-79'),array('wicon icon-outline-vector-icons-pack-80' => 'icon-outline-vector-icons-pack-80'),array('wicon icon-outline-vector-icons-pack-81' => 'icon-outline-vector-icons-pack-81'),array('wicon icon-outline-vector-icons-pack-82' => 'icon-outline-vector-icons-pack-82'),array('wicon icon-outline-vector-icons-pack-83' => 'icon-outline-vector-icons-pack-83'),array('wicon icon-outline-vector-icons-pack-84' => 'icon-outline-vector-icons-pack-84'),array('wicon icon-outline-vector-icons-pack-85' => 'icon-outline-vector-icons-pack-85'),array('wicon icon-outline-vector-icons-pack-92' => 'icon-outline-vector-icons-pack-92'),array('wicon icon-outline-vector-icons-pack-93' => 'icon-outline-vector-icons-pack-93'),array('wicon icon-outline-vector-icons-pack-94' => 'icon-outline-vector-icons-pack-94'),array('wicon icon-outline-vector-icons-pack-95' => 'icon-outline-vector-icons-pack-95'),array('wicon icon-outline-vector-icons-pack-96' => 'icon-outline-vector-icons-pack-96'),array('wicon icon-outline-vector-icons-pack-97' => 'icon-outline-vector-icons-pack-97'),array('wicon icon-outline-vector-icons-pack-98' => 'icon-outline-vector-icons-pack-98'),array('wicon icon-outline-vector-icons-pack-105' => 'icon-outline-vector-icons-pack-105'),array('wicon icon-outline-vector-icons-pack-106' => 'icon-outline-vector-icons-pack-106'),array('wicon icon-outline-vector-icons-pack-107' => 'icon-outline-vector-icons-pack-107'),array('wicon icon-outline-vector-icons-pack-108' => 'icon-outline-vector-icons-pack-108'),array('wicon icon-outline-vector-icons-pack-109' => 'icon-outline-vector-icons-pack-109'),array('wicon icon-outline-vector-icons-pack-110' => 'icon-outline-vector-icons-pack-110'),array('wicon icon-outline-vector-icons-pack-111' => 'icon-outline-vector-icons-pack-111'),array('wicon icon-outline-vector-icons-pack-118' => 'icon-outline-vector-icons-pack-118'),array('wicon icon-outline-vector-icons-pack-119' => 'icon-outline-vector-icons-pack-119'),array('wicon icon-outline-vector-icons-pack-120' => 'icon-outline-vector-icons-pack-120'),array('wicon icon-outline-vector-icons-pack-121' => 'icon-outline-vector-icons-pack-121'),array('wicon icon-outline-vector-icons-pack-122' => 'icon-outline-vector-icons-pack-122'),array('wicon icon-outline-vector-icons-pack-123' => 'icon-outline-vector-icons-pack-123'),array('wicon icon-outline-vector-icons-pack-124' => 'icon-outline-vector-icons-pack-124'),array('wicon icon-outline-vector-icons-pack-131' => 'icon-outline-vector-icons-pack-131'),array('wicon icon-outline-vector-icons-pack-132' => 'icon-outline-vector-icons-pack-132'),array('wicon icon-outline-vector-icons-pack-133' => 'icon-outline-vector-icons-pack-133'),array('wicon icon-outline-vector-icons-pack-134' => 'icon-outline-vector-icons-pack-134'),array('wicon icon-outline-vector-icons-pack-135' => 'icon-outline-vector-icons-pack-135'),array('wicon icon-outline-vector-icons-pack-136' => 'icon-outline-vector-icons-pack-136'),array('wicon icon-outline-vector-icons-pack-137' => 'icon-outline-vector-icons-pack-137'),array('wicon icon-outline-vector-icons-pack-144' => 'icon-outline-vector-icons-pack-144'),array('wicon icon-outline-vector-icons-pack-145' => 'icon-outline-vector-icons-pack-145'),array('wicon icon-outline-vector-icons-pack-146' => 'icon-outline-vector-icons-pack-146'),array('wicon icon-outline-vector-icons-pack-147' => 'icon-outline-vector-icons-pack-147'),array('wicon icon-outline-vector-icons-pack-148' => 'icon-outline-vector-icons-pack-148'),array('wicon icon-outline-vector-icons-pack-149' => 'icon-outline-vector-icons-pack-149'),array('wicon icon-outline-vector-icons-pack-150' => 'icon-outline-vector-icons-pack-150'),array('wicon icon-outline-vector-icons-pack-157' => 'icon-outline-vector-icons-pack-157'),array('wicon icon-outline-vector-icons-pack-158' => 'icon-outline-vector-icons-pack-158'),array('wicon icon-outline-vector-icons-pack-159' => 'icon-outline-vector-icons-pack-159'),array('wicon icon-outline-vector-icons-pack-160' => 'icon-outline-vector-icons-pack-160'),array('wicon icon-outline-vector-icons-pack-161' => 'icon-outline-vector-icons-pack-161'),array('wicon icon-outline-vector-icons-pack-162' => 'icon-outline-vector-icons-pack-162'),array('wicon icon-outline-vector-icons-pack-163' => 'icon-outline-vector-icons-pack-163'),array('wicon icon-outline-vector-icons-pack-8' => 'icon-outline-vector-icons-pack-8'),array('wicon icon-outline-vector-icons-pack-9' => 'icon-outline-vector-icons-pack-9'),array('wicon icon-outline-vector-icons-pack-10' => 'icon-outline-vector-icons-pack-10'),array('wicon icon-outline-vector-icons-pack-11' => 'icon-outline-vector-icons-pack-11'),array('wicon icon-outline-vector-icons-pack-12' => 'icon-outline-vector-icons-pack-12'),array('wicon icon-outline-vector-icons-pack-13' => 'icon-outline-vector-icons-pack-13'),array('wicon icon-outline-vector-icons-pack-21' => 'icon-outline-vector-icons-pack-21'),array('wicon icon-outline-vector-icons-pack-22' => 'icon-outline-vector-icons-pack-22'),array('wicon icon-outline-vector-icons-pack-23' => 'icon-outline-vector-icons-pack-23'),array('wicon icon-outline-vector-icons-pack-24' => 'icon-outline-vector-icons-pack-24'),array('wicon icon-outline-vector-icons-pack-25' => 'icon-outline-vector-icons-pack-25'),array('wicon icon-outline-vector-icons-pack-26' => 'icon-outline-vector-icons-pack-26'),array('wicon icon-outline-vector-icons-pack-34' => 'icon-outline-vector-icons-pack-34'),array('wicon icon-outline-vector-icons-pack-35' => 'icon-outline-vector-icons-pack-35'),array('wicon icon-outline-vector-icons-pack-36' => 'icon-outline-vector-icons-pack-36'),array('wicon icon-outline-vector-icons-pack-37' => 'icon-outline-vector-icons-pack-37'),array('wicon icon-outline-vector-icons-pack-38' => 'icon-outline-vector-icons-pack-38'),array('wicon icon-outline-vector-icons-pack-39' => 'icon-outline-vector-icons-pack-39'),array('wicon icon-outline-vector-icons-pack-47' => 'icon-outline-vector-icons-pack-47'),array('wicon icon-outline-vector-icons-pack-48' => 'icon-outline-vector-icons-pack-48'),array('wicon icon-outline-vector-icons-pack-49' => 'icon-outline-vector-icons-pack-49'),array('wicon icon-outline-vector-icons-pack-50' => 'icon-outline-vector-icons-pack-50'),array('wicon icon-outline-vector-icons-pack-51' => 'icon-outline-vector-icons-pack-51'),array('wicon icon-outline-vector-icons-pack-52' => 'icon-outline-vector-icons-pack-52'),array('wicon icon-outline-vector-icons-pack-60' => 'icon-outline-vector-icons-pack-60'),array('wicon icon-outline-vector-icons-pack-61' => 'icon-outline-vector-icons-pack-61'),array('wicon icon-outline-vector-icons-pack-62' => 'icon-outline-vector-icons-pack-62'),array('wicon icon-outline-vector-icons-pack-63' => 'icon-outline-vector-icons-pack-63'),array('wicon icon-outline-vector-icons-pack-64' => 'icon-outline-vector-icons-pack-64'),array('wicon icon-outline-vector-icons-pack-65' => 'icon-outline-vector-icons-pack-65'),array('wicon icon-outline-vector-icons-pack-73' => 'icon-outline-vector-icons-pack-73'),array('wicon icon-outline-vector-icons-pack-74' => 'icon-outline-vector-icons-pack-74'),array('wicon icon-outline-vector-icons-pack-75' => 'icon-outline-vector-icons-pack-75'),array('wicon icon-outline-vector-icons-pack-76' => 'icon-outline-vector-icons-pack-76'),array('wicon icon-outline-vector-icons-pack-77' => 'icon-outline-vector-icons-pack-77'),array('wicon icon-outline-vector-icons-pack-78' => 'icon-outline-vector-icons-pack-78'),array('wicon icon-outline-vector-icons-pack-86' => 'icon-outline-vector-icons-pack-86'),array('wicon icon-outline-vector-icons-pack-87' => 'icon-outline-vector-icons-pack-87'),array('wicon icon-outline-vector-icons-pack-88' => 'icon-outline-vector-icons-pack-88'),array('wicon icon-outline-vector-icons-pack-89' => 'icon-outline-vector-icons-pack-89'),array('wicon icon-outline-vector-icons-pack-90' => 'icon-outline-vector-icons-pack-90'),array('wicon icon-outline-vector-icons-pack-91' => 'icon-outline-vector-icons-pack-91'),array('wicon icon-outline-vector-icons-pack-99' => 'icon-outline-vector-icons-pack-99'),array('wicon icon-outline-vector-icons-pack-100' => 'icon-outline-vector-icons-pack-100'),array('wicon icon-outline-vector-icons-pack-101' => 'icon-outline-vector-icons-pack-101'),array('wicon icon-outline-vector-icons-pack-102' => 'icon-outline-vector-icons-pack-102'),array('wicon icon-outline-vector-icons-pack-103' => 'icon-outline-vector-icons-pack-103'),array('wicon icon-outline-vector-icons-pack-104' => 'icon-outline-vector-icons-pack-104'),array('wicon icon-outline-vector-icons-pack-112' => 'icon-outline-vector-icons-pack-112'),array('wicon icon-outline-vector-icons-pack-113' => 'icon-outline-vector-icons-pack-113'),array('wicon icon-outline-vector-icons-pack-114' => 'icon-outline-vector-icons-pack-114'),array('wicon icon-outline-vector-icons-pack-115' => 'icon-outline-vector-icons-pack-115'),array('wicon icon-outline-vector-icons-pack-116' => 'icon-outline-vector-icons-pack-116'),array('wicon icon-outline-vector-icons-pack-117' => 'icon-outline-vector-icons-pack-117'),array('wicon icon-outline-vector-icons-pack-125' => 'icon-outline-vector-icons-pack-125'),array('wicon icon-outline-vector-icons-pack-126' => 'icon-outline-vector-icons-pack-126'),array('wicon icon-outline-vector-icons-pack-127' => 'icon-outline-vector-icons-pack-127'),array('wicon icon-outline-vector-icons-pack-128' => 'icon-outline-vector-icons-pack-128'),array('wicon icon-outline-vector-icons-pack-129' => 'icon-outline-vector-icons-pack-129'),array('wicon icon-outline-vector-icons-pack-130' => 'icon-outline-vector-icons-pack-130'),array('wicon icon-outline-vector-icons-pack-138' => 'icon-outline-vector-icons-pack-138'),array('wicon icon-outline-vector-icons-pack-139' => 'icon-outline-vector-icons-pack-139'),array('wicon icon-outline-vector-icons-pack-140' => 'icon-outline-vector-icons-pack-140'),array('wicon icon-outline-vector-icons-pack-141' => 'icon-outline-vector-icons-pack-141'),array('wicon icon-outline-vector-icons-pack-142' => 'icon-outline-vector-icons-pack-142'),array('wicon icon-outline-vector-icons-pack-143' => 'icon-outline-vector-icons-pack-143'),array('wicon icon-outline-vector-icons-pack-151' => 'icon-outline-vector-icons-pack-151'),array('wicon icon-outline-vector-icons-pack-152' => 'icon-outline-vector-icons-pack-152'),array('wicon icon-outline-vector-icons-pack-153' => 'icon-outline-vector-icons-pack-153'),array('wicon icon-outline-vector-icons-pack-154' => 'icon-outline-vector-icons-pack-154'),array('wicon icon-outline-vector-icons-pack-155' => 'icon-outline-vector-icons-pack-155'),array('wicon icon-outline-vector-icons-pack-156' => 'icon-outline-vector-icons-pack-156'),array('wicon icon-outline-vector-icons-pack-164' => 'icon-outline-vector-icons-pack-164'),array('wicon icon-outline-vector-icons-pack-165' => 'icon-outline-vector-icons-pack-165'),array('wicon icon-outline-vector-icons-pack-166' => 'icon-outline-vector-icons-pack-166'),array('wicon icon-outline-vector-icons-pack-167' => 'icon-outline-vector-icons-pack-167'),array('wicon icon-outline-vector-icons-pack-168' => 'icon-outline-vector-icons-pack-168'),array('wicon icon-indians-icons-02' => 'icon-indians-icons-02'),array('wicon icon-indians-icons-03' => 'icon-indians-icons-03'),array('wicon icon-indians-icons-04' => 'icon-indians-icons-04'),array('wicon icon-indians-icons-05' => 'icon-indians-icons-05'),array('wicon icon-indians-icons-06' => 'icon-indians-icons-06'),array('wicon icon-indians-icons-07' => 'icon-indians-icons-07'),array('wicon icon-indians-icons-08' => 'icon-indians-icons-08'),array('wicon icon-indians-icons-09' => 'icon-indians-icons-09'),array('wicon icon-wolverine-logo-01' => 'icon-wolverine-logo-01'),array('wicon icon-wolverine-logo-02' => 'icon-wolverine-logo-02'),array('wicon icon-wolverine-logo-03' => 'icon-wolverine-logo-03'),array('wicon icon-wolverine-logo-04' => 'icon-wolverine-logo-04'),array('wicon icon-wolverine-logo-05' => 'icon-wolverine-logo-05'),array('wicon icon-wolverine-logo-06' => 'icon-wolverine-logo-06'),array('wicon icon-wolverine-logo-08' => 'icon-wolverine-logo-08'),array('wicon icon-wolverine-logo-09' => 'icon-wolverine-logo-09'),array('wicon icon-wolverine-logo-10' => 'icon-wolverine-logo-10'),array('wicon icon-address' => 'icon-address'),array('wicon icon-adjust' => 'icon-adjust'),array('wicon icon-air' => 'icon-air'),array('wicon icon-alert' => 'icon-alert'),array('wicon icon-archive' => 'icon-archive'),array('wicon icon-arrow-combo' => 'icon-arrow-combo'),array('wicon icon-arrows-ccw' => 'icon-arrows-ccw'),array('wicon icon-attach' => 'icon-attach'),array('wicon icon-attention' => 'icon-attention'),array('wicon icon-back' => 'icon-back'),array('wicon icon-back-in-time' => 'icon-back-in-time'),array('wicon icon-bag' => 'icon-bag'),array('wicon icon-basket' => 'icon-basket'),array('wicon icon-battery' => 'icon-battery'),array('wicon icon-behance' => 'icon-behance'),array('wicon icon-bell' => 'icon-bell'),array('wicon icon-block' => 'icon-block'),array('wicon icon-book' => 'icon-book'),array('wicon icon-book-open' => 'icon-book-open'),array('wicon icon-bookmark' => 'icon-bookmark'),array('wicon icon-bookmarks' => 'icon-bookmarks'),array('wicon icon-box' => 'icon-box'),array('wicon icon-briefcase' => 'icon-briefcase'),array('wicon icon-brush' => 'icon-brush'),array('wicon icon-bucket' => 'icon-bucket'),array('wicon icon-calendar' => 'icon-calendar'),array('wicon icon-camera' => 'icon-camera'),array('wicon icon-cancel' => 'icon-cancel'),array('wicon icon-cancel-circled' => 'icon-cancel-circled'),array('wicon icon-cancel-squared' => 'icon-cancel-squared'),array('wicon icon-cc' => 'icon-cc'),array('wicon icon-cc-by' => 'icon-cc-by'),array('wicon icon-cc-nc' => 'icon-cc-nc'),array('wicon icon-cc-nc-eu' => 'icon-cc-nc-eu'),array('wicon icon-cc-nc-jp' => 'icon-cc-nc-jp'),array('wicon icon-cc-nd' => 'icon-cc-nd'),array('wicon icon-cc-pd' => 'icon-cc-pd'),array('wicon icon-cc-remix' => 'icon-cc-remix'),array('wicon icon-cc-sa' => 'icon-cc-sa'),array('wicon icon-cc-share' => 'icon-cc-share'),array('wicon icon-cc-zero' => 'icon-cc-zero'),array('wicon icon-ccw' => 'icon-ccw'),array('wicon icon-cd' => 'icon-cd'),array('wicon icon-chart-area' => 'icon-chart-area'),array('wicon icon-chart-bar' => 'icon-chart-bar'),array('wicon icon-chart-line' => 'icon-chart-line'),array('wicon icon-chart-pie' => 'icon-chart-pie'),array('wicon icon-chat' => 'icon-chat'),array('wicon icon-check' => 'icon-check'),array('wicon icon-clipboard' => 'icon-clipboard'),array('wicon icon-clock' => 'icon-clock'),array('wicon icon-cloud' => 'icon-cloud'),array('wicon icon-cloud-thunder' => 'icon-cloud-thunder'),array('wicon icon-code' => 'icon-code'),array('wicon icon-cog' => 'icon-cog'),array('wicon icon-comment' => 'icon-comment'),array('wicon icon-compass' => 'icon-compass'),array('wicon icon-credit-card' => 'icon-credit-card'),array('wicon icon-cup' => 'icon-cup'),array('wicon icon-cw' => 'icon-cw'),array('wicon icon-database' => 'icon-database'),array('wicon icon-db-shape' => 'icon-db-shape'),array('wicon icon-direction' => 'icon-direction'),array('wicon icon-doc' => 'icon-doc'),array('wicon icon-doc-landscape' => 'icon-doc-landscape'),array('wicon icon-doc-text' => 'icon-doc-text'),array('wicon icon-doc-text-inv' => 'icon-doc-text-inv'),array('wicon icon-docs' => 'icon-docs'),array('wicon icon-dot' => 'icon-dot'),array('wicon icon-dot-2' => 'icon-dot-2'),array('wicon icon-dot-3' => 'icon-dot-3'),array('wicon icon-down' => 'icon-down'),array('wicon icon-down-bold' => 'icon-down-bold'),array('wicon icon-down-circled' => 'icon-down-circled'),array('wicon icon-down-dir' => 'icon-down-dir'),array('wicon icon-down-open' => 'icon-down-open'),array('wicon icon-down-open-big' => 'icon-down-open-big'),array('wicon icon-down-open-mini' => 'icon-down-open-mini'),array('wicon icon-down-thin' => 'icon-down-thin'),array('wicon icon-download' => 'icon-download'),array('wicon icon-dribbble' => 'icon-dribbble'),array('wicon icon-dribbble-circled' => 'icon-dribbble-circled'),array('wicon icon-drive' => 'icon-drive'),array('wicon icon-dropbox' => 'icon-dropbox'),array('wicon icon-droplet' => 'icon-droplet'),array('wicon icon-erase' => 'icon-erase'),array('wicon icon-evernote' => 'icon-evernote'),array('wicon icon-export' => 'icon-export'),array('wicon icon-eye' => 'icon-eye'),array('wicon icon-facebook' => 'icon-facebook'),array('wicon icon-facebook-circled' => 'icon-facebook-circled'),array('wicon icon-facebook-squared' => 'icon-facebook-squared'),array('wicon icon-fast-backward' => 'icon-fast-backward'),array('wicon icon-fast-forward' => 'icon-fast-forward'),array('wicon icon-feather' => 'icon-feather'),array('wicon icon-flag' => 'icon-flag'),array('wicon icon-flash' => 'icon-flash'),array('wicon icon-flashlight' => 'icon-flashlight'),array('wicon icon-flattr' => 'icon-flattr'),array('wicon icon-flickr' => 'icon-flickr'),array('wicon icon-flickr-circled' => 'icon-flickr-circled'),array('wicon icon-flight' => 'icon-flight'),array('wicon icon-floppy' => 'icon-floppy'),array('wicon icon-flow-branch' => 'icon-flow-branch'),array('wicon icon-flow-cascade' => 'icon-flow-cascade'),array('wicon icon-flow-line' => 'icon-flow-line'),array('wicon icon-flow-parallel' => 'icon-flow-parallel'),array('wicon icon-flow-tree' => 'icon-flow-tree'),array('wicon icon-folder' => 'icon-folder'),array('wicon icon-forward' => 'icon-forward'),array('wicon icon-gauge' => 'icon-gauge'),array('wicon icon-github' => 'icon-github'),array('wicon icon-github-circled' => 'icon-github-circled'),array('wicon icon-globe' => 'icon-globe'),array('wicon icon-google-circles' => 'icon-google-circles'),array('wicon icon-gplus' => 'icon-gplus'),array('wicon icon-gplus-circled' => 'icon-gplus-circled'),array('wicon icon-graduation-cap' => 'icon-graduation-cap'),array('wicon icon-heart' => 'icon-heart'),array('wicon icon-heart-empty' => 'icon-heart-empty'),array('wicon icon-help' => 'icon-help'),array('wicon icon-help-circled' => 'icon-help-circled'),array('wicon icon-home' => 'icon-home'),array('wicon icon-hourglass' => 'icon-hourglass'),array('wicon icon-inbox' => 'icon-inbox'),array('wicon icon-infinity' => 'icon-infinity'),array('wicon icon-info' => 'icon-info'),array('wicon icon-info-circled' => 'icon-info-circled'),array('wicon icon-instagrem' => 'icon-instagrem'),array('wicon icon-install' => 'icon-install'),array('wicon icon-key' => 'icon-key'),array('wicon icon-keyboard' => 'icon-keyboard'),array('wicon icon-lamp' => 'icon-lamp'),array('wicon icon-language' => 'icon-language'),array('wicon icon-lastfm' => 'icon-lastfm'),array('wicon icon-lastfm-circled' => 'icon-lastfm-circled'),array('wicon icon-layout' => 'icon-layout'),array('wicon icon-leaf' => 'icon-leaf'),array('wicon icon-left' => 'icon-left'),array('wicon icon-left-bold' => 'icon-left-bold'),array('wicon icon-left-circled' => 'icon-left-circled'),array('wicon icon-left-dir' => 'icon-left-dir'),array('wicon icon-left-open' => 'icon-left-open'),array('wicon icon-left-open-big' => 'icon-left-open-big'),array('wicon icon-left-open-mini' => 'icon-left-open-mini'),array('wicon icon-left-thin' => 'icon-left-thin'),array('wicon icon-level-down' => 'icon-level-down'),array('wicon icon-level-up' => 'icon-level-up'),array('wicon icon-lifebuoy' => 'icon-lifebuoy'),array('wicon icon-light-down' => 'icon-light-down'),array('wicon icon-light-up' => 'icon-light-up'),array('wicon icon-link' => 'icon-link'),array('wicon icon-linkedin' => 'icon-linkedin'),array('wicon icon-linkedin-circled' => 'icon-linkedin-circled'),array('wicon icon-list' => 'icon-list'),array('wicon icon-list-add' => 'icon-list-add'),array('wicon icon-location' => 'icon-location'),array('wicon icon-lock' => 'icon-lock'),array('wicon icon-lock-open' => 'icon-lock-open'),array('wicon icon-login' => 'icon-login'),array('wicon icon-logo-db' => 'icon-logo-db'),array('wicon icon-logout' => 'icon-logout'),array('wicon icon-loop' => 'icon-loop'),array('wicon icon-magnet' => 'icon-magnet'),array('wicon icon-mail' => 'icon-mail'),array('wicon icon-map' => 'icon-map'),array('wicon icon-megaphone' => 'icon-megaphone'),array('wicon icon-menu' => 'icon-menu'),array('wicon icon-mic' => 'icon-mic'),array('wicon icon-minus' => 'icon-minus'),array('wicon icon-minus-circled' => 'icon-minus-circled'),array('wicon icon-minus-squared' => 'icon-minus-squared'),array('wicon icon-mixi' => 'icon-mixi'),array('wicon icon-mobile' => 'icon-mobile'),array('wicon icon-monitor' => 'icon-monitor'),array('wicon icon-moon' => 'icon-moon'),array('wicon icon-mouse' => 'icon-mouse'),array('wicon icon-music' => 'icon-music'),array('wicon icon-mute' => 'icon-mute'),array('wicon icon-network' => 'icon-network'),array('wicon icon-newspaper' => 'icon-newspaper'),array('wicon icon-note' => 'icon-note'),array('wicon icon-note-beamed' => 'icon-note-beamed'),array('wicon icon-palette' => 'icon-palette'),array('wicon icon-paper-plane' => 'icon-paper-plane'),array('wicon icon-pause' => 'icon-pause'),array('wicon icon-paypal' => 'icon-paypal'),array('wicon icon-pencil' => 'icon-pencil'),array('wicon icon-phone' => 'icon-phone'),array('wicon icon-picasa' => 'icon-picasa'),array('wicon icon-picture' => 'icon-picture'),array('wicon icon-pinterest' => 'icon-pinterest'),array('wicon icon-pinterest-circled' => 'icon-pinterest-circled'),array('wicon icon-play' => 'icon-play'),array('wicon icon-plus' => 'icon-plus'),array('wicon icon-plus-circled' => 'icon-plus-circled'),array('wicon icon-plus-squared' => 'icon-plus-squared'),array('wicon icon-popup' => 'icon-popup'),array('wicon icon-print' => 'icon-print'),array('wicon icon-progress-0' => 'icon-progress-0'),array('wicon icon-progress-1' => 'icon-progress-1'),array('wicon icon-progress-2' => 'icon-progress-2'),array('wicon icon-progress-3' => 'icon-progress-3'),array('wicon icon-publish' => 'icon-publish'),array('wicon icon-qq' => 'icon-qq'),array('wicon icon-quote' => 'icon-quote'),array('wicon icon-rdio' => 'icon-rdio'),array('wicon icon-rdio-circled' => 'icon-rdio-circled'),array('wicon icon-record' => 'icon-record'),array('wicon icon-renren' => 'icon-renren'),array('wicon icon-reply' => 'icon-reply'),array('wicon icon-reply-all' => 'icon-reply-all'),array('wicon icon-resize-full' => 'icon-resize-full'),array('wicon icon-resize-small' => 'icon-resize-small'),array('wicon icon-retweet' => 'icon-retweet'),array('wicon icon-right' => 'icon-right'),array('wicon icon-right-bold' => 'icon-right-bold'),array('wicon icon-right-circled' => 'icon-right-circled'),array('wicon icon-right-dir' => 'icon-right-dir'),array('wicon icon-right-open' => 'icon-right-open'),array('wicon icon-right-open-big' => 'icon-right-open-big'),array('wicon icon-right-open-mini' => 'icon-right-open-mini'),array('wicon icon-right-thin' => 'icon-right-thin'),array('wicon icon-rocket' => 'icon-rocket'),array('wicon icon-rss' => 'icon-rss'),array('wicon icon-search' => 'icon-search'),array('wicon icon-share' => 'icon-share'),array('wicon icon-shareable' => 'icon-shareable'),array('wicon icon-shuffle' => 'icon-shuffle'),array('wicon icon-signal' => 'icon-signal'),array('wicon icon-sina-weibo' => 'icon-sina-weibo'),array('wicon icon-skype' => 'icon-skype'),array('wicon icon-skype-circled' => 'icon-skype-circled'),array('wicon icon-smashing' => 'icon-smashing'),array('wicon icon-sound' => 'icon-sound'),array('wicon icon-soundcloud' => 'icon-soundcloud'),array('wicon icon-spotify' => 'icon-spotify'),array('wicon icon-spotify-circled' => 'icon-spotify-circled'),array('wicon icon-star' => 'icon-star'),array('wicon icon-star-empty' => 'icon-star-empty'),array('wicon icon-stop' => 'icon-stop'),array('wicon icon-stumbleupon' => 'icon-stumbleupon'),array('wicon icon-stumbleupon-circled' => 'icon-stumbleupon-circled'),array('wicon icon-suitcase' => 'icon-suitcase'),array('wicon icon-sweden' => 'icon-sweden'),array('wicon icon-switch' => 'icon-switch'),array('wicon icon-tag' => 'icon-tag'),array('wicon icon-tape' => 'icon-tape'),array('wicon icon-target' => 'icon-target'),array('wicon icon-thermometer' => 'icon-thermometer'),array('wicon icon-thumbs-down' => 'icon-thumbs-down'),array('wicon icon-thumbs-up' => 'icon-thumbs-up'),array('wicon icon-ticket' => 'icon-ticket'),array('wicon icon-to-end' => 'icon-to-end'),array('wicon icon-to-start' => 'icon-to-start'),array('wicon icon-tools' => 'icon-tools'),array('wicon icon-traffic-cone' => 'icon-traffic-cone'),array('wicon icon-trash' => 'icon-trash'),array('wicon icon-trophy' => 'icon-trophy'),array('wicon icon-tumblr' => 'icon-tumblr'),array('wicon icon-tumblr-circled' => 'icon-tumblr-circled'),array('wicon icon-twitter' => 'icon-twitter'),array('wicon icon-twitter-circled' => 'icon-twitter-circled'),array('wicon icon-up' => 'icon-up'),array('wicon icon-up-bold' => 'icon-up-bold'),array('wicon icon-up-circled' => 'icon-up-circled'),array('wicon icon-up-dir' => 'icon-up-dir'),array('wicon icon-up-open' => 'icon-up-open'),array('wicon icon-up-open-big' => 'icon-up-open-big'),array('wicon icon-up-open-mini' => 'icon-up-open-mini'),array('wicon icon-up-thin' => 'icon-up-thin'),array('wicon icon-upload' => 'icon-upload'),array('wicon icon-upload-cloud' => 'icon-upload-cloud'),array('wicon icon-user' => 'icon-user'),array('wicon icon-user-add' => 'icon-user-add'),array('wicon icon-users' => 'icon-users'),array('wicon icon-vcard' => 'icon-vcard'),array('wicon icon-video' => 'icon-video'),array('wicon icon-vimeo' => 'icon-vimeo'),array('wicon icon-vimeo-circled' => 'icon-vimeo-circled'),array('wicon icon-vkontakte' => 'icon-vkontakte'),array('wicon icon-volume' => 'icon-volume'),array('wicon icon-water' => 'icon-water'),array('wicon icon-window' => 'icon-window'),array('wicon icon-wolverine-logo-07' => 'icon-wolverine-logo-07'),array('wicon icon-key21' => 'icon-key21'),array('wicon icon-password1' => 'icon-password1'),array('wicon icon-user14' => 'icon-user14'),array('wicon icon-shopping111' => 'icon-shopping111'),array('wicon icon-icon-search' => 'icon-icon-search'),array('wicon icon-arrow413' => 'icon-arrow413'),array('wicon icon-arrow427' => 'icon-arrow427'),array('wicon icon-wrong6' => 'icon-wrong6'),array('wicon icon-icon-opened29' => 'icon-icon-opened29'),array('wicon icon-icon-opened29-1' => 'icon-icon-opened29-1'),array('wicon icon-dark37' => 'icon-dark37'),array('wicon icon-dark37-1' => 'icon-dark37-1'),array('wicon icon-list23' => 'icon-list23'),array('wicon icon-menu27' => 'icon-menu27'),array('wicon icon-menu45' => 'icon-menu45'),array('wicon icon-menu53' => 'icon-menu53'),array('wicon icon-menu55' => 'icon-menu55'),array('wicon icon-list23-1' => 'icon-list23-1'),array('wicon icon-wrong6-1' => 'icon-wrong6-1'),array('wicon icon-previous11' => 'icon-previous11'),array('wicon icon-thin36' => 'icon-thin36'),array('wicon icon-thin35' => 'icon-thin35'),array('wicon icon-up77' => 'icon-up77'),array('wicon icon-right106' => 'icon-right106'),array('wicon icon-next15' => 'icon-next15'),array('wicon icon-collapse3' => 'icon-collapse3'),array('wicon icon-expand22' => 'icon-expand22'),array('wicon icon-play43' => 'icon-play43'),array('wicon icon-search-icon' => 'icon-search-icon'),array('wicon icon-cart-icon' => 'icon-cart-icon'),array('wicon icon-minus-1' => 'icon-minus-1'),array('wicon icon-plus-1' => 'icon-plus-1'),array('wicon icon-185100-caddie-shop-shopping-streamline' => 'icon-185100-caddie-shop-shopping-streamline'),array('wicon icon-185101-caddie-shopping-streamline' => 'icon-185101-caddie-shopping-streamline'),array('wicon icon-ecommerce-bag' => 'icon-ecommerce-bag'),array('wicon icon-ecommerce-bag-check' => 'icon-ecommerce-bag-check'),array('wicon icon-ecommerce-bag-cloud' => 'icon-ecommerce-bag-cloud'),array('wicon icon-ecommerce-bag-download' => 'icon-ecommerce-bag-download'),array('wicon icon-ecommerce-bag-minus' => 'icon-ecommerce-bag-minus'),array('wicon icon-ecommerce-bag-plus' => 'icon-ecommerce-bag-plus'),array('wicon icon-ecommerce-bag-refresh' => 'icon-ecommerce-bag-refresh'),array('wicon icon-ecommerce-bag-remove' => 'icon-ecommerce-bag-remove'),array('wicon icon-ecommerce-bag-search' => 'icon-ecommerce-bag-search'),array('wicon icon-ecommerce-bag-upload' => 'icon-ecommerce-bag-upload'),array('wicon icon-svg-icon-02' => 'icon-svg-icon-02'),array('wicon icon-svg-icon-03' => 'icon-svg-icon-03'),array('wicon icon-svg-icon-04' => 'icon-svg-icon-04'),array('wicon icon-svg-icon-05' => 'icon-svg-icon-05'),array('wicon icon-svg-icon-06' => 'icon-svg-icon-06'),array('wicon icon-svg-icon-07' => 'icon-svg-icon-07'),array('wicon icon-svg-icon-08' => 'icon-svg-icon-08'),array('wicon icon-svg-icon-09' => 'icon-svg-icon-09'),array('wicon icon-svg-icon-10' => 'icon-svg-icon-10'),array('wicon icon-svg-icon-11' => 'icon-svg-icon-11'),array('wicon icon-svg-icon-12' => 'icon-svg-icon-12'),array('wicon icon-svg-icon-13' => 'icon-svg-icon-13'),array('wicon icon-svg-icon-14' => 'icon-svg-icon-14'),array('wicon icon-svg-icon-15' => 'icon-svg-icon-15'),array('wicon icon-svg-icon-16' => 'icon-svg-icon-16'),array('wicon icon-svg-icon-17' => 'icon-svg-icon-17'),array('wicon icon-svg-icon-18' => 'icon-svg-icon-18'),
                );
                $pixel_icons = array(
                    array( 'vc_pixel_icon vc_pixel_icon-alert' => __( 'Alert', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-info' => __( 'Info', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-tick' => __( 'Tick', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-explanation' => __( 'Explanation', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-address_book' => __( 'Address book', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-alarm_clock' => __( 'Alarm clock', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-anchor' => __( 'Anchor', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-application_image' => __( 'Application Image', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-arrow' => __( 'Arrow', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-asterisk' => __( 'Asterisk', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-hammer' => __( 'Hammer', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-balloon' => __( 'Balloon', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-balloon_buzz' => __( 'Balloon Buzz', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-balloon_facebook' => __( 'Balloon Facebook', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-balloon_twitter' => __( 'Balloon Twitter', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-battery' => __( 'Battery', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-binocular' => __( 'Binocular', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-document_excel' => __( 'Document Excel', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-document_image' => __( 'Document Image', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-document_music' => __( 'Document Music', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-document_office' => __( 'Document Office', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-document_pdf' => __( 'Document PDF', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-document_powerpoint' => __( 'Document Powerpoint', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-document_word' => __( 'Document Word', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-bookmark' => __( 'Bookmark', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-camcorder' => __( 'Camcorder', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-camera' => __( 'Camera', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-chart' => __( 'Chart', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-chart_pie' => __( 'Chart pie', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-clock' => __( 'Clock', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-fire' => __( 'Fire', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-heart' => __( 'Heart', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-mail' => __( 'Mail', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-play' => __( 'Play', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-shield' => __( 'Shield', 'wolverine' ) ),
                    array( 'vc_pixel_icon vc_pixel_icon-video' => __( 'Video', 'wolverine' ) ),
                );
                $icon_type = array(
                    'type' => 'dropdown',
                    'heading' => __('Icon library', 'wolverine'),
                    'value' => array(
                        __('[None]', 'wolverine') => '',
                        __('Wolverine', 'wolverine') => 'wolverine',
                        __('Font Awesome', 'wolverine') => 'fontawesome',
                        __('Open Iconic', 'wolverine') => 'openiconic',
                        __('Typicons', 'wolverine') => 'typicons',
                        __('Entypo', 'wolverine') => 'entypo',
                        __('Linecons', 'wolverine') => 'linecons',
                        __('Image', 'wolverine') => 'image',
                    ),
                    'param_name' => 'icon_type',
                    'description' => __('Select icon library.', 'wolverine'),
                );
                $icon_font = array(
                    'type' => 'dropdown',
                    'heading' => __('Icon library', 'wolverine'),
                    'value' => array(
                        __('[None]', 'wolverine') => '',
                        __('Wolverine', 'wolverine') => 'wolverine',
                        __('Font Awesome', 'wolverine') => 'fontawesome',
                        __('Open Iconic', 'wolverine') => 'openiconic',
                        __('Typicons', 'wolverine') => 'typicons',
                        __('Entypo', 'wolverine') => 'entypo',
                        __('Linecons', 'wolverine') => 'linecons',
                    ),
                    'param_name' => 'icon_type',
                    'description' => __('Select icon library.', 'wolverine'),
                );
                $icon_fontawesome = array(
                    'type' => 'iconpicker',
                    'heading' => __('Icon', 'wolverine'),
                    'param_name' => 'icon_fontawesome',
                    'value' => 'fa fa-adjust', // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'fontawesome',
                    ),
                    'description' => __('Select icon from library.', 'wolverine'),
                );
                $icon_wolverine = array(
                    'type' => 'iconpicker',
                    'heading' => __('Icon', 'wolverine'),
                    'param_name' => 'icon_wolverine',
                    'settings' => array(
                        'emptyIcon' => false, // default true, display an "EMPTY" icon?
                        'iconsPerPage' => 4000,
                        'type' => 'wolverine',
                        'source' => $wolverine_icons,
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'wolverine',
                    ),
                    'description' => __('Select icon from library.', 'wolverine'),
                );
                $icon_openiconic = array(
                    'type' => 'iconpicker',
                    'heading' => __('Icon', 'wolverine'),
                    'param_name' => 'icon_openiconic',
                    'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false, // default true, display an "EMPTY" icon?
                        'type' => 'openiconic',
                        'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'openiconic',
                    ),
                    'description' => __('Select icon from library.', 'wolverine'),
                );
                $icon_typicons = array(
                    'type' => 'iconpicker',
                    'heading' => __('Icon', 'wolverine'),
                    'param_name' => 'icon_typicons',
                    'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false, // default true, display an "EMPTY" icon?
                        'type' => 'typicons',
                        'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'typicons',
                    ),
                    'description' => __('Select icon from library.', 'wolverine'),
                );
                $icon_entypo = array(
                    'type' => 'iconpicker',
                    'heading' => __('Icon', 'wolverine'),
                    'param_name' => 'icon_entypo',
                    'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false, // default true, display an "EMPTY" icon?
                        'type' => 'entypo',
                        'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'entypo',
                    ),
                );
                $icon_linecons = array(
                    'type' => 'iconpicker',
                    'heading' => __('Icon', 'wolverine'),
                    'param_name' => 'icon_linecons',
                    'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false, // default true, display an "EMPTY" icon?
                        'type' => 'linecons',
                        'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'linecons',
                    ),
                    'description' => __('Select icon from library.', 'wolverine'),
                );
                $icon_image = array(
                    'type' => 'attach_image',
                    'heading' => __('Upload Image Icon:', 'wolverine'),
                    'param_name' => 'icon_image',
                    'value' => '',
                    'description' => __('Upload the custom image icon.', 'wolverine'),
                    'dependency' => Array('element' => 'icon_type', 'value' => array('image')),
                );
                vc_map(array(
                    'name' => __('Slider Container', 'wolverine'),
                    'base' => 'wolverine_slider_container',
                    'class' => '',
                    'icon' => 'fa fa-ellipsis-h',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'as_parent' => array('except' => 'wolverine_slider_container'),
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'params' => array(
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Navigation', 'wolverine'),
                            'param_name' => 'navigation',
                            'description' => __('Show navigation.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Pagination', 'wolverine'),
                            'param_name' => 'pagination',
                            'description' => __('Show pagination.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'std' => 'yes',
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Single Item', 'wolverine'),
                            'param_name' => 'singleitem',
                            'description' => __('Display only one item.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Stop On Hover', 'wolverine'),
                            'param_name' => 'stoponhover',
                            'description' => __('Stop autoplay on mouse hover.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Auto Play', 'wolverine'),
                            'param_name' => 'autoplay',
                            'description' => __('Change to any integer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds.', 'wolverine'),
                            'value' => '',
                            'std' => 'true'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Items', 'wolverine'),
                            'param_name' => 'items',
                            'description' => __('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width', 'wolverine'),
                            'value' => '',
                            'std' => 4
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Items Desktop', 'wolverine'),
                            'param_name' => 'itemsdesktop',
                            'description' => __('This allows you to preset the number of slides visible with a particular browser width. The format is [x,y] whereby x=browser width and y=number of slides displayed. For example [1199,4] means that if(window<=1199){ show 4 slides per page} Alternatively use itemsDesktop: false to override these settings.', 'wolverine'),
                            'value' => '',
                            'std' => '1199,4'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Items Desktop Small', 'wolverine'),
                            'param_name' => 'itemsdesktopsmall',
                            'value' => '',
                            'std' => '979,3'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Items Tablet', 'wolverine'),
                            'param_name' => 'itemstablet',
                            'value' => '',
                            'std' => '768,2'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Items Tablet Small', 'wolverine'),
                            'param_name' => 'itemstabletsmall',
                            'value' => '',
                            'std' => 'false'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Items Mobile', 'wolverine'),
                            'param_name' => 'itemsmobile',
                            'value' => '',
                            'std' => '479,1'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Items Scale Up', 'wolverine'),
                            'param_name' => 'itemsscaleup',
                            'description' => __('Option to not stretch items when it is less than the supplied items.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Auto Height', 'wolverine'),
                            'param_name' => 'autoheight',
                            'description' => __('You can use different heights on slides.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Slide Speed', 'wolverine'),
                            'param_name' => 'slidespeed',
                            'description' => __('Slide speed in milliseconds. Ex 200', 'wolverine'),
                            'value' => '',
                            'std' => '200',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Pagination Speed', 'wolverine'),
                            'param_name' => 'paginationspeed',
                            'description' => __('Pagination speed in milliseconds. Ex 800', 'wolverine'),
                            'value' => '',
                            'std' => '800',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Rewind Speed', 'wolverine'),
                            'param_name' => 'rewindspeed',
                            'description' => __('Rewind speed in milliseconds. Ex 1000', 'wolverine'),
                            'value' => '',
                            'std' => '1000',
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    ),
                    'js_view' => 'VcColumnView'
                ));

                vc_map(array(
                    'name' => __('Testimonials', 'wolverine'),
                    'base' => 'wolverine_testimonial_ctn',
                    'class' => '',
                    'icon' => 'fa fa-quote-left',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'as_parent' => array('only' => 'wolverine_testimonial_sc'),
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Layout Style', 'wolverine'),
                            'param_name' => 'layout_style',
                            'admin_label' => true,
                            'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2', __('style 3', 'wolverine') => 'style3', __('style 4', 'wolverine') => 'style4'),
                            'description' => __('Select Layout Style.', 'wolverine')
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Color Scheme', 'wolverine'),
                            'param_name' => 'color_scheme',
                            'value' => array(__('Default', 'wolverine') => '',__('Dark', 'wolverine') => 'dark', __('Light', 'wolverine') => 'light'),
                            'description' => __('Select Color Scheme.', 'wolverine')
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Title', 'wolverine'),
                            'param_name' => 'title',
                            'value' => '',
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Navigation', 'wolverine'),
                            'param_name' => 'navigation',
                            'description' => __('Show navigation.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Auto Play', 'wolverine'),
                            'param_name' => 'autoplay',
                            'description' => __('Change to any integer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds.', 'wolverine'),
                            'value' => '',
                            'std' => 'true'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Stop On Hover', 'wolverine'),
                            'param_name' => 'stoponhover',
                            'description' => __('Stop autoplay on mouse hover.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Auto Height', 'wolverine'),
                            'param_name' => 'autoheight',
                            'description' => __('You can use different heights on slides.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Slide Speed', 'wolverine'),
                            'param_name' => 'slidespeed',
                            'description' => __('Slide speed in milliseconds. Ex 200', 'wolverine'),
                            'value' => '',
                            'std' => '200',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Pagination Speed', 'wolverine'),
                            'param_name' => 'paginationspeed',
                            'description' => __('Pagination speed in milliseconds. Ex 800', 'wolverine'),
                            'value' => '',
                            'std' => '800',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Rewind Speed', 'wolverine'),
                            'param_name' => 'rewindspeed',
                            'description' => __('Rewind speed in milliseconds. Ex 1000', 'wolverine'),
                            'value' => '',
                            'std' => '1000',
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    ),
                    'js_view' => 'VcColumnView'
                ));
                vc_map(array(
                    'name' => __('Testimonial', 'wolverine'),
                    'base' => 'wolverine_testimonial_sc',
                    'class' => '',
                    'icon' => 'fa fa-user',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'as_child' => array('only' => 'wolverine_testimonial_ctn', 'wolverine_slider_container'),
                    'params' => array(
                        array(
                            'type' => 'attach_image',
                            'heading' => __('Image:', 'wolverine'),
                            'param_name' => 'image',
                            'value' => '',
                            'description' => __('Choose the author picture.', 'wolverine'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Author name', 'wolverine'),
                            'param_name' => 'author',
                            'admin_label' => true,
                            'description' => __('Enter Author name.', 'wolverine')
                        ),
                        array(
                            'type' => 'textarea',
                            'heading' => __('Quote from author', 'wolverine'),
                            'param_name' => 'content',
                            'value' => ''
                        )
                    )
                ));

                vc_map(array(
                    'name' => __('Quotes', 'wolverine'),
                    'base' => 'wolverine_quotes_ctn',
                    'class' => '',
                    'icon' => 'fa fa-quote-right',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'as_parent' => array('only' => 'wolverine_quotes_sc'),
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Layout Style', 'wolverine'),
                            'param_name' => 'layout_style',
                            'admin_label' => true,
                            'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2'),
                            'description' => __('Select Layout Style.', 'wolverine'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Color Scheme', 'wolverine'),
                            'param_name' => 'color_scheme',
                            'value' => array(__('Dark', 'wolverine') => 'dark', __('Light', 'wolverine') => 'light'),
                            'std'=>'light',
                            'description' => __('Select Color Scheme.', 'wolverine')
                        ),
                        $icon_type,
                        $icon_wolverine,
                        $icon_fontawesome,
                        $icon_openiconic,
                        $icon_typicons,
                        $icon_entypo,
                        $icon_linecons,
                        $icon_image,
                        // Play with icon selector
                        array(
                            'type' => 'attach_image',
                            'heading' => __('Upload Image Icon:', 'wolverine'),
                            'param_name' => 'image',
                            'value' => '',
                            'description' => __('Upload the custom image icon.', 'wolverine'),
                            'dependency' => Array('element' => 'icon_type', 'value' => array('custom')),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Auto Play', 'wolverine'),
                            'param_name' => 'autoplay',
                            'description' => __('Change to any integer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds.', 'wolverine'),
                            'value' => '',
                            'std' => 'true'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Stop On Hover', 'wolverine'),
                            'param_name' => 'stoponhover',
                            'description' => __('Stop autoplay on mouse hover.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Auto Height', 'wolverine'),
                            'param_name' => 'autoheight',
                            'description' => __('You can use different heights on slides.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Slide Speed', 'wolverine'),
                            'param_name' => 'slidespeed',
                            'description' => __('Slide speed in milliseconds. Ex 200', 'wolverine'),
                            'value' => '',
                            'std' => '200',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Pagination Speed', 'wolverine'),
                            'param_name' => 'paginationspeed',
                            'description' => __('Pagination speed in milliseconds. Ex 800', 'wolverine'),
                            'value' => '',
                            'std' => '800',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Rewind Speed', 'wolverine'),
                            'param_name' => 'rewindspeed',
                            'description' => __('Rewind speed in milliseconds. Ex 1000', 'wolverine'),
                            'value' => '',
                            'std' => '1000',
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    ),
                    'js_view' => 'VcColumnView'
                ));
                vc_map(array(
                    'name' => __('Quote', 'wolverine'),
                    'base' => 'wolverine_quotes_sc',
                    'class' => '',
                    'icon' => 'fa fa-user',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'as_child' => array('only' => 'wolverine_quotes_ctn', 'wolverine_slider_container'),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => __('Author name', 'wolverine'),
                            'param_name' => 'author',
                            'admin_label' => true,
                            'description' => __('Enter Author name.', 'wolverine')
                        ),
                        array(
                            'type' => 'textarea',
                            'heading' => __('Quote from author', 'wolverine'),
                            'param_name' => 'content',
                            'value' => ''
                        )
                    )
                ));

                vc_map(array(
                    'name' => __('Cover Box', 'wolverine'),
                    'base' => 'wolverine_cover_box_ctn',
                    'class' => '',
                    'icon' => 'fa fa-newspaper-o',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'as_parent' => array('only' => 'wolverine_cover_box_sc'),
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => __('Item Active Index', 'wolverine'),
                            'param_name' => 'active_index',
                            'std'   =>  '1',
                            'admin_label' => true,
                            'description' => __('Enter number index of item need active.', 'wolverine')
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    ),
                    'js_view' => 'VcColumnView'
                ));
                vc_map(array(
                    'name' => __('Cover Box Item', 'wolverine'),
                    'base' => 'wolverine_cover_box_sc',
                    'class' => '',
                    'icon' => 'fa fa-file-text-o',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'as_child' => array('only' => 'wolverine_cover_box_ctn', 'wolverine_slider_container'),
                    'params' => array(
                        array(
                            'type' => 'attach_image',
                            'heading' => __('Image:', 'wolverine'),
                            'param_name' => 'image',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Sub Title', 'wolverine'),
                            'param_name' => 'sub_title',
                            'description' => __('Enter Sub Title.', 'wolverine')
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Title', 'wolverine'),
                            'param_name' => 'title',
                            'admin_label' => true,
                            'description' => __('Enter Title.', 'wolverine')
                        ),
                        array(
                            'type' => 'vc_link',
                            'heading' => __('Link (url)', 'wolverine'),
                            'param_name' => 'link',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textarea',
                            'heading' => __('Description', 'wolverine'),
                            'param_name' => 'content',
                            'value' => ''
                        )
                    )
                ));

                vc_map(array(
                    'name' => __('Our Commitment', 'wolverine'),
                    'base' => 'wolverine_our_commitment_ctn',
                    'class' => '',
                    'icon' => 'fa fa-coffee',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'as_parent' => array('only' => 'wolverine_our_commitment_sc'),
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Color Scheme', 'wolverine'),
                            'param_name' => 'color_scheme',
                            'value' => array(__('Dark', 'wolverine') => 'dark', __('Light', 'wolverine') => 'light'),
                            'std'=> 'light',
                            'description' => __('Select Color Scheme.', 'wolverine')
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Auto Play', 'wolverine'),
                            'param_name' => 'autoplay',
                            'description' => __('Change to any integer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds.', 'wolverine'),
                            'value' => '',
                            'std' => 'true',
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Stop On Hover', 'wolverine'),
                            'param_name' => 'stoponhover',
                            'description' => __('Stop autoplay on mouse hover.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column'
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    ),
                    'js_view' => 'VcColumnView'
                ));
                vc_map(array(
                    'name' => __('Commitment', 'wolverine'),
                    'base' => 'wolverine_our_commitment_sc',
                    'class' => '',
                    'icon' => 'fa fa-user',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'as_child' => array('only' => 'wolverine_our_commitment_ctn', 'wolverine_slider_container'),
                    'params' => array(
                        array(
                            'type' => 'attach_image',
                            'heading' => __('Image:', 'wolverine'),
                            'param_name' => 'image',
                            'value' => '',
                            'description' => __('Choose the author picture.', 'wolverine'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Title', 'wolverine'),
                            'param_name' => 'title',
                            'description' => __('Enter Author name.', 'wolverine')
                        ),
                        array(
                            'type' => 'textarea',
                            'heading' => __('Content', 'wolverine'),
                            'param_name' => 'content',
                            'value' => ''
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Author name', 'wolverine'),
                            'param_name' => 'author',
                            'admin_label' => true,
                            'description' => __('Enter Author name.', 'wolverine')
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Job', 'wolverine'),
                            'param_name' => 'job',
                            'description' => __('Enter Author Job.', 'wolverine')
                        ),
                    )
                ));

                vc_map(array(
                    'name' => __('Counter', 'wolverine'),
                    'base' => 'wolverine_counter',
                    'class' => '',
                    'icon' => 'fa fa-tachometer',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => __('Value', 'wolverine'),
                            'param_name' => 'value',
                            'value' => '',
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => __('Color', 'wolverine'),
                            'param_name' => 'value_color',
                            'description' => __('Select custom color for your element.', 'wolverine'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Title', 'wolverine'),
                            'param_name' => 'title',
                            'value' => '',
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => __('Color', 'wolverine'),
                            'param_name' => 'title_color',
                            'description' => __('Select custom color for your element.', 'wolverine'),
                        ),
                        $add_el_class
                    )
                ));
                vc_map(array(
                    'name' => __('Event Time', 'wolverine'),
                    'base' => 'wolverine_event_time',
                    'class' => '',
                    'icon' => 'fa fa-calendar',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Color Scheme', 'wolverine'),
                            'param_name' => 'color_scheme',
                            'value' => array(__('Dark', 'wolverine') => 'dark', __('Light', 'wolverine') => 'light'),
                            'std'=>'light',
                            'description' => __('Select Color Scheme.', 'wolverine')
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Title', 'wolverine'),
                            'param_name' => 'title',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Location', 'wolverine'),
                            'param_name' => 'location',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Month', 'wolverine'),
                            'param_name' => 'month',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Day', 'wolverine'),
                            'param_name' => 'day',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Time', 'wolverine'),
                            'param_name' => 'time',
                            'value' => '',
                        ),
                        array(
                            'type' => 'vc_link',
                            'heading' => __('Link (url)', 'wolverine'),
                            'param_name' => 'link',
                            'value' => '',
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    )
                ));
                if (!is_array($cpt_disable) || (array_key_exists('food', $cpt_disable) && ($cpt_disable['food'] == '0' || $cpt_disable['food'] == ''))) {
                    $food_categories = get_terms(G5PLUS_FOOD_CATEGORY_TAXONOMY, array('hide_empty' => 0, 'orderby' => 'ASC'));
                    $food_cat = array();
                    if (is_array($food_categories)) {
                        foreach ($food_categories as $cat) {
                            $food_cat[$cat->name] = $cat->slug;
                        }
                    }
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => G5PLUS_FOOD_POST_TYPE,
                        'post_status' => 'publish');
                    $list_food = array();
                    $post_array = get_posts($args);
                    foreach ($post_array as $post) : setup_postdata($post);
                        $list_food[$post->post_title] = $post->ID;
                    endforeach;
                    wp_reset_postdata();


                    vc_map(array(
                        'name' => __('Food', 'wolverine'),
                        'base' => 'g5plusframework_food',
                        'class' => '',
                        'icon' => 'fa fa-cutlery',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Layout style', 'wolverine'),
                                'param_name' => 'layout_type',
                                'admin_label' => true,
                                'value' => array(__('Grid', 'wolverine') => 'grid',
                                    __('Grid Title', 'wolverine') => 'grid-title',
                                    __('Title & Price', 'wolverine') => 'title-price',
                                    __('Thumb & Title & Price', 'wolverine') => 'title-price-thumb',
                                )
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Source', 'wolverine'),
                                'param_name' => 'data_source',
                                'admin_label' => true,
                                'value' => array(
                                    __('From Category', 'wolverine') => '',
                                    __('From Food IDs', 'wolverine') => 'list_id')
                            ),

                            array(
                                'type' => 'multi-select',
                                'heading' => __('Food Category', 'wolverine'),
                                'param_name' => 'category',
                                'admin_label' => true,
                                'options' => $food_cat,
                                'dependency' => Array('element' => 'data_source', 'value' => array(''))
                            ),
                            array(
                                'type' => 'multi-select',
                                'heading' => __('Select Food', 'wolverine'),
                                'param_name' => 'food_ids',
                                'options' => $list_food,
                                'dependency' => Array('element' => 'data_source', 'value' => array('list_id'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Show Category', 'wolverine'),
                                'param_name' => 'show_category',
                                'admin_label' => true,
                                'value' => array(
                                    __('None', 'wolverine') => '',
                                    __('Show in left', 'wolverine') => 'left',
                                    __('Show in center', 'wolverine') => 'center',
                                    __('Show in right', 'wolverine') => 'right'),

                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Number of column', 'wolverine'),
                                'param_name' => 'column',
                                'value' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6')
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Number of item (or number of item per page if choose show paging)', 'wolverine'),
                                'param_name' => 'item',
                                'value' => '',
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Order Post Date By', 'wolverine'),
                                'param_name' => 'order',
                                'value' => array(__('Descending', 'wolverine') => 'DESC', __('Ascending', 'wolverine') => 'ASC')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Show Paging', 'wolverine'),
                                'param_name' => 'show_pagging',
                                'value' => array('None' => '', __('Load more', 'wolverine') => '1', __('Slider', 'wolverine') => '2'),
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Padding', 'wolverine'),
                                'param_name' => 'padding',
                                'value' => array(__('No padding', 'wolverine') => '', '10 px' => 'col-padding-10', '15 px' => 'col-padding-15', '20 px' => 'col-padding-20', '40 px' => 'col-padding-40')

                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Overlay Style', 'wolverine'),
                                'param_name' => 'overlay_style',
                                'value' => array(__('Title & price', 'wolverine') => 'title-price',
                                    'Title & price & view gallery' => 'title-price-gallery',
                                ),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid'))

                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation

                        )
                    ));
                }

                if (!is_array($cpt_disable) || (array_key_exists('gallery', $cpt_disable) && ($cpt_disable['gallery'] == '0' || $cpt_disable['gallery'] == ''))) {
                    $gallery_categories = get_terms(G5PLUS_GALLERY_CATEGORY_TAXONOMY, array('hide_empty' => 0, 'orderby' => 'ASC'));
                    $gallery_cat = array();
                    if (is_array($gallery_categories)) {
                        foreach ($gallery_categories as $cat) {
                            $gallery_cat[$cat->name] = $cat->slug;
                        }
                    }
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => G5PLUS_GALLERY_POST_TYPE,
                        'post_status' => 'publish');
                    $list_gallery = array();
                    $post_array = get_posts($args);
                    foreach ($post_array as $post) : setup_postdata($post);
                        $list_gallery[$post->post_title] = $post->ID;
                    endforeach;
                    wp_reset_postdata();


                    vc_map(array(
                        'name' => __('Gallery', 'wolverine'),
                        'base' => 'g5plusframework_gallery',
                        'class' => '',
                        'icon' => 'fa fa-picture-o',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Popup gallery', 'wolverine'),
                                'param_name' => 'popup_type',
                                'admin_label' => true,
                                'value' => array(
                                    __('Pretty Photo', 'wolverine') => '',
                                    __('Magnific Popup', 'wolverine') => 'magnific_popup')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Display', 'wolverine'),
                                'param_name' => 'display_type',
                                'admin_label' => true,
                                'value' => array(
                                    __('Compact', 'wolverine') => '',
                                    __('Full', 'wolverine') => 'full')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Source', 'wolverine'),
                                'param_name' => 'data_source',
                                'admin_label' => true,
                                'value' => array(
                                    __('From Category', 'wolverine') => '',
                                    __('From Gallery IDs', 'wolverine') => 'list_id')
                            ),

                            array(
                                'type' => 'multi-select',
                                'heading' => __('Gallery Category', 'wolverine'),
                                'param_name' => 'category',
                                'admin_label' => true,
                                'options' => $gallery_cat,
                                'dependency' => Array('element' => 'data_source', 'value' => array(''))
                            ),
                            array(
                                'type' => 'multi-select',
                                'heading' => __('Select Gallery', 'wolverine'),
                                'param_name' => 'gallery_ids',
                                'options' => $list_gallery,
                                'dependency' => Array('element' => 'data_source', 'value' => array('list_id'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Show Category', 'wolverine'),
                                'param_name' => 'show_category',
                                'admin_label' => true,
                                'value' => array(
                                    __('None', 'wolverine') => '',
                                    __('Show in left', 'wolverine') => 'left',
                                    __('Show in center', 'wolverine') => 'center',
                                    __('Show in right', 'wolverine') => 'right'),
                                'dependency' => Array('element' => 'display_type', 'value' => array(''))

                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Number of column', 'wolverine'),
                                'param_name' => 'column',
                                'value' => array('2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6')
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Number of item (or number of item per page if choose show paging)', 'wolverine'),
                                'param_name' => 'item',
                                'value' => '',
                                'dependency' => Array('element' => 'display_type', 'value' => array(''))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Order Post Date By', 'wolverine'),
                                'param_name' => 'order',
                                'value' => array(__('Descending', 'wolverine') => 'DESC', __('Ascending', 'wolverine') => 'ASC')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Show Paging', 'wolverine'),
                                'param_name' => 'show_pagging',
                                'value' => array('None' => '', __('Load more', 'wolverine') => '1', __('Slider', 'wolverine') => '2'),
                                'dependency' => Array('element' => 'display_type', 'value' => array(''))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Padding', 'wolverine'),
                                'param_name' => 'padding',
                                'value' => array(__('No padding', 'wolverine') => '', '10 px' => 'col-padding-10', '15 px' => 'col-padding-15', '20 px' => 'col-padding-20', '40 px' => 'col-padding-40')

                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation

                        )
                    ));
                }

                if (!is_array($cpt_disable) || (array_key_exists('portfolio', $cpt_disable) && ($cpt_disable['portfolio'] == '0' || $cpt_disable['portfolio'] == ''))) {
                    $portfolio_categories = get_terms(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY, array('hide_empty' => 0, 'orderby' => 'ASC'));
                    $portfolio_cat = array();
                    if (is_array($portfolio_categories)) {
                        foreach ($portfolio_categories as $cat) {
                            $portfolio_cat[$cat->name] = $cat->slug;
                        }
                    }

                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => G5PLUS_PORTFOLIO_POST_TYPE,
                        'post_status' => 'publish');
                    $list_portfolio = array();
                    $post_array = get_posts($args);
                    foreach ($post_array as $post) : setup_postdata($post);
                        $list_portfolio[$post->post_title] = $post->ID;
                    endforeach;
                    wp_reset_postdata();

                    $arr_social = array();
                    $arr_social['Facebook'] = 'facebook_url';
                    $arr_social['Twitter'] = 'twitter_url';
                    $arr_social['Dribble'] = 'dribbble_url';
                    $arr_social['Vimeo'] = 'vimeo_url';
                    $arr_social['Linkedin'] = 'linkedin_url';
                    $arr_social['Google Plus'] = 'googleplus_url';
                    $arr_social['Youtube'] = 'youtube_url';
                    $arr_social['Pinterest'] = 'pinterest_url';
                    $arr_social['Instagram'] = 'instagram_url';

                    vc_map(array(
                        'name' => __('Portfolio', 'wolverine'),
                        'base' => 'g5plusframework_portfolio',
                        'class' => '',
                        'icon' => 'fa fa-th-large',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Layout style', 'wolverine'),
                                'param_name' => 'layout_type',
                                'admin_label' => true,
                                'value' => array(__('Grid', 'wolverine') => 'grid',
                                    __('Title & category', 'wolverine') => 'title',
                                    __('Title & More link', 'wolverine') => 'title-more-link',
                                    __('One page', 'wolverine') => 'one-page',
                                    __('More link', 'wolverine') => 'more-link',
                                    __('Masonry Style-01', 'wolverine') => 'masonry',
                                    __('Masonry Style-02', 'wolverine') => 'masonry-style-02',
                                    __('Masonry Classic', 'wolverine') => 'masonry-classic',
                                    __('Left menu', 'wolverine') => 'left-menu',
                                    __('Flip book', 'wolverine') => 'flip-book'
                                )
                            ),
                            array(
                                'type' => 'attach_image',
                                'heading' => __('Image logo on menu page', 'wolverine'),
                                'param_name' => 'menu_logo',
                                'value' => '',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('flip-book'))
                            ),
                            array(
                                'type' => 'attach_image',
                                'heading' => __('Image logo on search page', 'wolverine'),
                                'param_name' => 'search_logo',
                                'value' => '',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('flip-book'))
                            ),
                            array(
                                'type' => 'attach_image',
                                'heading' => __('Image logo on page detail', 'wolverine'),
                                'param_name' => 'detail_logo',
                                'value' => '',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('flip-book'))
                            ),
                            array(
                                'type' => 'multi-select',
                                'heading' => __('Social', 'wolverine'),
                                'param_name' => 'menu_social',
                                'options' => $arr_social,
                                'dependency' => Array('element' => 'layout_type', 'value' => array('flip-book'))
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Title of shortcode', 'wolverine'),
                                'param_name' => 'title',
                                'value' => '',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('title-more-link', 'flip-book'))
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Subtitle of shortcode', 'wolverine'),
                                'param_name' => 'subtitle',
                                'value' => '',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('title-more-link'))
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Title contact', 'wolverine'),
                                'param_name' => 'title_contact',
                                'value' => '',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('flip-book'))
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Link contact', 'wolverine'),
                                'param_name' => 'link_contact',
                                'value' => '',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('flip-book'))
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Link more items', 'wolverine'),
                                'param_name' => 'link_more_item',
                                'value' => '',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('title-more-link', 'more-link'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Source', 'wolverine'),
                                'param_name' => 'data_source',
                                'admin_label' => true,
                                'value' => array(
                                    __('From Category', 'wolverine') => '',
                                    __('From Portfolio IDs', 'wolverine') => 'list_id')
                            ),

                            array(
                                'type' => 'multi-select',
                                'heading' => __('Portfolio Category', 'wolverine'),
                                'param_name' => 'category',
                                'admin_label' => true,
                                'options' => $portfolio_cat,
                                'dependency' => Array('element' => 'data_source', 'value' => array(''))
                            ),
                            array(
                                'type' => 'multi-select',
                                'heading' => __('Select Portfolio', 'wolverine'),
                                'param_name' => 'portfolio_ids',
                                'options' => $list_portfolio,
                                'dependency' => Array('element' => 'data_source', 'value' => array('list_id'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Show Category', 'wolverine'),
                                'param_name' => 'show_category',
                                'admin_label' => true,
                                'value' => array(
                                    __('None', 'wolverine') => '',
                                    __('Show in left', 'wolverine') => 'left',
                                    __('Show in center', 'wolverine') => 'center',
                                    __('Show in right', 'wolverine') => 'right'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title', 'masonry', 'masonry-classic','masonry-style-02'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Category Position', 'wolverine'),
                                'param_name' => 'category_position',
                                'admin_label' => true,
                                'value' => array(
                                    __('Default', 'wolverine') => '',
                                    __('Show in breadcrumbs', 'wolverine') => 'in-breadcrumbs'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title', 'masonry', 'masonry-classic','masonry-style-02'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Number of column', 'wolverine'),
                                'param_name' => 'column',
                                'value' => array('2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title','more-link'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Number of column masonry', 'wolverine'),
                                'param_name' => 'column_masonry',
                                'value' => array('3' => '3', '4' => '4', '5' => '5'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('masonry'))
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Number of item (or number of item per page if choose show paging)', 'wolverine'),
                                'param_name' => 'item',
                                'value' => '',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title', 'masonry', 'more-link', 'title-more-link', 'one-page', 'masonry-style-02', 'masonry-classic', 'flip-book'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Order Post Date By', 'wolverine'),
                                'param_name' => 'order',
                                'value' => array(__('Descending', 'wolverine') => 'DESC', __('Ascending', 'wolverine') => 'ASC')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Show Paging', 'wolverine'),
                                'param_name' => 'show_pagging',
                                'value' => array('None' => '', __('Load more', 'wolverine') => '1', __('Slider', 'wolverine') => '2'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Show Paging Masonry', 'wolverine'),
                                'param_name' => 'show_pagging_masonry',
                                'value' => array('None' => '', __('Load more', 'wolverine') => '1'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('masonry','masonry-classic','masonry-style-02'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Padding', 'wolverine'),
                                'param_name' => 'padding',
                                'value' => array(__('No padding', 'wolverine') => '', '10 px' => 'col-padding-10', '15 px' => 'col-padding-15', '20 px' => 'col-padding-20', '40 px' => 'col-padding-40'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title', 'masonry', 'one-page', 'masonry-style-02', 'masonry-classic'))
                            ),

                            array(
                                'type' => 'dropdown',
                                'heading' => __('Image size', 'wolverine'),
                                'param_name' => 'image_size',
                                'value' => array('585x585' => '585x585', '590x393' => '590x393'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Overlay Style', 'wolverine'),
                                'param_name' => 'overlay_style',
                                'admin_label' => true,
                                'value' => array(__('Icon', 'wolverine') => 'icon',
                                    __('Title', 'wolverine') => 'title',
                                    __('Title & Category', 'wolverine') => 'title-category',
                                    __('Title & Category & Link button', 'wolverine') => 'title-category-link',
                                    __('Title & Excerpt & Link button & Align center', 'wolverine') => 'title-excerpt-link',
                                    __('Title & Excerpt & Link button & Align left', 'wolverine') => 'left-title-excerpt-link',
                                    __('Title & Excerpt & Link button & No Icon', 'wolverine') => 'title-excerpt-link-no-icon',
                                    __('Title & Excerpt', 'wolverine') => 'title-excerpt',
                                ),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'masonry', 'left-menu', 'title-more-link', 'more-link', 'one-page', 'masonry-style-02', 'masonry-classic'))
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation

                        )
                    ));



                    $portfolio_cat_ids = array();
                    if (is_array($portfolio_categories)) {
                        foreach ($portfolio_categories as $cat) {
                            $portfolio_cat_ids[$cat->name] = $cat->term_id;
                        }
                    }
                    vc_map(array(
                        'name' => __('Portfolio Category', 'wolverine'),
                        'base' => 'g5plusframework_portfolio_taxonomy',
                        'class' => '',
                        'icon' => 'fa fa-th-list',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Layout style', 'wolverine'),
                                'param_name' => 'layout_type',
                                'admin_label' => true,
                                'value' => array(__('Grid', 'wolverine') => 'grid',
                                    __('Title & category', 'wolverine') => 'title',
                                    __('One page', 'wolverine') => 'one-page',
                                    __('Masonry Style-01', 'wolverine') => 'masonry',
                                    __('Masonry Style-02', 'wolverine') => 'masonry-style-02',
                                    __('Masonry Classic', 'wolverine') => 'masonry-classic',
                                    __('Left menu', 'wolverine') => 'left-menu',
                                )
                            ),

                            array(
                                'type' => 'multi-select',
                                'heading' => __('Portfolio Category', 'wolverine'),
                                'param_name' => 'portfolio_taxonomy_ids',
                                'admin_label' => true,
                                'options' => $portfolio_cat_ids
                            ),

                            array(
                                'type' => 'dropdown',
                                'heading' => __('Number of column', 'wolverine'),
                                'param_name' => 'column',
                                'value' => array('2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title','more-link'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Number of column masonry', 'wolverine'),
                                'param_name' => 'column_masonry',
                                'value' => array('3' => '3', '4' => '4', '5' => '5'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('masonry'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Order Post Date By', 'wolverine'),
                                'param_name' => 'order',
                                'value' => array(__('Descending', 'wolverine') => 'DESC', __('Ascending', 'wolverine') => 'ASC')
                            ),

                            array(
                                'type' => 'dropdown',
                                'heading' => __('Padding', 'wolverine'),
                                'param_name' => 'padding',
                                'value' => array(__('No padding', 'wolverine') => '', '10 px' => 'col-padding-10', '15 px' => 'col-padding-15', '20 px' => 'col-padding-20', '40 px' => 'col-padding-40'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title', 'masonry', 'one-page', 'masonry-style-02', 'masonry-classic'))
                            ),

                            array(
                                'type' => 'dropdown',
                                'heading' => __('Image size', 'wolverine'),
                                'param_name' => 'image_size',
                                'value' => array('585x585' => '585x585', '590x393' => '590x393'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Overlay Style', 'wolverine'),
                                'param_name' => 'overlay_style',
                                'admin_label' => true,
                                'value' => array(
                                    __('Title', 'wolverine') => 'title',
                                    __('Title & Excerpt & Link button & Align center', 'wolverine') => 'title-excerpt-link',
                                    __('Title & Excerpt & Link button & Align left', 'wolverine') => 'left-title-excerpt-link',
                                    __('Title & Excerpt & Link button & No Icon', 'wolverine') => 'title-excerpt-link-no-icon',
                                    __('Title & Excerpt', 'wolverine') => 'title-excerpt',
                                ),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'masonry', 'left-menu', 'title-more-link', 'more-link', 'one-page', 'masonry-style-02', 'masonry-classic'))
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    ));

                    vc_map(array(
                        'name' => __('Social Icon', 'wolverine'),
                        'base' => 'g5plusframework_social_icon',
                        'class' => '',
                        'icon' => 'fa fa-share-alt',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Layout style', 'wolverine'),
                                'param_name' => 'layout_type',
                                'admin_label' => true,
                                'value' => array(__('Icon', 'wolverine') => 'icon',
                                    __('Icon & Text', 'wolverine') => 'icon-text'
                                ),
                            ),
                            array(
                                'type' => 'multi-select',
                                'heading' => __('Social', 'wolverine'),
                                'param_name' => 'social_icons',
                                'options' => $arr_social
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    ));
                }

                if ( !is_array($cpt_disable) || (array_key_exists('ourteam', $cpt_disable) && ($cpt_disable['ourteam'] == '0' || $cpt_disable['ourteam'] == ''))) {
                    $ourteam_cat = array();
                    $ourteam_categories = get_terms('ourteam_category', array('hide_empty' => 0, 'orderby' => 'ASC'));
                    if (is_array($ourteam_categories)) {
                        foreach ($ourteam_categories as $cat) {
                            $ourteam_cat[$cat->name] = $cat->slug;
                        }
                    }
                    vc_map(array(
                        'name' => __('Our Team', 'wolverine'),
                        'base' => 'wolverine_ourteam',
                        'class' => '',
                        'icon' => 'fa fa-users',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Layout Style', 'wolverine'),
                                'param_name' => 'layout_style',
                                'admin_label' => true,
                                'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2', __('style 3', 'wolverine') => 'style3'),
                                'description' => __('Select Layout Style.', 'wolverine')
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Item Amount', 'wolverine'),
                                'param_name' => 'item_amount',
                                'value' => '9'
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Column', 'wolverine'),
                                'param_name' => 'column',
                                'value' => '3'
                            ),
                            array(
                                'type' => 'checkbox',
                                'heading' => __('Slider Style', 'wolverine'),
                                'param_name' => 'is_slider',
                                'admin_label' => false,
                                'value' => array(__('Yes, please', 'wolverine') => 'yes')
                            ),
                            array(
                                'type' => 'multi-select',
                                'heading' => __('Category', 'wolverine'),
                                'param_name' => 'category',
                                'options' => $ourteam_cat
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    ));
                }

                if (!is_array($cpt_disable)  || (array_key_exists('pricingtable', $cpt_disable) && ($cpt_disable['pricingtable'] == '0' || $cpt_disable['pricingtable'] == ''))) {
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'pricingtable',
                        'orderby' => 'date',
                        'order' => 'ASC',
                        'post_status' => 'publish'
                    );
                    $pt_posts = get_posts($args);
                    $post_name = array();
                    foreach ($pt_posts as $post) : setup_postdata($post);
                        $post_name[$post->post_title] = $post->post_name;
                    endforeach;

                    vc_map(array(
                        'name' => __('Pricing Table', 'wolverine'),
                        'base' => 'wolverine_pricingtable',
                        'class' => '',
                        'icon' => 'fa fa-money',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Layout Style', 'wolverine'),
                                'param_name' => 'layout_style',
                                'admin_label' => true,
                                'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2', __('style 3', 'wolverine') => 'style3'),
                                'description' => __('Select Layout Style.', 'wolverine')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Column', 'wolverine'),
                                'param_name' => 'column',
                                'value' => array('1' => 1, '2' => 2, '3' => 3, '4' => 4),
                                'std' => '4',
                            ),
                            array(
                                'type' => 'checkbox',
                                'heading' => __('Slider Style', 'wolverine'),
                                'param_name' => 'is_slider',
                                'value' => array(__('Yes, please', 'wolverine') => 'yes')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Pricing Table', 'wolverine'),
                                'param_name' => 'post_name',
                                'admin_label' => true,
                                'value' => $post_name,
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    ));
                }

                vc_map(array(
                    'name' => __('Button', 'wolverine'),
                    'base' => 'wolverine_button',
                    'class' => '',
                    'icon' => 'fa fa-bold',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Layout Style', 'wolverine'),
                            'param_name' => 'layout_style',
                            'admin_label' => true,
                            'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2', __('style 3', 'wolverine') => 'style3', __('style 4', 'wolverine') => 'style4', __('style 5', 'wolverine') => 'style5', __('style 6', 'wolverine') => 'style6', __('Custom Style', 'wolverine') => 'custom'),
                            'description' => __('Select Layout Style.', 'wolverine')
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => __('Background', 'wolverine'),
                            'param_name' => 'custom_background',
                            'description' => __('Select custom background color for your element.', 'wolverine'),
                            'dependency' => array(
                                'element' => 'layout_style',
                                'value' => array('custom')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column',
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => __('Text', 'wolverine'),
                            'param_name' => 'custom_text',
                            'description' => __('Select custom text color for your element.', 'wolverine'),
                            'dependency' => array(
                                'element' => 'layout_style',
                                'value' => array('custom')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column',
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => __('Border', 'wolverine'),
                            'param_name' => 'custom_border',
                            'description' => __('Select custom text color for your element.', 'wolverine'),
                            'dependency' => array(
                                'element' => 'layout_style',
                                'value' => array('custom')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Size', 'wolverine'),
                            'param_name' => 'size',
                            'admin_label' => true,
                            'value' => array(__('1x', 'wolverine') => 'button-1x', __('2x', 'wolverine') => 'button-2x', __('3x', 'wolverine') => 'button-3x', __('4x', 'wolverine') => 'button-4x', __('5x', 'wolverine') => 'button-5x', __('6x', 'wolverine') => 'button-6x'),
                        ),
                        array(
                            'type' => 'vc_link',
                            'heading' => __('Link (url)', 'wolverine'),
                            'param_name' => 'link',
                            'value' => '',
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    )
                ));
                vc_map(array(
                    'name' => __('Vertical Progress Bar', 'wolverine'),
                    'base' => 'wolverine_vertical_progress_bar',
                    'icon' => 'fa fa-bar-chart',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'description' => __('Animated progress bar', 'wolverine'),
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Layout Style', 'wolverine'),
                            'param_name' => 'layout_style',
                            'admin_label' => true,
                            'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2'),
                            'description' => __('Select Layout Style.', 'wolverine')
                        ),
                        array(
                            'type' => 'exploded_textarea',
                            'heading' => __('Graphic values', 'wolverine'),
                            'param_name' => 'values',
                            'description' => __('Input graph values, titles and color here. Divide values with linebreaks (Enter). Example: 90|Development|#e75956', 'wolverine'),
                            'value' => '90|Development,80|Design,70|Marketing'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Units', 'wolverine'),
                            'param_name' => 'units',
                            'description' => __('Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'wolverine')
                        ),

                        array(
                            'type' => 'dropdown',
                            'heading' => __('Bar color', 'wolverine'),
                            'param_name' => 'bgcolor',
                            'value' => array(
                                __('Grey', 'wolverine') => 'bar_grey',
                                __('Blue', 'wolverine') => 'bar_blue',
                                __('Turquoise', 'wolverine') => 'bar_turquoise',
                                __('Green', 'wolverine') => 'bar_green',
                                __('Orange', 'wolverine') => 'bar_orange',
                                __('Red', 'wolverine') => 'bar_red',
                                __('Black', 'wolverine') => 'bar_black',
                                __('Custom Color', 'wolverine') => 'custom'
                            ),
                            'description' => __('Select bar background color.', 'wolverine'),
                            'admin_label' => true
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => __('Bar custom color', 'wolverine'),
                            'param_name' => 'custombgcolor',
                            'description' => __('Select custom background color for bars.', 'wolverine'),
                            'dependency' => array('element' => 'bgcolor', 'value' => array('custom'))
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Options', 'wolverine'),
                            'param_name' => 'options',
                            'value' => array(
                                __('Add Stripes?', 'wolverine') => 'striped',
                                __('Add animation? Will be visible with striped bars.', 'wolverine') => 'animated'
                            )
                        ),
                        $add_el_class
                    )
                ));
                vc_map( array(
                    'name' => __( 'Message Box', 'wolverine' ),
                    'base' => 'vc_message',
                    'icon' => 'icon-wpb-information-white',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'description' => __( 'Notification box', 'wolverine' ),
                    'params' => array(
                        array(
                            'type' => 'params_preset',
                            'heading' => __( 'Message Box Presets', 'wolverine' ),
                            'param_name' => 'color', // due to backward compatibility, really it is message_box_type
                            'value' => '',
                            'options' => array(
                                array(
                                    'label' => __( 'Custom', 'wolverine' ),
                                    'value' => '',
                                    'params' => array(),
                                ),
                                array(
                                    'label' => __( 'Informational', 'wolverine' ),
                                    'value' => 'info',
                                    'params' => array(
                                        'message_box_color' => 'info',
                                        'icon_type' => 'wolverine',
                                        'icon_wolverine' => 'wicon icon-info',
                                    ),
                                ),
                                array(
                                    'label' => __( 'Warning', 'wolverine' ),
                                    'value' => 'warning',
                                    'params' => array(
                                        'message_box_color' => 'warning',
                                        'icon_type' => 'wolverine',
                                        'icon_wolverine' => 'wicon icon-attention',
                                    ),
                                ),
                                array(
                                    'label' => __( 'Success', 'wolverine' ),
                                    'value' => 'success',
                                    'params' => array(
                                        'message_box_color' => 'success',
                                        'icon_type' => 'wolverine',
                                        'icon_wolverine' => 'wicon icon-check',
                                    ),
                                ),
                                array(
                                    'label' => __( 'Error', 'wolverine' ),
                                    'value' => 'danger',
                                    'params' => array(
                                        'message_box_color' => 'danger',
                                        'icon_type' => 'fontawesome',
                                        'icon_fontawesome' => 'fa fa-exclamation-circle',
                                    ),
                                ),
                                array(
                                    'label' => __( 'Informational Classic', 'wolverine' ),
                                    'value' => 'alert-info', // due to backward compatibility
                                    'params' => array(
                                        'message_box_color' => 'alert-info',
                                        'icon_type' => 'pixelicons',
                                        'icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-info',
                                    ),
                                ),
                                array(
                                    'label' => __( 'Warning Classic', 'wolverine' ),
                                    'value' => 'alert-warning', // due to backward compatibility
                                    'params' => array(
                                        'message_box_color' => 'alert-warning',
                                        'icon_type' => 'pixelicons',
                                        'icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
                                    ),
                                ),
                                array(
                                    'label' => __( 'Success Classic', 'wolverine' ),
                                    'value' => 'alert-success',  // due to backward compatibility
                                    'params' => array(
                                        'message_box_color' => 'alert-success',
                                        'icon_type' => 'pixelicons',
                                        'icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-tick',
                                    ),
                                ),
                                array(
                                    'label' => __( 'Error Classic', 'wolverine' ),
                                    'value' => 'alert-danger',  // due to backward compatibility
                                    'params' => array(
                                        'message_box_color' => 'alert-danger',
                                        'icon_type' => 'pixelicons',
                                        'icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-explanation',
                                    ),
                                ),
                            ),
                            'description' => __( 'Select predefined message box design or choose "Custom" for custom styling.', 'wolverine' ),
                            'param_holder_class' => 'vc_message-type vc_colored-dropdown',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __( 'Style', 'wolverine' ),
                            'param_name' => 'message_box_style',
                            'value' => getVcShared( 'message_box_styles' ),
                            'description' => __( 'Select message box design style.', 'wolverine' )
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __( 'Shape', 'wolverine' ),
                            'param_name' => 'style', // due to backward compatibility message_box_shape
                            'std' => 'rounded',
                            'value' => array(
                                __( 'Square', 'wolverine' ) => 'square',
                                __( 'Rounded', 'wolverine' ) => 'rounded',
                                __( 'Round', 'wolverine' ) => 'round',
                            ),
                            'description' => __( 'Select message box shape.', 'wolverine' ),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __( 'Color', 'wolverine' ),
                            'param_name' => 'message_box_color',
                            'value' => $custom_colors + getVcShared( 'colors' ),
                            'description' => __( 'Select message box color.', 'wolverine' ),
                            'param_holder_class' => 'vc_message-type vc_colored-dropdown',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __( 'Icon library', 'wolverine' ),
                            'value' => array(
                                __('[None]', 'wolverine') => '',
                                __( 'Wolverine', 'wolverine' ) => 'wolverine',
                                __( 'Font Awesome', 'wolverine' ) => 'fontawesome',
                                __( 'Open Iconic', 'wolverine' ) => 'openiconic',
                                __( 'Typicons', 'wolverine' ) => 'typicons',
                                __( 'Entypo', 'wolverine' ) => 'entypo',
                                __( 'Linecons', 'wolverine' ) => 'linecons',
                                __( 'Pixel', 'wolverine' ) => 'pixelicons',
                            ),
                            'param_name' => 'icon_type',
                            'description' => __( 'Select icon library.', 'wolverine' ),
                        ),
                        $icon_wolverine,
                        $icon_fontawesome,
                        $icon_openiconic,
                        $icon_typicons,
                        $icon_entypo,
                        $icon_linecons,
                        array(
                            'type' => 'iconpicker',
                            'heading' => __( 'Icon', 'wolverine' ),
                            'param_name' => 'icon_pixelicons',
                            'settings' => array(
                                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                                'type' => 'pixelicons',
                                'source' => $pixel_icons,
                            ),
                            'dependency' => array(
                                'element' => 'icon_type',
                                'value' => 'pixelicons',
                            ),
                            'description' => __( 'Select icon from library.', 'wolverine' ),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __( 'Icon Size', 'wolverine' ),
                            'param_name' => 'icon_size', // due to backward compatibility message_box_shape
                            'std' => 'small',
                            'value' => array(
                                __( 'Small', 'wolverine' ) => 'icon_small',
                                __( 'Large', 'wolverine' ) => 'icon_large',
                            ),
                        ),
                        array(
                            'type' => 'textarea_html',
                            'holder' => 'div',
                            'class' => 'messagebox_text',
                            'heading' => __( 'Message text', 'wolverine' ),
                            'param_name' => 'content',
                            'value' => __( '<p>I am message box. Click edit button to change this text.</p>', 'wolverine' )
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    ),
                    'js_view' => 'VcMessageView_Backend'
                ) );
                vc_map(array(
                    'name' => __('Call To Action', 'wolverine'),
                    'base' => 'wolverine_call_action',
                    'class' => '',
                    'icon' => 'fa fa-play',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Layout Style', 'wolverine'),
                            'param_name' => 'layout_style',
                            'admin_label' => true,
                            'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2', __('style 3', 'wolverine') => 'style3', __('style 4', 'wolverine') => 'style4', __('style 5', 'wolverine') => 'style5', __('style 6', 'wolverine') => 'style6'),
                            'description' => __('Select Layout Style.', 'wolverine')
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Text', 'wolverine'),
                            'param_name' => 'text',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Sub Text', 'wolverine'),
                            'param_name' => 'sub_text',
                            'value' => '',
                            'dependency' => Array('element' => 'layout_style', 'value' => array('style5','style6')),
                        ),
                        array(
                            'type' => 'vc_link',
                            'heading' => __('Link (url)', 'wolverine'),
                            'param_name' => 'link',
                            'value' => '',
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    )
                ));
                vc_map(array(
                    'name' => __('View Demo', 'wolverine'),
                    'base' => 'wolverine_view_demo',
                    'class' => '',
                    'icon' => 'fa fa-eye',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'params' => array(
                        array(
                            'type' => 'attach_image',
                            'heading' => __('Image:', 'wolverine'),
                            'param_name' => 'image',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Text', 'wolverine'),
                            'param_name' => 'text',
                            'value' => '',
                        ),
                        array(
                            'type' => 'vc_link',
                            'heading' => __('Link (url)', 'wolverine'),
                            'param_name' => 'link',
                            'value' => '',
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    )
                ));
                $category = array();
                $categories = get_categories();
                if (is_array($categories)) {
                    foreach ($categories as $cat) {
                        $category[$cat->name] = $cat->slug;
                    }
                }

                vc_map(
                    array(
                        'name' => __('Blog', 'wolverine'),
                        'base' => 'wolverine_blog',
                        'icon' => 'fa fa-file-text',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(

                            array(
                                'type' => 'dropdown',
                                'heading' => __('Blog Type', 'wolverine'),
                                'param_name' => 'type',
                                'value' => array(
                                    __('Classic 01', 'wolverine') => 'classic-01',
                                    __('Classic 02', 'wolverine') => 'classic-02',
                                    __('Grid 01', 'wolverine') => 'grid-01',
                                    __('Grid 02', 'wolverine') => 'grid-02',
                                    __('Masonry 01', 'wolverine') => 'masonry-01',
                                    __('Masonry 02', 'wolverine') => 'masonry-02',
                                ),
                                'std' => 'classic-01',
                                'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            ),

                            array(
                                "type" => "dropdown",
                                "heading" => __("Columns", 'wolverine'),
                                "param_name" => "columns",
                                "value" => array(
                                    __('2 columns', 'wolverine') => 2,
                                    __('3 columns', 'wolverine') => 3,
                                    __('4 columns', 'wolverine') => 4,
                                ),
                                "description" => __("How much columns grid", 'wolverine'),
                                'dependency' => array(
                                    'element' => 'type',
                                    'value' => array('grid-01', 'grid-02', 'masonry-01', 'masonry-02')
                                ),
                                'std' => 2,
                                'edit_field_class' => 'vc_col-sm-6 vc_column',
                            ),


                            array(
                                'type' => 'multi-select',
                                'heading' => __('Narrow Category', 'wolverine'),
                                'param_name' => 'category',
                                'options' => $category
                            ),

                            array(
                                "type" => "textfield",
                                "heading" => __("Total items", 'wolverine'),
                                "param_name" => "max_items",
                                "value" => -1,
                                "description" => __('Set max limit for items or enter -1 to display all.', 'wolverine')
                            ),

                            array(
                                'type' => 'dropdown',
                                'heading' => __('Navigation Type', 'wolverine'),
                                'param_name' => 'paging_style',
                                'value' => array(
                                    __('Show all', 'wolverine') => 'all',
                                    __('Default', 'wolverine') => 'default',
                                    __('Load More', 'wolverine') => 'load-more',
                                    __('Infinity Scroll', 'wolverine') => 'infinity-scroll',
                                ),
                                'std' => 'all',
                                'edit_field_class' => 'vc_col-sm-6 vc_column',
                                'dependency' => array(
                                    'element' => 'max_items',
                                    'value' => array('-1')
                                ),
                            ),




                            array(
                                "type" => "textfield",
                                "heading" => __("Posts per page", 'wolverine'),
                                "param_name" => "posts_per_page",
                                "value" => get_option('posts_per_page'),
                                "description" => __('Number of items to show per page', 'wolverine'),
                                'dependency' => array(
                                    'element' => 'paging_style',
                                    'value' => array('default', 'load-more', 'infinity-scroll'),
                                ),
                                'edit_field_class' => 'vc_col-sm-6 vc_column',
                            ),

                            array(
                                'type' => 'dropdown',
                                'heading' => __('Navigation Align', 'wolverine'),
                                'param_name' => 'paging_align',
                                'value' => array(
                                    __('Left', 'wolverine') => 'left',
                                    __('Center', 'wolverine') => 'center',
                                    __('Right', 'wolverine') => 'right',
                                ),
                                'std' => 'right',
                                'dependency' => array(
                                    'element' => 'paging_style',
                                    'value' => array('default'),
                                ),
                            ),

                            // Data settings
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Order by', 'wolverine'),
                                'param_name' => 'orderby',
                                'value' => array(
                                    __('Date', 'wolverine') => 'date',
                                    __('Order by post ID', 'wolverine') => 'ID',
                                    __('Author', 'wolverine') => 'author',
                                    __('Title', 'wolverine') => 'title',
                                    __('Last modified date', 'wolverine') => 'modified',
                                    __('Post/page parent ID', 'wolverine') => 'parent',
                                    __('Number of comments', 'wolverine') => 'comment_count',
                                    __('Menu order/Page Order', 'wolverine') => 'menu_order',
                                    __('Meta value', 'wolverine') => 'meta_value',
                                    __('Meta value number', 'wolverine') => 'meta_value_num',
                                    __('Random order', 'wolverine') => 'rand',
                                ),
                                'description' => __('Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'wolverine'),
                                'group' => __('Data Settings', 'wolverine'),
                                'param_holder_class' => 'vc_grid-data-type-not-ids',
                            ),

                            array(
                                'type' => 'dropdown',
                                'heading' => __('Sorting', 'wolverine'),
                                'param_name' => 'order',
                                'group' => __('Data Settings', 'wolverine'),
                                'value' => array(
                                    __('Descending', 'wolverine') => 'DESC',
                                    __('Ascending', 'wolverine') => 'ASC',
                                ),
                                'param_holder_class' => 'vc_grid-data-type-not-ids',
                                'description' => __('Select sorting order.', 'wolverine'),
                            ),

                            array(
                                'type' => 'textfield',
                                'heading' => __('Meta key', 'wolverine'),
                                'param_name' => 'meta_key',
                                'description' => __('Input meta key for grid ordering.', 'wolverine'),
                                'group' => __('Data Settings', 'wolverine'),
                                'param_holder_class' => 'vc_grid-data-type-not-ids',
                                'dependency' => array(
                                    'element' => 'orderby',
                                    'value' => array('meta_value', 'meta_value_num'),
                                ),
                            ),

                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation,
                            $add_el_class
                        )
                    )
                );
                vc_map(array(
                    'name' => __('Posts', 'wolverine'),
                    'base' => 'wolverine_post',
                    'icon' => 'fa fa-file-text-o',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'description' => __('Posts', 'wolverine'),
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Layout Style', 'wolverine'),
                            'param_name' => 'layout_style',
                            'admin_label' => true,
                            'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2', __('style 3', 'wolverine') => 'style3'),
                            'description' => __('Select Layout Style.', 'wolverine')
                        ),
                        array(
                            'type' => 'multi-select',
                            'heading' => __('Category', 'wolverine'),
                            'param_name' => 'category',
                            'options' => $category
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Display', 'wolverine'),
                            'param_name' => 'display',
                            'admin_label' => true,
                            'value' => array(__('Random', '') => 'random', __('Popular', 'wolverine') => 'popular', __('Recent', 'wolverine') => 'recent', __('Oldest', 'wolverine') => 'oldest'),
                            'std' => 'recent',
                            'description' => __('Select Orderby.', 'wolverine')
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Item Amount', 'wolverine'),
                            'param_name' => 'item_amount',
                            'value' => '6'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Column', 'wolverine'),
                            'param_name' => 'column',
                            'value' => '3',
                            'dependency' => Array('element' => 'layout_style', 'value' => array('style1'))
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Slider Style', 'wolverine'),
                            'param_name' => 'is_slider',
                            'admin_label' => false,
                            'value' => array(__('Yes, please', 'wolverine') => 'yes'),
                            'dependency' => Array('element' => 'layout_style', 'value' => array('style1'))
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    )
                ));
                vc_map(array(
                    'name' => __('Partner Carousel', 'wolverine'),
                    'base' => 'wolverine_partner_carousel',
                    'icon' => 'fa fa-user-plus',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'description' => __('Animated carousel with images', 'wolverine'),
                    'params' => array(
                        array(
                            'type' => 'attach_images',
                            'heading' => __('Images', 'wolverine'),
                            'param_name' => 'images',
                            'value' => '',
                            'description' => __('Select images from media library.', 'wolverine')
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Image size', 'wolverine'),
                            'param_name' => 'img_size',
                            'description' => __('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'wolverine')
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Image Opacity', 'wolverine'),
                            'param_name' => 'opacity',
                            'value' => array(
                                __('[none]', 'wolverine') => '',
                                __('10%', 'wolverine') => '10',
                                __('20%', 'wolverine') => '20',
                                __('30%', 'wolverine') => '30',
                                __('40%', 'wolverine') => '40',
                                __('50%', 'wolverine') => '50',
                                __('60%', 'wolverine') => '60',
                                __('70%', 'wolverine') => '70',
                                __('80%', 'wolverine') => '80',
                                __('90%', 'wolverine') => '90',
                                __('100%', 'wolverine') => '100'
                            ),
                            'std' => '80'
                        ),
                        array(
                            'type' => 'exploded_textarea',
                            'heading' => __('Custom links', 'wolverine'),
                            'param_name' => 'custom_links',
                            'description' => __('Enter links for each slide here. Divide links with linebreaks (Enter) . ','wolverine'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Custom link target', 'wolverine'),
                            'param_name' => 'custom_links_target',
                            'description' => __('Select where to open  custom links.', 'wolverine'),
                            'value' => $target_arr
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Slides per view', 'wolverine'),
                            'param_name' => 'column',
                            'value' => '5',
                            'description' => __('Set numbers of slides you want to display', 'wolverine')
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Slider autoplay', 'wolverine'),
                            'param_name' => 'autoplay',
                            'description' => __('Enables autoplay mode.', 'wolverine'),
                            'value' => array(__('Yes, please', 'wolverine') => 'yes')
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Show pagination control', 'wolverine'),
                            'param_name' => 'pagination',
                            'value' => array(__('Yes, please', 'wolverine') => 'yes')
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => __('Show navigation control', 'wolverine'),
                            'param_name' => 'navigation',
                            'value' => array(__('Yes, please', 'wolverine') => 'yes')
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    )
                ));
                vc_map(array(
                    'name' => __('Headings', 'wolverine'),
                    'base' => 'wolverine_heading',
                    'class' => '',
                    'icon' => 'fa fa-header',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Layout Style', 'wolverine'),
                            'param_name' => 'layout_style',
                            'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2', __('style 3', 'wolverine') => 'style3', __('style 4', 'wolverine') => 'style4', __('style 5', 'wolverine') => 'style5', __('style 6', 'wolverine') => 'style6', __('style 7', 'wolverine') => 'style7'),
                            'description' => __('Select Layout Style.', 'wolverine')
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Color Scheme', 'wolverine'),
                            'param_name' => 'color_scheme',
                            'value' => array(__('Dark', 'wolverine') => 'dark', __('Light', 'wolverine') => 'light'),
                            'std'   => 'dark',
                            'description' => __('Select Color Scheme.', 'wolverine')
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Icon library', 'wolverine'),
                            'value' => array(
                                __('[None]', 'wolverine') => '',
                                __('Wolverine', 'wolverine') => 'wolverine',
                                __('Font Awesome', 'wolverine') => 'fontawesome',
                                __('Open Iconic', 'wolverine') => 'openiconic',
                                __('Typicons', 'wolverine') => 'typicons',
                                __('Entypo', 'wolverine') => 'entypo',
                                __('Linecons', 'wolverine') => 'linecons',
                                __('Image', 'wolverine') => 'image',
                            ),
                            'param_name' => 'icon_type',
                            'description' => __('Select icon library.', 'wolverine'),
                            'dependency' => Array('element' => 'layout_style', 'value' => array('style1', 'style2', 'style6')),
                        ),
                        $icon_wolverine,
                        $icon_fontawesome,
                        $icon_openiconic,
                        $icon_typicons,
                        $icon_entypo,
                        $icon_linecons,
                        $icon_image,
                        array(
                            'type' => 'textfield',
                            'heading' => __('Title', 'wolverine'),
                            'param_name' => 'title',
                            'value' => '',
                            'admin_label' => true
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Sub Title', 'wolverine'),
                            'param_name' => 'sub_title',
                            'value' => '',
                            'dependency' => Array('element' => 'layout_style', 'value' => array('style1', 'style2', 'style7')),
                        ),
                        array(
                            'type' => 'textarea',
                            'heading' => __('Description', 'wolverine'),
                            'param_name' => 'description',
                            'value' => '',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Text alignment', 'wolverine'),
                            'param_name' => 'text_align',
                            'value' => array(__('Left', 'wolverine') => 'text-left', __('Right', 'wolverine') => 'text-right', __('Center', 'wolverine') => 'text-center'),
                            'dependency' => Array('element' => 'layout_style', 'value' => array('style1', 'style2', 'style3', 'style6', 'style7')),
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    )
                ));
                vc_map(array(
                    'name' => __('Feature Box', 'wolverine'),
                    'base' => 'wolverine_feature',
                    'class' => '',
                    'icon' => 'fa fa-th-list',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Layout Style', 'wolverine'),
                            'param_name' => 'layout_style',
                            'admin_label' => true,
                            'value' => array(__('style 1', 'wolverine') => 'style1'),
                            'description' => __('Select Layout Style.', 'wolverine')
                        ),
                        array(
                            'type' => 'attach_image',
                            'heading' => __('Image:', 'wolverine'),
                            'param_name' => 'image',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Video Url', 'wolverine'),
                            'param_name' => 'video_url',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Sub Title', 'wolverine'),
                            'param_name' => 'sub_title',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __('Title', 'wolverine'),
                            'param_name' => 'title',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textarea',
                            'heading' => __('Description', 'wolverine'),
                            'param_name' => 'description',
                            'value' => '',
                        ),
                        array(
                            'type' => 'vc_link',
                            'heading' => __('Link (url)', 'wolverine'),
                            'param_name' => 'link',
                            'value' => '',
                        ),
                        $add_el_class,
                        $add_css_animation,
                        $add_duration_animation,
                        $add_delay_animation
                    )
                ));
                vc_map(
                    array(
                        'name' => __('Icon Box', 'wolverine'),
                        'base' => 'wolverine_icon_box',
                        'icon' => 'fa fa-diamond',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'description' => 'Adds icon box with font icons',
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Layout Style', 'wolverine'),
                                'param_name' => 'layout_style',
                                'admin_label' => true,
                                'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2', __('style 3', 'wolverine') => 'style3', __('style 4', 'wolverine') => 'style4', __('style 5', 'wolverine') => 'style5', __('style 6', 'wolverine') => 'style6'),
                                'description' => __('Select Layout Style.', 'wolverine')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Color Scheme', 'wolverine'),
                                'param_name' => 'color_scheme',
                                'value' => array(__('Dark', 'wolverine') => 'dark', __('Light', 'wolverine') => 'light'),
                                'std'=>'dark',
                                'description' => __('Select Color Scheme.', 'wolverine'),
                                'dependency' => Array('element' => 'layout_style', 'value' => array('style1', 'style4', 'style5', 'style6')),
                            ),
                            $icon_type,
                            $icon_wolverine,
                            $icon_fontawesome,
                            $icon_openiconic,
                            $icon_typicons,
                            $icon_entypo,
                            $icon_linecons,
                            $icon_image,
                            array(
                                'type' => 'vc_link',
                                'heading' => __('Link (url)', 'wolverine'),
                                'param_name' => 'link',
                                'value' => '',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Title', 'wolverine'),
                                'param_name' => 'title',
                                'value' => '',
                                'description' => __('Provide the title for this icon box.', 'wolverine'),
                            ),
                            array(
                                'type' => 'textarea',
                                'heading' => __('Description', 'wolverine'),
                                'param_name' => 'description',
                                'value' => '',
                                'description' => __('Provide the description for this icon box.', 'wolverine'),
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    )
                );

                vc_map(
                    array(
                        'name' => __('Image Box', 'wolverine'),
                        'base' => 'wolverine_image_box',
                        'icon' => 'fa fa-picture-o',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'description' => 'Adds image with content',
                        'params' => array(
                            array(
                                'type' => 'attach_image',
                                'heading' => __('Choose Image:', 'wolverine'),
                                'param_name' => 'image',
                                'value' => '',
                                'description' => __('Upload the custom image.', 'wolverine'),
                            ),
                            array(
                                'type' => 'vc_link',
                                'heading' => __('Link (url)', 'wolverine'),
                                'param_name' => 'link',
                                'value' => '',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Title', 'wolverine'),
                                'param_name' => 'title',
                                'value' => '',
                                'description' => __('Provide the title for this image box.', 'wolverine'),
                            ),
                            array(
                                'type' => 'textarea',
                                'heading' => __('Description', 'wolverine'),
                                'param_name' => 'description',
                                'value' => '',
                                'description' => __('Provide the description for this image box.', 'wolverine'),
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    )
                );

                vc_map(
                    array(
                        'name' => __('Icon Separator', 'wolverine'),
                        'base' => 'wolverine_icon_separator',
                        'icon' => 'fa fa-arrows-v',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            $icon_font,
                            $icon_wolverine,
                            $icon_fontawesome,
                            $icon_openiconic,
                            $icon_typicons,
                            $icon_entypo,
                            $icon_linecons,
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    )
                );
                vc_map(
                    array(
                        'name' => __('Banner', 'wolverine'),
                        'base' => 'wolverine_banner',
                        'icon' => 'fa fa-file-image-o',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'description' => __('Interactive banner','wolverine'),
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Layout Style', 'wolverine'),
                                'param_name' => 'layout_style',
                                'admin_label' => true,
                                'value' => array(__('style 1', 'wolverine') => 'style1', __('style 2', 'wolverine') => 'style2', __('style 3', 'wolverine') => 'style3', __('style 4', 'wolverine') => 'style4'),
                                'description' => __('Select Layout Style.', 'wolverine')
                            ),
                            array(
                                'type' => 'attach_image',
                                'heading' => __('Background Image:', 'wolverine'),
                                'param_name' => 'image',
                                'value' => '',
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Icon library', 'wolverine'),
                                'value' => array(
                                    __('[None]', 'wolverine') => '',
                                    __('Wolverine', 'wolverine') => 'wolverine',
                                    __('Font Awesome', 'wolverine') => 'fontawesome',
                                    __('Open Iconic', 'wolverine') => 'openiconic',
                                    __('Typicons', 'wolverine') => 'typicons',
                                    __('Entypo', 'wolverine') => 'entypo',
                                    __('Linecons', 'wolverine') => 'linecons',
                                ),
                                'param_name' => 'icon_type',
                                'description' => __('Select icon library.', 'wolverine'),
                                'dependency' => Array('element' => 'layout_style', 'value' => array('style1', 'style2', 'style4')),
                            ),
                            $icon_wolverine,
                            $icon_fontawesome,
                            $icon_openiconic,
                            $icon_typicons,
                            $icon_entypo,
                            $icon_linecons,
                            array(
                                'type' => 'vc_link',
                                'heading' => __('Link (url)', 'wolverine'),
                                'param_name' => 'link',
                                'value' => '',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Title', 'wolverine'),
                                'param_name' => 'title',
                                'value' => '',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Sub Title', 'wolverine'),
                                'param_name' => 'sub_title',
                                'value' => '',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __('Banner Height', 'wolverine'),
                                'param_name' => 'height',
                                'value' => '',
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    )
                );
                $product_cat = array();
                if (class_exists('WooCommerce')) {
                    $args = array(
                        'number' => '',
                    );
                    $product_categories = get_terms('product_cat', $args);
                    if (is_array($product_categories)) {
                        foreach ($product_categories as $cat) {
                            $product_cat[$cat->name] = $cat->slug;
                        }
                    }


                    vc_map(
                        array(
                            'name' => __('Product', 'wolverine'),
                            'base' => 'wolverine_product',
                            'icon' => 'fa fa-shopping-cart',
                            'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                            'params' => array(
                                array(
                                    'type' => 'dropdown',
                                    'heading' => __('Style', 'wolverine'),
                                    'param_name' => 'style',
                                    "admin_label" => true,
                                    'value' => array(
                                        __('Classic 1', 'wolverine') => 'classic-1',
                                        __('Classic 2', 'wolverine') => 'classic-2',
                                        __('Classic 3', 'wolverine') => 'classic-3',
                                        __('Creative 1', 'wolverine') => 'creative',
                                        __('Creative 2', 'wolverine') => 'creative-2',
                                    )
                                ),
                                array(
                                    'type' => 'dropdown',
                                    'heading' => __('Feature', 'wolverine'),
                                    'param_name' => 'feature',
                                    "admin_label" => true,
                                    'value' => array(
                                        __('All', 'wolverine') => 'all',
                                        __('Sale Off', 'wolverine') => 'sale',
                                        __('New In', 'wolverine') => 'new-in',
                                        __('Featured', 'wolverine') => 'featured',
                                        __('Top rated', 'wolverine') => 'top-rated',
                                        __('Recent review', 'wolverine') => 'recent-review',
                                        __('Best Selling', 'wolverine') => 'best-selling'
                                    )
                                ),
                                array(
                                    'type' => 'multi-select',
                                    'heading' => __('Narrow Category', 'wolverine'),
                                    'param_name' => 'category',
                                    'options' => $product_cat,
                                    "admin_label" => true,
                                ),
                                array(
                                    "type" => "textfield",
                                    "heading" => __("Per Page", 'wolverine'),
                                    "param_name" => "per_page",
                                    "admin_label" => true,
                                    "value" => '8',
                                    "description" => __('How much items per page to show', 'wolverine')
                                ),
                                array(
                                    "type" => "textfield",
                                    "heading" => __("Columns", 'wolverine'),
                                    "param_name" => "columns",
                                    "value" => '4',
                                    "description" => __("How much columns grid", 'wolverine'),
                                ),
                                array(
                                    'type' => 'checkbox',
                                    'heading' => __('Show Rating', 'wolverine'),
                                    'param_name' => 'rating',
                                    'std' => 0,
                                    'value' => array(
                                        __('Yes, please', 'wolverine') => 1
                                    )
                                ),
                                array(
                                    'type' => 'checkbox',
                                    'heading' => __('Display Slider', 'wolverine'),
                                    'param_name' => 'slider',
                                    'std' => '',
                                    'value' => array(
                                        __('Yes, please', 'wolverine') => 'slider'
                                    )
                                ),
                                array(
                                    'type' => 'dropdown',
                                    'heading' => __('Order by', 'wolverine'),
                                    'param_name' => 'orderby',
                                    'value' => array(
                                        __('Date', 'wolverine') => 'date',
                                        __('ID', 'wolverine') => 'ID',
                                        __('Author', 'wolverine') => 'author',
                                        __('Modified', 'wolverine') => 'modified',
                                        __('Random', 'wolverine') => 'rand',
                                        __('Comment count', 'wolverine') => 'comment_count',
                                        __('Menu Order', 'wolverine') => 'menu_order'
                                    ),
                                    'description' => __('Select how to sort retrieved products.', 'wolverine'),
                                    'dependency' => array(
                                        'element' => 'feature',
                                        'value' => array('all', 'sale', 'featured')
                                    ),
                                ),
                                array(
                                    'type' => 'dropdown',
                                    'heading' => __('Order way', 'wolverine'),
                                    'param_name' => 'order',
                                    'value' => array(
                                        __('Descending', 'wolverine') => 'DESC',
                                        __('Ascending', 'wolverine') => 'ASC'
                                    ),
                                    'description' => __('Designates the ascending or descending order.', 'wolverine'),
                                    'dependency' => array(
                                        'element' => 'feature',
                                        'value' => array('all', 'sale', 'featured')
                                    ),
                                ),
                                $add_el_class,
                                $add_css_animation,
                                $add_duration_animation,
                                $add_delay_animation
                            )
                        )
                    );

                    vc_map(array(
                        'name' => __('Product Categories', 'wolverine'),
                        'base' => 'wolverine_product_categories',
                        'class' => '',
                        'icon' => 'fa fa-cart-plus',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            array(
                                "type" => "textfield",
                                "heading" => __("Title", 'wolverine'),
                                "param_name" => "title",
                                "admin_label" => true,
                                "value" => ''
                            ),
                            array(
                                'type' => 'multi-select',
                                'heading' => __('Narrow Category', 'wolverine'),
                                'param_name' => 'category',
                                'options' => $product_cat
                            ),
                            array(
                                "type" => "textfield",
                                "heading" => __("Columns", 'wolverine'),
                                "param_name" => "columns",
                                "value" => '4',
                                "description" => __("How much columns grid", 'wolverine'),
                            ),

                            array(
                                'type' => 'checkbox',
                                'heading' => __('Display Slider', 'wolverine'),
                                'param_name' => 'slider',
                                'std' => '',
                                'value' => array(
                                    __('Yes, please', 'wolverine') => 'slider'
                                )
                            ),

                            array(
                                'type' => 'checkbox',
                                'heading' => __('Hide empty', 'wolverine'),
                                'param_name' => 'hide_empty',
                                'std' => 0,
                                'value' => array(
                                    __('Yes, please', 'wolverine') => 1
                                )
                            ),


                            array(
                                'type' => 'dropdown',
                                'heading' => __('Order by', 'wolverine'),
                                'param_name' => 'orderby',
                                'value' => array(__('Date', 'wolverine') => 'date', __('ID', 'wolverine') => 'ID',
                                    __('Author', 'wolverine') => 'author', __('Modified', 'wolverine') => 'modified',
                                    __('Random', 'wolverine') => 'rand', __('Comment count', 'wolverine') => 'comment_count',
                                    __('Menu Order', 'wolverine') => 'menu_order'
                                ),
                                'description' => __('Select how to sort retrieved products.', 'wolverine')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Order way', 'wolverine'),
                                'param_name' => 'order',
                                'value' => array(__('Descending', 'wolverine') => 'DESC', __('Ascending', 'wolverine') => 'ASC'),
                                'description' => __('Designates the ascending or descending orde.', 'wolverine')
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    ));




                }

                vc_map( array(
                    'name' => __( 'Navigation FullPage', 'wolverine' ),
                    'base' => 'wolverine_navigation_fullpage',
                    'icon' => 'icon-wpb-graph',
                    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => __( 'Align', 'wolverine' ),
                            'param_name' => 'align',
                            'value' => array(
                                __( 'Left', 'wolverine' ) => 'left',
                                __( 'Right', 'wolverine' ) => 'right',
                            ),
                            'description' => __( 'Select align of navigation.', 'wolverine' ),
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'param_group',
                            'heading' => __( 'Navigation', 'wolverine' ),
                            'param_name' => 'navigation',
                            'description' => __( 'Enter values for navigation - id, title.', 'wolverine' ),
                            'value' => urlencode( json_encode( array(
                                array(
                                    'title' => __( 'Home', 'wolverine' ),
                                    'id' => 'home',
                                ),
                                array(
                                    'title' => __( 'About', 'wolverine' ),
                                    'id' => 'about',
                                ),
                            ) ) ),
                            'params' => array(
                                array(
                                    'type' => 'textfield',
                                    'heading' => __( 'Title', 'wolverine' ),
                                    'param_name' => 'title',
                                    'description' => __( 'Enter title of section.', 'wolverine' ),
                                    'admin_label' => true,
                                    'edit_field_class' => 'vc_col-sm-6',
                                ),
                                array(
                                    'type' => 'textfield',
                                    'heading' => __( 'Id', 'wolverine' ),
                                    'param_name' => 'id',
                                    'description' => __( 'Enter Id of section.', 'wolverine' ),
                                    'admin_label' => true,
                                    'edit_field_class' => 'vc_col-sm-6',
                                ),
                            ),
                        ),

                    )
                ));
                vc_map(
                    array(
                        'name' => __('Wolverine Google Map', 'wolverine'),
                        'base' => 'wolverine_google_map',
                        'icon' => 'fa fa-map-marker',
                        'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Marker title', 'wolverine' ),
                                'param_name' => 'marker_title',
                                'admin_label' => true,
                                'edit_field_class' => 'vc_col-sm-6',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Map height', 'wolverine' ),
                                'param_name' => 'map_height',
                                'admin_label' => true,
                                'edit_field_class' => 'vc_col-sm-6',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Location X', 'wolverine' ),
                                'param_name' => 'location_x',
                                'admin_label' => true,
                                'edit_field_class' => 'vc_col-sm-6',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Location Y', 'wolverine' ),
                                'param_name' => 'location_y',
                                'admin_label' => true,
                                'edit_field_class' => 'vc_col-sm-6',
                            ),
                            array(
                                'type' => 'number',
                                'heading' => __( 'Map zoom', 'wolverine' ),
                                'param_name' => 'map_zoom',
                                'admin_label' => true,
                                'edit_field_class' => 'vc_col-sm-6',
                                'std' => '11',
                                'min' => '1',
                                'max' => '16',

                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __( 'Map style', 'wolverine' ),
                                'param_name' => 'map_style',
                                'admin_label' => true,
                                'edit_field_class' => 'vc_col-sm-6',
                                'std' => 'gray_scale',
                                'value' => array(
                                    __('None','wolverine') => 'none',
                                    __('Gray Scale','wolverine') => 'gray_scale',
                                    __('Icy Blue','wolverine') => 'icy_blue',
                                    __('Mono Green','wolverine') => 'mono_green',
                                )
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('API Url', 'wolverine'),
                                'param_name' => 'api_url',
                                'std' => 'http://maps.googleapis.com/maps/api/js?key=AIzaSyAwey_47Cen4qJOjwHQ_sK1igwKPd74J18',
                            ),
                            $add_el_class,
                            $add_css_animation,
                            $add_duration_animation,
                            $add_delay_animation
                        )
                    )
                );
            }
        }

    }

    if (!function_exists('init_g5plus_framework_shortcodes')) {
        function init_g5plus_framework_shortcodes()
        {
            return g5plusFramework_Shortcodes::init();
        }

        init_g5plus_framework_shortcodes();
    }
}