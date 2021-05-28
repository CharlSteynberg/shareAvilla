<?php
$link_to_id = get_post_meta(get_the_ID(), 'food-link-to-post', true );
$link_to = '';
if(!isset($link_to_id) || $link_to_id==''){
    $link_to_id = get_post_meta(get_the_ID(), 'food-link-to-page', true );
}
if(!isset($link_to_id) && $link_to_id!=''){
    $link_to = get_permalink($link_to_post_id);
}
?>
<div class="entry-thumbnail title-price-gallery">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
         src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner line-height-1">
                <div class="food-icon">
                    <a href="<?php echo esc_url($url_origin) ?>" data-rel="prettyPhoto[pp_gal_<?php echo get_the_ID() ?>]"  title="<?php echo get_the_title() ?>">
                        <i class="wicon icon-outline-vector-icons-pack-94"></i>
                    </a>
                </div>
                <?php if($link_to!=''){ ?>
                    <a href="<?php echo esc_url($link_to) ?>" class="title"><h5 class="primary-color-hover other-font"><?php the_title() ?></h5></a>
                <?php }else{ ?>
                    <div class="title"><h5 class="primary-color-hover other-font"><?php the_title() ?></h5></div>
                <?php } ?>
                <div class="price-wrap">
                    <span class="price secondary-font primary-color">
                        <?php    $price = get_post_meta(get_the_ID(), 'food-price', true );
                        echo wp_kses_post($price);
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>