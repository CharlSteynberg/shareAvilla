<?php
/**
 * Plugin Name:   Quick View for WooCommerce
 * Plugin URI:    https://wordpress.org/plugins/woo-quickview/
 * Description:   Quick View for WooCommerce allows your customers to quickly view product information in nice Popup without opening the product page. Products can easily be added to cart from popup.
 * Version:       1.0.8
 * Author:        ShapedPlugin
 * Author URI:    https://shapedplugin.com/
 * Text Domain:   woo-quick-view
 * Domain Path:   /languages
 * WC requires at least: 4.0
 * WC tested up to: 5.1.0
 *
 * @package Woo_Quick_View
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'activate_woo_quick_view' ) ) {
	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-woo-quick-view-activator.php
	 */
	function activate_woo_quick_view() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-quick-view-activator.php';
		Woo_Quick_View_Activator::activate();
	}
}

register_activation_hook( __FILE__, 'activate_woo_quick_view' );

/**
 * Handles core plugin hooks and action setup.
 *
 * @package Woo_Quick_View
 *
 * @since 1.0
 */
if ( ! class_exists( 'SP_Woo_Quick_View' ) && ! class_exists( 'SP_Woo_Quick_View_Pro' ) ) {
	/**
	 * SP_Woo_Quick_View class
	 */
	class SP_Woo_Quick_View {
		/**
		 * Plugin version
		 *
		 * @var string
		 */
		public $version = '1.0.8';

		/**
		 * Router
		 *
		 * @var SP_WQV_Router $router
		 */
		public $router;

		/**
		 * Shortcode
		 *
		 * @var SP_WQV_Shortcode $shortcode
		 */
		public $shortcode;

		/**
		 * Popup
		 *
		 * @var SP_WQV_Popup $popup
		 */
		public $popup;

		/**
		 * Instance
		 *
		 * @var null
		 * @since 1.0
		 */
		protected static $_instance = null;

		/**
		 * Instance
		 *
		 * @return SP_Woo_Quick_View
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
		public function __construct() {
			// Define constants.
			$this->define_constants();

			// Initialize the action hooks.
			$this->init_actions();

			// Initialize the filter hooks.
			$this->init_filters();

			// Required class file include.
			spl_autoload_register( array( $this, 'autoload' ) );

			// Include required files.
			$this->includes();

			// instantiate classes.
			$this->instantiate();
		}

		/**
		 * Define constants
		 *
		 * @since 1.0
		 */
		public function define_constants() {
			$this->define( 'SP_WQV_VERSION', $this->version );
			$this->define( 'SP_WQV_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'SP_WQV_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'SP_WQV_BASENAME', plugin_basename( __FILE__ ) );
		}

		/**
		 * Define constant if not already set
		 *
		 * @param string      $name
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
			add_action( 'init', array( $this, 'init_button_position' ) );
		}

		/**
		 * Quick view button position
		 */
		public function init_button_position() {
			$wqv_button_position = sp_wqv_get_option( 'wqv_quick_view_button_position' );

			switch ( $wqv_button_position ) {
				case 'before_add_to_cart':
				case 'after_add_to_cart':
					add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'sp_wqv_quick_view_button' ), 15 );
					break;
			}
		}

		/**
		 * Initialize WordPress filter hooks
		 *
		 * @return void
		 */
		public function init_filters() {
			add_filter( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 2 );
		}

		/**
		 * Load TextDomain for plugin.
		 */
		public function load_text_domain() {
			load_textdomain( 'woo-quick-view', WP_LANG_DIR . '/woo-quickview/languages/woo-quick-view-' . apply_filters( 'plugin_locale', get_locale(), 'woo-quick-view' ) . '.mo' );
			load_plugin_textdomain( 'woo-quick-view', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Add plugin action menu
		 *
		 * @param array  $links
		 * @param string $file
		 *
		 * @return array
		 */
		public function add_plugin_action_links( $links, $file ) {

			if ( SP_WQV_BASENAME == $file ) {
				$new_links = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=wqv_settings' ), __( 'Settings', 'woo-quick-view' ) );

				array_unshift( $links, $new_links );

				$links['go_pro'] = sprintf( '<a target="_blank" href="%1$s" style="color: #35b747; font-weight: 700;">Go Premium!</a>', 'https://shapedplugin.com/plugin/woocommerce-quick-view-pro' );
			}

			return $links;
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
				$filename   = SP_WQV_PATH . '/class/' . $class_name . '.php';

				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}

		/**
		 * Instantiate all the required classes
		 *
		 * @since 2.4
		 */
		public function instantiate() {
			$this->popup = SP_WQV_Popup::getInstance();

			do_action( 'sp_wqv_instantiate', $this );
		}

		/**
		 * Page router instantiate
		 *
		 * @since 1.0
		 */
		public function page() {
			$this->router = SP_WQV_Router::instance();

			return $this->router;
		}

		/**
		 * Include the required files
		 *
		 * @return void
		 */
		public function includes() {
			$this->page()->sp_wqv_function();
			$this->page()->sp_wqv_framework();
			$this->router->includes();
		}

		/**
		 * Quick view button
		 *
		 * @param [type] $add_to_cart_url
		 *
		 * @return void
		 */
		public function sp_wqv_quick_view_button( $add_to_cart_url ) {

			global $woocommerce, $product;
			if ( $woocommerce->version >= '3.0' ) {
				$product_id = $product->get_id();
			} else {
				$product_id = $product->id;
			}

			$quick_view_button   = $this->sp_wqv_view_button( $product_id );
			$wqv_button_position = sp_wqv_get_option( 'wqv_quick_view_button_position' );
			if ( 'before_add_to_cart' == $wqv_button_position || 'above_add_to_cart' == $wqv_button_position ) {
				$buttons_url = $quick_view_button . $add_to_cart_url;
			} else {
				$buttons_url = $add_to_cart_url . $quick_view_button;
			}

			return $buttons_url;
		}

		/**
		 * Quick view button content
		 *
		 * @param [type] $product_id
		 * @return void
		 */
		public function sp_wqv_view_button( $product_id = null ) {
			if ( ! $product_id ) {
				global $woocommerce, $product;
				if ( $woocommerce->version >= '3.0' ) {
					$product_id = $product->get_id();
				} else {
					$product_id = $product->id;
				}
			}

			$close_button           = sp_wqv_get_option( 'wqv_popup_close_button' );
			$quick_view_button_text = sp_wqv_get_option( 'wqv_quick_view_button_text' );
			$wqv_button_position    = sp_wqv_get_option( 'wqv_quick_view_button_position' );

			$outline = '';
			if ( $product_id ) {
				$outline .= '<a href="#" id="sp-wqv-view-button" class="button sp-wqv-view-button ' . $wqv_button_position . '" data-id="' . esc_attr( $product_id ) . '" data-effect="' . sp_wqv_get_option( 'wqv_popup_effect' ) . '" data-wqv=\'{"close_button": "' . $close_button . '" } \'>' . $quick_view_button_text . '</a>';
			}
			return $outline;
		}

	}

	/**
	 * Returns the main instance.
	 *
	 * @since 1.0
	 *
	 * @return SP_Woo_Quick_View
	 */
	function sp_woo_quick_view() {
		return SP_Woo_Quick_View::instance();
	}

	/**
	 * SP_woo_quick_view instance.
	 */
	sp_woo_quick_view();

}
