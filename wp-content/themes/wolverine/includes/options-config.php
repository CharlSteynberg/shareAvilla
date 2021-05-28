<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux_Framework_options_config' ) ) {

    class Redux_Framework_options_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
	        if ( ! class_exists( 'ReduxFramework' ) ) {
		        return;
	        }
            $this->initSettings();
        }

        public function initSettings() {
            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        public function setSections() {

            $page_title_bg_url = THEME_URL . 'assets/images/bg-page-title.jpg';
            $logo_under_construction = THEME_URL . 'assets/images/logo_under_construction.png';
            $image_left_under_construction = THEME_URL . 'assets/images/image_left.png';

            // General Setting
            $this->sections[] = array(
                'title'  => __( 'General Setting', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-wrench',
                'fields' => array(
                    array(
                        'id' => 'home_preloader',
                        'type' => 'select',
                        'title' => __('Home Preloader', 'wolverine'),
                        'subtitle' => __('Enable/Disable Home Preloader', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'square-1'	=> 'Square 01',
                            'square-2'	=> 'Square 02',
                            'square-3'	=> 'Square 03',
                            'square-4'	=> 'Square 04',
                            'square-5'	=> 'Square 05',
                            'square-6'	=> 'Square 06',
                            'square-7'	=> 'Square 07',
                            'square-8'	=> 'Square 08',
                            'square-9'	=> 'Square 09',
                            'round-1'	=> 'Round 01',
                            'round-2'	=> 'Round 02',
                            'round-3'	=> 'Round 03',
                            'round-4'	=> 'Round 04',
                            'round-5'	=> 'Round 05',
                            'round-6'	=> 'Round 06',
                            'round-7'	=> 'Round 07',
                            'round-8'	=> 'Round 08',
                            'round-9'	=> 'Round 09',
                            'various-1'	=> 'Various 01',
                            'various-2'	=> 'Various 02',
                            'various-3'	=> 'Various 03',
                            'various-4'	=> 'Various 04',
                            'various-5'	=> 'Various 05',
                            'various-6'	=> 'Various 06',
                            'various-7'	=> 'Various 07',
                            'various-8'	=> 'Various 08',
                            'various-9'	=> 'Various 09',
                            'various-10'	=> 'Various 10',

                        ),
                        'default' => ''
                    ),


                    array(
                        'id'       => 'home_preloader_bg_color',
                        'type'     => 'color_rgba',
                        'title'    => __( 'Preloader background color', 'wolverine' ),
                        'subtitle' => __( 'Set Preloader background color.', 'wolverine' ),
                        'default'  => array(),
                        'mode'     => 'background',
                        'validate' => 'colorrgba',
	                    'required'  => array('home_preloader', 'not_empty_and', array('none')),
                    ),

                    array(
                        'id'       => 'home_preloader_spinner_color',
                        'type'     => 'color',
                        'title'    => __('Preloader spinner color', 'wolverine'),
                        'subtitle' => __('Pick a preloader spinner color for the Top Bar', 'wolverine'),
                        'default'  => '',
                        'validate' => 'color',
	                    'required'  => array('home_preloader', 'not_empty_and', array('none')),
                    ),


                    array(
                        'id' => 'custom_scroll',
                        'type' => 'button_set',
                        'title' => __('Custom Scroll', 'wolverine'),
                        'subtitle' => __('Enable/Disable Custom Scroll', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id'        => 'custom_scroll_width',
                        'type'      => 'text',
                        'title'     => __('Custom Scroll Width', 'wolverine'),
                        'subtitle'  => __('This must be numeric (no px) or empty.', 'wolverine'),
                        'validate'  => 'numeric',
                        'default'   => '10',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id'       => 'custom_scroll_color',
                        'type'     => 'color',
                        'title'    => __('Custom Scroll Color', 'wolverine'),
                        'subtitle' => __('Set Custom Scroll Color', 'wolverine'),
                        'default'  => '#19394B',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id'       => 'custom_scroll_thumb_color',
                        'type'     => 'color',
                        'title'    => __('Custom Scroll Thumb Color', 'wolverine'),
                        'subtitle' => __('Set Custom Scroll Thumb Color', 'wolverine'),
                        'default'  => '#e8aa00',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),


                    array(
                        'id' => 'panel_selector',
                        'type' => 'button_set',
                        'title' => __('Panel Selector', 'wolverine'),
                        'subtitle' => __('Enable/Disable Panel Selector', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'button_set',
                        'title' => __('Back To Top', 'wolverine'),
                        'subtitle' => __('Enable/Disable Back to top button', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),

	                array(
		                'id' => 'enable_rtl_mode',
		                'type' => 'button_set',
		                'title' => __('Enable RTL mode', 'wolverine'),
		                'subtitle' => __('Enable/Disable RTL mode', 'wolverine'),
		                'desc' => '',
		                'options' => array('1' => 'On','0' => 'Off'),
		                'default' => '0'
	                ),


	                array(
                        'id' => 'enable_social_meta',
                        'type' => 'button_set',
                        'title' => __('Enable Social Meta Tags', 'wolverine'),
                        'subtitle' => __('Enable the social meta head tag output.', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'twitter_author_username',
                        'type' => 'text',
                        'title' => __('Twitter Publisher Username', 'wolverine'),
                        'subtitle' => __( 'Enter your twitter username here, to be used for the Twitter Card date. Ensure that you do not include the @ symbol.','wolverine'),
                        'desc' => '',
                        'default' => "",
                        'required'  => array('enable_social_meta', '=', array('1')),
                    ),
                    array(
                        'id' => 'general_divide_2',
                        'type' => 'divide'
                    ),
                    array(
                        'id' => 'layout_style',
                        'type' => 'image_select',
                        'title' => __('Layout Style', 'wolverine'),
                        'subtitle' => __('Select the layout style', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'boxed' => array('title' => 'Boxed', 'img' => THEME_URL.'assets/images/theme-options/layout-boxed.png'),
                            'wide' => array('title' => 'Wide', 'img' => THEME_URL.'assets/images/theme-options/layout-wide.png'),
                            'float' => array('title' => 'Float', 'img' => THEME_URL.'assets/images/theme-options/layout-float.png')
                        ),
                        'default' => 'wide'
                    ),


                    array(
                        'id' => 'body_background_mode',
                        'type' => 'button_set',
                        'title' => __('Body Background Mode', 'wolverine'),
                        'subtitle' => __('Chose Background Mode', 'wolverine'),
                        'desc' => '',
                        'options' => array('background' => 'Background','pattern' => 'Pattern'),
                        'default' => 'background'
                    ),

                    array(
                        'id'       => 'body_background',
                        'type'     => 'background',
                        'output'   => array( 'body' ),
                        'title'    => __( 'Body Background', 'wolverine' ),
                        'subtitle' => __( 'Body background (Apply for Boxed layout style).', 'wolverine' ),
                        'default'  => array(
                            'background-color' => '',
                            'background-repeat' => 'no-repeat',
                            'background-position' => 'center center',
                            'background-attachment' => 'fixed',
                            'background-size' => 'cover'
                        ),
                        'required'  => array(
                                array('body_background_mode', '=', array('background'))
                        ),
                    ),
                    array(
                        'id' => 'body_background_pattern',
                        'type' => 'image_select',
                        'title' => __('Background Pattern', 'wolverine'),
                        'subtitle' => __('Body background pattern(Apply for Boxed layout style)', 'wolverine'),
                        'desc' => '',
                        'height' => '40px',
                        'options' => array(
                            'pattern-1.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-1.png'),
                            'pattern-2.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-2.png'),
                            'pattern-3.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-3.png'),
                            'pattern-4.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-4.png'),
                            'pattern-5.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-5.png'),
                            'pattern-6.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-6.png'),
                            'pattern-7.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-7.png'),
                            'pattern-8.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-8.png'),
                        ),
                        'default' => 'pattern-1.png',
                        'required'  => array(
                                array('body_background_mode', '=', array('pattern'))
                            ) ,
                    ),
                )
            );

            $this->sections[] = array(
                'title' => __('Maintenance Mode', 'wolverine'),
                'desc' => '',
                'subsection' => true,
                'icon' => 'el-icon-eye-close',
                'fields' => array(
                    array(
                        'id' => 'enable_maintenance',
                        'type' => 'button_set',
                        'title' => __('Enable Maintenance', 'wolverine'),
                        'subtitle' => __('Enable the themes maintenance mode.', 'wolverine'),
                        'desc' => '',
                        'options' => array('2' => 'On (Custom Page)', '1' => 'On (Standard)','0' => 'Off',),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'maintenance_mode_page',
                        'type' => 'select',
                        'data' => 'pages',
                        'required'  => array('enable_maintenance', '=', '2'),
                        'title' => __('Custom Maintenance Mode Page', 'wolverine'),
                        'subtitle' => __('Select the page that is your maintenace page, if you would like to show a custom page instead of the standard WordPress message. You should use the Holding Page template for this page.', 'wolverine'),
                        'desc' => '',
                        'default' => '',
                        'args' => array()
                    ),
                ),
            );


            // Performance Options
            $this->sections[] = array(
                'title'  => __( 'Performance', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-dashboard',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'enable_minifile_js',
                        'type' => 'button_set',
                        'title' => __('Enable Mini File JS', 'wolverine'),
                        'subtitle' => __('Enable/Disable Mini File JS', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'enable_minifile_css',
                        'type' => 'button_set',
                        'title' => __('Enable Mini File CSS', 'wolverine'),
                        'subtitle' => __('Enable/Disable Mini File CSS', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),
                )
            );

            // Custom Favicon
            $this->sections[] = array(
                'title'  => __( 'Custom Favicon', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-eye-open',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'custom_favicon',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Custom favicon', 'wolverine'),
                        'subtitle' => __('Upload a 16px x 16px Png/Gif/ico image that will represent your website favicon', 'wolverine'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_title',
                        'type' => 'text',
                        'title' => __('Custom iOS Bookmark Title', 'wolverine'),
                        'subtitle' => __('Enter a custom title for your site for when it is added as an iOS bookmark.', 'wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon57',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Custom iOS 57x57', 'wolverine'),
                        'subtitle' => __('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'wolverine'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon72',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Custom iOS 72x72', 'wolverine'),
                        'subtitle' => __('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'wolverine'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon114',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Custom iOS 114x114', 'wolverine'),
                        'subtitle' => __('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'wolverine'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon144',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Custom iOS 144x144', 'wolverine'),
                        'subtitle' => __('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'wolverine'),
                        'desc' => ''
                    ),
                )
            );


            // 404
            $this->sections[] = array(
                'title'  => __( '404 Setting', 'wolverine' ),
                'desc'   => '',
                'subsection' => true,
                'icon'   => 'el el-error',
                'fields' => array(
                    array(
                        'id'        => 'page_title_404',
                        'type'      => 'text',
                        'title'     => esc_html__('Page Title 404', 'wolverine'),
                        'default'   => esc_html__('Error 404 - not found','wolverine'),
                    ),
                    array(
                        'id'        => 'sub_page_title_404',
                        'type'      => 'text',
                        'title'     => esc_html__('SubPage Title 404', 'wolverine'),
                        'default'   => '',
                    ),
                    array(
                        'id' => 'page_404_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Background page title', 'wolverine'),
                        'subtitle' => __('Upload your background image here.', 'wolverine'),
                        'desc' => '',
                        'default' =>  array(
                            'url' => $page_title_bg_url
                        )
                    ),
                    array(
                        'id'        => 'title_404',
                        'type'      => 'text',
                        'title'     => __('Title 404', 'wolverine'),
                        'default'   => 'SO SORRY! =(',
                    ),
                    array(
                        'id'        => 'subtitle_404',
                        'type'      => 'textarea',
                        'title'     => __('Subtitle 404', 'wolverine'),
                        'default'   => 'The document you are looking for may have been removed or re-named. Please contact the web site owner for further assistance.',
                    ),
                    array(
                        'id'        => 'go_back_404',
                        'type'      => 'text',
                        'title'     => esc_html__('Go back label', 'wolverine'),
                        'default'   => esc_html__('BACK TO HOME','wolverine')
                    ),
                    array(
                        'id'        => 'go_back_url_404',
                        'type'      => 'text',
                        'title'     => __('Go back link', 'wolverine'),
                        'default'   => '',
                    ),
                    array(
                        'id'        => 'copyright_404',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Go back information', 'wolverine'),
                        'default'   => esc_html__('© 2015 WOLVERINE TEMPLATE. DESIGNED BY G5THEME','wolverine') ,
                    )
                )
            );

            // Pages Setting
            $this->sections[] = array(
                'title'  => __( 'Pages Setting', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-th',
                'fields' => array(
                    array(
                        'id' => 'page_layout',
                        'type' => 'button_set',
                        'title' => __('Layout', 'wolverine'),
                        'subtitle' => __('Select Page Layout', 'wolverine'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'page_sidebar',
                        'type' => 'image_select',
                        'title' => __('Sidebar', 'wolverine'),
                        'subtitle' => __('Set Sidebar Style', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'right'
                    ),

                    array(
                        'id' => 'page_sidebar_width',
                        'type' => 'button_set',
                        'title' => __('Sidebar Width', 'wolverine'),
                        'subtitle' => __('Set Sidebar width', 'wolverine'),
                        'desc' => '',
                        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
                        'default' => 'small',
                        'required'  => array('page_sidebar', '=', array('left','both','right')),
                    ),



                    array(
                        'id' => 'page_left_sidebar',
                        'type' => 'select',
                        'title' => __('Left Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('page_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'page_right_sidebar',
                        'type' => 'select',
                        'title' => __('Right Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-2',
                        'required'  => array('page_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id' => 'breadcrumbs_in_page_title',
                        'type' => 'button_set',
                        'title' => __('Breadcrumbs', 'wolverine'),
                        'subtitle' => __('Enable/Disable Breadcrumbs In Pages', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'show_page_title',
                        'type' => 'button_set',
                        'title' => __('Show Page Title', 'wolverine'),
                        'subtitle' => __('Enable/Disable Page Title', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),

                    array(
                        'id'       => 'page_title_text_align',
                        'type'     => 'button_set',
                        'title'    => __( 'Page Title Text Align', 'wolverine' ),
                        'subtitle' => __( 'Set Page Title Text Align', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'left',
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'page_title_parallax',
                        'type'     => 'button_set',
                        'title'    => __( 'Page Title Parallax', 'wolverine' ),
                        'subtitle' => __( 'Enable Page Title Parallax', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'page_title_height',
                        'type'     => 'dimensions',
                        'units' => 'px',
                        'width'    =>  false,
                        'title'    => __('Page Title Height', 'wolverine'),
                        'desc'      => __('You can set a height for the page title here', 'wolverine'),
                        'required'  => array('show_page_title', '=', array('1')),
                        'output' => array('.page-title-height'),
                        'default'  => array(
                            'Height'  => ''
                        )
                    ),


                    array(
                        'id' => 'page_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Page Title Background', 'wolverine'),
                        'subtitle' => __('Upload page title background.', 'wolverine'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        ),
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'page_comment',
                        'type' => 'button_set',
                        'title' => __('Page Comment', 'wolverine'),
                        'subtitle' => __('Enable/Disable page comment', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    )
                )
            );

	        // Archive Setting
	        $this->sections[] = array(
		        'title'  => __( 'Archive Setting', 'wolverine' ),
		        'desc'   => '',
		        'icon'   => 'el el-folder-close',
		        'fields' => array(

			        array(
				        'id' => 'archive_layout',
				        'type' => 'button_set',
				        'title' => __('Layout', 'wolverine'),
				        'subtitle' => __('Select Archive Layout', 'wolverine'),
				        'desc' => '',
				        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
				        'default' => 'container'
			        ),

			        array(
				        'id' => 'archive_sidebar',
				        'type' => 'image_select',
				        'title' => __('Sidebar', 'wolverine'),
				        'subtitle' => __('Set Sidebar Style', 'wolverine'),
				        'desc' => '',
				        'options' => array(
					        'none' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-none.png'),
					        'left' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-left.png'),
					        'right' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-right.png'),
					        'both' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-both.png'),
				        ),
				        'default' => 'right'
			        ),


			        array(
				        'id' => 'archive_sidebar_width',
				        'type' => 'button_set',
				        'title' => __('Sidebar Width', 'wolverine'),
				        'subtitle' => __('Set Sidebar width', 'wolverine'),
				        'desc' => '',
				        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
				        'default' => 'small',
				        'required'  => array('archive_sidebar', '=', array('left','both','right')),
			        ),

			        array(
				        'id' => 'archive_left_sidebar',
				        'type' => 'select',
				        'title' => __('Left Sidebar', 'wolverine'),
				        'subtitle' => "Choose the default left sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-1',
				        'required'  => array('archive_sidebar', '=', array('left','both')),
			        ),
			        array(
				        'id' => 'archive_right_sidebar',
				        'type' => 'select',
				        'title' => __('Right Sidebar', 'wolverine'),
				        'subtitle' => "Choose the default right sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-2',
				        'required'  => array('archive_sidebar', '=', array('right','both')),
			        ),
			        array(
				        'id' => 'archive_paging_style',
				        'type' => 'button_set',
				        'title' => __('Paging Style', 'wolverine'),
				        'subtitle' => __('Select archive paging style', 'wolverine'),
				        'desc' => '',
				        'options' => array('default' => 'Default', 'load-more' => 'Load More', 'infinity-scroll' => 'Infinity Scroll'),
				        'default' => 'default'
			        ),

			        array(
				        'id' => 'archive_display_type',
				        'type' => 'select',
				        'title' => __('Archive Display Type', 'wolverine'),
				        'subtitle' => __('Select archive display type', 'wolverine'),
				        'desc' => '',
				        'options' => array(
					        'classic-01' => 'Classic 01',
					        'classic-02' => 'Classic 02',
					        'grid-01' => 'Grid 01',
					        'grid-02' => 'Grid 02',
					        'masonry-01' => 'Masonry 01',
					        'masonry-02' => 'Masonry 02'
				        ),
				        'default' => 'classic-01'
			        ),

			        array(
				        'id' => 'archive_display_columns',
				        'type' => 'select',
				        'title' => __('Archive Display Columns', 'wolverine'),
				        'subtitle' => __('Choose the number of columns to display on archive pages.','wolverine'),
				        'options' => array(
					        '2'		=> '2',
					        '3'		=> '3',
					        '4'		=> '4',
				        ),
				        'desc' => '',
				        'default' => '2',
				        'required' => array('archive_display_type','=',array('grid-01','grid-02','masonry-01','masonry-02')),
			        ),
			        array(
				        'id' => 'breadcrumbs_in_archive_title',
				        'type' => 'button_set',
				        'title' => __('Breadcrumbs', 'wolverine'),
				        'subtitle' => __('Enable/Disable Breadcrumbs In Archive', 'wolverine'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),

			        array(
				        'id' => 'show_archive_title',
				        'type' => 'button_set',
				        'title' => __('Show Archive Title', 'wolverine'),
				        'subtitle' => __('Enable/Disable Archive Title', 'wolverine'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),


                    array(
                        'id'       => 'archive_title_text_align',
                        'type'     => 'button_set',
                        'title'    => __( 'Archive Title Text Align', 'wolverine' ),
                        'subtitle' => __( 'Set Archive Title Text Align', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'left',
                        'required' => array('show_archive_title','=',array('1')),
                    ),

                    array(
                        'id'       => 'archive_title_parallax',
                        'type'     => 'button_set',
                        'title'    => __( 'Archive Title Parallax', 'wolverine' ),
                        'subtitle' => __( 'Enable Archive Title Parallax', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required' => array('show_archive_title','=',array('1')),
                    ),


			        array(
				        'id'        => 'archive_title_height',
				        'type'      => 'dimensions',
				        'title'     => __('Archive Title Height', 'wolverine'),
				        'desc'      => __('You can set a height for the archive title here', 'wolverine'),
				        'required' => array('show_archive_title','=',array('1')),
				        'units' => 'px',
				        'width'    =>  false,
                        'output' => array('.archive-title-height'),
				        'default'  => array(
					        'Height'  => ''
				        )
			        ),

			        array(
				        'id' => 'archive_title_bg_image',
				        'type' => 'media',
				        'url'=> true,
				        'title' => __('Archive Title Background', 'wolverine'),
				        'subtitle' => __('Upload archive title background.', 'wolverine'),
				        'desc' => '',
				        'default' =>  array(
					        'url' => $page_title_bg_url
				        ),
				        'required' => array('show_archive_title','=',array('1')),
			        ),
		        )
	        );

	        // Single Blog
	        $this->sections[] = array(
		        'title'  => __( 'Single Blog', 'wolverine' ),
		        'desc'   => '',
		        'icon'   => 'el el-file',
		        'subsection' => true,
		        'fields' => array(
			        array(
				        'id' => 'single_blog_layout',
				        'type' => 'button_set',
				        'title' => __('Layout', 'wolverine'),
				        'subtitle' => __('Select Single Blog Layout', 'wolverine'),
				        'desc' => '',
				        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
				        'default' => 'container'
			        ),

			        array(
				        'id' => 'single_blog_sidebar',
				        'type' => 'image_select',
				        'title' => __('Sidebar', 'wolverine'),
				        'subtitle' => __('Set Sidebar Style', 'wolverine'),
				        'desc' => '',
				        'options' => array(
					        'none' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-none.png'),
					        'left' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-left.png'),
					        'right' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-right.png'),
					        'both' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-both.png'),
				        ),
				        'default' => 'none'
			        ),

			        array(
				        'id' => 'single_blog_sidebar_width',
				        'type' => 'button_set',
				        'title' => __('Sidebar Width', 'wolverine'),
				        'subtitle' => __('Set Sidebar width', 'wolverine'),
				        'desc' => '',
				        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
				        'default' => 'small',
				        'required'  => array('single_blog_sidebar', '=', array('left','both','right')),
			        ),


			        array(
				        'id' => 'single_blog_left_sidebar',
				        'type' => 'select',
				        'title' => __('Left Sidebar', 'wolverine'),
				        'subtitle' => "Choose the default left sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-1',
				        'required'  => array('single_blog_sidebar', '=', array('left','both')),
			        ),

			        array(
				        'id' => 'single_blog_right_sidebar',
				        'type' => 'select',
				        'title' => __('Right Sidebar', 'wolverine'),
				        'subtitle' => "Choose the default right sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-2',
				        'required'  => array('single_blog_sidebar', '=', array('right','both')),
			        ),

			        array(
				        'id' => 'breadcrumbs_in_single_blog_title',
				        'type' => 'button_set',
				        'title' => __('Breadcrumbs', 'wolverine'),
				        'subtitle' => __('Enable/Disable Breadcrumbs In Single Blog', 'wolverine'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),


			        array(
				        'id' => 'show_post_navigation',
				        'type' => 'button_set',
				        'title' => __('Show Post Navigation', 'wolverine'),
				        'subtitle' => __('Enable/Disable Post Navigation', 'wolverine'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),

			        array(
				        'id' => 'show_author_info',
				        'type' => 'button_set',
				        'title' => __('Show Author Info', 'wolverine'),
				        'subtitle' => __('Enable/Disable Author Info', 'wolverine'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),





			        array(
				        'id' => 'show_related_post',
				        'type' => 'button_set',
				        'title' => __('Show Related Post', 'wolverine'),
				        'subtitle' => __('Enable/Disable Related Post', 'wolverine'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),

			        array(
				        'id'       => 'related_post_count',
				        'type'     => 'text',
				        'title'    => __('Related Post Number', 'wolverine'),
				        'subtitle' => __('Total Record Of Related Post.', 'wolverine'),
				        'validate' => 'number',
				        'default'  => '6',
				        'required'  => array('show_related_post', '=', array('1')),
			        ),

			        array(
				        'id'       => 'related_post_columns',
				        'type'     => 'select',
				        'title'    => __('Related Post Columns', 'wolverine'),
				        'default'  => '3',
				        'options' => array('2' => '2' ,'3' => '3','4' => '4'),
				        'select2' => array('allowClear' =>  false) ,
				        'required'  => array('show_related_post', '=', array('1')),
			        ),


			        array(
				        'id' => 'related_post_condition',
				        'type' => 'checkbox',
				        'title' => __('Related Post Condition', 'wolverine'),
				        'options' => array(
					        'category' => __('Same Category','wolverine'),
					        'tag' => __('Same Tag','wolverine'),
				        ),
				        'default' => array(
					        'category'      => '1',
					        'tag'      => '1',
				        ),
				        'required'  => array('show_related_post', '=', array('1')),
			        ),

			        array(
				        'id' => 'related_post_place_holder_image_mode',
				        'type' => 'button_set',
				        'title' => __('Use Placeholder Image With Related Post No Image', 'wolverine'),
				        'options' => array('0' => 'Off','1' => 'On (Default)' , '2' => 'On (Images)'),
				        'default' => '1',
				        'required'  => array('show_related_post', '=', array('1')),
			        ),

			        array(
				        'id' => 'related_post_place_holder_image',
				        'type' => 'media',
				        'url'=> true,
				        'title' => __('Placeholder Images For Related Post', 'wolverine'),
				        'subtitle' => __('Upload Placeholder Images For Related Post.', 'wolverine'),
				        'desc' => '',
				        'required'  => array('related_post_place_holder_image_mode', '=', array('2')),
			        ),


			        array(
				        'id' => 'show_single_blog_title',
				        'type' => 'button_set',
				        'title' => __('Show Single Blog Title', 'wolverine'),
				        'subtitle' => __('Enable/Disable Single Blog Title', 'wolverine'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),



                    array(
                        'id'       => 'single_blog_title_text_align',
                        'type'     => 'button_set',
                        'title'    => __( 'Single Blog Title Text Align', 'wolverine' ),
                        'subtitle' => __( 'Set Single Blog Title Text Align', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'left',
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_blog_title_parallax',
                        'type'     => 'button_set',
                        'title'    => __( 'Single Blog Title Parallax', 'wolverine' ),
                        'subtitle' => __( 'Enable Single Blog Title Parallax', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),



			        array(
				        'id'        => 'single_blog_title_height',
				        'type'      => 'dimensions',
				        'title'     => __('Single Blog Title Height', 'wolverine'),
				        'desc'      => __('You can set a height for the single blog title here', 'wolverine'),
				        'required'  => array('show_single_blog_title', '=', array('1')),
				        'units' => 'px',
				        'width'    =>  false,
                        'output' => array('.single-blog-title-height'),
				        'default'  => array(
					        'Height'  => ''
				        )
			        ),

			        array(
				        'id' => 'single_blog_title_bg_image',
				        'type' => 'media',
				        'url'=> true,
				        'title' => __('Single Blog Title Background', 'wolverine'),
				        'subtitle' => __('Upload single blog title background.', 'wolverine'),
				        'desc' => '',
				        'default' =>  array(
					        'url' => $page_title_bg_url
				        ),
				        'required'  => array('show_single_blog_title', '=', array('1'))
			        ),
		        )
	        );

            // Logo
            $this->sections[] = array(
                'title'  => __( 'Logo', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-leaf',
                'fields' => array(
                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Logo', 'wolverine'),
                        'subtitle' => __('Upload your logo here.', 'wolverine'),
                        'desc' => '',
                        'default' => array(
                            'url' => THEME_URL . 'assets/images/theme-options/logo.png'
                        )
                    ),

	                array(
		                'id'        => 'logo_height',
		                'type'      => 'dimensions',
		                'title'     => __('Logo Height', 'wolverine'),
		                'desc'      => __('You can set a height for the logo here', 'wolverine'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'height'  => ''
		                )
	                ),

                    array(
                        'id'        => 'logo_max_height',
                        'type'      => 'dimensions',
                        'title'     => __('Logo Max Height', 'wolverine'),
                        'desc'      => __('You can set a max height for the logo here', 'wolverine'),
                        'units' => 'px',
                        'width'    =>  false,
                        'default'  => array(
                            'height'  => ''
                        )
                    ),

	                array(
		                'id'             => 'logo_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'title'          => __('Logo Top/Bottom Padding', 'wolverine'),
		                'subtitle'       => __('This must be numeric (no px). Leave balnk for default.', 'wolverine'),
		                'desc'           => __('If you would like to override the default logo top/bottom padding, then you can do so here.', 'wolverine'),
		                'left'          => false,
		                'right'          => false,
		                'default'            => array(
			                'padding-top'     => '',
			                'padding-bottom'  => '',
			                'units'          => 'px',
		                )
	                ),
	                array(
		                'id' => 'sticky_logo',
		                'type' => 'media',
		                'url'=> true,
		                'title' => __('Sticky Logo', 'wolverine'),
		                'subtitle' => __('Upload a sticky version of your logo here', 'wolverine'),
		                'desc' => '',
		                'default' => array(
			                'url' => THEME_URL . 'assets/images/theme-options/logo.png'
		                )
	                ),
                )
            );

            // Header
            $this->sections[] = array(
                'title'  => __( 'Header', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-credit-card',
                'fields' => array(
	                array(
		                'id'       => 'top_drawer_type',
		                'type'     => 'button_set',
		                'title'    => __( 'Top Drawer Type', 'wolverine' ),
		                'subtitle' => __( 'Set top drawer type.', 'wolverine' ),
		                'desc'     => '',
		                'options'  => array( 'none' => 'Disable', 'show' => 'Always Show', 'toggle' => 'Toggle' ),
		                'default'  => 'none'
	                ),
	                array(
                        'id'       => 'top_drawer_sidebar',
                        'type' => 'select',
                        'title' => __('Top Drawer Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default top drawer sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'top_drawer_sidebar',
		                'required' => array('top_drawer_type','=',array('show','toggle')),
                    ),

                    array(
                        'id' => 'top_drawer_wrapper_layout',
                        'type' => 'button_set',
                        'title' => __('Top Drawer Wrapper Layout', 'wolverine'),
                        'subtitle' => __('Select top drawer wrapper layout', 'wolverine'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container',
                        'required' => array('top_drawer_type','=',array('show','toggle')),
                    ),

	                array(
		                'id'       => 'top_drawer_hide_mobile',
		                'type'     => 'button_set',
		                'title'    => __( 'Show/Hide Top Drawer on mobile', 'wolverine' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '1',
		                'required' => array('top_drawer_type','=',array('show','toggle')),
	                ),

	                array(
		                'id'             => 'top_drawer_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'left'           => false,
		                'right'          => false,
		                'title'          => __('Top drawer padding', 'wolverine'),
		                'desc'           => __('Set top drawer padding (px). Not include units.','wolverine'),
		                'default'            => array(
			                'padding-top'     => '0',
			                'padding-bottom'  => '0',
			                'units'          => 'px',
		                ),
		                'required' => array('top_drawer_type','=',array('show','toggle')),
	                ),

	                array(
		                'id'       => 'top_bar',
		                'type'     => 'button_set',
		                'title'    => __( 'Show/Hide Top Bar', 'wolverine' ),
		                'subtitle' => __( 'Show Hide Top Bar.', 'wolverine' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '0',
	                ),
                    array(
                        'id' => 'top_bar_layout',
                        'type' => 'image_select',
                        'title' => __('Top bar Layout', 'wolverine'),
                        'subtitle' => __('Select the top bar column layout.', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'top-bar-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg'),
                            'top-bar-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg'),
                            'top-bar-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg'),
	                        'top-bar-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'),
                        ),
                        'default' => 'top-bar-1',
                        'required' => array('top_bar','=','1'),
                    ),

                    array(
                        'id' => 'top_bar_left_sidebar',
                        'type' => 'select',
                        'title' => __('Top Left Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default top left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'top_bar_left',
                        'required' => array('top_bar','=','1'),
                    ),
                    array(
                        'id' => 'top_bar_right_sidebar',
                        'type' => 'select',
                        'title' => __('Top Right Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default top right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'top_bar_right',
                        'required' => array('top_bar','=','1'),
                    ),

                    array(
                        'id' => 'header_layout',
                        'type' => 'image_select',
                        'title' => __('Header Layout', 'wolverine'),
                        'subtitle' => __('Select a header layout option from the examples.', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'header-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-1.png'),
	                        'header-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-2.png'),
	                        'header-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-3.png'),
	                        'header-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-4.png'),
	                        'header-5' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-5.png'),
	                        'header-6' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-6.png'),
	                        'header-7' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-7.jpg'),
                        ),
                        'default' => 'header-2'
                    ),

	                array(
		                'id'        => 'header_tag_line',
		                'type'      => 'text',
		                'title'     => __('Set header Tagline', 'wolverine'),
		                'default'  => '',
		                'required' => array('header_layout','=','header-4'),
	                ),

	                array(
		                'id'       => 'header_background',
		                'type'     => 'background',
		                'title'    => __('Header background', 'wolverine'),
		                'subtitle' => __('Header background with image, color, etc.', 'wolverine'),
		                'default'  => array(
			                'background-color' => '#fff',
		                )
	                ),

	                array(
		                'id' => 'header_background_color_opacity',
		                'type'     => 'slider',
		                'title' => __('Header background color opacity', 'wolverine'),
		                'subtitle' => __('Set the opacity level of background color.', 'wolverine'),
		                'default'  => '100',
		                "min"       => 0,
		                "step"      => 1,
		                "max"       => 100
	                ),

	                array(
		                'id'        => 'header_nav_layout',
		                'type'      => 'button_set',
		                'title'     => __('Header navigation layout', 'wolverine'),
		                'options'  => array(
			                'container' => __('Container','wolverine'),
			                'nav-fullwith' => __('Full width','wolverine'),
		                ),
		                'default'  => 'container'
	                ),

	                array(
		                'id'        => 'header_nav_layout_padding',
		                'type'     => 'slider',
		                'title'     => __('Header navigation padding left/right (px)', 'wolverine'),
		                'default'  => '100',
		                "min"       => 0,
		                "step"      => 1,
		                "max"       => 200,
		                'required' => array('header_nav_layout','=','nav-fullwith'),
	                ),

	                array(
		                'id'        => 'header_nav_separate',
		                'type'      => 'button_set',
		                'title'     => __('Header navigation separate', 'wolverine'),
		                'options'  => array( '1' => 'Show', '0' => 'Hide' ),
		                'default'  => '0'
	                ),

	                array(
		                'id'        => 'header_nav_hover',
		                'type'      => 'button_set',
		                'title'     => __('Header navigation hover', 'wolverine'),
		                'options'  => array( 'nav-hover-primary' => 'Primary Color', 'nav-hover-bolder' => 'Bolder' ),
		                'default'  => 'nav-hover-primary'
	                ),

	                array(
		                'id'        => 'header_nav_hover_border',
		                'type'      => 'button_set',
		                'title'     => __('Header navigation hover border', 'wolverine'),
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '0',
		                'desc'      => __('Turn On/Off menu border when hover (top level)', 'wolverine'),
	                ),

	                array(
		                'id'        => 'header_nav_distance',
		                'type'      => 'dimensions',
		                'title'     => __('Header navigation distance', 'wolverine'),
		                'desc'      => __('You can set distance between navigation items. Empty value to default', 'wolverine'),
		                'units' => 'px',
		                'height'    =>  false,
		                'default'  => array(
			                'width'  => ''
		                )
	                ),

	                array(
		                'id'       => 'header_nav_scheme',
		                'type'     => 'button_set',
		                'title'    => __( 'Header navigation scheme', 'wolverine' ),
		                'subtitle' => __( 'Set header navigation scheme', 'wolverine' ),
		                'default'  => 'gray',
		                'options'  => array(
			                'gray' => __('Gray','wolverine'),
			                'light' => __('Light','wolverine'),
			                'dark' => __('Dark','wolverine'),
			                'customize' => __('Customize','wolverine')
		                )
	                ),

	                array(
		                'id'       => 'header_nav_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => __( 'Header navigation background color', 'wolverine' ),
		                'subtitle' => __( 'Set header navigation background color', 'wolverine' ),
		                'mode'     => 'background',
		                'validate' => 'colorrgba',
		                'default'   => array(
			                'color'     => '#f4f4f4',
			                'alpha'     => 1
		                ),
		                'options'       => array(
			                'allow_empty'   => false,
		                ),
		                'required' => array('header_nav_scheme','=','customize'),
	                ),

	                array(
		                'id'       => 'header_nav_text_color',
		                'type'     => 'color',
		                'title'    => __('Header navigation text color', 'wolverine'),
		                'subtitle' => __('Set header navigation text color', 'wolverine'),
		                'default'  => '#222',
		                'validate' => 'color',
		                'required' => array('header_nav_scheme','=','customize'),
	                ),

	                array(
		                'id'       => 'header_nav_border',
		                'type'     => 'border',
		                'title'    => __('Header navigation border bottom', 'wolverine'),
		                'left'     => false,
		                'right'     => false,
		                'top'     => false,
		                'default'  => array(
			                'border-color'  => '#E9E9E9',
			                'border-style'  => 'none',
			                'border-bottom' => '0'
		                ),
	                ),
	                array(
		                'id' => 'header_nav_border_opacity',
		                'type'     => 'slider',
		                'title' => __('Header navigation border bottom opacity', 'wolverine'),
		                'subtitle' => __('Set the opacity level of border bottom.', 'wolverine'),
		                'default'  => 40,
		                "min"       => 0,
		                "step"      => 1,
		                "max"       => 100
	                ),

	                array(
		                'id'       => 'header_layout_float',
		                'type'     => 'button_set',
		                'title'    => __( 'Header Float', 'wolverine' ),
		                'subtitle' => __( 'Enable/Disable Header Float.', 'wolverine' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '0',
	                ),

                    array(
                        'id'       => 'header_sticky',
                        'type'     => 'button_set',
                        'title'    => __( 'Show/Hide Header Sticky', 'wolverine' ),
                        'subtitle' => __( 'Show Hide header Sticky.', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),

	                array(
		                'id'       => 'header_sticky_scheme',
		                'type'     => 'button_set',
		                'title'    => __( 'Header sticky scheme', 'wolverine' ),
		                'subtitle' => __( 'Choose header sticky scheme', 'wolverine' ),
		                'desc'     => '',
		                'options'  => array(
			                'inherit'   => __('Inherit','wolverine'),
			                'gray'      => __('Gray','wolverine'),
			                'light'     => __('Light','wolverine'),
			                'dark'     => __('Dark','wolverine')
		                ),
		                'default'  => 'inherit'
	                ),

	                array(
		                'id'      => 'header_customize',
		                'type'    => 'sorter',
		                'title'   => 'Header customize',
		                'desc'    => 'Organize how you want the layout to appear on the header',
		                'options' => array(
			                'enabled'  => array(
				                'shopping-cart'   => __('Shopping Cart','wolverine'),
				                'search' => __('Search Box','wolverine'),
			                ),
			                'disabled' => array(
				                'social-profile' => __('Social Profile','wolverine'),
				                'custom-text' => __('Custom Text','wolverine'),
			                )
		                )
	                ),

	                array(
		                'id' => 'header_customize_social_profile',
		                'type' => 'select',
		                'multi' => true,
		                'width' => '100%',
		                'title' => __('Custom social profiles', 'wolverine'),
		                'subtitle' => __('Select social profile for custom text', 'wolverine'),
		                'options' => array(
			                'twitter'  => __( 'Twitter', 'wolverine' ),
			                'facebook'  => __( 'Facebook', 'wolverine' ),
			                'dribbble'  => __( 'Dribbble', 'wolverine' ),
			                'vimeo'  => __( 'Vimeo', 'wolverine' ),
			                'tumblr'  => __( 'Tumblr', 'wolverine' ),
			                'skype'  => __( 'Skype', 'wolverine' ),
			                'linkedin'  => __( 'LinkedIn', 'wolverine' ),
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
		                'desc' => '',
		                'default' => ''
	                ),

	                array(
		                'id' => 'header_customize_text',
		                'type' => 'ace_editor',
		                'mode' => 'html',
		                'theme' => 'monokai',
		                'title' => __('Custom Text Content', 'wolverine'),
		                'subtitle' => __('Add Content for Custom Text', 'wolverine'),
		                'desc' => '',
		                'default' => '',
		                'options'  => array('minLines'=> 5, 'maxLines' => 60),
	                ),

	                array(
		                'id' => 'header_shopping_cart_button',
		                'type' => 'checkbox',
		                'title' => __('Shopping Cart Button', 'wolverine'),
		                'subtitle' => __('Select header shopping cart button', 'wolverine'),
		                'options' => array(
			                'view-cart' => 'View Cart',
			                'checkout' => 'Checkout',
		                ),
		                'default' => array(
			                'view-cart' => '1',
			                'checkout' => '1',
		                ),
		                'required' => array('header_shopping_cart','=','1'),
	                ),

                    array(
                        'id' => 'search_box_type',
                        'type' => 'button_set',
                        'title' => __('Search Box Type', 'wolverine'),
                        'subtitle' => __('Select search box type.', 'wolverine'),
                        'desc' => '',
                        'options' => array('standard' => __('Standard','wolverine'),'ajax' => __('Ajax Search','wolverine')),
                        'default' => 'standard'
                    ),

                    array(
                        'id' => 'search_box_post_type',
                        'type' => 'checkbox',
                        'title' => __('Post type for Ajax Search', 'wolverine'),
                        'subtitle' => __('Select post type for ajax search', 'wolverine'),
                        'options' => array(
                            'post' => 'Post',
	                        'page' => 'Page',
                            'product' => 'Product',
                            'portfolio' => 'Portfolio',
                            'service' => 'Our Services',
                        ),
                        'default' => array(
                            'post'      => '1',
	                        'page'      => '0',
                            'product'   => '1',
                            'portfolio' => '1',
	                        'service'   => '1',
                        ),
                        'required' => array('search_box_type','=','ajax'),
                    ),

                    array(
                        'id'        => 'search_box_result_amount',
                        'type'      => 'text',
                        'title'     => __('Amount Of Search Result', 'wolverine'),
                        'subtitle'  => __('This must be numeric (no px) or empty (default: 8).', 'wolverine'),
                        'desc'      => __('Set mount of Search Result', 'wolverine'),
                        'validate'  => 'numeric',
                        'default'   => '',
                        'required' => array('search_box_type','=','ajax'),
                    ),
                )
            );

            $this->sections[] = array(
                'title'  => __( 'Mobile Header', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-th-list',
                'fields' => array(
	                array(
		                'id' => 'mobile_header_layout',
		                'type' => 'image_select',
		                'title' => __('Header Layout', 'wolverine'),
		                'subtitle' => __('Select header mobile layout', 'wolverine'),
		                'desc' => '',
		                'options' => array(
			                'header-mobile-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-1.png'),
			                'header-mobile-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-2.png'),
			                'header-mobile-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-3.png'),
			                'header-mobile-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-4.png'),
			                'header-mobile-5' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-5.jpg'),
		                ),
		                'default' => 'header-mobile-2'
	                ),

	                array(
		                'id'       => 'mobile_header_menu_drop',
		                'type'     => 'button_set',
		                'title'    => __( 'Menu Drop Type', 'wolverine' ),
		                'subtitle' => __( 'Set menu drop type for mobile header', 'wolverine' ),
		                'desc'     => '',
		                'options'  => array(
			                'dropdown' => __('Dropdown Menu','wolverine'),
			                'fly' => __('Fly Menu','wolverine')
		                ),
		                'default'  => 'fly'
	                ),

	                array(
                        'id' => 'mobile_header_logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Mobile Logo', 'wolverine'),
                        'subtitle' => __('Upload your logo here.', 'wolverine'),
                        'desc' => '',
                        'default' => array(
                            'url' => THEME_URL . 'assets/images/theme-options/logo.png'
                        )
                    ),

	                array(
		                'id'        => 'logo_mobile_height',
		                'type'      => 'dimensions',
		                'title'     => __('Logo Height', 'wolverine'),
		                'desc'      => __('You can set a height for the logo here', 'wolverine'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'height'  => ''
		                )
	                ),

	                array(
		                'id'        => 'logo_mobile_max_height',
		                'type'      => 'dimensions',
		                'title'     => __('Logo Mobile Max Height', 'wolverine'),
		                'desc'      => __('You can set a max height for the logo mobile here', 'wolverine'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'height'  => ''
		                )
	                ),

	                array(
		                'id'        => 'logo_mobile_padding',
		                'type'      => 'dimensions',
		                'title'     => __('Logo Top/Bottom Padding', 'wolverine'),
		                'desc'      => __('If you would like to override the default logo top/bottom padding, then you can do so here', 'wolverine'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'height'  => ''
		                )
	                ),

                    array(
                        'id'       => 'mobile_header_top_bar',
                        'type'     => 'button_set',
                        'title'    => __( 'Top Bar', 'wolverine' ),
                        'subtitle' => __( 'Enable Top bar.', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'mobile_header_stick',
                        'type'     => 'button_set',
                        'title'    => __( 'Stick Mobile Header', 'wolverine' ),
                        'subtitle' => __( 'Enable Stick Mobile Header.', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'mobile_header_search_box',
                        'type'     => 'button_set',
                        'title'    => __( 'Search Box', 'wolverine' ),
                        'subtitle' => __( 'Enable Search Box.', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'mobile_header_shopping_cart',
                        'type'     => 'button_set',
                        'title'    => __( 'Shopping Cart', 'wolverine' ),
                        'subtitle' => __( 'Enable Shopping Cart', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                )
            );

            $this->sections[] = array(
                'title'  => __( 'Footer', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-website',
                'fields' => array(
	                array(
		                'id' => 'footer_wrap_layout',
		                'type' => 'button_set',
		                'title' => __('Wrapper Layout', 'wolverine'),
		                'subtitle' => __('Select Footer Wrapper Layout', 'wolverine'),
		                'desc' => '',
		                'options' => array(
                            'full' => __('Full Width','wolverine'),
                            'container-fluid' => __('Container Fluid','wolverine')
                        ),
		                'default' => 'full'
	                ),


                    array(
                        'id' => 'footer_layout',
                        'type' => 'image_select',
                        'title' => __('Layout', 'wolverine'),
                        'subtitle' => __('Select the footer column layout.', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'footer-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-1.jpg'),
                            'footer-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-2.jpg'),
                            'footer-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-3.jpg'),
                            'footer-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-4.jpg'),
                            'footer-5' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-5.jpg'),
                            'footer-6' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-6.jpg'),
                            'footer-7' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-7.jpg'),
                            'footer-8' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-8.jpg'),
                            'footer-9' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-9.jpg'),
                        ),
                        'default' => 'footer-5'
                    ),

	                array(
		                'id' => 'footer_sidebar_1',
		                'type' => 'select',
		                'title' => __('Sidebar 1', 'wolverine'),
		                'subtitle' => "Choose the default footer sidebar 1",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-1',
	                ),

	                array(
		                'id' => 'footer_sidebar_2',
		                'type' => 'select',
		                'title' => __('Sidebar 2', 'wolverine'),
		                'subtitle' => "Choose the default footer sidebar 2",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-2',
	                ),

	                array(
		                'id' => 'footer_sidebar_3',
		                'type' => 'select',
		                'title' => __('Sidebar 3', 'wolverine'),
		                'subtitle' => "Choose the default footer sidebar 3",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-3',
	                ),

	                array(
		                'id' => 'footer_sidebar_4',
		                'type' => 'select',
		                'title' => __('Sidebar 4', 'wolverine'),
		                'subtitle' => "Choose the default footer sidebar 4",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-4',
	                ),

                    array(
                        'id'             => 'footer_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => __('Footer Top/Bottom Padding', 'wolverine'),
                        'subtitle'       => __('This must be numeric (no px). Leave balnk for default.', 'wolverine'),
                        'desc'           => __('If you would like to override the default footer top/bottom padding, then you can do so here.', 'wolverine'),
                        'left'          => false,
                        'right'          => false,
                        'default'            => array(
                            'padding-top'     => '',
                            'padding-bottom'  => '',
                            'units'          => 'px',
                        )
                    ),


                    array(
                        'id' => 'footer_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Background image', 'wolverine'),
                        'subtitle' => __('Upload footer background image here', 'wolverine'),
                        'desc' => '',
                    ),


	                array(
		                'id' => 'footer_scheme',
		                'type' => 'button_set',
		                'title' => __('Scheme', 'wolverine'),
		                'subtitle' => __( 'Choose footer scheme', 'wolverine' ),
		                'desc' => '',
		                'options'  => array(
			                'gray'      => __('Gray','wolverine'),
			                'light'     => __('Light','wolverine'),
			                'dark'     => __('Dark','wolverine'),
			                'custom'   => __('Custom','wolverine'),
		                ),
		                'default' => 'gray'
	                ),





	                array(
		                'id'       => 'footer_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => __('Background Color', 'wolverine'),
		                'subtitle' => __('Set Footer Background Color.', 'wolverine'),
		                'default'  => array(),
		                'validate' => 'colorrgba',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'footer_text_color',
		                'type'     => 'color',
		                'title'    => __('Text Color', 'wolverine'),
		                'subtitle' => __('Set Footer Text Color.', 'wolverine'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'footer_heading_text_color',
		                'type'     => 'color',
		                'title'    => __('Heading Text Color', 'wolverine'),
		                'subtitle' => __('Set Footer Heading Text Color.', 'wolverine'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'bottom_bar_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => __('Bottom Bar Background Color', 'wolverine'),
		                'subtitle' => __('Set Bottom Bar Background Color.', 'wolverine'),
		                'default'  => array(),
		                'validate' => 'colorrgba',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'bottom_bar_text_color',
		                'type'     => 'color',
		                'title'    => __('Bottom Bar Text Color', 'wolverine'),
		                'subtitle' => __('Set Bottom Bar Text Color.', 'wolverine'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

                    array(
                        'id'       => 'footer_parallax',
                        'type'     => 'button_set',
                        'title'    => __( 'Footer Parallax', 'wolverine' ),
                        'subtitle' => __( 'Enable Footer Parallax', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'collapse_footer',
                        'type'     => 'button_set',
                        'title'    => __( 'Collapse footer on mobile device', 'wolverine' ),
                        'subtitle' => __( 'Enable collapse footer', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'bottom_bar',
                        'type'     => 'button_set',
                        'title'    => __( 'Bottom Bar', 'wolverine' ),
                        'subtitle' => __( 'Enable Bottom Bar (below Footer)', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),

                    array(
                        'id' => 'bottom_bar_layout',
                        'type' => 'image_select',
                        'title' => __('Bottom bar Layout', 'wolverine'),
                        'subtitle' => __('Select the bottom bar column layout.', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'bottom-bar-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-1.jpg'),
                            'bottom-bar-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-2.jpg'),
                            'bottom-bar-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-3.jpg'),
	                        'bottom-bar-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-4.jpg'),
                        ),
                        'default' => 'bottom-bar-4',
                        'required' => array('bottom_bar','=','1'),
                    ),

                    array(
                        'id' => 'bottom_bar_left_sidebar',
                        'type' => 'select',
                        'title' => __('Bottom Left Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default bottom left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'bottom_bar_left',
                        'required' => array('bottom_bar','=','1'),
                    ),
                    array(
                        'id' => 'bottom_bar_right_sidebar',
                        'type' => 'select',
                        'title' => __('Bottom Right Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default bottom right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'bottom_bar_right',
                        'required' => array('bottom_bar','=','1'),
                    ),
                )
            );




            $this->sections[] = array(
                'title'  => __( 'Styling Options', 'wolverine' ),
                'desc'   => __( 'If you change value in this section, you must "Save & Generate CSS"', 'wolverine' ),
                'icon'   => 'el el-magic',
                'fields' => array(
                    array(
                        'id'       => 'primary_color',
                        'type'     => 'color',
                        'title'    => __('Primary Color', 'wolverine'),
                        'subtitle' => __('Set Primary Color', 'wolverine'),
                        'default'  => '#995958',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'secondary_color',
                        'type'     => 'color',
                        'title'    => __('Secondary Color', 'wolverine'),
                        'subtitle' => __('Set Secondary Color', 'wolverine'),
                        'default'  => '#444444',
                        'validate' => 'color',
                    ),

	                array(
		                'id'       => 'top_drawer_bg_color',
		                'type'     => 'color',
		                'title'    => __( 'Top drawer background color', 'wolverine' ),
		                'subtitle' => __( 'Set Top drawer background color.', 'wolverine' ),
		                'default'  => '#2f2f2f',
		                'validate' => 'color',
	                ),

	                array(
		                'id'       => 'top_drawer_text_color',
		                'type'     => 'color',
		                'title'    => __('Top drawer text color', 'wolverine'),
		                'subtitle' => __('Pick a text color for the Top drawer', 'wolverine'),
		                'default'  => '#c5c5c5',
		                'validate' => 'color',
	                ),

	                array(
		                'id'       => 'top_bar_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => __( 'Top Bar background color', 'wolverine' ),
		                'subtitle' => __( 'Set Top Bar background color.', 'wolverine' ),
		                'default'  => array(
			                'color' => '#333',
			                'alpha' => '1'
		                ),
		                'mode'     => 'background',
		                'validate' => 'colorrgba',
	                ),

	                array(
		                'id'       => 'top_bar_text_color',
		                'type'     => 'color',
		                'title'    => __('Top Bar text color', 'wolverine'),
		                'subtitle' => __('Pick a text color for the Top Bar', 'wolverine'),
		                'default'  => '#c5c5c5',
		                'validate' => 'color',
	                ),

                    array(
                        'id'       => 'text_color',
                        'type'     => 'color',
                        'title'    => __('Text Color', 'wolverine'),
                        'subtitle' => __('Set Text Color.', 'wolverine'),
                        'default'  => '#555555',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'bold_color',
                        'type'     => 'color',
                        'title'    => __('Bolder Color', 'wolverine'),
                        'subtitle' => __('Set Bolder Color.', 'wolverine'),
                        'default'  => '#333333',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'heading_color',
                        'type'     => 'color',
                        'title'    => __('Heading Color', 'wolverine'),
                        'subtitle' => __('Set Heading Color.', 'wolverine'),
                        'default'  => '#333333',
                        'validate' => 'color',
                    ),



                    array(
                        'id'       => 'link_color',
                        'type'     => 'link_color',
                        'title'    => __( 'Link Color', 'wolverine' ),
                        'subtitle' => __( 'Link Color.', 'wolverine' ),
                        'default'  => array(
                            'regular'  => '#995958', // blue
                            'hover'    => '#995958', // red
                            'active'   => '#995958',  // purple
                        ),
                    ),

                    array(
                        'id'       => 'count_down_color',
                        'type'     => 'color',
                        'title'    => __( 'Circle countdown Color', 'wolverine' ),
                        'subtitle' => __( 'Circle countdown Color.', 'wolverine' ),
                        'default'  => '#fff',
                        'validate' => 'color'
                    ),

                    array(
                        'id'=>'styling-color-divide-0',
                        'type' => 'divide'
                    ),

	                array(
		                'id'       => 'menu_sub_scheme',
		                'type'     => 'button_set',
		                'title'    => __( 'Sub menu scheme', 'wolverine' ),
		                'subtitle' => __( 'Set sub menu scheme', 'wolverine' ),
		                'default'  => 'light',
		                'options'  => array(
			                'gray' => __('Gray','wolverine'),
			                'light' => __('Light','wolverine'),
			                'dark' => __('Dark','wolverine'),
			                'customize' => __('Customize','wolverine')
		                )
	                ),

                    array(
                        'id'       => 'menu_sub_bg_color',
                        'type'     => 'color',
                        'title'    => __('Sub Menu Background Color', 'wolverine'),
                        'subtitle' => __('Set Sub Menu Background Color.', 'wolverine'),
                        'default'  => '#fff',
                        'validate' => 'color',
	                    'required'  => array('menu_sub_scheme', '=', 'customize'),
                    ),

                    array(
                        'id'       => 'menu_sub_text_color',
                        'type'     => 'color',
                        'title'    => __('Sub Menu Text Color', 'wolverine'),
                        'subtitle' => __('Set Sub Menu Text Color.', 'wolverine'),
                        'default'  => '#888',
                        'validate' => 'color',
	                    'required'  => array('menu_sub_scheme', '=', 'customize'),
                    ),

                    array(
                        'id'=>'styling-color-divide-1',
                        'type' => 'divide'
                    ),

                    array(
                        'id' => 'page_title_bg_color',
                        'type'     => 'color',
                        'title' => __('Page Title Background Color', 'wolverine'),
                        'subtitle' => __('Pick a background color for page title.', 'wolverine'),
                        'default'  => '#FFFFFF',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'page_title_overlay_color',
                        'type'     => 'color',
                        'title' => __('Page Title Background Overlay Color', 'wolverine'),
                        'subtitle' => __('Pick a background overlay color for page title.', 'wolverine'),
                        'default'  => '#000',
                        'validate' => 'color',
                    ),

                    array(
		                'id' => 'page_title_overlay_opacity',
		                'type'     => 'slider',
		                'title' => __('Page Title Background Overlay Opacity', 'wolverine'),
		                'subtitle' => __('Set the opacity level of the overlay.', 'wolverine'),
		                'default'  => '30',
		                "min"       => 0,
		                "step"      => 1,
		                "max"       => 100
	                ),

                    array(
                        'id'=>'styling-color-divide-2',
                        'type' => 'divide'
                    ),



                    array(
                        'id' => 'breadcrumbs_text_color',
                        'type'     => 'color',
                        'title' => __('Breadcrumbs Text Color', 'wolverine'),
                        'subtitle' => __('Pick a text color for breadcrumbs.', 'wolverine'),
                        'default'  => '#535353',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'breadcrumbs_background_color',
                        'type'     => 'color',
                        'title' => __('Breadcrumbs background color', 'wolverine'),
                        'subtitle' => __('Pick a color for background breadcrumbs.', 'wolverine'),
                        'default'  => '#f4f4f4',
                        'validate' => 'color',
                    ),

                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-fontsize',
                'title' => __('Font Options', 'wolverine'),
                'desc'   => __( 'If you change value in this section, you must "Save & Generate CSS"', 'wolverine' ),
                'fields' => array(
                    array(
                        'id'=>'body_font',
                        'type' => 'typography',
                        'title' => esc_html__('Body Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the body font properties.', 'wolverine'),
                        'google'=> true,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'line-height'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'13px',
                            'font-family'=>'Raleway',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h1_font',
                        'type' => 'typography',
                        'title' => esc_html__('H1 Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the H1 font properties.', 'wolverine'),
                        'google'=> true,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'36px',
                            'line-height'=>'43.2px',
                            'font-family'=>'Montserrat',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h2_font',
                        'type' => 'typography',
                        'title' => esc_html__('H2 Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the H2 font properties.', 'wolverine'),
                        'google'=> true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'28px',
                            'line-height'=>'33.6px',
                            'font-family'=>'Montserrat',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h3_font',
                        'type' => 'typography',
                        'title' => esc_html__('H3 Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the H3 font properties.', 'wolverine'),
                        'google'=> true,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'24px',
                            'line-height'=>'28.8px',
                            'font-family'=>'Montserrat',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h4_font',
                        'type' => 'typography',
                        'title' => esc_html__('H4 Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the H4 font properties.', 'wolverine'),
                        'google'=> true,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'21px',
                            'line-height'=>'25.2px',
                            'font-family'=>'Montserrat',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h5_font',
                        'type' => 'typography',
                        'title' => esc_html__('H5 Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the H5 font properties.', 'wolverine'),
                        'google'=> true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'18px',
                            'line-height'=>'21.6px',
                            'font-family'=>'Montserrat',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h6_font',
                        'type' => 'typography',
                        'title' => esc_html__('H6 Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the H6 font properties.', 'wolverine'),
                        'google'=> true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'14px',
                            'line-height'=>'16.8px',
                            'font-family'=>'Montserrat',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=> 'menu_font',
                        'type' => 'typography',
                        'title' => esc_html__('Menu Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the Menu font properties.', 'wolverine'),
                        'google' => true,
                        'line-height'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'color'=>false,
                        'text-align'=>false,
                        'font-style' => false,
                        'subsets' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Montserrat',
                        ),
                    ),

                    array(
                        'id'=> 'secondary_font',
                        'type' => 'typography',
                        'title' => esc_html__('Secondary Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the Secondary font properties.', 'wolverine'),
                        'google' => true,
                        'line-height'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'color'=>false,
                        'text-align'=>false,
                        'font-style' => false,
                        'subsets' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Montserrat',
                        ),
                    ),


                    array(
                        'id'=> 'other_font',
                        'type' => 'typography',
                        'title' => esc_html__('Other Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the Other font properties.', 'wolverine'),
                        'google' => true,
                        'line-height'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'color'=>false,
                        'text-align'=>false,
                        'font-style' => false,
                        'subsets' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Playfair Display',
                        ),
                    ),

                    array(
                        'id'=> 'page_title_font',
                        'type' => 'typography',
                        'title' => esc_html__('Page Title Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the page title font properties.', 'wolverine'),
                        'google' => true,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'=>false,
                        'color'=>true,
                        'text-align'=>false,
                        'font-style' => true,
                        'subsets' => false,
                        'font-size' => true,
                        'font-weight' => true,
                        'text-transform' => true,
                        'output' => array('.page-title-inner h1'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Montserrat',
                            'font-size'=>'36px',
                            'font-weight'=>'400',
                            'text-transform' => 'uppercase',
                            'color' => '#ffffff'
                        ),
                    ),

                    array(
                        'id'=> 'page_sub_title_font',
                        'type' => 'typography',
                        'title' => esc_html__('Page Sub Title Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the page sub title font properties.', 'wolverine'),
                        'google' => true,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'=>false,
                        'color'=>true,
                        'text-align'=>false,
                        'font-style' => true,
                        'subsets' => false,
                        'font-size' => true,
                        'font-weight' => true,
                        'text-transform' => true,
                        'output' => array('.page-title-inner .page-sub-title'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Playfair Display',
                            'font-size'=>'16px',
                            'font-weight'=>'400',
	                        'font-style'=>'italic',
                            'text-transform' => 'none',
                            'color' => '#ffffff'
                        ),
                    ),



                    array(
                        'id'=> 'count_down_font',
                        'type' => 'typography',
                        'title' => esc_html__('Countdown Font', 'wolverine'),
                        'subtitle' => esc_html__('Specify the countdown font properties.', 'wolverine'),
                        'google' => true,
                        'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'=>false,
                        'color'=>false,
                        'text-align'=>false,
                        'font-style' => false,
                        'subsets' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Lato',
                        ),
                    ),
                ),
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Social Profiles', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-path',
                'fields' => array(
                    array(
                        'id' => 'twitter_url',
                        'type' => 'text',
                        'title' => esc_html__('Twitter', 'wolverine'),
                        'subtitle' => esc_html__('Your Twitter','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'facebook_url',
                        'type' => 'text',
                        'title' => esc_html__('Facebook', 'wolverine'),
                        'subtitle' => esc_html__('Your facebook page/profile url','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'dribbble_url',
                        'type' => 'text',
                        'title' => esc_html__('Dribbble', 'wolverine'),
                        'subtitle' => esc_html__('Your Dribbble','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'vimeo_url',
                        'type' => 'text',
                        'title' => esc_html__('Vimeo', 'wolverine'),
                        'subtitle' => esc_html__('Your Vimeo','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'tumblr_url',
                        'type' => 'text',
                        'title' => esc_html__('Tumblr', 'wolverine'),
                        'subtitle' => esc_html__('Your Tumblr','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'skype_username',
                        'type' => 'text',
                        'title' => esc_html__('Skype', 'wolverine'),
                        'subtitle' => esc_html__('Your Skype username','wolverine'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'linkedin_url',
                        'type' => 'text',
                        'title' => esc_html__('LinkedIn', 'wolverine'),
                        'subtitle' => esc_html__('Your LinkedIn page/profile url','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'flickr_url',
                        'type' => 'text',
                        'title' => esc_html__('Flickr', 'wolverine'),
                        'subtitle' => esc_html__('Your Flickr page url','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'youtube_url',
                        'type' => 'text',
                        'title' => esc_html__('YouTube', 'wolverine'),
                        'subtitle' => esc_html__('Your YouTube URL','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'pinterest_url',
                        'type' => 'text',
                        'title' => esc_html__('Pinterest', 'wolverine'),
                        'subtitle' => esc_html__('Your Pinterest','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'foursquare_url',
                        'type' => 'text',
                        'title' => esc_html__('Foursquare', 'wolverine'),
                        'subtitle' => esc_html__('Your Foursqaure URL','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'instagram_url',
                        'type' => 'text',
                        'title' => esc_html__('Instagram', 'wolverine'),
                        'subtitle' => esc_html__('Your Instagram','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'github_url',
                        'type' => 'text',
                        'title' => esc_html__('GitHub', 'wolverine'),
                        'subtitle' => esc_html__('Your GitHub URL','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'xing_url',
                        'type' => 'text',
                        'title' => esc_html__('Xing', 'wolverine'),
                        'subtitle' => esc_html__('Your Xing URL','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'behance_url',
                        'type' => 'text',
                        'title' => esc_html__('Behance', 'wolverine'),
                        'subtitle' => esc_html__('Your Behance URL','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'deviantart_url',
                        'type' => 'text',
                        'title' => esc_html__('Deviantart', 'wolverine'),
                        'subtitle' => esc_html__('Your Deviantart URL','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'soundcloud_url',
                        'type' => 'text',
                        'title' => esc_html__('SoundCloud', 'wolverine'),
                        'subtitle' => esc_html__('Your SoundCloud URL','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'yelp_url',
                        'type' => 'text',
                        'title' => esc_html__('Yelp', 'wolverine'),
                        'subtitle' => esc_html__('Your Yelp URL','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'rss_url',
                        'type' => 'text',
                        'title' => esc_html__('RSS Feed', 'wolverine'),
                        'subtitle' => esc_html__('Your RSS Feed URL','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'email_address',
                        'type' => 'text',
                        'title' => esc_html__('Email address', 'wolverine'),
                        'subtitle' => esc_html__('Your email address','wolverine'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id'=>'social-profile-divide-0',
                        'type' => 'divide'
                    ),
                    array(
                        'title'    => esc_html__('Social Share', 'wolverine'),
                        'id'       => 'social_sharing',
                        'type'     => 'checkbox',
                        'subtitle' => esc_html__('Show the social sharing in blog posts', 'wolverine'),

                        //Must provide key => value pairs for multi checkbox options
                        'options'  => array(
                            'facebook' => 'Facebook',
                            'twitter' => 'Twitter',
                            'linkedin' => 'Linkedin',
                            'tumblr' => 'Tumblr',
                            'pinterest' => 'Pinterest'
                        ),

                        //See how default has changed? you also don't need to specify opts that are 0.
                        'default' => array(
                            'facebook' => '1',
                            'twitter' => '1',
                            'linkedin' => '1',
                            'tumblr' => '1',
                            'pinterest' => '1'
                        )
                    )
                )
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Woocommerce', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-shopping-cart',
                'fields' => array(
                    array(
                        'id'       => 'add_to_cart_animation',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Add To Cart Animation', 'wolverine' ),
                        'subtitle' => esc_html__( 'Enable Add To Cart Animation', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                    array(
                        'id'        => 'product_per_page',
                        'type'      => 'text',
                        'title'     => esc_html__('Products Per Page', 'wolverine'),
                        'subtitle'  => esc_html__('This must be numeric or empty (default 12).', 'wolverine'),
                        'desc'      => esc_html__('Set Products Per Page in archive product', 'wolverine'),
                        'validate'  => 'numeric',
                        'default'   => '12',
                    ),
                    array(
                        'id' => 'product_display_columns',
                        'type' => 'select',
                        'title' => esc_html__('Product Display Columns', 'wolverine'),
                        'subtitle' => esc_html__('Choose the number of columns to display on shop/category pages.','wolverine'),
                        'options' => array(
                            '2'		=> '2',
                            '3'		=> '3',
                            '4'		=> '4',
                            '5'		=> '5',
                            '6'		=> '6',
                        ),
                        'desc' => '',
                        'default' => '3',
                        'select2' => array('allowClear' =>  false) ,
                    ),
                    array(
                        'id'       => 'product_show_rating',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Rating', 'wolverine' ),
                        'subtitle' => esc_html__( 'Show/Hide Rating product', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),


                    array(
                        'id'       => 'product_sale_flash_mode',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Sale Flash Mode', 'wolverine' ),
                        'subtitle' => esc_html__( 'Chose Sale Flash Mode', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array(
                        	'text' => esc_html__('Text','wolverine'),
	                        'percent' => esc_html__('Percent','wolverine')
                        ),
                        'default'  => 'percent'
                    ),

                    array(
                        'id'       => 'product_show_result_count',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Result Count', 'wolverine' ),
                        'subtitle' => esc_html__( 'Show/Hide Result Count In Archive Product', 'wolverine' ),
                        'options'  => array(
                        	'1' => esc_html__('On','wolverine'),
	                        '0' => esc_html__('Off','wolverine')
                        ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'product_show_catalog_ordering',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Catalog Ordering', 'wolverine' ),
                        'subtitle' => esc_html__( 'Show/Hide Catalog Ordering', 'wolverine' ),
                        'options'  => array(
                        	'1' => esc_html__('On','wolverine'),
	                        '0' => esc_html__('Off','wolverine')
                        ),
                        'default'  => '1'
                    ),
	                array(
		                'id'       => 'product_quick_view',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Quick View', 'wolverine' ),
		                'subtitle' => esc_html__( 'Enable/Disable Quick View', 'wolverine' ),
		                'options'  => array(
		                	'1' => esc_html__('Enable','wolverine'),
			                '0' => esc_html__('Disable','wolverine')
		                ),
		                'default'  => '1'
	                ),
                )
            );


            // Archive Product
            $this->sections[] = array(
                'title'  => esc_html__( 'Archive Product', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-book',
                'subsection' => true,
                'fields' => array(

	                array(
		                'id' => 'archive_product_style',
		                'type' => 'button_set',
		                'title' => esc_html__('Archive Product Style', 'wolverine'),
		                'subtitle' => esc_html__('Archive Product Style', 'wolverine'),
		                'desc' => '',
		                'options' => array(
			                'classic-1' => esc_html__('Classic 1','wolverine'),
			                'classic-2' => esc_html__('Classic 2','wolverine'),
			                'creative' => esc_html__('Creative','wolverine')
		                ),
		                'default' => 'classic-1'
	                ),

                    array(
                        'id' => 'archive_product_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Archive Product Layout', 'wolverine'),
                        'subtitle' => esc_html__('Select Archive Product Layout', 'wolverine'),
                        'options' => array(
                        	'full' => esc_html__('Full Width','wolverine'),
	                        'container' => esc_html__('Container','wolverine'),
	                        'container-fluid' => esc_html__('Container Fluid','wolverine')
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'archive_product_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Archive Product Sidebar', 'wolverine'),
                        'subtitle' => esc_html__('Set Archive Product Sidebar', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                        ),
                        'default' => 'right'
                    ),
                    array(
                        'id' => 'archive_product_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'wolverine'),
                        'subtitle' => esc_html__('Set Sidebar width', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                        	'small' => esc_html__('Small (1/4)','wolverine'),
	                        'large' => esc_html__('Large (1/3)','wolverine')
                        ),
                        'default' => 'small',
                        'required'  => array('archive_product_sidebar', '=', array('left','both','right')),
                    ),
                    array(
                        'id' => 'archive_product_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Product Left Sidebar', 'wolverine'),
                        'subtitle' => esc_html__('Choose the default Archive Product left sidebar','wolverine'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('archive_product_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'archive_product_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Product Right Sidebar', 'wolverine'),
                        'subtitle' => esc_html__('Choose the default Archive Product right sidebar','wolverine'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('archive_product_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id' => 'breadcrumbs_in_archive_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs in Archive Product', 'wolverine'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Archive Product', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                        	'1' => esc_html__('On','wolverine'),
	                        '0' => esc_html__('Off','wolverine')
                        ),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'show_archive_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Archive Title', 'wolverine'),
                        'subtitle' => esc_html__('Enable/Disable Archive Product Title', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                        	'1' => esc_html__('On','wolverine'),
	                        '0' => esc_html__('Off','wolverine')
                        ),
                        'default' => '1'
                    ),


                    array(
                        'id'       => 'archive_product_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Product Title Text Align', 'wolverine' ),
                        'subtitle' => esc_html__( 'Set Archive Product Title Text Align', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array(
                        	'left' => 'Left', 'center' => 'Center', 'right' => 'Right'
                        ),
                        'default'  => 'left',
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'archive_product_title_parallax',
                        'type'     => 'button_set',
                        'title'    => __( 'Archive Product Title Parallax', 'wolverine' ),
                        'subtitle' => __( 'Enable Archive Product Title Parallax', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),


                    array(
                        'id'        => 'archive_product_title_height',
                        'type'      => 'dimensions',
                        'title'     => __('Archive Product Title Height', 'wolverine'),
                        'desc'      => __('You can set a height for the archive product title here', 'wolverine'),
                        'required'  => array('show_archive_product_title', '=', array('1')),
                        'units' => 'px',
                        'output' => array('.archive-product-title-height'),
                        'width'    =>  false,
                        'default'  => array(
                            'Height'  => ''
                        )
                    ),

                    array(
                        'id' => 'archive_product_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Archive Product Title Background', 'wolverine'),
                        'subtitle' => __('Upload archive product title background.', 'wolverine'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        ),
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),
                    array(
                        'id' => 'show_page_shop_content',
                        'type' => 'button_set',
                        'title' => __('Show Page Shop Content', 'wolverine'),
                        'subtitle' => __('Enable/Disable Shop Page Content', 'wolverine'),
                        'desc' => '',
                        'options' => array('0' => 'Off','before' => 'Show Before Archive','after' => 'Show After Archive'),
                        'default' => '0'
                    ),
                )
            );

            // Single Product
            $this->sections[] = array(
                'title'  => __( 'Single Product', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-laptop',
                'subsection' => true,
                'fields' => array(
	                array(
		                'id'       => 'single_product_show_image_thumb',
		                'type'     => 'button_set',
		                'title'    => __( 'Show Image Thumb', 'wolverine' ),
		                'subtitle' => __( 'Show/Hide Image Thumb product', 'wolverine' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '1'
	                ),





	                array(
		                'id' => 'section-single-product-layout-start',
		                'type' => 'section',
		                'title' => __('Layout Options', 'wolverine'),
		                'indent' => true
	                ),

                    array(
                        'id' => 'single_product_layout',
                        'type' => 'button_set',
                        'title' => __('Single Product Layout', 'wolverine'),
                        'subtitle' => __('Select Single Product Layout', 'wolverine'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'single_product_sidebar',
                        'type' => 'image_select',
                        'title' => __('Single Product Sidebar', 'wolverine'),
                        'subtitle' => __('Set Single Product Sidebar', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                        ),
                        'default' => 'left'
                    ),
                    array(
                        'id' => 'single_product_sidebar_width',
                        'type' => 'button_set',
                        'title' => __('Single Product Sidebar Width', 'wolverine'),
                        'subtitle' => __('Set Sidebar width', 'wolverine'),
                        'desc' => '',
                        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
                        'default' => 'small',
                        'required'  => array('single_product_sidebar', '=', array('left','both','right')),
                    ),
                    array(
                        'id' => 'single_product_left_sidebar',
                        'type' => 'select',
                        'title' => __('Single Product Left Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default Single Product left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('single_product_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'single_product_right_sidebar',
                        'type' => 'select',
                        'title' => __('Single Product Right Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default Single Product right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('single_product_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id' => 'breadcrumbs_in_single_product_title',
                        'type' => 'button_set',
                        'title' => __('Breadcrumbs in Single Product', 'wolverine'),
                        'subtitle' => __('Enable/Disable Breadcrumbs in Single Product', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'show_single_product_title',
                        'type' => 'button_set',
                        'title' => __('Show Single Title', 'wolverine'),
                        'subtitle' => __('Enable/Disable Single Product Title', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),


                    array(
                        'id'       => 'single_product_title_text_align',
                        'type'     => 'button_set',
                        'title'    => __( 'Single Product Title Text Align', 'wolverine' ),
                        'subtitle' => __( 'Set Single Product Title Text Align', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'left',
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_product_title_parallax',
                        'type'     => 'button_set',
                        'title'    => __( 'Single Product Title Parallax', 'wolverine' ),
                        'subtitle' => __( 'Enable Single Product Title Parallax', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),


                    array(
                        'id'        => 'single_product_title_height',
                        'type'      => 'dimensions',
                        'title'     => __('Single Product Title Height', 'wolverine'),
                        'subtitle'  => __('This must be numeric (no px) or empty.', 'wolverine'),
                        'desc'      => __('You can set a height for the single product title here', 'wolverine'),
                        'required'  => array('show_single_product_title', '=', array('1')),
                        'units' => 'px',
                        'width'    =>  false,
                        'output' => array('.single-product-title-height'),
                        'default'  => array(
                            'Height'  => ''
                        )
                    ),

                    array(
                        'id' => 'single_product_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Single Product Title Background', 'wolverine'),
                        'subtitle' => __('Upload single product title background.', 'wolverine'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        ),
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

	                array(
		                'id' => 'section-single-product-layout-end',
		                'type' => 'section',
		                'indent' => false
	                ),

	                array(
		                'id' => 'section-single-product-related-start',
		                'type' => 'section',
		                'title' => __('Product Related Options', 'wolverine'),
		                'indent' => true
	                ),



	                array(
		                'id' => 'related_product_style',
		                'type' => 'button_set',
		                'title' => __('Related Product Style', 'wolverine'),
		                'desc' => '',
		                'options' => array(
			                'classic-3' => 'Classic',
			                'creative-2' => 'Creative'
		                ),
		                'default' => 'classic-3'
	                ),

	                array(
		                'id'       => 'related_product_count',
		                'type'     => 'text',
		                'title'    => __('Related Product Total Record', 'wolverine'),
		                'subtitle' => __('Total Record Of Related Product.', 'wolverine'),
		                'validate' => 'number',
		                'default'  => '6',
	                ),

	                array(
		                'id' => 'related_product_display_columns',
		                'type' => 'select',
		                'title' => __('Related Product Display Columns', 'wolverine'),
		                'subtitle' => __('Choose the number of columns to display on related product.','wolverine'),
		                'options' => array(
			                '3'		=> '3',
			                '4'		=> '4',
			                '5'		=> '5',
			                '6'		=> '6',
		                ),
		                'desc' => '',
		                'default' => '4'
	                ),

	                array(
		                'id' => 'related_product_condition',
		                'type' => 'checkbox',
		                'title' => __('Related Product Condition', 'wolverine'),
		                'options' => array(
			                'category' => __('Same Category','wolverine'),
			                'tag' => __('Same Tag','wolverine'),
		                ),
		                'default' => array(
			                'category'      => '1',
			                'tag'      => '1',
		                ),
	                ),


	                array(
		                'id' => 'section-single-product-related-end',
		                'type' => 'section',
		                'indent' => false
	                ),



                )
            );



            $this->sections[] = array(
                'title'  => __( 'Custom Post Type', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-screenshot',
                'fields' => array(
                    array(
                        'id' => 'cpt-disable',
                        'type' => 'checkbox',
                        'title' => __('Disable Custom Post Types', 'wolverine'),
                        'subtitle' => __('You can disable the custom post types used within the theme here, by checking the corresponding box. NOTE: If you do not want to disable any, then make sure none of the boxes are checked.', 'wolverine'),
                        'options' => array(
                            'portfolio' => 'Portfolio',
                            'ourteam' => 'Our Team',
                            'countdown' => 'CountDown',
                            'pricingtable' => 'Pricing Table',
                            'food' => 'Food',
                            'gallery' => 'Gallery',
                        ),
                        'default' => array(
                            'portfolio' => '0',
                            'ourteam' => '0',
                            'countdown' => '0',
                            'pricingtable' => '0',
                            'food' => '0',
                            'gallery' => '0'
                        )
                    ),


                )
            );

	        $this->sections[] = array(
		        'title'  => __( 'Portfolio Settings', 'wolverine' ),
		        'desc'   => '',
		        'icon'   => 'el el-th-large',
		        'subsection' => true,
		        'fields' => array(
			        array(
				        'id' => 'home_portfolio_flip_book_url',
				        'type' => 'text',
				        'title' => __('Home page portfolio flip book url', 'wolverine'),
				        'desc' => '',
				        'default' => ''
			        ),

                    array(
                        'id'       => 'portfolio_copyright',
                        'type'     => 'textarea',
                        'title'    => esc_html__( 'Portfolio Copyright', 'wolverine' ),
                        'subtitle' => esc_html__( 'Display copyright below portfolio flip book footer', 'wolverine' ),
                        'default'  => esc_html__('© 2015 Wolverine Template Designed By G5Theme','wolverine')
                    ),

                    array(
                        'id' => 'portfolio_disable_link_detail',
                        'type' => 'button_set',
                        'title' => esc_html__('Disable link to detail', 'wolverine'),
                        'subtitle' => esc_html__('Enable/Disable link to detail in Portfolio', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'breadcrumbs_in_portfolio_title',
                        'type' => 'button_set',
                        'title' => __('Breadcrumbs in Portfolio', 'wolverine'),
                        'subtitle' => __('Enable/Disable Breadcrumbs in Portfolio', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

			        array(
				        'id' => 'show_portfolio_title',
				        'type' => 'button_set',
				        'title' => __('Show Portfolio Title', 'wolverine'),
				        'subtitle' => __('Enable/Disable Portfolio Title', 'wolverine'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),

                    array(
                        'id'       => 'portfolio_title_text_align',
                        'type'     => 'button_set',
                        'title'    => __( 'Portfolio Title Text Align', 'wolverine' ),
                        'subtitle' => __( 'Set Portfolio Title Text Align', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'left',
                        'required'  => array('show_portfolio_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'portfolio_title_parallax',
                        'type'     => 'button_set',
                        'title'    => __( 'Portfolio Title Parallax', 'wolverine' ),
                        'subtitle' => __( 'Enable Portfolio Title Parallax', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_portfolio_title', '=', array('1')),
                    ),




			        array(
				        'id'        => 'portfolio_title_height',
				        'type'      => 'dimensions',
				        'title'     => __('Portfolio Title Height', 'wolverine'),
				        'subtitle'  => __('This must be numeric (no px) or empty.', 'wolverine'),
				        'desc'      => __('You can set a height for the Portfolio title here', 'wolverine'),
				        'units' => 'px',
				        'width'    =>  false,
                        'output' => array('.portfolio-title-height'),
				        'default'  => array(
					        'Height'  => ''
				        ),
                        'required'  => array('show_portfolio_title', '=', array('1')),
			        ),

			        array(
				        'id' => 'portfolio_title_bg_image',
				        'type' => 'media',
				        'url'=> true,
				        'title' => __('Portfolio Title Background', 'wolverine'),
				        'subtitle' => __('Upload portfolio title background.', 'wolverine'),
				        'desc' => '',
				        'default' => array(
					        'url' => $page_title_bg_url
				        ),
                        'required'  => array('show_portfolio_title', '=', array('1')),
			        ),
                    array(
                        'id'       => 'portfolio-single-style-enable',
                        'type'     => 'button_set',
                        'title'    => __( 'Custom Single Layout', 'wolverine' ),
                        'subtitle' => __( 'Enable Custom Single Layout', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '1',

                    ),
			        array(
				        'id' => 'portfolio-single-style',
				        'type' => 'image_select',
				        'title' => __('Single Portfolio Layout', 'wolverine'),
				        'subtitle' => __('Select Single Portfolio Layout', 'wolverine'),
				        'desc' => '',
				        'options' => array(
					        'detail-01' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-detail-01.jpg'),
					        'detail-02' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-detail-02.jpg'),
					        'detail-03' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-detail-03.jpg'),
					        'detail-04' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-detail-04.jpg'),
				        ),
				        'default' => 'detail-01',
                        'required'  => array('portfolio-single-style-enable', '=', array('1')),
			        ),
		        )
	        );


            $this->sections[] = array(
                'title'  => __( 'Archive Portfolio Settings', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-folder-close',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'portfolio_archive_layout',
                        'type' => 'button_set',
                        'title' => __('Layout', 'wolverine'),
                        'subtitle' => __('Select Archive Layout', 'wolverine'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container'
                    ),

                    array(
                        'id' => 'portfolio_archive_sidebar',
                        'type' => 'image_select',
                        'title' => __('Sidebar', 'wolverine'),
                        'subtitle' => __('Set Sidebar Style', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('alt' => 'No sidebar', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('alt' => 'Left sidebar', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('alt' => 'Right sidebar', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-right.png'),
                            'both' => array('alt' => 'Both left and right sidebar', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'none'
                    ),


                    array(
                        'id' => 'portfolio_archive_sidebar_width',
                        'type' => 'button_set',
                        'title' => __('Sidebar Width', 'wolverine'),
                        'subtitle' => __('Set Sidebar width', 'wolverine'),
                        'desc' => '',
                        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
                        'default' => 'small',
                        'required'  => array('portfolio_archive_sidebar', '=', array('left','both','right')),
                    ),

                    array(
                        'id' => 'portfolio_archive_left_sidebar',
                        'type' => 'select',
                        'title' => __('Left Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('portfolio_archive_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'portfolio_archive_right_sidebar',
                        'type' => 'select',
                        'title' => __('Right Sidebar', 'wolverine'),
                        'subtitle' => "Choose the default right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-2',
                        'required'  => array('portfolio_archive_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id' => 'breadcrumbs_in_portfolio_archive',
                        'type' => 'button_set',
                        'title' => __('Breadcrumbs in Portfolio Archive', 'wolverine'),
                        'subtitle' => __('Enable/Disable Breadcrumbs in Portfolio Archive', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'show_portfolio_archive_title',
                        'type' => 'button_set',
                        'title' => __('Show Portfolio Archive Title', 'wolverine'),
                        'subtitle' => __('Enable/Disable Portfolio Title', 'wolverine'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),

                    array(
                        'id'       => 'portfolio_archive_title_text_align',
                        'type'     => 'button_set',
                        'title'    => __( 'Portfolio Archive Title Text Align', 'wolverine' ),
                        'subtitle' => __( 'Set Portfolio Archive Title Text Align', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'left',
                        'required'  => array('show_portfolio_archive_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'portfolio_archive_title_parallax',
                        'type'     => 'button_set',
                        'title'    => __( 'Portfolio Archive Title Parallax', 'wolverine' ),
                        'subtitle' => __( 'Enable Portfolio Archive Title Parallax', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_portfolio_archive_title', '=', array('1')),
                    ),


                    array(
                        'id' => 'portfolio_archive_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => __('Portfolio Archive Title Background', 'wolverine'),
                        'subtitle' => __('Upload portfolio title background.', 'wolverine'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        ),
                        'required'  => array('show_portfolio_archive_title', '=', array('1')),
                    ),
                    array(
                        'id'       => 'portfolio_archive_heading_enable',
                        'type'     => 'button_set',
                        'title'    => __( 'Enable using heading on top item', 'wolverine' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                    ),


                    array(
                        'id' => 'portfolio_archive_heading_style',
                        'type' => 'select',
                        'title' => __('Portfolio Archive Heading Layout', 'wolverine'),
                        'subtitle' => __('Select Portfolio Archive Heading Layout', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'style1' => __('style 1', 'wolverine'),
                            'style2' => __('style 2', 'wolverine'),
                            'style3' => __('style 3', 'wolverine'),
                            'style4'  => __('style 4', 'wolverine'),
                            'style5' => __('style 5', 'wolverine'),
                            'style6' => __('style 6', 'wolverine'),
                            'style7' =>  __('style 7', 'wolverine')),
                        'default' => 'style1',
                        'required'  => array('portfolio_archive_heading_enable', '=', array('1')),
                    ),
                    array(
                        'id'        => 'portfolio_archive_heading_title',
                        'type'      => 'text',
                        'title'     => __('Heading title', 'wolverine'),
                        'subtitle' => __('Add keyword %s into title if want display category name in title', 'wolverine'),
                        'required'  => array('portfolio_archive_heading_enable', '=', array('1'))
                    ),
                    array(
                        'id'        => 'portfolio_archive_heading_sub_title',
                        'type'      => 'text',
                        'title'     => __('Heading sub title', 'wolverine'),
                        'required'  => array('portfolio_archive_heading_style', '=', array('style1', 'style2', 'style7')),
                    ),
                    array(
                        'id'        => 'portfolio_archive_heading_description',
                        'type'      => 'textarea',
                        'title'     => __('Heading description', 'wolverine'),
                        'required'  => array('portfolio_archive_heading_enable', '=', array('1'))
                    ),
                    array(
                        'id' => 'portfolio_archive_heading_text_align',
                        'type' => 'select',
                        'title' => __('Portfolio Archive Heading Align', 'wolverine'),
                        'subtitle' => __('Select Portfolio Archive Heading Align', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'text-left' => __('Left', 'wolverine'),
                            'text-right' => __('Right', 'wolverine'),
                            'text-center' => __('Center', 'wolverine')),
                        'default' => 'text-center',
                        'required'  => array('portfolio_archive_heading_enable', '=', array('1')),
                    ),

                    array(
                        'id' => 'portfolio_archive_item_style',
                        'type' => 'select',
                        'title' => __('Portfolio Archive Item Layout', 'wolverine'),
                        'subtitle' => __('Select Portfolio Archive Item Layout', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            'grid' => __('Grid', 'wolverine') ,
                            'title' => __('Title & category', 'wolverine') ,
                            'one-page' => __('One page', 'wolverine') ,
                            'masonry' =>  __('Masonry Style-01', 'wolverine'),
                            'masonry-style-02' =>  __('Masonry Style-02', 'wolverine'),
                            'masonry-classic' =>  __('Masonry Classic', 'wolverine'),
                            'left-menu' =>  __('Left menu', 'wolverine')),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'portfolio_archive_item_column',
                        'type' => 'select',
                        'title' => __('Portfolio Archive Item Column', 'wolverine'),
                        'subtitle' => __('Select Portfolio Archive Item Column', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            '2' => '2' ,
                            '3' => '3' ,
                            '4' => '4' ,
                            '5' => '5',
                            '6' => '6'),
                        'default' => '4',
                        'required'  => array('portfolio_archive_item_style', '=', array('grid','title')),
                    ),
                    array(
                        'id' => 'portfolio_archive_item_masonry_column',
                        'type' => 'select',
                        'title' => __('Portfolio Archive Item Column', 'wolverine'),
                        'subtitle' => __('Select Portfolio Archive Item Column', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            '3' => '3' ,
                            '4' => '4' ,
                            '5' => '5'),
                        'default' => '4',
                        'required'  => array('portfolio_archive_item_style', '=', array('masonry')),
                    ),
                    array(
                        'id'        => 'portfolio_archive_item_per_page',
                        'type'      => 'text',
                        'title'     => __('Portfolio Archive Iterm Per Page', 'wolverine'),
                        'subtitle'  => __('This must be numeric or empty. Empty for select all', 'wolverine'),
                    ),
                    array(
                        'id' => 'portfolio_archive_padding_item',
                        'type' => 'select',
                        'title' => __('Portfolio Archive Padding Between Items', 'wolverine'),
                        'subtitle' => __('Select Portfolio Archive Padding Between Items', 'wolverine'),
                        'desc' => '',
                        'options' => array(
                            '' => __('No padding', 'wolverine'),
                            'col-padding-10'=> '10 px',
                            'col-padding-15' =>  '15 px',
                            'col-padding-20'  => '20 px',
                            'col-padding-40' =>  '40 px'),
                        'default' => 'col-padding-15'
                    ),
                    array(
                        'id' => 'portfolio_archive_item_image_size',
                        'type' => 'select',
                        'title' => __('Portfolio Archive Item Image Size', 'wolverine'),
                        'subtitle' => __('Select Portfolio Archive Item Image Size', 'wolverine'),
                        'desc' => '',
                        'options' =>array('585x585' => '585x585', '590x393' => '590x393'),
                        'default' => '585x585',
                        'required'  => array('portfolio_archive_item_style', '=', array('grid','title')),
                    ),
                    array(
                        'id' => 'portfolio_archive_overlay',
                        'type' => 'select',
                        'title' => __('Single Portfolio Archive hover style', 'wolverine'),
                        'subtitle' => __('Select Portfolio Archive hover style', 'wolverine'),
                        'desc' => '',
                        'options' => array('icon' => __('Icon', 'wolverine') ,
                            'title' => __('Title', 'wolverine'),
                            'title-category' => __('Title & Category', 'wolverine')  ,
                            'title-category-link' =>  __('Title & Category & Link button', 'wolverine') ,
                            'title-excerpt-link' => __('Title & Excerpt & Link button & Align center', 'wolverine') ,
                            'left-title-excerpt-link' =>  __('Title & Excerpt & Link button & Align left', 'wolverine') ,
                            'title-excerpt-link-no-icon'  => __('Title & Excerpt & Link button & No Icon', 'wolverine') ,
                            'title-excerpt' => __('Title & Excerpt', 'wolverine'),
                        ),
                        'default' => 'title'
                    ),
                    array(
                        'id'        => 'portfolio_archive_css',
                        'type'      => 'text',
                        'title'     => __('Custome css class name', 'wolverine')
                    ),
                )
            );

            $this->sections[] = array(
                'title'  => __( 'Resources Options', 'wolverine' ),
                'desc'   => '',
                'icon'   => 'el el-th-large',
                'fields' => array(
                    array(
                        'id'        => 'cdn_bootstrap_js',
                        'type'      => 'text',
                        'title'     => __('CDN Bootstrap Script', 'wolverine'),
                        'subtitle'  => __('Url CDN Bootstrap Script', 'wolverine'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_bootstrap_css',
                        'type'      => 'text',
                        'title'     => __('CDN Bootstrap Stylesheet', 'wolverine'),
                        'subtitle'  => __('Url CDN Bootstrap Stylesheet', 'wolverine'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_font_awesome',
                        'type'      => 'text',
                        'title'     => __('CDN Font Awesome', 'wolverine'),
                        'subtitle'  => __('Url CDN Font Awesome', 'wolverine'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                )
            );
            $this->sections[] = array(
                'title'  => __( 'Custom CSS & Script', 'wolverine' ),
                'desc'   => __( 'If you change Custom CSS, you must "Save & Generate CSS"', 'wolverine' ),
                'icon'   => 'el el-edit',
                'fields' => array(
                    array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'title' => __('Custom CSS', 'wolverine'),
                        'subtitle' => __('Add some CSS to your theme by adding it to this textarea. Please do not include any style tags.', 'wolverine'),
                        'desc' => '',
                        'default' => '',
                        'options'  => array('minLines'=> 20, 'maxLines' => 60)
                    ),
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'title' => __('Custom JS', 'wolverine'),
                        'subtitle' => __('Add some custom JavaScript to your theme by adding it to this textarea. Please do not include any script tags.', 'wolverine'),
                        'desc' => '',
                        'default' => '',
                        'options'  => array('minLines'=> 20, 'maxLines' => 60)
                    ),

                )
            );
        }

        public function setHelpTabs() {
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'           => 'g5plus_wolverine_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'       => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'    => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'          => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'     => true,
                // Show the sections below the admin menu item or not
                'menu_title'         => __( 'Theme Options', 'wolverine' ),
                'page_title'         => __( 'Theme Options', 'wolverine' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'     => '',
                // Must be defined to add google fonts to the typography module

                'async_typography'   => false,
                // Use a asynchronous font on the front end or font string
                'admin_bar'          => true,
                // Show the panel pages on the admin bar
                'global_variable'    => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'           => false,
                // Show the time the page took to load, etc
                'customizer'         => false,
                // Enable basic customizer support

                // OPTIONAL -> Give you extra features
                'page_priority'      => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'        => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_theme_page#Parameters
                'page_permissions'   => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'          => '',
                // Specify a custom URL to an icon
                'last_tab'           => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'          => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'          => '_options',
                // Page slug used to denote the panel
                'save_defaults'      => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'       => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'       => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'     => 60 * MINUTE_IN_SECONDS,
                'output'             => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'         => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'           => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'        => false,
                // REMOVE

                // HINTS
                'hints'              => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'   => 'light',
                        'shadow'  => true,
                        'rounded' => false,
                        'style'   => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el el-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el el-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el el-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el el-linkedin'
            );


            // Add content after the form.
            $this->args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'wolverine' );
        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_options_config();
}