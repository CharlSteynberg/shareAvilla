<?php
/**
 * Plugin Name: Meta Box
 * Plugin URI: https://metabox.io
 * Description: Create custom meta boxes and custom fields in WordPress.
 * Version: 4.11
 * Author: Anh Tran
 * Author URI: http://www.deluxeblogtips.com
 * License: GPL2+
 * Text Domain: meta-box
 * Domain Path: /languages/
 *
 * @package Meta Box
 */

if ( defined( 'ABSPATH' ) && ! defined( 'RWMB_VER' ) ) {
	require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/meta-box/inc/loader.php';
	$loader = new RWMB_Loader;
	$loader->init();
}
