<?php
$product_quick_view = g5plus_get_option('product_quick_view',1);
if ($product_quick_view == 0) {
    return;
}
?>
<a data-toggle="tooltip" data-placement="top" title="<?php echo __('Quick view', 'wolverine') ?>" class="product-quick-view" data-product_id="<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><i class="wicon icon-search-icon"></i></a>

