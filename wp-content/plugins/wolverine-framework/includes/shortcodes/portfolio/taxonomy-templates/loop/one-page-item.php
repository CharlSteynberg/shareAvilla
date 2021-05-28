<?php
$col_class = 'col-md-3 col-sm-6';
$width = 585;
$height = 585;
$hover_align_bottom = '';
$total_item_clone = 1;
if($index==1 || ($index-1)%8==0){
    $col_class = 'col-md-6 col-sm-6';
    $hover_align_bottom = 'hover-align-bottom';
}
if($index%8==0 && $index > 1){
    $width = 570;
    $height = 270;
    $col_class = 'col-md-6 col-sm-6 hidden-sm hidden-xs';
    $total_item_clone = 2;
}
?>
<?php for($i=1;$i<=$total_item_clone;$i++){
        if($i==2){
            $width = 585;
            $height = 585;
            $col_class = 'col-md-3 col-sm-6 hidden-lg hidden-md';
        }
    ?>
    <div class="portfolio-item hover-dir <?php echo sprintf('%s %s %s %s',$cat_filter,$overlay_align,$hover_align_bottom ,$col_class ) ?>">
        <?php
        $prefix = 'g5plus_';
        $cat_data = get_tax_meta($term,$prefix.'thumbnail_id');
        $post_thumbnail_id = 0;
        $arrImages = array();

        if(isset($cat_data) && isset($cat_data['id']))
            $arrImages = wp_get_attachment_image_src( $cat_data['id'], 'full' );

        $thumbnail_url = $url_origin = '';
        if(count($arrImages)>0){
            if (function_exists('matthewruddy_image_resize_id')) {
                $thumbnail_url = matthewruddy_image_resize_id($cat_data['id'],$width,$height);
            }
	        $url_origin = $arrImages[0];
        }
        if($overlay_style=='left-title-excerpt-link')
            $overlay_style = 'title-excerpt-link';
        include(plugin_dir_path( __FILE__ ).'/overlay/'.$overlay_style.'.php');
        ?>

    </div>
<?php } ?>

