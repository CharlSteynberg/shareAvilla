<?php
$prefix = 'g5plus_';
$show_author_info = g5plus_rwmb_meta($prefix.'show_author_info');
if ($show_author_info == -1 || $show_author_info === '') {
    $show_author_info = g5plus_get_option('show_author_info',1);
}
if ($show_author_info == 0) {
    return;
}

$author_description = get_the_author_meta('description');
if (empty($author_description)) return;
?>
<div class="author-info clearfix">
    <div class="author-avatar">
        <?php
        $author_avatar_size = apply_filters( 'g5plus_framework_author_avatar_size', 200 );
        echo get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size );
        ?>
    </div>
    <div class="author-description">
        <h3 class="author-title"><?php the_author_posts_link(); ?></h3>
        <p class="author-bio"><?php the_author_meta( 'description' ); ?></p>
    </div>
</div>