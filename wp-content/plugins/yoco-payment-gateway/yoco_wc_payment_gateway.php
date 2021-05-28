<?php
/*
 * Plugin Name: Yoco Payment Gateway
 * Plugin URI: https://wordpress.org/plugins/yoco-payment-gateway/
 * Description: Take debit and credit card payments on your store.
 * Author: Yoco
 * Author URI: https://www.yoco.com
 * Version: 1.48
 * WC requires at least: 3.0
 * WC tested up to: 4.7
 */

define('YOCO_PLUGIN_VERSION', '1.48');

load_plugin_textdomain( 'yoco_wc_payment_gateway', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );
add_action('admin_init', function () {
    if (!is_plugin_active('woocommerce/woocommerce.php')) {
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_script('requirements_js', plugins_url('assets/js/admin/requirements.js', __FILE__));
            return;
        });
    }
});
add_action('plugins_loaded', 'wc_yoco_gateway_init', 0);
/**
 * Initialize the gateway.
 *
 * @since 1.0.0
 */
function wc_yoco_gateway_init() {
    if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;

    require_once 'class_yoco_wc_payment_gateway.php';
    require_once 'class_yoco_wc_error.php';
    add_filter('woocommerce_payment_gateways', 'woocommerce_yoco_add_gateway' );
}
/**
 * Add the gateway to WooCommerce
 *
 * @since 1.0.0
 */
function woocommerce_yoco_add_gateway( $methods ) {
    $methods[] = 'class_yoco_wc_payment_gateway';
    return $methods;
}

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'yoco_thrive_add_plugin_page_settings_link');
function yoco_thrive_add_plugin_page_settings_link( $links ) {
    $links[] = '<a href="' .
        admin_url( 'admin.php?page=wc-settings&tab=checkout&section=class_yoco_wc_payment_gateway' ) .
        '">' . __('Settings') . '</a>';
    return $links;
}
