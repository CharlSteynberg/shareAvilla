<?php
$title = esc_html( get_theme_mod('blog_title'));
$subtitle = esc_html( get_theme_mod('blog_sub_title'));
$nposts = esc_html( get_theme_mod('real-estate-lite-blog-number'));
?>
<div class="section blog">
	<div class="grid">
	<h2 class="section-title"> <?php echo esc_html( $title) ; ?></h2>
	<?php if(!empty($subtitle)) : ?>
	<h5 class="section-sub-title"> <?php echo esc_html( $subtitle) ; ?></h5>
<?php endif; ?>
	<?php
	$args = array(
		'post_type' => 'post',
		'posts_per_page'  => $nposts,
		);
	$wp_query = new WP_Query( $args);
		if ( $wp_query->have_posts() ) :


			/* Start the Loop */
			while ( $wp_query->have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */?>
				<div class="col-4-12 post-item"> 
				<?php get_template_part( 'template-parts/content-preview', get_post_format() ); ?>
				</div>
				<?php

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

	</div>
</div>