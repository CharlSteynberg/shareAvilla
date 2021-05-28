<?php
$demo_site = array(
	'main' => array(
		'name' => __('Main','wolverine'),
		'path'  => 'wolverine/main',
	),
	'portfolio' => array(
		'name' => __('Portfolio','wolverine'),
		'path'  => 'wolverine/portfolio',
	),
	/*'portfolio-2' => array(
		'name' => __('Portfolio 2','wolverine'),
		'path'  => 'wolverine/portfolio-2',
	),*/
	'blog' => array(
		'name' => __('Blog','wolverine'),
		'path'  => 'wolverine/blog',
	),
	'garden' => array(
		'name' => __('Garden ','wolverine'),
		'path'  => 'wolverine/garden',
	),
	'restaurant' => array(
		'name' => __('Restaurant ','wolverine'),
		'path'  => 'wolverine/restaurant',
	),
);
foreach ($demo_site as $key => $value) {
	$demo_site[$key]['image'] = G5PLUS_FRAMEWORK_THEME_URL . 'assets/data-demo/' . $key . '/preview.jpg';
}

$hide_fix_class = 'hide';
if (isset($_REQUEST['fix-demo-data']) && ($_REQUEST['fix-demo-data'] == '1')) {
$hide_fix_class = '';
}
?>
<div class="g5plus-demo-data-wrapper">
	<h1><?php esc_html_e('G5PLUS - Install Demo Data','wolverine') ?></h1>
	<p><?php esc_html_e('Please choose demo to install (take about 3-35 mins)','wolverine') ?></p>
	<div class="install-message" data-success="<?php esc_attr_e('Install Done','wolverine') ?>"></div>

	<div class="g5plus-demo-site-wrapper">
		<?php foreach ($demo_site as $key => $value): ?>
			<div class="g5plus-demo-site">
				<div class="g5plus-demo-site-inner">
					<div class="demo-site-thumbnail">
						<div class="centered">
							<img src="<?php echo esc_url($value['image'])?>" alt="<?php echo esc_attr($value['name'])?>"/>
						</div>
					</div>
				</div>
				<h3><span><?php echo esc_html($value['name'])?></span><span class="install-button" data-demo="<?php echo esc_attr($key) ?>" data-path="<?php echo esc_attr($value['path']) ?>"><?php esc_html_e('Install','wolverine'); ?></span></h3>
				<button class="fix_install_demo_error <?php echo esc_attr($hide_fix_class) ?>" data-demo="<?php echo esc_attr($key) ?>" data-path="<?php echo esc_attr($value['path']) ?>"><?php esc_html_e('Fix Setting','wolverine') ?></button>
			</div>
		<?php endforeach; ?>
		<div class="clear"></div>
	</div>
	<div class="install-progress-wrapper">
		<div class="title"><?php esc_html_e('Reset theme options','wolverine') ?></div>
		<div id="g5plus_reset_option" class="meter"><span style="width: 0%"></span></div>

		<div class="title"><?php esc_html_e('Install Demo Data','wolverine') ?></div>
		<div id="g5plus_install_demo" class="meter orange"><span style="width: 0%"></span></div>

		<div class="title"><?php esc_html_e('Import slider','wolverine') ?></div>
		<div id="g5plus_import_slider" class="meter red"><span style="width: 0%"></span></div>
	</div>
</div>