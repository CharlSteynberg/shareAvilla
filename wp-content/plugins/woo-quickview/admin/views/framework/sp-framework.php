<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * ------------------------------------------------------------------------------------------------
 * Text Domains: sp-framework
 * ------------------------------------------------------------------------------------------------
 *
 */

// ------------------------------------------------------------------------------------------------
require_once plugin_dir_path( __FILE__ ) . '/sp-framework-path.php';
// ------------------------------------------------------------------------------------------------

if ( ! function_exists( 'sp_wqv_framework_init' ) && ! class_exists( 'SP_WQV_Framework' ) ) {
	function sp_wqv_framework_init() {

		// active modules.
		defined( 'SP_WQV_F_ACTIVE_FRAMEWORK' ) || define( 'SP_WQV_F_ACTIVE_FRAMEWORK', true );

		// helpers.
		sp_wqv_locate_template( 'functions/fallback.php' );
		sp_wqv_locate_template( 'functions/helpers.php' );
		sp_wqv_locate_template( 'functions/actions.php' );
		sp_wqv_locate_template( 'functions/enqueue.php' );
		sp_wqv_locate_template( 'functions/sanitize.php' );
		sp_wqv_locate_template( 'functions/validate.php' );

		// classes.
		sp_wqv_locate_template( 'classes/abstract.class.php' );
		sp_wqv_locate_template( 'classes/options.class.php' );
		sp_wqv_locate_template( 'classes/framework.class.php' );

		// configs.
		sp_wqv_locate_template( 'config/framework.config.php' );

	}
	add_action( 'init', 'sp_wqv_framework_init', 10 );
}
