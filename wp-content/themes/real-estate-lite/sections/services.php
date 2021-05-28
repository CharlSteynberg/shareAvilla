<?php
$title = esc_html( get_theme_mod('service_title'));
$subtitle = esc_html( get_theme_mod('service_sub_title'));
$first = esc_html( get_theme_mod('first_service'));
$second = esc_html( get_theme_mod('second_service'));
$third = esc_html( get_theme_mod('third_service'));

?>
<div class="section service grey">
	<div class="grid">
	<h2 class="section-title"> <?php echo esc_html( $title) ; ?></h2>
	<?php if(!empty($subtitle)) : ?>
	<h5 class="section-sub-title"> <?php echo esc_html( $subtitle) ; ?></h5>
	<?php endif; ?>
		<?php 
	
		// The Query
		$args = array(
			'post_type' => 'page',
			'post__in' => array($first,$second,$third),
			'orderby' => 'post__in',
			);
		$feature = new WP_Query( $args );

	// The Loop
		if ( $feature->have_posts() ) {
			
				while ( $feature->have_posts() ) {
					?><div class="col-4-12"><?php
					$feature->the_post();
	if ( has_post_thumbnail() ) { ?>
		<div class='post-thumb'>
				<a href="<?php the_permalink();?>" >
				<?php the_post_thumbnail('real_estate_lite_page_thumb'); ?>
				</a>
		</div>
		<?php } ?>
		<?php the_title('<h2 class="entry-title">', '</h2>'); ?>
		<?php  the_excerpt(); ?>

		<a class="read_more" href="<?php esc_url(the_permalink()); ?>"> <?php esc_html_e( 'Read More', 'real-estate-lite' ); ?></a>
				
 
 	  <?php 
 	  echo "</div>";
 	  } } else { ?>
	<p><?php echo esc_attr( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php }  
		
		/* Restore original Post Data */
		wp_reset_postdata();
		?>
		
	</div>
	</div>