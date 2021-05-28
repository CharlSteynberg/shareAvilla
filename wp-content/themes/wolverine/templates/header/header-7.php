<?php
$prefix = 'g5plus_';

$header_class = array('main-header', 'header-7', 'header-left');

$header_nav_wrapper = array('header-nav-wrapper', 'header-desktop-wrapper');

$header_nav_hover = g5plus_rwmb_meta($prefix . 'header_nav_hover');
if (($header_nav_hover == '') || ($header_nav_hover == '-1')) {
	$header_nav_hover = g5plus_get_option('header_nav_hover','nav-hover-primary');
}
$header_nav_wrapper[] = $header_nav_hover;

$page_menu = g5plus_rwmb_meta($prefix . 'page_menu');
?>
<header id="header" class="<?php echo join(' ', $header_class) ?>">
	<div class="header-nav-above">
		<?php g5plus_get_template('header/header','logo' ); ?>
	</div>
	<div class="<?php echo join(' ', $header_nav_wrapper) ?>">
		<?php if (has_nav_menu('primary')) : ?>
			<div id="primary-menu" class="menu-wrapper">
				<?php
				$arg_menu = array(
					'menu_id' => 'main-menu',
					'container' => '',
					'theme_location' => 'primary',
					'menu_class' => 'main-menu x-nav-vmenu'
				);
				if (!empty($page_menu)) {
					$arg_menu['menu'] = $page_menu;
				}
				wp_nav_menu( $arg_menu );
				?>
			</div>
		<?php endif; ?>
		<?php echo apply_filters('g5plus_header_customize_filter',''); ?>
	</div>
</header>