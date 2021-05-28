<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: Box Shadow
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SP_WCS_Field_box_shadow' ) ) {
	class SP_WCS_Field_box_shadow extends SP_WCS_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'vertical_icon'          => '<i class="fa fa-long-arrow-up"></i>',
					'horizontal_icon'        => '<i class="fa fa-long-arrow-left"></i>',
					'vertical_placeholder'   => 'v-offset',
					'horizontal_placeholder' => 'h-offset',
					'blur_placeholder'       => 'blur',
					'spread_placeholder'     => 'spread',
					'vertical'               => true,
					'horizontal'             => true,
					'blur'                   => true,
					'spread'                 => true,
					'color'                  => true,
					'hover_color'            => false,
					'style'                  => true,
					'unit'                   => 'px',
				)
			);

			$default_value = array(
				'vertical'    => '',
				'horizontal'  => '',
				'blur'        => '',
				'spread'      => '',
				'color'       => '',
				'hover_color' => '',
				'style'       => 'outset',
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$value = wp_parse_args( $this->value, $default_value );

			echo $this->field_before();

			$properties = array();

			foreach ( array( 'vertical', 'horizontal', 'blur', 'spread' ) as $prop ) {
				if ( ! empty( $args[ $prop ] ) ) {
					$properties[] = $prop;
				}
			}

			foreach ( $properties as $property ) {

				$placeholder = ( ! empty( $args[ $property . '_placeholder' ] ) ) ? ' placeholder="' . $args[ $property . '_placeholder' ] . '"' : '';

				echo '<div class="spf--left spf--input">';
				echo ( ! empty( $args[ $property . '_icon' ] ) ) ? '<span class="spf--label spf--label-icon">' . $args[ $property . '_icon' ] . '</span>' : '';
				echo '<input type="text" name="' . $this->field_name( '[' . $property . ']' ) . '" value="' . $value[ $property ] . '"' . $placeholder . ' class="spf-number" />';
				echo ( ! empty( $args['unit'] ) ) ? '<span class="spf--label spf--label-unit">' . $args['unit'] . '</span>' : '';
				echo '</div>';

			}

			if ( ! empty( $args['style'] ) ) {
				echo '<div class="spf--left spf--input">';
				echo '<select name="' . $this->field_name( '[style]' ) . '">';
				foreach ( array( 'inset', 'outset' ) as $style ) {
					$selected = ( $value['style'] === $style ) ? ' selected' : '';
					echo '<option value="' . $style . '"' . $selected . '>' . ucfirst( $style ) . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}

			if ( ! empty( $args['color'] ) ) {
				$default_color_attr = ( ! empty( $default_value['color'] ) ) ? ' data-default-color="' . $default_value['color'] . '"' : '';
				echo '<div class="spf--left spf-field-color">';
				echo '<div class="spf--title">Color</div>';
				echo '<input type="text" name="' . $this->field_name( '[color]' ) . '" value="' . $value['color'] . '" class="spf-color"' . $default_color_attr . ' />';
				echo '</div>';
			}

			if ( ! empty( $args['hover_color'] ) ) {
				$default_hover_color_attr = ( ! empty( $default_value['hover_color'] ) ) ? ' data-default-hover-color="' . $default_value['hover_color'] . '"' : '';
				echo '<div class="spf--left spf-field-color">';
				echo '<div class="spf--title">Hover Color</div>';
				echo '<input type="text" name="' . $this->field_name( '[hover_color]' ) . '" value="' . $value['hover_color'] . '" class="spf-color"' . $default_hover_color_attr . ' />';
				echo '</div>';
			}

			echo '<div class="clear"></div>';

			echo $this->field_after();

		}

		public function output() {

			$output    = '';
			$unit      = ( ! empty( $this->value['unit'] ) ) ? $this->value['unit'] : 'px';
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
			$element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];

			// properties.
			$vertical   = ( isset( $this->value['vertical'] ) && $this->value['vertical'] !== '' ) ? $this->value['vertical'] : '';
			$horizontal = ( isset( $this->value['horizontal'] ) && $this->value['horizontal'] !== '' ) ? $this->value['horizontal'] : '';
			$blur       = ( isset( $this->value['blur'] ) && $this->value['blur'] !== '' ) ? $this->value['blur'] : '';
			$spread     = ( isset( $this->value['spread'] ) && $this->value['spread'] !== '' ) ? $this->value['spread'] : '';
			$style      = ( isset( $this->value['style'] ) && $this->value['style'] !== '' && $this->value['style'] !== 'outset' ) ? $this->value['style'] : '';
			$color      = ( isset( $this->value['color'] ) && $this->value['color'] !== '' ) ? $this->value['color'] : '';

				$output  = $element . '{ box-shadow: ';
				$output .= ( '' !== $vertical ) ? $vertical . $unit : '0' . $unit;
				$output .= ( '' !== $horizontal ) ? $horizontal . $unit : '0' . $unit;
				$output .= ( '' !== $blur ) ? $blur . $unit : '0' . $unit;
				$output .= ( '' !== $spread ) ? $spread . $unit : '0' . $unit;
				$output .= ( '' !== $color ) ? $color : '';
				$output .= ( '' !== $style ) ? $style : '';
				$output .= ';' . $important . ' }';

			$this->parent->output_css .= $output;

			return $output;

		}

	}
}
