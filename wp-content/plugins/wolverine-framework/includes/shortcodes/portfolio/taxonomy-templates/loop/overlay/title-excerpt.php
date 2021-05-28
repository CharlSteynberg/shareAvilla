<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/6/15
 * Time: 6:13 PM
 */
?>
<div class="entry-thumbnail title-excerpt">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
         src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php  echo esc_attr($term->name)?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner line-height-1">
                <a href="<?php echo get_term_link( $term ) ?>" class="title"><h5 class="primary-color-hover"><?php  echo esc_attr($term->name) ?></h5></a>
                <div class="excerpt-wrap">
                    <span class="excerpt primary-font bold-color">
                        <?php  echo esc_attr($term->description) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>