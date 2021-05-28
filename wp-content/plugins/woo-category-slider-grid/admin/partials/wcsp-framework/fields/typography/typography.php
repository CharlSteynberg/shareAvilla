<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: typography
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SP_WCS_Field_typography' ) ) {
	class SP_WCS_Field_typography extends SP_WCS_Fields {

		public $chosen = false;

		public $value = array();

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			echo $this->field_before();

			$args = wp_parse_args(
				$this->field,
				array(
					'font_family'        => true,
					'font_weight'        => true,
					'font_style'         => true,
					'font_size'          => true,
					'line_height'        => true,
					'letter_spacing'     => true,
					'text_align'         => true,
					'text_transform'     => true,
					'color'              => true,
					'hover-color'        => false,
					'chosen'             => true,
					'preview'            => true,
					'subset'             => true,
					'multi_subset'       => false,
					'extra_styles'       => false,
					'backup_font_family' => false,
					'font_variant'       => false,
					'word_spacing'       => false,
					'text_decoration'    => false,
					'custom_style'       => false,
					'exclude'            => '',
					'unit'               => 'px',
					'preview_text'       => 'The quick brown fox jumps over the lazy dog',
				)
			);

			$default_value = array(
				'font-family'        => '',
				'font-weight'        => '',
				'font-style'         => '',
				'font-variant'       => '',
				'font-size'          => '',
				'line-height'        => '',
				'letter-spacing'     => '',
				'word-spacing'       => '',
				'text-align'         => '',
				'text-transform'     => '',
				'text-decoration'    => '',
				'backup-font-family' => '',
				'color'              => '',
				'hover-color'        => '',
				'custom-style'       => '',
				'type'               => '',
				'subset'             => '',
				'extra-styles'       => array(),
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;
			$this->value   = wp_parse_args( $this->value, $default_value );
			$this->chosen  = $args['chosen'];
			$chosen_class  = ( $this->chosen ) ? ' spf--chosen' : '';

			echo '<div class="spf--typography' . $chosen_class . '" data-unit="' . $args['unit'] . '" data-exclude="' . $args['exclude'] . '">';

			echo '<div class="spf--blocks spf--blocks-selects">';

			//
			// Font Family.
			if ( ! empty( $args['font_family'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Font Family', 'woo-category-slider' ) . '</div>';
				echo '<select disabled class="spf--font-family"><option value="open_sans">Open Sans</option></select>';
				echo '</div>';
			}

			//
			// Font Style and Extra Style Select.
			if ( ! empty( $args['font_weight'] ) || ! empty( $args['font_style'] ) ) {

				//
				// Font Style Select.
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Font Style', 'woo-category-slider' ) . '</div>';
				echo '<select disabled class="spf--font-style-select" data-placeholder="Default">';
				echo '<option value="">' . ( ! $this->chosen ? esc_html__( 'Default', 'woo-category-slider' ) : '' ) . '</option>';
				if ( ! empty( $this->value['font-weight'] ) || ! empty( $this->value['font-style'] ) ) {
					echo '<option value="' . strtolower( $this->value['font-weight'] . $this->value['font-style'] ) . '" selected></option>';
				}
				echo '</select>';
				echo '<input type="hidden" name="' . $this->field_name( '[font-weight]' ) . '" class="spf--font-weight" value="' . $this->value['font-weight'] . '" />';
				echo '<input type="hidden" name="' . $this->field_name( '[font-style]' ) . '" class="spf--font-style" value="' . $this->value['font-style'] . '" />';

				//
				// Extra Font Style Select.
				if ( ! empty( $args['extra_styles'] ) ) {
					echo '<div class="spf--block-extra-styles hidden">';
					echo ( ! $this->chosen ) ? '<div class="spf--title">' . esc_html__( 'Load Extra Styles', 'woo-category-slider' ) . '</div>' : '';
					$placeholder = ( $this->chosen ) ? esc_html__( 'Load Extra Styles', 'woo-category-slider' ) : esc_html__( 'Default', 'woo-category-slider' );
					echo $this->create_select( $this->value['extra-styles'], 'extra-styles', $placeholder, true );
					echo '</div>';
				}

				echo '</div>';

			}

			//
			// Subset.
			if ( ! empty( $args['subset'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Subset', 'woo-category-slider' ) . '</div>';
				$subset = ( is_array( $this->value['subset'] ) ) ? $this->value['subset'] : array_filter( (array) $this->value['subset'] );
				echo $this->create_select( $subset, 'subset', esc_html__( 'Default', 'woo-category-slider' ), $args['multi_subset'] );
				echo '</div>';
			}

			//
			// Text Align.
			if ( ! empty( $args['text_align'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Text Align', 'woo-category-slider' ) . '</div>';
				echo $this->create_select(
					array(
						'inherit' => esc_html__( 'Inherit', 'woo-category-slider' ),
						'left'    => esc_html__( 'Left', 'woo-category-slider' ),
						'center'  => esc_html__( 'Center', 'woo-category-slider' ),
						'right'   => esc_html__( 'Right', 'woo-category-slider' ),
						'justify' => esc_html__( 'Justify', 'woo-category-slider' ),
						'initial' => esc_html__( 'Initial', 'woo-category-slider' ),
					),
					'text-align',
					esc_html__( 'Default', 'woo-category-slider' )
				);
				echo '</div>';
			}

			//
			// Font Variant.
			if ( ! empty( $args['font_variant'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Font Variant', 'woo-category-slider' ) . '</div>';
				echo $this->create_select(
					array(
						'normal'         => esc_html__( 'Normal', 'woo-category-slider' ),
						'small-caps'     => esc_html__( 'Small Caps', 'woo-category-slider' ),
						'all-small-caps' => esc_html__( 'All Small Caps', 'woo-category-slider' ),
					),
					'font-variant',
					esc_html__( 'Default', 'woo-category-slider' )
				);
				echo '</div>';
			}

			//
			// Text Transform.
			if ( ! empty( $args['text_transform'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Text Transform', 'woo-category-slider' ) . '</div>';
				echo $this->create_select(
					array(
						'none'       => esc_html__( 'None', 'woo-category-slider' ),
						'capitalize' => esc_html__( 'Capitalize', 'woo-category-slider' ),
						'uppercase'  => esc_html__( 'Uppercase', 'woo-category-slider' ),
						'lowercase'  => esc_html__( 'Lowercase', 'woo-category-slider' ),
					),
					'text-transform',
					esc_html__( 'Default', 'woo-category-slider' )
				);
				echo '</div>';
			}

			//
			// Text Decoration.
			if ( ! empty( $args['text_decoration'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Text Decoration', 'woo-category-slider' ) . '</div>';
				echo $this->create_select(
					array(
						'none'               => esc_html__( 'None', 'woo-category-slider' ),
						'underline'          => esc_html__( 'Solid', 'woo-category-slider' ),
						'underline double'   => esc_html__( 'Double', 'woo-category-slider' ),
						'underline dotted'   => esc_html__( 'Dotted', 'woo-category-slider' ),
						'underline dashed'   => esc_html__( 'Dashed', 'woo-category-slider' ),
						'underline wavy'     => esc_html__( 'Wavy', 'woo-category-slider' ),
						'underline overline' => esc_html__( 'Overline', 'woo-category-slider' ),
						'line-through'       => esc_html__( 'Line-through', 'woo-category-slider' ),
					),
					'text-decoration',
					esc_html__( 'Default', 'woo-category-slider' )
				);
				echo '</div>';
			}

			echo '</div>'; // End of .spf--blocks-selects.

			echo '<div class="spf--blocks spf--blocks-inputs">';

			//
			// Font Size
			if ( ! empty( $args['font_size'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Font Size', 'woo-category-slider' ) . '</div>';
				echo '<div class="spf--blocks">';
				echo '<div class="spf--block"><input disabled type="text" name="' . $this->field_name( '[font-size]' ) . '" class="spf--font-size spf--input spf-number" value="' . $this->value['font-size'] . '" /></div>';
				echo '<div class="spf--block spf--unit">' . $args['unit'] . '</div>';
				echo '</div>';
				echo '</div>';
			}

			//
			// Line Height.
			if ( ! empty( $args['line_height'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Line Height', 'woo-category-slider' ) . '</div>';
				echo '<div class="spf--blocks">';
				echo '<div class="spf--block"><input disabled type="text" name="' . $this->field_name( '[line-height]' ) . '" class="spf--line-height spf--input spf-number" value="' . $this->value['line-height'] . '" /></div>';
				echo '<div class="spf--block spf--unit">' . $args['unit'] . '</div>';
				echo '</div>';
				echo '</div>';
			}

			//
			// Letter Spacing.
			if ( ! empty( $args['letter_spacing'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Letter Spacing', 'woo-category-slider' ) . '</div>';
				echo '<div class="spf--blocks">';
				echo '<div class="spf--block"><input disabled type="text" name="' . $this->field_name( '[letter-spacing]' ) . '" class="spf--letter-spacing spf--input spf-number" value="' . $this->value['letter-spacing'] . '" /></div>';
				echo '<div class="spf--block spf--unit">' . $args['unit'] . '</div>';
				echo '</div>';
				echo '</div>';
			}

			//
			// Word Spacing.
			if ( ! empty( $args['word_spacing'] ) ) {
				echo '<div class="spf--block">';
				echo '<div class="spf--title">' . esc_html__( 'Word Spacing', 'woo-category-slider' ) . '</div>';
				echo '<div class="spf--blocks">';
				echo '<div class="spf--block"><input disabled type="text" name="' . $this->field_name( '[word-spacing]' ) . '" class="spf--word-spacing spf--input spf-number" value="' . $this->value['word-spacing'] . '" /></div>';
				echo '<div class="spf--block spf--unit">' . $args['unit'] . '</div>';
				echo '</div>';
				echo '</div>';
			}

			echo '</div>'; // End of spf--blocks-inputs.

			//
			// Font Color.
			if ( ! empty( $args['color'] ) ) {
				echo '<div class="spf--blocks spf--blocks-color">';
				$default_color_attr = ( ! empty( $default_value['color'] ) ) ? ' data-default-color="' . $default_value['color'] . '"' : '';
				echo '<div class="spf--block spf--block-font-color">';
				echo '<div class="spf--title">' . esc_html__( 'Font Color', 'woo-category-slider' ) . '</div>';
				echo '<div class="spf-field-color">';
				echo '<input type="text" name="' . $this->field_name( '[color]' ) . '" class="spf-color spf--color" value="' . $this->value['color'] . '"' . $default_color_attr . ' />';
				echo '</div>';
				echo '</div>';

				//
				// Font Hover Color.
				if ( ! empty( $args['hover-color'] ) ) {
					$default_hover_color_attr = ( ! empty( $default_value['hover-color'] ) ) ? ' data-default-color="' . $default_value['hover-color'] . '"' : '';
					echo '<div class="spf--block spf--block-font-color">';
					echo '<div class="spf--title">' . esc_html__( 'Font Hover Color', 'woo-category-slider' ) . '</div>';
					echo '<div class="spf-field-color">';
					echo '<input type="text" name="' . $this->field_name( '[hover-color]' ) . '" class="spf-color spf--color" value="' . $this->value['hover-color'] . '"' . $default_hover_color_attr . ' />';
					echo '</div>';
					echo '</div>';
				}
				echo '</div>'; // End of spf--blocks-color
			}

			//
			// Custom style.
			if ( ! empty( $args['custom_style'] ) ) {
				echo '<div class="spf--block spf--block-custom-style">';
				echo '<div class="spf--title">' . esc_html__( 'Custom Style', 'woo-category-slider' ) . '</div>';
				echo '<textarea name="' . $this->field_name( '[custom-style]' ) . '" class="spf--custom-style">' . $this->value['custom-style'] . '</textarea>';
				echo '</div>';
			}

			//
			// Preview.
			$always_preview = ( $args['preview'] !== 'always' ) ? ' hidden' : '';

			if ( ! empty( $args['preview'] ) ) {
				echo '<div class="spf--block spf--block-preview' . $always_preview . '">';
				echo '<div class="spf--toggle fa fa-toggle-off"></div>';
				echo '<div class="spf--preview">' . $args['preview_text'] . '</div>';
				echo '</div>';
			}

			echo '<input type="hidden" name="' . $this->field_name( '[type]' ) . '" class="spf--type" value="' . $this->value['type'] . '" />';
			echo '<input type="hidden" name="' . $this->field_name( '[unit]' ) . '" class="spf--unit-save" value="' . $args['unit'] . '" />';

			echo '</div>';

			echo $this->field_after();

		}

		public function create_select( $options, $name, $placeholder = '', $is_multiple = false ) {

			$multiple_name = ( $is_multiple ) ? '[]' : '';
			$multiple_attr = ( $is_multiple ) ? ' multiple data-multiple="true"' : '';
			$chosen_rtl    = ( $this->chosen && is_rtl() ) ? ' chosen-rtl' : '';

			$output  = '<select disabled name="' . $this->field_name( '[' . $name . ']' . $multiple_name ) . '" class="spf--' . $name . $chosen_rtl . '" data-placeholder="' . $placeholder . '"' . $multiple_attr . '>';
			$output .= ( ! empty( $placeholder ) ) ? '<option value="">' . ( ( ! $this->chosen ) ? $placeholder : '' ) . '</option>' : '';

			if ( ! empty( $options ) ) {
				foreach ( $options as $option_key => $option_value ) {
					if ( $is_multiple ) {
						$selected = ( in_array( $option_value, $this->value[ $name ] ) ) ? ' selected' : '';
						$output  .= '<option value="' . $option_value . '"' . $selected . '>' . $option_value . '</option>';
					} else {
						$option_key = ( is_numeric( $option_key ) ) ? $option_value : $option_key;
						$selected   = ( $option_key === $this->value[ $name ] ) ? ' selected' : '';
						$output    .= '<option value="' . $option_key . '"' . $selected . '>' . $option_value . '</option>';
					}
				}
			}

			$output .= '</select>';

			return $output;

		}
	}
}
