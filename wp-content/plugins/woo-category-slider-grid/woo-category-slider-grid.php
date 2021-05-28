<?php
/**
 * @link              https://shapedplugin.com/
 * @since             1.0.0
 * @package           Woo_Category_Slider
 *
 * Plugin Name:       Category Slider for WooCommerce
 * Plugin URI:        https://shapedplugin.com/plugin/woocommerce-category-slider-pro/
 * Description:       Category Slider for WooCommerce helps you display WooCommerce Categories aesthetically in a nice sliding manner. You can manage and show your product categories with thumbnail, child category (beside), description, shop now button with an easy to use shortcode generator interface with many handy options.
 * Version:           1.2.9
 * Author:            ShapedPlugin
 * Author URI:        https://shapedplugin.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-category-slider
 * Domain Path:       /languages
 * Requires at least: 5.0
 * Requires PHP: 5.6
 * WC requires at least: 4.5
 * WC tested up to: 5.1.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woo_Category_Slider
 * @subpackage Woo_Category_Slider/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class Woo_Category_Slider {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woo_Category_Slider_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name = 'woo-category-slider-grid';

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version = '1.2.9';

	/**
	 * Holds class object
	 *
	 * @var object
	 *
	 * @since 1.0.0
	 */
	private static $instance;

	/**
	 * Initialize the Woo_Category_Slider() class
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Woo_Category_Slider ) ) {
			self::$instance = new Woo_Category_Slider();
			self::$instance->setup();
		}
		return self::$instance;
	}

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function setup() {

		$this->define_constants();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Define plugin constants.
	 *
	 * @since 1.0
	 */
	public function define_constants() {
		$this->define( 'SP_WCS_VERSION', $this->version );
		$this->define( 'SP_WCS_PLUGIN_NAME', $this->plugin_name );
		$this->define( 'SP_WCS_PATH', plugin_dir_path( __FILE__ ) );
		$this->define( 'SP_WCS_URL', plugin_dir_url( __FILE__ ) );
		$this->define( 'SP_WCS_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'SP_WCS_INCLUDES', SP_WCS_PATH . '/includes' );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param  string      $name Constant name.
	 * @param  string|bool $value Constant Value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}


	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woo_Category_Slider_Loader. Orchestrates the hooks of the plugin.
	 * - Woo_Category_Slider_i18n. Defines internationalization functionality.
	 * - Woo_Category_Slider_Admin. Defines all hooks for the admin area.
	 * - Woo_Category_Slider_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once SP_WCS_INCLUDES . '/class-woo-category-slider-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once SP_WCS_INCLUDES . '/class-woo-category-slider-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once SP_WCS_PATH . 'admin/class-woo-category-slider-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once SP_WCS_PATH . 'public/class-woo-category-slider-public.php';

		require_once SP_WCS_INCLUDES . '/class-woo-category-slider-updates.php';
		require_once SP_WCS_INCLUDES . '/class-woo-category-slider-post-types.php';
		require_once SP_WCS_INCLUDES . '/class-woo-category-slider-shortcode.php';
		require_once SP_WCS_INCLUDES . '/class-woo-category-slider-premium.php';
		require_once SP_WCS_INCLUDES . '/class-woo-category-slider-help.php';
		require_once SP_WCS_INCLUDES . '/class-woo-category-slider-widget.php';
		require_once SP_WCS_INCLUDES . '/class-woo-category-slider-mcebutton.php';
		require_once SP_WCS_PATH . 'admin/partials/wcsp-framework/classes/setup.class.php';
		require_once SP_WCS_PATH . 'admin/partials/notices/review.php';

		$this->loader = new Woo_Category_Slider_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woo_Category_Slider_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woo_Category_Slider_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin   = new Woo_Category_Slider_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_cpt     = new Woo_Category_Slider_Post_Type( $this->get_plugin_name(), $this->get_version() );
		$plugin_premium = new Woo_Category_Slider_Premium( $this->get_plugin_name(), $this->get_version() );
		$plugin_help    = new Woo_Category_Slider_Help( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_cpt, 'register_post_type' );
		$this->loader->add_action( 'admin_menu', $plugin_premium, 'premium_page', 100 );
		$this->loader->add_action( 'admin_menu', $plugin_help, 'help_page', 100 );
		$this->loader->add_action( 'manage_sp_wcslider_posts_custom_column', $plugin_admin, 'add_shortcode_form', 10, 2 );
		$this->loader->add_filter( 'manage_sp_wcslider_posts_columns', $plugin_admin, 'add_shortcode_column' );
		$this->loader->add_filter( 'plugin_action_links', $plugin_admin, 'add_plugin_action_links', 10, 2 );
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'plugin_row_meta', 10, 2 );
		$this->loader->add_filter( 'post_updated_messages', $plugin_admin, 'post_update_message' );
		$this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'admin_footer', 1, 2 );

		// Redirect after active.
		$this->loader->add_action( 'activated_plugin', $plugin_admin, 'redirect_to' );

		// WooCommerce plugin is not installed notice.
		if ( empty( get_option( 'sp-wcsp-woo-notice-dismissed' ) ) ) {
			$this->loader->add_action( 'admin_notices', $plugin_admin, 'admin_notice' );
		}
		$this->loader->add_action( 'wp_ajax_dismiss_woo_notice', $plugin_admin, 'dismiss_woo_notice' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public    = new Woo_Category_Slider_Public( $this->get_plugin_name(), $this->get_version() );
		$plugin_shortcode = new Woo_Category_Slider_Shortcode( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Woo_Category_Slider_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_category_slider() {

	$plugin = Woo_Category_Slider::init();
	$plugin->run();

}

require_once ABSPATH . 'wp-admin/includes/plugin.php';
if ( ! ( is_plugin_active( 'woo-category-slider-pro/woo-category-slider-pro.php' ) || is_plugin_active_for_network( 'woo-category-slider-pro/woo-category-slider-pro.php' ) ) ) {
	run_woo_category_slider();

	require_once plugin_dir_path( __FILE__ ) . 'deprecated/woo-category-slider.php';
}
