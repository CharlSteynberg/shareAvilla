<?php
$prefix = 'g5plus_';
$cat_data = get_tax_meta($term,$prefix.'thumbnail_id');
$post_thumbnail_id = 0;
$arrImages = array();

if(isset($cat_data) && isset($cat_data['id']))
    $arrImages = wp_get_attachment_image_src( $cat_data['id'], 'full' );
$width = 370;
$height = 494;
$overlay_height = 'height-50';

$matrix = array(
  array(2,1,2),
  array(2,2,2),
  array(2,1,1)
);

$index_row = floor(($index-1) / $column)%3;
$index_col = ($index-1) % $column;
if($matrix[$index_row][$index_col]==1){
    $width = 370;
    $height = 260;
    $overlay_height = '';
}

?>

<div class="portfolio-item <?php echo sprintf('%s %s %s',$cat_filter,$overlay_align, $overlay_height) ?>">

    <?php
    $thumbnail_url = '';
    $url_origin = '';
    if (count($arrImages) > 0) {
        if (function_exists('matthewruddy_image_resize_id')) {
	        $thumbnail_url = $thumbnail_url($cat_data['id'], $width, $height);
        }
	    $url_origin = $arrImages[0];
    }

    if ($overlay_style == 'left-title-excerpt-link')
        $overlay_style = 'title-excerpt-link';
    include(plugin_dir_path(__FILE__) . '/overlay/' . $overlay_style . '.php');
    ?>

</div>
