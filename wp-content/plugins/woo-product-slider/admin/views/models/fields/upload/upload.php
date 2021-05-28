<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: upload
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'SPWPS_Field_upload' ) ) {
  class SPWPS_Field_upload extends SPWPS_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'library'      => array(),
        'button_title' => esc_html__( 'Upload', 'woo-product-slider' ),
        'remove_title' => esc_html__( 'Remove', 'woo-product-slider' ),
      ) );

      echo $this->field_before();

      $library = ( is_array( $args['library'] ) ) ? $args['library'] : array_filter( (array) $args['library'] );
      $library = ( ! empty( $library ) ) ? implode(',', $library ) : '';
      $hidden  = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="spwps--wrap">';
      echo '<input type="text" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'"'. $this->field_attributes() .'/>';
      echo '<a href="#" class="button button-primary spwps--button" data-library="'. esc_attr( $library ) .'">'. wp_kses_post( $args['button_title'] ) .'</a>';
      echo '<a href="#" class="button button-secondary spwps-warning-primary spwps--remove'. esc_attr( $hidden ) .'">'. wp_kses_post( $args['remove_title'] ) .'</a>';
      echo '</div>';

      echo $this->field_after();

    }
  }
}
