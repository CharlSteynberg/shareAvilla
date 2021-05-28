<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/20/15
 * Time: 11:01 AM
 */
?>
<div class="entry-thumbnail title-only">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo esc_attr($term->name) ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner">
                <span class="icon-logo">
                    <i class="wicon icon-indians-icons-04"></i>
                </span>
                <a href="<?php echo get_term_link( $term );?>" class="line-height-1"><div class="title"><?php echo esc_attr($term->name) ?></div> </a>
            </div>
        </div>
    </div>

</div>