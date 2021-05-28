<?php
// GET CUSTOM CSS VARIABLE FONT
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_font')) {
	function g5plus_custom_css_variable_font() {
		$fonts = (object)array();

		$fonts->menu_font = 'Montserrat';
		$menu_font = g5plus_get_option('menu_font',array(
			'font-family'=>'Montserrat',
		));
		if (is_array($menu_font) && isset($menu_font['font-family']) && !empty($menu_font['font-family'])) {
			$fonts->menu_font = $menu_font['font-family'];
		}

		$fonts->primary_font = 'Raleway';
		$body_font = g5plus_get_option('body_font',array(
			'font-size'=>'13px',
			'font-family'=>'Raleway',
			'font-weight'=>'400',
		));
		if (is_array($body_font) && isset($body_font['font-family']) && !empty($body_font['font-family'])) {
			$fonts->primary_font = $body_font['font-family'];
		}

		$fonts->secondary_font = 'Montserrat';
		$secondary_font = g5plus_get_option('secondary_font',array(
			'font-family'=>'Montserrat',
		));
		if (is_array($secondary_font) && isset($secondary_font['font-family']) && !empty($secondary_font['font-family'])) {
			$fonts->secondary_font = $secondary_font['font-family'];
		}

		$fonts->other_font = 'Playfair Display';
		$other_font = g5plus_get_option('other_font',array(
			'font-family'=>'Playfair Display',
		));
		if (is_array($other_font) && isset($other_font['font-family']) && ! empty($other_font['font-family'])) {
			$fonts->other_font = $other_font['font-family'];
		}

		return $fonts;
	}
}

// GET CUSTOM CSS VARIABLE LOGO
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_logo')) {
	function g5plus_custom_css_variable_logo($page_id = 0) {
		$prefix = 'g5plus_';

		$logo = (object)array();

		// GET logo_max_height, logo_padding
		$g5plus_header_layout = '';
		if (!empty($page_id)) {
			$g5plus_header_layout = g5plus_rwmb_meta($prefix . 'header_layout', array(), $page_id);
		}
		if (($g5plus_header_layout === false) || ($g5plus_header_layout === '') || ($g5plus_header_layout == '-1')) {
			$g5plus_header_layout = g5plus_get_option('header_layout','header-2');
		}

		$logo->logo_max_height = '92px';
		$logo->logo_padding_top = '10px';
		$logo->logo_padding_bottom = '10px';
		$logo->main_menu_height = '92px';

		$logo_matrix = array(
			'header-1' => array(66, 15, 15),
			'header-2' => array(120, 15, 15, 70),
			'header-3' => array(90, 25, 25),
			'header-4' => array(180, 60, 20, 60),
			'header-5' => array(228, 60, 60, 60),
			'header-6' => array(228, 60, 60, 60),
			'header-7' => array(200, 30, 30, 46),
		);

		if (isset($logo_matrix[$g5plus_header_layout])) {
			$logo->logo_max_height = $logo_matrix[$g5plus_header_layout][0] . 'px';
			$logo->logo_padding_top = $logo_matrix[$g5plus_header_layout][1] . 'px';
			$logo->logo_padding_bottom = $logo_matrix[$g5plus_header_layout][2] . 'px';
			if (isset($logo_matrix[$g5plus_header_layout][3])) {
				$logo->main_menu_height = $logo_matrix[$g5plus_header_layout][3] . 'px';
			}
		}

		// Get logo max height
		$logo_max_height = g5plus_get_option('logo_max_height');
		if (!empty($page_id)) {
			$logo->logo_max_height = g5plus_rwmb_meta($prefix . 'logo_max_height', array(), $page_id);
			if (($logo->logo_max_height === false) || ($logo->logo_max_height === '') || ($logo->logo_max_height == '-1')) {
				if (is_array($logo_max_height) && isset($logo_max_height['height']) && ! empty($logo_max_height['height']) && ($logo_max_height['height'] != 'px')) {
					$logo->logo_max_height = $logo_max_height['height'];
				}
				else {
					$logo->logo_max_height = $logo_matrix[$g5plus_header_layout][0] . 'px';
				}
			}
			else {
				$logo->logo_max_height .= 'px';
			}
		}
		else {
			if (is_array($logo_max_height) && isset($logo_max_height['height']) && ! empty($logo_max_height['height']) && ($logo_max_height['height'] != 'px')) {
				$logo->logo_max_height = $logo_max_height['height'];
			}
		}

		// get logo padding
		$logo_padding = g5plus_get_option('logo_padding');
		if (!empty($page_id)) {
			$logo->logo_padding_top = g5plus_rwmb_meta($prefix . 'logo_padding_top', array(), $page_id);

			if (($logo->logo_padding_top === false) || ($logo->logo_padding_top === '') || ($logo->logo_padding_top == '-1')) {
				if (is_array($logo_padding)
					&& isset($logo_padding['padding-top'])
				    && !empty($logo_padding['padding-top'])) {
					$logo->logo_padding_top = $logo_padding['padding-top'];
				}
				else {
					$logo->logo_padding_top = $logo_matrix[$g5plus_header_layout][1] . 'px';
				}
			}
			else {
				$logo->logo_padding_top .= 'px';
			}


			$logo->logo_padding_bottom = g5plus_rwmb_meta($prefix . 'logo_padding_bottom', array(), $page_id);

			if (($logo->logo_padding_bottom === false) || ($logo->logo_padding_bottom === '') || ($logo->logo_padding_bottom == '-1')) {

				if (is_array($logo_padding)
					&& isset($logo_padding['padding-bottom'])
				    && !empty($logo_padding['padding-bottom'])) {
					$logo->logo_padding_bottom = $logo_padding['padding-bottom'];
				}
				else {
					$logo->logo_padding_bottom = $logo_matrix[$g5plus_header_layout][2] . 'px';
				}
			}
			else {
				$logo->logo_padding_bottom .= 'px';
			}

		}
		else {
			if (is_array($logo_padding)) {

				if (isset($logo_padding['padding-top']) && !empty($logo_padding['padding-top'])) {
					$logo->logo_padding_top = $logo_padding['padding-top'];
				}
				if (isset($logo_padding['padding-bottom']) && !empty($logo_padding['padding-bottom'])) {
					$logo->logo_padding_bottom = $logo_padding['padding-bottom'];
				}
			}
		}

		if (!isset($logo_matrix[$g5plus_header_layout][3])) {
			$logo->main_menu_height = (str_replace('px', '', $logo->logo_max_height)) . 'px';
		}

		return $logo;
	}
}

