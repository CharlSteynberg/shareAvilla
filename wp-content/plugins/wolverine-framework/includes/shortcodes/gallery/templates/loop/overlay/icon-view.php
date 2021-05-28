<div class="entry-thumbnail title-price-gallery">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
         src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner line-height-1">
                <div class="g5plus-gallery-icon">
                    <a href="<?php echo esc_url($url_origin) ?>" data-rel="<?php if(isset($popup_type) && $popup_type==''){echo 'prettyPhoto[pp_gal_'.get_the_ID() .']';}  ?>"  title="<?php echo get_the_title() ?>">
                        <i class="wicon icon-outline-vector-icons-pack-156"></i>
                    </a>
                </div>
                <div class="gallery-title">
                    <h5 ><?php echo get_the_title() ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>