<?php
/**
 * neptune Theme Customizer
 *
 * @package Neptune WP
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function neptune_real_estate_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'neptune_real_estate_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'neptune_real_estate_customize_partial_blogdescription',
		) );
	}

	// View PRO Version
	$wp_customize->add_section( 'neptune_style_view_pro', array(
		'title'       => '' . esc_html__( 'Upgrage to Pro', 'neptune-real-estate' ),
		'priority'    => 2,
		'description' => sprintf(
			//unintrosive upsell message
			__( '<div class="upsell-container">
					<h2>Get Neptune PRO Now!</h2>
					<p>Get the pro add-on plugin today:</p>
					<ul class="upsell-features">
                            <li>
                            	<h4>Property Features</h4>
                            	<div class="description">Get more property features such as sliders, image galleries, google maps support & more</div>
                            </li>

                            <li>
                            	<h4>Dynamic Homepage</h4>
                            	<div class="description">Create a dynamic homepage with property, agents, maps & teams block</div>
                            </li>
                            
                            <li>
                            	<h4>Translation</h4>
                            	<div class="description">Translate your website to any language supported by WordPress, from Spanish, French, Dutch & more.</div>
                            </li>

                            <li>
                            	<h4>One On One Email Support</h4>
                            	<div class="description">Get one on one email support from our experienced support stuff, we can also help you modify the theme to your liking</div>
                            </li>
                            
                    </ul> %s </div>', 'neptune-real-estate' ),
			sprintf( '<a href="%1$s" target="_blank" class="button button-primary">%2$s</a>', esc_url( neptune_get_pro_link() ), esc_html__( 'Upgrade To PRO', 'neptune-real-estate' ) )
		),
	) );
	$wp_customize->add_setting( 'neptune_pro_desc', array(
		'default'           => '',
		'sanitize_callback' => 'neptune_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'neptune_pro_desc', array(
		'section' => 'neptune_style_view_pro',
		'type'    => 'hidden',
	) );
}
add_action( 'customize_register', 'neptune_real_estate_customize_register' );

function neptune_real_estate_sections( $wp_customize ) {
	/**
	 * Add panels
	 */
	$wp_customize->add_panel( 'fonts', array(
		'priority'    => 10,
		'title'       => esc_html__( 'Custom Fonts', 'neptune-real-estate' ),
	) );
	$wp_customize->add_panel( 'frontpage', array(
		'priority'    => 1,
		'title'       => esc_html__( 'Front Page', 'neptune-real-estate' ),
	) );
	/**
	 * Add sections
	 */
     $wp_customize->add_section( 'body_fonts', array(
 		'title'       => esc_html__( 'Body fonts', 'neptune-real-estate' ),
 		'priority'    => 10,
 		'panel'       => 'fonts',
 	) );

     $wp_customize->add_section( 'header_fonts', array(
 		'title'       => esc_html__( 'Header fonts', 'neptune-real-estate' ),
 		'priority'    => 10,
 		'panel'       => 'fonts',
 	) );

      $wp_customize->add_section( 'properties', array(
 		'title'       => esc_html__( 'Properties', 'neptune-real-estate' ),
 		'priority'    => 2,
 		//'panel'       => 'frontpage',
 		
 	) );  

}


add_action( 'customize_register', 'neptune_real_estate_sections' );