// GET CUSTOM CSS VARIABLE HEADER
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_header')) {
	function g5plus_custom_css_variable_header($page_id = 0) {
		$prefix = 'g5plus_';

		$header = (object)array();

		$header->header_nav_bg_color_color = '#f4f4f4';
		$header->header_nav_bg_color_opacity = 1;
		$header->header_nav_text_color = '#fff';

		// Set header scheme
		$header_nav_scheme = g5plus_rwmb_meta($prefix . 'header_nav_scheme', array(), $page_id);
		if ((!empty($page_id)) && ($header_nav_scheme != '-1') && ($header_nav_scheme != '') && ($header_nav_scheme !== false)) {
			switch ($header_nav_scheme) {
				case 'gray':
					$header->header_nav_bg_color_color = '#f4f4f4';
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#191919';
					break;
				case 'light':
					$header->header_nav_bg_color_color = '#fff';
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#191919';
					break;
				case 'dark':
					$header->header_nav_bg_color_color = '#222';
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#f0f0f0';
					break;
				default:
					if (g5plus_rwmb_meta($prefix . 'header_nav_bg_color_color', array(), $page_id) != '') {
						$header->header_nav_bg_color_color = g5plus_rwmb_meta($prefix . 'header_nav_bg_color_color', array(), $page_id);
					}
					$header->header_nav_bg_color_opacity = g5plus_rwmb_meta($prefix . 'header_nav_bg_color_opacity', array(), $page_id);

					if (($header->header_nav_bg_color_opacity == '')) {
						$header->header_nav_bg_color_opacity = 1;
					}
					else {
						$header->header_nav_bg_color_opacity = $header->header_nav_bg_color_opacity/100.0;
					}

					$header->header_nav_text_color = g5plus_rwmb_meta($prefix . 'header_nav_text_color', array(), $page_id);
					if (($header->header_nav_text_color == '')) {
						$header->header_nav_text_color = '#222';
					}
					break;
			}
		}
		else {
			$header_nav_scheme = g5plus_get_option('header_nav_scheme','gray');
			switch ($header_nav_scheme) {
				case 'gray':
					$header->header_nav_bg_color_color = '#f4f4f4';
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#191919';
					break;
				case 'light':
					$header->header_nav_bg_color_color = '#fff';
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#191919';
					break;
				case 'dark':
					$header->header_nav_bg_color_color = '#222';
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#f0f0f0';
					break;
				default:
					$header_nav_bg_color = g5plus_get_option('header_nav_bg_color',array(
						'color'     => '#f4f4f4',
						'alpha'     => 1
					));

					if (is_array($header_nav_bg_color)) {
						if (isset($header_nav_bg_color['alpha'])) {
							$header->header_nav_bg_color_opacity = $header_nav_bg_color['alpha'];
						}
						if (isset($header_nav_bg_color['color'])) {
							$header->header_nav_bg_color_color =$header_nav_bg_color['color'];
						}
					}

					$header_nav_text_color = g5plus_get_option('header_nav_text_color','#222');
					if (!empty($header_nav_text_color)) {
						$header->header_nav_text_color = $header_nav_text_color;
					}
					break;
			}
		}

		$header->header_nav_bg_color = g5plus_hex2rgba($header->header_nav_bg_color_color, $header->header_nav_bg_color_opacity);
		// Set header background css
		$header_background_enable = g5plus_rwmb_meta($prefix . 'header_background_enable', array(), $page_id);
		$header->header_background_css = '.header-main-background {}';
		$header->header_background_color = '#fff';
		$header->header_background_color_rgba = '#fff';
		$header_background = g5plus_get_option('header_background',array(
			'background-color' => '#fff',
		));
		$header_background_color_opacity = g5plus_get_option('header_background_color_opacity',100);
		if ((!empty($page_id))) {
			if (($header_background_enable == '1')) {
				$header_background_color = g5plus_rwmb_meta($prefix . 'header_background_color', array(), $page_id);
				$header_background_image = g5plus_rwmb_meta($prefix . 'header_background_image', 'type=image_advanced', $page_id);
				$header_background_repeat = g5plus_rwmb_meta($prefix . 'header_background_repeat', array(), $page_id);
				$header_background_position = g5plus_rwmb_meta($prefix . 'header_background_position', array(), $page_id);
				$header_background_size = g5plus_rwmb_meta($prefix . 'header_background_size', array(), $page_id);
				$header_background_attachment = g5plus_rwmb_meta($prefix . 'header_background_attachment', array(), $page_id);
				$header_background_color_opacity = g5plus_rwmb_meta($prefix . 'header_background_color_opacity', array(), $page_id);

				$header_background_image_id = g5plus_rwmb_meta($prefix . 'header_background_image', array(), $page_id);
				if (is_array($header_background_image) && array_key_exists($header_background_image_id, $header_background_image)) {
					$header_background_image = $header_background_image[$header_background_image_id];
				}

				if (($header_background_color != '' ) && ($header_background_color_opacity != '')) {
					$header_background_color = g5plus_hex2rgba($header_background_color, $header_background_color_opacity / 100.0);
				}

				$header->header_background_color = $header_background_color !== '' ? $header_background_color : '#fff';
				$header->header_background_color_rgba = !empty($header_background_color) ? $header_background_color : 'transparent';

				$header->header_background_css = sprintf('.header-main-background {%s%s%s%s%s%s}',
					!empty($header_background_color) ?
						'background-color:' . $header_background_color  . ';' : 'background-color:transparent;',
					!empty($header_background_image) ?
						'background-image:url(' . $header_background_image['url'] . ');' : 'background-image:none;',
					!empty($header_background_repeat) ?
						'background-repeat:' . $header_background_repeat . ';' : '',
					!empty($header_background_position) ?
						'background-position:' . $header_background_position . ';' : '',
					!empty($header_background_size) ?
						'background-size:' . $header_background_size . ';' : '',
					!empty($header_background_attachment) ?
						'background-attachment:' . $header_background_attachment . ';' : ''
				);
			}
			else {
				$header->header_background_color = is_array($header_background) && isset($header_background['background-color']) ? $header_background['background-color'] : '#fff';
				$header->header_background_color_rgba = isset($header_background['background-color']) ? g5plus_hex2rgba($header_background['background-color'], $header_background_color_opacity/ 100.0) : 'transparent';
			}
		}
		else {
			$header->header_background_color = is_array($header_background) && isset($header_background['background-color']) ? $header_background['background-color'] : '#fff';
			$header->header_background_color_rgba = isset($header_background['background-color']) ? g5plus_hex2rgba($header_background['background-color'], $header_background_color_opacity/ 100.0) : 'transparent';

			$header->header_background_css = sprintf('.header-main-background {%s%s%s%s%s%s}',
				isset($header_background['background-color']) ?
					'background-color:' . g5plus_hex2rgba($header_background['background-color'], $header_background_color_opacity/ 100.0) . ';' : 'transparent',
				isset($header_background['background-image']) && !empty($header_background['background-image']) ?
					'background-image:url(' . $header_background['background-image'] . ');' : '',
				isset($header_background['background-repeat']) && !empty($header_background['background-repeat']) ?
					'background-repeat:' . $header_background['background-repeat'] . ';' : '',
				isset($header_background['background-position']) && !empty($header_background['background-position']) ?
					'background-position:' . $header_background['background-position'] . ';' : '',
				isset($header_background['background-size']) && !empty($header_background['background-size']) ?
					'background-size:' . $header_background['background-size'] . ';' : '',
				isset($header_background['background-attachment']) && !empty($header_background['background-attachment']) ?
					'background-attachment:' . $header_background['background-attachment'] . ';' : ''
			);
		}

		if ($header->header_background_color == 'transparent') {
			$header->header_background_color = '#fff';
		}

		// Set header nav layout
		$header->header_nav_layout_padding = '100';
		if ((!empty($page_id))) {
			$header_nav_layout = g5plus_rwmb_meta($prefix . 'header_nav_layout', array(), $page_id);
			if (($header_nav_layout == '-1') || ($header_nav_layout === '') || ($header_nav_layout === false)) {
				$header->header_nav_layout_padding = g5plus_get_option('header_nav_layout_padding',100);
			}
			else if ($header_nav_layout == 'nav-fullwith') {
				$header->header_nav_layout_padding = g5plus_rwmb_meta($prefix . 'header_nav_layout_padding', array(), $page_id);
				if ($header->header_nav_layout_padding == '') {
					$header->header_nav_layout_padding = '100';
				}
			}

		}
		else {
			$header->header_nav_layout_padding = g5plus_get_option('header_nav_layout_padding',100);
			if ($header->header_nav_layout_padding == '') {
				$header->header_nav_layout_padding = '100';
			}
		}
		$header->header_nav_layout_padding .= 'px';


		// Set header navigation distance
		$header->header_nav_distance = g5plus_rwmb_meta($prefix . 'header_nav_distance', array(), $page_id);
		if ($header->header_nav_distance == '') {
			$header_nav_distance = g5plus_get_option('header_nav_distance');
			if (is_array($header_nav_distance) && isset($header_nav_distance['height']) && !empty($header_nav_distance['height']) && ($header_nav_distance['height'] != 'px')) {
				$header->header_nav_distance = $header_nav_distance['height'];
			}
		}
		else {
			$header->header_nav_distance = str_replace('px','', $header->header_nav_distance) . 'px';
		}
		if ($header->header_nav_distance == '') {
			$header->header_nav_distance = '45px';
		}

		$menu_sub_scheme = g5plus_get_option('menu_sub_scheme','light');
		$header->menu_sub_bg_color = '#F8F8F8';
		$header->menu_sub_text_color = '#222';
		switch ($menu_sub_scheme) {
			case 'gray':
				$header->menu_sub_bg_color = '#F8F8F8';
				$header->menu_sub_text_color = '#222';
				break;
			case 'light':
				$header->menu_sub_bg_color = '#fff';
				$header->menu_sub_text_color = '#333';
				break;
			case 'dark':
				$header->menu_sub_bg_color = '#222';
				$header->menu_sub_text_color = '#ededed';
				break;
			default:
				$menu_sub_bg_color = g5plus_get_option('menu_sub_bg_color','#fff');
				if (!empty($menu_sub_bg_color)) {
					$header->menu_sub_bg_color = $menu_sub_bg_color;
				}
				$menu_sub_text_color = g5plus_get_option('menu_sub_text_color','#888');
				if (!empty($menu_sub_text_color)) {
					$header->menu_sub_text_color = $menu_sub_text_color;
				}
		}

		// get header nav border bottom

		$header->header_nav_border = 'none';
		$header_nav_border = g5plus_get_option('header_nav_border',array(
			'border-color'  => '#E9E9E9',
			'border-style'  => 'none',
			'border-bottom' => '0'
		));
		if (is_array($header_nav_border) && isset($header_nav_border['border-style']) && isset($header_nav_border['border-color']) && isset($header_nav_border['border-width'])) {
			$header_nav_border_color = $header_nav_border['border-color'];
			$header_nav_border_opacity = g5plus_get_option('header_nav_border_opacity',40);
			$header_nav_border_color = g5plus_hex2rgba($header_nav_border_color, $header_nav_border_opacity * 1.0 / 100);
			$header->header_nav_border = $header_nav_border['border-style'] . ' ' . $header_nav_border['border-width'] . ' ' . $header_nav_border_color;
		}

		$header_nav_border_enable = g5plus_rwmb_meta($prefix . 'header_nav_border_enable', array(), $page_id);
		if ((!empty($page_id)) && ($header_nav_border_enable == '1')) {
			$header_nav_border_style = g5plus_rwmb_meta($prefix . 'header_nav_border_style', array(), $page_id);
			if ($header_nav_border_style == '') {
				$header_nav_border_style = 'none';
			}

			$header_nav_border_width = g5plus_rwmb_meta($prefix . 'header_nav_border_width', array(), $page_id);
			if ($header_nav_border_width == '') {
				$header_nav_border_width = '0';
			}

			$header_nav_border_opacity = g5plus_rwmb_meta($prefix . 'header_nav_border_opacity', array(), $page_id);
			if ($header_nav_border_opacity == '') {
				$header_nav_border_opacity = '100';
			}

			$header_nav_border_color = g5plus_rwmb_meta($prefix . 'header_nav_border_color', array(), $page_id);
			if ($header_nav_border_color == '') {
				$header_nav_border_color = '#E9E9E9';
			}

			$header_nav_border_color = g5plus_hex2rgba($header_nav_border_color, $header_nav_border_opacity * 1.0 / 100);

			$header->header_nav_border = $header_nav_border_style . ' ' . $header_nav_border_width . 'px ' . $header_nav_border_color;
		}

		$header->top_drawer_padding_top = '';
		$header->top_drawer_padding_bottom = '';
		if ((!empty($page_id))) {
			$header->top_drawer_padding_top = g5plus_rwmb_meta($prefix . 'top_drawer_padding_top', array(), $page_id);
			$header->top_drawer_padding_bottom = g5plus_rwmb_meta($prefix . 'top_drawer_padding_bottom', array(), $page_id);
		}

		if ($header->top_drawer_padding_top == '') {
			$top_drawer_padding = g5plus_get_option('top_drawer_padding', array(
				'padding-top'     => '0',
				'padding-bottom'  => '0',
				'units'          => 'px',
			));

			$header->top_drawer_padding_top = is_array($top_drawer_padding) && isset($top_drawer_padding['padding-top']) ? $top_drawer_padding['padding-top'] : '0';
		}
		if ($header->top_drawer_padding_bottom == '') {
			$header->top_drawer_padding_bottom = is_array($top_drawer_padding) && isset($top_drawer_padding['padding-bottom']) ? $top_drawer_padding['padding-bottom'] : '0';
		}

		$header->top_drawer_padding_top = str_replace('px', '', $header->top_drawer_padding_top) . 'px';
		$header->top_drawer_padding_bottom = str_replace('px', '', $header->top_drawer_padding_bottom) . 'px';

		return $header;
	}
}


