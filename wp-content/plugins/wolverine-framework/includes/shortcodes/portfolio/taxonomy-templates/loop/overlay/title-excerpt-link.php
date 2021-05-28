<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/6/15
 * Time: 6:13 PM
 */
?>
<div class="entry-thumbnail title-excerpt-link">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
         src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo esc_attr($term->name) ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner line-height-1">
                <span class="icon-logo">
                    <i class="wicon icon-indians-icons-04 <?php if( isset($overlay_align) && $overlay_align!='hover-align-left' ) {echo 'primary-color';} ?>"></i>
                </span>
                <a href="<?php echo get_term_link( $term ) ?>" class="title"><h5 class="primary-color-hover line-height-1"><?php echo esc_attr($term->name) ?></h5></a>
                <div class="excerpt-wrap">
                    <span class="excerpt primary-font bold-color">
                    <?php echo esc_attr($term->description)?>
                </span>
                </div>
                <span class="link-button">
                    <a class="link bold-color primary-bg-color-hover primary-color-hover primary-border-color-hover" href="<?php echo get_term_link( $term ) ?>" title="<?php echo esc_attr($term->name) ?>">
                        <i class="wicon icon-link"></i>
                    </a>
                    <a class="view-gallery prettyPhoto bold-color primary-color-hover primary-bg-color-hover primary-border-color-hover" href="<?php echo esc_url($url_origin) ?>" data-rel="prettyPhoto[pp_gal]"  title="<?php echo esc_attr($term->name) ?>">
                      <i class="wicon icon-outline-vector-icons-pack-67"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>