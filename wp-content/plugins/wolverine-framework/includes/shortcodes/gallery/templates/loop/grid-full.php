<?php
$meta_values = get_post_meta(get_the_ID(), 'gallery-format-gallery', false);
if (count($meta_values) > 0) {
    foreach ($meta_values as $image) {
        ?>
        <div class="g5plus-gallery-item hover-dir">
            <?php
            $post_thumbnail_id = get_post_thumbnail_id(  get_the_ID() );
            $arrImages =  wp_get_attachment_image_src($image, 'full');
            $width = 475;
            $height = 475;
            $thumbnail_url = $url_origin = '';
            if(count($arrImages)>0){
                if (function_exists('matthewruddy_image_resize_id')) {
                    $thumbnail_url = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
                }
	            $url_origin = $arrImages[0];
            }


            include(plugin_dir_path( __FILE__ ).'/overlay/'. $overlay_style .'.php');

            ?>

        </div>
    <?php
    }
}
?>