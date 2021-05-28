<?php
/**
 * nirman-construction: Customizer
 *
 * @subpackage nirman-construction
 * @since 1.0
 */

function nirman_construction_customize_register( $wp_customize ) {

	$wp_customize->add_setting('nirman_construction_show_site_title',array(
       'default' => true,
       'sanitize_callback'	=> 'nirman_construction_sanitize_checkbox'
    ));
    $wp_customize->add_control('nirman_construction_show_site_title',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Site Title','nirman-construction'),
       'section' => 'title_tagline'
    ));

    $wp_customize->add_setting('nirman_construction_show_tagline',array(
       'default' => true,
       'sanitize_callback'	=> 'nirman_construction_sanitize_checkbox'
    ));
    $wp_customize->add_control('nirman_construction_show_tagline',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Site Tagline','nirman-construction'),
       'section' => 'title_tagline'
    ));

	$wp_customize->add_panel( 'nirman_construction_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'nirman-construction' ),
	    'description' => __( 'Description of what this panel does.', 'nirman-construction' ),
	) );

	$wp_customize->add_section( 'nirman_construction_theme_options_section', array(
    	'title'      => __( 'General Settings', 'nirman-construction' ),
		'priority'   => 30,
		'panel' => 'nirman_construction_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('nirman_construction_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'nirman_construction_sanitize_choices'  
	));

	$wp_customize->add_control('nirman_construction_theme_options',array(
        'type' => 'radio',
        'label' => __('Do you want this section','nirman-construction'),
        'section' => 'nirman_construction_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','nirman-construction'),
            'Right Sidebar' => __('Right Sidebar','nirman-construction'),
            'One Column' => __('One Column','nirman-construction'),
            'Three Columns' => __('Three Columns','nirman-construction'),
            'Four Columns' => __('Four Columns','nirman-construction'),
            'Grid Layout' => __('Grid Layout','nirman-construction')
        ),
	));

	// Top Bar
	$wp_customize->add_section( 'nirman_construction_contact_details', array(
    	'title'      => __( 'Top Bar', 'nirman-construction' ),
		'priority'   => null,
		'panel' => 'nirman_construction_panel_id'
	) );
	
	$wp_customize->add_setting('nirman_construction_call1',array(
		'default'=> '',
		'sanitize_callback'	=> 'nirman_construction_sanitize_phone_number'
	));	
	$wp_customize->add_control('nirman_construction_call1',array(
		'label'	=> __('Phone Number','nirman-construction'),
		'section'=> 'nirman_construction_contact_details',
		'setting'=> 'nirman_construction_call1',
		'type'=> 'text'
	));

	//social icons
	$wp_customize->add_setting('nirman_construction_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('nirman_construction_facebook_url',array(
		'label'	=> __('Add Facebook link','nirman-construction'),
		'section'	=> 'nirman_construction_contact_details',
		'setting'	=> 'nirman_construction_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('nirman_construction_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('nirman_construction_twitter_url',array(
		'label'	=> __('Add Twitter link','nirman-construction'),
		'section'	=> 'nirman_construction_contact_details',
		'setting'	=> 'nirman_construction_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('nirman_construction_linkedin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('nirman_construction_linkedin_url',array(
		'label'	=> __('Add Linkedin link','nirman-construction'),
		'section'	=> 'nirman_construction_contact_details',
		'setting'	=> 'nirman_construction_linkedin_url',
		'type'	=> 'url'
	));
	
	$wp_customize->add_setting('nirman_construction_insta_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('nirman_construction_insta_url',array(
		'label'	=> __('Add Instagram link','nirman-construction'),
		'section'	=> 'nirman_construction_contact_details',
		'setting'	=> 'nirman_construction_insta_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('nirman_construction_pintrest_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('nirman_construction_pintrest_url',array(
		'label'	=> __('Add Pinterest link','nirman-construction'),
		'section'	=> 'nirman_construction_contact_details',
		'setting'	=> 'nirman_construction_pintrest_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('nirman_construction_btn_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('nirman_construction_btn_text',array(
		'label'	=> __('Add Button Text','nirman-construction'),
		'section'	=> 'nirman_construction_contact_details',
		'setting'	=> 'nirman_construction_btn_text',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('nirman_construction_btn_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('nirman_construction_btn_link',array(
		'label'	=> __('Add Button Link','nirman-construction'),
		'section'	=> 'nirman_construction_contact_details',
		'setting'	=> 'nirman_construction_btn_link',
		'type'	=> 'url'
	));
	
	//home page slider
	$wp_customize->add_section( 'nirman_construction_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'nirman-construction' ),
		'priority'   => null,
		'panel' => 'nirman_construction_panel_id'
	) );

	$wp_customize->add_setting('nirman_construction_slider_hide_show',array(
       	'default' => 'true',
       	'sanitize_callback'	=> 'nirman_construction_sanitize_checkbox'
	));
	$wp_customize->add_control('nirman_construction_slider_hide_show',array(
	   	'type' => 'checkbox',
	   	'label' => __('Show / Hide slider','nirman-construction'),
	   	'description' => __('Image Size ( 1600px x 582px )','nirman-construction'),
	   	'section' => 'nirman_construction_slider_section',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'nirman_construction_slider' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'nirman_construction_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'nirman_construction_slider' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'nirman-construction' ),
			'section'  => 'nirman_construction_slider_section',
			'type'     => 'dropdown-pages'
		) );
	}

	//	Our Topics
	$wp_customize->add_section('nirman_construction_service',array(
		'title'	=> __('Our Services','nirman-construction'),
		'description'=> __('This section will appear below the slider.','nirman-construction'),
		'panel' => 'nirman_construction_panel_id',
	));
	
	$wp_customize->add_setting('nirman_construction_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('nirman_construction_title',array(
		'label'	=> __('Section Title','nirman-construction'),
		'section'	=> 'nirman_construction_service',
		'setting'	=> 'nirman_construction_title',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('nirman_construction_subtitle',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('nirman_construction_subtitle',array(
		'label'	=> __('Section Subtitle','nirman-construction'),
		'section'	=> 'nirman_construction_service',
		'setting'	=> 'nirman_construction_subtitle',
		'type'		=> 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('nirman_construction_cat',array(
		'default'	=> 'select',
		'sanitize_callback' => 'nirman_construction_sanitize_choices',
	));
	$wp_customize->add_control('nirman_construction_cat',array(
		'type'    => 'select',
		'choices' => $cat_pst,
		'label' => __('Select Category to display Post','nirman-construction'),
		'section' => 'nirman_construction_service',
	));

	//Footer
    $wp_customize->add_section( 'nirman_construction_footer', array(
    	'title'      => __( 'Footer Text', 'nirman-construction' ),
		'priority'   => null,
		'panel' => 'nirman_construction_panel_id'
	) );

    $wp_customize->add_setting('nirman_construction_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('nirman_construction_footer_copy',array(
		'label'	=> __('Footer Text','nirman-construction'),
		'section'	=> 'nirman_construction_footer',
		'setting'	=> 'nirman_construction_footer_copy',
		'type'		=> 'text'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'nirman_construction_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'nirman_construction_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'nirman_construction_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'nirman_construction_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'nirman-construction' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'nirman-construction' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'nirman_construction_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'nirman_construction_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'nirman_construction_customize_register' );

function nirman_construction_customize_partial_blogname() {
	bloginfo( 'name' );
}

function nirman_construction_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function nirman_construction_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function nirman_construction_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Nirman_Construction_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Nirman_Construction_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Nirman_Construction_Customize_Section_Pro(
				$manager,
				'nirman_construction_example_1',
				array(
					'priority' => 9,
					'title'    => esc_html__( 'Construction Pro Theme', 'nirman-construction' ),
					'pro_text' => esc_html__( 'Go Pro','nirman-construction' ),
					'pro_url'  => esc_url( 'https://www.luzuk.com/product/construction-wordpress-theme/' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'nirman-construction-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'nirman-construction-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Nirman_Construction_Customize::get_instance();