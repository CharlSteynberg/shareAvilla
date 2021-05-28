<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings = array(
	'menu_title'      => __( 'Woo QuickView', 'woo-quick-view' ),
	// 'menu_parent'     => 'edit.php?post_type=spt_testimonial',
	'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
	'menu_slug'       => 'wqv_settings',
	'ajax_save'       => true,
	'show_reset_all'  => false,
	'menu_icon'		  => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNy4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhbHF1ZV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNTEyIDUxMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8Zz4NCgkJPHBhdGggZmlsbD0iI0EwQTVBQSIgZD0iTTIyMy42MTUsNDQyLjQ2Yy0xMjAuMTY3LDAtMjE3LjY3My05Ny41MDctMjE3LjY3My0yMTcuNjczUzEwMy40NDgsNy44LDIyMy42MTUsNy44DQoJCQlzMjE3LjY3Myw5Ny41MDcsMjE3LjY3MywyMTcuNjczUzM0My43ODIsNDQyLjQ2LDIyMy42MTUsNDQyLjQ2eiBNMjIzLjYxNSw0OC4zMTNjLTk3LjUwNywwLTE3Ni40NzMsNzguOTY3LTE3Ni40NzMsMTc2LjQ3Mw0KCQkJUzEyNi4xMDgsNDAxLjI2LDIyMy42MTUsNDAxLjI2czE3Ni40NzMtNzguOTY3LDE3Ni40NzMtMTc2LjQ3M1MzMjEuMTIyLDQ4LjMxMywyMjMuNjE1LDQ4LjMxM3oiLz4NCgk8L2c+DQoJPGc+DQoJCTxwYXRoIGZpbGw9IiNBMEE1QUEiIGQ9Ik00ODYuNjA4LDUwMi4yYy00LjgwNywwLTEwLjMtMi4wNi0xMy43MzMtNS40OTNMMzU0LjA4MiwzODQuMDkzYy04LjI0LTcuNTUzLTguMjQtMjAuNi0wLjY4Ny0yOC44NA0KCQkJYzcuNTUzLTguMjQsMjAuNi04LjI0LDI4Ljg0LTAuNjg3TDUwMS4wMjgsNDY3LjE4YzguMjQsNy41NTMsOC4yNCwyMC42LDAuNjg3LDI4Ljg0QzQ5Ny41OTUsNTAwLjE0LDQ5Mi4xMDIsNTAyLjIsNDg2LjYwOCw1MDIuMnoNCgkJCSIvPg0KCTwvZz4NCgk8Zz4NCgkJPHBhdGggZmlsbD0iI0EwQTVBQSIgZD0iTTMzOC45NzUsMjM5LjIwN2MtNi4xOCwwLTEyLjM2LTMuNDMzLTE1LjEwNy0xMC4zYy0xNy4xNjctNDAuNTEzLTU2LjMwNy02NS45Mi0xMDAuMjUzLTY1LjkyDQoJCQlzLTgzLjA4NywyNi4wOTMtMTAwLjI1Myw2NS45MmMtMy40MzMsOC4yNC0xMy4wNDcsMTIuMzYtMjEuMjg3LDguOTI3Yy04LjI0LTMuNDMzLTEyLjM2LTEzLjA0Ny04LjkyNy0yMS4yODcNCgkJCWMyMS45NzMtNTIuMTg3LDczLjQ3My04Ni41MiwxMzAuNDY3LTg2LjUyczEwNy44MDcsMzMuNjQ3LDEzMC40NjcsODYuNTJjMy40MzMsOC4yNC0wLjY4NywxNy44NTMtOC45MjcsMjEuMjg3DQoJCQlDMzQzLjA5NSwyMzguNTIsMzQxLjAzNSwyMzkuMjA3LDMzOC45NzUsMjM5LjIwN3oiLz4NCgk8L2c+DQoJPGc+DQoJCTxwYXRoIGZpbGw9IiNBMEE1QUEiIGQ9Ik0yMjMuNjE1LDMxNi44Yy01Ni45OTMsMC0xMDcuODA3LTMzLjY0Ny0xMzAuNDY3LTg2LjUyYy0zLjQzMy04LjI0LDAuNjg3LTE3Ljg1Myw4LjkyNy0yMS4yODcNCgkJCXMxNy44NTMsMC42ODcsMjEuMjg3LDguOTI3YzE3LjE2Nyw0MC41MTMsNTYuMzA3LDY1LjkyLDEwMC4yNTMsNjUuOTJzODMuMDg3LTI2LjA5MywxMDAuMjUzLTY1LjkyDQoJCQljMy40MzMtOC4yNCwxMy4wNDctMTIuMzYsMjEuMjg3LTguOTI3YzguMjQsMy40MzMsMTIuMzYsMTMuMDQ3LDguOTI3LDIxLjI4N0MzMzIuMTA4LDI4Mi40NjcsMjgwLjYwOCwzMTYuOCwyMjMuNjE1LDMxNi44eiIvPg0KCTwvZz4NCgk8Zz4NCgkJPHBhdGggZmlsbD0iI0EwQTVBQSIgZD0iTTIyMy42MTUsMjc1LjZjLTI4Ljg0LDAtNTIuMTg3LTIzLjM0Ny01Mi4xODctNTIuMTg3czIzLjM0Ny01Mi4xODcsNTIuMTg3LTUyLjE4Nw0KCQkJczUyLjE4NywyMy4zNDcsNTIuMTg3LDUyLjE4N1MyNTIuNDU1LDI3NS42LDIyMy42MTUsMjc1LjZ6IE0yMjMuNjE1LDIwMy41Yy0xMC45ODcsMC0xOS45MTMsOC45MjctMTkuOTEzLDE5LjkxMw0KCQkJYzAsMTAuOTg3LDguOTI3LDE5LjkxMywxOS45MTMsMTkuOTEzczE5LjkxMy04LjkyNywxOS45MTMtMTkuOTEzQzI0My41MjgsMjEyLjQyNywyMzQuNjAyLDIwMy41LDIyMy42MTUsMjAzLjV6Ii8+DQoJPC9nPg0KPC9nPg0KPC9zdmc+DQo=',
	'framework_title' => __( 'WooCommerce Quick View', 'woo-quick-view' ),
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// Quick View Button Settings.
$options[] = array(
	'name'   => 'quick_view_btn_settings',
	'title'  => __( 'Button Settings', 'woo-quick-view' ),
	'icon'   => 'fa fa-toggle-off',

	// begin: fields.
	'fields' => array(
		array(
			'id'         => 'wqv_quick_view_button_position',
			'type'       => 'select',
			'title'      => __( 'Quick View Button Position', 'woo-quick-view' ),
			'desc'       => __( 'Select quick view button position.', 'woo-quick-view' ),
			'default'    => 'after_add_to_cart',
			'options'	 => array(
				'before_add_to_cart' => __( 'Before Add to cart button', 'woo-quick-view' ),
				'after_add_to_cart'  => __( 'After add to cart button', 'woo-quick-view' ),
				'none'               => __( 'None', 'woo-quick-view' ),
			),
		),
		array(
			'id'         => 'wqv_quick_view_button_color',
			'type'       => 'color_set',
			'title'      => __( 'Button Color', 'woo-quick-view' ),
			'desc'       => __( 'Set quick view button color.', 'woo-quick-view' ),
			'default'    => array(
				'title1'  => 'Color',
				'color1'  => '#ffffff',
				'title2'  => 'Hover Color',
				'color2'  => '#ffffff',
				'title3'  => 'Background',
				'color3'  => '#994294',
				'title4'  => 'Hover Background',
				'color4'  => '#7d3179',
			),
			'color1'     => true,
			'color2'     => true,
			'color3'     => true,
			'color4'     => true,
		),
		array(
			'id'         => 'wqv_quick_view_button_padding',
			'type'       => 'margin',
			'title'      => __( 'Button Padding', 'woo-quick-view' ),
			'desc'       => __( 'Set quick view button padding.', 'woo-quick-view' ),
			'default'    => array(
				'left'   => '17',
				'right'  => '17',
				'top'    => '9',
				'bottom' => '9',
			),
			'left'      => true,
			'right'     => true,
			'top'       => true,
			'bottom'    => true,
		),
		array(
			'id'         => 'wqv_quick_view_button_border',
			'type'       => 'border',
			'title'      => __( 'Button Border', 'woo-quick-view' ),
			'desc'       => __( 'Set quick view button border.', 'woo-quick-view' ),
			'default'    => array(
				'width'       => '0',
				'style'       => 'solid',
				'color'       => '#994294',
				'hover_color' => '#7d3179',
			),
			'hover_color'     => true,
		),
		array(
			'id'         => 'wqv_quick_view_button_text',
			'type'       => 'text',
			'title'      => __( 'Quick View Button Label', 'woo-quick-view' ),
			'desc'       => __( 'Type quick view button custom label.', 'woo-quick-view' ),
			'default'    => 'Quick View',
		),

	), // end: fields.
);

// ----------------------------------------
// Popup Settings -
// ----------------------------------------
$options[] = array(
	'name'   => 'popup_settings',
	'title'  => __( 'Popup Settings', 'woo-quick-view' ),
	'icon'   => 'fa fa-external-link',

	// begin: fields.
	'fields' => array(

		array(
			'id'         => 'wqv_popup_overlay_bg',
			'type'       => 'color_picker',
			'title'      => __( 'Popup Overlay Background', 'woo-quick-view' ),
			'desc'       => __( 'Set popup overlay background color.', 'woo-quick-view' ),
			'default'    => 'rgba(11,11,11,0.8)',
		),
		array(
			'id'         => 'wqv_popup_effect',
			'type'       => 'select',
			'title'      => __( 'Popup Effect', 'woo-quick-view' ),
			'desc'       => __( 'Select popup effect.', 'woo-quick-view' ),
			'default'    => 'mfp-zoom-in',
			'options'	 => array(
				'mfp-fade'            => 'Fade',
				'mfp-zoom-in'         => 'Zoom in',
				'mfp-zoom-out'        => 'Zoom out',
				'mfp-newspaper'       => 'Newspaper',
				'mfp-move-horizontal' => 'Move horizontal',
				'mfp-3d-unfold'       => '3d unfold',
				'mfp-slide-bottom'    => 'Slide bottom',
			),
		),
		array(
			'id'         => 'wqv_popup_close_button',
			'type'       => 'switcher',
			'title'      => __( 'Popup Close Button', 'woo-quick-view' ),
			'desc'       => __( 'Show/hide popup close button.', 'woo-quick-view' ),
			'default'    => true,
		),
		array(
			'id'         => 'wqv_popup_close_btn_color',
			'type'       => 'color_set',
			'title'      => __( 'Close Button Icon Color', 'woo-quick-view' ),
			'desc'       => __( 'Set popup close button icon color.', 'woo-quick-view' ),
			'default'    => array(
				'title1'  => __( 'Color', 'woo-quick-view' ),
				'color1'  => '#444444',
				'title2'  => __( 'Hover Color', 'woo-quick-view' ),
				'color2'  => '#994294',
			),
			'color1'     => true,
			'color2'     => true,
			'dependency' => array( 'wqv_popup_close_button', '==', 'true' ),
		),
		array(
			'id'         => 'wqv_popup_close_icon_size',
			'type'       => 'number',
			'title'      => __( 'Close Button Icon Size', 'woo-quick-view' ),
			'desc'       => __( 'Set popup close button icon size.', 'woo-quick-view' ),
			'default'    => '18',
			'after'     => 'px',
			'attributes' => array(
				'min' => 0,
				'max' => 70,
			),
			'dependency' => array( 'wqv_popup_close_button', '==', 'true' ),
		),
		array(
			'type'    => 'subheading',
			'content' => __( 'Popup Product Content', 'woo-quick-view' ),
		),
		array(
			'id'         => 'wqv_rating_start_color',
			'type'       => 'color_set',
			'title'      => __( 'Rating Color', 'woo-quick-view' ),
			'desc'       => __( 'Set product star rating color.', 'woo-quick-view' ),
			'default'    => array(
				'title1'  => 'Empty Color',
				'color1'  => '#dadada',
				'title2'  => 'Full Color',
				'color2'  => '#ff9800',
			),
			'color1'     => true,
			'color2'     => true,
		),
		array(
			'id'         => 'wqv_add_to_cart_btn_color',
			'type'       => 'color_set',
			'title'      => __( 'Add to Cart Button Background', 'woo-quick-view' ),
			'desc'       => __( 'Set product add to cart button background color.', 'woo-quick-view' ),
			'default'    => array(
				'title1'  => __( 'Color', 'woo-quick-view' ),
				'color1'  => '#ffffff',
				'title2'  => __( 'Hover Color', 'woo-quick-view' ),
				'color2'  => '#ffffff',
				'title3'  => __( 'Background', 'woo-quick-view' ),
				'color3'  => '#333333',
				'title4'  => __( 'Hover Background', 'woo-quick-view' ),
				'color4'  => '#1a1a1a',
			),
			'color1'     => true,
			'color2'     => true,
			'color3'     => true,
			'color4'     => true,
		),
		array(
			'id'         => 'wqv_add_to_cart_btn_padding',
			'type'       => 'margin',
			'title'      => __( 'Add to Cart Button Padding', 'woo-quick-view' ),
			'desc'       => __( 'Set product add to cart button padding.', 'woo-quick-view' ),
			'default'    => array(
				'left'   => '21',
				'right'  => '21',
				'top'    => '0',
				'bottom' => '0',
			),
			'left'      => true,
			'right'     => true,
			'top'       => true,
			'bottom'    => true,
		),
		array(
			'id'         => 'wqv_popup_box_bg',
			'type'       => 'color_picker',
			'title'      => __( 'Popup Window Background', 'woo-quick-view' ),
			'desc'       => __( 'Set popup window background.', 'woo-quick-view' ),
			'default'    => '#ffffff',
		),

	), // end: fields.
);

// ------------------------------
// Other Options                   -
// ------------------------------
$options[] = array(
	'name'   => 'other_options_section',
	'title'  => __( 'Other Options', 'woo-quick-view' ),
	'icon'   => 'fa fa-cogs',
	'fields' => array(
		array(
			'id'    => 'wqv_custom_css',
			'type'  => 'textarea',
			'title' => __( 'Custom CSS', 'woo-quick-view' ),
			'desc'  => __( 'Type your custom css.', 'woo-quick-view' ),
		),
	),
);


SP_WQV_Framework::instance( $settings, $options );
