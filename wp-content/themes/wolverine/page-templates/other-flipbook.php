<?php
/**
 * Template Name: Other Page Flip book
 *
 * @package g5plus-framework
 */

remove_action('g5plus_before_page_wrapper_content','g5plus_page_above_header',10);
remove_action('g5plus_before_page_wrapper_content','g5plus_page_top_bar',10);
remove_action('g5plus_before_page_wrapper_content','g5plus_page_header',15);
$enable_minifile_js = g5plus_get_option('enable_minifile_js',0);
$min_suffix = $enable_minifile_js == 1 ? '.min' : '';

wp_register_script('other_flipbook_scripts',
    plugins_url() . '/wolverine-framework/includes/shortcodes/portfolio/assets/js/flipbook' . $min_suffix . '.js',array('jquery') );
wp_enqueue_script('other_flipbook_scripts' );

get_header();
$home_portfolio_flipbook = g5plus_get_option('home_portfolio_flip_book_url');
?>
<div class="other-page-flipbook">
    <?php if($home_portfolio_flipbook != ''){ ?>
        <div class="goto-menu">
            <a href="<?php echo sprintf('%s',$home_portfolio_flipbook); ?>?action=menu" class="secondary-font"><?php echo __('Menu','wolverine') ?></a>
        </div>
        <div class="goto-search">
            <a href="<?php echo sprintf('%s',$home_portfolio_flipbook); ?>?action=search"><i class="wicon icon-outline-vector-icons-pack-95"></i></a>
        </div>
    <?php } ?>
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
<?php remove_action('g5plus_main_wrapper_footer','g5plus_footer_widgets',10); ?>
<script type="text/javascript">
    "use strict";
    jQuery(document).ready(function(){
        Page.initFlipOtherPageHeight();
        jQuery(window).resize(function(){
            Page.initFlipOtherPageHeight();
        });
    })
</script>
<?php get_footer(); ?>