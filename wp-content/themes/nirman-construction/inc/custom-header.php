<?php
/**
 * Custom header implementation
 */

function nirman_construction_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'nirman_construction_custom_header_args', array(

		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'nirman_construction_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'nirman_construction_custom_header_setup' );

if ( ! function_exists( 'nirman_construction_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see nirman_construction_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'nirman_construction_header_style' );
function nirman_construction_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        .menu-section{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'nirman-construction-basic-style', $custom_css );
	endif;
}
endif; // nirman_construction_header_style