// GET CUSTOM CSS VARIABLE FOOTER
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_footer')) {
	function g5plus_custom_css_variable_footer($page_id = 0) {
		$prefix = 'g5plus_';

		$footer = (object)array();

		$footer->footer_bg_color = '#333';
		$footer->footer_bg_color_opacity = 1;

		$footer->footer_text_color = '#aaa';
		$footer->footer_heading_text_color = '#fff';

		$footer->bottom_bar_bg_color = '#333';
		$footer->bottom_bar_bg_color_opacity = 1;

		$footer->bottom_bar_text_color = '#777';






		// Set footer scheme
		$footer_scheme = g5plus_get_post_meta($page_id,$prefix . 'footer_scheme',true);
		if ((!empty($page_id)) && ($footer_scheme != '-1') && ($footer_scheme != '')) {
			switch ($footer_scheme) {
				case 'gray':
					$footer->footer_bg_color = '#f4f4f4';
					$footer->footer_text_color = '#545454';
					$footer->footer_heading_text_color = '#333333';
					$footer->bottom_bar_bg_color = '#f4f4f4';
					$footer->bottom_bar_text_color = '#333333';
					break;
				case 'light':
					$footer->footer_bg_color = '#ffffff';
					$footer->footer_text_color = '#535353';
					$footer->footer_heading_text_color = '#333333';
					$footer->bottom_bar_bg_color = '#ffffff';
					$footer->bottom_bar_text_color = '#545454';
					break;
				case 'dark':
					$footer->footer_bg_color = '#333';
					$footer->footer_text_color = '#aaa';
					$footer->footer_heading_text_color = '#fff';
					$footer->bottom_bar_bg_color = '#333';
					$footer->bottom_bar_text_color = '#777';
					break;
				default:
					$footer_bg_color = g5plus_get_post_meta($page_id, $prefix . 'footer_bg_color', true);
					if ($footer_bg_color != '') {
						$footer->footer_bg_color = $footer_bg_color;
					}

					$footer_bg_color_opacity = g5plus_get_post_meta($page_id,$prefix. 'footer_bg_color_opacity' , true);
					if ($footer_bg_color_opacity != '') {
						$footer->footer_bg_color_opacity = $footer_bg_color_opacity / 100.0;
					}

					$footer_text_color = g5plus_get_post_meta($page_id,$prefix. 'footer_text_color',true);
					if ($footer_text_color != '') {
						$footer->footer_text_color = $footer_text_color;
					}

					$footer_heading_text_color = g5plus_get_post_meta($page_id,$prefix. 'footer_heading_text_color',true);
					if ($footer_heading_text_color != '') {
						$footer->footer_heading_text_color = $footer_heading_text_color;
					}

					$bottom_bar_bg_color = g5plus_get_post_meta($page_id,$prefix. 'bottom_bar_bg_color',true);
					if ($bottom_bar_bg_color != '') {
						$footer->bottom_bar_bg_color = $bottom_bar_bg_color;
					}

					$bottom_bar_bg_color_opacity = g5plus_get_post_meta($page_id,$prefix. 'bottom_bar_bg_color_opacity' , true);
					if ($bottom_bar_bg_color_opacity != '') {
						$footer->bottom_bar_bg_color_opacity = $bottom_bar_bg_color_opacity / 100.0;
					}
					break;
			}
		} else {
			$footer_scheme = g5plus_get_option('footer_scheme','dark');
			switch ($footer_scheme) {
				case 'gray':
					$footer->footer_bg_color = '#f4f4f4';
					$footer->footer_text_color = '#545454';
					$footer->footer_heading_text_color = '#333333';
					$footer->bottom_bar_bg_color = '#f4f4f4';
					$footer->bottom_bar_text_color = '#333333';
					break;
				case 'light':
					$footer->footer_bg_color = '#ffffff';
					$footer->footer_text_color = '#535353';
					$footer->footer_heading_text_color = '#333333';
					$footer->bottom_bar_bg_color = '#ffffff';
					$footer->bottom_bar_text_color = '#545454';
					break;
				case 'dark':
					$footer->footer_bg_color = '#333';
					$footer->footer_text_color = '#aaa';
					$footer->footer_heading_text_color = '#fff';
					$footer->bottom_bar_bg_color = '#333';
					$footer->bottom_bar_text_color = '#777';
					break;
				default:
					$footer_bg_color = g5plus_get_option('footer_bg_color',array());
					if (is_array($footer_bg_color)) {
						if (isset($footer_bg_color['color'])) {
							$footer->footer_bg_color = $footer_bg_color['color'];
						}
						if (isset($footer_bg_color['alpha'])) {
							$footer->footer_bg_color_opacity = $footer_bg_color['alpha'];
						}
					}


					$footer_text_color = g5plus_get_option('footer_text_color');
					if ($footer_text_color != '') {
						$footer->footer_text_color = $footer_text_color;
					}

					$footer_heading_text_color = g5plus_get_option('footer_heading_text_color');
					if ($footer_heading_text_color != '') {
						$footer->footer_heading_text_color = $footer_heading_text_color;
					}



					$bottom_bar_bg_color = g5plus_get_option('bottom_bar_bg_color',array());
					if (is_array($bottom_bar_bg_color)) {
						if (isset($bottom_bar_bg_color['color'])) {
							$footer->bottom_bar_bg_color = $bottom_bar_bg_color['color'];
						}
						if (isset($bottom_bar_bg_color['alpha'])) {
							$footer->bottom_bar_bg_color_opacity = $bottom_bar_bg_color['alpha'];
						}
					}
					break;
			}
		}


		// get footer padding
		$footer_padding = g5plus_get_option('footer_padding',array(
			'padding-top'     => '',
			'padding-bottom'  => '',
			'units'          => 'px',
		));
		$footer->footer_padding_top = g5plus_get_post_meta($page_id,$prefix. 'footer_padding_top',true);
		if ($footer->footer_padding_top === '') {
			if (is_array($footer_padding)
				&& isset($footer_padding['padding-top'])
			    && !(empty($footer_padding['padding-top']))) {
				$footer->footer_padding_top = $footer_padding['padding-top'];
			}
		} else {
			$footer->footer_padding_top .= 'px';
		}

		if (empty($footer->footer_padding_top)) {
			$footer->footer_padding_top = '80px';
		}

		$footer->footer_padding_bottom = g5plus_get_post_meta($page_id,$prefix. 'footer_padding_bottom',true);
		if ($footer->footer_padding_bottom === '') {
			if (is_array($footer_padding)
				&& isset($footer_padding['padding-bottom'])
			    && !(empty($footer_padding['padding-bottom']))) {
				$footer->footer_padding_bottom = $footer_padding['padding-bottom'];
			}
		} else {
			$footer->footer_padding_bottom .= 'px';
		}

		if (empty($footer->footer_padding_bottom)) {
			$footer->footer_padding_bottom = '50px';
		}

		return $footer;

	}
}

