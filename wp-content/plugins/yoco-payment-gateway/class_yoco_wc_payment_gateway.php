<?php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

require_once 'class_yoco_wc_error_logging.php';

class class_yoco_wc_payment_gateway extends WC_Payment_Gateway {
    const THRIVE_POPUP_SDK_ENDPOINT = 'https://js.yoco.com/sdk/v1/yoco-sdk-web.js';
    const THRIVE_CREATE_CHARGE_ENDPOINT = 'https://online.yoco.com/v1/charges/';
    const WC_API_TOKEN_ENDPOINT = '/?wc-api=charge_yoco_token';
    const WC_API_ADMIN_ENDPOINT = '/?wc-api=plugin_health_check';
    const YOCO_ALLOWED_CURRENCY = 'ZAR';
    const THRIVE_ALLOWED_HTTP_STATUS = [200, 201, 202];
    private $yoco_wc_customer_error_msg;
    private $yoco_logging;
    private $yoco_system_message = '<br><span style="color: #ff0000 !important; font-size: smaller !important;">YOCO_SYSTEM_MESSAGE</span>';


    function __construct() {
        $this->id = 'class_yoco_wc_payment_gateway';
        $this->icon = plugins_url( 'assets/images/yoco/yoco_small.png', __FILE__ );
        $this->method_title = 'Yoco Payment Gateway';
        $this->method_description = 'Pay via Yoco';
        $this->has_fields = false;
        $this->supports = array( 'products' );

        $this->init_form_fields();
        $this->init_settings();


        $this->title = $this->get_option( 'title' );

        $yoco_system_message = class_yoco_wc_error_logging::getYocoSystemMessages();
        if ($yoco_system_message == '') {
            $this->yoco_system_message = '';
        } else {
            $this->yoco_system_message = str_replace('YOCO_SYSTEM_MESSAGE', $yoco_system_message, $this->yoco_system_message);
        }

        $this->description = ($this->yoco_system_message != '') ? $this->get_option( 'description' ). "<br>".$this->yoco_system_message : $this->get_option( 'description' );

        $this->enabled = $this->get_option( 'enabled' );
        $this->testmode = 'test' === $this->get_option( 'mode' );
        $this->private_key = $this->testmode ? $this->get_option( 'test_secret_key' ) : $this->get_option( 'live_secret_key' );
        $this->publishable_key = $this->testmode ? $this->get_option( 'test_public_key' ) : $this->get_option( 'live_public_key' );
        $this->yoco_wc_customer_error_msg = (!empty($this->get_option( 'customer_error_message' ))) ? trim($this->get_option( 'customer_error_message' )) : "Payment Gateway Error";


        $this->perform_plugin_checks();
        $this->yoco_logging = new class_yoco_wc_error_logging($this->enabled, $this->testmode, $this->private_key, $this->publishable_key);
        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );


        /**
         * Pay For Order Receipting Hook
         */
        add_action( 'woocommerce_receipt_' . $this->id, array(
            $this,
            'pay_for_order'
        ) );

