<div class="food-item">
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
    <div class="food-title-price">
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