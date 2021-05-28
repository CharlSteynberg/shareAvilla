<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: textarea
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SPWPS_Field_textarea' ) ) {
	class SPWPS_Field_textarea extends SPWPS_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			echo $this->field_before();
			echo '<textarea name="' . esc_attr( $this->field_name() ) . '"' . $this->field_attributes() . '>' . $this->value . '</textarea>';
			echo $this->field_after();

		}

	}
}
