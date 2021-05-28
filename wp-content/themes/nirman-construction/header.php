<?php
/**
 * The header for our theme
 *
 * @subpackage nirman-construction
 * @since 1.0
 * @version 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nirman-construction' ); ?></a>

	<header id="header">
		<div class="top-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="contact-details">
							<?php if( get_theme_mod('nirman_construction_call1') != ''){ ?>
								<span class="col-org"><a href="tel:<?php echo esc_attr( get_theme_mod('nirman_construction_call1','') ); ?>"><i class="fas fa-phone"></i><?php echo esc_html( get_theme_mod('nirman_construction_call1','') ); ?></a></span>
							<?php } ?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="social-icons">
							<?php if( get_theme_mod( 'nirman_construction_facebook_url') != '') { ?>
						      <a href="<?php echo esc_url( get_theme_mod( 'nirman_construction_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
						    <?php } ?>
						    <?php if( get_theme_mod( 'nirman_construction_twitter_url') != '') { ?>
						      <a href="<?php echo esc_url( get_theme_mod( 'nirman_construction_twitter_url','' ) ); ?>"><i class="fab fa-twitter"></i></a>
						    <?php } ?>
						    <?php if( get_theme_mod( 'nirman_construction_linkedin_url') != '') { ?>
						      <a href="<?php echo esc_url( get_theme_mod( 'nirman_construction_linkedin_url','' ) ); ?>"><i class="fab fa-linkedin-in"></i></a>
						    <?php } ?>	
						    <?php if( get_theme_mod( 'nirman_construction_insta_url') != '') { ?>
						      <a href="<?php echo esc_url( get_theme_mod( 'nirman_construction_insta_url','' ) ); ?>"><i class="fab fa-instagram"></i></a>
						    <?php } ?>	
						    <?php if( get_theme_mod( 'nirman_construction_pintrest_url') != '') { ?>
						      <a href="<?php echo esc_url( get_theme_mod( 'nirman_construction_pintrest_url','' ) ); ?>"><i class="fab fa-pinterest-p"></i></a>
						    <?php } ?>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<div class="menu-section">
			<div class="container">
				<div class="row m-0">
					<div class="col-lg-3 col-md-3 p-0">
						<div class="logo">
					        <?php if ( has_custom_logo() ) : ?>
						        <div class="site-logo"><?php the_custom_logo(); ?></div>
						    <?php endif; ?>
				            <?php if (get_theme_mod('nirman_construction_show_site_title',true)) {?>
						        <?php $blog_info = get_bloginfo( 'name' ); ?>
						        <?php if ( ! empty( $blog_info ) ) : ?>
						            <?php if ( is_front_page() && is_home() ) : ?>
							            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						        	<?php else : ?>
					            		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						            <?php endif; ?>
						        <?php endif; ?>
						    <?php }?>
				        	<?php if (get_theme_mod('nirman_construction_show_tagline',true)) {?>
						        <?php
						        $description = get_bloginfo( 'description', 'display' );
						        if ( $description || is_customize_preview() ) :
						          ?>
							        <p class="site-description">
							            <?php echo esc_html($description); ?>
							        </p>
						        <?php endif; ?>
						    <?php }?>
					    </div>
					</div>
					<div class="col-lg-7 col-md-7 col-5 top-menu">
						<?php if (has_nav_menu('primary')){ ?>
							<div class="toggle-menu responsive-menu">
					            <button onclick="nirman_construction_open()" role="tab" class="mobile-menu"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','nirman-construction'); ?></span></button>
					        </div>
							<div id="sidelong-menu" class="nav sidenav">
				                <nav id="primary-site-navigation" class="nav-menu" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'nirman-construction' ); ?>">
				                  	<?php 
				                    	wp_nav_menu( array( 
											'theme_location' => 'primary',
											'container_class' => 'main-menu-navigation clearfix' ,
											'menu_class' => 'clearfix',
											'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
											'fallback_cb' => 'wp_page_menu',
				                    	) ); 
				                  	?>
				                  	<a href="javascript:void(0)" class="closebtn responsive-menu" onclick="nirman_construction_close()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','nirman-construction'); ?></span></a>
				                </nav>
				            </div>
				        <?php }?>
					</div>
					<?php if ( get_theme_mod('nirman_construction_btn_text','') != "" ) {?>
						<div class="col-lg-2 col-md-2 col-7 p-0"> 
						   	<div class="quote-btn">
					     		<a href="<?php echo esc_html( get_theme_mod('nirman_construction_btn_link','') ); ?>"><?php echo esc_html( get_theme_mod('nirman_construction_btn_text','') ); ?></a>
						    </div>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
	</header>

	<div class="site-content-contain">
		<div id="content" class="site-content">