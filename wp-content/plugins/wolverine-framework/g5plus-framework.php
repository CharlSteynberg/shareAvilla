<?php
/**
 *
 *    Plugin Name: Wolverine Framework
 *    Plugin URI: http://g5plus.net
 *    Description: The Wolverine Framework plugin.
 *    Version: 1.4
 *    Author: g5plus
 *    Author URI: http://g5plus.net
 *
 *    Text Domain: g5plus-wolverine
 *    Domain Path: /languages/
 *
 * @package G5Plus Framework
 * @category Core
 * @author g5plus
 *
 **/
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!class_exists('g5plusFrameWork')) {
	class g5plusFrameWork
	{

		protected $loader;

		protected $prefix;

		protected $version;


		public function __construct()
		{
			$this->version = '1.4';
			$this->prefix = 'wolverine-framework';
			$this->define_constants();
			$this->includes();
			$this->define_hook();
		}


		private function  define_constants()
		{
			if (!defined('PLUGIN_G5PLUS_FRAMEWORK_DIR')) {
				define('PLUGIN_G5PLUS_FRAMEWORK_DIR', plugin_dir_path(__FILE__));
			}
			if (!defined('PLUGIN_G5PLUS_FRAMEWORK_NAME')) {
				define('PLUGIN_G5PLUS_FRAMEWORK_NAME', 'wolverine-framework');
			}
			if (!defined('G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY')) {
				define('G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY', esc_html__('Wolverine Shortcodes', 'wolverine'));
			}

			if (!defined('PLUGIN_G5PLUS_FRAMEWORK_URL')) {
				define( 'PLUGIN_G5PLUS_FRAMEWORK_URL', trailingslashit( plugins_url(basename( __DIR__ )) ) );
			}

			if (!defined('G5PLUS_FRAMEWORK_THEME_DIR')) {
				define('G5PLUS_FRAMEWORK_THEME_DIR', trailingslashit(get_template_directory()) );
			}
			if (!defined('G5PLUS_FRAMEWORK_THEME_URL')) {
				define('G5PLUS_FRAMEWORK_THEME_URL', trailingslashit(get_template_directory_uri()));
			}
		}

		private function includes()
		{


			if (!class_exists( 'ReduxFramework' )) {
				include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/options/framework.php' ;
				include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/option-extensions/loader.php';
			}

			/*core*/
			include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/g5plus-framework.php';


			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/class-g5plus-framework-loader.php';
			if (!class_exists('WPAlchemy_MetaBox')) {
				include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/MetaBox.php');
			}
			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'admin/class-g5plus-framework-admin.php';
			$this->loader = new g5plusFramework_Loader();

			/*short-codes*/
			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/vc-functions.php';
			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/shortcodes.php';

			/* widgets */
			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/widgets/widgets.php';

			/* tax meta */
			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/tax-meta.php';

		}

		private function define_hook()
		{
			/*admin*/
			$plugin_admin = new g5plusFramework_Admin($this->get_prefix(), $this->get_version());

			$pages = isset($_GET['page']) ? $_GET['page'] : '';
			if ($pages !== '_options') {
				$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
				$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
			}

			$this->loader->add_action('admin_enqueue_scripts',$plugin_admin,'dequeue_assets',100);
		}

		public function get_version()
		{
			return $this->version;
		}

		public function get_prefix()
		{
			return $this->prefix;
		}

		public function run()
		{
			$this->loader->run();
		}
	}

	if (!function_exists('init_g5plus_framework')) {
		function init_g5plus_framework()
		{
			$g5plusFramework = new g5plusFrameWork();
			$g5plusFramework->run();
		}

		init_g5plus_framework();
	}
}
