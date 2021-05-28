<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neptune WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-preview col-4-12'); ?>>
	

	<?php 	if ( has_post_thumbnail() ) { 
		$thumb = get_the_post_thumbnail_url(get_the_ID(),'large');
	}
	else {
		$thumb = get_template_directory_uri() .'/img/default-image.jpg';
	} ?>
	<a href="<?php the_permalink(); ?>" >
		<div class="thumbnail" style="background-image:url('<?php echo esc_url($thumb); ?>'); background-size: cover;"></div>
	</a>

	<header class="entry-header blog-title">
		<?php
	
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		 ?>
		<div class="entry-meta">
			<?php neptune_category();  ?>
		</div><!-- .entry-meta -->

	<?php //the_excerpt(); ?>
	</header><!-- .entry-header -->

	
</article><!-- #post-<?php the_ID(); ?> -->
