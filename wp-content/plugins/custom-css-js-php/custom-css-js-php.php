<?php
/**
 * WP_CustomCode_Pro class file.
 * @package Core
 * @author Flipper Code <hello@flippercode.com>
 * @version 2.0.7
 */

/*
Plugin Name: Custom css-js-php
Plugin URI: http://www.flippercode.com/
Description:  Write custom code for php, html, javascript or css and insert in to your theme using shortcode, actions or filters.
Author: flippercode
Author URI: http://www.flippercode.com/
Version: 2.0.7
Text Domain: custom-css-js-php
Domain Path: /lang/
*/
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

if( !class_exists( 'FC_Plugin_Base_Lite' ) ) {
	
   $pluginClass =  plugin_dir_path( __FILE__ ). '/core/class.plugin-lite.php';
   if( file_exists( $pluginClass ) )
   include( $pluginClass );
}

if ( ! class_exists( 'WP_CustomCode_Pro' ) and class_exists( 'FC_Plugin_Base_Lite' ) ) {

	/**
	 * Main plugin class
	 * @author Flipper Code <hello@flippercode.com>
	 * @package Core
	 */
	class WP_CustomCode_Pro extends FC_Plugin_Base_Lite
	{
		/**
		 * List of Modules.
		 * @var array
		 */
		private $modules = array();

		/**
		 * Intialize variables, files and call actions.
		 * @var array
		 */
		public function __construct() {

			error_reporting( E_ERROR | E_PARSE );
			parent::__construct( $this->_plugin_definition() );
			$this->register_hooks();
		}

		function register_hooks(){
			add_action( 'wp_ajax_wcjp_ajax_call',array( $this, 'wcjp_ajax_call' ) );
			add_action( 'wp_ajax_nopriv_wcjp_ajax_call', array( $this, 'wcjp_ajax_call' ) );
			add_action( 'wp_head', array( $this, 'wce_inline_code_header_footer' ), 500 );
			add_action( 'wp_footer', array( $this, 'wce_inline_code_header_footer' ), 500 );
			add_shortcode( 'wce_code', array( $this, 'wce_editor_inline_code' ) );
			add_filter('fc_manage_search_query',array($this,'custom_css_search_query'),10);
			
		}
		
		function custom_css_search_query($query){
			
			global $wpdb;
			$page = $_GET['page'];
			if(!empty($_POST['s'])){
				
				if($page == 'wcjp_managecss_code'){
				   $query = "SELECT * FROM  ".$wpdb->prefix."wce_editor_content WHERE  data_type = 'css' AND ( data_title LIKE '%".$_POST['s']."%' OR data_cond LIKE  '%".$_POST['s']."%'  OR  status LIKE  '%".$_POST['s']."%' ) LIMIT 0 , 30";
			    }else if($page == 'wcjp_managejs_code'){
					$query = "SELECT * FROM  ".$wpdb->prefix."wce_editor_content WHERE  data_type = 'js' AND ( data_title LIKE '%".$_POST['s']."%' OR data_cond LIKE  '%".$_POST['s']."%'  OR  status LIKE  '%".$_POST['s']."%' ) LIMIT 0 , 30";
				}else if($page == 'wcjp_managephp_code'){
					$query = "SELECT * FROM  ".$wpdb->prefix."wce_editor_content WHERE  data_type = 'php' AND ( data_title LIKE '%".$_POST['s']."%' OR data_cond LIKE  '%".$_POST['s']."%'  OR  status LIKE  '%".$_POST['s']."%' ) LIMIT 0 , 30";
				}
			}
			return $query;
		}
		/**
		 * Call PHP Script.
		 * @param  string $script_source PHP Source Code.
		 */
		public function wce_call_php_script( $script_source ) {

			if ( strpos( $script_source, 'php' ) > 0 ) {
				echo  eval( "?>{$script_source}" );
			} else { 		echo  eval( "{$script_source}" ); }

		}
		/**
		 * Get function name used in the source code.
		 * @param  string $script_source source code.
		 * @return string                function name.
		 */
		public function get_function_name( $script_source ) {

			$func_name = array();

			preg_match_all( '/function[\s\n]+(\S+)[\s\n]*\(/', $script_source, $matches );

			if ( $matches[1] ) {
				$func_name = $matches[1]; }

			return $func_name;

		}

		function _plugin_definition() { 
			
		  $this->pluginPrefix = 'wcjp';	
		  $pluginClasses = array('wcjp-form.php','wcjp-controller.php','wcjp-model.php' );
		  $pluginModules = array( 'overview','code','shortcode'); 
		  $pluginCssFilesFrontEnd = array( 'wcjp-frontend.css' );
		  $pluginCssFilesBackendEnd = array('select2.css','wcjp-backend.css'); 
		  $pluginJsFilesFrontEnd = array('wcjp-frontend.js'); 
		  $pluginJsFilesBackEnd = array('wcjp-backend.js','select2.js');
		  $pluginData = array('childFileRefrence' => __FILE__,
							  'childClassRefrence' => __CLASS__,
							  'pluginPrefix' => $this->pluginPrefix,
							  'pluginDirectory' => plugin_dir_path( __FILE__ ),
							  'pluginTextDomain' => 'custom-css-js-php',
							  'pluginURL' =>  plugin_dir_url( __FILE__ ),
							  'dboptions' => '_wsl_store_locator_settings',
							  'controller' => 'WCJP_Controller',
							  'model' => 'WCJP_Model',
							  'pluginLabel' => 'Custom css-js-php',
							  'pluginClasses' =>  $pluginClasses,
							  'pluginmodules' => $pluginModules,
							  'pluginmodulesprefix' => 'WCJP_Model_',
							  'pluginCssFilesFrontEnd' => $pluginCssFilesFrontEnd,
							  'pluginCssFilesBackEnd' => $pluginCssFilesBackendEnd,
							  'pluginJsFilesFrontEnd' => $pluginJsFilesFrontEnd,
							  'pluginJsFilesBackEnd' => $pluginJsFilesBackEnd,
							  'loadCustomizer' => false);
							  
			return $pluginData;
		}
		/**
		 * Call actions or filter according to backend settings.
		 */
		public function wce_run_filter_action_hooks() {

			global $wpdb;

			if ( defined( 'DISABLE_WCE' ) ) {
				return; }

			$action_filters = $wpdb->get_results( 'SELECT * FROM '.WCJP_TBL_CODES." WHERE data_cond IN( 'filter', 'action') AND status = 1" );

			if ( empty( $action_filters ) ) {
				return; }

			foreach ( $action_filters as $hook ) {

				$wp_func_name = '';

				if ( empty( $hook->data_source ) ) {
					continue; }

				if ( empty( $hook->tag_name ) ) {
					continue; }

				if ( $hook->data_cond == 'filter' ) {

					$wp_func_name = 'add_filter'; } else if ( $hook->data_cond == 'action' ) {

					$wp_func_name = 'add_action';
					} else { continue; }

					$functions = $this->get_function_name( $hook->data_source );

					if ( empty( $functions ) ) {
						continue; }

					$this->wce_call_php_script( $hook->data_source );

					foreach ( $functions as $func_name ) {

						if ( function_exists( $func_name ) ) {

							if ( $hook->accept_args > 1 ) {

								$wp_func_name( $hook->tag_name, $func_name , 10 , $hook->accept_args ); } else {
								$wp_func_name( $hook->tag_name, $func_name ); }
						}
					}
			}

		}
		/**
		 * Print CSS or JS code in wp_head or wp_footer.
		 * @param  array $atts Arguments.
		 */
		public function wce_editor_inline_code($atts) {
			global $wpdb;

			if ( defined( 'DISABLE_WCE' ) ) {
				return false;
			}
			$id = $atts['id'];

			if ( ! $id ) {
				return false; }

			$row = $wpdb->get_row( 'SELECT * FROM '.WCJP_TBL_CODES.' WHERE id='. $id.' AND status = 1' );

			if ( empty( $row->data_source ) ) {
				return false; }

			$script_source = trim( $row->data_source );
			ob_start();

			switch ( $row->data_type ) {

				case 'css'  :

					echo <<<EOT
<style type="text/css">
{$script_source}
</style>
EOT;
			break;

				case 'js'  :

					$script_source = htmlspecialchars_decode( $script_source );

					echo <<<EOT
<script type="text/javascript">
{$script_source}
</script>
EOT;

			break;

				case 'php' :

					eval( "?>{$script_source}" );

			break;

			}

			return ob_get_clean();

		}
		/**
		 * Call required wp_head or wp_footer function.
		 */
		public function wce_inline_code_header_footer() {

			global $wpdb;

			$filter_by = '';

			if ( current_filter() == 'wp_head' ) {

				$filter_by = 'header'; }

			if ( current_filter() == 'wp_footer' ) {

				$filter_by = 'footer'; }

			if ( empty( $filter_by ) ) {

				return; }

			$scripts_source = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.WCJP_TBL_CODES.' WHERE data_cond= %s', $filter_by ) );

			if ( ! $scripts_source ) {
				return;
			}

			foreach ( $scripts_source as $source ) {
				echo do_shortcode( '[wce_code id="'.$source->id.'"]' );
			}

		}
		/**
		 * Ajax Call
		 */
		function wcjp_ajax_call() {

			check_ajax_referer( 'wcjp-call-nonce', 'nonce' );
			$operation = sanitize_text_field( wp_unslash( $_POST['operation'] ) );
			$value = wp_unslash( $_POST );
			$selected = wp_unslash( $_POST['selected_value'] );
			if ( 'wcjp_load_template' == $operation ) {
				$obj = new FlipperCode_Layout();
				echo json_encode( $obj->wcjp_load_template( $value ) );
			} else if ( 'get_next_posts' == $operation ) {
				$obj = new FlipperCode_Layout();
				echo $obj->wcjp_load_posts( $value );
			} else if ( isset( $operation ) ) {
				$this->$operation($value,$selected);
			}
			exit;
		}
	

		/**
		 * Eneque scripts at frontend.
		 */
		function frontend_script_localisation() {

			$get_data = get_option( 'blogpost_settings' );
			$wcjp_js_lang = array();
			$wcjp_js_lang['ajax_url'] = admin_url( 'admin-ajax.php' );
			$wcjp_js_lang['nonce'] = wp_create_nonce( 'wcjp-call-nonce' );
			$wcjp_js_lang['confirm'] = __( 'Are you sure to delete item?',WCJP_TEXT_DOMAIN );
			wp_localize_script( 'wcjp-frontend', 'settings_obj', $wcjp_js_lang );
		}

		

		/**
		 * Create backend navigation.
		 */
		function define_admin_menu() {

			$pagehook1 = add_menu_page(
				__( 'CSS-JS-PHP', WCJP_TEXT_DOMAIN ),
				__( 'CSS-JS-PHP', WCJP_TEXT_DOMAIN ),
				'wcjp_admin_overview',
				WCJP_SLUG,
				array( $this,'processor' ),
				WCJP_IMAGES.'fc-small-logo.png'
			);

			return $pagehook1;
		}

		/**
		 * Eneque scripts in the backend.
		 */
		function backend_script_localisation() {

			$get_data = get_option( 'blogpost_settings' );
			$wcjp_js_lang = array();
			$wcjp_js_lang['ajax_url'] = admin_url( 'admin-ajax.php' );
			$wcjp_js_lang['nonce'] = wp_create_nonce( 'wcjp-call-nonce' );
			$wcjp_js_lang['confirm'] = __( 'Are you sure to delete item?',WCJP_TEXT_DOMAIN );
			wp_localize_script( 'wcjp-backend', 'settings_obj', $wcjp_js_lang );

		}

		/**
		 * Define all constants.
		 */
		function _define_constants() {

			global $wpdb;

			if ( ! defined( 'WCJP_SLUG' ) ) {
				define( 'WCJP_SLUG', 'wcjp_view_overview' );
			}

			if ( ! defined( 'WCJP_VERSION' ) ) {
				define( 'WCJP_VERSION', '2.0.6' );
			}

			if ( ! defined( 'WCJP_TEXT_DOMAIN' ) ) {
				define( 'WCJP_TEXT_DOMAIN', 'custom-css-js-php' );
			}

			if ( ! defined( 'WCJP_FOLDER' ) ) {
				define( 'WCJP_FOLDER', basename( dirname( __FILE__ ) ) );
			}

			if ( ! defined( 'WCJP_DIR' ) ) {
				define( 'WCJP_DIR', plugin_dir_path( __FILE__ ) );
			}

			if ( ! defined( 'WCJP_CORE_CLASSES' ) ) {
				define( 'WCJP_CORE_CLASSES', WCJP_DIR.'core/' );
			}
			
			if ( ! defined( 'WCJP_PLUGIN_CLASSES' ) ) {
				define( 'WCJP_PLUGIN_CLASSES', WCJP_DIR.'classes/' );
			}

			if ( ! defined( 'WCJP_CONTROLLER' ) ) {
				define( 'WCJP_CONTROLLER', WCJP_CORE_CLASSES );
			}

			if ( ! defined( 'WCJP_CORE_CONTROLLER_CLASS' ) ) {
				define( 'WCJP_CORE_CONTROLLER_CLASS', WCJP_CORE_CLASSES.'class.controller.php' );
			}

			if ( ! defined( 'WCJP_MODEL' ) ) {
				define( 'WCJP_MODEL', WCJP_DIR.'modules/' );
			}

			if ( ! defined( 'WCJP_URL' ) ) {
				define( 'WCJP_URL', plugin_dir_url( WCJP_FOLDER ).WCJP_FOLDER.'/' );
			}

			if ( ! defined( 'FC_CORE_URL' ) ) {
				define( 'FC_CORE_URL', plugin_dir_url( WCJP_FOLDER ).WCJP_FOLDER.'/core/' );
			}

			if ( ! defined( 'WCJP_INC_URL' ) ) {
				define( 'WCJP_INC_URL', WCJP_URL.'includes/' );
			}

			if ( ! defined( 'WCJP_CSS' ) ) {
				define( 'WCJP_CSS', WCJP_URL.'/assets/css/' );
			}

			if ( ! defined( 'WCJP_JS' ) ) {
				define( 'WCJP_JS', WCJP_URL.'/assets/js/' );
			}

			if ( ! defined( 'WCJP_IMAGES' ) ) {
				define( 'WCJP_IMAGES', WCJP_URL.'/assets/images/' );
			}

			if ( ! defined( 'WCJP_FONTS' ) ) {
				define( 'WCJP_FONTS', WCJP_URL.'fonts/' );
			}

			if ( ! defined( 'WCJP_TBL_CODES' ) ) {
				define( 'WCJP_TBL_CODES', $wpdb->prefix.'wce_editor_content' );
			}

		}

	}
}

new WP_CustomCode_Pro();
