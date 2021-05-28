<?php
/**
 * The Header for our theme.
 * @package Construction Realestate
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open(); 
  } else { 
    do_action( 'wp_body_open' ); 
  } ?>
  <?php if(get_theme_mod('construction_realestate_preloader',true) != '' || get_theme_mod( 'construction_realestate_display_preloader',true) != ''){ ?>
    <div class="frame w-100 h-100">
      <div class="loader">
        <div class="dot-1 rounded-circle"></div>
        <div class="dot-2 rounded-circle"></div>
        <div class="dot-3 rounded-circle"></div>
      </div>
    </div>
  <?php }?>
  <header role="banner">
    <div id="header">
      <a class="screen-reader-text skip-link" href="#skip_content"><?php esc_html_e( 'Skip to content', 'construction-realestate' ); ?></a>
      <?php if( get_theme_mod( 'construction_realestate_cont_facebook') != '' || get_theme_mod( 'construction_realestate_cont_twitter') != '' || get_theme_mod( 'construction_realestate_pinterest') != '' ||get_theme_mod( 'construction_realestate_tumblr') != '') { ?>
        <div class="top_headbar py-2 px-5 w-100 m-0 m-auto">
          <div class="socialbox">
            <?php if(  get_theme_mod( 'construction_realestate_cont_facebook') != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_facebook','' ) ); ?>"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_facebook_icon','fab fa-facebook-f')); ?> my-0 mx-2"></i><span class="screen-reader-text"><?php esc_html_e( 'Facebook','construction-realestate' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'construction_realestate_cont_twitter' ) != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_twitter','' ) ); ?>"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_twitter_icon','fab fa-twitter')); ?> my-0 mx-2" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Twitter','construction-realestate' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'construction_realestate_pinterest') != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_pinterest','' ) ); ?>"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_pinterest_icon','fab fa-pinterest')); ?> my-0 mx-2" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Pinterest','construction-realestate' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'construction_realestate_tumblr') != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_tumblr','' ) ); ?>"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_tumblr_icon','fab fa-tumblr')); ?> my-0 mx-2" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Tumblr','construction-realestate' );?></span></a>
            <?php } ?>
          </div>
          <div class="clearfix"></div>
        </div>
      <?php }?>
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 logo_bar">
            <div class="logo m-0 py-1">
              <?php if ( has_custom_logo() ) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
              <?php endif; ?>
              <?php $blog_info = get_bloginfo( 'name' ); ?>
              <?php if ( ! empty( $blog_info ) ) : ?>
                <?php if( get_theme_mod('construction_realestate_site_title_enable',true) != ''){ ?>
                  <?php if ( is_front_page() && is_home() ) : ?>
                    <h1 class="site-title p-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="my-0"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php else : ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="my-0"><?php bloginfo( 'name' ); ?></a></p>
                  <?php endif; ?>
                <?php }?>
              <?php endif; ?>
              <?php
              $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) :
                ?>
                <?php if( get_theme_mod('construction_realestate_site_tagline_enable',true) != ''){ ?>
                  <p class="site-description">
                    <?php echo esc_html($description); ?>
                  </p>
                <?php }?>
              <?php endif; ?>    
            </div>     
          </div>
          <div class="col-lg-8 col-md-8 row contact my-4">
            <div class="col-lg-4 col-md-4">
              <?php if( get_theme_mod( 'construction_realestate_location','' ) != '') { ?>
                <div class="row">
                  <div class="col-lg-2 col-md-4 p-0">
                    <p class="mb-0"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_location_icon','fas fa-map-marker-alt')); ?>"></i></p>
                  </div>
                  <div class="col-lg-10 col-md-8 p-0">
                    <p class="f_para mb-0"><?php echo esc_html( get_theme_mod('construction_realestate_location','') ); ?></p>
                    <p class="mb-0"><?php echo esc_html( get_theme_mod('construction_realestate_location1','') ); ?></p>         
                  </div>
                </div>
              <?php }?>
            </div>
            <div class="col-lg-4 col-md-4">
              <?php if( get_theme_mod( 'construction_realestate_time','' ) != '') { ?>
                <div class="row">
                  <div class="col-lg-2 col-md-4 p-0">
                    <p class="mb-0"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_time_icon','far fa-clock')); ?>"></i></p>
                  </div>
                  <div class="col-lg-10 col-md-8 p-0">              
                    <p class="f_para mb-0"><?php echo esc_html( get_theme_mod('construction_realestate_time','') ); ?></p>
                    <p class="mb-0"><?php echo esc_html( get_theme_mod('construction_realestate_time1','') ); ?></p>             
                  </div>
                </div>
              <?php }?>
            </div>
            <div class="col-lg-4 col-md-4">
              <?php if( get_theme_mod( 'construction_realestate_number','' ) != '') { ?>
                <div class="row">
                  <div class="col-lg-2 col-md-4 p-0">
                    <p class="mb-0"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_phone_icon','fas fa-phone')); ?>"></i></p>
                  </div>
                  <div class="col-lg-10 col-md-8 p-0">            
                    <p><a class="f_para mb-0" href="tel:<?php echo esc_attr( get_theme_mod('construction_realestate_number','' )); ?>"><?php echo esc_html( get_theme_mod('construction_realestate_number','') ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('construction_realestate_number','') ); ?></span></a></p>
                    <p><a class="call1 mb-0" href="tel:<?php echo esc_attr( get_theme_mod('construction_realestate_number1','' )); ?>"><?php echo esc_html( get_theme_mod('construction_realestate_number1','') ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('construction_realestate_number1','') ); ?></span></a></p>        
                  </div>
                </div>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
      <div class="<?php if( get_theme_mod( 'construction_realestate_sticky_header', false) != '' || get_theme_mod( 'construction_realestate_display_fixed_header', false) != '') { ?> sticky-header"<?php } else { ?>close-sticky <?php } ?>">
        <?php 
          if(has_nav_menu('primary')){ ?>
          <div class="toggle-menu responsive-menu my-0 mx-auto text-right">
            <button role="tab" class="mobiletoggle" onclick="construction_realestate_responsive_menu_open()"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_responsive_menu_open_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','construction-realestate'); ?></span>
            </button>
          </div>
        <?php }?>
        <div id="navbar-header" class="menu-brand text-lg-center text-left">
          <div id="search" class="text-center">
            <?php get_search_form(); ?>
          </div>
          <nav id="site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'construction-realestate' ); ?>">
            <?php 
              if(has_nav_menu('primary')){
                wp_nav_menu( array( 
                  'theme_location' => 'primary',
                  'container_class' => 'main-menu-navigation clearfix' ,
                  'menu_class' => 'clearfix',
                  'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav m-0 pl-0">%3$s</ul>',
                  'fallback_cb' => 'wp_page_menu',
                ) ); 
              }
            ?>
          </nav>
          <?php if( get_theme_mod( 'construction_realestate_location','' ) != '') { ?>
            <div class="construction-location">
              <div class="row">
                <div class="col-lg-2 col-md-4 col-3">
                  <p><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_location_icon','fas fa-map-marker-alt')); ?>"></i></p>
                </div>
                <div class="col-lg-10 col-md-8 col-9">
                  <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_location','') ); ?></p>
                  <p><?php echo esc_html( get_theme_mod('construction_realestate_location1','') ); ?></p>       
                </div>
              </div>
            </div>
          <?php }?>
          <?php if( get_theme_mod( 'construction_realestate_time','' ) != '') { ?>
            <div class="construction-time">
              <div class="row">
                <div class="col-lg-2 col-md-4 col-3">
                  <p><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_time_icon','far fa-clock')); ?>"></i></p>
                </div>
                <div class="col-lg-10 col-md-8 col-9">              
                  <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_time','') ); ?></p>
                  <p><?php echo esc_html( get_theme_mod('construction_realestate_time1','') ); ?></p>
                </div>
              </div>
            </div>
          <?php }?>
          <?php if( get_theme_mod( 'construction_realestate_number','' ) != '') { ?>
            <div class="construction-number">
              <div class="row">
                <div class="col-lg-2 col-md-4 col-3">
                  <p><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_phone_icon','fas fa-phone-alt')); ?>"></i></p>
                </div>
                <div class="col-lg-10 col-md-8 col-9">            
                  <p><a class="f_para" href="tel:<?php echo esc_url( get_theme_mod('construction_realestate_number','' )); ?>"><?php echo esc_html( get_theme_mod('construction_realestate_number','') ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('construction_realestate_number','') ); ?></span></a></p>
                  <p><a class="call1" href="tel:<?php echo esc_url( get_theme_mod('construction_realestate_number1','' )); ?>"><?php echo esc_html( get_theme_mod('construction_realestate_number1','') ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('construction_realestate_number1','') ); ?></span></a></p>       
                </div>
              </div>
            </div>
          <?php }?>
          <div class="socialbox">
            <?php if( get_theme_mod( 'construction_realestate_cont_facebook') != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_facebook','' ) ); ?>"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_facebook_icon','fab fa-facebook-f')); ?> my-0 mx-2"></i><span class="screen-reader-text"><?php esc_html_e( 'Facebook','construction-realestate' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'construction_realestate_cont_twitter' ) != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_twitter','' ) ); ?>"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_twitter_icon','fab fa-twitter')); ?> my-0 mx-2" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Twitter','construction-realestate' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'construction_realestate_pinterest') != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_pinterest','' ) ); ?>"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_pinterest_icon','fab fa-pinterest')); ?> my-0 mx-2" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Pinterest','construction-realestate' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'construction_realestate_tumblr') != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_tumblr','' ) ); ?>"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_tumblr_icon','fab fa-tumblr')); ?> my-0 mx-2" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Tumblr','construction-realestate' );?></span></a>
            <?php } ?>
          </div>
          <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="construction_realestate_responsive_menu_close()"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_responsive_menu_close_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','construction-realestate'); ?></span></a>
        </div>
      </div>
    </div>
  </header>