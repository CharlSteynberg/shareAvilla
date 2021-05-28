<?php
$cat = '';
foreach ( $terms as $term ){
    $cat .= $term->name.', ';
}
$cat = rtrim($cat,', ');

$disable_link = g5plus_framework_get_option('portfolio_disable_link_detail','0');
$link = '';
if ($disable_link == '0') {
	$link = get_post_meta(get_the_ID(), 'portfolio-link', true );
	if(!isset($link) || $link=='') {
		$link = get_permalink(get_the_ID());
    }
}
?>
<div class="entry-thumbnail title-category">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner">
                <span class="icon-logo">
                    <i class="wicon icon-indians-icons-04 primary-color"></i>
                </span>
                <?php if ($disable_link == '1'){?>
                    <div class="title  primary-color-hover bold-color"><?php the_title() ?></div>
                <?php } else{?>
                    <a href="<?php echo  esc_url($link) ?>" class="line-height-1"><div class="title  primary-color-hover bold-color"><?php the_title() ?></div> </a>
                <?php }?>
                <span class="category other-font bold-color line-height-1"><?php echo wp_kses_post($cat) ?></span>
            </div>
        </div>
    </div>

</div>