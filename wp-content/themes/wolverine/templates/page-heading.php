<?php
global $post;
$prefix = 'g5plus_';
$show_page_title =  g5plus_rwmb_meta($prefix.'show_page_title');
if (($show_page_title == -1) || ($show_page_title === '') || ($show_page_title === false)) {

    $show_page_title = g5plus_get_option('show_page_title','1');

    if (is_singular('product')) {
        $show_page_title = g5plus_get_option('show_single_product_title','1');
    }

    else if (is_singular('portfolio')) {
        $show_page_title = g5plus_get_option('show_portfolio_title','1');
    }

    else if (is_singular('post')) {
        $show_page_title = g5plus_get_option('show_single_blog_title','1');
    }

}


$page_title = g5plus_rwmb_meta($prefix.'page_title_custom');
if ($page_title == '') {

    if (is_singular('post')) {
        $page_title = esc_html__('Blog','wolverine');
    } else {
	    $page_title = get_the_title();
    }


}

if(is_404()){
    $page_title = g5plus_get_option('page_title_404',esc_html__('Error 404 - not found','wolverine'));
}
$page_sub_title = g5plus_rwmb_meta($prefix.'page_subtitle_custom');
if(is_404()){
    $page_sub_title = g5plus_get_option('sub_page_title_404');
}

$page_title_text_color = g5plus_rwmb_meta($prefix.'page_title_text_color','type=color',get_the_ID());


$page_title_bg_color = g5plus_rwmb_meta($prefix.'page_title_bg_color','type=color',get_the_ID());



$enable_custom_page_title_bg_image = g5plus_rwmb_meta($prefix.'enable_custom_page_title_bg_image');
if ($enable_custom_page_title_bg_image == '1') {
    $page_title_bg_images = g5plus_rwmb_meta($prefix.'page_title_bg_image','type=image&size=full',get_the_ID());
    if ($page_title_bg_images) {
        $page_title_bg_image_id = g5plus_get_post_meta(get_the_ID(),$prefix.'page_title_bg_image',true);
        $page_title_bg_image = $page_title_bg_images[$page_title_bg_image_id];
    }
} else {
    $page_title_bg_image = g5plus_get_option('page_title_bg_image',array(
	    'url' => THEME_URL . 'assets/images/bg-page-title.jpg'
    ));

    if (is_singular('product')) {
        $page_title_bg_image = g5plus_get_option('single_product_title_bg_image', array(
	        'url' => THEME_URL . 'assets/images/bg-page-title.jpg'
        ));
    }

    else if (is_singular('portfolio')) {
        $page_title_bg_image = g5plus_get_option('portfolio_title_bg_image', array(
	        'url' => THEME_URL . 'assets/images/bg-page-title.jpg'
        ));
    }


    else if (is_singular('post')) {
        $page_title_bg_image = g5plus_get_option('single_blog_title_bg_image', array(
	        'url' => THEME_URL . 'assets/images/bg-page-title.jpg'
        ));
    }
    if(is_404()){
        $page_title_bg_image = g5plus_get_option('page_404_bg_image', array(
	        'url' => THEME_URL . 'assets/images/bg-page-title.jpg'
        ));
    }
}

if (is_array($page_title_bg_image) && isset($page_title_bg_image['url'])) {
	$page_title_bg_image_url = $page_title_bg_image['url'];
}

$page_title_overlay_color = g5plus_rwmb_meta($prefix.'page_title_overlay_color','type=color',get_the_ID());
$page_title_overlay_opacity = '';
$enable_custom_overlay_opacity = g5plus_rwmb_meta($prefix.'enable_custom_overlay_opacity','type=checkbox',get_the_ID());
if ($enable_custom_overlay_opacity == 1) {
    $page_title_overlay_opacity = g5plus_rwmb_meta($prefix.'page_title_overlay_opacity','type=slider',get_the_ID()) / 100;
}

$page_title_height = g5plus_rwmb_meta($prefix.'page_title_height');

$breadcrumbs_in_page_title = g5plus_rwmb_meta($prefix.'breadcrumbs_in_page_title');
if (($breadcrumbs_in_page_title == -1) || ($breadcrumbs_in_page_title === '') || ($breadcrumbs_in_page_title === false) ) {
	$breadcrumbs_in_page_title = g5plus_get_option('breadcrumbs_in_page_title','1');

    if (is_singular('product')) {
        $breadcrumbs_in_page_title = g5plus_get_option('breadcrumbs_in_single_product_title','1');

    }

    else if (is_singular('portfolio')) {
        $breadcrumbs_in_page_title = g5plus_get_option('breadcrumbs_in_portfolio_title','0');
    }

    else if (is_singular('post')) {
        $breadcrumbs_in_page_title = g5plus_get_option('breadcrumbs_in_single_blog_title','1');
    }
}
if(is_404()){
    $breadcrumbs_in_page_title = 0;
}

$class = array('page-title-wrap');

if (is_singular('product')) {
    $class[] = 'single-product-title-height';
}

else if (is_singular('portfolio')) {
    $class[] = 'portfolio-title-height';
}

else if (is_singular('post')) {
    $class[] = 'single-blog-title-height';
} else {
    $class[] = 'page-title-height';
}






