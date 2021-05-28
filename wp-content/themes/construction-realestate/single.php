<?php
/**
 * The Template for displaying all single posts.
 * @package Construction Realestate
 */

get_header(); ?>

<div class="container" role="main">
    <main id="skip_content" class="main-wrapper">
    	<?php
        $construction_realestate_layout_option = get_theme_mod( 'construction_realestate_layout_options','Right Sidebar');
        if($construction_realestate_layout_option == 'One Column'){ ?>
			<div id="content_box">
				<?php while ( have_posts() ) : the_post();
					get_template_part('template-parts/single-post');
	            endwhile; // end of the loop. ?>
	       	</div>
	    <?php }else if($construction_realestate_layout_option == 'Three Columns'){ ?>
	    	<div class="row">
				<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
				<div class="col-lg-6 col-md-6" id="content_box">
					<?php while ( have_posts() ) : the_post();
						get_template_part('template-parts/single-post');
	            	endwhile; // end of the loop. ?>
		       	</div>
				<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
			</div>
		<?php }else if($construction_realestate_layout_option == 'Four Columns'){ ?>
			<div class="row">
				<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
				<div class="col-lg-3 col-md-3" id="content_box">
					<?php while ( have_posts() ) : the_post();
						get_template_part('template-parts/single-post');
	            	endwhile; // end of the loop. ?>
		       	</div>
				<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
				<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
			</div>
		<?php }else if($construction_realestate_layout_option == 'Grid Layout'){ ?>
			<div class="row">
				<div class="col-lg-8 col-md-8" id="content_box">
					<?php while ( have_posts() ) : the_post();
						get_template_part('template-parts/single-post');
	            	endwhile; // end of the loop. ?>
		       	</div>
				<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-2'); ?></div>
			</div>
	    <?php }else if($construction_realestate_layout_option == 'Left Sidebar'){ ?>
	    	<div class="row">
	    		<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
				<div class="col-lg-8 col-md-8" id="content_box">
					<?php while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/single-post' );
		            endwhile; // end of the loop. ?>
		       	</div>
	       	</div>
	    <?php }else if($construction_realestate_layout_option == 'Right Sidebar'){ ?>
	    	<div class="row">
		       	<div class="col-lg-8 col-md-8" id="content_box">
					<?php while ( have_posts() ) : the_post();
						get_template_part('template-parts/single-post');
		            endwhile; // end of the loop. ?>
		       	</div>
				<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
			</div>
		<?php }else{?>
			<div class="row">
		       	<div class="col-lg-8 col-md-8" id="content_box">
					<?php while ( have_posts() ) : the_post();
						get_template_part('template-parts/single-post');
		            endwhile; // end of the loop. ?>
		       	</div>
				<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
			</div>
		<?php }?>
	    <div class="clearfix"></div>
    </main>
</div>

<?php get_footer(); ?>