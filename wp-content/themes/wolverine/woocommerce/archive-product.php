<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce_loop,$g5plus_woocommerce_loop;

$archive_product_style = isset($_GET['style']) ? $_GET['style'] : '';
if (!in_array($archive_product_style, array('classic-1','classic-2','classic-3','creative','creative-2'))) {
	$archive_product_style = g5plus_get_option('archive_product_style','classic-1');
}




$layout_style = isset($_GET['layout']) ? $_GET['layout'] : '';
if (!in_array($layout_style, array('full','container','container-fluid'))) {
    $layout_style = g5plus_get_option('archive_product_layout','container');
}

$sidebar = isset($_GET['sidebar']) ? $_GET['sidebar'] : '';
if (!in_array($sidebar, array('none','left','right','both'))) {
    $sidebar = g5plus_get_option('archive_product_sidebar','right');
}

$sidebar_width = isset($_GET['sidebar_width']) ? $_GET['sidebar_width'] : '';
if (!in_array($sidebar_width, array('small','large'))) {
    $sidebar_width = g5plus_get_option('archive_product_sidebar_width','small');
}

$left_sidebar = g5plus_get_option('archive_product_left_sidebar','woocommerce');
$right_sidebar = g5plus_get_option('archive_product_right_sidebar','woocommerce');

$archive_display_columns = 3;
$archive_display_columns = isset($_GET['columns']) ? $_GET['columns'] : '';
if (!in_array($archive_display_columns, array('2','3','4','5','6'))) {
    $archive_display_columns = g5plus_get_option('product_display_columns',4);
}

$product_rating = isset($_GET['rating']) ? $_GET['rating'] : '';
if (!in_array($product_rating,array(0,1))) {
	$product_rating = g5plus_get_option('product_show_rating',1);
}

$sidebar_col = 'col-md-3';
if ($sidebar_width == 'large') {
    $sidebar_col = 'col-md-4';
}

$content_col_number = 12;

if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'both') || ($sidebar == 'left'))) {
    if ($sidebar_width == 'large') {
        $content_col_number -= 4;
    }
    else {
        $content_col_number -= 3;
    }
}
if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'both') || ($sidebar == 'right'))) {
    if ($sidebar_width == 'large') {
        $content_col_number -= 4;
    }
    else {
        $content_col_number -= 3;
    }
}

$content_col = 'col-md-' . $content_col_number;
if (($content_col_number == 12) && ($layout_style == 'full')) {
    $content_col = '';
}



$archive_class = array('archive-product-wrap','clearfix');
$archive_class[] = 'layout-' . $layout_style;

get_header( 'shop' ); ?>
<?php
/**
 * @hooked - g5plus_archive_product_heading - 5
 **/
do_action('g5plus_before_archive_product');
?>
<main  class="site-content-archive-product">
    <?php
    /**
     * @hooked - g5plus_shop_page_content - 5
     **/
    do_action('g5plus_before_archive_product_listing');
    ?>

    <?php if ($layout_style != 'full'): ?>
        <div class="<?php echo esc_attr($layout_style) ?> clearfix">
    <?php endif;?>

            <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
                <div class="row clearfix">
            <?php endif;?>

                    <?php if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'left') || ($sidebar == 'both'))): ?>
                        <div class="sidebar woocommerce-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs sidebar-<?php echo esc_attr($sidebar_width); ?>">
                            <?php dynamic_sidebar( $left_sidebar );?>
                        </div>
                    <?php endif;?>

                    <div class="<?php echo esc_attr($content_col) ?>">
                        <div class="<?php echo join(' ',$archive_class); ?>">

	                        <?php
	                        /**
	                         * Hook: woocommerce_archive_description.
	                         *
	                         * @hooked woocommerce_taxonomy_archive_description - 10
	                         * @hooked woocommerce_product_archive_description - 10
	                         */
	                        do_action( 'woocommerce_archive_description' );
	                        ?>

                            <?php
	                        if ( woocommerce_product_loop() ) {

		                        /**
		                         * Hook: woocommerce_before_shop_loop.
		                         *
		                         * @hooked wc_print_notices - 10
		                         * @hooked woocommerce_result_count - 20
		                         * @hooked woocommerce_catalog_ordering - 30
		                         */
		                        do_action( 'woocommerce_before_shop_loop' );
		                        $g5plus_woocommerce_loop['style'] = $archive_product_style;
		                        $g5plus_woocommerce_loop['columns'] = $archive_display_columns;
		                        $g5plus_woocommerce_loop['rating'] = $product_rating;

		                        woocommerce_product_loop_start();

		                        if ( wc_get_loop_prop( 'total' ) ) {
			                        while ( have_posts() ) {
				                        the_post();

				                        /**
				                         * Hook: woocommerce_shop_loop.
				                         *
				                         * @hooked WC_Structured_Data::generate_product_data() - 10
				                         */
				                        do_action( 'woocommerce_shop_loop' );

				                        wc_get_template_part( 'content', 'product' );
			                        }
		                        }

		                        woocommerce_product_loop_end();

		                        /**
		                         * Hook: woocommerce_after_shop_loop.
		                         *
		                         * @hooked woocommerce_pagination - 10
		                         */
		                        do_action( 'woocommerce_after_shop_loop' );
	                        } else {
		                        /**
		                         * Hook: woocommerce_no_products_found.
		                         *
		                         * @hooked wc_no_products_found - 10
		                         */
		                        do_action( 'woocommerce_no_products_found' );
	                        }


                            ?>
                        </div>
                    </div>

                    <?php if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'right') || ($sidebar == 'both'))): ?>
                        <div class="sidebar woocommerce-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs sidebar-<?php echo esc_attr($sidebar_width); ?>">
                            <?php dynamic_sidebar( $right_sidebar );?>
                        </div>
                    <?php endif;?>
            <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
                </div>
            <?php endif;?>

    <?php if ($layout_style != 'full'): ?>
        </div>
    <?php endif;?>
    <?php
        /**
         * @hooked - g5plus_shop_page_content - 5
         **/
        do_action('g5plus_after_archive_product_listing');
    ?>
</main>
<?php get_footer( 'shop' ); ?>
