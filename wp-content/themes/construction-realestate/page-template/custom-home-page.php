<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="skip_content" role="main">
  <?php do_action( 'construction_realestate_above_slider' ); ?>

  <?php /** slider section **/ ?>
  <?php if( get_theme_mod('construction_realestate_slider_hide_show', false) != '' || get_theme_mod( 'construction_realestate_display_slider',false) != ''){ ?>
    <section id="slider" class="p-0 m-auto mw-100">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php $construction_realestate_slider_page = array();
          for ( $count = 1; $count <=4; $count++ ) {
            $mod = intval( get_theme_mod( 'construction_realestate_slider' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $construction_realestate_slider_page[] = $mod;
            }
          }
          if( !empty($construction_realestate_slider_page) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $construction_realestate_slider_page,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <?php the_post_thumbnail(); ?>
            <div class="carousel-caption">
              <div class="inner_carousel text-center">
                <h1 class="p-0"><?php the_title(); ?></h1>
                <p><?php $excerpt = get_the_excerpt(); echo esc_html( construction_realestate_string_limit_words( $excerpt, esc_attr(get_theme_mod('construction_realestate_slider_excerpt_number','30')))); ?></p>
              </div>
              <?php if (get_theme_mod( 'construction_realestate_show_slider_button',true) != '' || get_theme_mod( 'construction_realestate_display_slider_button',true) != ''){ ?>
                <?php if( get_theme_mod('construction_realestate_slider_button_text','KNOW MORE') != ''){ ?>
                  <div class="slide-button my-5">
                    <a class="read-more p-2" href="<?php echo esc_url( get_permalink() );?>"><?php echo esc_html( get_theme_mod('construction_realestate_slider_button_text',__('KNOW MORE','construction-realestate'))); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('construction_realestate_slider_button_text',__('KNOW MORE','construction-realestate'))); ?></span></a>
                  </div>
                <?php }?> 
              <?php } ?>
            </div>
          </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_slider_previous_icon','far fa-arrow-alt-circle-left')); ?>"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','construction-realestate' );?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_slider_next_icon','far fa-arrow-alt-circle-right')); ?>"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','construction-realestate' );?></span>
        </a>
      </div>  
      <div class="clearfix"></div>
    </section> 
  <?php }?>

  <?php do_action( 'construction_realestate_below_slider' ); ?>

  <?php /** About Us section **/ ?>
  <?php if( get_theme_mod('construction_realestate_sec_title') != '' || get_theme_mod( 'construction_realestate_about_post_setting' )!= ''){ ?>
    <section id="about">
      <div class="container">
        <?php if( get_theme_mod('construction_realestate_sec_title') != ''){ ?>
          <h2><?php echo esc_html(get_theme_mod('construction_realestate_sec_title','')); ?></h2>
        <?php }?>
        <?php
        $construction_realestate_postData =  get_theme_mod('construction_realestate_about_post_setting');
          if($construction_realestate_postData){
            $args = array( 'name' => esc_html($construction_realestate_postData ,'construction-realestate'));
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="mainbox">
              <h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( construction_realestate_string_limit_words( $excerpt, esc_attr(get_theme_mod('construction_realestate_about_excerpt_number','30')))); ?></p>
              <div class="clearfix"></div>
            </div>
          <?php endwhile; 
          wp_reset_postdata();?>
          <?php else : ?>
            <div class="no-postfound"></div>
          <?php
        endif;} ?>
        <div class="clearfix"></div>
      </div> 
    </section>
  <?php }?>

  <?php do_action( 'construction_realestate_below_about' ); ?>

  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="new-text"><?php the_content(); ?></div>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>

<?php get_footer(); ?>