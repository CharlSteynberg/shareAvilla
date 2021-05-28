<div class="portfolio-item hover-dir <?php echo esc_attr($cat_filter . ' ' . $overlay_align) ?>">

    <?php
    $prefix = 'g5plus_';
    $cat_data = get_tax_meta($term,$prefix.'thumbnail_id');
    $post_thumbnail_id = 0;
    $arrImages = array();

    if(isset($cat_data) && isset($cat_data['id']))
        $arrImages = wp_get_attachment_image_src( $cat_data['id'], 'full' );

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

    $thumbnail_url = '';
    $url_origin = '';
    if (count($arrImages) > 0) {
        if (function_exists('matthewruddy_image_resize_id')) {
	        $thumbnail_url = matthewruddy_image_resize_id($cat_data['id'],$width, $height);
        }
	    $url_origin = $arrImages[0];
    }


    if ($overlay_style == 'left-title-excerpt-link')
        $overlay_style = 'title-excerpt-link';
    include(plugin_dir_path(__FILE__) . '/overlay/' . $overlay_style . '.php');
    ?>


</div>
