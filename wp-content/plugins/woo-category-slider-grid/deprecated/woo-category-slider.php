<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles core plugin hooks and action setup.
 *
 * @package woo-category-slider
 *
 * @since 1.0
 */
if ( ! class_exists( 'WPL_Woo_Category_Slider' ) ) {
	class WPL_Woo_Category_Slider {
		/**
		 * Plugin version
		 *
		 * @var string
		 */
		public $version = '1.1.3';

		/**
		 * @var WPL_WCS_Shortcode $shortcode
		 */
		public $shortcode;

		/**
		 * @var WPL_WCS_Router $router
		 */
		public $router;

		/**
		 * @var null
		 * @since 1.0
		 */
		protected static $_instance = null;

		/**
		 * @return WPL_Woo_Category_Slider
		 * @since 1.0
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Constructor.
		 */
		function __construct() {
			// Define constants.
			$this->define_constants();

			// Initialize the action hooks.
			$this->init_actions();

			// Required class file include.
			spl_autoload_register( array( $this, 'autoload' ) );

			// Include required files.
			$this->includes();

		}

		/**
		 * Define constants
		 *
		 * @since 1.0
		 */
		public function define_constants() {
			$this->define( 'WPL_WCS_VERSION', $this->version );
			$this->define( 'WPL_WCS_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'WPL_WCS_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'WPL_WCS_BASENAME', plugin_basename( __FILE__ ) );
		}

		/**
		 * Define constant if not already set
		 *
		 * @param string $name
		 * @param string|bool $value
		 */
		public function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Initialize WordPress action hooks
		 *
		 * @return void
		 */
		public function init_actions() {
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
		}

		/**
		 * Load TextDomain for plugin.
		 *
		 */
		public function load_text_domain() {
			load_textdomain( 'woo-category-slider', WP_LANG_DIR . '/woo-category-slider-grid/languages/woo-category-slider-' . apply_filters( 'plugin_locale', get_locale(), 'woo-category-slider' ) . '.mo' );
			load_plugin_textdomain( 'woo-category-slider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Autoload class files on demand
		 *
		 * @param string $class requested class name
		 */
		public function autoload( $class ) {
			$name = explode( '_', $class );
			if ( isset( $name[2] ) ) {
				$class_name = strtolower( $name[2] );
				$filename   = WPL_WCS_PATH . '/class/' . $class_name . '.php';

				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}

		/**
		 * Page router instantiate
		 *
		 * @since 1.0
		 */
		public function page() {
			$this->router = WPL_WCS_Router::instance();

			return $this->router;
		}

		/**
		 * Include the required files
		 *
		 * @return void
		 */
		public function includes() {
			$this->page()->wpl_wcs_function();
			$this->router->includes();
		}

	}
}

/**
 * Returns the main instance.
 *
 * @since 1.0
 *
 * @return WPL_Woo_Category_Slider
 */
function wpl_woo_category_slider() {
	return WPL_Woo_Category_Slider::instance();
}


/**
 * Wpl_woo_category_slider instance.
 */
wpl_woo_category_slider();
