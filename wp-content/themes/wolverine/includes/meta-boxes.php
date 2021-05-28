<?php
/*
*
*	Meta Box Functions
*	------------------------------------------------
*	G5Plus Framework
* 	Copyright Swift Ideas 2015 - http://www.g5plus.net
*
*/
global $meta_boxes;

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function g5plus_register_meta_boxes()
{
	global $meta_boxes;
	$prefix = 'g5plus_';
	/* PAGE MENU */
	$menu_list = array();
	if ( function_exists( 'g5plus_get_menu_list' ) ) {
		$menu_list = g5plus_get_menu_list();
	}

// POST FORMAT: Image
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => __('Post Format: Image', 'wolverine'),
		'id' => $prefix .'meta_box_post_format_image',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => __('Image', 'wolverine'),
				'id' => $prefix . 'post_format_image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'desc' => __('Select a image for post','wolverine')
			),
		),
	);

// POST FORMAT: Gallery
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => __('Post Format: Gallery', 'wolverine'),
		'id' => $prefix . 'meta_box_post_format_gallery',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => __('Images', 'wolverine'),
				'id' => $prefix . 'post_format_gallery',
				'type' => 'image_advanced',
				'desc' => __('Select images gallery for post','wolverine')
			),
		),
	);

// POST FORMAT: Video
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => __('Post Format: Video', 'wolverine'),
		'id' => $prefix . 'meta_box_post_format_video',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => __( 'Video URL or Embeded Code', 'wolverine' ),
				'id'   => $prefix . 'post_format_video',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: Audio
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => __('Post Format: Audio', 'wolverine'),
		'id' => $prefix . 'meta_box_post_format_audio',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => __( 'Audio URL or Embeded Code', 'wolverine' ),
				'id'   => $prefix . 'post_format_audio',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: QUOTE
