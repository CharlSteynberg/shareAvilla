<?php
/**
 * The template part for displaying content
 * @package Ecommerce Solution
 * @subpackage construction_realestate
 * @since 1.0
 */
?>
<?php 
  $archive_year  = get_the_time('Y'); 
  $archive_month = get_the_time('m'); 
  $archive_day   = get_the_time('d'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="box-image text-left">
    <?php 
      if(has_post_thumbnail()) { 
        the_post_thumbnail(); 
      }
    ?>
  </div>
  <h2 class="section-title pb-2 mb-2 text-left"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
  <?php if( get_theme_mod( 'construction_realestate_metafields_date',true) != '') { ?>
    <div class="date-box pb-1"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_post_date_icon','far fa-calendar-alt')); ?>"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></div>  
  <?php }?>
  <div class="new-text text-left">
    <p><?php $excerpt = get_the_excerpt(); echo esc_html( construction_realestate_string_limit_words( $excerpt, esc_attr(get_theme_mod('construction_realestate_post_excerpt_number','30')))); ?></p> <?php echo esc_html( get_theme_mod('construction_realestate_post_discription_suffix','[...]') ); ?>
  </div>  
  <?php if( get_theme_mod( 'construction_realestate_post_category',true) != '') { ?>
    <div class="cat-box mt-1">
      <i class="<?php echo esc_attr(get_theme_mod('construction_realestate_category_icon','fas fa-folder-open')); ?>"></i><?php the_category(); ?>
    </div>
  <?php }?>
  <div class="clearfix"></div>
</article>