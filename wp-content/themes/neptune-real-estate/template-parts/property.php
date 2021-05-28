<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neptune WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		the_title( '<h1 class="entry-title">', '</h1>' );
		do_action('neptune_real_estate_price');
		?>

	</header><!-- .entry-header -->

	<?php neptune_real_estate_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'neptune-real-estate' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

		//Property amenities
		do_action('neptune_details');
		do_action('neptune_amenities');			
		?>

	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
