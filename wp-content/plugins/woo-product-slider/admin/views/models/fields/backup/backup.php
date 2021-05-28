<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'SPWPS_Field_backup' ) ) {
  class SPWPS_Field_backup extends SPWPS_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'spwps_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'spwps-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="spwps_import_data" class="spwps-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary spwps-confirm spwps-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'woo-product-slider' ) .'</button>';
      echo '<small>( '. esc_html__( 'copy-paste your backup string here', 'woo-product-slider' ).' )</small>';

      echo '<hr />';
      echo '<textarea readonly="readonly" class="spwps-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary spwps-export" target="_blank">'. esc_html__( 'Export and Download Backup', 'woo-product-slider' ) .'</a>';

      echo '<hr />';
      echo '<button type="submit" name="spwps_transient[reset]" value="reset" class="button spwps-warning-primary spwps-confirm spwps-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset All', 'woo-product-slider' ) .'</button>';
      echo '<small class="spwps-text-error">'. esc_html__( 'Please be sure for reset all of options.', 'woo-product-slider' ) .'</small>';

      echo $this->field_after();

    }

  }
}
