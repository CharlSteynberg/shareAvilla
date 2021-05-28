<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Padding_Field' ) ) {
	class RWMB_Padding_Field extends RWMB_Field {
		static function admin_enqueue_scripts()
		{
			wp_enqueue_style( 'rwmb-padding', RWMB_CSS_URL . 'padding.css', array(), RWMB_VER );
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
				'top' => '',
				'bottom' => '',
				'left' => '',
				'right' => '',
			);
			if (!is_array($meta)) {
				$meta = array();
			}
			$meta = array_merge($default, $meta);

			$default = array(
				'top' => true,
				'bottom' => true,
				'left' => true,
				'right' => true,
			);
			if (isset($field['allow']) && is_array($field['allow'])) {
				$allow = array_merge($default, $field['allow']);
			}
			else {
				$allow = $default;
			}
			$padding_config = array(
				'top'       => array(
					'icon' => 'fa fa-arrow-up',
					'label' => esc_html__('Top','wolverine')
				),
				'bottom'       => array(
					'icon' => 'fa fa-arrow-down',
					'label' => esc_html__('Bottom','wolverine')
				),
				'left'       => array(
					'icon' => 'fa fa-arrow-left',
					'label' => esc_html__('Left','wolverine')
				),
				'right'       => array(
					'icon' => 'fa fa-arrow-right',
					'label' => esc_html__('Right','wolverine')
				),
			);

			ob_start();
			?>
			<ul class="padding-wrapper">
				<?php foreach($padding_config as $key => $value): ?>
					<?php if ($allow[$key]): ?>
						<li>
							<label for="<?php echo esc_attr($field['id'] . '-' . $key ); ?>"><i class="<?php echo esc_html($value['icon']) ?>"></i></label>
							<input type="number" placeholder="<?php echo esc_attr($value['label']); ?>" id="<?php echo esc_attr($field['id']  . '-') . $key; ?>" name="<?php echo esc_attr($field['field_name']) . '[' . $key . ']'; ?>" value="<?php echo esc_attr($meta[$key]); ?>"/>
						</li>
					<?php endif;?>
				<?php endforeach; ?>
			</ul>
			<?php
			return ob_get_clean();
		}
	}
}
