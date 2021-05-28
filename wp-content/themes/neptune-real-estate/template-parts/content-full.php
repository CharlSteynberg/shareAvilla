<?php
/**
 * Template part for displaying full page with no sidebar, ideal for builder plugins
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neptune WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php neptune_real_estate_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			the_content();

		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
