<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/19/15
 * Time: 5:31 PM
 */
$args = array(
    'orderby' =>'post__in',
    'post__in' => explode(",",$portfolio_ids),
    'posts_per_page' => -1,
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
$col_class = '';
$col_class = 'wolverine-col-md-' . $column;
$data_section_id = uniqid();
$paging_style = $show_pagging == 2 ? 'slider' : 'paging';

?>
<div
    class="portfolio overflow-hidden <?php echo esc_attr($g5plus_animation . ' ' . $styles_animation) ?>"
    id="portfolio-<?php echo esc_attr($data_section_id) ?>">
    <div
        class="portfolio-wrapper <?php echo sprintf('%s %s %s', $col_class, $padding, $layout_type) ?>"
        data-section-id="<?php echo esc_attr($data_section_id) ?>"
        id="portfolio-container-<?php echo esc_attr($data_section_id) ?>"
        data-columns="<?php echo esc_attr($column) ?>">
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
            include(plugin_dir_path(__FILE__) . '/loop/' . $layout_type . '-item.php');
            ?>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>

    </div>
    <?php if ($show_pagging == '1' && $post_per_page > 0 && $total_post / $post_per_page > 1 && $total_post > ($post_per_page * $current_page)) { ?>
        <div style="clear: both"></div>
        <div class="paging" id="load-more-<?php echo esc_attr($data_section_id) ?>">
            <a href="javascript:;" class="button-sm load-more bold-color primary-color-hover secondary-font"
               data-source = "<?php echo esc_attr($data_source) ?>"
               data-category="<?php echo esc_attr($category) ?>"
               data-portfolio-ids ="<?php echo esc_attr($portfolio_ids) ?>"
               data-loading-text="<i class='fa fa-refresh fa-spin'></i> <?php _e("Loading...", 'wolverine'); ?>"
               data-section-id="<?php echo esc_attr($data_section_id) ?>"
               data-current-page="<?php echo esc_attr($current_page + 1) ?>"
               data-offset="<?php echo esc_attr($offset) ?>"
               data-post-per-page="<?php echo esc_attr($post_per_page) ?>"
               data-overlay-style="<?php echo esc_attr($overlay_style) ?>"
               data-column="<?php echo esc_attr($column); ?>"
               data-padding="<?php echo esc_attr($padding) ?>"
               data-layout-type="<?php echo esc_attr($layout_type) ?>"
               data-order="<?php echo esc_attr($order) ?>"
                ><?php _e('SHOW MORE', 'wolverine') ?></a>
        </div>
    <?php } ?>

</div>

<script type="text/javascript">
    (function ($) {
        "use strict";
        <?php if($show_pagging!='2') {?>
        $(document).ready(function () {
            $('.isotope-portfolio', '.portfolio-tabs').off();
            $('.isotope-portfolio', '.portfolio-tabs').click(function () {
                $('.isotope-portfolio', '.portfolio-tabs').removeClass('active');
                $('li', '.portfolio-tabs').removeClass('active');
                $(this).addClass('active');
                $(this).parent().addClass('active');
                var dataSectionId = $(this).attr('data-section-id');
                var filter = $(this).attr('data-filter');
                var $container = jQuery('div[data-section-id="' + dataSectionId + '"]').isotope({ filter: filter});
                $container.imagesLoaded(function () {
                    $container.isotope('layout');
                });
            });
            var $container = jQuery('div[data-section-id="<?php echo esc_attr($data_section_id); ?>"]');
            $container.imagesLoaded(function () {
                $container.isotope({
                    itemSelector: '.portfolio-item'
                }).isotope('layout');
            });
        });

        <?php } ?>

        $(document).ready(function () {
            <?php if (g5framework_is_enable_hover_dir($overlay_style)) {?>
            $('.portfolio-item.hover-dir > div.entry-thumbnail').hoverdir();
            <?php } ?>
            PortfolioAjaxAction.init('<?php echo esc_url(get_site_url() . '/wp-admin/admin-ajax.php') ?>');
        })

    })(jQuery);
</script>


