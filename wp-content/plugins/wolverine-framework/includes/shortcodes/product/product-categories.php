<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/22/2015
 * Time: 3:56 PM
 */
if ( ! defined( 'ABSPATH' ) ) die( '-1' );
if (!class_exists('g5plusFramework_Shortcode_Product_Categories')) {
    class g5plusFramework_Shortcode_Product_Categories {
        function __construct() {
            add_shortcode('wolverine_product_categories', array($this, 'product_categories_shortcode' ));
        }

        function  product_categories_shortcode($atts) {
            $atts = vc_map_get_attributes( 'wolverine_product_categories', $atts );
            $title =  $category =  $columns = $slider = $hide_empty = $orderby = $order = $el_class = $css_animation = $duration = $delay =  '';
            extract(shortcode_atts(array(
                'title' => '',
                'category' => '',
                'columns' => '4',
                'slider'  => '',
                'hide_empty' => '',
                'orderby' => 'date',
                'order' => 'DESC',
                'el_class'      => '',
                'css_animation' => '',
                'duration'      => '',
                'delay'         => ''
            ), $atts));

            // get terms and workaround WP bug with parents/pad counts
            $args = array(
                'orderby'    => $orderby,
                'order'      => $order,
                'hide_empty' => $hide_empty == 1 ? true : false ,
                'pad_counts' => true
            );


            $product_categories = get_terms( 'product_cat', $args );

	        if (!empty($category)) {
		        $cats = explode(',',$category);
		        foreach ( $product_categories as $key => $category ) {
			        if ( ($hide_empty && $category->count == 0) || !in_array($category->slug,$cats) ) {
				        unset( $product_categories[ $key ] );
			        }
		        }
	        }


            global  $g5plus_woocommerce_loop;
            $g5plus_woocommerce_loop['columns'] = $columns;
            $g5plus_woocommerce_loop['layout'] = $slider;


            $class[]= 'woocommerce shortcode-product-categories-wrap';
            $class[] = $el_class;
            $class[] = g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);

            $class_name = join(' ',$class);

            ob_start();
            ?>
            <?php if ($product_categories) : ?>
                <div class="<?php echo esc_attr($class_name) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                    <?php if (!empty($title)) : ?>
                        <h4 class="widget-title"><span><?php echo esc_html($title);?></span></h4>
                    <?php endif; ?>
                    <?php woocommerce_product_loop_start(); ?>
                        <?php foreach ( $product_categories as $category ) : ?>
                            <?php  wc_get_template( 'content-product_cat.php', array(
                                'category' => $category
                            ) ); ?>
                        <?php endforeach; // end of the loop. ?>
                    <?php woocommerce_product_loop_end(); ?>

                </div>
            <?php else: ?>
                <div class="item-not-found"><?php echo __('No item found','wolverine') ?></div>
            <?php endif; ?>

            <?php
            wp_reset_postdata();
            $content =  ob_get_clean();
            return $content;
        }

    }
    new g5plusFramework_Shortcode_Product_Categories();
}