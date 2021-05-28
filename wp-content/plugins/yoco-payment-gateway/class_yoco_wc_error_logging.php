<?php


class class_yoco_wc_error_logging
{
    const YOCO_ERROR_API_ENDPOINT = 'https://yoco.api.semantica.co.za';
    private $enabled;
    private $mode;
    private $has_keys = true;
    private $merchant_name;
    private $merchant_url;
    private $php_version;
    private $php_memory;
    private $wp_version;
    private $wc_version;


    function __construct($enabled, $mode, $sk, $pk)
    {
        $this->enabled = ($enabled === 'yes') ? true : false;
        $this->mode = ($mode === true) ? "Test" : "Live";
        if ($sk === '' || $pk === '') {
            $this->has_keys = false;
        }
        $this->merchant_name = get_bloginfo('name');
        $this->merchant_url = get_bloginfo('url');
        $this->php_version = phpversion();
        $this->php_memory = ini_get('memory_limit');
        $this->wc_version = WC_VERSION;
        $this->wp_version = get_bloginfo( 'version' );
        $this->saveMerchantDetails();
        $this->updateMerchantDetails();
    }

    public function sendNewMerchantDetails() {
        $body = [
            'name' => $this->merchant_name,
            'url' => $this->merchant_url,
            'plugin_enabled' => $this->enabled,
            'mode' => $this->mode,
            'has_keys' => $this->has_keys,
            'php_version' => $this->php_version,
            'php_memory' => $this->php_memory,
            'wc_version' => $this->wc_version,
            'wp_version' => $this->wp_version,
            'plugin_version' => YOCO_PLUGIN_VERSION
        ];

        $args = [
            'method'      => 'POST',
            'sslverify'   => true,
            'headers'     => [
                'Cache-Control' => 'no-cache',
                'Content-Type'  => 'application/json',
            ],
            'body'        => json_encode($body),
        ];
        $uri = self::YOCO_ERROR_API_ENDPOINT.'/merchant/new';
        $request = wp_remote_post( $uri, $args );
        $response = wp_remote_retrieve_body( $request );
        $response = json_decode($response, true);
        return $response;
    }

