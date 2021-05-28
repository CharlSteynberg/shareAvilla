<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $g5plus_woocommerce_loop;

$related_product_display_columns = isset($_GET['columns']) ? $_GET['columns'] : '';
if (!in_array($related_product_display_columns, array('3','4','5','6'))) {
	$related_product_display_columns = g5plus_get_option('related_product_display_columns',4);
}

$related_product_style = g5plus_get_option('related_product_style','classic-3');
$g5plus_woocommerce_loop['style'] = $related_product_style;
$g5plus_woocommerce_loop['rating'] = 0;

$g5plus_woocommerce_loop['columns'] = $related_product_display_columns;
$g5plus_woocommerce_loop['layout'] = 'slider';

if ( $upsells ) : ?>

	<div class="upsells products">

		<h4 class="widget-title"><span><?php _e( 'You may also like&hellip;', 'wolverine' ) ?></span></h4>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				 	$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
