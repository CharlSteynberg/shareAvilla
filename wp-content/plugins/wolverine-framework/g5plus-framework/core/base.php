<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if (!function_exists('g5plus_framework_get_option')) {
	function g5plus_framework_get_option($key,$default = '') {
		global $g5plus_wolverine_options;
		return (isset($g5plus_wolverine_options) && isset($g5plus_wolverine_options[$key])) ? $g5plus_wolverine_options[$key] : $default;
	}
}


if (!function_exists('g5plus_install_demo_data_generate_less')) {
	function g5plus_install_demo_data_generate_less() {
		require_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/core/generate-less.php' );
		$gen_css = g5plus_generate_less();
		if ($gen_css['status'] == 'error') {
			ob_end_clean();

			$data_response = array(
				'code' => 'done',
				'message' => $gen_css['message']
			);
			echo json_encode($data_response);
			die();
		}
	}
	add_action('g5plus_install_demo_data_done','g5plus_install_demo_data_generate_less');
}

if (!function_exists('g5plus_redux_generate_less')) {
	function g5plus_redux_generate_less() {
		// Save & Generate LESS to CSS
		require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/core/generate-less.php';
		$gen_css = g5plus_generate_less();
		if ($gen_css['status'] == 'error') {
			$error = array( 'status' => $gen_css['message'] );
			ob_clean();
			echo json_encode( $error );
		}
	}
	add_action('redux/generate_less_to_css','g5plus_redux_generate_less');
}

/*---------------------------------------------------
/* CUSTOM HEADER CSS
/*---------------------------------------------------*/
if (!function_exists('g5plus_framework_custom_header_css')) {
	function g5plus_framework_custom_header_css() {
		if (!function_exists('g5plus_custom_css_variable')) {
			return;
		}

		$page_id = '0';
		if (isset($_REQUEST['current_page_id'])) {
			$page_id = $_REQUEST['current_page_id'];
		}

		$css_variable = g5plus_custom_css_variable($page_id);

		if (!class_exists('Less_Parser')) {
			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/less/Less.php';
		}

		$parser = new Less_Parser(array( 'compress'=>true ));

		$parser->parse($css_variable, G5PLUS_FRAMEWORK_THEME_URL);

		$enable_rtl_mode = g5plus_framework_get_option('enable_rtl_mode','0');

		if (is_rtl() || $enable_rtl_mode == '1' || isset($_GET['RTL'])) {
			$parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/header-customize-rtl.less', G5PLUS_FRAMEWORK_THEME_URL );
			$parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/footer-customize.less', G5PLUS_FRAMEWORK_THEME_URL );
		}
		else {
			$parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/header-customize.less', G5PLUS_FRAMEWORK_THEME_URL );
			$parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/footer-customize.less', G5PLUS_FRAMEWORK_THEME_URL );
		}

		$css = $parser->getCss();
		header("Content-type: text/css; charset: UTF-8");
		echo sprintf('%s', $css);
	}
	add_action('custom-page/header-custom-css', 'g5plus_framework_custom_header_css');
}

/*---------------------------------------------------
/* Panel Selector
/*---------------------------------------------------*/
if (!function_exists('g5plus_framework_panel_selector_change_color_callback')) {
	function g5plus_panel_selector_change_color_callback() {
		if (function_exists('g5plus_custom_css_variable')) {
			if (!class_exists('Less_Parser')) {
				require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/less/Less.php';
			}
			$content_file = g5plus_custom_css_variable();
			$primary_color = $_REQUEST['primary_color'];
			$content_file  .= '@primary_color:' . $primary_color . ';';
			$file_full_variable = G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/variable.less';
			$file_color = G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/color.less';

			$parser = new Less_Parser(array( 'compress'=>true ));
			$parser->parse($content_file);
			$parser->parseFile($file_full_variable);
			$parser->parseFile($file_color);
			$css = $parser->getCss();
			echo  $css;
		}
		die();
	}
	add_action( 'wp_ajax_nopriv_custom_css_selector', 'g5plus_framework_panel_selector_change_color_callback' );
	add_action( 'wp_ajax_custom_css_selector', 'g5plus_framework_panel_selector_change_color_callback' );
}


