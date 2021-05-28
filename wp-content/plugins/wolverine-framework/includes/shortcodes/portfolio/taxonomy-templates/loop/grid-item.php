<div class="portfolio-item hover-dir <?php echo esc_attr($overlay_align) ?>">
    <?php
    $prefix = 'g5plus_';
    $cat_data = get_tax_meta($term,$prefix.'thumbnail_id');
    $post_thumbnail_id = 0;
    $arrImages = array();

    if(isset($cat_data) && isset($cat_data['id']))
        $arrImages = wp_get_attachment_image_src( $cat_data['id'], 'full' );
    $width = 585;
    $height = 585;
    if($image_size=='590x393')
    {
        $width = 590;
        $height = 393;
    }
    $thumbnail_url = $url_origin = '';
    if(count($arrImages)>0){
        $url_origin = $arrImages[0];
        if (function_exists('matthewruddy_image_resize_id')) {
	        $thumbnail_url = matthewruddy_image_resize_id($cat_data['id'],$width,$height);
        }
    }
    if($overlay_style=='left-title-excerpt-link')
        $overlay_style = 'title-excerpt-link';
    include(plugin_dir_path( __FILE__ ).'/overlay/'.$overlay_style.'.php');
    ?>
</div>
