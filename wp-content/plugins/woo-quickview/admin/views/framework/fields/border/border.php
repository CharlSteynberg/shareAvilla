<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

/**
 *
 * Field: Border
 *
 * @since 1.0
 * @version 1.0
 */
class SP_WQV_Framework_Option_border extends SP_WQV_Framework_Options {

	public function __construct( $field, $value = '', $unique = '' ) {
		parent::__construct( $field, $value, $unique );
	}

	public function output() {

		echo $this->element_before();

		$defaults_value = array(
			'width'       => '',
			'style'       => '',
			'color'       => '',
			'hover_color' => '',
		);

		$value = wp_parse_args( $this->element_value(), $defaults_value );

		// Container.
		echo '<div class="sp_wqv_border_field" data-id="' . $this->field['id'] . '">';

			echo sp_wqv_add_element(
				array(
					'pseudo'     => true,
					'type'       => 'number',
					'name'       => $this->element_name( '[width]' ),
					'value'      => $value['width'],
					'default'    => ( isset( $this->field['default']['width'] ) ) ? $this->field['default']['width'] : '',
					'wrap_class' => 'small-input sp-border-width',
					'before'     => 'Width<br>',
					'after'      => '(px)',
					'attributes' => array(
						'min'   => 0,
						'title' => __( 'Border Width', 'woo-quick-view' ),
					),
				)
			);
			echo sp_wqv_add_element(
				array(
					'pseudo'     => true,
					'type'       => 'select_typo',
					'name'       => $this->element_name( '[style]' ),
					'value'      => $value['style'],
					'default'    => ( isset( $this->field['default']['style'] ) ) ? $this->field['default']['style'] : '',
					'wrap_class' => 'small-input sp-border-style sp-wqv-select-wrapper',
					'class'      => 'sp-wqv-select-css',
					'before'     => 'Style<br>',
					'attributes' => array(
						'title' => __( 'Border Style', 'woo-quick-view' ),
					),
					'options'    => array(
						'none'   => __( 'None', 'woo-quick-view' ),
						'solid'  => __( 'Solid', 'woo-quick-view' ),
						'dotted' => __( 'Dotted', 'woo-quick-view' ),
						'dashed' => __( 'Dashed', 'woo-quick-view' ),
						'double' => __( 'Double', 'woo-quick-view' ),
						'groove' => __( 'Groove', 'woo-quick-view' ),
						'ridge'  => __( 'Ridge', 'woo-quick-view' ),
						'inset'  => __( 'Inset', 'woo-quick-view' ),
						'outset' => __( 'Outset', 'woo-quick-view' ),
					),
				)
			);
			echo sp_wqv_add_element(
				array(
					'pseudo'     => true,
					'type'       => 'color_picker',
					'name'       => $this->element_name( '[color]' ),
					'value'      => $value['color'],
					'default'    => ( isset( $this->field['default']['color'] ) ) ? $this->field['default']['color'] : '',
					'wrap_class' => 'small-input sp-border-color',
					'before'     => 'Color<br>',
					'attributes' => array(
						'title' => __( 'Border Color', 'woo-quick-view' ),
					),
				)
			);
		if ( isset( $this->field['hover_color'] ) && $this->field['hover_color'] == true ) {
			echo sp_wqv_add_element(
				array(
					'pseudo'     => true,
					'type'       => 'color_picker',
					'name'       => $this->element_name( '[hover_color]' ),
					'value'      => $value['hover_color'],
					'default'    => ( isset( $this->field['default']['hover_color'] ) ) ? $this->field['default']['hover_color'] : '',
					'wrap_class' => 'small-input sp-border-hover-color',
					'before'     => 'Hover Color<br>',
					'attributes' => array(
						'title' => __( 'Border Hover Color', 'woo-quick-view' ),
					),
				)
			);
		}

		// end container.
		echo '</div>';

		echo $this->element_after();

	}

}
