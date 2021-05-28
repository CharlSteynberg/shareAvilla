<?php
$show_page_title = g5plus_get_option('show_archive_product_title','1');

$prefix = 'g5plus_';

$page_sub_title = strip_tags(term_description());

//archive
$page_title_bg_image = '';
$page_title_height = '';
$cat = get_queried_object();
if ($cat && property_exists( $cat, 'term_id' )) {
    $page_title_bg_image = g5plus_get_tax_meta($cat->term_id,$prefix.'page_title_background');
    $page_title_height = g5plus_get_tax_meta($cat->term_id,$prefix.'page_title_height');
}

if(!$page_title_bg_image || $page_title_bg_image === '') {
    $page_title_bg_image = g5plus_get_option('archive_product_title_bg_image',array(
	    'url' => THEME_URL . 'assets/images/bg-page-title.jpg'
    ));
}

if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {
    $page_title_bg_image_url = $page_title_bg_image['url'];
}


$breadcrumbs_in_page_title = g5plus_get_option('breadcrumbs_in_archive_product_title','0');
$product_show_result_count = g5plus_get_option('product_show_result_count','1');
$product_show_catalog_ordering = g5plus_get_option('product_show_catalog_ordering','1');
$breadcrumb_class = array('breadcrumb-wrap page-title-margin-bottom breadcrumb-archive-product-wrap');

if (($product_show_result_count == 0) && ($product_show_catalog_ordering == 0) ) {
	$breadcrumb_class[] = 'catalog-filter-visible';
} else {
	if ($product_show_result_count == 0) {
		$breadcrumb_class[] = 'result-count-visible';
	}

	if ($product_show_catalog_ordering == 0) {
		$breadcrumb_class[] = 'catalog-ordering-visible';
	}
}




$class = array();
$class[] = 'page-title-wrap archive-product-title-height';

$custom_styles = array();

if ($page_title_bg_image_url != '') {
    $class[] = 'page-title-wrap-bg';
    $custom_styles[] = 'background-image: url(' . $page_title_bg_image_url . ');';
}

if (($page_title_height != '') && ($page_title_height > 0)) {
    $custom_styles[] = 'height:' . $page_title_height . 'px';
}

if ($breadcrumbs_in_page_title != 1 && $product_show_result_count != 1 && $product_show_catalog_ordering != 1) {
    $class[] = 'page-title-margin-bottom';
}



$custom_style= '';
if ($custom_styles) {
    $custom_style = 'style="'. join(';',$custom_styles).'"';
}

$page_title_parallax = g5plus_get_option('archive_product_title_parallax','0');

if (!empty($page_title_bg_image_url) && ($page_title_parallax == '1')) {
    $custom_style.= ' data-stellar-background-ratio="0.5"';
    $class[] = 'page-title-parallax';
}

$page_title_text_align = g5plus_get_option('archive_product_title_text_align','left');
if (!isset($page_title_text_align) || empty($page_title_text_align)) {
    $page_title_text_align = 'left';
}
$class[] = 'page-title-' . $page_title_text_align;

$class_name = join(' ', $class);
?>


<?php if ($show_page_title == 1) : ?>
    <section class="<?php echo esc_attr($class_name) ?>" <?php echo wp_kses_post($custom_style); ?>>
        <div class="page-title-overlay"></div>
        <div class="container">
            <div class="page-title-inner block-center">
                <div class="block-center-inner">
                    <h1><?php woocommerce_page_title(); ?></h1>
                    <?php if ($page_sub_title != '') : ?>
                        <span class="page-sub-title"><?php echo esc_html($page_sub_title) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if ($breadcrumbs_in_page_title == 1 || $product_show_result_count == 1 || $product_show_catalog_ordering == 1) : ?>
    <section class="<?php echo join(' ',$breadcrumb_class); ?>">
        <div class="container">
            <?php g5plus_the_breadcrumb(); ?>
	        <div class="catalog-filter clearfix">
		        <?php
		        /**
		         * woocommerce_before_shop_loop hook
		         *
		         * @hooked woocommerce_result_count - 20
		         * @hooked woocommerce_catalog_ordering - 30
		         */
		        do_action( 'g5plus_before_shop_loop' );
		        ?>
	        </div>
        </div>
    </section>
<?php endif; ?>
