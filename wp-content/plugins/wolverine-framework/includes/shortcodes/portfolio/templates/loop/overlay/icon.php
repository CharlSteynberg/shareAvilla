<?php
$disable_link = g5plus_framework_get_option('portfolio_disable_link_detail','0');
$link = get_post_meta(get_the_ID(), 'portfolio-link', true );
if(!isset($link) || $link=='') {
	$link = get_permalink(get_the_ID());
}

?>
<div class="entry-thumbnail icon">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner">
                <a href="<?php echo esc_url($url_origin) ?>" data-rel="prettyPhoto[pp_gal_<?php echo get_the_ID() ?>]"  title="<?php echo get_the_title() ?>">
                    <i class="wicon icon-outline-vector-icons-pack-94 icon-fs-34  fc-white link-color-hover"></i>
                </a>
                <span class="separate">
                    <span class="line"></span>
                </span>
                <?php if ($disable_link == '1'){?>
                    <i class="wicon icon-outline-vector-icons-pack-135 icon-fs-34 fc-white link-color-hover"></i>
                <?php } else{?>
                    <a href="<?php echo esc_url($link) ?>" title="<?php echo get_the_title() ?>">
                        <i class="wicon icon-outline-vector-icons-pack-135 icon-fs-34 fc-white link-color-hover"></i>
                    </a>
                <?php }?>
            </div>
        </div>
    </div>

</div>