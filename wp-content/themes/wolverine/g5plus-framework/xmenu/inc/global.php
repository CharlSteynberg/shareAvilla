<?php
function xmenu_get_transition() {
	return array(
		'none' => esc_html__('None','wolverine'),
		'x-animate-slide-up' => esc_html__('Slide Up','wolverine'),
		'x-animate-slide-down' => esc_html__('Slide Down','wolverine'),
		'x-animate-slide-left' => esc_html__('Slide Left','wolverine'),
		'x-animate-slide-right' => esc_html__('Slide Right','wolverine'),
		'x-animate-sign-flip' => esc_html__('Sign Flip','wolverine'),
	);
}

function xmenu_get_grid () {
	return array(
		'basic' => array(
			'text' => esc_html__('Basic','wolverine'),
			'options' => array(
				'auto' => esc_html__('Automatic','wolverine'),
				'x-col x-col-12-12' => esc_html__('Full Width','wolverine'),
			)
		),
		'halves' => array(
			'text' => esc_html__('Halves','wolverine'),
			'options' => array(
				'x-col x-col-6-12' => esc_html__('1/2','wolverine'),
			)
		),
		'thirds' => array(
			'text' => esc_html__('Thirds','wolverine'),
			'options' => array(
				'x-col x-col-4-12' => esc_html__('1/3','wolverine'),
				'x-col x-col-8-12' => esc_html__('2/3','wolverine'),
			)
		),
		'quarters' => array(
			'text' => esc_html__('Quarters','wolverine'),
			'options' => array(
				'x-col x-col-3-12' => esc_html__('1/4','wolverine'),
				'x-col x-col-9-12' => esc_html__('3/4','wolverine'),
			)
		),
		'fifths' => array(
			'text' => esc_html__('Fifths','wolverine'),
			'options' => array(
				'x-col x-col-2-10' => esc_html__('1/5','wolverine'),
				'x-col x-col-4-10' => esc_html__('2/5','wolverine'),
				'x-col x-col-6-10' => esc_html__('3/5','wolverine'),
				'x-col x-col-8-10' => esc_html__('4/5','wolverine'),
			)
		),
		'sixths' => array(
			'text' => esc_html__('Sixths','wolverine'),
			'options' => array(
				'x-col x-col-2-12' => esc_html__('1/6','wolverine'),
				'x-col x-col-10-12' => esc_html__('5/6','wolverine'),
			)
		),
		'sevenths' => array(
			'text' => esc_html__('Sevenths','wolverine'),
			'options' => array(
				'x-col x-col-1-7' => esc_html__('1/7','wolverine'),
				'x-col x-col-2-7' => esc_html__('2/7','wolverine'),
				'x-col x-col-3-7' => esc_html__('3/7','wolverine'),
				'x-col x-col-4-7' => esc_html__('4/7','wolverine'),
				'x-col x-col-5-7' => esc_html__('5/7','wolverine'),
				'x-col x-col-6-7' => esc_html__('6/7','wolverine'),
			)
		),
		'eighths' => array(
			'text' => esc_html__('Eighths','wolverine'),
			'options' => array(
				'x-col x-col-1-8' => esc_html__('1/8','wolverine'),
				'x-col x-col-3-8' => esc_html__('3/8','wolverine'),
				'x-col x-col-5-8' => esc_html__('5/8','wolverine'),
				'x-col x-col-7-8' => esc_html__('7/8','wolverine'),
			)
		),
		'ninths' => array(
			'text' => esc_html__('Ninths','wolverine'),
			'options' => array(
				'x-col x-col-1-9' => esc_html__('1/9','wolverine'),
				'x-col x-col-2-9' => esc_html__('2/9','wolverine'),
				'x-col x-col-4-9' => esc_html__('4/9','wolverine'),
				'x-col x-col-5-9' => esc_html__('5/9','wolverine'),
				'x-col x-col-7-9' => esc_html__('7/9','wolverine'),
				'x-col x-col-8-9' => esc_html__('8/9','wolverine'),
			)
		),
		'tenths' => array(
			'text' => esc_html__('Tenths','wolverine'),
			'options' => array(
				'x-col x-col-1-10' => esc_html__('1/10','wolverine'),
				'x-col x-col-3-10' => esc_html__('3/10','wolverine'),
				'x-col x-col-7-10' => esc_html__('7/10','wolverine'),
				'x-col x-col-9-10' => esc_html__('9/10','wolverine'),
			)
		),
		'elevenths' => array(
			'text' => esc_html__('Elevenths','wolverine'),
			'options' => array(
				'x-col x-col-1-11' => esc_html__('1/11','wolverine'),
				'x-col x-col-2-11' => esc_html__('2/11','wolverine'),
				'x-col x-col-3-11' => esc_html__('3/11','wolverine'),
				'x-col x-col-4-11' => esc_html__('4/11','wolverine'),
				'x-col x-col-5-11' => esc_html__('5/11','wolverine'),
				'x-col x-col-6-11' => esc_html__('6/11','wolverine'),
				'x-col x-col-7-11' => esc_html__('7/11','wolverine'),
				'x-col x-col-8-11' => esc_html__('8/11','wolverine'),
				'x-col x-col-9-11' => esc_html__('9/11','wolverine'),
				'x-col x-col-10-11' => esc_html__('10/11','wolverine'),
			)
		),
		'twelfths' => array(
			'text' => esc_html__('Twelfths','wolverine'),
			'options' => array(
				'x-col x-col-1-12' => esc_html__('1/12','wolverine'),
				'x-col x-col-5-12' => esc_html__('5/12','wolverine'),
				'x-col x-col-7-12' => esc_html__('7/12','wolverine'),
				'x-col x-col-11-12' => esc_html__('11/12','wolverine'),
			)
		),
	);
}


