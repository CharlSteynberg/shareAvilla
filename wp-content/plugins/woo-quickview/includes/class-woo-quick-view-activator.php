<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.5
 * @package    Woo_Quick_View
 * @subpackage Woo_Quick_View/includes
 */
class Woo_Quick_View_Activator {
	/**
	 * When plugin activate work activate function.
	 *
	 * @since      1.0.5
	 */
	public static function activate() {

		deactivate_plugins( 'woo-quick-view-pro/woo-quick-view-pro.php' );
	}

}
