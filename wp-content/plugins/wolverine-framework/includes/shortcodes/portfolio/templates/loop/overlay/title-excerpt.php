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
<div class="entry-thumbnail title-excerpt">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
         src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner line-height-1">
                <?php if ($disable_link == '1'){?>
                    <h5 class="primary-color-hover"><?php the_title() ?></h5>
                <?php } else{?>
                    <a href="<?php echo esc_url($link) ?>" class="title"><h5 class="primary-color-hover"><?php the_title() ?></h5></a>
                <?php }?>
                <div class="excerpt-wrap">
                    <span class="excerpt primary-font bold-color">
                        <?php echo get_the_excerpt() ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>