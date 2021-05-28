<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://shapedplugin.com/
 * @since      1.1.0
 *
 * @package    Woo_Category_Slider
 * @subpackage Woo_Category_Slider/public
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class Woo_Category_Slider_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The style and script suffix.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $suffix    The style and script suffix of this plugin.
	 */
	private $suffix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 * @param string $suffix The style and script suffix of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->suffix      = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Category_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Category_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$wcsp_options = get_option( 'sp_wcsp_settings', true );
		// CSS Files.
		if ( $wcsp_options['wcsp_swiper_css'] ) {
			wp_register_style( 'sp-wcs-swiper', SP_WCS_URL . 'public/css/swiper' . $this->suffix . '.css', array(), $this->version, 'all' );
		}
		if ( $wcsp_options['wcsp_fa_css'] ) {
			wp_register_style( 'sp-wcs-font-awesome', SP_WCS_URL . 'public/css/font-awesome.min.css', array(), $this->version, 'all' );
		}
		wp_register_style( $this->plugin_name, SP_WCS_URL . 'public/css/woo-category-slider-public' . $this->suffix . '.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Category_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Category_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$wcsp_options = get_option( 'sp_wcsp_settings', true );

		if ( $wcsp_options['wcsp_swiper_js'] ) {
			wp_register_script( 'sp-wcs-swiper-js', SP_WCS_URL . 'public/js/swiper' . $this->suffix . '.js', array( 'jquery' ), $this->version, true );
		}
		wp_register_script( 'sp-wcs-swiper-config', SP_WCS_URL . 'public/js/swiper-config' . $this->suffix . '.js', array( 'jquery' ), $this->version, true );
		wp_register_script( 'sp-wcs-preloader', SP_WCS_URL . 'public/js/preloader' . $this->suffix . '.js', array( 'jquery' ), $this->version, true );

	}

}
