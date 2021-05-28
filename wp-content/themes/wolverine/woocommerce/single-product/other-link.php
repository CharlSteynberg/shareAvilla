<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/6/2015
 * Time: 1:42 PM
 */
$continue_shopping =  get_permalink( wc_get_page_id( 'shop' ) );
$checkout_url = wc_get_checkout_url();
?>
<div class="single-product-other-link text-center">
	<a class="wolverine-button style2 button-4x" href="<?php echo esc_url($continue_shopping); ?>"><?php _e('Back To Shop','wolverine') ?></a>
	<a class="wolverine-button style3 button-4x" href="<?php echo esc_url($checkout_url); ?>"><?php _e('Checkout','wolverine') ?></a>
</div>