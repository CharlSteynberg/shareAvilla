<?php
global  $g5plus_header_layout;

$prefix = 'g5plus_';
$logo_meta_id = g5plus_rwmb_meta($prefix . 'custom_logo');
$logo_meta = g5plus_rwmb_meta($prefix . 'custom_logo', 'type=image_advanced');
$logo_url = '';
if ($logo_meta !== array() && isset($logo_meta[$logo_meta_id]) && isset($logo_meta[$logo_meta_id]['full_url'])) {
	$logo_url = $logo_meta[$logo_meta_id]['full_url'];
}

$opt_logo = g5plus_get_option('logo',array(
	'url' => THEME_URL . 'assets/images/theme-options/logo.png'
));

$opt_sticky_logo = g5plus_get_option('sticky_logo',array(
	'url' => THEME_URL . 'assets/images/theme-options/logo.png'
));

if ($logo_url === '') {
	$logo_url = THEME_URL . 'assets/images/theme-options/logo.png';

	if (is_array($opt_logo) && isset($opt_logo['url']) && !empty($opt_logo['url'])) {
		$logo_url = $opt_logo['url'];
	}
}

$logo_sticky = '';

if (!in_array($g5plus_header_layout, array('header-2', 'header-4', 'header-5', 'header-6', 'header-7'))) {
	$logo_sticky_meta_id = g5plus_rwmb_meta($prefix . 'sticky_logo');
	$logo_sticky_meta = g5plus_rwmb_meta($prefix . 'sticky_logo', 'type=image_advanced');

	$logo_sticky = '';
	if ($logo_sticky_meta !== array() && isset($logo_sticky_meta[$logo_sticky_meta_id]) && isset($logo_sticky_meta[$logo_sticky_meta_id]['full_url'])) {
		$logo_sticky = $logo_sticky_meta[$logo_sticky_meta_id]['full_url'];
	}
	if (empty($logo_sticky)) {
		if (is_array($opt_sticky_logo) && isset($opt_sticky_logo['url'])) {
			$logo_sticky = $opt_sticky_logo['url'];
		}
		else if (is_array($opt_logo) && isset($opt_logo) && isset($opt_logo['url'])) {
			$logo_sticky = $opt_logo['url'];
		}
	}
}

$header_logo_class = array('header-logo');
if (!empty($logo_sticky) && ($logo_sticky != $logo_url)) {
	$header_logo_class[] = 'has-logo-sticky';
}

// Logo Height
$opt_logo_height = g5plus_get_option('logo_height');
$logo_height = g5plus_rwmb_meta($prefix . 'logo_height');
if ($logo_height == '') {
	if (is_array($opt_logo_height) && isset($opt_logo_height['height']) && ! empty($opt_logo_height['height'])) {
		$logo_height = $opt_logo_height['height'];
	}
}
$logo_height = str_replace('px' , '', $logo_height);
if ($logo_height != '') {
	$logo_height .= 'px';
}

$logo_attr = array();
if (!empty($logo_height)) {
    $logo_attr[] = sprintf('style="height:%s"', $logo_height);
}


?>
<div class="<?php echo join(' ', $header_logo_class) ?>">
	<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
		<img <?php echo join(' ', $logo_attr)?> src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
	</a>
</div>
<?php if (!empty($logo_sticky) && ($logo_sticky != $logo_url)): ?>
	<div class="logo-sticky">
		<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
			<img src="<?php echo esc_url($logo_sticky); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
		</a>
	</div>
<?php endif;?>