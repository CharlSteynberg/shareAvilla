<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/3/2015
 * Time: 10:20 AM
 */
?>
<?php if (!is_front_page()) : ?>
	<?php g5plus_get_breadcrumb(); ?>
<?php else: ?>
	<ul class="breadcrumbs">
		<li><a rel="v:url" href="<?php echo home_url('/') ?>" class="home"><?php _e('Home','wolverine');?> </a></li>
		<li><span><?php _e('Blog', 'wolverine'); ?></span></li>
	</ul>
<?php endif; ?>