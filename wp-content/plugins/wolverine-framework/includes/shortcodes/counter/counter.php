<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_ShortCode_Counter')) {
    class g5plusFramework_ShortCode_Counter
    {
        function __construct()
        {
            add_shortcode('wolverine_counter', array($this, 'counter_shortcode'));
        }

        function counter_shortcode($atts)
        {
	        /**
	         * Shortcode attributes
	         * @var $value
	         * @var $value_color
	         * @var $title
	         * @var $title_color
	         * @var $el_class
	         */
	        $atts = vc_map_get_attributes( 'wolverine_counter', $atts );
	        extract( $atts );
            wp_enqueue_script('wolverine_counter',plugins_url('wolverine-framework/includes/shortcodes/counter/jquery.countTo.js'),array(),false, true);
            ob_start();?>
            <div class="wolverine-counter <?php echo esc_attr($el_class) ?>">
            <?php if($value!=''): ?>
                <span class="display-percentage" style="color: <?php echo esc_attr($value_color) ?>" data-percentage="<?php echo esc_attr($value) ?>"><?php echo esc_html($value) ?></span>
                <?php if($title!=''): ?>
                    <p class="counter-title" style="color: <?php echo esc_attr($title_color) ?>"><?php echo wp_kses_post($title) ?></p>
                <?php endif;
            endif; ?>
            </div>
            <?php
            $content = ob_get_clean();
            return $content;
        }
    }
    new g5plusFramework_ShortCode_Counter();
}