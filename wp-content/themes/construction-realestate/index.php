<?php
/**
 * The template for displaying home page.
 * @package Construction Realestate
 */
get_header(); ?>

<main id="skip_content" role="main">
  <?php /** post section **/ ?>
  <div class="container main-wrapper">
    <?php
    $construction_realestate_layout_option = get_theme_mod( 'construction_realestate_layout_options','Right Sidebar');
    if($construction_realestate_layout_option == 'One Column'){ ?>
      <div id="blog_sec" class="blog-section mt-0">
        <?php if ( have_posts() ) :
          /* Start the Loop */          
          while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content',get_post_format() );           
          endwhile;
          else :
            get_template_part( 'no-results' ); 
          endif; 
        ?>
        <div class="navigation">
          <?php
            // Previous/next page navigation.
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'construction-realestate' ),
                'next_text'          => __( 'Next page', 'construction-realestate' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-realestate' ) . ' </span>',
            ) );
          ?>
          <div class="clearfix"></div>
        </div>
      </div>
    <?php }else if($construction_realestate_layout_option == 'Three Columns'){ ?>
      <div class="row m-0">
        <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>
        <div id="blog_sec" class="blog-section col-lg-6 col-md-6 mt-0">
          <?php if ( have_posts() ) :
            /* Start the Loop */          
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content',get_post_format() );           
            endwhile;
            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <div class="navigation">
            <?php
              // Previous/next page navigation.
              the_posts_pagination( array(
                  'prev_text'          => __( 'Previous page', 'construction-realestate' ),
                  'next_text'          => __( 'Next page', 'construction-realestate' ),
                  'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-realestate' ) . ' </span>',
              ) );
            ?>
            <div class="clearfix"></div>
          </div>
        </div>
        <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
      </div>
    <?php }else if($construction_realestate_layout_option == 'Four Columns'){ ?>
      <div class="row m-0">
        <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>
        <div id="blog_sec" class="blog-section col-lg-3 col-md-3 mt-0">
          <?php if ( have_posts() ) :
            /* Start the Loop */          
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content',get_post_format() );           
            endwhile;
            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <div class="navigation">
            <?php
              // Previous/next page navigation.
              the_posts_pagination( array(
                  'prev_text'          => __( 'Previous page', 'construction-realestate' ),
                  'next_text'          => __( 'Next page', 'construction-realestate' ),
                  'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-realestate' ) . ' </span>',
              ) );
            ?>
            <div class="clearfix"></div>
          </div>
        </div>
        <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
        <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-3'); ?></div>
      </div>
    <?php }else if($construction_realestate_layout_option == 'Grid Layout'){ ?>
      <div id="blog_sec" class="blog-section row mt-0">
        <?php if ( have_posts() ) :
          /* Start the Loop */          
          while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/grid-layout' );           
          endwhile;
          else :
            get_template_part( 'no-results' ); 
          endif; 
        ?>
        <div class="navigation">
          <?php
            // Previous/next page navigation.
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'construction-realestate' ),
                'next_text'          => __( 'Next page', 'construction-realestate' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-realestate' ) . ' </span>',
            ) );
          ?>
          <div class="clearfix"></div>
        </div>
      </div>
    <?php }else if($construction_realestate_layout_option == 'Right Sidebar'){ ?>
      <div class="row m-0">
        <div id="blog_sec" class="blog-section col-lg-8 col-md-8 mt-0">
          <?php if ( have_posts() ) :
            /* Start the Loop */          
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content',get_post_format() );           
            endwhile;
            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <div class="navigation">
            <?php
              // Previous/next page navigation.
              the_posts_pagination( array(
                  'prev_text'          => __( 'Previous page', 'construction-realestate' ),
                  'next_text'          => __( 'Next page', 'construction-realestate' ),
                  'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-realestate' ) . ' </span>',
              ) );
            ?>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4"><?php get_sidebar(); ?></div>
      </div>
    <?php }else if($construction_realestate_layout_option == 'Left Sidebar'){ ?>
      <div class="row m-0">
        <div class="col-lg-4 col-md-4"><?php get_sidebar(); ?></div>
        <div id="blog_sec" class="blog-section col-lg-8 col-md-8 mt-0">
          <?php if ( have_posts() ) :
            /* Start the Loop */          
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content',get_post_format() );           
            endwhile;
            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <div class="navigation">
            <?php
              // Previous/next page navigation.
              the_posts_pagination( array(
                  'prev_text'          => __( 'Previous page', 'construction-realestate' ),
                  'next_text'          => __( 'Next page', 'construction-realestate' ),
                  'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-realestate' ) . ' </span>',
              ) );
            ?>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    <?php }else{?>
      <div class="row m-0">
        <div id="blog_sec" class="blog-section col-lg-8 col-md-8 mt-0">
          <?php if ( have_posts() ) :
            /* Start the Loop */          
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content',get_post_format() );           
            endwhile;
            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <div class="navigation">
            <?php
              // Previous/next page navigation.
              the_posts_pagination( array(
                  'prev_text'          => __( 'Previous page', 'construction-realestate' ),
                  'next_text'          => __( 'Next page', 'construction-realestate' ),
                  'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-realestate' ) . ' </span>',
              ) );
            ?>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4"><?php get_sidebar(); ?></div>
      </div>
    <?php }?>
  </div>
</main>

<?php get_footer(); ?>