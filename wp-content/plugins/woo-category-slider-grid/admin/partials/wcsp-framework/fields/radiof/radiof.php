<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: radiof
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SP_WCS_Field_radiof' ) ) {
	class SP_WCS_Field_radiof extends SP_WCS_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'inline' => false,
				)
			);

			$inline_class = ( $args['inline'] ) ? ' class="spf--inline-list"' : '';

			echo $this->field_before();

			if ( isset( $this->field['options'] ) ) {

				$options = $this->field['options'];
				$options = ( is_array( $options ) ) ? $options : array_filter( $this->field_data( $options ) );

				if ( ! empty( $options ) ) {

					echo '<ul' . $inline_class . '>';
					foreach ( $options as $option_key => $option_value ) {
						$pro_only = true == $option_value['pro_only'] ? 'disabled' : '';
						$checked = ( $option_key === $this->value ) ? ' checked' : '';
						echo '<li><label class="wcs-'. $pro_only .'"><input '. $pro_only .' type="radio" name="' . $this->field_name() . '" value="' . $option_key . '"' . $this->field_attributes() . $checked . '/> ' . $option_value['text'] . '</label></li>';
					}
					echo '</ul>';

				} else {

					echo ( ! empty( $this->field['empty_message'] ) ) ? $this->field['empty_message'] : esc_html__( 'No data provided for this option type.', 'woo-category-slider' );

				}
			} else {
				$label = ( isset( $this->field['label'] ) ) ? $this->field['label'] : '';
				echo '<label><input type="radio" name="' . $this->field_name() . '" value="1"' . $this->field_attributes() . checked( $this->value, 1, false ) . '/> ' . $label . '</label>';
			}

			echo $this->field_after();

		}

	}
}
