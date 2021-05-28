<?php

Real_Estate_Lite::add_config( 'real-estate-lite', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod',
) );


/*SECTIONS */

//Home Page
Real_Estate_Lite::add_panel( 'section', array(
    'priority'    => 2,
    'title'       => __( 'Front Page Sections', 'real-estate-lite' ),
    'description' => __( 'Front Page Sections', 'real-estate-lite' ),
) );

Real_Estate_Lite::add_section( 'services_section', array(
    'title'          => __( 'Services Section', 'real-estate-lite' ),
    'description'    => __( 'What we do Content', 'real-estate-lite' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'section',
) );

Real_Estate_Lite::add_section( 'about_section', array(
    'title'          => __( 'About Section', 'real-estate-lite' ),
    'description'    => __( 'About Us Content', 'real-estate-lite' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'section',
) );
Real_Estate_Lite::add_section( 'address_section', array(
    'title'          => __( 'Contact Section', 'real-estate-lite' ),
    'description'    => __( 'Contact Information', 'real-estate-lite' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 12,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'section',
) );

Real_Estate_Lite::add_section( 'blog_section', array(
    'title'          => __( 'Blog Section', 'real-estate-lite' ),
    'description'    => __( 'Blog Posts', 'real-estate-lite' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'section',
) );


//about section title

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'service_title',
	'label'    => __( 'Section title', 'real-estate-lite' ),
	'section'  => 'services_section',
	'default'  => esc_attr__( 'What We Do', 'real-estate-lite' ),
	'priority' => 2,
) );

//about us sub heading
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'service_sub_title',
	'label'    => __( 'Section Sub heading', 'real-estate-lite' ),
	'section'  => 'services_section',
	'priority' => 3,
) );

//First Column
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'first_service',
	'label'       => __( 'Select First column content', 'real-estate-lite' ),
	'section'     => 'services_section',
	'default'     => 42,
	'priority'    => 4,
) );
//First Column
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'second_service',
	'label'       => __( 'Select First column content', 'real-estate-lite' ),
	'section'     => 'services_section',
	'default'     => 42,
	'priority'    => 4,
) );
//First Column
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'third_service',
	'label'       => __( 'Select First column content', 'real-estate-lite' ),
	'section'     => 'services_section',
	'default'     => 42,
	'priority'    => 4,
) );


//About Us Section settings_errors


//about section title

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'about_title',
	'label'    => __( 'Section title', 'real-estate-lite' ),
	'section'  => 'about_section',
	'default'  => esc_attr__( 'What We Do', 'real-estate-lite' ),
	'priority' => 2,
) );

//about us sub heading
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'about_sub_title',
	'label'    => __( 'Section Sub heading', 'real-estate-lite' ),
	'section'  => 'about_section',
	'priority' => 3,
) );

//First Column
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'first_about',
	'label'       => __( 'Select First column content', 'real-estate-lite' ),
	'section'     => 'about_section',
	'default'     => 42,
	'priority'    => 4,
) );

//Address page
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'address',
	'label'       => __( 'Select Your Contact page', 'real-estate-lite' ),
	'section'     => 'address_section',
	'default'     => 42,
	'priority'    => 1,
) );

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'contact_form_id',
	'label'    => __( 'Contact Form 7 Form ID', 'real-estate-lite' ),
	'section'  => 'address_section',
	'priority' => 3,
) );



/*
* Custom Header Image Text
*/

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'real_estate_lite_header_text',
	'label'    => __( 'Intro Text', 'real-estate-lite' ),
	'section'  => 'header_image',
	'priority' => 11,
) );

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'real_estate_lite_header_button_a',
	'label'    => __( 'Button A Label', 'real-estate-lite' ),
	'section'  => 'header_image',
	'priority' => 12,
	'default'  => esc_attr__( 'Button A', 'real-estate-lite' ),
	'description'    => __( 'Button A label', 'real-estate-lite' ),

) );
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'real_estate_lite_header_button_a_url',
	'label'    => __( 'Button A URL', 'real-estate-lite' ),
	'section'  => 'header_image',
	'priority' => 12,
	'description'    => __( 'Button A URL', 'real-estate-lite' ),

) );


Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'real_estate_lite_header_button_b',
	'label'    => __( 'Button B Label', 'real-estate-lite' ),
	'section'  => 'header_image',
	'priority' => 13,
	'default'  => esc_attr__( 'Button B', 'real-estate-lite' ),
	'description'    => __( 'Paste the button URL here, leave blank to disable the button', 'real-estate-lite' ),

) );
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'real_estate_lite_header_button_b_url',
	'label'    => __( 'Button B URL', 'real-estate-lite' ),
	'section'  => 'header_image',
	'priority' => 13,
	'description'    => __( 'Button B URL', 'real-estate-lite' ),

) );


