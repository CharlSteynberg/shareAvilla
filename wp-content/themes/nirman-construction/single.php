<?php
/**
 * The template for displaying all single posts
 * 
 * @subpackage nirman-construction
 * @since 1.0
 * @version 0.1
 */

get_header(); ?>

<div class="container">
	<div class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
		    $nirman_construction_layout_option = get_theme_mod( 'nirman_construction_theme_options', 'Right Sidebar');
		    if($nirman_construction_layout_option == 'Left Sidebar'){ ?>
		    	<div class="row">
			        <div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
			        <div id="" class="content_area col-lg-8 col-md-8">
				    	<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content-single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'nirman-construction' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'nirman-construction' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
					<div class="clearfix"></div>
				</div>			
			<?php }else if($nirman_construction_layout_option == 'Right Sidebar'){ ?>
				<div class="row">
					<div id="" class="content_area col-lg-8 col-md-8">
						<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content-single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'nirman-construction' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'nirman-construction' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
					<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
				</div>
			<?php }else if($nirman_construction_layout_option == 'One Column'){ ?>
					<div id="" class="content_area">
						<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content-single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'nirman-construction' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'nirman-construction' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>			
			<?php }else if($nirman_construction_layout_option == 'Three Columns'){ ?>	
				<div class="row">
					<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>	
					<div id="" class="content_area col-lg-6 col-md-6">
						<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content-single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'nirman-construction' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'nirman-construction' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
					<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
				</div>
			<?php }else if($nirman_construction_layout_option == 'Four Columns'){ ?>
				<div class="row">
					<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>
					<div id="" class="content_area col-lg-3 col-md-3">
						<section id="post_section">
								<?php
								/* Start the Loop */
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/post/content-single' );

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

									the_post_navigation( array(
										'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'nirman-construction' ) . '</span>',
										'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'nirman-construction' ) . '</span> ',
									) );

								endwhile; // End of the loop.
								?>
						</section>
					</div>
					<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
			        <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-3'); ?></div>
		        </div>
	    	<?php }else if($nirman_construction_layout_option == 'Grid Layout'){ ?>
		    	<div class="row">
			    	<div id="" class="content_area col-lg-8 col-md-8">
						<section id="post_section">
							<div class="row">
								<?php
								/* Start the Loop */
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/post/content-single' );

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

									the_post_navigation( array(
										'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'nirman-construction' ) . '</span>',
										'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'nirman-construction' ) . '</span> ',
									) );

								endwhile; // End of the loop.
								?>
				                <div class="clearfix"></div>
							</div>
						</section>
					</div>
					<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>	
				</div>		
			<?php } else { ?>
				<div class="row">
					<div id="" class="content_area col-lg-8 col-md-8">
						<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content-single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'nirman-construction' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'nirman-construction' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'nirman-construction' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
					<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
				</div>
			<?php } ?>
		</main>
	</div>
</div>

<?php get_footer();