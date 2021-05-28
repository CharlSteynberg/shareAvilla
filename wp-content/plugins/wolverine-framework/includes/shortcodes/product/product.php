<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/15/2015
 * Time: 9:44 AM
 */
if ( ! defined( 'ABSPATH' ) ) die( '-1' );

if (!class_exists('g5plusFramework_Shortcode_Product')) {
    class g5plusFramework_Shortcode_Product {
        function __construct() {
            add_shortcode('wolverine_product', array($this, 'product_shortcode' ));
        }

        function  product_shortcode($atts) {
            $atts = vc_map_get_attributes( 'wolverine_product', $atts );
            $style =  $feature = $category = $per_page = $columns = $rating = $slider = $orderby = $order = $el_class = $css_animation = $duration = $delay =  '';
            extract(shortcode_atts(array(
                'style' => 'classic-1',
                'feature' => 'all',
                'category' => '',
                'per_page' => '12',
                'columns' => '4',
                'rating' => 0,
	            'slider'  => '',
                'orderby' => 'date',
                'order' => 'DESC',
                'el_class'      => '',
                'css_animation' => '',
                'duration'      => '',
                'delay'         => ''
            ), $atts));

	        $product_visibility_term_ids = wc_get_product_visibility_term_ids();
            // get sources
	        $query_args = array(
		        'posts_per_page' => $per_page,
		        'post_status'    => 'publish',
		        'post_type'      => 'product',
		        'no_found_rows'  => 1,
		        'meta_query'     => array(),
		        'tax_query'      => array(
			        'relation' => 'AND',
		        ),
	        );

	        if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
		        $query_args['tax_query'] = array(
			        array(
				        'taxonomy' => 'product_visibility',
				        'field'    => 'term_taxonomy_id',
				        'terms'    => $product_visibility_term_ids['outofstock'],
				        'operator' => 'NOT IN',
			        ),
		        );
	        }


	        if (!empty($category)) {
		        $query_args['tax_query'] = array(
			        array(
				        'taxonomy' 		=> 'product_cat',
				        'terms' 		=>  explode(',',$category),
				        'field' 		=> 'slug',
				        'operator' 		=> 'IN'
			        )
		        );
	        }

	        switch($feature) {
		        case 'sale':
			        $product_ids_on_sale = wc_get_product_ids_on_sale();
			        $query_args['post__in'] = array_merge( array( 0 ), $product_ids_on_sale );
			        break;
		        case 'new-in':
			        $query_args['orderby'] = 'DESC';
			        $query_args['order'] = 'date';
			        break;
		        case 'featured':
			        $query_args['tax_query'][] = array(
				        'taxonomy' => 'product_visibility',
				        'field'    => 'term_taxonomy_id',
				        'terms'    => $product_visibility_term_ids['featured'],
			        );
			        break;
		        case 'top-rated':
			        $query_args['meta_key'] = '_wc_average_rating';
			        $query_args['orderby'] = 'meta_value_num';
			        $query_args['order'] = 'DESC';
			        $query_args['meta_query'] = WC()->query->get_meta_query();
			        $query_args['tax_query'] = WC()->query->get_tax_query();
			        break;
		        case 'recent-review':
			        add_filter( 'posts_clauses', array($this, 'order_by_comment_date_post_clauses' ) );
			        break;
		        case 'best-selling' :
			        $query_args['meta_key'] = 'total_sales';
			        $query_args['orderby'] = 'meta_value_num';
			        break;
	        }

	        if ($feature == 'all' || $feature == 'sale' || $feature == 'featured') {
		        $query_args['orderby'] = $orderby;
		        $query_args['order'] = $order;
	        }


	        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts ) );


            if($feature =='recent-review' ){
                remove_filter( 'posts_clauses', array($this, 'order_by_comment_date_post_clauses' )  );
            }

            $class = array('woocommerce shortcode-product-wrap');
            $class[] = $el_class;
            $class[] = g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);

            $class_name = join(' ',$class);

            global  $g5plus_woocommerce_loop;
            $g5plus_woocommerce_loop['columns'] = $columns;
            $g5plus_woocommerce_loop['layout'] = $slider;
	        $g5plus_woocommerce_loop['style'] = $style;
	        $g5plus_woocommerce_loop['rating'] = $rating == 1 ? 1 : 0;

            ob_start();
            ?>
            <?php if ($products->have_posts()) : ?>
                <div class="<?php echo esc_attr($class_name) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                    <?php woocommerce_product_loop_start(); ?>
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile; // end of the loop. ?>
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

        function order_by_comment_date_post_clauses($args){
            global $wpdb;

            $args['join'] .= "
                LEFT JOIN (
                    SELECT comment_post_ID, MAX(comment_date)  as  comment_date
                    FROM $wpdb->comments
                    WHERE comment_approved = 1
                    GROUP BY comment_post_ID
                ) as wp_comments ON($wpdb->posts.ID = wp_comments.comment_post_ID)
            ";
            $args['orderby'] = "wp_comments.comment_date DESC";
            return $args;
        }


    }
    new g5plusFramework_Shortcode_Product();
}