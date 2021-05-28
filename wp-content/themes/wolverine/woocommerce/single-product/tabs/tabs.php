<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$index = 0;
if ( ! empty( $tabs ) ) : ?>


	<div class="panel-group" id="woocommerce-tabs" role="tablist" aria-multiselectable="true">
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="heading<?php echo esc_attr($key);?>">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#woocommerce-tabs" href="#<?php echo esc_attr($key) ?>" aria-expanded="<?php echo esc_attr($index == 0 ? 'true' : 'false');?>" aria-controls="<?php echo esc_attr($key) ?>">
							<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
						</a>
					</h4>
				</div>
				<div id="<?php echo esc_attr($key) ?>" class="panel-collapse collapse<?php echo esc_attr($index == 0 ? ' in' : '');?>" role="tabpanel" aria-labelledby="heading<?php echo esc_attr($key); ?>">
					<div class="panel-body">
						<?php call_user_func( $tab['callback'], $key, $tab ) ?>
					</div>
				</div>
			</div>
			<?php $index++; ?>

		<?php endforeach; ?>
	</div>

<?php endif; ?>
