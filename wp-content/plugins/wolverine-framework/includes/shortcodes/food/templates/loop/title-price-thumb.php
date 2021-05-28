<div class="food-item">
    <?php

    $post_thumbnail_id = get_post_thumbnail_id(  get_the_ID() );
    $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
    $width = 134;
    $height = 134;
    $thumbnail_url = $url_origin = '';
    if(count($arrImages)>0){
        if (function_exists('matthewruddy_image_resize_id')) {
            $thumbnail_url = matthewruddy_image_resize_id($post_thumbnail_id,$width, $height);
        }
	    $url_origin = $arrImages[0];
    }



    $link_to_id = get_post_meta(get_the_ID(), 'food-link-to-post', true );
    $link_to = '';
    if(!isset($link_to_id) || $link_to_id==''){
        $link_to_id = get_post_meta(get_the_ID(), 'food-link-to-page', true );
    }
    if(!isset($link_to_id) && $link_to_id!=''){
        $link_to = get_permalink($link_to_post_id);
    }


    ?>
    <div class="food-title-price">
        <div class="thumb">
            <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
                 src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
        </div>

        <?php if($link_to!=''){ ?>
            <a href="<?php echo esc_url($link_to) ?>" class="title">
                <h5 class="primary-color-hover secondary-font"><?php the_title() ?></h5>
                <div class="price-wrap">
                    <span class="price secondary-font primary-color">
                        <?php    $price = get_post_meta(get_the_ID(), 'food-price', true );
                        echo wp_kses_post($price);
                        ?>
                    </span>
                </div>
            </a>
        <?php }else{ ?>
            <div class="title">
                <h5 class="primary-color-hover secondary-font"><?php the_title() ?></h5>
                <div class="price-wrap">
                    <span class="price secondary-font primary-color">
                        <?php    $price = get_post_meta(get_the_ID(), 'food-price', true );
                        echo wp_kses_post($price);
                        ?>
                    </span>
                </div>
            </div>
        <?php } ?>
        <div class="excerpt other-font">
            <?php echo get_the_excerpt() ?>
        </div>
    </div>
</div>