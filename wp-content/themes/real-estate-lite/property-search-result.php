<?php
/**
 * The template for displaying search results, when the search if performed using the Advanced Search Option.
 * This template has been provided to work with WP Property Listings Plugin.
 * This file will not be executed if the Required plugin is not active.
 * (c) Rohit Tripathi 2017
 *
 * @package wpre
 */
 
//$_name = $_GET['name'] != '' ? esc_html($_GET['name']) : '';
$_location = $_GET['location'] != '' ? esc_html($_GET['location']) : '';
$_types = $_GET['type'] != '' ? esc_html($_GET['type']) : '';
$_contract = $_GET['listing_type'] != '' ? esc_html($_GET['listing_type']) : '';



get_header(); ?>

	<div id="primary" class="content-area grid">
		<main id="main" class="site-main" role="main">
		
		<?php //do_action('realest_display_search_form');

$tax_query = array( 'relation' => 'AND' );

//Location Types_Query


if (!empty($_location)) {
	$tax_query[] = array(
		'taxonomy' => 'location',
		'field' => 'id',
		'terms' => $_location
	);
}

// Types Tax_Query
if (!empty($_types)) {
	$tax_query[] = array(
		'taxonomy' => 'types',
		'field' => 'id',
		'terms' => $_types,
	);
}
// Contract Types meta_Query
if (!empty($_contract)) {
	$meta_query[] = array(
		'key' => '_realest_contract',
		'value' => $_contract,
    	'compare' => 'IN',

	);
}



			$p_args = array(
		        'post_type'     =>  'property', // your CPT
		        //'s'             =>  $_name, // looks into everything with the keyword from your 'name field'
		        //'relation' => 'AND',

 				'tax_query' => $tax_query,
 				'meta_query' => $meta_query,

		    );
		$propSearchQuery = new WP_Query( $p_args );	
			
		?>
		
		<?php if ( $propSearchQuery->have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php  echo esc_html__( 'Search Results', 'real-estate-lite' ); ?></h1>
			</header><!-- .page-header -->
			

			<?php get_template_part( 'sections/search' ); ?>

			<?php /* Start the Loop */ ?>
			<ul class="properties">
			<?php while ( $propSearchQuery->have_posts() ) : $propSearchQuery->the_post(); ?>

			
				  <li class="col-4-12">
      <div class="property-thumb">
      <?php if (get_the_post_thumbnail()) : ?>
      <a href="<?php the_permalink();?>" >
        <?php the_post_thumbnail('realest_property'); ?>
      </a>
      <?php endif; ?>
   <?php 
      //Show price or Lease
            $price = get_post_meta( get_the_ID(), '_realest_price', true );
            $lease = get_post_meta( get_the_ID(), '_realest_lease', true ); 

          if ( ! empty( $price ) ) : ?>
          <span class="price"><?php echo get_theme_mod('realest_currency') ;  echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); echo get_post_meta( get_the_ID(), '_realest_suffix', true );?></span>
        <?php else: ?>
          <span class="price"><?php echo get_theme_mod('realest_currency') ;  echo wp_kses( $lease, wp_kses_allowed_html( 'post' ) ); echo get_post_meta( get_the_ID(), '_realest_suffix', true );?></span>
        <?php endif; ?>
      <?php $featured = get_post_meta( get_the_ID(), '_realest_featured', true ); ?>
        <?php if ( ! empty( $featured ) ) : ?>
          <span class="featured"><?php  _e( 'Featured', 'pt-real-estate-proffesional' ); ?></span>

        <?php endif; ?>
        <?php 
        // $contract = wp_get_post_terms( get_the_ID(), 'contract_type');

        // foreach ( $contract as $term) { 
        //                  echo '<span class="contract">' . $term->name .'</span>';
        //                 }   
                        
          ?>

      <?php $featured = get_post_meta( get_the_ID(), '_realest_featured', true ); ?>
        <?php if ( ! empty( $featured ) ) : ?>
          <span class="featured"><?php  _e( 'Featured', 'real-estate-lite' ); ?></span>
        <?php endif; ?>
      </div>

      <ul class="property-info">
      <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
      <span class="location-marker">
        <?php $location = get_post_meta( get_the_ID(), '_realest_address', true ); ?>
        <i class="fa fa-map-marker"></i>
        <?php echo esc_html( $location ); ?>
        
      </span>
          <?php $beds = get_post_meta( get_the_ID(), '_realest_bedrooms', true ); ?>
          <?php if ( ! empty( $beds ) ) : ?>
            <li><i class="fa fa-bed"></i><span><?php _e( 'Beds', 'real-estate-lite' ); ?></span><span class="alignright"><?php echo esc_attr( $beds ); ?></span></li>
          <?php endif; ?>

          <?php $baths = get_post_meta( get_the_ID(), '_realest_baths', true ); ?>
          <?php if ( ! empty( $baths ) ) : ?>
            <li><i class="fa fa-bath"></i><span><?php _e( 'Baths', 'real-estate-lite' ); ?></span><span class="alignright"><?php echo esc_attr( $baths ); ?></span></li>
          <?php endif;?>

          <?php $rooms = get_post_meta( get_the_ID(), '_realest_rooms', true ); ?>
          <?php if ( ! empty( $rooms ) ) : ?>
            <li><i class="fa fa-th-large"></i><span><?php _e( 'Rooms', 'real-estate-lite' ); ?></span><span class="alignright"><?php echo esc_attr( $rooms ); ?></span></li>
          <?php endif;?>  
          </ul> 
    </li>

			

			<?php endwhile; ?>
		</ul>
		<?php else : ?>
			<?php get_template_part( 'sections/search'); ?>
			<?php _e('No Properties were found with specified parameters. Please search using different parameters.','real-estate-lite') ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>