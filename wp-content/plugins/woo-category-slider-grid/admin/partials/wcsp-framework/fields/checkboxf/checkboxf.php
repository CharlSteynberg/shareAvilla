<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: checkboxf
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'SP_WCS_Field_checkboxf' ) ) {
	class SP_WCS_Field_checkboxf extends SP_WCS_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args( $this->field, array(
				'inline' => false,
			) );

			$inline_class = ( $args['inline'] ) ? ' class="spf--inline-list"' : '';

			echo $this->field_before();

			if( ! empty( $this->field['options'] ) ) {

				$value   = ( is_array( $this->value ) ) ? $this->value : array_filter( (array) $this->value );
				$options = $this->field['options'];
				$options = ( is_array( $options ) ) ? $options : array_filter( $this->field_data( $options ) );

				if( ! empty( $options ) ) {

					echo '<ul'. $inline_class .'>';
					foreach ( $options as $option_key => $option_value ) {
						$pro_only = true == $option_value['pro_only'] ? 'disabled' : '';
						$checked = ( in_array( $option_key, $value ) ) ? ' checked' : '';
						echo '<li><label class="wcs-'. $pro_only .'"><input '. $pro_only .' type="checkbox" name="'. $this->field_name( '[]' ) .'" value="'. $option_key .'"'. $this->field_attributes() . $checked .'/> '. $option_value['text'] .'</label></li>';
					}
					echo '</ul>';

				} else {

					echo ( ! empty( $this->field['empty_message'] ) ) ? $this->field['empty_message'] : esc_html__( 'No data provided for this option type.', 'woo-category-slider' );

				}

			} else {
				echo '<label class="spf-checkbox">';
				echo '<input type="hidden" name="'. $this->field_name() .'" value="'. $this->value .'" class="spf--input"'. $this->field_attributes() .'/>';
				echo '<input type="checkbox" class="spf--checkbox"'. checked( $this->value, 1, false ) .'/>';
				echo ( ! empty( $this->field['label'] ) ) ? ' '. $this->field['label'] : '';
				echo '</label>';
			}

			echo $this->field_after();

		}

	}
}
