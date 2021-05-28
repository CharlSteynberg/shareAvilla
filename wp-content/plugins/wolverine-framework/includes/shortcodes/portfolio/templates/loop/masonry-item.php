<div class="portfolio-item hover-dir <?php echo esc_attr($cat_filter . ' ' . $overlay_align) ?>">

    <?php
    $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
    $arrImages = wp_get_attachment_image_src($post_thumbnail_id, 'full');

    $matrix = array(
        '3' => array(
            array(2,1,2),
            array(2,1,1)
        ),
        '4' => array(
            array(1,2,1,2),
            array(2,2,1,1),
        ),
        '5' => array(
            array(1,2,1,2,1),
            array(2,2,2,1,1),
        )

    );

    $index_row = floor(($index-1) / $column)%2;
    $index_col = ($index-1) % $column;

    $width = 475;
    $height = 475;

    if($matrix[$column][$index_row][$index_col]==1){
        $width = 390;
        $height = 260;
    }

    $thumbnail_url = $url_origin = '';
    if (count($arrImages) > 0) {
        if (function_exists('matthewruddy_image_resize_id')) {
            $thumbnail_url = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
        }
	    $url_origin = $arrImages[0];
    }


    if ($overlay_style == 'left-title-excerpt-link')
        $overlay_style = 'title-excerpt-link';
    include(plugin_dir_path(__FILE__) . '/overlay/' . $overlay_style . '.php');
    ?>

    <?php
    include(plugin_dir_path(__FILE__) . '/gallery.php');
    ?>

</div>
<?php if ($index % $column == 0 && $show_pagging != '2') { ?>
    <div style="clear:both"></div>
<?php } ?>