//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => __('Post Format: Quote', 'wolverine'),
        'id' => $prefix . 'meta_box_post_format_quote',
        'post_types' => array('post'),
        'fields' => array(
            array(
                'name' => __( 'Quote', 'wolverine' ),
                'id'   => $prefix . 'post_format_quote',
                'type' => 'textarea',
            ),
            array(
                'name' => __( 'Author', 'wolverine' ),
                'id'   => $prefix . 'post_format_quote_author',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author Url', 'wolverine' ),
                'id'   => $prefix . 'post_format_quote_author_url',
                'type' => 'url',
            ),
        ),
    );
    // POST FORMAT: LINK
	//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => __('Post Format: Link', 'wolverine'),
        'id' => $prefix . 'meta_box_post_format_link',
        'post_types' => array('post'),
        'fields' => array(
            array(
                'name' => __( 'Url', 'wolverine' ),
                'id'   => $prefix . 'post_format_link_url',
                'type' => 'url',
            ),
            array(
                'name' => __( 'Text', 'wolverine' ),
                'id'   => $prefix . 'post_format_link_text',
                'type' => 'text',
            ),
        ),
    );

	// PAGE LAYOUT
	$meta_boxes[] = array(
		'id' => $prefix . 'page_layout_meta_box',
		'title' => __('Page Layout', 'wolverine'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => __( 'Layout Style', 'wolverine' ),
				'id'    => $prefix . 'layout_style',
				'type'  => 'button_set',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'boxed'	  => __('Boxed','wolverine'),
					'wide'	  => __('Wide','wolverine'),
					'float'	  => __('Float','wolverine')
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => __( 'Page Layout', 'wolverine' ),
				'id'    => $prefix . 'page_layout',
				'type'  => 'button_set',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'full'	  => __('Full Width','wolverine'),
					'container'	  => __('Container','wolverine'),
					'container-fluid'	  => __('Container Fluid','wolverine'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => __( 'Page Sidebar', 'wolverine' ),
				'id'    => $prefix . 'page_sidebar',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'none'	  => THEME_URL.'/assets/images/theme-options/sidebar-none.png',
					'left'	  => THEME_URL.'/assets/images/theme-options/sidebar-left.png',
					'right'	  => THEME_URL.'/assets/images/theme-options/sidebar-right.png',
					'both'	  => THEME_URL.'/assets/images/theme-options/sidebar-both.png'
				),
				'std'	=> '',
				'multiple' => false,

			),
			array (
				'name' 	=> __('Left Sidebar', 'wolverine'),
				'id' 	=> $prefix . 'page_left_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','wolverine'),
				'std' 	=> '',
				'required-field' => array($prefix . 'page_sidebar','=',array('','left','both')),
			),

			array (
				'name' 	=> __('Right Sidebar', 'wolverine'),
				'id' 	=> $prefix . 'page_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','wolverine'),
				'std' 	=> '',
				'required-field' => array($prefix . 'page_sidebar','=',array('','right','both')),
			),

			array(
				'name'  => __( 'Sidebar Width', 'wolverine' ),
				'id'    => $prefix . 'sidebar_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'		=> __('Default','wolverine'),
					'small'		=> __('Small (1/4)','wolverine'),
					'larger'	=> __('Large (1/3)','wolverine')
				),
				'std'	=> '-1',
				'multiple' => false,
				'required-field' => array($prefix . 'page_sidebar','<>','none'),
			),

			array (
				'name' 	=> __('Page Class Extra', 'wolverine'),
				'id' 	=> $prefix . 'page_class_extra',
				'type' 	=> 'text',
				'std' 	=> ''
			),
		)
	);

	// SITE TOP & TOP DRAWER
	$meta_boxes[] = array(
		'id' => $prefix . 'site_top_meta_box',
		'title' => __('Site top & Top drawer', 'wolverine'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> __('Top Drawer Type', 'wolverine'),
				'id' 	=> $prefix . 'top_drawer_type',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'none' => __('Disable','wolverine'),
					'show' => __('Always Show','wolverine'),
					'toggle' => __('Toggle','wolverine')
				),
				'desc' => __('Top drawer type', 'wolverine'),
			),
			array (
				'name' 	=> __('Top Drawer Sidebar', 'wolverine'),
				'id' 	=> $prefix . 'top_drawer_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','wolverine'),
				'std' 	=> '',
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> __('Top Drawer Wrapper Layout', 'wolverine'),
				'id' 	=> $prefix . 'top_drawer_wrapper_layout',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'full' => __('Full Width','wolverine'),
					'container' => __('Container','wolverine'),
					'container-fluid' => __('Container Fluid','wolverine')
				),
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> __('Top Drawer hide on mobile', 'wolverine'),
				'id' 	=> $prefix . 'top_drawer_hide_mobile',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => __('Show on mobile','wolverine'),
					'0' => __('Hide on mobile','wolverine'),
				),
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> __('Top Drawer padding top', 'wolverine'),
				'id' 	=> $prefix . 'top_drawer_padding_top',
				'type' 	=> 'text',
				'desc' => __("Set padding top for top drawer. Not include units. Blank to default", 'wolverine'),
				'std'	=> '',
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> __('Top Drawer padding bottom', 'wolverine'),
				'id' 	=> $prefix . 'top_drawer_padding_bottom',
				'type' 	=> 'text',
				'desc' => __("Set padding top for bottom drawer. Not include units. Blank to default", 'wolverine'),
				'std'	=> '',
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> __('Show/Hide Top Bar', 'wolverine'),
				'id' 	=> $prefix . 'top_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => __('Show Top Bar','wolverine'),
					'0' => __('Hide Top Bar','wolverine')
				),
				'desc' => __('Show Hide Top Bar.', 'wolverine'),
			),

			array (
				'name' 	=> __('Top Bar Layout', 'wolverine'),
				'id' 	=> $prefix . 'top_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'top-bar-1' => THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg',
					'top-bar-2' => THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg',
					'top-bar-3' => THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg',
					'top-bar-4' => THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'
				),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> __('Top Left Sidebar', 'wolverine'),
				'id' 	=> $prefix . 'top_left_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => __('Select Sidebar','wolverine'),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> __('Top Right Sidebar', 'wolverine'),
				'id' 	=> $prefix . 'top_right_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => __('Select Sidebar','wolverine'),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),
		)
	);


	// PAGE HEADER
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_header_meta_box',
		'title' => __('Page Header', 'wolverine'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> __('Header On/Off?', 'wolverine'),
				'id' 	=> $prefix . 'header_show_hide',
				'type' 	=> 'checkbox',
				'desc' => __("Switch header ON or OFF?", 'wolverine'),
				'std'	=> '1',
			),

			array (
				'name' 	=> __('Header Layout', 'wolverine'),
				'id' 	=> $prefix . 'header_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'std'	=> '',
				'options' => array(
					'header-1'	    => THEME_URL.'/assets/images/theme-options/header-1.png',
					'header-2'	    => THEME_URL.'/assets/images/theme-options/header-2.png',
					'header-3'	    => THEME_URL.'/assets/images/theme-options/header-3.png',
					'header-4'	    => THEME_URL.'/assets/images/theme-options/header-4.png',
					'header-5'	    => THEME_URL.'/assets/images/theme-options/header-5.png',
					'header-6'	    => THEME_URL.'/assets/images/theme-options/header-6.png',
					'header-7'	    => THEME_URL.'/assets/images/theme-options/header-7.jpg',
				),
				'required-field' => array($prefix . 'header_show_hide','=','1'),
			),

			array(
				'id' => $prefix . 'header_tag_line',
				'name' => __('Tagline', 'wolverine'),
				'desc' => __("Set Tagline for header.", 'wolverine'),
				'type'  => 'text',
				'std' => '',
				'required-field' => array(
					array($prefix . 'header_show_hide','=','1'),
					array($prefix . 'header_layout','=','header-4'),
				)
			),

			array(
				'id'    => $prefix . 'header_background_enable',
				'name'  => __( 'Custom header background?', 'wolverine' ),
				'type'  => 'checkbox',
				'desc' => __("Switch ON to custom header background", 'wolverine'),
				'std'	=> 0,
				'required-field' => array($prefix . 'header_show_hide','=','1'),
			),

			array(
				'id' => $prefix . 'header_background_color',
				'name' => __('Header background color', 'wolverine'),
				'desc' => __("Set header background color.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array(
					array($prefix . 'header_background_enable','=','1'),
					array($prefix . 'header_show_hide','=','1'),
				)
			),

			array(
				'id'         => $prefix .'header_background_color_opacity',
				'name'       => __( 'Header background color opacity', 'wolverine' ),
				'desc'       => __( 'Set the opacity level of the header background color', 'wolverine' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array(
					array($prefix . 'header_background_enable','=','1'),
					array($prefix . 'header_show_hide','=','1'),
				)
			),

			array(
				'id'    => $prefix.  'header_background_image',
				'name'  => __('Header Background Image', 'wolverine'),
				'desc'  => __('Set header background image', 'wolverine'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'std' => '',
				'required-field' => array(
					array($prefix . 'header_background_enable','=','1'),
					array($prefix . 'header_show_hide','=','1'),
				)
			),

			array(
				'id'    => $prefix.  'header_background_repeat',
				'name'  => __('Header Background Repeat', 'wolverine'),
				'desc'  => __('Set header background repeat', 'wolverine'),
				'type'  => 'select_advanced',
				'placeholder' => __('Background Repeat','wolverine'),
				'std' => '',
				'options' => array(
					'no-repeat' => __('No Repeat','wolverine'),
					'repeat'    => __('Repeat','wolverine'),
					'repeat-x'  => __('Repeat-x','wolverine'),
					'repeat-y'  => __('Repeat-y','wolverine'),
					'inherit'   => __('Inherit','wolverine'),
				),
				'required-field' => array(
					array($prefix . 'header_background_enable','=','1'),
					array($prefix . 'header_show_hide','=','1'),
				)
			),

			array(
				'id'    => $prefix.  'header_background_size',
				'name'  => __('Header Background Size', 'wolverine'),
				'desc'  => __('Set header background size', 'wolverine'),
				'type'  => 'select_advanced',
				'placeholder' => __('Background size','wolverine'),
				'std' => '',
				'options' => array(
					'inherit'   => __('Inherit','wolverine'),
					'cover'    => __('Cover','wolverine'),
					'contain' => __('Contain','wolverine'),
				),
				'required-field' => array(
					array($prefix . 'header_background_enable','=','1'),
					array($prefix . 'header_show_hide','=','1'),
				)
			),

			array(
				'id'    => $prefix.  'header_background_attachment',
				'name'  => __('Header Background Attachment', 'wolverine'),
				'desc'  => __('Set header background attachment', 'wolverine'),
				'type'  => 'select_advanced',
				'placeholder' => __('Background attachment','wolverine'),
				'std' => '',
				'options' => array(
					'fixed'   => __('Fixed','wolverine'),
					'scroll'    => __('Scroll','wolverine'),
					'inherit' => __('Inherit','wolverine'),
				),
				'required-field' => array(
					array($prefix . 'header_background_enable','=','1'),
					array($prefix . 'header_show_hide','=','1'),
				)
			),

			array(
				'id'    => $prefix.  'header_background_position',
				'name'  => __('Header Background Position', 'wolverine'),
				'desc'  => __('Set header background position', 'wolverine'),
				'type'  => 'select_advanced',
				'placeholder' => __('Background position','wolverine'),
				'std' => '',
				'options' => array(
					'left top'      => __('Left Top','wolverine'),
					'left center'   => __('Left center','wolverine'),
					'left bottom'   => __('Left bottom','wolverine'),
					'center top'    => __('Center top','wolverine'),
					'center center' => __('Center center','wolverine'),
					'center bottom' => __('Center bottom','wolverine'),
					'right top'     => __('Right top','wolverine'),
					'right center'  => __('Right center','wolverine'),
					'right bottom'  => __('Right bottom','wolverine'),
				),
				'required-field' => array(
					array($prefix . 'header_background_enable','=','1'),
					array($prefix . 'header_show_hide','=','1'),
				)
			),

			array(
				'id'    => $prefix . 'header_nav_layout',
				'name'  => __( 'Header navigation layout', 'wolverine' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'container' => __('Container','wolverine'),
					'nav-fullwith' => __('Full width','wolverine'),
				),
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),

			array(
				'id'         => $prefix .'header_nav_layout_padding',
				'name'       => __( 'Header navigation padding left/right (px)', 'wolverine' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'std'	=> '100',
				'required-field' => array(
					array($prefix . 'header_nav_layout','=','nav-fullwith'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'id'    => $prefix . 'header_nav_separate',
				'name'  => __( 'Header navigation separate', 'wolverine' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => __('Show','wolverine'),
					'0' => __('Hide','wolverine')
				),
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),

			array(
				'id'        => $prefix . 'header_nav_hover',
				'name'     => __('Header navigation hover', 'wolverine'),
				'type'      => 'button_set',
				'std'  => '-1',
				'options'  => array(
					'-1' => __('Default','wolverine'),
					'nav-hover-primary' => 'Primary Color',
					'nav-hover-bolder' => 'Bolder'
				),
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),

			array(
				'id'        => $prefix . 'header_nav_distance',
				'type'      => 'text',
				'name'     => __('Header navigation distance', 'wolverine'),
				'desc'      => __('You can set distance between navigation items. Empty value to default', 'wolverine'),
				'std'	=> '',
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),

			array(
				'id'    => $prefix . 'header_nav_scheme',
				'name'  => __( 'Header nav scheme', 'wolverine' ),
				'type'  => 'button_set',
				'desc' => __("Set header nav scheme", 'wolverine'),
				'std'	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'gray' => __('Gray','wolverine'),
					'light' => __('Light','wolverine'),
					'dark' => __('Dark','wolverine'),
					'customize' => __('Customize','wolverine'),
				),
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),

			array(
				'name' => __('Header navigation background color', 'wolverine'),
				'id' => $prefix . 'header_nav_bg_color_color',
				'desc' => __("Set header navigation background color.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array(
					array($prefix . 'header_nav_scheme','=','customize'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'name'       => __( 'Overlay Opacity', 'wolverine' ),
				'id'         => $prefix .'header_nav_bg_color_opacity',
				'desc'       => __( 'Set the opacity level of the header navigation background color', 'wolverine' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array(
					array($prefix . 'header_nav_scheme','=','customize'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'name' => __('Header navigation text color', 'wolverine'),
				'id' => $prefix . 'header_nav_text_color',
				'desc' => __("Set header navigation text color.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array(
					array($prefix . 'header_nav_scheme','=','customize'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'name'  => __( 'Set header navigation border bottom?', 'wolverine' ),
				'id'    => $prefix . 'header_nav_border_enable',
				'type'  => 'checkbox',
				'std'	=> 0,
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),

			array(
				'name' => __('Header navigation border width', 'wolverine'),
				'id' => $prefix . 'header_nav_border_width',
				'desc' => __("Enter a header navigation border width value (not include unit).", 'wolverine'),
				'type'  => 'number',
				'std' => '',
				'required-field' => array(
					array($prefix . 'header_nav_border_enable','=','1'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'name' => __('Header navigation border style', 'wolverine'),
				'id' => $prefix . 'header_nav_border_style',
				'type'  => 'select',
				'std'   => 'none',
				'options' => array(
					'none'      => __('None','wolverine'),
					'solid'     => __('Solid','wolverine'),
					'dashed'    => __('Dashed','wolverine'),
					'dotted'    => __('Dotted','wolverine'),
				),
				'required-field' => array(
					array($prefix . 'header_nav_border_enable','=','1'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'name' => __('Header navigation border color', 'wolverine'),
				'id' => $prefix . 'header_nav_border_color',
				'type'  => 'color',
				'std' => '#E9E9E9',
				'required-field' => array(
					array($prefix . 'header_nav_border_enable','=','1'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'name'       => __( 'Header navigation border opacity', 'wolverine' ),
				'id'         => $prefix .'header_nav_border_opacity',
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'std'       => '40',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array(
					array($prefix . 'header_nav_border_enable','=','1'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'name'  => __( 'Set header customize?', 'wolverine' ),
				'id'    => $prefix . 'enable_header_customize',
				'type'  => 'checkbox',
				'std'	=> 0,
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),

			array (
				'name' 	=> __('Header Customize', 'wolverine'),
				'id' 	=> $prefix . 'header_customize',
				'type' 	=> 'sorter',
				'std' 	=> '',
				'desc'  => __('Select element for header customize. Drag to change element order', 'wolverine'),
				'options' => array(
					'social-profile' => __('Social Profile','wolverine'),
					'shopping-cart'   => 'Shopping Cart',
					'search' => 'Search Box',
					'custom-text' => 'Custom Text',
				),
				'required-field' => array(
					array($prefix . 'enable_header_customize','=','1'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'name'  => __( 'Custom text content', 'wolverine' ),
				'id'    => $prefix . 'header_customize_text',
				'type'  => 'textarea',
				'std'	=> '',
				'required-field' => array(
					array($prefix . 'enable_header_customize','=','1'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array(
				'name' => __('Custom social profiles', 'wolverine'),
				'id' => $prefix . 'header_customize_social_profile',
				'type'  => 'select_advanced',
				'placeholder' => __('Select social profiles','wolverine'),
				'std'	=> '',
				'multiple' => true,
				'options' => array(
					'twitter'  => __( 'Twitter', 'wolverine' ),
					'facebook'  => __( 'Facebook', 'wolverine' ),
					'dribbble'  => __( 'Dribbble', 'wolverine' ),
					'vimeo'  => __( 'Vimeo', 'wolverine' ),
					'tumblr'  => __( 'Tumblr', 'wolverine' ),
					'skype'  => __( 'Skype', 'wolverine' ),
					'linkedin'  => __( 'LinkedIn', 'wolverine' ),
					'googleplus'  => __( 'Google+', 'wolverine' ),
					'flickr'  => __( 'Flickr', 'wolverine' ),
					'youtube'  => __( 'YouTube', 'wolverine' ),
					'pinterest' => __( 'Pinterest', 'wolverine' ),
					'foursquare'  => __( 'Foursquare', 'wolverine' ),
					'instagram' => __( 'Instagram', 'wolverine' ),
					'github'  => __( 'GitHub', 'wolverine' ),
					'xing' => __( 'Xing', 'wolverine' ),
					'behance'  => __( 'Behance', 'wolverine' ),
					'deviantart'  => __( 'Deviantart', 'wolverine' ),
					'soundcloud'  => __( 'SoundCloud', 'wolverine' ),
					'yelp'  => __( 'Yelp', 'wolverine' ),
					'rss'  => __( 'RSS Feed', 'wolverine' ),
					'email'  => __( 'Email address', 'wolverine' ),
				),
				'required-field' => array(
					array($prefix . 'enable_header_customize','=','1'),
					array($prefix . 'header_show_hide','=','1')
				)
			),

			array (
				'name' 	=> __('Header Float', 'wolverine'),
				'id' 	=> $prefix . 'header_layout_float',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => __('Enable','wolverine'),
					'0' => __('Disable','wolverine')
				),
				'desc' => __('Enable/disable header float.', 'wolverine'),
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),

			array (
				'name' 	=> __('Header Sticky', 'wolverine'),
				'id' 	=> $prefix . 'header_sticky',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => __('Enable Header Sticky','wolverine'),
					'0' => __('Disable Header Sticky','wolverine'),
				),
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),

			array(
				'name'    => __( 'Header sticky scheme', 'wolverine' ),
				'id'       => $prefix . 'header_sticky_scheme',
				'type'     => 'button_set',
				'options'  => array(
					'-1'   => __('Default','wolverine'),
					'inherit'   => __('Inherit','wolverine'),
					'gray'      => __('Gray','wolverine'),
					'light'     => __('Light','wolverine'),
					'dark'     => __('Dark','wolverine')
				),
				'std'  => '-1',
				'required-field' => array($prefix . 'header_show_hide','=','1')
			),
		)
	);

	// LOGO
	$meta_boxes[] = array(
		'id' => $prefix . 'page_logo_meta_box',
		'title' => __('Logo', 'wolverine'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'id'    => $prefix.  'custom_logo',
				'name'  => __('Custom Logo', 'wolverine'),
				'desc'  => __('Upload custom logo in header.', 'wolverine'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),

			array(
				'id'    => $prefix.  'logo_height',
				'name'  => __('Logo height', 'wolverine'),
				'desc'  => __('Logo height. Do not include units (empty to set default)', 'wolverine'),
				'type'  => 'text',
				'sdt'   => '',
			),

			array(
				'id'    => $prefix.  'logo_max_height',
				'name'  => __('Logo max height', 'wolverine'),
				'desc'  => __('Logo max height. Do not include units (empty to set default)', 'wolverine'),
				'type'  => 'text',
				'sdt'   => '',
			),

			array(
				'id'    => $prefix.  'logo_padding_top',
				'name'  => __('Logo padding top', 'wolverine'),
				'desc'  => __('Logo padding top. Do not include units (empty to set default)', 'wolverine'),
				'type'  => 'text',
				'sdt'   => '',
			),

			array(
				'id'    => $prefix.  'logo_padding_bottom',
				'name'  => __('Logo padding bottom', 'wolverine'),
				'desc'  => __('Logo padding bottom. Do not include units (empty to set default)', 'wolverine'),
				'type'  => 'text',
				'sdt'   => '',
			),

			array(
				'id'    => $prefix . 'sticky_logo',
				'name'  => __('Sticky Logo', 'wolverine'),
				'desc'  => __('Upload sticky logo in header (empty to default)', 'wolverine'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
		)
	);

	// MENU
	$meta_boxes[] = array(
		'id' => $prefix . 'page_menu_meta_box',
		'title' => __('Menu', 'wolverine'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => __( 'Page menu', 'wolverine' ),
				'id'    => $prefix . 'page_menu',
				'type'  => 'select_advanced',
				'options' => $menu_list,
				'placeholder' => __('Select Menu','wolverine'),
				'std'	=> '',
				'multiple' => false,
				'desc' => __('Optionally you can choose to override the menu that is used on the page', 'wolverine'),
			),

			array(
				'name'  => __( 'Page menu mobile', 'wolverine' ),
				'id'    => $prefix . 'page_menu_mobile',
				'type'  => 'select_advanced',
				'options' => $menu_list,
				'placeholder' => __('Select Menu','wolverine'),
				'std'	=> '',
				'multiple' => false,
				'desc' => __('Optionally you can choose to override the menu mobile that is used on the page', 'wolverine'),
			),

			array(
				'name'  => __( 'Is One Page', 'wolverine' ),
				'id'    => $prefix . 'is_one_page',
				'type' 	=> 'checkbox',
				'std' 	=> '0',
				'desc' => __('Set page style is One Page', 'wolverine'),
			),
		)
	);


	// PAGE TITLE
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_title_meta_box',
		'title' => __('Page Title', 'wolverine'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => __( 'Show/Hide Page Title?', 'wolverine' ),
				'id'    => $prefix . 'show_page_title',
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'	=> __('Default','wolverine'),
					'1'	=> __('Show Page Title','wolverine'),
					'0'	=> __('Hide Page Title','wolverine'),
				)

			),

			// PAGE TITLE LINE 1
			array(
				'name' => __('Custom Page Title', 'wolverine'),
				'id' => $prefix . 'page_title_custom',
				'desc' => __("Enter a custom page title if you'd like.", 'wolverine'),
				'type'  => 'text',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE LINE 2
			array(
				'name' => __('Custom Page Subtitle', 'wolverine'),
				'id' => $prefix . 'page_subtitle_custom',
				'desc' => __("Enter a custom page title if you'd like.", 'wolverine'),
				'type'  => 'text',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// PAGE TITLE TEXT COLOR
			array(
				'name' => __('Page Title Text Color', 'wolverine'),
				'id' => $prefix . 'page_title_text_color',
				'desc' => __("Optionally set a text color for the page title.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE TEXT COLOR
			array(
				'name' => __('Page Sub Title Text Color', 'wolverine'),
				'id' => $prefix . 'page_sub_title_text_color',
				'desc' => __("Optionally set a text color for the page sub title.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// PAGE TITLE BACKGROUND COLOR
			array(
				'name' => __('Page Title Background Color', 'wolverine'),
				'id' => $prefix . 'page_title_bg_color',
				'desc' => __("Optionally set a background color for the page title.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name'  => __( 'Custom Background Image?', 'wolverine' ),
				'id'    => $prefix . 'enable_custom_page_title_bg_image',
				'type'  => 'checkbox',
				'std'	=> 0,
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// BACKGROUND IMAGE
			array(
				'id'    => $prefix.  'page_title_bg_image',
				'name'  => __('Background Image', 'wolverine'),
				'desc'  => __('Background Image for page title.', 'wolverine'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'required-field' => array($prefix . 'enable_custom_page_title_bg_image','=','1'),
			),

			// PAGE TITLE OVERLAY COLOR
			array(
				'id'   => $prefix. 'page_title_overlay_color',
				'name' => __( 'Page Title Overlay Color', 'wolverine' ),
				'desc' => __( "Set an overlay color for page title image.", 'wolverine' ),
				'type' => 'color',
				'std'  => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name'  => __( 'Custom Overlay Opacity?', 'wolverine' ),
				'id'    => $prefix . 'enable_custom_overlay_opacity',
				'type'  => 'checkbox',
				'std'	=> 0,
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// Overlay Opacity Value
			array(
				'name'       => __( 'Overlay Opacity', 'wolverine' ),
				'id'         => $prefix .'page_title_overlay_opacity',
				'desc'       => __( 'Set the opacity level of the overlay. This will lighten or darken the image depening on the color selected.', 'wolverine' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_custom_overlay_opacity','=','1'),
			),


			array(
				'name' => __('Page Title Text Align', 'wolverine'),
				'id' => $prefix . 'page_title_text_align',
				'desc' => __("Set Page Title Text Align", 'wolverine'),
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => __('Default','wolverine'),
					'left' => __('Left','wolverine'),
					'center' => __('Center','wolverine'),
					'right' => __('Right','wolverine'),
				),
				'std' => '-1',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name' => __('Page Title Parallax', 'wolverine'),
				'id' => $prefix . 'page_title_parallax',
				'desc' => __("Enable Page Title Parallax", 'wolverine'),
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => __('Default','wolverine'),
					'1' => __('Enable','wolverine'),
					'0' => __('Disable','wolverine'),
				),
				'std' => '-1',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// PAGE TITLE Height
			array(
				'name' => __('Page Title Height', 'wolverine'),
				'id' => $prefix . 'page_title_height',
				'desc' => __("Enter a page title height value (not include unit).", 'wolverine'),
				'type'  => 'number',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),




			// Breadcrumbs in Page Title
			array(
				'name' => __('Breadcrumbs', 'wolverine'),
				'id' => $prefix . 'breadcrumbs_in_page_title',
				'desc' => __("Show/Hide Breadcrumbs", 'wolverine'),
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => __('Default','wolverine'),
					'1' => __('Show','wolverine'),
					'0' => __('Hide','wolverine'),
				),
				'std' => '-1',
			),
            array(
                'name'  => __( 'Remove Margin Bottom', 'wolverine' ),
                'id'    => $prefix . 'page_title_remove_margin_bottom',
                'type'  => 'checkbox',
                'std'	=> 0,
            ),
		)
	);

	// PAGE FOOTER
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_footer_meta_box',
		'title' => __('Page Footer', 'wolverine'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(

			array (
				'name' 	=> __('Show/Hide Footer', 'wolverine'),
				'id' 	=> $prefix . 'footer_show_hide',
				'type' 	=> 'button_set',
				'std' 	=> '1',
				'options' => array(
					'1' => __('Show Footer','wolverine'),
					'0' => __('Hide Footer','wolverine')
				),
				'desc' => __('Show/hide footer', 'wolverine'),
			),


			array (
				'name' 	=> __('Footer Parallax', 'wolverine'),
				'id' 	=> $prefix . 'footer_parallax',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => 'On',
					'0' => 'Off'
				),
				'desc' => __('Enable Footer Parallax', 'wolverine'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),

			array (
				'name' 	=> __('Collapse footer on mobile device', 'wolverine'),
				'id' 	=> $prefix . 'collapse_footer',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => 'On',
					'0' => 'Off'
				),
				'desc' => __('Enable collapse footer', 'wolverine'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),

			array (
				'name' 	=> __('Wrapper Layout', 'wolverine'),
				'id' 	=> $prefix . 'footer_wrap_layout',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'full' => __('Full Width','wolverine'),
					'container-fluid' => __('Container Fluid','wolverine')
				),
				'desc' => __('Select Footer Wrapper Layout', 'wolverine'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),



			array (
				'name' 	=> __('Scheme', 'wolverine'),
				'id' 	=> $prefix . 'footer_scheme',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'gray'      => __('Gray','wolverine'),
					'light'     => __('Light','wolverine'),
					'dark'     => __('Dark','wolverine'),
					'custom'   => __('Custom','wolverine'),
				),
				'desc' => __('Select Footer Scheme', 'wolverine'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),



			array(
				'id' => $prefix . 'footer_bg_color',
				'name' => __('Background color', 'wolverine'),
				'desc' => __("Set footer background color.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id'         => $prefix .'footer_bg_color_opacity',
				'name'       => __( 'Background color opacity', 'wolverine' ),
				'desc'       => __( 'Set the opacity level of the footer background color', 'wolverine' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'std' => '100',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id' => $prefix . 'footer_text_color',
				'name' => __('Text color', 'wolverine'),
				'desc' => __("Set footer text color.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),




			array(
				'id' => $prefix . 'footer_heading_text_color',
				'name' => __('Heading text color', 'wolverine'),
				'desc' => __("Set footer heading text color.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id' => $prefix . 'bottom_bar_bg_color',
				'name' => __('Bottom Bar Background Color', 'wolverine'),
				'desc' => __("Set Bottom Bar Background Color.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id'         => $prefix .'bottom_bar_bg_color_opacity',
				'name'       => __( 'Bottom Bar Background color opacity', 'wolverine' ),
				'desc'       => __( 'Set the opacity level of the bottom bar background color', 'wolverine' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id' => $prefix . 'bottom_bar_text_color',
				'name' => __('Bottom Bar Text Color', 'wolverine'),
				'desc' => __("Set Bottom Bar Text Color.", 'wolverine'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array (
				'name' 	=> __('Show/Hide Main Footer', 'wolverine'),
				'id' 	=> $prefix . 'footer_top_bar_show_hide',
				'type' 	=> 'button_set',
				'std' 	=> '1',
				'options' => array(
					'1' => __('Show','wolverine'),
					'0' => __('Hide','wolverine')
				),
				'desc' => __('Show/hide main footer', 'wolverine'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),

			array(
				'id'    => $prefix.  'footer_bg_image',
				'name'  => __('Background Image', 'wolverine'),
				'desc'  => __('Set footer background image', 'wolverine'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'std' => '',
				'required-field' => array($prefix . 'footer_top_bar_show_hide','=','1'),
			),

			array(
				'id'    => $prefix.  'footer_padding_top',
				'name'  => __('Main Footer padding top', 'wolverine'),
				'desc'  => __('Main Footer padding top. Do not include units (empty to set default)', 'wolverine'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'footer_top_bar_show_hide','=','1'),
			),

			array(
				'id'    => $prefix.  'footer_padding_bottom',
				'name'  => __('Main Footer padding bottom', 'wolverine'),
				'desc'  => __('Main Footer padding bottom. Do not include units (empty to set default)', 'wolverine'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'footer_top_bar_show_hide','=','1'),
			),



			array (
				'name' 	=> __('Layout', 'wolverine'),
				'id' 	=> $prefix . 'footer_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'footer-1' => THEME_URL.'/assets/images/theme-options/footer-layout-1.jpg',
					'footer-2' => THEME_URL.'/assets/images/theme-options/footer-layout-2.jpg',
					'footer-3' => THEME_URL.'/assets/images/theme-options/footer-layout-3.jpg',
					'footer-4' => THEME_URL.'/assets/images/theme-options/footer-layout-4.jpg',
					'footer-5' => THEME_URL.'/assets/images/theme-options/footer-layout-5.jpg',
					'footer-6' => THEME_URL.'/assets/images/theme-options/footer-layout-6.jpg',
					'footer-7' => THEME_URL.'/assets/images/theme-options/footer-layout-7.jpg',
					'footer-8' => THEME_URL.'/assets/images/theme-options/footer-layout-8.jpg',
					'footer-9' => THEME_URL.'/assets/images/theme-options/footer-layout-9.jpg',
				),
				'desc' => __('Select Footer Layout (Not set to default).', 'wolverine'),
				'required-field' => array($prefix . 'footer_top_bar_show_hide','=','1'),
			),

			array (
				'name' 	=> __('Sidebar 1', 'wolverine'),
				'id' 	=> $prefix . 'footer_sidebar_1',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','wolverine'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1','footer-2','footer-3','footer-4','footer-5','footer-6','footer-7','footer-8','footer-9')),
			),

			array (
				'name' 	=> __('Sidebar 2', 'wolverine'),
				'id' 	=> $prefix . 'footer_sidebar_2',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','wolverine'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1','footer-2','footer-3','footer-4','footer-5','footer-6','footer-7','footer-8')),
			),

			array (
				'name' 	=> __('Sidebar 3', 'wolverine'),
				'id' 	=> $prefix . 'footer_sidebar_3',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','wolverine'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1','footer-2','footer-3','footer-5','footer-8')),
			),

			array (
				'name' 	=> __('Sidebar 4', 'wolverine'),
				'id' 	=> $prefix . 'footer_sidebar_4',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','wolverine'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1')),
			),











			array (
				'name' 	=> __('Show/Hide Bottom Bar', 'wolverine'),
				'id' 	=> $prefix . 'bottom_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => 'Default',
					'1' => 'Show Bottom Bar',
					'0' => 'Hide Bottom Bar'
				),
				'desc' => __('Show Hide Bottom Bar.', 'wolverine'),
			),

			array (
				'name' 	=> __('Bottom Bar Layout', 'wolverine'),
				'id' 	=> $prefix . 'bottom_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'bottom-bar-1' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-1.jpg',
					'bottom-bar-2' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-2.jpg',
					'bottom-bar-3' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-3.jpg',
					'bottom-bar-4' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-4.jpg',
				),
				'desc' => __('Bottom bar layout.', 'wolverine'),
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> __('Bottom Bar Left Sidebar', 'wolverine'),
				'id' 	=> $prefix . 'bottom_bar_left_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','wolverine'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> __('Bottom Bar Right Sidebar', 'wolverine'),
				'id' 	=> $prefix . 'bottom_bar_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','wolverine'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

		)
	);

	// HEADER MOBILE
	$meta_boxes[] = array(
		'id' => $prefix . 'page_header_mobile_meta_box',
		'title' => __('Header Mobile', 'wolverine'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> __('Header Mobile Layout', 'wolverine'),
				'id' 	=> $prefix . 'mobile_header_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'std'	=> '',
				'options' => array(
					'header-mobile-1'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-1.png',
					'header-mobile-2'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-2.png',
					'header-mobile-3'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-3.png',
					'header-mobile-4'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-4.png',
					'header-mobile-5'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-5.jpg',
				)
			),
			array(
				'id'    => $prefix . 'mobile_header_menu_drop',
				'name'  => __( 'Menu Drop Type', 'wolverine' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'        => __('Default','wolverine'),
					'dropdown'  => __('Dropdown Menu','wolverine'),
					'fly'       => __('Fly Menu','wolverine'),
				)
			),
			array (
				'name' 	=> __('Header mobile sticky', 'wolverine'),
				'id' 	=> $prefix . 'mobile_header_stick',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => __('Enable','wolverine'),
					'0' => __('Disable','wolverine'),
				),
			),
			array(
				'id'    => $prefix.  'custom_logo_mobile',
				'name'  => __('Custom Logo', 'wolverine'),
				'desc'  => __('Upload custom logo in header.', 'wolverine'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'std'   => ''
			),
			array (
				'name' 	=> __('Mobile Header Search Box', 'wolverine'),
				'id' 	=> $prefix . 'mobile_header_search_box',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => __('Show','wolverine'),
					'0' => __('Hide','wolverine')
				),
			),

			array (
				'name' 	=> __('Mobile Header Shopping Cart', 'wolverine'),
				'id' 	=> $prefix . 'mobile_header_shopping_cart',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','wolverine'),
					'1' => __('Show','wolverine'),
					'0' => __('Hide','wolverine')
				),
			),
		)
	);

    // POST OPTIONS
    $meta_boxes[] = array(
        'id' => $prefix . 'post_meta_box',
        'title' => __('Post Options', 'wolverine'),
        'post_types' => array('post'),
	    'tab' => true,
        'fields' => array(
            array(
                'name'  => __( 'Show/Hide Post Navigation?', 'wolverine' ),
                'id'    => $prefix . 'show_post_navigation',
                'type'  => 'button_set',
                'std'	=> '-1',
                'options' => array(
                    '-1'	=> __('Default','wolverine'),
                    '1'	=> __('Show','wolverine'),
                    '0'	=> __('Hide','wolverine'),
                )

            ),


            array(
                'name'  => __( 'Show/Hide Author Info?', 'wolverine' ),
                'id'    => $prefix . 'show_author_info',
                'type'  => 'button_set',
                'std'	=> '-1',
                'options' => array(
                    '-1'	=> __('Default','wolverine'),
                    '1'	=> __('Show','wolverine'),
                    '0'	=> __('Hide','wolverine'),
                )

            ),

            array(
                'name'  => __( 'Show/Hide Related Post?', 'wolverine' ),
                'id'    => $prefix . 'show_related_post',
                'type'  => 'button_set',
                'std'	=> '-1',
                'options' => array(
                    '-1'	=> __('Default','wolverine'),
                    '1'	=> __('Show','wolverine'),
                    '0'	=> __('Hide','wolverine'),
                )

            ),
        )
    );

	// Secondary Image Product
	$meta_boxes[] = array(
		'title' => __('Secondary Image', 'wolverine'),
		'id' => $prefix . 'meta_box_product_secondary_image',
		'post_types' => array('product'),
		'context' => 'side',
		'priority' => 'low',
		'fields' => array(
			array(
				'name'  => __( 'Secondary Image', 'wolverine' ),
				'id'    => $prefix . 'product_secondary_image',
				'type'  => 'image_advanced',
				'std'	=> '',
				'max_file_uploads' => 1
			),
		),
	);




	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if (class_exists('RW_Meta_Box')) {
		foreach ($meta_boxes as $meta_box) {
			new RW_Meta_Box($meta_box);
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action('admin_init', 'g5plus_register_meta_boxes');
