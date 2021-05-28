<div class="portfolio-item hover-dir <?php echo esc_attr($cat_filter . ' ' . $overlay_align) ?>">

    <?php
    $post_thumbnail_id = get_post_thumbnail_id(  get_the_ID() );
    $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
    $width = 585;
    $height = 585;
    if($image_size=='590x393')
    {
        $width = 590;
        $height = 393;
    }
    $thumbnail_url = $url_origin = '';
    if(count($arrImages)>0){
        if (function_exists('matthewruddy_image_resize_id')) {
            $thumbnail_url = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
        }
	    $url_origin = $arrImages[0];
    }


    if($overlay_style=='left-title-excerpt-link')
        $overlay_style = 'title-excerpt-link';
    include(plugin_dir_path( __FILE__ ).'/overlay/'.$overlay_style.'.php');
    ?>

    <?php
        include(plugin_dir_path(__FILE__) . '/gallery.php');
    ?>

</div>
<?php if($index%$column==0 && $show_pagging != '2') {?>
    <div style="clear:both"></div>
<?php }?>