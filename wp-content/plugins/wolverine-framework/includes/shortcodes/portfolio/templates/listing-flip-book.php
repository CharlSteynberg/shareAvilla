<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/19/15
 * Time: 5:31 PM
 */
$args = array(
    'posts_per_page' => $post_per_page,
    'orderby' => 'post_date',
    'order' => $order,
    'post_type' => G5PLUS_PORTFOLIO_POST_TYPE,
    G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY => strtolower($category),
    'post_status' => 'publish');


if($data_source==''){
    $args = array(
        'offset' => $offset,
        'posts_per_page' => $post_per_page,
        'orderby' => 'post_date',
        'order' => $order,
        'post_type' => G5PLUS_PORTFOLIO_POST_TYPE,
        G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY => strtolower($category),
        'post_status' => 'publish');
}

$posts_array = new WP_Query($args);
$total_post = $posts_array->found_posts;
$data_section_id = uniqid();
?>
<div
    class="portfolio overflow-hidden <?php echo esc_attr($g5plus_animation . ' ' . $styles_animation ) ?>"
    id="portfolio-<?php echo esc_attr($data_section_id) ?>">

    <div
        class="portfolio-wrapper bb-bookblock <?php echo sprintf('%s %s', $padding, $layout_type) ?>"
        data-section-id="<?php echo esc_attr($data_section_id) ?>"
        id="flips"
       >
        <?php
        $index = 0;

        while ($posts_array->have_posts()) : $posts_array->the_post();
            $index++;
            $permalink = get_permalink();
            $title_post = get_the_title();
            $terms = wp_get_post_terms(get_the_ID(), array(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));

            $post_thumbnail_id = get_post_thumbnail_id(  get_the_ID() );
            $thumbnail_url = '';
	        if (function_exists('matthewruddy_image_resize_id')) {
		        $thumbnail_url = matthewruddy_image_resize_id($post_thumbnail_id, 770,537);
	        }
            $bg_img_id = get_post_meta(get_the_ID(), 'portfolio-background-image', true );
            $arr_bg_img = wp_get_attachment_image_src( $bg_img_id, 'full' );
            $bg_img = '';
            if(count($arr_bg_img)>0)
                $bg_img = $arr_bg_img[0];

            include(plugin_dir_path(__FILE__) . '/loop/flip-book-item.php');

        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</div>

<div id="bb-menu-item-template" class="hidden">
   <?php include(plugin_dir_path(__FILE__) . '/loop/flip-book-first-item.php'); ?>
</div>

<div id="bb-search-item-template" class="hidden">
    <?php include(plugin_dir_path(__FILE__) . '/loop/flip-book-last-item.php'); ?>
</div>
<div id="section-portfolio-detail">

</div>
<?php

if(isset($detail_logo) && is_numeric($detail_logo)){
    $logo = wp_get_attachment_image_src($detail_logo,'full');
    if(isset($logo) && is_array($logo) ){
        $logo_url = $logo[0];
        ?>
        <span class="hidden" id="portfolio-detail-logo" data-logo-url="<?php echo esc_url($logo_url) ?>"></span>
    <?php       }
}
?>
<script type="text/javascript">
    "use strict";
    jQuery(document).ready(function(){
        Page.init('<?php echo esc_url(get_site_url() . '/wp-admin/admin-ajax.php') ?>');
    })
</script>


