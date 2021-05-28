<?php
/**
 * The template part for displaying a message that posts cannot be found.
 * @package Construction Realestate
 */
?>

<header role="banner">
	<h2 class="entry-title"><?php echo esc_html(get_theme_mod('construction_realestate_no_search_result_heading',__('Nothing Found','construction-realestate')));?></h2>
</header>
<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.','construction-realestate'), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php elseif ( is_search() ) : ?>
	<p><?php echo esc_html(get_theme_mod('construction_realestate_no_search_result_text',__('Sorry, but nothing matched your search terms. Please try again with some different keywords.','construction-realestate')));?></p><br />
		<?php get_search_form(); ?>
<?php else : ?>
	<p><?php esc_html_e( 'Dont worry it happens to the best of us.', 'construction-realestate' ); ?></p><br />
	<div class="read-moresec my-4">
		<a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right mt-2 py-2 px-3"><?php esc_html_e( 'Back to Home Page', 'construction-realestate' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Back to Home Page', 'construction-realestate' ); ?></span></a>
	</div>
<?php endif; ?>