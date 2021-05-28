<?php
/**
 * @package Construction Realestate
 * @subpackage construction-realestate
 * @since construction-realestate 1.0
 * Setup the WordPress core custom header feature.
 * @uses construction_realestate_header_style()
*/

function construction_realestate_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'construction_realestate_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 135,
		'flex-width'         	=> true,
        'flex-height'        	=> true,
		'wp-head-callback'       => 'construction_realestate_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'construction_realestate_custom_header_setup' );

if ( ! function_exists( 'construction_realestate_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see construction_realestate_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'construction_realestate_header_style' );
function construction_realestate_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$construction_realestate_custom_css = "
        #header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'construction-realestate-basic-style', $construction_realestate_custom_css );
	endif;
}
endif; // construction_realestate_header_style