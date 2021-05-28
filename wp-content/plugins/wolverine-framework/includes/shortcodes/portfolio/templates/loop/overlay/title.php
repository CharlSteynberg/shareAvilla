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
<div class="entry-thumbnail title-only">
    <a href="<?php echo esc_url($link) ?>">
        <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    </a>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner">
                <span class="icon-logo">
                    <i class="wicon icon-indians-icons-04"></i>
                </span>
                <?php if ($disable_link == '1'){?>
                    <div class="title fc-white"><?php the_title() ?></div>
                <?php } else{?>
                    <a href="<?php echo esc_url($link) ?>" class="line-height-1"><div class="title"><?php the_title() ?></div> </a>
                <?php }?>

            </div>
        </div>
    </div>

</div>