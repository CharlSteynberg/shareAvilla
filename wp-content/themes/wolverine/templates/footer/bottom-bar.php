<?php
$prefix = 'g5plus_';
$bottom_bar = g5plus_rwmb_meta($prefix . 'bottom_bar');
if (!isset($bottom_bar) || $bottom_bar === '-1' || $bottom_bar=='') {
    $bottom_bar = g5plus_get_option('bottom_bar','1');
}

$bottom_bar_layout_custom = g5plus_rwmb_meta($prefix . 'bottom_bar_layout');
$bottom_bar_layout = $bottom_bar_layout_custom;
if (!isset($bottom_bar_layout) ||  $bottom_bar_layout == '-1' || $bottom_bar_layout=='') {
    $bottom_bar_layout = g5plus_get_option('bottom_bar_layout','bottom-bar-4');
}

if (!isset($bottom_bar_layout_custom) ||  $bottom_bar_layout_custom == '-1' || $bottom_bar_layout_custom == '') {
	$bottom_bar_left_sidebar = g5plus_get_option('bottom_bar_left_sidebar','bottom_bar_left');
} else {
	$bottom_bar_left_sidebar = g5plus_rwmb_meta($prefix . 'bottom_bar_left_sidebar');
}

if (!isset($bottom_bar_layout_custom) ||  $bottom_bar_layout_custom == '-1' || $bottom_bar_layout_custom == '') {
	$bottom_bar_right_sidebar = g5plus_get_option('bottom_bar_right_sidebar','bottom_bar_right');
} else {
	$bottom_bar_right_sidebar = g5plus_rwmb_meta($prefix . 'bottom_bar_right_sidebar');
}

$col_left_class = $col_right_class = 'col-md-6';
switch ($bottom_bar_layout) {
	case 'bottom-bar-2':
		$col_left_class =  'col-md-9';
		$col_right_class = 'col-md-3';
		break;
	case 'bottom-bar-3':
		$col_left_class =  'col-md-3';
		$col_right_class = 'col-md-9';
		break;
	case 'bottom-bar-4':
		$col_left_class =  'col-md-12';
		$bottom_bar_right_sidebar = '';
		break;

}

if (!is_active_sidebar($bottom_bar_left_sidebar) || !is_active_sidebar($bottom_bar_left_sidebar)) {
	$col_left_class =  'col-md-12';
	$col_right_class =  'col-md-12';
}

$sidebar_bottom_right_class = array($col_right_class, 'sidebar', 'text-right');
$sidebar_bottom_left_class = array($col_left_class, 'sidebar');
if($bottom_bar_layout === 'bottom-bar-4'){
	$sidebar_bottom_left_class[] = 'text-center';
}
else {
	$sidebar_bottom_left_class[] = 'text-left';
}

if($bottom_bar==='1' && ( ($bottom_bar_left_sidebar!='' && is_active_sidebar($bottom_bar_left_sidebar)) ||
                            ($bottom_bar_right_sidebar!='' && is_active_sidebar($bottom_bar_right_sidebar))
   ) ){
?>
<div class="bottom-bar-wrapper">
    <div class="container">
	    <div class="bottom-bar-inner">
		    <div class="row">
			    <div class="<?php echo join(' ', $sidebar_bottom_left_class) ?>">
				    <?php if($bottom_bar_left_sidebar!='' && is_active_sidebar($bottom_bar_left_sidebar)) {
					    dynamic_sidebar($bottom_bar_left_sidebar);
				    }
				    ?>
			    </div>
			    <div class="<?php echo join(' ', $sidebar_bottom_right_class) ?>">
				    <?php if($bottom_bar_right_sidebar!='' && is_active_sidebar($bottom_bar_right_sidebar)) {
					    dynamic_sidebar($bottom_bar_right_sidebar);
				    }
				    ?>
			    </div>
		    </div>
	    </div>
    </div>
</div>
<?php } ?>