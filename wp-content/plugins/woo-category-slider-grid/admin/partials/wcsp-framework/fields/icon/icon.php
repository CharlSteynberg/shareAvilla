<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'SP_WCS_Field_icon' ) ) {
	class SP_WCS_Field_icon extends SP_WCS_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args( $this->field, array(
				'button_title' => esc_html__( 'Add Icon', 'woo-category-slider' ),
				'remove_title' => esc_html__( 'Remove Icon', 'woo-category-slider' ),
			) );

			echo $this->field_before();

			$nonce  = wp_create_nonce( 'spf_icon_nonce' );
			$hidden = ( empty( $this->value ) ) ? ' hidden' : '';

			echo '<div class="spf-icon-select">';
			echo '<span class="spf-icon-preview'. $hidden .'"><i class="'. $this->value .'"></i></span>';
			echo '<a href="#" class="button button-primary spf-icon-add" data-nonce="'. $nonce .'">'. $args['button_title'] .'</a>';
			echo '<a href="#" class="button spf-warning-primary spf-icon-remove'. $hidden .'">'. $args['remove_title'] .'</a>';
			echo '<input type="text" name="'. $this->field_name() .'" value="'. $this->value .'" class="spf-icon-value"'. $this->field_attributes() .' />';
			echo '</div>';

			echo $this->field_after();

		}

	}
}
