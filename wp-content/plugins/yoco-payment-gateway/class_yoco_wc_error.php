<?php

class class_yoco_wc_error
{
    function __construct()
    {
        $this->create_error_table();
        add_filter( 'manage_edit-shop_order_columns', [$this,'add_order_error_column_header'], 20 );
        add_action( 'manage_shop_order_posts_custom_column', [$this,'add_order_error_column_content']);
    }

    private function create_error_table() {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;
        $table_name = $wpdb->prefix.'yoco_order_errors';
        // Check if table exists
        $sql = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
        $res = $wpdb->get_results($sql, 'ARRAY_A');
        if (count($res) == 0) {
            $create_ddl = $wpdb->prepare(
              'CREATE TABLE %s (
                `id` mediumint(9) NOT NULL AUTO_INCREMENT,
                `order_id` mediumint(9) DEFAULT NULL,
                `error_code` VARCHAR(25),
                `error_msg` VARCHAR(255),
                UNIQUE KEY `id` (`id`)
              );',
              $table_name
            );
            maybe_create_table('yoco_customer_order_error', $create_ddl);
        }
    }

    public function add_order_error_column_header( $columns ) {

        $new_columns = array();

        foreach ( $columns as $column_name => $column_info ) {

            $new_columns[ $column_name ] = $column_info;

            if ( 'order_status' === $column_name ) {
                $new_columns['order_error'] = __( 'Error', 'yoco_wc_payment_gateway' );
            }
        }

        return $new_columns;
    }

    public function add_order_error_column_content( $column ) {
        global $post;
        global $wpdb;
        $table_name = $wpdb->prefix.'yoco_order_errors';

        if ( 'order_error' === $column ) {
            $order = wc_get_order( $post->ID );
            $sql = $wpdb->prepare(
              'SELECT error_code, error_msg FROM %s WHERE order_id = %d ORDER BY id DESC LIMIT 1',
              $table_name,
              $post->ID
            );
            $res = $wpdb->get_results($sql, 'ARRAY_A');
            if ($res) {
                $output = '<em>' . esc_html( $res[0]['error_msg'] ) . '</em>';
                echo $output;
            }

        }
    }


    static function save_yoco_customer_order_error($order_id, $code, $message) {
        global $wpdb;
        $table_name = $wpdb->prefix.'yoco_order_errors';
        $wpdb->insert(
          $table_name,
          array(
            'order_id' => $order_id,
            'error_code' => $code,
            'error_msg' => $message,
          ),
          array( '%d', '%s', '%s' )
        );
    }
}

(new class_yoco_wc_error());