/*
* Colors
*/

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'        => 'color',
	'settings'    => 'real_estate_lite_accent',
	'label'       => __( 'Main Accent Color', 'real-estate-lite' ),
	'section'     => 'colors',
	'default'     => '#f1572f',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
	),
    'output' => array(
        array(
            'element'  => 'a, #cssmenu ul li ul li:hover>a, #cssmenu ul li ul li.active>a a,.slider-info .fa, .widget .widget-title:after,.widget .widget-title span,	.property-box-price, #secondary .widget ul li a:hover,
						ul.double li:before,h3.price,.flex-direction-nav a,	.agent-widget span,	.property-widget h3.entry-title ,.slider .price, .widget .widget-title:after,.hentry .entry-title:after, .hentry .entry-title:after,ul.properties .property-info span.location-marker, ul.property-widget li .price',
            'property' => 'color',
        ),
        array(
            'element'  => 'button,input[type="button"],input[type="reset"],input[type="submit"],.form-group button, .slider-info ul.property-info-price li.price span a.pricee, .home-image .intro-header a.button-a, ul.properties .price,.alizarin,.address-content,.address',
            'property' => 'background-color',
        ),
        array(
        	'element' => '.home-image .intro-header a.button-a',
        	'property'=> 'border-color',
        	),

     )
));

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'        => 'color',
	'settings'    => 'real_estate_footer_color',
	'label'       => __( 'Footer Background', 'real-estate-lite' ),
	'section'     => 'colors',
	'default'     => '#1f1f1f',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
	),
    'output' => array(
        array(
            'element'  => '.site-footer',
            'property' => 'background-color',
        ),
       

     )
));

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'        => 'color',
	'settings'    => 'real_estate_footer__text_color',
	'label'       => __( 'Footer Text Color', 'real-estate-lite' ),
	'section'     => 'colors',
	'default'     => '#636363',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
	),
    'output' => array(
        array(
            'element'  => '.site-footer .site-info, .site-footer .widget, .site-footer .site-info a, .site-footer a',
            'property' => 'color',
        ),
       

     )
));

//blog section title

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'blog_title',
	'label'    => __( 'Section title', 'real-estate-lite' ),
	'section'  => 'blog_section',
	'default'  => esc_attr__( 'Latest News', 'real-estate-lite' ),
	'priority' => 2,
) );

//about us sub heading
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'blog_sub_title',
	'label'    => __( 'Section Sub heading', 'real-estate-lite' ),
	'section'  => 'blog_section',
	'priority' => 3,
) );
Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'number',
	'settings' => 'real-estate-lite-blog-number',
	'label'    => __( 'Number of Posts', 'real-estate-lite' ),
	'section'  => 'blog_section',
	'default'  => 6,
	'priority' => 2,
) );

/*SECTIONS */
Real_Estate_Lite::add_panel( 'fonts', array(
    'priority'    => 20,
    'title'       => __( 'Google Fonts', 'real-estate-lite' ),
    'description' => __( 'Choose your Fonts', 'real-estate-lite' ),
) );

Real_Estate_Lite::add_section( 'heading_font', array(
    'title'          => __( 'Header Font', 'real-estate-lite' ),
    'description'    => __( 'h1,h2,h3,h4,h5 fonts', 'real-estate-lite' ),
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel'          => 'fonts',
) );
Real_Estate_Lite::add_section( 'body_font', array(
    'title'          => __( 'Body Font', 'real-estate-lite' ),
    'description'    => __( 'Site typography', 'real-estate-lite' ),
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel'          => 'fonts',
) );

/**
 * Add the header typography control
 */
Real_Estate_Lite::add_field( 'real-estate-lite', array(
    'type'        => 'typography',
    'settings'    => 'headers_typography',
    'label'       => esc_attr__( 'Headers Typography', 'real-estate-lite' ),
    'description' => esc_attr__( 'Select the typography options for your headers.', 'real-estate-lite' ),
    'help'        => esc_attr__( 'The typography options you set here will override the heading Typography options for all headers on your site (post titles, widget titles etc).', 'real-estate-lite' ),
    'section'     => 'heading_font',
    'priority'    => 10,
    'default'     => array(
        'font-family'    => 'Montserrat',
        'variant'        => '400',
    ),
    'output' => array(
        array(
            'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6', '.header-meta b' ),
        ),
    ),
) );

/**
 * Add the header typography control
 */
Real_Estate_Lite::add_field( 'real-estate-lite', array(
    'type'        => 'typography',
    'settings'    => 'body_typography',
    'label'       => esc_attr__( 'Body Font', 'real-estate-lite' ),
    'description' => esc_attr__( 'Select the typography options for body text.', 'real-estate-lite' ),
    'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all texts on your site except headers.', 'real-estate-lite' ),
    'section'     => 'body_font',
    'priority'    => 10,
    'default'     => array(
        'font-family'    => 'Fira Sans',
        'variant'        => '400',
    ),
    'output' => array(
        array(
            'element' => array( 'body' ),
        ),
    ),
) );

Real_Estate_Lite::add_field( 'real-estate-lite', array(
	'type'     => 'text',
	'settings' => 'footer-credit',
	'label'    => __( 'Footer Credit', 'pt-real-estate-proffesional' ),
	'section'  => 'footer_section',
	'priority' => 10,
) );
