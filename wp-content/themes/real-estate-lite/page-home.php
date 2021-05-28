<?php
/**
 * Template Name: Home
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package real-estate-lite
 */

get_header(); ?>

<?php do_action('real_estate_lite_main_slider' ); ?>
<?php do_action('slider'); 

?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php
	
		get_template_part( 'sections/search');
		get_template_part( 'sections/services');
		get_template_part( 'sections/about');
		get_template_part( 'sections/properties');
		get_template_part( 'sections/blog');
		get_template_part( 'sections/testimonial');
		get_template_part( 'sections/address');

?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
