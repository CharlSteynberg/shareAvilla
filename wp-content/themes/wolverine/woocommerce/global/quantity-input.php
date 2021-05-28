<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
	?>
    <div class="quantity hidden">
        <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
    </div>
	<?php
} else {
	/* translators: %s: Quantity. */
	$labelledby = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'wolverine' ), strip_tags( $args['product_name'] ) ) : '';
	?>
    <div class="quantity">
        <div class="quantity-inner">
            <span><?php _e('Quantity:','wolverine') ?></span>
            <button class="btn-number" data-type="minus">
                <i class="fa fa-caret-down"></i>
            </button>
            <input type="text" step="<?php echo esc_attr($step); ?>"
			       <?php if (is_numeric($min_value)) : ?>min="<?php echo esc_attr($min_value); ?>"<?php endif; ?>
			       <?php if (is_numeric($max_value)) : ?>max="<?php echo esc_attr($max_value); ?>"<?php endif; ?>
                   name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>"
                   title="<?php _ex('Qty', 'Product quantity input tooltip', 'wolverine') ?>" class="input-text qty text"
                   size="4"/>
            <button class="btn-number" data-type="plus">
                <i class="fa fa-caret-up"></i>
            </button>
        </div>
    </div>
	<?php
}
