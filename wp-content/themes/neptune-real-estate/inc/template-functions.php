<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Neptune WP
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function neptune_real_estate_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'neptune_real_estate_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function neptune_real_estate_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'neptune_real_estate_pingback_header' );

function neptune_real_estate_logo_f() {
			the_custom_logo(); ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

			<?php $description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
			<?php
			endif;
}

add_filter('neptune_real_estate_logo', 'neptune_real_estate_logo_f');


/**
 * Template for comments and pingbacks.
 */
if ( ! function_exists( 'neptune_real_estate_theme_comment' ) ) {

	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own neptune_real_estate_theme_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param  string $comment Comment.
	 * @param  array  $args    Comment arguments.
	 * @param  number $depth   Depth.
	 * @return mixed          Comment markup.
	 */
	function neptune_real_estate_theme_comment( $comment, $args, $depth ) {

		switch ( $comment->comment_type ) {

			case 'pingback':
			case 'trackback':
				// Display trackbacks differently than normal comments.
			?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p><?php esc_html_e( 'Pingback:', 'neptune-real-estate' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'neptune-real-estate' ), '<span class="edit-link">', '</span>' ); ?></p>
				</li>
				<?php
				break;

			default:
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

					<article id="comment-<?php comment_ID(); ?>" class="ast-comment">
						<div class='ast-comment-avatar-wrap'><?php echo get_avatar( $comment, 50 ); ?></div><!-- Remove 1px Space
						--><div class="ast-comment-data-wrap">
							<div class="ast-comment-meta-wrap">
								<header class="ast-comment-meta ast-row ast-comment-author vcard capitalize">

									<?php

									printf(
										'<div class="ast-comment-cite-wrap ast-col-lg-12"><cite><b class="fn">%1$s</b> %2$s</cite></div>',
										get_comment_author_link(),
										// If current post author is also comment author, make it known visually.
										( $comment->user_id === $post->post_author ) ? '<span class="ast-highlight-text ast-cmt-post-author"></span>' : ''
									);

									printf(
										'<div class="ast-comment-time ast-col-lg-12"><span  class="timendate"><a href="%1$s"><time datetime="%2$s">%3$s</time></a></span></div>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										get_comment_time( 'c' ),
										/* translators: 1: date, 2: time */
										sprintf( esc_html__( '%1$s at %2$s', 'neptune-real-estate' ), get_comment_date(), get_comment_time() )
									);

									?>

								</header> <!-- .ast-comment-meta -->
							</div>
							<section class="ast-comment-content comment">
								<?php comment_text(); ?>
								<div class="ast-comment-edit-reply-wrap">
									<?php edit_comment_link( neptune_real_estate_default_strings( 'string-comment-edit-link', false ), '<span class="ast-edit-link">', '</span>' ); ?>
									<?php
									comment_reply_link(
										array_merge(
											$args, array(
												'reply_text' => neptune_real_estate_default_strings( 'string-comment-reply-link', false ),
												'add_below' => 'comment',
												'depth'  => $depth,
												'max_depth' => $args['max_depth'],
												'before' => '<span class="ast-reply-link">',
												'after'  => '</span>',
											)
										)
									);
									?>
								</div>
								<?php if ( '0' == $comment->comment_approved ) : ?>
									<p class="ast-highlight-text comment-awaiting-moderation"><?php echo esc_html( neptune_real_estate_default_strings( 'string-comment-awaiting-moderation', false ) ); ?></p>
								<?php endif; ?>
							</section> <!-- .ast-comment-content -->
						</div>
					</article><!-- #comment-## -->
				<!-- </li> -->
				<?php
				break;
		} // End switch().
	}
}// End if().
