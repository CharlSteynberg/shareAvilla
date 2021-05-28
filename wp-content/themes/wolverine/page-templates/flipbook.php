<?php
/**
 * Template Name: Flip book
 *
 * @package g5plus-framework
 */

remove_action('g5plus_before_page_wrapper_content','g5plus_page_above_header',10);
remove_action('g5plus_before_page_wrapper_content','g5plus_page_top_bar',10);
remove_action('g5plus_before_page_wrapper_content','g5plus_page_header',15);

get_header();
?>
<div class="page-flipbook">
    <?php
    // TO SHOW THE PAGE CONTENTS
    while ( have_posts() ) : the_post(); ?>
        <div class="entry-content-page">
            <?php the_content(); ?>
        </div>
    <?php
    endwhile;
    wp_reset_query();
    ?>
</div>
<?php
remove_action('g5plus_main_wrapper_footer','g5plus_footer_widgets',10);
get_footer();
?>