$breadcrumb_class = array('breadcrumb-wrap');

$custom_styles = array();

if ($page_title_bg_image_url != '') {
	$class[] = 'page-title-wrap-bg';
    $custom_styles[] = 'background-image: url(' . $page_title_bg_image_url . ')';
}

if ($page_title_bg_color != '') {
    $custom_styles[] = 'background-color:' . $page_title_bg_color;
}

$custom_text_color_styles = array();
if($page_title_text_color != '') {
    $custom_text_color_styles[] = 'color:' . $page_title_text_color;
}


if (($page_title_height != '') && ($page_title_height > 0)) {
    $custom_styles[] = 'height:' . $page_title_height . 'px';
}

$page_title_remove_margin_bottom = g5plus_rwmb_meta($prefix.'page_title_remove_margin_bottom');
if ($page_title_remove_margin_bottom) {
    $class[] = 'page-title-no-margin-bottom';
	$breadcrumb_class[] = 'page-title-no-margin-bottom';
} else {
    if ($breadcrumbs_in_page_title == 0) {
        $class[] = 'page-title-margin-bottom';
    } else {
        $breadcrumb_class[] = 'page-title-margin-bottom';
    }
}

$custom_style= '';
if ($custom_styles) {
    $custom_style = 'style="'. join(';',$custom_styles).'"';
}



$page_title_parallax = g5plus_rwmb_meta($prefix.'page_title_parallax');
if (!isset($page_title_parallax) || ($page_title_parallax == '') || ($page_title_parallax == '-1')) {
    $page_title_parallax = g5plus_get_option('page_title_parallax','0');

    if (is_singular('product')) {
        $page_title_parallax = g5plus_get_option('single_product_title_parallax','0');

    }

    else if (is_singular('portfolio')) {
        $page_title_parallax = g5plus_get_option('portfolio_title_parallax','0');
    }

    else if (is_singular('post')) {
        $page_title_parallax = g5plus_get_option('single_blog_title_parallax','0');
    }
}

if (!empty($page_title_bg_image_url) && ($page_title_parallax == '1')) {
    $custom_style.= ' data-stellar-background-ratio="0.5"';
    $class[] = 'page-title-parallax';
}

$page_title_text_align = g5plus_rwmb_meta($prefix . 'page_title_text_align');
if(!isset($page_title_text_align) || ($page_title_text_align == '') || ($page_title_text_align == '-1')) {
    $page_title_text_align = g5plus_get_option('page_title_text_align','left');

    if (is_singular('product')) {
        $page_title_text_align = g5plus_get_option('single_product_title_text_align','left');

    }

    else if (is_singular('portfolio')) {
        $page_title_text_align = g5plus_get_option('portfolio_title_text_align','left');
    }

    else if (is_singular('post')) {
        $page_title_text_align = g5plus_get_option('single_blog_title_text_align','left');
    }
}
if (!isset($page_title_text_align) || empty($page_title_text_align)) {
    $page_title_text_align = 'left';
}

$class[] = 'page-title-' . $page_title_text_align;


$custom_overlay_styles = array();
if ($page_title_overlay_color != '') {
    $custom_overlay_styles[] = 'background-color:' . $page_title_overlay_color;
}

if ($page_title_overlay_opacity != '') {
    $custom_overlay_styles[] = 'opacity:' . $page_title_overlay_opacity;
}
$custom_overlay_style= '';
if ($custom_overlay_styles) {
    $custom_overlay_style = 'style="'. join(';',$custom_overlay_styles).'"';
}

$custom_text_color_style = '';
if ($custom_text_color_styles) {
    $custom_text_color_style = 'style="'. join(';',$custom_text_color_styles).'"';
}

$class_name = join(' ', $class);


$page_sub_title_text_color = g5plus_rwmb_meta($prefix.'page_sub_title_text_color','type=color',get_the_ID());
$custom_text_sub_title_color_styles = array();
if($page_sub_title_text_color != '') {
    $custom_text_sub_title_color_styles[] = 'color:' . $page_sub_title_text_color;
}
$custom_text_sub_title_color_style = '';
if ($custom_text_sub_title_color_styles) {
    $custom_text_sub_title_color_style = 'style="'. join(';',$custom_text_sub_title_color_styles).'"';
}


?>

<?php if ($show_page_title == 1) : ?>
    <section  class="<?php echo esc_attr($class_name) ?>" <?php echo wp_kses_post($custom_style); ?>>
        <div class="page-title-overlay" <?php echo wp_kses_post($custom_overlay_style);?>></div>
        <div class="container">
            <div class="page-title-inner block-center">
                <div class="block-center-inner">
                    <h1 <?php echo wp_kses_post($custom_text_color_style); ?>><?php echo esc_html($page_title); ?></h1>
                    <?php if ($page_sub_title != '') : ?>
                    <span <?php echo wp_kses_post($custom_text_sub_title_color_style); ?> class="page-sub-title"><?php echo esc_html($page_sub_title) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if ($breadcrumbs_in_page_title == 1) : ?>
    <section class="<?php echo join(' ',$breadcrumb_class) ?>">
        <div class="container">
            <?php g5plus_the_breadcrumb(); ?>
        </div>
    </section>
<?php endif; ?>