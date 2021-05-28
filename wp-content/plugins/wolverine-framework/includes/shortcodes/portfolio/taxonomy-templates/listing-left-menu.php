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
        foreach ( $terms as $term ) {
            $index++;
            include(plugin_dir_path(__FILE__) . '/loop/' . $layout_type . '-item.php');
        }
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


