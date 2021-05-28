<?php
global  $g5plus_header_layout;
$prefix = 'g5plus_';

$enable_header_customize = g5plus_rwmb_meta($prefix . 'enable_header_customize');
$header_search_box = '0';

$header_customize = array();
if ($enable_header_customize == '1') {
	$page_header_customize = g5plus_rwmb_meta($prefix . 'header_customize');
	if (isset($page_header_customize['enable']) && !empty($page_header_customize['enable'])) {
		$header_customize = explode('||', $page_header_customize['enable']);
	}
	if (in_array('search', $header_customize)) {
		$header_search_box = '1';
	}
}
else {
	$header_customize = g5plus_get_option('header_customize');
	if (is_array($header_customize) && isset($header_customize['enabled']) && is_array($header_customize['enabled'])) {
		if (in_array('search', $header_customize['enabled'])) {
			$header_search_box = '1';
		}
	}
}

$mobile_header_search_box = g5plus_get_option('mobile_header_search_box','1');

// SHOW HEADER
$header_show_hide = g5plus_rwmb_meta($prefix . 'header_show_hide');
if (($header_show_hide === '')) {
	$header_show_hide = '1';
}
?>
<?php if (($header_show_hide == '1')): ?>
	<?php g5plus_get_template('header/header-mobile-template' ); ?>
	<?php g5plus_get_template('header/' . $g5plus_header_layout ); ?>
	<?php if (($header_search_box == '1') || ($mobile_header_search_box == '1')): ?>
		<?php g5plus_get_template('header/search','popup'); ?>
	<?php endif; ?>
<?php endif; ?>