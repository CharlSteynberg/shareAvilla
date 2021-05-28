<?php
global $g5plus_archive_loop;

if (isset($g5plus_archive_loop['image-size'])) {
    $size = $g5plus_archive_loop['image-size'];
} else {
    $size = 'full';
}

$archive_style = 'classic-01';
if (isset($g5plus_archive_loop['style']) && !empty($g5plus_archive_loop['style'])) {
    $archive_style  = $g5plus_archive_loop['style'];
}

$class = array();
$class[]= "clearfix";



?>
<?php if ($archive_style == 'classic-01') : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
        <div class="entry-wrap clearfix">
            <?php
            $thumbnail = g5plus_post_thumbnail($size);
            if (!empty($thumbnail)) : ?>
                <div class="entry-thumbnail-wrap">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
            <?php endif; ?>
            <div class="entry-content-wrap">
                <div class="entry-post-meta-wrap">
                    <?php g5plus_post_meta(); ?>
                </div>
                <h3 class="entry-title">
                    <a class="bold-color link-color-hover link-color-active" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <div class="entry-post-meta-bottom-wrap">
                    <div class="entry-meta-author">
                        <?php _e('Posted by','wolverine') ?> <?php printf('<a href="%1$s">%2$s</a>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())); ?>
                    </div>
                    <?php g5plus_share(); ?>
                </div>
            </div>
        </div>
    </article>
<?php elseif ($archive_style == 'classic-02') : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
        <div class="entry-wrap clearfix">
            <?php
            $thumbnail = g5plus_post_thumbnail($size);
            if (!empty($thumbnail)) : ?>
                <div class="entry-thumbnail-wrap">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
            <?php endif; ?>
            <div class="entry-content-wrap">
                <div class="entry-post-meta-wrap text-center">
                    <?php g5plus_post_meta_related(); ?>
                </div>
                <h3 class="entry-title text-center">
                    <a class="bold-color link-color-hover link-color-active" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <div class="text-center read-more-wrap">
                    <a class="wolverine-button style2 button-3x" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php _e('Read more','wolverine') ?></a>
                </div>
                <div class="entry-post-meta-bottom-wrap">
                    <div class="entry-meta-author">
                        <?php _e('Posted by','wolverine') ?> <?php printf('<a href="%1$s">%2$s</a>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())); ?>
                    </div>
                    <?php g5plus_share(); ?>
                </div>
            </div>
        </div>
    </article>
<?php elseif (($archive_style == 'grid-01') || ($archive_style == 'masonry-01')) : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
        <div class="entry-wrap clearfix">
            <?php
            $thumbnail = g5plus_post_thumbnail($size);
            if (!empty($thumbnail)) : ?>
                <div class="entry-thumbnail-wrap">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
            <?php endif; ?>
            <div class="entry-content-wrap text-center">
                <div class="entry-content-inner">
                    <div class="entry-post-meta-wrap">
                        <?php g5plus_post_meta(); ?>
                    </div>
                    <h3 class="entry-title">
                        <a class="bold-color link-color-hover link-color-active" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
        <div class="entry-wrap clearfix">
            <?php
            $thumbnail = g5plus_post_thumbnail($size);
            if (!empty($thumbnail)) : ?>
                <div class="entry-thumbnail-wrap">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
            <?php endif; ?>
            <div class="entry-content-wrap">
                <div class="entry-content-inner">
                    <h3 class="entry-title">
                        <a class="bold-color link-color-hover link-color-active" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="entry-post-meta-wrap">
                        <?php g5plus_post_meta(); ?>
                        <?php g5plus_share(); ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php endif; ?>

