<?php
$disable_link = g5plus_framework_get_option('portfolio_disable_link_detail','0');
$link = '';
if ($disable_link == '0') {
	$link = get_post_meta(get_the_ID(), 'portfolio-link', true );
	if(!isset($link) || $link=='') {
		$link = get_permalink(get_the_ID());
    }
}
?>
<div class="entry-thumbnail title">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner">
                <a href="<?php echo esc_url($url_origin) ?>" data-rel="prettyPhoto[pp_gal_<?php echo get_the_ID() ?>]"  title="<?php echo get_the_title() ?>">
                    <i class="wicon icon-outline-vector-icons-pack-94 icon-fs-34 fc-white link-color-hover"></i>
                </a>
                <?php if ($disable_link == '1'){?>
                    <h5><?php the_title() ?></h5>
                <?php } else{?>
                    <a href="<?php echo esc_url($link) ?>"><h5><?php the_title() ?></h5> </a>
                <?php }?>
            </div>
        </div>
    </div>
</div>