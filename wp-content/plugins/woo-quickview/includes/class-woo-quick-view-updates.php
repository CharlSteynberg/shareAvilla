<?php
/**
 * Fired during plugin updates.
 *
 * This class defines all code necessary to run during the plugin's updates.
 *
 * @since      1.0.7
 * @package    Woo_Quick_View
 * @subpackage Woo_Quick_View/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Woo Quick View updates class.
 */
class Woo_Quick_View_Updates {

	/**
	 * DB updates that need to be run
	 *
	 * @var array
	 */
	private static $updates = [
		'1.0.7' => 'updates/update-1.0.7.php',
	];

	/**
	 * Binding all events
	 *
	 * @since 1.0.7
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'do_updates' ) );
	}

	/**
	 * Check if need any update
	 *
	 * @since 1.0.7
	 *
	 * @return boolean
	 */
	public function is_needs_update() {
        $installed_version = get_option( 'woo_quick_view_version' );
        $first_version = get_option( 'woo_quick_view_first_version' );
		$activation_date = get_option( 'woo_quick_view_activation_date' );

		if ( false === $installed_version ) {
			update_option( 'woo_quick_view_version', '1.0.7' );
			update_option( 'woo_quick_view_db_version', '1.0.7' );
        }
        if ( false === $first_version ) {
			update_option( 'woo_quick_view_first_version', SP_WQV_VERSION );
		}
		if ( false === $activation_date ) {
			update_option( 'woo_quick_view_activation_date', current_time( 'timestamp' ) );
		}

		if ( version_compare( $installed_version, SP_WQV_VERSION, '<' ) ) {
			return true;
		}

		return false;
	}



	/**
	 * Do updates.
	 *
	 * @since 1.0.7
	 *
	 * @return void
	 */
	public function do_updates() {
		$this->perform_updates();
	}

	/**
	 * Perform all updates
	 *
	 * @since 1.0.7
	 *
	 * @return void
	 */
	public function perform_updates() {
		if ( ! $this->is_needs_update() ) {
			return;
		}

		$installed_version = get_option( 'woo_quick_view_version' );

		foreach ( self::$updates as $version => $path ) {
			if ( version_compare( $installed_version, $version, '<' ) ) {
				include $path;
				update_option( 'woo_quick_view_version', $version );
			}
		}

		update_option( 'woo_quick_view_version', SP_WQV_VERSION );

	}

}
new Woo_Quick_View_Updates();
