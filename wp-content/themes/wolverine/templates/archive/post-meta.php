<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/4/2015
 * Time: 3:32 PM
 */
?>
<ul class="entry-meta">
    <?php if (has_category()): ?>
        <li class="entry-meta-category">
            <?php echo get_the_category_list(', '); ?>
        </li>
    <?php endif; ?>
    <li class="entry-meta-date">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"> <?php echo  get_the_date(get_option('date_format'));?> </a>
    </li>
    <?php edit_post_link( __( 'Edit', 'wolverine' ), '<li class="edit-link">', '</li>' ); ?>
</ul>