<?php
$prefix = 'g5plus_';

$header_class = array('mobile-header');

// get header mobile layout
$mobile_header_layout = g5plus_rwmb_meta($prefix . 'mobile_header_layout');
$opt_mobile_header_layout = g5plus_get_option('mobile_header_layout','header-mobile-2');
if (($mobile_header_layout === '')) {
	$mobile_header_layout = 'header-mobile-1';
	if (!empty($opt_mobile_header_layout)) {
		$mobile_header_layout = $opt_mobile_header_layout;
	}
}

$header_class[] = $mobile_header_layout;

// Get logo url for mobile
$logo_meta_id = g5plus_rwmb_meta($prefix . 'custom_logo_mobile');
$logo_meta = g5plus_rwmb_meta($prefix . 'custom_logo_mobile', 'type=image_advanced');
$logo_url = '';
if ($logo_meta !== array() && isset($logo_meta[$logo_meta_id]) && isset($logo_meta[$logo_meta_id]['full_url'])) {
	$logo_url = $logo_meta[$logo_meta_id]['full_url'];
}

$opt_mobile_header_logo = g5plus_get_option('mobile_header_logo',array(
	'url' => THEME_URL . 'assets/images/theme-options/logo.png'
));
$opt_logo = g5plus_get_option('logo',array(
	'url' => THEME_URL . 'assets/images/theme-options/logo.png'
));
if ($logo_url === '') {
	$logo_url = THEME_URL . 'assets/images/theme-options/logo.png';
	if (is_array($opt_mobile_header_logo) &&  isset($opt_mobile_header_logo['url']) && !empty($opt_mobile_header_logo['url'])) {
		$logo_url = $opt_mobile_header_logo['url'];
	}
	else if (is_array($opt_logo) && isset($opt_logo['url']) && !empty($opt_logo['url'])) {
		$logo_url = $opt_logo['url'];
	}
}

// Get search & mini-cart for header mobile
$mobile_header_shopping_cart = g5plus_rwmb_meta($prefix . 'mobile_header_shopping_cart');
if (($mobile_header_shopping_cart === '') || ($mobile_header_shopping_cart == '-1')) {
	$mobile_header_shopping_cart = g5plus_get_option('mobile_header_shopping_cart','1');
}

$mobile_header_search_box = g5plus_rwmb_meta($prefix . 'mobile_header_search_box');
if (($mobile_header_search_box === '') || ($mobile_header_search_box == '-1')) {
	$mobile_header_search_box = g5plus_get_option('mobile_header_search_box','1');
}

$mobile_header_menu_drop = g5plus_rwmb_meta($prefix . 'mobile_header_menu_drop');
if (($mobile_header_menu_drop === '') || ($mobile_header_menu_drop == '-1')) {
	$mobile_header_menu_drop = 'dropdown';
	$opt_mobile_header_menu_drop = g5plus_get_option('mobile_header_menu_drop','fly');
	if (!empty($opt_mobile_header_menu_drop)) {
		$mobile_header_menu_drop = $opt_mobile_header_menu_drop;
	}
}

$header_container_wrapper_class = array('header-container-wrapper', 'menu-drop-' . $mobile_header_menu_drop);

$mobile_header_stick = g5plus_rwmb_meta($prefix . 'mobile_header_stick');
if (($mobile_header_stick === '') || ($mobile_header_stick == '-1')) {
	$mobile_header_stick = g5plus_get_option('mobile_header_stick','1');
}
if ($mobile_header_stick == '1') {
	$header_container_wrapper_class[] = 'header-mobile-sticky';
}

$page_menu = g5plus_rwmb_meta($prefix . 'page_menu_mobile');
if (empty($page_menu)) {
	$page_menu = g5plus_rwmb_meta($prefix . 'page_menu');
}

$theme_location = 'primary';
if (wp_is_mobile() && has_nav_menu( 'mobile' )) {
	$theme_location = 'mobile';
}

$header_mobile_nav = array('header-mobile-nav' , 'menu-drop-' . $mobile_header_menu_drop);

$opt_logo_mobile_height = g5plus_get_option('logo_mobile_height');
$logo_mobile_height = '';
if (is_array($opt_logo_mobile_height) && isset($opt_logo_mobile_height['height']) && ! empty($opt_logo_mobile_height['height'])) {
	$logo_mobile_height = $opt_logo_mobile_height['height'];
}

$logo_attr = array();
if (!empty($logo_mobile_height)) {
    $logo_attr[] = sprintf('style="height:%s"',$logo_mobile_height);
}


?>
<header id="header-mobile" class="<?php echo join(' ', $header_class) ?>">
	<?php if ($mobile_header_layout == 'header-mobile-2'): ?>
		<div class="header-mobile-before">
			<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
				<img <?php echo join(' ', $logo_attr)?> src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
			</a>
		</div>
	<?php endif;?>
	<div class="<?php echo join(' ', $header_container_wrapper_class); ?>">
		<div class="container header-mobile-wrapper">
			<div class="header-mobile-inner">
				<div class="toggle-icon-wrapper toggle-mobile-menu" data-ref="nav-menu-mobile" data-drop-type="<?php echo esc_attr($mobile_header_menu_drop); ?>">
					<div class="toggle-icon"> <span></span></div>
				</div>
				<div class="header-customize">
					<?php if ($mobile_header_search_box == '1'): ?>
						<?php g5plus_get_template('header/search-button-mobile'); ?>
					<?php endif; ?>
					<?php if (($mobile_header_shopping_cart == '1') && class_exists( 'WooCommerce' )): ?>
						<?php g5plus_get_template('header/mini-cart'); ?>
					<?php endif; ?>
				</div>
				<?php if ($mobile_header_layout != 'header-mobile-2'): ?>
					<div class="header-logo-mobile">
						<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
							<img <?php echo join(' ', $logo_attr)?> src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
						</a>
					</div>
				<?php endif;?>
			</div>
			<div id="nav-menu-mobile" class="<?php echo join(' ', $header_mobile_nav) ?>">
				<?php echo apply_filters('g5plus_before_menu_mobile_filter',''); ?>
				<?php if (has_nav_menu($theme_location)) : ?>
					<?php
					$arg_menu = array(
						'container' => '',
						'theme_location' => $theme_location,
						'menu_class' => 'nav-menu-mobile',
						'is_mobile_menu' => true
					);
					if (!empty($page_menu)) {
						$arg_menu['menu'] = $page_menu;
					}
					wp_nav_menu( $arg_menu );
					?>
				<?php endif; ?>
				<?php echo apply_filters('g5plus_after_menu_mobile_filter',''); ?>

			</div>
			<?php if ($mobile_header_menu_drop == 'fly'): ?>
				<div class="main-menu-overlay"></div>
			<?php endif;?>
		</div>
	</div>
</header>