add_action( 'admin_bar_menu', 'xmenu_add_toolbar_items', 100 );
function xmenu_get_toolbar_icon($icon_name) {
	return '<i class="fa fa-'. esc_attr($icon_name) . '"></i>';
}
function xmenu_add_toolbar_items($admin_bar) {
	if( !current_user_can( 'manage_options' ) ) return;

	$admin_bar->add_node( array(
		'id'    => 'xmenutoolbar',
		'title' => '<span class="ab-icon"></span><span>' . __('XMEMU','wolverine') . '</span>',
		'href'  => admin_url( 'themes.php?page=xmenu-settings' ),
		'meta'  => array(
			'title' => __( 'XMenu' , 'wolverine' ),
		),
	));

	$admin_bar->add_node( array(
		'id'    => 'xmenu_settings',
		'parent' => 'xmenutoolbar',
		'title' => __( 'XMENU Settings' , 'wolverine' ),
		'href'  => admin_url( 'themes.php?page=xmenu-settings' )
	));

	$admin_bar->add_node( array(
		'id'    => 'xmenu_menu_edit',
		'parent' => 'xmenutoolbar',
		'title' => __( 'Edit Menus' , 'wolverine' ),
		'href'  => admin_url( 'nav-menus.php' )
	));
	$menus = wp_get_nav_menus( array('orderby' => 'name') );
	foreach( $menus as $menu ){
		$admin_bar->add_node( array(
			'id'    	=> 'xmenu_menu_edit_'.$menu->slug,
			'parent' 	=> 'xmenu_menu_edit',
			'title' 	=> $menu->name,
			'href'  	=> admin_url( 'nav-menus.php?action=edit&menu='.$menu->term_id ),
			'meta'  	=> array(
				'title' => __('Configure' , 'wolverine' ) . ' '. $menu->name,
				'target' => '_blank',
				'class' => ''
			),
		));
	}

	$admin_bar->add_node( array(
		'id'    => 'xmenu_menu_assign',
		'parent' => 'xmenutoolbar',
		'title' => __( 'Assign Menus' , 'wolverine' ),
		'href'  => admin_url( 'nav-menus.php?action=locations' )
	));
}


function g5plus_framework_xmenu_generate_css_file($option_key,$settings) {

	try {
		$regex = array(
			"`^([\t\s]+)`ism"                       => '',
			"`^\/\*(.+?)\*\/`ism"                   => "",
			"`([\n\A;]+)\/\*(.+?)\*\/`ism"          => "$1",
			"`([\n\A;\s]+)//(.+?)[\n\r]`ism"        => "$1\n",
			"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism" => "\n"
		);
		$css = '';
		$responsive_breakpoint = 991;
		/*if (isset($settings['setting-responsive-breakpoint']) && !empty($settings['setting-responsive-breakpoint']) && is_numeric($settings['setting-responsive-breakpoint'])) {
			$responsive_breakpoint = $settings['setting-responsive-breakpoint'];
		}*/

		$animation_duration = '.5s';
		if (isset($settings['transition-duration']) && !empty($settings['transition-duration'])) {
			$animation_duration = $settings['transition-duration'];
		}

		$css .= '@x_nav_menu_slug:' . (empty($option_key) ? '' : 'x-nav-menu' . $option_key) . ';';
		$css .= '@x_nav_menu_dot:'. (empty($option_key) ? '': '.') .';';
		$css .= '@responsive_breakpoint:'. $responsive_breakpoint . 'px;';
		$css .= '@animation_duration:' . $animation_duration . ';';

		require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/less/Less.php';
		WP_Filesystem();
		global $wp_filesystem;
		$options = array( 'compress'=>true );
		$parser = new Less_Parser($options);
		$parser->parse($css);
		$parser->parseFile(XMENU_DIR . 'assets/css/style.less');
		$css = $parser->getCss();
		$css   = preg_replace( array_keys( $regex ), $regex, $css );
		$wp_filesystem->put_contents( XMENU_DIR .   'assets/css/style' . $option_key . '.css', $css, FS_CHMOD_FILE);
	}
	catch (Exception $e) {
		?>
		<div class="error">
			<?php echo esc_html__('Caught exception:','wolverine') . esc_html($e->getMessage()) ?>
		</div>
		<?php
	}
}
add_action('xmenu_setting_save','g5plus_framework_xmenu_generate_css_file',10,2);


/*================================================
MAINTENANCE MODE
================================================== */
if (!function_exists('g5plus_maintenance_mode')) {
	function g5plus_maintenance_mode() {

		if (current_user_can( 'edit_themes' ) || is_user_logged_in()) {
			return;
		}

		$enable_maintenance = g5plus_framework_get_option('enable_maintenance','0');

		switch ($enable_maintenance) {
			case 1 :
				wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'wolverine' ) . '</p>', get_bloginfo( 'name' ) );
				break;
			case 2:
				$maintenance_mode_page = g5plus_framework_get_option('maintenance_mode_page');
				if (empty($maintenance_mode_page)) {
					wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'wolverine' ) . '</p>', get_bloginfo( 'name' ) );
				} else {
					$maintenance_mode_page_url = get_permalink($maintenance_mode_page);
					$current_page_url = g5plus_framework_current_page_url();
					if ($maintenance_mode_page_url != $current_page_url) {
						wp_redirect($maintenance_mode_page_url);
					}
				}
				break;
		}
	}
	add_action( 'get_header', 'g5plus_maintenance_mode' );
}

/*================================================
GET CURRENT PAGE URL
================================================== */
if (!function_exists('g5plus_framework_current_page_url')) {
	function g5plus_framework_current_page_url() {
		$pageURL = 'http';
		if ( isset( $_SERVER["HTTPS"] ) ) {
			if ( $_SERVER["HTTPS"] == "on" ) {
				$pageURL .= "s";
			}
		}
		$pageURL .= "://";
		if ( $_SERVER["SERVER_PORT"] != "80" ) {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}
}