<?php
/**
 * Template part for displaying  Single Posts
 * 
 * @subpackage nirman-construction
 * @since 1.0
 * @version 1.4
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="single-post">
    <div class="article_content">
      <div class="article-text">
        <h3 class="single-post"><?php the_title(); ?></h3>
        <div class="metabox1"> 
          <span class="entry-author"><i class="fas fa-user"></i><?php the_author(); ?></span><span>|</span>
          <span class="entry-date"><i class="fas fa-calendar-alt"></i><?php the_time( get_option( 'date_format' ) ); ?></span><span>|</span>
          <span class="entry-comments"><i class="fas fa-comments"></i><?php comments_number( __('0 Comments','nirman-construction'), __('0 Comments','nirman-construction'), __('% Comments','nirman-construction') ); ?></span>
        </div>
        <?php the_post_thumbnail(); ?>
        <div class="entry-content"><p><?php the_content(); ?></p></div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</article>