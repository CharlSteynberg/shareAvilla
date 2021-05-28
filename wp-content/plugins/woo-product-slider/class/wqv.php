<?php

class SP_WPS_WQV {

	/**
	 * @var
	 */
	private static $_instance;

	/**
	 * @return SP_WPS_WQV
	 */
	public static function getInstance() {
		if ( ! self::$_instance ) {
			self::$_instance = new SP_WPS_WQV();
		}

		return self::$_instance;
	}

	/**
	 * SP_WPS_WQV constructor.
	 */
	public function __construct() {
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	}

	public function install_plugin( $url ) {
		if ( strstr( $url, '.zip' ) != false ) {
			$download_link = $url;
		} else {
			$slug          = explode( '/', $url );
			$slug          = $slug[ count( $slug ) - 2 ];
			$api           = plugins_api(
				'plugin_information', array(
					'slug'   => $slug,
					'fields' => array( 'sections' => 'false' ),
				)
			);
			$download_link = $api->download_link;
		}

		$upgrader = new Plugin_Upgrader();

		if ( ! $upgrader->install( $download_link ) ) {
			return 0;
		}

		$plugin_to_activate = $upgrader->plugin_info();
		$this->activate_wqv_plugin( $plugin_to_activate );

		return 1;
	}

	public function activate_wqv_plugin( $plugin_to_activate ) {
		$activate = activate_plugin( $plugin_to_activate );
		wp_cache_flush();

		$this->show_activation_notice();
	}

	public function show_activation_notice() {
		echo '<div class="updated notice is-dismissible"><p>';
		echo __( 'Plugin <strong>activated.</strong>', 'woo-product-slider' );
		echo '</p></div>';
	}

}
