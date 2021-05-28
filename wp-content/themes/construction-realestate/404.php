<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package Construction Realestate
 */
get_header(); ?>

<main id="skip_content" role="main" class="content_box main-wrapper">
    <div class="container page-content text-center">
        <h1><?php echo esc_html(get_theme_mod('construction_realestate_page_not_found_heading',__('404 Not Found','construction-realestate')));?></h1>
        <p class="text-404"><?php echo esc_html(get_theme_mod('construction_realestate_page_not_found_text',__('Looks like you have taken a wrong turn. Dont worry it happens to the best of us.','construction-realestate')));?></p>
        <?php if( get_theme_mod('construction_realestate_page_not_found_button','Back to Home Page') != ''){ ?>
            <div class="read-moresec my-4">
                <a href="<?php echo esc_url( home_url() ); ?>" class="button mt-2 py-2 px-3"><?php echo esc_html(get_theme_mod('construction_realestate_page_not_found_button',__('Back to Home Page','construction-realestate')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('construction_realestate_page_not_found_button',__('Back to Home Page','construction-realestate')));?></span></a>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</main>

<?php get_footer(); ?>