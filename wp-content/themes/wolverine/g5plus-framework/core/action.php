<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/19/2015
 * Time: 3:59 PM
 */
/*---------------------------------------------------
/* SEARCH AJAX
/*---------------------------------------------------*/
if (!function_exists('g5plus_result_search_callback')) {
    function g5plus_result_search_callback() {
        ob_start();
        $posts_per_page = 8;
        $search_box_result_amount = g5plus_get_option('search_box_result_amount');
        if (!empty($search_box_result_amount)) {
            $posts_per_page = $search_box_result_amount;
        }

        $post_type = array();
        $search_box_post_type = g5plus_get_option('search_box_post_type',array(
	        'post'      => '1',
	        'page'      => '0',
	        'product'   => '1',
	        'portfolio' => '1',
	        'service'   => '1',
        ));
        if (is_array($search_box_post_type)) {
            foreach($search_box_post_type as $key => $value) {
                if ($value == 1) {
                    $post_type[] = $key;
                }
            }
        }


        $keyword = $_REQUEST['keyword'];

        if ( $keyword ) {
            $search_query = array(
                's' => $keyword,
                'order'     	=> 'DESC',
                'orderby'   	=> 'date',
                'post_status'	=> 'publish',
                'post_type' 	=> $post_type,
                'posts_per_page'         => $posts_per_page + 1,
            );
            $search = new WP_Query( $search_query );

            $newdata = array();
            if ($search && count($search->post) > 0) {
                $count = 0;
                foreach ( $search->posts as $post ) {
                    if ($count == $posts_per_page) {
                        $newdata[] = array(
                            'id'        => -2,
                            'title'     => '<a href="' . esc_url(home_url('/')) .'?s=' . $keyword . '"><i class="wicon icon-outline-vector-icons-pack-94"></i> ' . __('View More','wolverine') . '</a>',
                            'guid'      => '',
                            'date'      => null,
                        );

                        break;
                    }
                    $newdata[] = array(
                        'id'        => $post->ID,
                        'title'     => $post->post_title,
                        'guid'      => get_permalink( $post->ID ),
                        'date'      => mysql2date( 'M d Y', $post->post_date ),
                    );
                    $count++;

                }
            }
            else {
                $newdata[] = array(
                    'id'        => -1,
                    'title'     => __('Sorry, but nothing matched your search terms. Please try again with different keywords.','wolverine'),
                    'guid'      => '',
                    'date'      => null,
                );
            }

            ob_end_clean();
            echo json_encode( $newdata );
        }
        die(); // this is required to return a proper result
    }
    add_action( 'wp_ajax_nopriv_result_search', 'g5plus_result_search_callback' );
    add_action( 'wp_ajax_result_search', 'g5plus_result_search_callback' );

}



/*---------------------------------------------------
/* Panel Selector
/*---------------------------------------------------*/
if (!function_exists('g5plus_panel_selector_callback')) {
    function g5plus_panel_selector_callback() {
        g5plus_get_template('panel-selector');
        die();
    }
    add_action( 'wp_ajax_nopriv_panel_selector', 'g5plus_panel_selector_callback' );
    add_action( 'wp_ajax_panel_selector', 'g5plus_panel_selector_callback' );
}


/*---------------------------------------------------
/* Blog Comment Like
/*---------------------------------------------------*/
if (!function_exists('g5plus_blog_comment_like_callback')) {
    function g5plus_blog_comment_like_callback() {
        $id = $_REQUEST['id'];
        $like_count = get_comment_meta($id,'g5plus-like',true) == '' ? 0 : get_comment_meta($id,'g5plus-like',true);
        $like_count+=1;
        update_comment_meta($id,'g5plus-like',$like_count);
        echo json_encode($like_count);
        die();
    }
    add_action( 'wp_ajax_nopriv_blog_comment_like', 'g5plus_blog_comment_like_callback' );
    add_action( 'wp_ajax_blog_comment_like', 'g5plus_blog_comment_like_callback' );
}

/*---------------------------------------------------
/* Product Quick View
/*---------------------------------------------------*/
if (!function_exists('g5plus_product_quick_view_callback')) {
	function g5plus_product_quick_view_callback() {
		$product_id = $_REQUEST['id'];
		global $post, $product, $woocommerce;
		$post = get_post($product_id);
		setup_postdata($post);
		$product = wc_get_product( $product_id );
		wc_get_template_part('content-product-quick-view');
		wp_reset_postdata();
		die();
	}
	add_action( 'wp_ajax_nopriv_product_quick_view', 'g5plus_product_quick_view_callback' );
	add_action( 'wp_ajax_product_quick_view', 'g5plus_product_quick_view_callback' );
}