        add_action('admin_enqueue_scripts', array( $this,'yoco_admin_load_scripts'));
        add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );


		/**
		 * Ajax Token Store
		 */
		add_action(
			'woocommerce_api_charge_yoco_token',
			array( $this, 'charge_yoco_token' )
		);

        add_action('woocommerce_thankyou', array($this, 'auto_complete_virtual_orders'));



    }


    public function admin_options() {
        if ( $this->is_currency_valid_for_use() ) {
            parent::admin_options();
        } else {
            ?>
            <div class="inline error">
                <p>
                    <strong><?php esc_html_e( 'Gateway disabled', 'woocommerce' ); ?></strong>: <?php _e( 'Currency not supported by by Yoco plugin, you can change the currency of the store <a href="/wp-admin/admin.php?page=wc-settings">here</a>', 'woocommerce' ); ?>
                </p>
            </div>
            <?php
        }
    }
    /**
     * @return array
     *
     * Perform Plugin Health Check
     */
    private function perform_plugin_checks() {
        $health = array('SSL' => false,'KEYS' => false,'CURRENCY' => false);

        if ( empty( $this->private_key ) || empty( $this->publishable_key ) ) {
            $this->enabled = 'no';

        } else {
            $health['KEYS'] = true;
        }

        if ( !$this->testmode && !is_ssl() ) {
            $this->enabled = 'no';
        } else {
            $health['SSL'] = true;
        }


        if (get_woocommerce_currency() !== self::YOCO_ALLOWED_CURRENCY) {
            $this->enabled = 'no';
        } else {
            $health['CURRENCY'] = true;
        }

        return $health;

    }

    /**
     * Yoco Admin Load Scripts
     */

    static function is__payments_admin_page() {
        $tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : '';
        $section = isset($_GET['section']) ? sanitize_text_field($_GET['section']) : '';

        return ($tab === 'checkout' && $section === 'class_yoco_wc_payment_gateway');
    }
    public function yoco_admin_load_scripts() {
        wp_enqueue_style('admin_styles', plugins_url( 'assets/css/admin/admin.css', __FILE__ ) );
        if (class_yoco_wc_payment_gateway::is__payments_admin_page()) {
            wp_enqueue_script('admin_js', plugins_url('assets/js/admin/admin.js', __FILE__));
        }
        wp_localize_script( 'admin_js', 'yoco_params', array(
            'url' => get_site_url().self::WC_API_ADMIN_ENDPOINT,
            'nonce' => wp_create_nonce('nonce_yoco_admin'),
        ) );
    }

    /**
     * Woocommerce Currency Validator
     * @return bool
     */
    public function is_currency_valid_for_use() {
        return in_array(
            get_woocommerce_currency(),
            apply_filters(
                'woocommerce_yoco_supported_currencies',
                array( 'ZAR')
            ),
            true
        );
    }


    /**
     * Woocommerce Init Form Fields
     */
    public function init_form_fields(){

        add_action( 'woocommerce_api_plugin_health_check', array($this,'plugin_health_check'));

        $this->form_fields = array(
            'enabled' => array(
                'title'       => 'Enable/Disable',
                'label'       => 'Enable Yoco Gateway',
                'type'        => 'checkbox',
                'description' => '',
                'default'     => 'no'
            ),
            'title' => array(
                'title'       => 'Title',
                'type'        => 'text',
                'description' => 'This controls the title which the user sees during checkout.',
                'default'     => 'Yoco - debit/credit card',
            ),

            'description' => array(
                'title'       => 'Description',
                'type'        => 'textarea',
                'description' => 'This controls the description which the user sees during checkout.',
                'default'     => 'Pay securely with your card via Yoco',
            ),

            'customer_error_message' => array(
                'title'       => 'Customer Error Message',
                'type'        => 'textarea',
                'description' => 'What the client sees when a payment processing error occurs',
                'default'     => 'Your order could not be processed by Yoco - please try again later',
            ),

            'mode' => array(
                'title'       => 'Mode',
                'label'       => 'Mode',
                'type'        => 'select',
                'description' => 'Test mode allow you to test the plugin without processing money, make sure you set the plugin to live mode and click on "Save changes" for real customers to use it',
                'default'     => 'Test',
                'options' => array(
                    'live' => 'Live',
                    'test' => 'Test'
                )
            ),

            'live_public_key' => array(
              'title'       => 'Live Public Key',
              'type'        => 'password',
              'description' => 'Live Public Key',
            ),
            'live_secret_key' => array(
                'title'       => 'Live Secret Key',
                'type'        => 'password',
                'description' => 'Live Secret Key',
            ),

            'test_public_key' => array(
                'title'       => 'Test Public Key',
                'type'        => 'text',
                'description' => 'Test Public Key',
            ),
            'test_secret_key' => array(
              'title'       => 'Test Secret Key',
              'type'        => 'text',
              'description' => 'Test Secret Key',
          ),

        );

    }

    private function formatOrderTotal($order) {
        return absint( wc_format_decimal( ( $order->get_total() * 100 ), wc_get_price_decimals() ) );
    }

    /**
     * @param         string   $token  Token to charge
     * @param         WC_Order $order  Order being charged against
     * @return mixed
     * Send token to Yoco
     */
    private function sendtoYoco($token, $order) {
        $body = [
            'token' => $token,
            'amountInCents' => $this->formatOrderTotal( $order ),
            'currency' => get_woocommerce_currency()
        ];

        $args = [
            'method'      => 'POST',
            'sslverify'   => true,
            'headers'     => [
                'Authorization' => 'Basic '.base64_encode($this->private_key.':'),
                'Cache-Control' => 'no-cache',
                'Content-Type'  => 'application/json',
            ],
            'body'        => json_encode($body),
        ];
        $request = wp_remote_post( self::THRIVE_CREATE_CHARGE_ENDPOINT, $args );

        if ( is_wp_error( $request ) ) {
            $retries = 0;
            while( $retries < 3 ) {
                sleep( 1 );
                $request = wp_remote_post(
                    self::THRIVE_CREATE_CHARGE_ENDPOINT,
                    $args
                );
                if ( ! is_wp_error( $request ) ) {
                    break;
                }
                $retries++;
            }
        }

        if ( is_wp_error( $request ) || !in_array( wp_remote_retrieve_response_code( $request ), self::THRIVE_ALLOWED_HTTP_STATUS) ) {
            class_yoco_wc_error_logging::logError("CHARGE", wp_remote_retrieve_response_code( $request ), wp_remote_retrieve_response_message($request), $args);
        }

        $response = wp_remote_retrieve_body( $request );
        if (json_decode($response, true) !== null) {
            class_yoco_wc_error_logging::logError("CHARGE", wp_remote_retrieve_response_code( $request ), base64_encode($response), $args);
            return json_decode($response, true);
        }
        return $response;

    }

    /**
     * Woocommerce Payment Scripts
     */
    public function payment_scripts() {
        if ( ! is_wc_endpoint_url( 'order-pay' ) || isset( $_GET['pay_for_order'] ) ) {
          return;
        }

        if ( 'no' === $this->enabled ) {
            return;
        }

        if ( empty( $this->private_key ) || empty( $this->publishable_key ) ) {
            return;
        }

        if ( ! $this->testmode && ! is_ssl() ) {
            return;
        }

        $is_yoco_order = wc_get_order($this->get_order_id_order_pay_yoco())->get_payment_method() === $this->id;
        if ( ! $is_yoco_order ) {
          return;
        }

        $order_id = $this->get_order_id_order_pay_yoco();
        $order = wc_get_order($order_id);
        if ( $order->get_status() !== 'pending' ) {
            return;
        }
        $order_data = $order->get_data();
        $order_description = sprintf(
          __( 'order %s from %s %s (%s)',  'yoco_wc_payment_gateway' ),
          $order_id,
          $order_data['billing']['first_name'],
          $order_data['billing']['last_name'],
          $order_data['billing']['email']
        );

        $yoco_popup_configuration = array(
          'amountInCents' => $this->formatOrderTotal( $order ),
          'currency' => 'ZAR',
          'description' => $order_description,
          'email' => $order_data['billing']['email'],
          'firstName' => $order_data['billing']['first_name'],
          'lastName' => $order_data['billing']['last_name'],
          'metadata' => array(
            'billNote' => $order_description,
            'productType' => "wc_plugin",
            'customerFirstName' => $order_data['billing']['first_name'],
            'customerLastName' => $order_data['billing']['last_name']
          ),
          'name' => get_bloginfo('name'),
        );

        /**
         * Filter the Yoco PopUp Configuration
         * This excludes the JavaScript callbacks
         *
         * @param array    $yoco_popup_configuration Yoco PopUp configuration
         * @param WC_Order $order                    Order being charged against
         */
        $yoco_popup_configuration = apply_filters(
          'wc_yoco_popup_configuration',
          $yoco_popup_configuration,
          $order
        );

        $yoco_params = array(
          'publicKey' => $this->publishable_key,
          'order_id' => $order_id,
          'url' => get_site_url() . self::WC_API_TOKEN_ENDPOINT,
          'nonce' => wp_create_nonce('nonce_charge_yoco_token'),
          'checkout_url' => wc_get_checkout_url(),
          'frontendResourcesError' => __(
            'There was a network error while preparing your payment. Please retry.',
            'yoco_wc_payment_gateway'
          ),
          'frontendResourcesErrorAction' => __(
            'Retry',
            'yoco_wc_payment_gateway'
          ),
          'popUpConfiguration' => $yoco_popup_configuration
        );

        wp_enqueue_script('yoco_js', self::THRIVE_POPUP_SDK_ENDPOINT);
        wp_enqueue_style('customer_styles', plugins_url('assets/css/customer/customer.css', __FILE__), [], '2.0.0');
        wp_register_script('woocommerce_yoco', plugins_url('assets/js/yoco/yoco-sdk-v2.js', __FILE__), array('jquery', 'yoco_js'), '2.0.0', false);
        wp_enqueue_style('orderpay_styles', plugins_url('assets/css/frontend/orderpay.css?v2', __FILE__));
        wp_localize_script('woocommerce_yoco', 'yoco_params', $yoco_params);
        wp_enqueue_script('woocommerce_yoco');
    }

    /**
     * Get Order ID from Order-Pay endpoint
     */
    public function get_order_id_order_pay_yoco() {

        global $wp;
        $order_id = absint( $wp->query_vars['order-pay'] );
        if ( empty( $order_id ) || $order_id == 0 ) {
            return;
        }
        return $order_id;
    }

    /**
     * @param $order
     * Process a successful payment and redirect to order received
     */
    private function process_success($order) {
      global $woocommerce;
      $order->payment_complete();
      $order->add_order_note(
        sprintf(
          __(
            "%s %s was successfully processed through Yoco, you can see this payment in Yoco transaction history (on the Yoco app or on the desktop portal)\n",
            'yoco_wc_payment_gateway'
          ),
          get_woocommerce_currency(),
          $order->get_total()
      ));
      $woocommerce->cart->empty_cart();
      wp_send_json( array(
        'success' => true,
        'redirect' => $order->get_checkout_order_received_url(),
      ));
    }

    /***
     * @param $order
     * @param $message
     *
     * Process a failed payment and redirect to checkout url
     */
    private function process_failure($order, $message) {
        if ( empty( $message ) ) {
          $message = __(
            'Could not connect to Yoco server.',
            'yoco_wc_payment_gateway'
          );
        }
        // Cancel Order
        $order->update_status(
          'cancelled',
          sprintf(
            __( "%s payment cancelled! Transaction ID: %d\n%s\n", 'woocommerce' ),
            get_woocommerce_currency().' '.$order->get_total(),
            $order->get_id(),
            $message
          )
        );
        // Add WC Notice
        wc_add_notice( $this->yoco_wc_customer_error_msg, 'error' );
        $this->set_wc_admin_notice('Yoco Payment Gateway Error [Order# '.$order->get_id().']: '.$message);
        // Redirect to Cart Page
        wp_send_json( array(
          'success' => false,
          'redirect' => wc_get_checkout_url(),
        ));
        exit;
    }

    /**
     * Process a failed payment from Yoco Endpoint and redirect to checkout url
     *
     * @param WC_Order $order           Order being charged against
     * @param string   $error_code      Yoco charge API error code
     * @param string   $error_message   Yoco charge API error message
     * @param string   $display_message Yoco charge API error display message
     */
    private function process_yoco_failure($order, $error_code, $error_message, $display_message) {
        // Cancel Order
        $order->update_status(
          'cancelled',
          sprintf(
            __( "%s payment cancelled! Transaction ID: %d\nError Code: %s\nError Message: %s\n", 'woocommerce' ),
            get_woocommerce_currency().' '.$order->get_total(),
            $order->get_id(),
            $error_code,
            $error_message
          )
        );
        // Add WC Notice
        wc_add_notice( $display_message, 'error' );
        $this->set_wc_admin_notice('Yoco Payment Gateway Error [Order# '.$order->get_id().']: '.$error_message);
        class_yoco_wc_error::save_yoco_customer_order_error($order->get_id(), $error_code, $error_message);
        // Redirect to Cart Page
        wp_send_json( array(
          'success' => false,
          'redirect' => wc_get_checkout_url(),
        ));
    }

    /**
     * @param $order
     * Process a successful test transaction, cancel order and redirect to checkout url
     */
    private function process_test($order) {
        // Cancel Order
        $order->update_status('cancelled', sprintf( __( '%s payment cancelled! Transaction ID: %d', 'woocommerce' ), get_woocommerce_currency().' '.$order->get_total(), $order->get_id()));
        // Add WC Notice
        wc_add_notice( "Yoco Payment Gateway Test Transaction [SUCCESS] - Order Cancelled", 'error' );
        $this->set_wc_admin_notice('Yoco Payment Gateway Test Transaction [SUCCESS] [Order# '.$order->get_id().']: Cancelled');
        // Redirect to Cart Page
        wp_send_json( array(
          'success' => false,
          'redirect' => wc_get_checkout_url(),
        ));
    }

    /**
     * @param $message
     * Displays a Woocommerce Admin Notice to the backend
     */
    private function set_wc_admin_notice($message) {
        $html = __("<h2 class='yoco_pg_admin_notice'>$message</h2>", 'yoco_payment_gateway');
        WC_Admin_Notices::add_custom_notice('yoco_payment_gateway', $html);
    }


    /**
     * @param $order_id
     * @return bool
     *
     * Pay For Yoco Order
     */
    public function pay_for_order( $order_id ) {
        return true;
    }

    public function process_payment( $order_id ) {
        $order = new WC_Order( $order_id );

        return array(
            'result' => 'success',
            'redirect' => $order->get_checkout_payment_url( true )
        );
    }

	/**
	 * Charge a Yoco token
	 *
	 * @param WC_Order $order  Order being charged against
	 * @param string   $token  Yoco token
	 */
	public function attempt_yoco_token_charge($order, $token) {
		$yoco_result = $this->sendtoYoco( $token, $order );
		if ( ! is_array( $yoco_result ) ) {
			$this->process_failure( $order, strval( $yoco_result ) );
			return;
		}

		if ( array_key_exists( 'errorCode', $yoco_result ) ) {
			$this->process_yoco_failure(
				$order,
				$yoco_result['errorCode'],
				$yoco_result['errorMessage'],
				$yoco_result['displayMessage']
			);
			return;
		}

		if ( ! array_key_exists( 'status', $yoco_result ) ) {
			$this->process_failure(
				$order,
				__(
					'No status defined on token charge.',
					'yoco_wc_payment_gateway'
				)
			);
			return;
		}

		if ( $yoco_result['status'] !==  "successful" ) {
			$this->process_failure( $order, $yoco_result['message'] );
			return;
		}

		$this->process_success( $order );
    }

    /**
     * Ajax request handler for charging a Yoco Token
     */
    public function charge_yoco_token() {
        global $woocommerce;
        check_ajax_referer( 'nonce_charge_yoco_token', 'nonce' );
        if ( ! isset( $_POST['token'] ) || ! isset( $_POST['order_id'] ) ) {
            $error_message = __( 'Invalid request', 'yoco_wc_payment_gateway' );
            wp_send_json( array(
              'success' => false,
              'redirect' => wc_get_checkout_url(),
            ));
        }

        $token_id = sanitize_text_field( $_POST['token'] );
        $order_id = intval( $_POST['order_id'] );
        $order = wc_get_order( $order_id );

        if ( $order->is_paid() ) {
            $woocommerce->cart->empty_cart();
            wp_send_json( array(
              'success' => false,
              'redirect' => $order->get_checkout_order_received_url(),
            ));
        }

        $this->attempt_yoco_token_charge( $order, $token_id );
    }

    /**
     * Ajax Admin Plugin Health Check
     */
    public function plugin_health_check() {
        check_ajax_referer( 'nonce_yoco_admin', 'nonce' );
        $health = $this->perform_plugin_checks(true);
        wp_send_json($health);
        wp_die();
    }

    public function auto_complete_virtual_orders($order_id) {
        if (!$order_id) {
            return;
        }
        $order = wc_get_order($order_id);
        if ($order->get_payment_method() === $this->id) {
            $items = $order->get_items();
            if (count($items) < 1) {
                return;
            }

            foreach ($items as $item) {
                if ($item['variation_id'] != '0') {
                    $product = wc_get_product($item['variation_id']);
                } else {
                    $product = new WC_Product($item['product_id']);
                }
                if ($product->is_virtual() === false) {
                    return;
                }
            }
            $order->update_status('completed');
        }
    }
}


