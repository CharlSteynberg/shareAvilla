<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<?php do_action( 'nirman_construction_above_slider' ); ?>

<?php if( get_theme_mod('nirman_construction_slider_hide_show') != ''){ ?>
	<section id="slider">
	  	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
		    <?php $nirman_construction_slider_pages = array();
		      	for ( $count = 1; $count <= 4; $count++ ) {
			        $mod = intval( get_theme_mod( 'nirman_construction_slider' . $count ));
			        if ( 'page-none-selected' != $mod ) {
			          	$nirman_construction_slider_pages[] = $mod;
			        }
		      	}
		      	if( !empty($nirman_construction_slider_pages) ) :
		        $args = array(
		          	'post_type' => 'page',
		          	'post__in' => $nirman_construction_slider_pages,
		          	'orderby' => 'post__in'
		        );
		        $query = new WP_Query( $args );
		        if ( $query->have_posts() ) :
		          $i = 1;
		    ?>     
		    <div class="carousel-inner" role="listbox">
		      	<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
		        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
		          	<a href="<?php echo esc_url( get_permalink() );?>"><?php the_post_thumbnail(); ?></a>
		          	<div class="carousel-caption">
			            <div class="inner_carousel">
			              	<h1><?php the_title(); ?></h1>
			              	<p><?php $excerpt = get_the_excerpt(); echo esc_html( nirman_construction_string_limit_words( $excerpt,15 ) ); ?></p>
			            </div>
			            <div class="read-btn">
			              <a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Read More', 'nirman-construction' ); ?>"><?php esc_html_e('Read More','nirman-construction'); ?><i class="fas fa-arrow-right"></i>
			              </a>
			            </div>
		          	</div>
		        </div>
		      	<?php $i++; endwhile; 
		      	wp_reset_postdata();?>
		    </div>
		    <?php else : ?>
		    <div class="no-postfound"></div>
		      <?php endif;
		    endif;?>
		    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
		    </a>
		    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
		    </a>
	  	</div>  
	  	<div class="clearfix"></div>
	</section>
<?php }?>

<?php do_action('nirman_construction_below_slider'); ?>

<?php /*--our-services --*/?>
<?php if( get_theme_mod('nirman_construction_title') != '' || get_theme_mod( 'nirman_construction_cat' )!= '' ||get_theme_mod('nirman_construction_subtitle') != ''){ ?>
	<section id="nirman-services">
		<div class="container">
			<div class="service-box">
				<?php if( get_theme_mod('nirman_construction_title') != ''){ ?>
		    		<h2><?php echo esc_html(get_theme_mod('nirman_construction_title','')); ?></h2>
		    	<?php }?>
		    	<?php if( get_theme_mod('nirman_construction_subtitle') != ''){ ?>
		    		<p class="para-const"><?php echo esc_html(get_theme_mod('nirman_construction_subtitle','')); ?></p>
		    		<hr>
		    	<?php }?>
		    		
	            <div class="row">
		      		<?php
		      		$nirman_construction_catData1 =  get_theme_mod('nirman_construction_cat');
          			if($nirman_construction_catData1){ 
		      			$page_query = new WP_Query(array( 'category_name' => esc_html($nirman_construction_catData1 ,'nirman-construction')));?>
		        		<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>	
		          			<div class="col-lg-3 col-md-4">
		          				<div class="service-section">
							      	<?php the_post_thumbnail(); ?>
			          				<div class="content-topic">
			          					<h3><?php the_title(); ?></h3>
					            		<p><?php $excerpt = get_the_excerpt(); echo esc_html( nirman_construction_string_limit_words( $excerpt,10 ) ); ?></p>
					            		<div class="read-btn">
							              <a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Read More', 'nirman-construction' ); ?>"><?php esc_html_e('Read More','nirman-construction'); ?><i class="fas fa-arrow-right"></i>
							              </a>
							            </div>
		            				</div>
		          				</div>
						    </div>    	
		          		<?php endwhile; 
		          	wp_reset_postdata();
		          	}?>
	      		</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</section>
<?php }?>

<?php do_action('nirman_construction_below_our_topics_section'); ?>

<div class="container lz-content">
  	<?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>