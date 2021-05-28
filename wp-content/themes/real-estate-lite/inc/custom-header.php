<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package real-estate-lite
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses real_estate_lite_header_style()
 * @uses real_estate_lite_admin_header_style()
 * @uses real_estate_lite_admin_header_image()
 */
function real_estate_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'real_estate_lite_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 550,
		'flex-height'            => true,
		'default-image' 		 => get_template_directory_uri() . '/img/default.jpg',
        'uploads'       		 => true,
		'wp-head-callback'       => 'real_estate_lite_header_style',
		'admin-head-callback'    => 'real_estate_lite_admin_header_style',
		'admin-preview-callback' => 'real_estate_lite_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'real_estate_lite_custom_header_setup' );

if ( ! function_exists( 'real_estate_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see real_estate_lite_custom_header_setup().
 */
function real_estate_lite_header_style() {
	$header_text_color = get_header_textcolor();



	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // real_estate_lite_header_style

if ( ! function_exists( 'real_estate_lite_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see real_estate_lite_custom_header_setup().
 */
function real_estate_lite_admin_header_style() {
	$headerimg = esc_htm( get_header_image());
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		.header-image {
			background-color: #fff;
			background: url('<?php echo esc_url ( $headerimg); ?>;');
		}
		#headimg img {
		}

	</style>
<?php
}
endif; // real_estate_lite_admin_header_style

if ( ! function_exists( 'real_estate_lite_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see real_estate_lite_custom_header_setup().
 */
function real_estate_lite_admin_header_image() {
?>
	<div id="headimg">
		<h1 class="displaying-header-text">
			<a id="name" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<div class="displaying-header-text" id="desc" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // real_estate_lite_admin_header_image
