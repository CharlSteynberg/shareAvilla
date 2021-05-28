<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: Gradient Color
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SP_WCS_Field_gradient_color' ) ) {
	class SP_WCS_Field_gradient_color extends SP_WCS_Fields {

        public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'color_from' => true,
					'color_to'   => true,
					'direction'  => true,
				)
			);

			$default_value = array(
				'color_from' => '',
				'color_to'   => '',
				'direction'  => 'to bottom',
			);

			$border_props = array(
                'to bottom' => esc_html__( '&#8659; top to bottom', 'woo-category-slider' ),
                'to right'  => esc_html__( '&#8658; left to right', 'woo-category-slider' ),
                '135deg'    => esc_html__( '&#8664; corner top to right', 'woo-category-slider' ),
                '-135deg'   => esc_html__( '&#8665; corner top to left', 'woo-category-slider' ),
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$value = wp_parse_args( $this->value, $default_value );

			echo $this->field_before();

			if ( ! empty( $args['color_from'] ) ) {
				$default_color_from_attr = ( ! empty( $default_value['color_from'] ) ) ? ' data-default-color-from="' . $default_value['color_from'] . '"' : '';
				echo '<div class="spf--left spf-field-color">';
				echo '<div class="spf--title">' . esc_html__( 'From', 'woo-category-slider' ) . '</div>';
				echo '<input type="text" name="' . $this->field_name( '[color_from]' ) . '" value="' . $value['color_from'] . '" class="spf-color"' . $default_color_from_attr . ' />';
				echo '</div>';
			}

			if ( ! empty( $args['color_to'] ) ) {
				$default_color_to_attr = ( ! empty( $default_value['color_to'] ) ) ? ' data-default-hover-color="' . $default_value['color_to'] . '"' : '';
				echo '<div class="spf--left spf-field-color">';
				echo '<div class="spf--title">' . esc_html__( 'To', 'woo-category-slider' ) . '</div>';
				echo '<input type="text" name="' . $this->field_name( '[color_to]' ) . '" value="' . $value['color_to'] . '" class="spf-color"' . $default_color_to_attr . ' />';
				echo '</div>';
            }
            
            if ( ! empty( $args['direction'] ) ) {
                echo '<div class="spf--left spf--input">';
                echo '<div class="spf--title">' . esc_html__( 'Gradient Direction', 'woo-category-slider' ) . '</div>';
				echo '<select name="' . $this->field_name( '[direction]' ) . '">';
				foreach ( $border_props as $border_prop_key => $border_prop_value ) {
					$selected = ( $value['direction'] === $border_prop_key ) ? ' selected' : '';
					echo '<option value="' . $border_prop_key . '"' . $selected . '>' . $border_prop_value . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}

			echo '<div class="clear"></div>';

			echo $this->field_after();

		}

		public function output() {

			$output    = '';
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
			$element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];
			$direction  = ( isset( $this->value['direction'] ) && $this->value['direction'] !== '' ) ? $this->value['direction'] : '';
			$color_from  = ( isset( $this->value['color_from'] ) && $this->value['color_from'] !== '' ) ? $this->value['color_from'] : '';
			$color_to  = ( isset( $this->value['color_to'] ) && $this->value['color_to'] !== '' ) ? $this->value['color_to'] : '';

			if ( $color_from !== '' || $color_to !== '' ) {

				$output  = $element . '{';
				$output .= ( $all !== '' ) ? 'border-width:' . $all . $unit . $important . ';' : '';
				$output .= ( $color_from !== '' ) ? 'border-color:' . $color_from . $important . ';' : '';
				$output .= ( $color_to !== '' ) ? 'border-hover-color:' . $color_to . $important . ';' : '';
				$output .= ( $direction !== '' ) ? 'border-style:' . $direction . $important . ';' : '';
				$output .= '}';

            }

			$this->parent->output_css .= $output;

			return $output;

		}

	}
}
