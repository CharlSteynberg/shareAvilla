<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/9/2015
 * Time: 4:12 PM
 */
?>
<ul class="entry-meta">
    <?php if (has_category()): ?>
        <?php
        $cat_name = '';
        $terms = get_the_category(get_the_ID());
        if ($terms) {
            $cat_link = get_term_link( $terms[0], 'category' );
            $cat_name = $terms[0]->name;
        }
        ?>
        <?php if (!empty($cat_name)) : ?>
            <li class="entry-meta-category">
                <a href="<?php echo esc_url($cat_link) ?>" ><?php echo esc_html($cat_name);?></a>
            </li>
        <?php endif; ?>
    <?php endif; ?>
    <li class="entry-meta-date">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"> <?php echo  get_the_date("d.m.y");?> </a>
    </li>
    <?php edit_post_link( __( 'Edit', 'wolverine' ), '<li class="edit-link">', '</li>' ); ?>
</ul>