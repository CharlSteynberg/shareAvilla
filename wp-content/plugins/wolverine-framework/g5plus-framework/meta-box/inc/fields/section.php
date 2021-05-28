<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Section_Field' ) )
{
	class RWMB_Section_Field extends RWMB_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			wp_enqueue_style( 'rwmb-section', RWMB_CSS_URL . 'section.css', array(), RWMB_VER );
		}

		/**
		 * Show begin HTML markup for fields
		 *
		 * @param mixed $meta
		 * @param array $field
		 *
		 * @return string
		 */
		static function begin_html( $meta, $field )
		{
			if (isset($field['switch']) && ($field['switch'])) {
				$html = sprintf(
					'<div class="rwmb-section"><span>%s</span><input type="checkbox" class="rwmb-checkbox" name="%s" id="%s" value="1" %s>',
					$field['name'],
					$field['field_name'],
					$field['id'],
					checked( ! empty( $meta ), 1, false )
				);

				$html .= sprintf('<label for="%s" data-on="%s" data-off="%s"></label>',
					$field['id'],
					esc_html__('CUSTOMIZE ON','wolverine'),
					esc_html__('CUSTOMIZE OFF','wolverine')
				);
			}
			else {
				$html = sprintf('<div class="rwmb-section"><span>%s</span>', $field['name']);
			}
			return $html;
		}

		/**
		 * Show end HTML markup for fields
		 *
		 * @param mixed $meta
		 * @param array $field
		 *
		 * @return string
		 */
		static function end_html( $meta, $field )
		{
			return '</div>';
		}
	}
}
