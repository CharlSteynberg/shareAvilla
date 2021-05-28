<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/4/15
 * Time: 11:33 AM
 */
?>
<?php if (is_home() && current_user_can('publish_posts')) : ?>

    <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wolverine'), admin_url('post-new.php')); ?></p>

<?php elseif (is_search()) : ?>

    <p><?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'wolverine'); ?></p>
    <?php get_search_form(); ?>

<?php
else : ?>
    <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wolverine'); ?></p>
    <?php get_search_form(); ?>
<?php endif; ?>