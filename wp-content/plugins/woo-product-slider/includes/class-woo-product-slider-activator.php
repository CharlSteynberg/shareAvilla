<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      2.2.0
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

/**
 * Product slider activator class.
 */
class Woo_Product_Slider_Activator {

	/**
	 * Activator
	 *
	 * @since    2.2.0
	 */
	public static function activate() {

		// Deactivate pro version.
		deactivate_plugins( 'woo-product-slider-pro/woo-product-slider-pro.php' );
	}

}