global $xmenu_item_settings;
$xmenu_item_settings = array(
	'general' => array(
		'text' => esc_html__('General','wolverine'),
		'icon' => 'fa fa-cogs',
		'config' => array(
			'general-heading' => array(
				'text' => esc_html__('General','wolverine'),
				'type' => 'heading'
			),
			'general-url' => array(
				'text' => esc_html__('URL','wolverine'),
				'type' => 'text',
				'std'  => '',
			),
			'general-title' => array(
				'text' => esc_html__('Navigation Label','wolverine'),
				'type' => 'text',
				'std'  => '',
			),
			'general-attr-title' => array(
				'text' => esc_html__('Title Attribute','wolverine'),
				'type' => 'text',
				'std'  => '',
			),
			'general-target' => array(
				'text' => esc_html__('Open link in a new window/tab','wolverine'),
				'type' => 'checkbox',
				'std'  => '',
				'value' => '_blank',
			),
			'general-classes' => array(
				'text' => esc_html__('CSS Classes (optional)','wolverine'),
				'type' => 'array',
				'std'  => '',
			),
			'general-xfn' => array(
				'text' => esc_html__('Link Relationship (XFN)','wolverine'),
				'type' => 'text',
				'std'  => '',
			),
			'general-description' => array(
				'text' => esc_html__('Description','wolverine'),
				'type' => 'textarea',
				'std'  => '',
			),
			'general-other-heading' => array(
				'text' => esc_html__('Other','wolverine'),
				'type' => 'heading'
			),
			'other-disable-text' => array(
				'text' => esc_html__('Disable Text','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'other-disable-menu-item' => array(
				'text' => esc_html__('Disable Menu Item','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'other-disable-link' => array(
				'text' => esc_html__('Disable Link','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'other-display-header-column' => array(
				'text' => esc_html__('Display as a Sub Menu column header','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'other-feature-text' => array(
				'text' => esc_html__('Menu Feature Text','wolverine'),
				'type' => 'text',
				'std' => ''
			),
		)
	),
	'icon' => array(
		'text' => esc_html__('Icon','wolverine'),
		'icon' => 'fa fa-qrcode',
		'config' => array(
			'icon-heading' => array(
				'text' => esc_html__('Icon','wolverine'),
				'type' => 'heading'
			),
			'icon-value' => array(
				'text' => esc_html__('Set Icon','wolverine'),
				'type' => 'icon',
				'std'  => '',
			),
			'icon-position' => array(
				'text' => esc_html__('Icon Position','wolverine'),
				'type' => 'select',
				'std'  => 'left',
				'options' => array(
					'left' => esc_html__('Left of Menu Text','wolverine'),
					'right' => esc_html__('Right of Menu Text','wolverine'),
				)
			),
			'icon-padding' => array(
				'text' => esc_html__('Padding Icon and Text Menu','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Padding between Icon and Text Menu (px). Do not include units','wolverine')
			)
		)
	),
	'image' => array(
		'text' => esc_html__('Image','wolverine'),
		'icon' => 'fa fa-picture-o',
		'config' => array(
			'image-heading' => array(
				'text' => esc_html__('Image','wolverine'),
				'type' => 'heading'
			),
			'image-url' => array(
				'text' => esc_html__('Image Url','wolverine'),
				'type' => 'image',
				'std'  => '',
			),
			'image-size' => array(
				'text' => esc_html__('Image Size','wolverine'),
				'type' => 'select',
				'std'  => 'inherit',
				'options' => xmenu_get_image_size()
			),
			'image-dimensions' => array(
				'text' => esc_html__('Image Dimensions','wolverine'),
				'type' => 'select',
				'std'  => 'inherit',
				'options' => array(
					'inherit' =>  esc_html__('Inherit from Menu Settings','wolverine'),
					'custom' => esc_html__('Custom','wolverine'),
				)
			),
			'image-width' => array(
				'text' => esc_html__('Image Width','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Image width attribute (px). Do not include units. Only valid if "Image Dimension" is set to "Custom" above','wolverine')
			),
			'image-height' => array(
				'text' => esc_html__('Image Height','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Image width attribute (px). Do not include units. Only valid if "Image Dimension" is set to "Custom" above','wolverine')
			),
			'image-layout' => array(
				'text' => esc_html__('Image Layout','wolverine'),
				'type' => 'select',
				'std'  => 'image-only',
				'options' => array(
					'image-only' => esc_html__('Image Only','wolverine'),
					'left' => esc_html__('Image Left','wolverine'),
					'right' => esc_html__('Image Right','wolverine'),
					'above' => esc_html__('Image Above','wolverine'),
					'below' => esc_html__('Image Below','wolverine'),
				)
			),
			'image-feature' => array(
				'text' => esc_html__('Use Feature Image','wolverine'),
				'type' => 'checkbox',
				'std'  => '',
				'des' => esc_html__('Use Feature Image from Post/Page Menu Item','wolverine')
			),
		)
	),

	'layout' => array(
		'text' => esc_html__('Layout','wolverine'),
		'icon' => 'fa fa-columns',
		'config' => array(
			'layout-heading' => array(
				'text' => esc_html__('Layout','wolverine'),
				'type' => 'heading'
			),
			'layout-width' => array(
				'text' => esc_html__('Menu Item Width','wolverine'),
				'type' => 'select-group',
				'std'  => 'auto',
				'options' => xmenu_get_grid()
			),
			'layout-text-align' => array(
				'text' => esc_html__('Item Content Alignment','wolverine'),
				'type' => 'select',
				'std'  => 'none',
				'options' => array(
					'none' => esc_html__('Default','wolverine'),
					'left' => esc_html__('Text Left','wolverine'),
					'center' => esc_html__('Text Center','wolverine'),
					'right' => esc_html__('Text Right','wolverine'),
				)
			),
			'layout-padding' => array(
				'text' => esc_html__('Padding','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set padding for menu item. Include the units.','wolverine'),
			),
			'layout-margin' => array(
				'text' => esc_html__('Margin','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set margin for menu item. Include the units.','wolverine'),
			),
			'layout-new-row' => array(
				'text' => esc_html__('New Row','wolverine'),
				'type' => 'checkbox',
				'std'  => ''
			),
		)
	),
	'submenu' => array(
		'text' => esc_html__('Sub Menu','wolverine'),
		'icon' => 'fa fa-list-alt',
		'config' => array(
			'submenu-heading' => array(
				'text' => esc_html__('Sub Menu','wolverine'),
				'type' => 'heading'
			),
			'submenu-type' => array(
				'text' => esc_html__('Sub Menu Type','wolverine'),
				'type' => 'select',
				'std'  => 'standard',
				'options' => array(
					'standard' => esc_html__('Standard','wolverine'),
					'multi-column' => esc_html__('Multi Column','wolverine'),
					/*'stack' => __('Stack','wolverine'),*/
					'tab' => esc_html__('Tab','wolverine'),
				)
			),
			'submenu-position' => array(
				'text' => esc_html__('Sub Menu Position','wolverine'),
				'type' => 'select',
				'std'  => '',
				'options' => array(
					'' => esc_html__('Automatic','wolverine'),
					'pos-left-menu-parent' => esc_html__('Left of Menu Parent','wolverine'),
					'pos-right-menu-parent' => esc_html__('Right of Menu Parent','wolverine'),
					'pos-center-menu-parent' => esc_html__('Center of Menu Parent','wolverine'),
					'pos-left-menu-bar' => esc_html__('Left of Menu Bar','wolverine'),
					'pos-right-menu-bar' => esc_html__('Right of Menu Bar','wolverine'),
					'pos-full' => esc_html__('Full Size','wolverine'),
				)
			),
			'submenu-width-custom' => array(
				'text' => esc_html__('Sub Menu Width Custom','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set custom Sub Menu Width. Include the units (px/em/%).','wolverine'),
			),
			'submenu-col-width-default' => array(
				'text' => esc_html__('Sub Menu Column Width Default','wolverine'),
				'type' => 'select-group',
				'std'  => 'auto',
				'options' => xmenu_get_grid()
			),
			'submenu-col-spacing-default' => array(
				'text' => esc_html__('Sub Menu Column Spacing Default','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set sub menu column spacing default. Do not include unit.','wolverine'),
			),
			'submenu-list-style' => array(
				'text' => esc_html__('Sub Menu List Style','wolverine'),
				'type' => 'select',
				'std'  => 'none',
				'options' => array(
					'none' => esc_html__('None','wolverine'),
					'disc' => esc_html__('Disc','wolverine'),
					'square' => esc_html__('Square','wolverine'),
					'circle' => esc_html__('Circle','wolverine'),
				)
			),
			'submenu-tab-position' => array(
				'text' => esc_html__('Tab Position','wolverine'),
				'type' => 'select',
				'std'  => 'left',
				'des' => esc_html__('Tab Position set to "Sub Menu Type" is "TAB".','wolverine'),
				'options' => array(
					'left' => esc_html__('Left','wolverine'),
					'right' => esc_html__('Right','wolverine'),
				)
			),
			'submenu-animation' => array(
				'text' => esc_html__('Sub Menu Animation','wolverine'),
				'type' => 'select',
				'std'  => 'x-animate-sign-flip',
				'options' => xmenu_get_transition()
			),
		)
	),
	'custom-content' => array(
		'text' => esc_html__('Custom Content','wolverine'),
		'icon' => 'fa fa-code',
		'config' => array(
			'custom-content-heading' => array(
				'text' => esc_html__('Custom Content','wolverine'),
				'type' => 'heading'
			),
			'custom-content-value' => array(
				'text' => esc_html__('Custom Content','wolverine'),
				'type' => 'textarea',
				'std'  => '',
				'des' => esc_html__('Can contain HTML and shortcodes','wolverine'),
				'height' => '300px'
			),
		)
	),
	'widget' => array(
		'text' => esc_html__('Widget Area','wolverine'),
		'icon' => 'fa-puzzle-piece',
		'config' => array(
			'widget-heading' => array(
				'text' => esc_html__('Widget Area','wolverine'),
				'type' => 'heading'
			),
			'widget-area' => array(
				'text' => esc_html__('Widget Area','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => __('Enter a name for your Widget Area, and a widget area specifically for this menu item will be automatically be created in the <a href="widgets.php" target="_blank">Widgets Screen</a>','wolverine'),
			),
		)
	),
	'customize-style' => array(
		'text' => esc_html__('Customize Style','wolverine'),
		'icon' => 'fa-paint-brush',
		'config' => array(
			'custom-style-menu-heading' => array(
				'text' => esc_html__('Menu Item','wolverine'),
				'type' => 'heading'
			),
			'custom-style-menu-bg-color' => array(
				'text' => esc_html__('Background Color','wolverine'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-menu-text-color' => array(
				'text' => esc_html__('Text Color','wolverine'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-menu-bg-color-active' => array(
				'text' => esc_html__('Background Color [Active]','wolverine'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-menu-text-color-active' => array(
				'text' => esc_html__('Text Color [Active]','wolverine'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-menu-bg-image' => array(
				'text' => esc_html__('Background Image','wolverine'),
				'type' => 'image',
				'std'  => '',
			),
			'custom-style-menu-bg-image-repeat' => array(
				'text' => esc_html__('Background Image Repeat','wolverine'),
				'type' => 'select',
				'std' => 'no-repeat',
				'hide-label' => 'true',
				'options' => array(
					'no-repeat' => esc_html__('no-repeat','wolverine'),
					'repeat' => esc_html__('repeat','wolverine'),
					'repeat-x' => esc_html__('repeat-x','wolverine'),
					'repeat-y' => esc_html__('repeat-y','wolverine')
				)
			),
			'custom-style-menu-bg-image-attachment' => array(
				'text' => esc_html__('Background Image Attachment','wolverine'),
				'type' => 'select',
				'std' => 'scroll',
				'hide-label' => 'true',
				'options' => array(
					'scroll' => esc_html__('scroll','wolverine'),
					'fixed' => esc_html__('fixed','wolverine')
				)
			),
			'custom-style-menu-bg-image-position' => array(
				'text' => esc_html__('Background Image Position','wolverine'),
				'type' => 'select',
				'std' => 'center',
				'hide-label' => 'true',
				'options' => array(
					'center' => esc_html__('center','wolverine'),
					'center left' => esc_html__('center left','wolverine'),
					'center right' => esc_html__('center right','wolverine'),
					'top left' => esc_html__('top left','wolverine'),
					'top center' => esc_html__('top center','wolverine'),
					'top right' => esc_html__('top right','wolverine'),
					'bottom left' => esc_html__('bottom left','wolverine'),
					'bottom center' => esc_html__('bottom center','wolverine'),
					'bottom right' => esc_html__('bottom right','wolverine')
				)
			),
			'custom-style-menu-bg-image-size' => array(
				'text' => esc_html__('Background Image Size','wolverine'),
				'type' => 'select',
				'std' => 'auto',
				'hide-label' => 'true',
				'options' => array(
					'auto' => esc_html__('Keep original','wolverine'),
					'100% auto' => esc_html__('Stretch to width','wolverine'),
					'auto 100%' => esc_html__('Stretch to height','wolverine'),
					'cover' => esc_html__('Cover','wolverine'),
					'contain' => esc_html__('Contain','wolverine')
				)
			),
			'custom-style-sub-menu-heading' => array(
				'text' => esc_html__('Sub Menu','wolverine'),
				'type' => 'heading'
			),
			'custom-style-sub-menu-bg-color' => array(
				'text' => esc_html__('Background Color','wolverine'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-sub-menu-text-color' => array(
				'text' => esc_html__('Text Color','wolverine'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-sub-menu-bg-image' => array(
				'text' => esc_html__('Background Image','wolverine'),
				'type' => 'image',
				'std'  => '',
			),
			'custom-style-sub-menu-bg-image-repeat' => array(
				'text' => esc_html__('Background Image Repeat','wolverine'),
				'type' => 'select',
				'std' => 'no-repeat',
				'hide-label' => 'true',
				'options' => array(
					'no-repeat' => esc_html__('no-repeat','wolverine'),
					'repeat' => esc_html__('repeat','wolverine'),
					'repeat-x' => esc_html__('repeat-x','wolverine'),
					'repeat-y' => esc_html__('repeat-y','wolverine')
				)
			),
			'custom-style-sub-menu-bg-image-attachment' => array(
				'text' => esc_html__('Background Image Attachment','wolverine'),
				'type' => 'select',
				'std' => 'scroll',
				'hide-label' => 'true',
				'options' => array(
					'scroll' => esc_html__('scroll','wolverine'),
					'fixed' => esc_html__('fixed','wolverine')
				)
			),
			'custom-style-sub-menu-bg-image-position' => array(
				'text' => esc_html__('Background Image Position','wolverine'),
				'type' => 'select',
				'std' => 'center',
				'hide-label' => 'true',
				'options' => array(
					'center' => esc_html__('center','wolverine'),
					'center left' => esc_html__('center left','wolverine'),
					'center right' => esc_html__('center right','wolverine'),
					'top left' => esc_html__('top left','wolverine'),
					'top center' => esc_html__('top center','wolverine'),
					'top right' => esc_html__('top right','wolverine'),
					'bottom left' => esc_html__('bottom left','wolverine'),
					'bottom center' => esc_html__('bottom center','wolverine'),
					'bottom right' => esc_html__('bottom right','wolverine')
				)
			),
			'custom-style-sub-menu-bg-image-size' => array(
				'text' => esc_html__('Background Image Size','wolverine'),
				'type' => 'select',
				'std' => 'auto',
				'hide-label' => 'true',
				'options' => array(
					'auto' => esc_html__('Keep original','wolverine'),
					'100% auto' => esc_html__('Stretch to width','wolverine'),
					'auto 100%' => esc_html__('Stretch to height','wolverine'),
					'cover' => esc_html__('Cover','wolverine'),
					'contain' => esc_html__('Contain','wolverine')
				)
			),
			'custom-style-col-min-width' => array(
				'text' => esc_html__('Column Min Width','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set min-width for Sub Menu Column (px). Not include the units.','wolverine'),
			),
			'custom-style-padding' => array(
				'text' => esc_html__('Padding','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set padding for Sub Menu. Include the units.','wolverine'),
			),

			'custom-style-feature-menu-text-heading' => array(
				'text' => esc_html__('Menu Feature Text','wolverine'),
				'type' => 'heading'
			),
			'custom-style-feature-menu-text-type' => array(
				'text' => esc_html__('Feature Menu Type','wolverine'),
				'type' => 'select',
				'std'  => '',
				'options' => array(
					'' => esc_html__('Standard','wolverine'),
					'x-feature-menu-not-float' => esc_html__('Not Float','wolverine')
				)
			),
			'custom-style-feature-menu-text-bg-color' => array(
				'text' => esc_html__('Background Color','wolverine'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-feature-menu-text-color' => array(
				'text' => esc_html__('Text Color','wolverine'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-feature-menu-text-top' => array(
				'text' => esc_html__('Position Top','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des'  => esc_html__('Position Top (px) Feature Menu Text. Do not include units.','wolverine'),
			),
			'custom-style-feature-menu-text-left' => array(
				'text' => esc_html__('Position Left','wolverine'),
				'type' => 'text',
				'std'  => '',
				'des'  => esc_html__('Position Left (px) Feature Menu Text. Do not include units.','wolverine'),
			),
		)
	),
	'responsive' => array(
		'text' => esc_html__('Responsive','wolverine'),
		'icon' => 'fa-desktop',
		'config' => array(
			'responsive-heading' => array(
				'text' => esc_html__('Responsive','wolverine'),
				'type' => 'heading'
			),
			'responsive-hide-mobile-css' => array(
				'text' => esc_html__('Hide item on mobile via CSS','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-desktop-css' => array(
				'text' => esc_html__('Hide item on desktop via CSS','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-mobile-css-submenu' => array(
				'text' => esc_html__('Hide sub menu on mobile via CSS','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-mobile' => array(
				'text' => esc_html__('Remove this item when mobile device is detected via wp_is_mobile()','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-desktop' => array(
				'text' => esc_html__('Remove this item when desktop device is NOT detected via wp_is_mobile()','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-mobile-submenu' => array(
				'text' => esc_html__('Remove sub menu when desktop device is NOT detected via wp_is_mobile()','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
		),
	),
	'responsive' => array(
		'text' => esc_html__('Responsive','wolverine'),
		'icon' => 'fa-desktop',
		'config' => array(
			'responsive-heading' => array(
				'text' => esc_html__('Responsive','wolverine'),
				'type' => 'heading'
			),
			'responsive-hide-mobile-css' => array(
				'text' => esc_html__('Hide item on mobile via CSS','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-desktop-css' => array(
				'text' => esc_html__('Hide item on desktop via CSS','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-mobile-css-submenu' => array(
				'text' => esc_html__('Hide sub menu on mobile via CSS','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-desktop-css-submenu' => array(
				'text' => esc_html__('Hide sub menu on desktop via CSS','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			/*'responsive-remove-mobile' => array(
				'text' => esc_html__('Remove this item when mobile device is detected via wp_is_mobile()','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-desktop' => array(
				'text' => esc_html__('Remove this item when desktop device is NOT detected via wp_is_mobile()','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-mobile-submenu' => array(
				'text' => esc_html__('Remove sub menu when desktop device is NOT detected via wp_is_mobile()','wolverine'),
				'type' => 'checkbox',
				'std' => ''
			),*/
		),
	)
);

global $xmenu_item_defaults;
$xmenu_item_defaults = xmenu_get_item_defaults($xmenu_item_settings);

function xmenu_get_item_defaults($items_setting, $defaults = array()) {
	if (!$defaults) {
		$defaults = array(
			'nosave-type_label' => '',
			'nosave-type' => '',
			'nosave-change' => 0
		);
	}

	foreach ($items_setting as $seting_key => $setting) {
		foreach ($setting['config'] as $key => $value) {
			if (isset($value['config']) && $value['config']) {

			}
			else {
				if ($value['type'] != 'heading') {
					$defaults[$key] = $value['std'];
				}
			}

		}
	}
	return $defaults;
}
function xmenu_get_image_size($is_setting = 0) {
	global $_wp_additional_image_sizes;

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {

		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

			$sizes[ $_size ] = array(
				'width' => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
			);

		}

	}
	$image_size = array();
	if (!$is_setting) {
		$image_size ['inherit'] = esc_html__('Inherit from Menu Setting','wolverine');
	}
	$image_size ['full'] = esc_html__('Full Size','wolverine');
	foreach ($sizes as $key => $value) {
		$image_size[$key] = ucfirst($key) . ' (' . $value['width'] . ' x ' . $value['height'] .')' . ($value['crop'] ? '[cropped]' : '') ;
	}
	return $image_size;
}