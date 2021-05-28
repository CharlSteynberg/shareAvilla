<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Add framework element
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'sp_wqv_add_element' ) ) {
	function sp_wqv_add_element( $field = array(), $value = '', $unique = '' ) {

		$output     = '';
		$depend     = '';
		$sub        = ( isset( $field['sub'] ) ) ? 'sub-': '';
		$unique     = ( isset( $unique ) ) ? $unique : '';
		$languages  = sp_language_defaults();
		$class      = 'SP_WQV_Framework_Option_' . $field['type'];
		$wrap_class = ( isset( $field['wrap_class'] ) ) ? ' ' . $field['wrap_class'] : '';
		$hidden     = ( isset( $field['show_only_language'] ) && ( $field['show_only_language'] != $languages['current'] ) ) ? ' hidden' : '';
		$is_pseudo  = ( isset( $field['pseudo'] ) ) ? ' sp-pseudo-field' : '';

		if ( isset( $field['dependency'] ) ) {
			$hidden  = ' hidden';
			$depend .= ' data-'. $sub .'controller="'. $field['dependency'][0] .'"';
			$depend .= ' data-'. $sub .'condition="'. $field['dependency'][1] .'"';
			$depend .= ' data-'. $sub .'value="'. $field['dependency'][2] .'"';
		}

		$output .= '<div class="sp-element sp-field-'. $field['type'] . $is_pseudo . $wrap_class . $hidden .'"'. $depend .'>';

		if( isset( $field['title'] ) ) {
			$field_desc = ( isset( $field['desc'] ) ) ? '<p class="sp-text-desc">'. $field['desc'] .'</p>' : '';
			$output .= '<div class="sp-title"><h4>' . $field['title'] . '</h4>'. $field_desc .'</div>';
		}

		$output .= ( isset( $field['title'] ) ) ? '<div class="sp-fieldset">' : '';

		$value   = ( !isset( $value ) && isset( $field['default'] ) ) ? $field['default'] : $value;
		$value   = ( isset( $field['value'] ) ) ? $field['value'] : $value;

		if( class_exists( $class ) ) {
			ob_start();
			$element = new $class( $field, $value, $unique );
			$element->output();
			$output .= ob_get_clean();
		} else {
			$output .= '<p>'. __( 'This field class is not available!', 'woo-quick-view' ) .'</p>';
		}

		$output .= ( isset( $field['title'] ) ) ? '</div>' : '';
		$output .= '<div class="clear"></div>';
		$output .= '</div>';

		return $output;

	}
}

/**
 *
 * Array search key & value
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'sp_array_search' ) ) {
	function sp_array_search( $array, $key, $value ) {

		$results = array();

		if ( is_array( $array ) ) {
			if ( isset( $array[$key] ) && $array[$key] == $value ) {
				$results[] = $array;
			}

			foreach ( $array as $sub_array ) {
				$results = array_merge( $results, sp_array_search( $sub_array, $key, $value ) );
			}

		}

		return $results;

	}
}

/**
 *
 * Getting POST Var
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'sp_wqv_get_var' ) ) {
	function sp_wqv_get_var( $var, $default = '' ) {

		if( isset( $_POST[$var] ) ) {
			return $_POST[$var];
		}

		if( isset( $_GET[$var] ) ) {
			return $_GET[$var];
		}

		return $default;

	}
}

/**
 *
 * Getting POST Vars
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'sp_wqv_get_vars' ) ) {
	function sp_wqv_get_vars( $var, $depth, $default = '' ) {

		if( isset( $_POST[$var][$depth] ) ) {
			return $_POST[$var][$depth];
		}

		if( isset( $_GET[$var][$depth] ) ) {
			return $_GET[$var][$depth];
		}

		return $default;

	}
}

/**
 *
 * Load options fields
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'sp_wqv_load_option_fields' ) ) {
	function sp_wqv_load_option_fields() {

		$located_fields = array();

		foreach ( glob( SP_WQV_F_DIR .'/fields/*/*.php' ) as $sp_field ) {
			$located_fields[] = basename( $sp_field );
			sp_wqv_locate_template( str_replace(  SP_WQV_F_DIR, '', $sp_field ) );
		}

		$override_name = apply_filters( 'sp_wqv_framework_override', 'sp-framework-override' );
		$override_dir  = get_template_directory() .'/' . $override_name . '/fields';

		if ( is_dir( $override_dir ) ) {

			foreach ( glob( $override_dir . '/*/*.php' ) as $override_field ) {

				if ( ! in_array( basename( $override_field ), $located_fields ) ) {

					sp_wqv_locate_template( str_replace( $override_dir, '/fields', $override_field ) );

				}
			}
		}

		do_action( 'sp_wqv_load_option_fields' );

	}
}
