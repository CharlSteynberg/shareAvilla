<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'RWMB_Sidebars_Field' ) )
{
	class RWMB_Sidebars_field extends RWMB_Select_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			parent::admin_enqueue_scripts();
			wp_enqueue_style( 'select2', RWMB_CSS_URL . 'select2/select2.min.css', array(), '4.0.3' );
			wp_enqueue_style( 'rwmb-select-advanced', RWMB_CSS_URL . 'select-advanced.css', array(), RWMB_VER );

			wp_register_script( 'select2', RWMB_JS_URL . 'select2/select2.full.min.js', array( 'jquery' ), '4.0.3', true );

			wp_enqueue_script( 'rwmb-select', RWMB_JS_URL . 'select.js', array( 'jquery' ), RWMB_VER, true );
			wp_enqueue_script( 'rwmb-select-advanced', RWMB_JS_URL . 'select-advanced.js', array('select2'), RWMB_VER, true );
		}


		/**
		 * Normalize parameters for field.
		 *
		 * @param array $field Field parameters.
		 * @return array
		 */
		public static function normalize( $field ) {
			$field = wp_parse_args( $field, array(
				'js_options'  => array(),
				'placeholder' => __( 'Select an item', 'wolverine' ),
			) );

			$field = parent::normalize( $field );

			$field['js_options'] = wp_parse_args( $field['js_options'], array(
				'allowClear'  => true,
				'width'       => 'none',
				'placeholder' => $field['placeholder'],
			) );

			$field['options'] = array();

			$field['options']['-2'] = esc_html__('--None--','wolverine');
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				$field['options'][$sidebar['id']] = ucwords( $sidebar['name'] );
			}

			return $field;
		}

		/**
		 * Get the attributes for a field.
		 *
		 * @param array $field Field parameters.
		 * @param mixed $value Meta value.
		 * @return array
		 */
		public static function get_attributes( $field, $value = null ) {
			$attributes = parent::get_attributes( $field, $value );
			$attributes = wp_parse_args( $attributes, array(
				'data-options' => wp_json_encode( $field['js_options'] ),
			) );

			return $attributes;
		}

	}
}
