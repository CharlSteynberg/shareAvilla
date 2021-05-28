<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
/**
 *
 * Framework admin enqueue style and scripts
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'sp_wqv_admin_enqueue_scripts' ) ) {
	function sp_wqv_admin_enqueue_scripts() {
		$screen        = get_current_screen();
		if ( $screen->id == 'toplevel_page_wqv_settings' ) {

			// admin utilities.
			wp_enqueue_media();

			// wp core styles.
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
			wp_enqueue_style( 'jquery-ui-slider' );

			// framework core styles.
			wp_enqueue_style( 'sp-wqv-framework', SP_WQV_URL . 'admin/views/framework/assets/css/sp-framework.css', array(), SP_WQV_VERSION, 'all' );
			wp_enqueue_style( 'sp-wqv-custom', SP_WQV_URL . 'admin/views/framework/assets/css/sp-custom.css', array(), SP_WQV_VERSION, 'all' );
			wp_enqueue_style( 'sp-wqv-style', SP_WQV_URL . 'admin/views/framework/assets/css/sp-style.css', array(), SP_WQV_VERSION, 'all' );
			wp_enqueue_style( 'sp-wqv-font-awesome', SP_WQV_URL . 'public/assets/css/font-awesome.min.css', array(), SP_WQV_VERSION, 'all' );
			wp_enqueue_style( 'sp-wqv-flaticon', SP_WQV_URL . 'public/assets/css/flaticon.css', array(), SP_WQV_VERSION, 'all' );

			if ( is_rtl() ) {
				wp_enqueue_style( 'sp-framework-rtl', SP_WQV_URL . 'admin/views/framework/assets/css/sp-framework-rtl.css', array(), SP_WQV_VERSION, 'all' );
			}

			// wp core scripts.
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'jquery-ui-dialog' );
			wp_enqueue_script( 'jquery-ui-slider' );

			// framework core scripts.
			wp_enqueue_script( 'sp-wqv-dependency', SP_WQV_URL . 'admin/views/framework/assets/js/dependency.js', array( 'jquery' ), SP_WQV_VERSION, true );
			wp_enqueue_script( 'sp-wqv-plugins', SP_WQV_URL . 'admin/views/framework/assets/js/sp-plugins.js', array(), SP_WQV_VERSION, true );
			wp_enqueue_script( 'sp-wqv-framework', SP_WQV_URL . 'admin/views/framework/assets/js/sp-framework.js', array( 'sp-wqv-plugins' ), SP_WQV_VERSION, true );
		}

	}

	add_action( 'admin_enqueue_scripts', 'sp_wqv_admin_enqueue_scripts' );
}
