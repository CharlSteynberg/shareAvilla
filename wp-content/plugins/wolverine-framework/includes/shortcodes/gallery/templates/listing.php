<?php
$primary_color = g5plus_framework_get_option('primary_color','#995958');

$args = array(
    'offset' => $offset,
    'orderby' =>'post__in',
    'post__in' => explode(",",$gallery_ids),
    'posts_per_page' => $post_per_page,
    'post_type' => G5PLUS_GALLERY_POST_TYPE,
    'post_status' => 'publish');

if($data_source==''){
    $args = array(
        'offset' => $offset,
        'posts_per_page' => $post_per_page,
        'orderby' => 'post_date',
        'order' => $order,
        'post_type' => G5PLUS_GALLERY_POST_TYPE,
        G5PLUS_GALLERY_CATEGORY_TAXONOMY => strtolower($category),
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
    class="g5plus-gallery overflow-hidden <?php echo esc_attr($g5plus_animation . ' ' . $styles_animation . ' ' . $paging_style) ?>"
    id="g5plus-gallery-<?php echo esc_attr($data_section_id) ?>">
    <?php if ($show_category != '') { ?>
        <div class="g5plus-gallery-tabs">
            <?php
            $termIds = array();
            $portfolio_terms = get_terms(G5PLUS_GALLERY_CATEGORY_TAXONOMY);
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
            $terms = get_terms(G5PLUS_GALLERY_CATEGORY_TAXONOMY, $array_terms);

            if (count($terms) > 0) {
                $index = 1;
                ?>
                <div
                    class="tab-wrapper line-height-1 <?php echo esc_attr($show_category) ?> ">
                    <ul>
                        <li class="active">
                            <a class="isotope-g5plus-gallery ladda-button semi-bold text-color bold-color-hover active"
                               data-section-id="<?php echo esc_attr($data_section_id) ?>"
                               data-load-type="filter"
                               data-category=""
                               data-overlay-style="<?php echo esc_attr($overlay_style)?>"
                               data-source = "<?php echo esc_attr($data_source) ?>"
                               data-gallery-ids="<?php echo esc_attr($gallery_ids)?>"
                               data-layout-type="<?php echo esc_attr($layout_type) ?>"
                               data-current-page="1"
                               data-offset="<?php echo esc_attr($offset) ?>"
                               data-post-per-page="<?php echo esc_attr($post_per_page) ?>"
                               data-column="<?php echo esc_attr($column) ?>"
                               data-order="<?php echo esc_attr($order) ?>"
                               data-style="zoom-out" data-spinner-color="<?php echo esc_attr($primary_color) ?>"
                               data-show-paging = "<?php echo esc_attr($show_pagging) ?>"
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
                                <a class="isotope-food ladda-button semi-bold text-color bold-color-hover"
                                   href="javascript:;" data-section-id="<?php echo esc_attr($data_section_id) ?>"
                                   data-load-type="filter"
                                   data-category="<?php echo esc_attr($term->slug)?>"
                                   data-overlay-style="<?php echo esc_attr($overlay_style)?>"
                                   data-source = "<?php echo esc_attr($data_source) ?>"
                                   data-gallery-ids="<?php echo esc_attr($gallery_ids)?>"
                                   data-layout-type="<?php echo esc_attr($layout_type) ?>"
                                   data-current-page="1"
                                   data-offset="<?php echo esc_attr($offset) ?>"
                                   data-post-per-page="<?php echo esc_attr($post_per_page) ?>"
                                   data-column="<?php echo esc_attr($column) ?>"
                                   data-order="<?php echo esc_attr($order) ?>"
                                   data-show-paging = "<?php echo esc_attr($show_pagging) ?>"
                                   data-style="zoom-out" data-spinner-color="<?php echo esc_attr($primary_color) ?>">
                                    <?php echo wp_kses_post($term->name) ?>
                                </a>
                            </li>
                            <?php if ($index++ != count($terms)) { ?>
                                <li class="none-magic-line">|</li>
                            <?php } ?>
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
        class="g5plus-gallery-wrapper <?php echo sprintf('%s %s %s %s', $col_class, $padding, $layout_type, $owl_carousel_class) ?>" <?php echo wp_kses_post($data_plugin_options) ?>
        data-section-id="<?php echo esc_attr($data_section_id) ?>"
        id="g5plus-gallery-container-<?php echo esc_attr($data_section_id) ?>"
        data-columns="<?php echo esc_attr($column) ?>">
        <?php
        $index = 0;

        while ($posts_array->have_posts()) : $posts_array->the_post();
            $index++;
            $permalink = get_permalink();
            $title_post = get_the_title();
            $terms = wp_get_post_terms(get_the_ID(), array(G5PLUS_GALLERY_CATEGORY_TAXONOMY));
            $cat = $cat_filter = '';
            foreach ($terms as $term) {
                $cat_filter .= preg_replace('/\s+/', '', $term->name) . ' ';
                $cat .= $term->name . ', ';
            }
            $cat = rtrim($cat, ', ');

            ?>

            <?php
            if($display_type=='')
                include(plugin_dir_path(__FILE__) . '/loop/' . $layout_type  . '.php');
            else
                include(plugin_dir_path(__FILE__) . '/loop/' . $layout_type  . '-full.php');
            ?>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>

    </div>
    <?php if ($show_pagging == '1' && $post_per_page > 0 && $total_post / $post_per_page > 1 && $total_post > ($post_per_page * $current_page)) { ?>
        <div style="clear: both"></div>
        <div class="paging" id="load-more-<?php echo esc_attr($data_section_id) ?>">
            <a href="javascript:;" class="button-sm ladda-button load-more secondary-font"
               data-load-type="load-more"
               data-source = "<?php echo esc_attr($data_source) ?>"
               data-overlay-style="<?php echo esc_attr($overlay_style)?>"
               data-category="<?php echo esc_attr($category) ?>"
               data-gallery-ids ="<?php echo esc_attr($gallery_ids) ?>"
               data-section-id="<?php echo esc_attr($data_section_id) ?>"
               data-current-page="<?php echo esc_attr($current_page + 1) ?>"
               data-offset="<?php echo esc_attr($offset) ?>"
               data-post-per-page="<?php echo esc_attr($post_per_page) ?>"
               data-column="<?php echo esc_attr($column); ?>"
               data-padding="<?php echo esc_attr($padding) ?>"
               data-layout-type="<?php echo esc_attr($layout_type) ?>"
               data-order="<?php echo esc_attr($order) ?>"
               data-show-paging = "<?php echo esc_attr($show_pagging) ?>"
               data-style="zoom-out" data-spinner-color="#000"
                ><?php _e('VIEW MORE', 'wolverine') ?></a>
        </div>
    <?php } ?>

</div>

<?php if(isset($ajax_load) && $ajax_load=='0'){ ?>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $('.g5plus-gallery-item.hover-dir > div.entry-thumbnail').hoverdir();
                GalleryAjaxAction.init('<?php echo esc_url(get_site_url() . '/wp-admin/admin-ajax.php')?>','<?php echo esc_attr($data_section_id)?>');
                <?php if($popup_type=='magnific_popup'){ ?>
                    var $wrap = $('#g5plus-gallery-container-<?php echo esc_attr($data_section_id) ?>');
                    $($wrap).magnificPopup({
                        delegate: 'a', // child items selector, by clicking on it popup will open
                        type: 'image',
                        gallery: {
                            enabled: true
                        }
                    });
                <?php } ?>
            })

        })(jQuery);
    </script>
<?php } ?>
