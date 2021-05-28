<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neptune WP
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'neptune-real-estate' ); ?></a>

	<header id="masthead" class="site-header">

		<div class="grid-wide center-align">
		<div class="row">

		<div class="site-branding col-4-12 mobile-col-1-1"><!-- header-middle -->
			<?php neptune_real_estate_logo(); ?>
		</div><!-- .site-branding -->

		<div class="col-8-12 mobile-col-1-1">
		
		<nav id="site-navigation" class="main-navigation">
		     <?php 	
		     wp_nav_menu(array(
			     'container_id' => 'cssmenu',
			     'theme_location' => 'menu-1',
			     'fallback_cb'       => 'Neptune_Real_Estate_Menu_Walker::fallback',
			     'walker' => new Neptune_Real_Estate_Menu_Walker()
   			 ));?>

		</nav><!-- #site-navigation -->	
		</div><!-- header-right -->
	</div>

	</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
