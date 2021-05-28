<?php
if ( ! defined( 'ABSPATH' ) ) die( '-1' );
if(!class_exists('g5plusFramework_Shortcode_Countdown')){
    class g5plusFramework_Shortcode_Countdown {
        function __construct() {
            add_action( 'init', array($this, 'register_post_types' ), 6 );
            add_shortcode('wolverine_countdown_shortcode', array($this, 'wolverine_countdown_shortcode' ));
            add_filter( 'rwmb_meta_boxes', array($this,'wolverine_register_meta_boxes' ));
        }

        function register_post_types() {
            if ( post_type_exists('countdown') ) {
                return;
            }
            register_post_type('countdown',
                array(
                    'label' => __('Countdown','wolverine'),
                    'description' => __( 'Countdown Description', 'wolverine' ),
                    'labels' => array(
                        'name'					=>'Countdown',
                        'singular_name' 		=> 'Countdown',
                        'menu_name'    			=> __( 'Countdown', 'wolverine' ),
                        'parent_item_colon'  	=> __( 'Parent Item:', 'wolverine' ),
                        'all_items'          	=> __( 'All Countdown', 'wolverine' ),
                        'view_item'          	=> __( 'View Item', 'wolverine' ),
                        'add_new_item'       	=> __( 'Add New Countdown', 'wolverine' ),
                        'add_new'            	=> __( 'Add New', 'wolverine' ),
                        'edit_item'          	=> __( 'Edit Item', 'wolverine' ),
                        'update_item'        	=> __( 'Update Item', 'wolverine' ),
                        'search_items'       	=> __( 'Search Item', 'wolverine' ),
                        'not_found'          	=> __( 'Not found', 'wolverine' ),
                        'not_found_in_trash' 	=> __( 'Not found in Trash', 'wolverine' ),
                    ),
                    'supports'    => array( 'title', 'editor', 'comments', 'thumbnail'),
                    'public'      => true,
                    'menu_icon' => 'dashicons-clock',
                    'has_archive' => true
                )
            );
        }

        function wolverine_countdown_shortcode($atts){
            $type = $css = '';
            extract( shortcode_atts( array(
                'type'     => '',
                'css'      => ''
            ), $atts ) );

            $plugin_path =  untrailingslashit( plugin_dir_path( __FILE__ ) );
            $template_path = $plugin_path . '/templates/'.$type.'.php';
            ob_start();
            include($template_path);
            $ret = ob_get_contents();
            ob_end_clean();
            return $ret;
        }

        function wolverine_register_meta_boxes($meta_boxes){
            $meta_boxes[] = array(
                'title'  => __( 'Countdown Option', 'wolverine' ),
                'id'     => 'wolverine-meta-box-countdown-opening',
                'pages'  => array( 'countdown' ),
                'fields' => array(
                    array(
                        'name' => __( 'Opening hours', 'wolverine' ),
                        'id'   => 'countdown-opening',
                        'type' => 'datetime',
                    ),
                     array(
                         'name' => __( 'Type', 'wolverine' ),
                         'id'   => 'countdown-type',
                         'type' => 'select',
                         'options'  => array(
                             'comming-soon' => __('Coming Soon','wolverine'),
                             'under-construction' => __('Under Construction','wolverine')
                         )
                     ),
                    array(
                        'name' => __( 'Url redirect (after countdown completed)', 'wolverine' ),
                        'id'   => 'countdown-url',
                        'type' => 'textarea',
                    )
                )
            );
            return $meta_boxes;
        }
    }
    new g5plusFramework_Shortcode_Countdown();
}