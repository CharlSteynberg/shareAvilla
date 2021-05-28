<?php
/**
 * The template for displaying Comments.
 * @package Construction Realestate
 */

if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area mt-5">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title pt-1 mb-0">
		    <?php
		    $comments_number = get_comments_number();
		    if ( 1 === $comments_number ) {

		        /* translators: %s: post title */
		        printf( esc_html__('One thought on &ldquo;%s&rdquo;', 'construction-realestate' ), esc_html(get_the_title()) );

		    } else {
		        printf(
		        /* translators: 1: number of comments, 2: post title */

		            esc_html( _nx(
		                '%1$s thought on &ldquo;%2$s&rdquo;',
		                '%1$s thoughts on &ldquo;%2$s&rdquo;',
		                $comments_number,
		                'comments title',
		                'construction-realestate'

		            ) ),
		            esc_html (number_format_i18n( $comments_number ) ),
		            esc_html(get_the_title() )

		        );
		    }
		    ?>
        </h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list my-1 mx-0">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 42,
				) );
			?>
		</ol>

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'construction-realestate' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'title_reply' => esc_html(get_theme_mod('construction_realestate_title_comment_form',__('Leave a Reply','construction-realestate' )) ),
			'label_submit' => esc_html(get_theme_mod('construction_realestate_comment_form_button_content',__('Post Comment','construction-realestate' )) ),
		) );
	?>
</div>