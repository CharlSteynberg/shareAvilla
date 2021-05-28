<?php
$prefix = 'g5plus_';

$top_drawer_type = g5plus_rwmb_meta($prefix . 'top_drawer_type');
if (($top_drawer_type === false) || ($top_drawer_type === '') || ($top_drawer_type == '-1')) {
	$top_drawer_type = g5plus_get_option('top_drawer_type','none');
}

// Top drawer type = DISABLE
if ($top_drawer_type == 'none') {
	return;
}

$top_drawer_sidebar = g5plus_rwmb_meta($prefix . 'top_drawer_sidebar');
if (($top_drawer_sidebar === false) || ($top_drawer_sidebar === '') || ($top_drawer_sidebar == '-1')) {
	$top_drawer_sidebar = g5plus_get_option('top_drawer_sidebar','top_drawer_sidebar');
}

// Top drawer sidebar = NONE
if ($top_drawer_sidebar == '-2') {
	return;
}

$top_drawer_wrapper_layout = g5plus_rwmb_meta($prefix . 'top_drawer_wrapper_layout');
if (($top_drawer_wrapper_layout === false) || ($top_drawer_wrapper_layout === '') || ($top_drawer_wrapper_layout == '-1')) {
	$top_drawer_wrapper_layout = g5plus_get_option('top_drawer_wrapper_layout','container');
}

$top_drawer_class='top-drawer-show';
if ($top_drawer_type!='show') {
    $top_drawer_class = 'top-drawer-hide';
}

$top_drawer_hide_mobile = g5plus_rwmb_meta($prefix . 'top_drawer_hide_mobile');
if (($top_drawer_hide_mobile === false) || ($top_drawer_hide_mobile === '') || ($top_drawer_hide_mobile == '-1')) {
	$top_drawer_hide_mobile = g5plus_get_option('top_drawer_hide_mobile','1');
}

$top_drawer_area_class = '';
if ($top_drawer_hide_mobile == '0') {
	$top_drawer_area_class = 'hidden-sm hidden-xs';
}
?>
<?php if (is_active_sidebar( $top_drawer_sidebar)): ?>
<div id="top-drawer-area" class="<?php echo esc_attr($top_drawer_area_class) ?>">
    <div id="top-drawer-bar" class="<?php echo esc_attr($top_drawer_class); ?>">
        <?php if($top_drawer_wrapper_layout!='full'):?>
        <div class="<?php echo esc_attr($top_drawer_wrapper_layout) ?>">
        <?php endif;?>
            <div class="sidebar sidebar-top-drawer row">
                <?php dynamic_sidebar( $top_drawer_sidebar );?>
            </div>
        <?php if($top_drawer_wrapper_layout!='full'):?>
        </div>
        <?php endif;?>
    </div>
    <?php if ($top_drawer_type!='show'): ?>
        <a href="#" class="top-drawer-toggle"><i class="wicon icon-plus"></i></a>
    <?php endif;?>
</div>
<?php endif;?>