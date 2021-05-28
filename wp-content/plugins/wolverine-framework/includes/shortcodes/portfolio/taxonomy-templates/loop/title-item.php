<div class="portfolio-item <?php echo esc_attr($cat_filter) ?>">

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
    ?>
    <div class="entry-thumbnail title">
        <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php  echo esc_attr($term->name) ?>"/>

        <div class="entry-title-wrapper line-height-1 primary-bg-color-hover primary-border-color-hover">
            <div class="entry-title-inner">
                <a href="<?php echo get_permalink(get_the_ID()) ?>" class="bold-color"><div class="title secondary-font"><?php echo esc_attr($term->name) ?></div> </a>
                <span class="category other-font primary-color display-inline-block"><?php echo esc_attr($term->description) ?></span>
            </div>
        </div>

    </div>

</div>
