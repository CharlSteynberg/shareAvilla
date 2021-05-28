<?php
	global  $g5plus_header_layout;
    $search_box_type = g5plus_get_option('search_box_type','standard');
	$search_box_submit = $search_box_type === 'ajax' ? 'button' :  'submit';
?>
<?php if (in_array($g5plus_header_layout, array('header-2', 'header-4')) || (($g5plus_header_layout == 'header-7') && ($search_box_type == 'standard'))): ?>
	<div class="search-button-wrapper header-customize-item" data-hint-message="<?php _e('Type at least 3 characters to search','wolverine') ?>">
		<form method="get" action="<?php echo esc_url(site_url()); ?>" class="search-type-<?php echo esc_attr($search_box_type) ?>">
			<input type="text" name="s" placeholder="<?php _e('Search','wolverine'); ?>"/>
			<button type="<?php echo esc_attr($search_box_submit) ?>"><i class="wicon icon-search-icon"></i></button>
		</form>
	</div>
<?php else:?>
	<div class="search-button-wrapper header-customize-item <?php echo esc_attr($search_box_type) ?>">
		<a class="icon-search-menu" href="#" data-search-type="<?php echo esc_attr($search_box_type) ?>"><i class="wicon icon-search-icon"></i></a>
	</div>
<?php endif;?>