// GET CUSTOM CSS VARIABLE
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable')) {
	function g5plus_custom_css_variable($page_id = 0) {
		$top_bar_bg_color = '#333';
		$opt_top_bar_bg_color = g5plus_get_option('top_bar_bg_color',array(
			'color' => '#333',
			'alpha' => '1'
		));
		if (is_array($opt_top_bar_bg_color)) {
			if (isset($opt_top_bar_bg_color['rgba'])) {
				$top_bar_bg_color = $opt_top_bar_bg_color['rgba'];
			}
			elseif (isset($opt_top_bar_bg_color['color'])) {
				$top_bar_bg_color = $opt_top_bar_bg_color['color'];
			}
		}

		$top_bar_text_color = '#c5c5c5';
		$opt_top_bar_text_color = g5plus_get_option('top_bar_text_color','#c5c5c5');
		if (! empty($opt_top_bar_text_color)) {
			$top_bar_text_color = $opt_top_bar_text_color;
		}

		$top_drawer_bg_color = '#2f2f2f';
		$opt_top_drawer_bg_color = g5plus_get_option('top_drawer_bg_color','#2f2f2f');
		if ( ! empty($opt_top_drawer_bg_color)) {
			$top_drawer_bg_color = $opt_top_drawer_bg_color;
		}

		$top_drawer_text_color = '#c5c5c5';
		$opt_top_drawer_text_color = g5plus_get_option('top_drawer_text_color','#c5c5c5');
		if ( ! empty($opt_top_drawer_text_color)) {
			$top_drawer_text_color = $opt_top_drawer_text_color;
		}


		$primary_color = '#995958';
		$opt_primary_color = g5plus_get_option('primary_color','#995958');
		if (!empty($opt_primary_color)) {
			$primary_color = $opt_primary_color;
		}

		$secondary_color = '#444444';
		$opt_secondary_color = g5plus_get_option('secondary_color','#444444');
		if (! empty($opt_secondary_color)) {
			$secondary_color = $opt_secondary_color;
		}

		$text_color = '#888';
		$opt_text_color = g5plus_get_option('text_color','#c5c5c5');
		if ( ! empty($opt_text_color)) {
			$text_color = $opt_text_color;
		}

		$bold_color = '#373636';
		$opt_bold_color = g5plus_get_option('bold_color','#333333');
		if (! empty($opt_bold_color)) {
			$bold_color = $opt_bold_color;
		}

		$heading_color = '#1e1e1e';
		$opt_heading_color = g5plus_get_option('heading_color','#333333');
		if (! empty($opt_heading_color)) {
			$heading_color = $opt_heading_color;
		}

		$link_color = '#e8aa00';
		$opt_link_color = g5plus_get_option('link_color',array(
			'regular'  => '#995958', // blue
			'hover'    => '#995958', // red
			'active'   => '#995958',  // purple
		));
		if (is_array($opt_link_color) && isset($opt_link_color['regular']) && !empty($opt_link_color['regular'])) {
			$link_color = $opt_link_color['regular'];
		}

		$link_color_hover = '#e8aa00';
		if (is_array($opt_link_color) && isset($opt_link_color['hover']) && !empty($opt_link_color['hover'])) {
			$link_color_hover = $opt_link_color['hover'];
		}

		$link_color_active = '#e8aa00';
		if (is_array($opt_link_color) && isset($opt_link_color['active']) && !empty($opt_link_color['active'])) {
			$link_color_active = $opt_link_color['active'];
		}

		// Page Title
		//-------------------

		$page_title_bg_color = '#fff';
		$opt_page_title_bg_color = g5plus_get_option('page_title_bg_color','#FFFFFF');
		if (! empty($opt_page_title_bg_color)) {
			$page_title_bg_color = $opt_page_title_bg_color;
		}

		$page_title_overlay_color = '#000';
		$opt_page_title_overlay_color = g5plus_get_option('page_title_overlay_color','#000');
		if (! empty($opt_page_title_overlay_color)) {
			$page_title_overlay_color = $opt_page_title_overlay_color;
		}

		$page_title_overlay_opacity = '0.5';
		$opt_page_title_overlay_opacity = g5plus_get_option('page_title_overlay_opacity','30');
		if (! empty($opt_page_title_overlay_opacity)) {
			$page_title_overlay_opacity = $opt_page_title_overlay_opacity/100;
		}

		$breadcrumbs_text_color  = '#535353';
		$opt_breadcrumbs_text_color = g5plus_get_option('breadcrumbs_text_color','#535353');
		if (! empty($opt_breadcrumbs_text_color)) {
			$breadcrumbs_text_color = $opt_breadcrumbs_text_color;
		}

		$breadcrumbs_background_color  = '#f4f4f4';
		$opt_breadcrumbs_background_color = g5plus_get_option('breadcrumbs_background_color','#f4f4f4');
		if (! empty($opt_breadcrumbs_background_color)) {
			$breadcrumbs_background_color = $opt_breadcrumbs_background_color;
		}

		$logo_mobile_max_height = '72px';
		$logo_mobile_padding = '15px';
		$main_menu_mobile_height = '72px';

		$logo_mobile_matrix = array(
			'header-mobile-1' => array(72, 15),
			'header-mobile-2' => array(42, 25, 52),
			'header-mobile-3' => array(72, 15),
			'header-mobile-4' => array(72, 15),
			'header-mobile-5' => array(72, 15),
		);

		// GET logo_max_height, logo_padding
		$mobile_header_layout = g5plus_get_option('mobile_header_layout','header-mobile-2');

		if (isset($logo_mobile_matrix[$mobile_header_layout])) {
			$logo_mobile_max_height = $logo_mobile_matrix[$mobile_header_layout][0] . 'px';
			$logo_mobile_padding = $logo_mobile_matrix[$mobile_header_layout][1] . 'px';
			if (isset($logo_mobile_matrix[$mobile_header_layout][2])) {
				$main_menu_mobile_height = $logo_mobile_matrix[$mobile_header_layout][2] . 'px';
			}
			else {
				$main_menu_mobile_height = ($logo_mobile_matrix[$mobile_header_layout][0] + $logo_mobile_matrix[$mobile_header_layout][1] * 2) . 'px';
			}
		}

		$opt_logo_mobile_max_height = g5plus_get_option('logo_mobile_max_height');
		if (is_array($opt_logo_mobile_max_height) && isset($opt_logo_mobile_max_height['height']) && ! empty($opt_logo_mobile_max_height['height']) && ($opt_logo_mobile_max_height['height'] != 'px')) {
			$logo_mobile_max_height = $opt_logo_mobile_max_height['height'];
		}
		if (str_replace('px','', $logo_mobile_max_height) == '') {
			$logo_mobile_max_height = '72px';
		}
		else {
			$logo_mobile_max_height = str_replace('px','', $logo_mobile_max_height) . 'px';
		}

		$opt_logo_mobile_padding = g5plus_get_option('logo_mobile_padding');
		if (is_array($opt_logo_mobile_padding) && isset($opt_logo_mobile_padding['height']) && ! empty($opt_logo_mobile_padding['height']) && ($opt_logo_mobile_padding['height'] != 'px')) {
			$logo_mobile_padding = $opt_logo_mobile_padding['height'] . 'px';
		}

		$fonts = g5plus_custom_css_variable_font();
		$logo = g5plus_custom_css_variable_logo($page_id);
		$header = g5plus_custom_css_variable_header($page_id);
		$footer = g5plus_custom_css_variable_footer($page_id);

		ob_start();

		echo "@top_drawer_bg_color:		$top_drawer_bg_color;", PHP_EOL;
		echo "@top_drawer_text_color:	$top_drawer_text_color;", PHP_EOL;
		echo "@top_bar_bg_color:		$top_bar_bg_color;", PHP_EOL;
		echo "@top_bar_text_color:		$top_bar_text_color;", PHP_EOL;
		echo "@primary_color:			$primary_color;", PHP_EOL;
		echo "@secondary_color:			$secondary_color;", PHP_EOL;
		echo "@text_color:				$text_color;", PHP_EOL;
		echo "@heading_color:			$heading_color;", PHP_EOL;
		echo "@bold_color:				$bold_color;", PHP_EOL;



		echo "@footer_bg_color:			$footer->footer_bg_color;", PHP_EOL;
		echo "@footer_bg_color_opacity:			$footer->footer_bg_color_opacity;", PHP_EOL;
		echo "@footer_text_color:		$footer->footer_text_color;", PHP_EOL;
		echo "@footer_heading_text_color: $footer->footer_heading_text_color;", PHP_EOL;
		echo "@bottom_bar_bg_color:		$footer->bottom_bar_bg_color;", PHP_EOL;
		echo "@bottom_bar_bg_color_opacity:		$footer->bottom_bar_bg_color_opacity;", PHP_EOL;
		echo "@bottom_bar_text_color:	$footer->bottom_bar_text_color;", PHP_EOL;
		echo "@footer_padding_top:	$footer->footer_padding_top;", PHP_EOL;
		echo "@footer_padding_bottom:	$footer->footer_padding_bottom;", PHP_EOL;



		echo "@link_color:				$link_color;", PHP_EOL;
		echo "@link_color_hover:		$link_color_hover;", PHP_EOL;
		echo "@link_color_active:		$link_color_active;", PHP_EOL;
		echo "@menu_font:				'$fonts->menu_font';", PHP_EOL;
		echo "@secondary_font:			'$fonts->secondary_font';", PHP_EOL;
		echo "@primary_font:			'$fonts->primary_font';", PHP_EOL;
		echo "@other_font:				'$fonts->other_font';", PHP_EOL;

		echo "@page_title_bg_color:		$page_title_bg_color;", PHP_EOL;
		echo "@page_title_overlay_color:	$page_title_overlay_color;", PHP_EOL;
		echo "@page_title_overlay_opacity:	$page_title_overlay_opacity;", PHP_EOL;

		echo "@logo_max_height:	$logo->logo_max_height;", PHP_EOL;
		echo "@logo_padding_top:	$logo->logo_padding_top;", PHP_EOL;
		echo "@logo_padding_bottom:	$logo->logo_padding_bottom;", PHP_EOL;
		echo "@main_menu_height:	$logo->main_menu_height;", PHP_EOL;

		echo "@logo_mobile_max_height:	$logo_mobile_max_height;", PHP_EOL;
		echo "@logo_mobile_padding:	$logo_mobile_padding;", PHP_EOL;
		echo "@main_menu_mobile_height:	$main_menu_mobile_height;", PHP_EOL;

		echo "@header_nav_layout_padding:	$header->header_nav_layout_padding;", PHP_EOL;
		echo "@header_nav_distance:	$header->header_nav_distance;", PHP_EOL;
		echo "@header_nav_text_color:	$header->header_nav_text_color;", PHP_EOL;
		echo "@menu_sub_bg_color:	$header->menu_sub_bg_color;", PHP_EOL;
		echo "@menu_sub_text_color:	$header->menu_sub_text_color;", PHP_EOL;

		echo "@breadcrumbs_text_color: $breadcrumbs_text_color;", PHP_EOL;
		echo "@breadcrumbs_background_color: $breadcrumbs_background_color;", PHP_EOL;

		echo "@header_nav_bg_color: $header->header_nav_bg_color;", PHP_EOL;
		echo "@header_background_color: $header->header_background_color;", PHP_EOL;
		echo "@header_background_color_rgba: $header->header_background_color_rgba;", PHP_EOL;
		echo "@header_nav_border: $header->header_nav_border;", PHP_EOL;

		echo "@top_drawer_padding_top: $header->top_drawer_padding_top;", PHP_EOL;
		echo "@top_drawer_padding_bottom: $header->top_drawer_padding_bottom;", PHP_EOL;


		echo '@theme_url:"'. THEME_URL . '";', PHP_EOL;

		echo sprintf('%s', $header->header_background_css), PHP_EOL;

		return ob_get_clean();
	}
}

