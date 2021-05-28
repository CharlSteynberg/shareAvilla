<?php
$prefix = 'g5plus_';

$enable_header_customize = g5plus_rwmb_meta($prefix . 'enable_header_customize');

$header_customize_text = '';

if ($enable_header_customize == '1') {
	$header_customize_text = g5plus_rwmb_meta($prefix . 'header_customize_text');
}
else {
	$header_customize_text = g5plus_get_option('header_customize_text');
}
?>
<?php if (!empty($header_customize_text)): ?>
	<div class="custom-text-wrapper header-customize-item">
		<?php echo apply_filters('header_customize_custom_text', $header_customize_text);?>
	</div>
<?php endif;?>