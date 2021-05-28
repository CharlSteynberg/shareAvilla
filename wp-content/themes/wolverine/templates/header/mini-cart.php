<?php
$icon_shopping_cart_class = array('shopping-cart-wrapper', 'header-customize-item');
$mobile_header_shopping_cart = g5plus_get_option('mobile_header_shopping_cart','1');
if ($mobile_header_shopping_cart == '0') {
	$icon_shopping_cart_class[] = 'mobile-hide-shopping-cart';
}
?>
<div class="<?php echo join(' ', $icon_shopping_cart_class); ?>">
	<div class="widget_shopping_cart_content">
		<?php get_template_part('woocommerce/cart/mini-cart'); ?>
	</div>
</div>