// GET CUSTOM CSS
//--------------------------------------------------
if (!function_exists('g5plus_custom_css')) {
	function g5plus_custom_css() {
		$custom_css = '';
		$background_image_css = '';

		$body_background_mode = g5plus_get_option('body_background_mode','background');
		if ($body_background_mode == 'background') {
			$opt_body_background = g5plus_get_option('body_background',array(
				'background-color' => '',
				'background-repeat' => 'no-repeat',
				'background-position' => 'center center',
				'background-attachment' => 'fixed',
				'background-size' => 'cover'
			));
			$background_image_url = is_array($opt_body_background) && isset($opt_body_background['background-image']) ? $opt_body_background['background-image'] : '';
			$background_color = is_array($opt_body_background) && isset($opt_body_background['background-color']) ? $opt_body_background['background-color'] : '';

			if (!empty($background_color)) {
				$background_image_css .= 'background-color:' . $background_color . ';';
			}

			if (!empty($background_image_url)) {
				$background_repeat = is_array($opt_body_background) && isset($opt_body_background['background-repeat']) ? $opt_body_background['background-repeat'] : '';
				$background_position = is_array($opt_body_background) && isset($opt_body_background['background-position']) ? $opt_body_background['background-position'] : '';
				$background_size = is_array($opt_body_background) && isset($opt_body_background['background-size']) ? $opt_body_background['background-size'] : '';
				$background_attachment = is_array($opt_body_background) && isset($opt_body_background['background-attachment']) ? $opt_body_background['background-attachment'] : '';

				$background_image_css .= 'background-image: url("'. $background_image_url .'");';


				if (!empty($background_repeat)) {
					$background_image_css .= 'background-repeat: '. $background_repeat .';';
				}

				if (!empty($background_position)) {
					$background_image_css .= 'background-position: '. $background_position .';';
				}

				if (!empty($background_size)) {
					$background_image_css .= 'background-size: '. $background_size .';';
				}

				if (!empty($background_attachment)) {
					$background_image_css .= 'background-attachment: '. $background_attachment .';';
				}
			}

		}

		if ($body_background_mode == 'pattern') {
			$opt_body_background_pattern = g5plus_get_option('body_background_pattern','pattern-1.png');
			$background_image_url = THEME_URL . 'assets/images/theme-options/' . $opt_body_background_pattern;
			$background_image_css .= 'background-image: url("'. $background_image_url .'");';
			$background_image_css .= 'background-repeat: repeat;';
			$background_image_css .= 'background-position: center center;';
			$background_image_css .= 'background-size: auto;';
			$background_image_css .= 'background-attachment: scroll;';
		}

		if (!empty($background_image_css)) {
			$custom_css.= 'body{'.$background_image_css.'}';
		}

		$custom_scroll = g5plus_get_option('custom_scroll','0');
		if ($custom_scroll == 1) {
			$custom_scroll_width = g5plus_get_option('custom_scroll_width','10');
			$custom_scroll_color = g5plus_get_option('custom_scroll_color','#19394B');
			$custom_scroll_thumb_color = g5plus_get_option('custom_scroll_thumb_color','#e8aa00');

			$custom_css .= 'body::-webkit-scrollbar {width: '.$custom_scroll_width.'px;background-color: '.$custom_scroll_color .';}';
			$custom_css .= 'body::-webkit-scrollbar-thumb{background-color: '.$custom_scroll_thumb_color .';}';
		}

		$opt_footer_bg_image = g5plus_get_option('footer_bg_image');
		$footer_bg_image = is_array($opt_footer_bg_image) && isset($opt_footer_bg_image['url']) && !empty($opt_footer_bg_image['url']) ? $opt_footer_bg_image['url'] : '';

		if (!empty($footer_bg_image)) {
			$footer_bg_css = 'background-image:url(' . $footer_bg_image . ');';
			$footer_bg_css .= 'background-size: cover;';
			$footer_bg_css .= 'background-attachment: fixed;';
			$custom_css .= 'footer.main-footer-wrapper {' . $footer_bg_css . '}';
		}


		$custom_css = str_replace( "\r\n", '', $custom_css );
		$custom_css = str_replace( "\n", '', $custom_css );
		$custom_css = str_replace( "\t", '', $custom_css );
		return $custom_css;
	}
}

