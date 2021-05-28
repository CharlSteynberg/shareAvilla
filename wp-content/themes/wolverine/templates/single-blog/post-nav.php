<?php
// Don't print empty markup if there's nowhere to navigate.
$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
$next = get_adjacent_post(false, '', false);

if (!$next && !$previous) {
    return;
}
$prefix = 'g5plus_';
$show_post_navigation = g5plus_rwmb_meta($prefix.'show_post_navigation');
if ($show_post_navigation == -1 || $show_post_navigation === '') {
    $show_post_navigation = g5plus_get_option('show_post_navigation',1);
}
if ($show_post_navigation == 0) {
    return;
}
?>
<nav class="post-navigation" role="navigation">
    <div class="nav-links">
        <?php
        previous_post_link('<div class="nav-previous">%link</div>', _x('<i class="post-navigation-icon fa fa-chevron-left"></i> <div class="post-navigation-content"><div class="post-navigation-label">Previous Post</div> <div class="post-navigation-title">%title </div> </div> ', 'Previous post link', 'wolverine'));
        next_post_link('<div class="nav-next">%link</div>', _x('<i class="post-navigation-icon fa fa-chevron-right"></i> <div class="post-navigation-content"><div class="post-navigation-label">Next Post</div> <div class="post-navigation-title">%title</div></div> ', 'Next post link', 'wolverine'));
        ?>
    </div>
    <!-- .nav-links -->
</nav><!-- .navigation -->