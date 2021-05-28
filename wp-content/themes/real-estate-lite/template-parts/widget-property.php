<?php

$args = array(
	'post_type' => 'property',
	'showposts' =>  '3' ,
	);

$query2 = new WP_Query( $args );

if( $query2->have_posts() ) {
	echo "<div class='grid'>";
	while ( $query2->have_posts()) {
	 $query2->the_post();
	 	echo "<div class='col-1-1 property-widget'>";
	 	echo "<div class='property-thumb'>";

	 	real_estate_lite_contract_type();

		the_post_thumbnail('medium');

		 $price = get_post_meta( get_the_ID(), '_real_estate_lite_price', true );
            if ( ! empty( $price ) ) :
               echo '<div class="price">' .  esc_attr( $price ) .'</div>';
            endif;
		echo "</div>";
		echo "<div class='content'>";
		the_title("<h3 class='entry-title'>","</h3>");

		 echo '<ul class="pwdetails">';
            $rooms = get_post_meta( get_the_ID(), '_real_estate_lite_rooms', true );
            if ( ! empty( $rooms ) ) :
               echo '<li>' . esc_attr( 'Rooms: ', 'real-estate-lite' ), esc_attr( $rooms ) .'</li>';
            endif;

            $bedrooms = get_post_meta( get_the_ID(), '_real_estate_lite_bedrooms', true );
            if ( ! empty( $bedrooms ) ) :
               echo '<li>' . esc_attr( 'Beds: ', 'real-estate-lite' ), esc_attr( $bedrooms ) .'</li>';
            endif;

            $baths = get_post_meta( get_the_ID(), '_real_estate_lite_baths', true );
            if ( ! empty( $baths ) ) :
               echo '<li>' . esc_attr( 'Baths: ', 'real-estate-lite' ), esc_attr( $baths ) .'</li>';
            endif;

           $garages = get_post_meta( get_the_ID(), '_real_estate_lite_garages', true );
            if ( ! empty( $garages ) ) :
               echo '<li>' . esc_attr( 'garages: ', 'real-estate-lite' ), esc_attr( $garages ) .'</li>';
            endif;


		echo "</ul></div> </div>";
	}
	echo "</div>";
wp_reset_postdata(); 

}

?>