    public function sendUpdateMerchantDetails($token, $yoco_merchant_details) {
        $body = [
            'client_id' => $yoco_merchant_details['client_id'],
            'client_secret' => $yoco_merchant_details['client_secret'],
            'name' => $this->merchant_name,
            'url' => $this->merchant_url,
            'plugin_enabled' => $this->enabled,
            'mode' => $this->mode,
            'has_keys' => $this->has_keys,
            'php_version' => $this->php_version,
            'php_memory' => $this->php_memory,
            'wc_version' => $this->wc_version,
            'wp_version' => $this->wp_version,
            'plugin_version' => YOCO_PLUGIN_VERSION
        ];
        $authorization = 'Bearer ' . $token;
        $args = [
            'method' => 'POST',
            'sslverify' => true,
            'headers' => [
                'Authorization' => $authorization,
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($body),
        ];

        $uri = self::YOCO_ERROR_API_ENDPOINT . '/merchant/update';
        $response = wp_remote_post($uri, $args);
        return $response;
    }

    private function setNewMerchantDetails($response) {
        $merchant_data = [];
        if (is_array($response) && array_key_exists('client_id', $response) && !empty($response['client_id'])) {
            $merchant_data['client_id'] = $response['client_id'];
        }
        if (is_array($response) && array_key_exists('client_secret', $response) && !empty($response['client_secret'])) {
            $merchant_data['client_secret'] = $response['client_secret'];
        }
        if (is_array($response) && array_key_exists('client_auth', $response)&& !empty($response['client_auth'])) {
            $merchant_data['authorization'] = $response['client_auth'];
        }
        return $merchant_data;
    }

    public function saveMerchantDetails() {
        if (!get_option('yoco_merchant_details')) {
            $merchant_data = $this->setNewMerchantDetails($this->sendNewMerchantDetails());
            if (is_array($merchant_data) && array_key_exists('client_id', $merchant_data) && array_key_exists('client_secret', $merchant_data) && array_key_exists('authorization', $merchant_data)) {
                $merchant_data['last_updated'] = strtotime(date('Y-m-d H:i:s'));
                add_option('yoco_merchant_details', $merchant_data);
            }
        }
    }

    public function validateStoredMerchantDetails($yoco_merchant_details) {
        if (is_array($yoco_merchant_details) &&
            array_key_exists('client_id', $yoco_merchant_details) &&
            !empty($yoco_merchant_details['client_id']) &&
            strlen($yoco_merchant_details['client_id']) == 32 &&
            array_key_exists('client_secret', $yoco_merchant_details) &&
            !empty($yoco_merchant_details['client_secret']) &&
            strlen($yoco_merchant_details['client_secret']) == 32 &&
            array_key_exists('authorization', $yoco_merchant_details) &&
            !empty($yoco_merchant_details['authorization']) &&
            strlen($yoco_merchant_details['authorization']) == 32
        ) {
            return true;
        }
        return false;
    }

    private function canUpdate($yoco_merchant_details) {
        $can_update = false;
        $now = strtotime(date('Y-m-d H:i:s'));
        if (array_key_exists('last_updated', $yoco_merchant_details)) {
            $last_updated = $yoco_merchant_details['last_updated'];
            $sec_diff = $now - $last_updated;
            if ($sec_diff > intval(86400)) {
                $can_update = true;
            }
        } else {
            $yoco_merchant_details['last_updated'] = $now;
            update_option('yoco_merchant_details', $yoco_merchant_details);
            $can_update = true;
        }
        return $can_update;
    }

    public function updateMerchantDetails() {
        $yoco_merchant_details = get_option('yoco_merchant_details');
        $yoco_merchant_details = maybe_unserialize($yoco_merchant_details);
        if ($yoco_merchant_details) {
            if ($this->validateStoredMerchantDetails($yoco_merchant_details)) {
                if ($this->canUpdate($yoco_merchant_details)) {
                    $token = self::login();
                    if ($token !== false) {
                        $this->sendUpdateMerchantDetails($token, $yoco_merchant_details);
                        $now = strtotime(date('Y-m-d H:i:s'));
                        $yoco_merchant_details['last_updated'] = $now;
                        update_option('yoco_merchant_details', $yoco_merchant_details);
                    }
                }
            }
        }
    }

    static function login() {
        $yoco_merchant_details = get_option('yoco_merchant_details');
        if ($yoco_merchant_details) {
            $yoco_merchant_details = maybe_unserialize($yoco_merchant_details);
            if (array_key_exists('client_id', $yoco_merchant_details) && !empty($yoco_merchant_details['client_id'] && array_key_exists('authorization', $yoco_merchant_details) && !empty($yoco_merchant_details['authorization']))) {
                $body = [
                    'username' => $yoco_merchant_details['client_id'],
                    'password' => hex2bin($yoco_merchant_details['authorization']),
                ];


                $args = [
                    'method' => 'POST',
                    'sslverify' => true,
                    'headers' => [
                        'Cache-Control' => 'no-cache',
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'body' => $body,
                ];

                $uri = self::YOCO_ERROR_API_ENDPOINT . '/login';
                $request = wp_remote_post($uri, $args);
                if ( ! is_wp_error( $request ) ) {
                    $response = wp_remote_retrieve_body($request);
                    $response = json_decode($response, true);
                    if (array_key_exists('token', $response)) {
                        return $response['token'];
                    }
                    if (
                        array_key_exists( 'message', $response ) &&
                        $response['message'] === 'Unauthorized'
                    ) {
                        delete_option( 'yoco_merchant_details' );
                        return false;
                    }
                }
            }
        }
        return false;
    }

    static function getYocoSystemMessages() {
        $token = self::login();
        if ($token !== false) {
            $authorization = 'Bearer ' . $token;

            $args = [
                'method' => 'GET',
                'sslverify' => true,
                'headers' => [
                    'Authorization' => $authorization,
                    'Cache-Control' => 'no-cache',
                    'Content-Type' => 'application/json',
                ],
            ];
            $uri = self::YOCO_ERROR_API_ENDPOINT . '/merchant/messages';
            $request = wp_remote_post($uri, $args);
            $response = wp_remote_retrieve_body($request);
            $response = json_decode($response, true);
            if ($response == null) {
                return "";
            }
            $yoco_message = '';
            foreach ($response as $messages) {
                $yoco_message .= $messages['message'] . '<br>';
            }
            return $yoco_message;
        }
        return '';
    }

    static function logError($type, $error_code, $error_message, $request_message)
    {

        $token = self::login();
        if ($token !== false) {
            $yoco_merchant_details = get_option('yoco_merchant_details');
            if ($yoco_merchant_details) {
                $yoco_merchant_details = maybe_unserialize($yoco_merchant_details);
                $body = [
                    'client_id' => $yoco_merchant_details['client_id'],
                    'client_secret' => $yoco_merchant_details['client_secret'],
                    'message' => $error_message,
                    'code' => intval($error_code),
                    'type' => $type,
                    'request' => base64_encode(json_encode($request_message))
                ];
                $authorization = 'Bearer ' . $token;

                $args = [
                    'method' => 'POST',
                    'sslverify' => true,
                    'headers' => [
                        'Authorization' => $authorization,
                        'Cache-Control' => 'no-cache',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode($body),
                ];
                $uri = self::YOCO_ERROR_API_ENDPOINT . '/merchant/log';
                $request = wp_remote_post($uri, $args);
            }
        }
    }

}
