<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
global $woocommerce_loop,$g5plus_woocommerce_loop;

$columns = $g5plus_woocommerce_loop['columns'];
if (!isset($columns) || empty($columns)) {
    $columns =  $woocommerce_loop['columns'];
}


$class = array();
$class[] = 'product-listing woocommerce clearfix';
$archive_product_layout =  isset($g5plus_woocommerce_loop['layout']) ? $g5plus_woocommerce_loop['layout'] : '';

if ($archive_product_layout == 'slider') {
    $class[] = 'product-slider';
} else {
    $class[] = 'columns-' . $columns;
}

$archive_product_style = isset($g5plus_woocommerce_loop['style']) ?  $g5plus_woocommerce_loop['style'] : 'classic-1';

$class[] = 'style-' . $archive_product_style;

$class_names = join(' ', $class);




if ($archive_product_layout == 'slider') {

    $data_plugin_options = '{"items" :' . $columns . ',"pagination" : false, "navigation" : true';

    switch ($columns) {
        case 3 :
            $data_plugin_options .= ',"itemsDesktop" : [1199,3],"itemsTablet" : [768, 3], "itemsTabletSmall": [600, 2]';
            break;
        case 2 :
            $data_plugin_options .= ',"itemsDesktop" : [1199,2], "itemsDesktopSmall" : [980,2]';
            break;
        case 1 :
            $data_plugin_options .= ',"singleItem": true';
            break;
        default:
            $data_plugin_options .= ',"itemsDesktop" : [1199,'.$columns.'], "itemsDesktopSmall" : [980,3], "itemsTablet" : [768, 3], "itemsTabletSmall": [600, 2]';
            break;
    }
    $data_plugin_options .= '}';
}

?>
<div class="<?php echo esc_attr($class_names); ?>">
<?php if ($archive_product_layout == 'slider') : ?>
<div class="owl-carousel" data-plugin-options='<?php echo wp_kses_post($data_plugin_options); ?>'>
<?php endif; ?>