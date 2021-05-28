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
$col_class = '';
$col_class = 'wolverine-col-md-' . $column;
$data_section_id = uniqid();
$paging_style = $show_pagging == 2 ? 'slider' : 'paging';

?>
<div
    class="portfolio overflow-hidden <?php echo esc_attr($g5plus_animation . ' ' . $styles_animation . ' ' . $paging_style) ?>"
    id="portfolio-<?php echo esc_attr($data_section_id) ?>">
    <?php if ($show_category != '') { ?>
    <div class="portfolio-tabs <?php if(isset($category_position) && $category_position=='in-breadcrumbs'){ echo 'tabs-hidden';} ?>">
        <?php
            $termIds = array();
            $portfolio_terms = get_terms(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY);
            if($category!=''){
                $slugSelected = explode(',',$category);
                foreach ($portfolio_terms as $term) {
                    if(in_array($term->slug,$slugSelected))
                        $termIds[$term->term_id] = $term->term_id;
                }
            }
            $array_terms = array(
                'include' => $termIds
            );
            $terms = get_terms(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY, $array_terms);

            if (count($terms) > 0) {
                $index = 1;
                ?>
                <div
                    class="tab-wrapper line-height-1 <?php echo esc_attr($show_category) ?> <?php if ($show_title == $show_category) {
                        echo esc_attr('isolation');
                    } ?>">
                    <ul>
                        <?php if(isset($category_position) && $category_position=='in-breadcrumbs') { ?>
                            <li>
                                <span><?php echo __('Sort Portfolio:','wolverine') ?></span>
                            </li>
                        <?php } ?>

                        <li class="active">
                            <a class="isotope-portfolio ladda-button semi-bold text-color bold-color-hover active"
                               data-section-id="<?php echo esc_attr($data_section_id) ?>"
                               data-group="all" data-filter="*" data-layout-type="<?php echo esc_attr($layout_type) ?>"
                               data-order="<?php echo esc_attr($order) ?>"
                               data-column="<?php echo esc_attr($column) ?>"
                               data-overlay-style="<?php echo esc_attr($overlay_style) ?>"
                               data-style="zoom-out" data-spinner-color="<?php echo esc_attr($primary_color) ?>"
                               href="javascript:;">
                                <?php echo __('All', 'wolverine') ?>
                            </a>
                        </li>
                        <li class="none-magic-line">|</li>
                        <?php
                        foreach ($terms as $term) {
                            ?>
                            <li class="<?php if ($index == count($terms)) {
                                echo "last";
                            } ?>">
                                <a class="isotope-portfolio ladda-button semi-bold text-color bold-color-hover"
                                   href="javascript:;" data-section-id="<?php echo esc_attr($data_section_id) ?>"
                                   data-layout-type="<?php echo esc_attr($layout_type) ?>"
                                   data-column="<?php echo esc_attr($column) ?>"
                                   data-order="<?php echo esc_attr($order) ?>"
                                   data-group="<?php echo preg_replace('/\s+/', '', $term->slug) ?>"
                                   data-filter=".<?php echo preg_replace('/\s+/', '', $term->name) ?>"
                                   data-overlay-style="<?php echo esc_attr($overlay_style) ?>" data-style="zoom-out"
                                   data-spinner-color="<?php echo esc_attr($primary_color) ?>">
                                    <?php echo wp_kses_post($term->name) ?>
                                </a>
                            </li>
                            <?php if ($index++ != count($terms)) { ?>
                                <li class="none-magic-line">|</li>
                            <?php } ?>
                        <?php } ?>
                        <?php if(isset($category_position) && $category_position=='in-breadcrumbs') { ?>
                            <li class="back-to-home">
                                <a href="<?php echo get_home_url() ?>"><?php echo __('Back to home','wolverine') ?> <i class="fa fa-angle-right"></i></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

            <?php
            }
        ?>
    </div>
    <?php } ?>
    <?php
    $data_plugin_options = $owl_carousel_class = '';
    if ($show_pagging == '2' && $total_post / $item > 1) {
        $data_plugin_options = 'data-plugin-options=\'{ "items" : ' . $column . ',"pagination": false, "navigation": true, "autoPlay": false}\'';
        $owl_carousel_class = 'owl-carousel';
    }
    ?>
    <div
        class="portfolio-wrapper <?php echo sprintf('%s %s %s %s', $col_class, $padding, $layout_type, $owl_carousel_class) ?>" <?php echo wp_kses_post($data_plugin_options) ?>
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
               data-loading-text="<i class='fa fa-refresh fa-spin'></i> <?php _e("Loading...", 'wolverine'); ?>"
               data-source = "<?php echo esc_attr($data_source) ?>"
               data-category="<?php echo esc_attr($category) ?>"
               data-portfolio-ids ="<?php echo esc_attr($portfolio_ids) ?>"
               data-section-id="<?php echo esc_attr($data_section_id) ?>"
               data-current-page="<?php echo esc_attr($current_page + 1) ?>"
               data-offset="<?php echo esc_attr($offset) ?>"
               data-current-page = "<?php echo esc_attr($current_page) ?>"
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
        <?php if(isset($category_position) && $category_position=='in-breadcrumbs'){ ?>
        $('.breadcrumbs','.breadcrumb-wrap').css('opacity','0');
        <?php } ?>

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

            <?php if(isset($category_position) && $category_position=='in-breadcrumbs'){ ?>

            var $containerTabs = $('#portfolio-<?php echo esc_attr($data_section_id); ?>');
            var $tabs = $('.portfolio-tabs', $containerTabs);
            if($('section.breadcrumb-wrap').length>0){
                var breadcrumnsContainer = $('.breadcrumbs','.breadcrumb-wrap').parent();
                $(breadcrumnsContainer).empty();
                $(breadcrumnsContainer).append($tabs);
            }else{
                var $sectionBreadcrumbs = $('<section class="breadcrumb-wrap page-title-margin-bottom"><div class="container"></div></section>');
                $('.container',$sectionBreadcrumbs).append($tabs);
                if($('section.page-title-wrap').length>0){
                    $('section.page-title-wrap').after($sectionBreadcrumbs);
                }else{
                    $('#wrapper-content').prepend($sectionBreadcrumbs);
                }
            }
            $($tabs).show();
            <?php } ?>
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


