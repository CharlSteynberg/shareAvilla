<?php
    $search_box_type = g5plus_get_option('search_box_type','standard');
?>
<div class="search-button-wrapper header-customize-item">
	<a class="icon-search-menu" href="#" data-search-type="<?php echo esc_attr($search_box_type) ?>"><i class="wicon icon-search-icon"></i></a>
</div>