// UNREGISTER CUSTOM POST TYPES
//--------------------------------------------------
if (!function_exists('g5plus_unregister_post_type')) {
	function g5plus_unregister_post_type( $post_type, $slug = '' ) {
		global $wp_post_types;
		$cpt_disable = g5plus_get_option('cpt-disable');
		if ( is_array( $cpt_disable ) ) {
			foreach ( $cpt_disable as $post_type => $cpt ) {
				if ( $cpt == 1 && isset( $wp_post_types[ $post_type ] ) ) {
					unset( $wp_post_types[ $post_type ] );
				}
			}
		}
	}
	add_action( 'init', 'g5plus_unregister_post_type', 20 );
}

// ADD HEADER CUSTOMIZE CSS
//--------------------------------------------------
if (!function_exists('g5plus_enqueue_header_custom_style')) {
	function g5plus_enqueue_header_custom_style() {
		if (is_singular()) {
			echo '<link rel="stylesheet" type="text/css" media="all" href="'. HOME_URL . '?custom-page=header-custom-css&amp;current_page_id=' . get_the_ID()
				. (isset($_GET['RTL']) ? '&amp;RTL=1' : '') . '"/>';
		}
	}
	add_action('wp_head', 'g5plus_enqueue_header_custom_style',100);
}

/**
 * Get Tax meta with key not prefix
 * *******************************************************
 */
