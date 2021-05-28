<?php
if (!function_exists('g5plus_register_sidebar')) {
    function g5plus_register_sidebar() {
        register_sidebar( array(
            'name'          => __("Sidebar 1",'wolverine'),
            'id'            => 'sidebar-1',
            'description'   => __("Widget Area 1",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );
        register_sidebar( array(
            'name'          => __("Sidebar 2",'wolverine'),
            'id'            => 'sidebar-2',
            'description'   => __("Widget Area 2",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Top Drawer",'wolverine'),
            'id'            => 'top_drawer_sidebar',
            'description'   => __("Top Drawer",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ));
	    register_sidebar( array(
		    'name'          => __("Top Bar Left",'wolverine'),
		    'id'            => 'top_bar_left',
		    'description'   => __("Top Bar Left",'wolverine'),
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widget-title"><span>',
		    'after_title'   => '</span></h4>',
	    ) );

	    register_sidebar( array(
		    'name'          => __("Top Bar Right",'wolverine'),
		    'id'            => 'top_bar_right',
		    'description'   => __("Top Bar Right",'wolverine'),
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widget-title"><span>',
		    'after_title'   => '</span></h4>',
	    ) );

        register_sidebar( array(
            'name'          => __("Footer 1",'wolverine'),
            'id'            => 'footer-1',
            'description'   => __("Footer 1",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Footer 2",'wolverine'),
            'id'            => 'footer-2',
            'description'   => __("Footer 2",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Footer 3",'wolverine'),
            'id'            => 'footer-3',
            'description'   => __("Footer 3",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Footer 4",'wolverine'),
            'id'            => 'footer-4',
            'description'   => __("Footer 4",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Bottom Bar Left",'wolverine'),
            'id'            => 'bottom_bar_left',
            'description'   => __("Bottom Bar Left",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Bottom Bar Right",'wolverine'),
            'id'            => 'bottom_bar_right',
            'description'   => __("Bottom Bar Right",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );


        register_sidebar( array(
            'name'          => __("Woocommerce",'wolverine'),
            'id'            => 'woocommerce',
            'description'   => __("Woocommerce",'wolverine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        $theme_mods = get_theme_mods();
        if(is_array($theme_mods) && array_key_exists('redux-widget-areas', $theme_mods)){
            $sidebar = $theme_mods['redux-widget-areas'];
            foreach ($sidebar as $name){
                register_sidebar( array(
                    'name'          => $name,
                    'id'            => str_replace(' ','',strtolower ($name)),
                    'description'   =>  $name,
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h4 class="widget-title"><span>',
                    'after_title'   => '</span></h4>',
                ) );
            }
        }



    }
    add_action( 'widgets_init', 'g5plus_register_sidebar' );
}

if (!function_exists('g5plus_redux_custom_widget_area_filter')) {
    function g5plus_redux_custom_widget_area_filter($arg) {
        return array(
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>'
        );
    }
    add_filter('redux_custom_widget_args','g5plus_redux_custom_widget_area_filter');
}

