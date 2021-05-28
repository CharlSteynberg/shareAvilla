<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<?php if (!$product->is_in_stock()): ?>
	<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->get_id() ) ); ?>" class="product_type_soldout" data-toggle="tooltip" data-placement="top" title="<?php _e('Sold out','wolverine'); ?>"><i class="wicon icon-svg-icon-14"></i></a>
<?php else: ?>
	<?php
	$icon_class = '';
	$product_type = apply_filters( 'woocommerce_add_to_cart_handler', $product->get_type(), $product );
	switch ($product_type) {
		case 'variable':
			$icon_class = 'wicon icon-svg-icon-12';
			break;
		case 'grouped':
			$icon_class = 'wicon icon-svg-icon-13';
			break;
		case 'external':
			$icon_class = 'fa fa-info';
			break;
		default:
			if ( $product->is_purchasable() && $product->get_type() != "booking" ) {
				$icon_class = 'wicon icon-svg-icon-15';
			} else {
				$icon_class = 'wicon icon-svg-icon-14';
			}
			break;
	}

	global $g5plus_woocommerce_loop;
	$archive_product_style = isset($g5plus_woocommerce_loop['style']) ? $g5plus_woocommerce_loop['style'] : 'classic-1';
	?>
	<div class="add-to-cart-wrap" data-style="<?php echo esc_attr($archive_product_style) ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($product->add_to_cart_text()); ?>">
		<?php
		echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
			sprintf( '<a href="%s" data-quantity="%s" class="%s" %s><i class="%s"></i></a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
				esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
				isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
				esc_attr( $icon_class )
			),
			$product, $args );
		?>
	</div>
<?php endif;