if ( !function_exists( 'g5plus_get_tax_meta') ) {
	function g5plus_get_tax_meta($term_id,$key,$multi = false) {
		if ( function_exists('get_term_meta')){
			$meta = get_term_meta($term_id, $key, !$multi );
			if ($meta === false || $meta === '') {
				$meta = get_tax_meta( $term_id, $key, !$multi  );
			}
			return $meta;
		}else{
			return get_tax_meta( $term_id, $key, !$multi  );
		}
	}
}

if (!function_exists('g5plus_rwmb_meta')) {
	function g5plus_rwmb_meta($key, $args = array(), $post_id = null ) {
		if (function_exists('rwmb_meta')) {
			return rwmb_meta($key,$args, $post_id);
		}
		$default = &g5plus_rwmb_meta_default();
		return isset($default[$key]) ? $default[$key] : '';
	}
}

if (!function_exists('g5plus_rwmb_meta_default')) {
	function &g5plus_rwmb_meta_default() {
		$prefix = 'g5plus_';
		$default =  array (
			"{$prefix}post_format_image" => '',
			"{$prefix}post_format_gallery" => '',
			"{$prefix}post_format_video" => '',
			"{$prefix}post_format_audio" => '',
			"{$prefix}post_format_quote" => '',
			"{$prefix}post_format_quote_author" => '',
			"{$prefix}post_format_quote_author_url" => '',
			"{$prefix}post_format_link_url" => '',
			"{$prefix}post_format_link_text" => '',

			"{$prefix}layout_style" => '-1',
			"{$prefix}page_layout" => '-1',
			"{$prefix}page_sidebar" => '',
			"{$prefix}page_left_sidebar" => '',
			"{$prefix}page_right_sidebar" => '',
			"{$prefix}sidebar_width" => '-1',
			"{$prefix}page_class_extra" => '',


			"{$prefix}top_drawer_type" => '-1',
			"{$prefix}top_drawer_sidebar" => '',
			"{$prefix}top_drawer_wrapper_layout" => '-1',
			"{$prefix}top_drawer_hide_mobile" => '-1',
			"{$prefix}top_drawer_padding_top" => '',
			"{$prefix}top_drawer_padding_bottom" => '',

			"{$prefix}top_bar" => '-1',
			"{$prefix}top_bar_layout" => '',
			"{$prefix}top_bar_left_sidebar" => '',
			"{$prefix}top_bar_right_sidebar" => '',

			"{$prefix}header_show_hide" => '1',
			"{$prefix}header_layout" => '',
			"{$prefix}header_tag_line" => '',

			"{$prefix}header_background_enable" => 0,
			"{$prefix}header_background_color" => '',
			"{$prefix}header_background_color_opacity" => '100',
			"{$prefix}header_background_image" => '',
			"{$prefix}header_background_repeat" => '',
			"{$prefix}header_background_size" => '',
			"{$prefix}header_background_attachment" => '',
			"{$prefix}header_background_position" => '',

			"{$prefix}header_nav_layout" => '-1',
			"{$prefix}header_nav_layout_padding" => '100',
			"{$prefix}header_nav_separate" => '-1',
			"{$prefix}header_nav_hover" => '-1',
			"{$prefix}header_nav_distance" => '',
			"{$prefix}header_nav_scheme" => '-1',
			"{$prefix}header_nav_bg_color_color" => '',
			"{$prefix}header_nav_bg_color_opacity" => '',
			"{$prefix}header_nav_text_color" => '',

			"{$prefix}header_nav_border_enable" => 0,
			"{$prefix}header_nav_border_width" => '',
			"{$prefix}header_nav_border_style" => 'none',
			"{$prefix}header_nav_border_color" => '#E9E9E9',
			"{$prefix}header_nav_border_opacity" => '40',

			"{$prefix}enable_header_customize" => 0,
			"{$prefix}header_customize" => '',
			"{$prefix}header_customize_text" => '',
			"{$prefix}header_customize_social_profile" => '',


			"{$prefix}header_layout_float" => '-1',
			"{$prefix}header_sticky" => '-1',
			"{$prefix}header_sticky_scheme" => '-1',


			"{$prefix}custom_logo" => '',
			"{$prefix}logo_height" => '',
			"{$prefix}logo_max_height" => '',
			"{$prefix}logo_padding_top" => '',
			"{$prefix}logo_padding_bottom" => '',
			"{$prefix}sticky_logo" => '',


			"{$prefix}page_menu" => '',
			"{$prefix}page_menu_mobile" => '',
			"{$prefix}is_one_page" => '',


			"{$prefix}show_page_title" => '-1',
			"{$prefix}page_title_custom" => '',
			"{$prefix}page_subtitle_custom" => '',
			"{$prefix}page_title_text_color" => '',
			"{$prefix}page_sub_title_text_color" => '',
			"{$prefix}page_title_bg_color" => '',
			"{$prefix}enable_custom_page_title_bg_image" => 0,
			"{$prefix}page_title_bg_image" => '',
			"{$prefix}page_title_overlay_color" => '',
			"{$prefix}enable_custom_overlay_opacity" => 0,
			"{$prefix}page_title_overlay_opacity" => '',
			"{$prefix}page_title_text_align" => '-1',
			"{$prefix}page_title_parallax" => '-1',
			"{$prefix}page_title_height" => '',
			"{$prefix}breadcrumbs_in_page_title" => '-1',
			"{$prefix}page_title_remove_margin_bottom" => 0,

			"{$prefix}footer_show_hide" => '-1',
			"{$prefix}footer_parallax" => '-1',
			"{$prefix}collapse_footer" => '-1',
			"{$prefix}footer_wrap_layout" => '-1',
			"{$prefix}footer_scheme" => '-1',
			"{$prefix}footer_bg_color" => '',
			"{$prefix}footer_bg_color_opacity" => '100',
			"{$prefix}footer_text_color" => '',
			"{$prefix}footer_heading_text_color" => '',
			"{$prefix}bottom_bar_bg_color" => '',
			"{$prefix}bottom_bar_bg_color_opacity" => '',
			"{$prefix}bottom_bar_text_color" => '',
			"{$prefix}footer_top_bar_show_hide" => '1',
			"{$prefix}footer_bg_image" => '',
			"{$prefix}footer_padding_top" => '',
			"{$prefix}footer_padding_bottom" => '',
			"{$prefix}footer_layout" => '',
			"{$prefix}footer_sidebar_1" => '',
			"{$prefix}footer_sidebar_2" => '',
			"{$prefix}footer_sidebar_3" => '',
			"{$prefix}footer_sidebar_4" => '',
			"{$prefix}bottom_bar" => '-1',
			"{$prefix}bottom_bar_layout" => '',
			"{$prefix}bottom_bar_left_sidebar" => '',
			"{$prefix}bottom_bar_right_sidebar" => '',



			"{$prefix}mobile_header_layout" => '',
			"{$prefix}mobile_header_menu_drop" => '-1',
			"{$prefix}mobile_header_stick" => '-1',
			"{$prefix}custom_logo_mobile" => '',
			"{$prefix}mobile_header_search_box" => '-1',
			"{$prefix}mobile_header_shopping_cart" => '-1',


			"{$prefix}show_post_navigation" => '-1',
			"{$prefix}show_author_info" => '-1',
			"{$prefix}show_related_post" => '-1',
			"{$prefix}show_related_post" => '-1',

			"{$prefix}product_secondary_image" => '',
		);
		return $default;
	}
}

