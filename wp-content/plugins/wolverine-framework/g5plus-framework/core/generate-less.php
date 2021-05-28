<?php
function g5plus_generate_less()
{
    try{

	    if (!function_exists('g5plus_custom_css_variable') || !function_exists('g5plus_custom_css')) {
		    return array(
			    'status' => 'error',
			    'message' => esc_html__('Could not save file','wolverine')
		    );
	    }


		global $g5plus_wolverine_options;
	    $g5plus_wolverine_options = get_option('g5plus_wolverine_options');

	    if ( ! defined( 'FS_METHOD' ) ) {
		    define('FS_METHOD', 'direct');
	    }

	    $enable_rtl_mode = g5plus_framework_get_option('enable_rtl_mode','0');

	    if (is_rtl() || $enable_rtl_mode == '1' || isset($_GET['RTL'])) {
		    $enable_rtl_mode = '1';
	    }
	    else {
		    $enable_rtl_mode = '0';
	    }

        $home_preloader = g5plus_framework_get_option('home_preloader');
        $css_variable = g5plus_custom_css_variable();
        $custom_css = g5plus_custom_css();


	    if (!class_exists('Less_Parser')) {
		    require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/less/Less.php';
	    }

        $parser = new Less_Parser(array( 'compress'=>true ));

        $parser->parse($css_variable);
        $parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/style.less' );

        if ($home_preloader != 'none' && !empty($home_preloader)) {
            $parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/loading/'.$home_preloader.'.less' );
        }

        $opt_panel_selector = g5plus_framework_get_option('panel_selector');
        if  ($opt_panel_selector == 1) {
            $parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/panel-style-selector.less' );
        }

	    if ($enable_rtl_mode == '1') {
		    $parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR .'assets/css/less/rtl.less');
	    }

        $parser->parse($custom_css);
        $css = $parser->getCss();

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        WP_Filesystem();
        global $wp_filesystem;

        if (!$wp_filesystem->put_contents( G5PLUS_FRAMEWORK_THEME_DIR.   "style.min.css", $css, FS_CHMOD_FILE)) {
            return array(
                'status' => 'error',
                'message' => esc_html__('Could not save file','wolverine')
            );
        }

        $theme_info = $wp_filesystem->get_contents( G5PLUS_FRAMEWORK_THEME_DIR . "theme-info.txt" );

        $parser = new Less_Parser();
        $parser->parse($css_variable);
        $parser->parseFile(G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/style.less');
        if ($home_preloader != 'none' && !empty($home_preloader)) {
            $parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/loading/'.$home_preloader.'.less' );
        }

        if ( isset($opt_panel_selector) && ($opt_panel_selector == 1)) {
            $parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/panel-style-selector.less' );
        }

	    if ($enable_rtl_mode == '1') {
		    $parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR .'assets/css/less/rtl.less');
	    }


        $parser->parse($custom_css);
        $css = $parser->getCss();

        $css = $theme_info . "\n" . $css;
	    $css = str_replace("\r\n","\n", $css);

        if (!$wp_filesystem->put_contents( G5PLUS_FRAMEWORK_THEME_DIR.   "style.css", $css, FS_CHMOD_FILE)) {
            return array(
                'status' => 'error',
                'message' => esc_html__('Could not save file','wolverine')
            );
        }



	    $parser = new Less_Parser(array( 'compress'=>false ));

	    $parser->parse($css_variable);
	    $parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/editor-style.less' );
	    $css = $parser->getCss();

	    if (!$wp_filesystem->put_contents( G5PLUS_FRAMEWORK_THEME_DIR.   "assets/css/editor-style.css", $css, FS_CHMOD_FILE)) {
		    return array(
			    'status' => 'error',
			    'message' => esc_html__('Could not save file','wolverine')
		    );
	    }



	    $parser = new Less_Parser(array( 'compress'=>false ));

	    $parser->parse($css_variable);
	    $parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/editor-blocks.less' );
	    $css = $parser->getCss();

	    if (!$wp_filesystem->put_contents( G5PLUS_FRAMEWORK_THEME_DIR.   "assets/css/editor-blocks.css", $css, FS_CHMOD_FILE)) {
		    return array(
			    'status' => 'error',
			    'message' => esc_html__('Could not save file','wolverine')
		    );
	    }

        return array(
            'status' => 'success',
            'message' => ''
        );

    }catch(Exception $e){
        $error_message = $e->getMessage();
        return array(
            'status' => 'error',
            'message' => $error_message
        );
    }
}