function neptune_real_estate_settings( $wp_customize ) {

if ( class_exists( 'Kirki' ) ) {
		//section one text color
	Kirki::add_field( 'neptune', array(
		'type'        => 'color-palette',
		'settings'    => 'accent_color',
		'label'       => esc_html__( 'Site Accent Color', 'neptune-real-estate' ),
		'description' => esc_html__( 'Accent Colors', 'neptune-real-estate' ),
		'section'     => 'colors',
		'default'     => '#2ecc71',
		'choices'     => array(
			'colors' => Kirki_Helper::get_material_design_colors( 'primary' ),
			'size'   => 25,
		),
		'output' => array(
			array(
				'element'  => 'button, a.button,.property-preview .for-sale, .slider-price .more,button, input[type="button"], input[type="reset"], input[type="submit"],.range-slider__range::-webkit-slider-thumb,.range-slider__range:active::-webkit-slider-thumb',
				'property' => 'background-color',
			),
			array(
				'element'  => 'a.button',
				'property' => 'border-color',
			),
			array(
				'element'  => '.slider-price .more:before',
				'property' => 'border-bottom-color',
			),
			
			array(
				'element'  => '.property-details .location a,.entry-meta a',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'neptune', array(
		'type'        => 'color',
		'settings'    => 'footer_bg',
		'label'       => esc_html__( 'Footer Background Color', 'neptune-real-estate' ),
		'section'     => 'colors',
		'default'     => 'rgba(5,25,56,0.95)',
		'choices'     => array(
		'alpha' => true,
			),
		'output' => array(
			array(
				'element'  => '.footer-overlay',
				'property' => 'background-color',
			),

		),
	) );

	Kirki::add_field( 'neptune', array(
		'type'        => 'color',
		'settings'    => 'footer_text_color',
		'label'       => esc_html__( 'Footer Text Color', 'neptune-real-estate' ),
		'section'     => 'colors',
		'default'     => '#42b2f8',
		'choices'     => array(
		'alpha' => true,
			),
		'output' => array(
			array(
				'element'  => '.site-footer .widget a, .site-footer .widget, .site-footer .widget ul li:before',
				'property' => 'color',
			),

		),
	) );

	Kirki::add_field( 'neptune', array(
		'type'        => 'color',
		'settings'    => 'footer_widget_color',
		'label'       => esc_html__( 'Footer Widget header Text Color', 'neptune-real-estate' ),
		'section'     => 'colors',
		'default'     => '#ffffff',
		'choices'     => array(
		'alpha' => true,
			),
		'output' => array(
			array(
				'element'  => '.site-footer .widget h2',
				'property' => 'color',
			),

		),
	) );
	kirki::add_field( 'neptune', array(
		'type'     => 'text',
		'settings' => 'currency',
		'label'    => esc_html__( 'Property Currency', 'neptune-real-estate' ),
		'section'  => 'properties',
		'priority' => 1,
		'default'  => esc_html__( '$', 'neptune-real-estate' ),
		'description'    => esc_html__( 'Property Price Currency', 'neptune-real-estate' ),

	) );

	/**
	 * Add the body-typography control
	 */
	Kirki::add_field( 'neptune', array(
	    'type'        => 'typography',
	    'settings'    => 'body_typography',
	    'label'       => esc_html__( 'Body Typography', 'neptune-real-estate' ),
	    'description' => esc_html__( 'Select the main typography options for your site.', 'neptune-real-estate' ),
	    'help'        => esc_html__( 'The typography options you set here apply to all content on your site.', 'neptune-real-estate' ),
	    'section'     => 'body_fonts',
	    'priority'    => 10,
	    'default'     => array(
	        'font-family'    => 'Roboto',
	        'variant'        => '400',
	        'font-size'      => '16px',
	        'line-height'    => '1.5',
	        'color'          => '#333333',
	    ),
	    'output' => array(
	        array(
	            'element' => 'body, p',
	        ),
	    ),
	) );

	/**
	 * Add the body-typography control
	 */
	Kirki::add_field( 'neptune', array(
	    'type'        => 'typography',
	    'settings'    => 'headers_typography',
	    'label'       => esc_html__( 'Headers Typography', 'neptune-real-estate' ),
	    'description' => esc_html__( 'Select the typography options for your headers.', 'neptune-real-estate' ),
	    'help'        => esc_html__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'neptune-real-estate' ),
	    'section'     => 'header_fonts',
	    'priority'    => 10,
	    'default'     => array(
	        'font-family'    => 'Oswald',
	    ),
	    'output' => array(
	        array(
	            'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ,'.blog-item h2 a, h2.section-title, .property-search input, .property-search select'),
	        ),
	    ),
	) );
}
}
add_action( 'init', 'neptune_real_estate_settings' );
/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function neptune_real_estate_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function neptune_real_estate_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function neptune_real_estate_customize_preview_js() {
	wp_enqueue_script( 'neptune-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'neptune_real_estate_customize_preview_js' );

/**
 * Admin CSS
 */
function neptune_customizer_assets() {
    wp_enqueue_style( 'neptune_customizer_style', get_template_directory_uri() . '/css/admin.css', null, '1.0.0', false );
}
add_action( 'customize_controls_enqueue_scripts', 'neptune_customizer_assets' );
/**
 * Generate a link to the Noah Lite info page.
 */
function neptune_get_pro_link() {
    return 'https://thepixeltribe.com/template/neptune-real-estate/';
}