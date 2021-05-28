<?php
global $post;
/**
 * neptune functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Neptune WP
 */

if ( ! function_exists( 'neptune_real_estate_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function neptune_real_estate_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on neptune, use a find and replace
		 * to change 'neptune-real-estate' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'neptune-real-estate', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_post_type_support( 'page', 'excerpt' );
		/*	
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'neptune-real-estate' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'neptune_real_estate_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'neptune_real_estate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function neptune_real_estate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'neptune_real_estate_content_width', 640 );
}
add_action( 'after_setup_theme', 'neptune_real_estate_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function neptune_real_estate_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'neptune-real-estate' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-real-estate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'neptune-real-estate' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-real-estate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'neptune-real-estate' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-real-estate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'neptune-real-estate' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-real-estate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'neptune-real-estate' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-real-estate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'neptune_real_estate_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function neptune_real_estate_scripts() {
	wp_enqueue_style( 'neptune-style', get_stylesheet_uri() );

	wp_enqueue_style( 'neptune-grid', get_template_directory_uri() . '/css/grid.css');

	add_editor_style('netputune-editor', get_template_directory_uri() . '/css/editor.css');

	wp_enqueue_script( 'neptune-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'neptune-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'neptune_real_estate_scripts' );

/**
 * Implement the Custom Menu Walker.
 */
require get_template_directory() . '/inc/menu-walker.php';


require get_template_directory() . '/inc/neptune-strings.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * TGM activation
 */
require get_template_directory() . '/inc/libraries/TGM/class-tgm-plugin-activation.php';

/**
 * TGM add plugins
 */
require get_template_directory() . '/inc/tgm-include-plugins.php';
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * logo
 */
function neptune_real_estate_logo() {
	do_action( 'neptune_real_estate_logo' );
}


/**
 * Neptune Comments
 */
function neptune_real_estate_comments_before() {
	do_action( 'neptune_real_estate_comments_before' );
}
function neptune_real_estate_comments_after() {
	do_action( 'neptune_real_estate_comments_after' );
}
/**
 * Custom CSS
 */


if ( class_exists( 'Kirki' ) ) {

	Kirki::add_config( 'neptune', array(
        'option_name'   => 'theme_options', 
        'capability'    => 'edit_theme_options'
    ) );
}





add_action( 'tgmpa_register', 'neptune_register_required_theme_plugins' );

/**
 * Register the required plugins for this theme.
 *
 *  <snip />
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */


function neptune_register_required_theme_plugins() {
	if ( !is_plugin_active( 'neptune-real-estate-pro/neptune-real-estate.php' ) ) {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(


		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'kirki Customizer',
			'slug'      => 'kirki',
			'required'  => false,
		),
		array(
			'name'      => 'Neptune Real Estate',
			'slug'      => 'neptune-real-estate',
			'required'  => false,
		),		
		 
		// <snip />
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
			// <snip>...</snip>
			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
		*/
	);
	tgmpa( $plugins, $config );

}}
