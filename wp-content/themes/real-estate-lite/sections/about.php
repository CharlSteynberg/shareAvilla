<?php
$title = esc_html(get_theme_mod('about_title'));
$subtitle = esc_html(get_theme_mod('about_sub_title'));
$first = esc_html(get_theme_mod('first_about'));


?>
<div class="section about">
	<div class="grid">

		<?php 
	
		// The Query
		$args = array(
			'post_type' => 'page',
			'post__in' => array($first),
			);
		$feature = new WP_Query( $args );

	// The Loop
		if ( $feature->have_posts() ) {
			
				while ( $feature->have_posts() ) {
					?><div class="col-6-12"><?php
					$feature->the_post();
	if ( has_post_thumbnail() ) { ?>
		<div class='page-thumb'>
				<a href="<?php the_permalink();?>" >
				<?php the_post_thumbnail('real_estate_lite_property_slide'); ?>
				</a>
		</div>
		<?php } ?>
		</div>
		<div class="col-6-12 about-content">
			<h2 class="section-title"> <?php echo esc_html( $title) ; ?></h2>
	<h5 class="section-sub-title"> <?php echo esc_html( $subtitle) ; ?></h5>
		<?php

		echo '<div class="about-excerpt">';
		the_content();
		echo '</div>';

		?>

				
 
 	  <?php 
 	  echo "</div></div>";
 	  } } else { ?>
	<p><?php echo esc_attr( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php }  
		
		/* Restore original Post Data */
		wp_reset_postdata();
		?>
		
	</div>
	</div>