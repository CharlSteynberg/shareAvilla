<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Label_Text_Field' ) ) {
	class RWMB_Label_Text_Field extends RWMB_Field {
		static function admin_enqueue_scripts()
		{
			wp_enqueue_style( 'rwmb-label-text', RWMB_CSS_URL . 'label_text.css', array(), RWMB_VER );
		}

		/**
		 * Get field HTML
		 *
		 * @param mixed $meta
		 * @param array $field
		 *
		 * @return string
		 */
		static function html( $meta, $field )
		{
			$default = array(
				'label' => '',
				'text' => ''
			);
			if (!is_array($meta)) {
				$meta = array();
			}
			$meta = array_merge($default, $meta);
			ob_start();
			?>
			<ul class="label-text-wrapper">
				<li>
					<label for="<?php echo esc_attr($field['id'])  . '-label'; ?>"><?php esc_html_e('Label','wolverine'); ?></label>
					<input type="text" id="<?php echo esc_attr($field['id'])  . '-label'; ?>" name="<?php echo esc_attr($field['field_name']) . '[label]'; ?>" value="<?php echo esc_attr($meta['label']); ?>"/>
				</li>
				<li>
					<label for="<?php echo esc_attr($field['id'])  . '-text'; ?>"><?php esc_html_e('Text','wolverine'); ?></label>
					<input type="text" id="<?php echo esc_attr($field['id'])  . '-text'; ?>" name="<?php echo esc_attr($field['field_name']) . '[text]'; ?>" value="<?php echo esc_attr($meta['text']); ?>"/>
				</li>
			</ul>
			<?php
			return ob_get_clean();
		}
	}
}
