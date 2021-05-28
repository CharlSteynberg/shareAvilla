<?php
$primary_color = g5plus_framework_get_option('primary_color','#995958');

$args = array(
    'offset' => $offset,
    'orderby' =>'post__in',
    'post__in' => explode(",",$portfolio_ids),
    'posts_per_page' => $post_per_page,
    'post_type' => G5PLUS_PORTFOLIO_POST_TYPE,
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

$paging_style = $show_pagging == 2 ? 'slider' : 'paging';
$data_section_id = uniqid();
?>
<div
    class="portfolio overflow-hidden <?php echo esc_attr($g5plus_animation . ' ' . $styles_animation . ' ' . $paging_style) ?>"
    id="portfolio-<?php echo esc_attr($data_section_id) ?>">
    <div class="portfolio-wrapper <?php echo sprintf('%s %s', $padding, $layout_type) ?>" data-columns="<?php echo esc_attr($column) ?>">
        <?php
        $index = 0;

        while ($posts_array->have_posts()) : $posts_array->the_post();
            $index++;
            $permalink = get_permalink();
            $title_post = get_the_title();
            $terms = wp_get_post_terms(get_the_ID(), array(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));
            $cat = $cat_filter = '';
            foreach ($terms as $term) {
                $cat_filter .= preg_replace('/\s+/', '', $term->name) . ' ';
                $cat .= $term->name . ', ';
            }
            $cat = rtrim($cat, ', ');

            ?>

            <?php
                include(plugin_dir_path(__FILE__) . '/loop/one-page-item.php');
            ?>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>

    </div>

</div>

<script type="text/javascript">
    (function ($) {
        "use strict";
        $(document).ready(function () {
            <?php if (g5framework_is_enable_hover_dir($overlay_style)) {?>
            $('.portfolio-item.hover-dir > div.entry-thumbnail').hoverdir();
            <?php } ?>
        })

    })(jQuery);
</script>


