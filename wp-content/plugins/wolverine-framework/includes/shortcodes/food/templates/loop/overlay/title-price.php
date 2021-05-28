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
<div class="entry-thumbnail title-excerpt">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
         src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner line-height-1">
                <?php if($link_to!=''){ ?>
                    <a href="<?php echo esc_url($link_to) ?>" class="title"><h5 class="primary-color-hover other-font"><?php the_title() ?></h5></a>
                <?php }else{ ?>
                    <div class="title"><h5 class="primary-color-hover other-font"><?php the_title() ?></h5></div>
                <?php } ?>
                <div class="food-icon"><i class="wicon icon-indians-icons-05"></i></div>
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