if (!function_exists('g5plus_get_default_fonts')) {
	function g5plus_get_default_fonts($is_frontEnd = true) {
		return  array(
			'body_font' => array(
				'default' => array(
					'font-size'=>'13px',
					'font-family'=>'Raleway',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('body') : array('.editor-styles-wrapper.editor-styles-wrapper')
			) ,
			'h1_font' => array(
				'default' =>  array(
					'font-size'=>'36px',
					'line-height'=>'43.2px',
					'font-family'=>'Montserrat',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h1') :  array('.editor-styles-wrapper.editor-styles-wrapper h1')
			),
			'h2_font' => array(
				'default' =>  array(
					'font-size'=>'28px',
					'line-height'=>'33.6px',
					'font-family'=>'Montserrat',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h2') : array('.editor-styles-wrapper.editor-styles-wrapper h2')
			),
			'h3_font' => array(
				'default' =>  array(
					'font-size'=>'24px',
					'line-height'=>'28.8px',
					'font-family'=>'Montserrat',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h3') :array('.editor-styles-wrapper.editor-styles-wrapper h3','.editor-post-title__block.editor-post-title__block .editor-post-title__input')
			),
			'h4_font' => array(
				'default' =>  array(
					'font-size'=>'21px',
					'line-height'=>'25.2px',
					'font-family'=>'Montserrat',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h4') : array('.editor-styles-wrapper.editor-styles-wrapper h4')
			),
			'h5_font' => array(
				'default' =>  array(
					'font-size'=>'18px',
					'line-height'=>'21.6px',
					'font-family'=>'Montserrat',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h5') : array('.editor-styles-wrapper.editor-styles-wrapper h5')
			),
			'h6_font'  => array(
				'default' =>  array(
					'font-size'=>'14px',
					'line-height'=>'16.8px',
					'font-family'=>'Montserrat',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h6') : array('.editor-styles-wrapper.editor-styles-wrapper h6')
			),
			'page_title_font'  => array(
				'default' =>  array(
					'font-family'=>'Montserrat',
					'font-size'=>'36px',
					'font-weight'=>'400',
					'text-transform' => 'uppercase',
					'color' => '#ffffff'
				),
				'selector' => $is_frontEnd ? array('.page-title-inner h1') : array('')
			),
			'page_sub_title_font'  => array(
				'default' =>  array(
					'font-family'=>'Playfair Display',
					'font-size'=>'16px',
					'font-weight'=>'400',
					'font-style'=>'italic',
					'text-transform' => 'none',
					'color' => '#ffffff'
				),
				'selector' => $is_frontEnd ? array('.page-title-inner .page-sub-title') : array('')
			),
			'menu_font'  => array(
				'default' =>  array(
					'font-family'=>'Montserrat',
				)
			),
			'count_down_font'  => array(
				'default' =>  array(
					'font-family'=>'Lato',
				)
			),
			'secondary_font' => array(
				'default' =>  array(
					'font-family'=>'Montserrat',
				),
			),
			'other_font' => array(
				'default' =>  array(
					'font-family'=>'Playfair Display',
				),
			),
		);
	}
}


if (!function_exists('g5plus_get_fonts_css')) {
	function g5plus_get_fonts_css($is_frontEnd = true) {
		$custom_fonts_variable = g5plus_get_default_fonts($is_frontEnd);
		$custom_css = '';
		foreach ($custom_fonts_variable as $optionKey => $v) {
			$fonts = g5plus_get_option($optionKey,$v['default']);
			if ($fonts) {
				$selector = (isset($v['selector']) && is_array($v['selector'])) ? implode(',', $v['selector']) : '';
				$fonts = g5plus_process_font($fonts);
				$fonts_attributes = array();
				if (isset($fonts['font-family'])) {
					$fonts['font-family'] = g5plus_get_font_family($fonts['font-family']);
					$fonts_attributes[] = "font-family: '{$fonts['font-family']}'";
				}

				if (isset($fonts['font-size'])) {
					$fonts_attributes[] = "font-size: {$fonts['font-size']}";
				}

				if (isset($fonts['font-weight'])) {
					$fonts_attributes[] = "font-weight: {$fonts['font-weight']}";
				}

				if (isset($fonts['font-style'])) {
					$fonts_attributes[] = "font-style: {$fonts['font-style']}";
				}

				if (isset($fonts['text-transform'])) {
					$fonts_attributes[] = "text-transform: {$fonts['text-transform']}";
				}

				if (isset($fonts['color'])) {
					$fonts_attributes[] = "color: {$fonts['color']}";
				}


				if ((count($fonts_attributes) > 0)  && ($selector != '')) {
					$fonts_css = implode(';', $fonts_attributes);

					$custom_css .= <<<CSS
                {$selector} {
                    {$fonts_css}
                }
CSS;
				}
			}
		}

		// Remove comments
		$custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
		// Remove space after colons
		$custom_css = str_replace(': ', ':', $custom_css);
		// Remove whitespace
		$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
		return $custom_css;
	}
}

if (!function_exists('g5plus_get_fonts_url')) {
	function g5plus_get_fonts_url() {
		$custom_fonts_variable = g5plus_get_default_fonts();
		$google_fonts = array();
		foreach ($custom_fonts_variable as $k => $v) {
			$custom_fonts = g5plus_get_option($k,$v['default']);
			if (is_array($custom_fonts)  && isset($custom_fonts['font-family']) && !in_array($custom_fonts['font-family'],$google_fonts)) {
				$google_fonts[] = $custom_fonts['font-family'];
			}
		}
		$fonts_url = '';
		$fonts = '';
		foreach($google_fonts as $google_font)
		{
			$fonts .= str_replace('','+',$google_font) . ':100,300,400,600,700,900,100italic,300italic,400italic,600italic,700italic,900italic|';
		}
		if ($fonts != '')
		{
			$protocol = is_ssl() ? 'https' : 'http';
			$fonts_url =  $protocol . '://fonts.googleapis.com/css?family=' . substr_replace( $fonts, "", - 1 );
		}
		return $fonts_url;
	}
}