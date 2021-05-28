<?php
/**
 * Neptune Theme Strings
 *
 * @package     Neptune
 * @author      Neptune
 * @copyright   Copyright (c) 2018, Neptune
 * @link        http://neptunewp.com/
 * @since       Neptune 1.0.0
 */

/**
 * Default Strings
 */
if ( ! function_exists( 'neptune_real_estate_default_strings' ) ) {

	/**
	 * Default Strings
	 *
	 * @since 1.0.0
	 * @param  string  $key  String key.
	 * @param  boolean $echo Print string.
	 * @return mixed        Return string or nothing.
	 */
	function neptune_real_estate_default_strings( $key, $echo = true ) {

		$defaults = apply_filters(
			'neptune_real_estate_default_strings', array(

				// Header.
				'string-header-skip-link'                => __( 'Skip to content', 'neptune-real-estate' ),

				// 404 Page Strings.
				'string-404-sub-title'                   => __( 'It looks like the link pointing here was faulty. Maybe try searching?', 'neptune-real-estate' ),

				// Search Page Strings.
				'string-search-nothing-found'            => __( 'Nothing Found', 'neptune-real-estate' ),
				'string-search-nothing-found-message'    => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'neptune-real-estate' ),
				'string-full-width-search-message'       => __( 'Start typing and press enter to search', 'neptune-real-estate' ),
				'string-full-width-search-placeholder'   => __( 'Start Typing&hellip;', 'neptune-real-estate' ),
				'string-header-cover-search-placeholder' => __( 'Start Typing&hellip;', 'neptune-real-estate' ),
				'string-search-input-placeholder'        => __( 'Search &hellip;', 'neptune-real-estate' ),

				// Comment Template Strings.
				'string-comment-reply-link'              => __( 'Reply', 'neptune-real-estate' ),
				'string-comment-edit-link'               => __( 'Edit', 'neptune-real-estate' ),
				'string-comment-awaiting-moderation'     => __( 'Your comment is awaiting moderation.', 'neptune-real-estate' ),
				'string-comment-title-reply'             => __( 'Leave a Comment', 'neptune-real-estate' ),
				'string-comment-cancel-reply-link'       => __( 'Cancel Reply', 'neptune-real-estate' ),
				'string-comment-label-submit'            => __( 'Post Comment &raquo;', 'neptune-real-estate' ),
				'string-comment-label-message'           => __( 'Type here..', 'neptune-real-estate' ),
				'string-comment-label-name'              => __( 'Name*', 'neptune-real-estate' ),
				'string-comment-label-email'             => __( 'Email*', 'neptune-real-estate' ),
				'string-comment-label-website'           => __( 'Website', 'neptune-real-estate' ),
				'string-comment-closed'                  => __( 'Comments are closed.', 'neptune-real-estate' ),
				'string-comment-navigation-title'        => __( 'Comment navigation', 'neptune-real-estate' ),
				'string-comment-navigation-next'         => __( 'Newer Comments', 'neptune-real-estate' ),
				'string-comment-navigation-previous'     => __( 'Older Comments', 'neptune-real-estate' ),

				// Blog Default Strings.
				'string-blog-page-links-before'          => __( 'Pages:', 'neptune-real-estate' ),
				'string-blog-meta-author-by'             => __( 'By ', 'neptune-real-estate' ),
				'string-blog-meta-leave-a-comment'       => __( 'Leave a Comment', 'neptune-real-estate' ),
				'string-blog-meta-one-comment'           => __( '1 Comment', 'neptune-real-estate' ),
				'string-blog-meta-multiple-comment'      => __( '% Comments', 'neptune-real-estate' ),
				'string-blog-navigation-next'            => __( 'Next Page', 'neptune-real-estate' ) . ' <span class="ast-right-arrow">&rarr;</span>',
				'string-blog-navigation-previous'        => '<span class="ast-left-arrow">&larr;</span> ' . __( 'Previous Page', 'neptune-real-estate' ),

				// Single Post Default Strings.
				'string-single-page-links-before'        => __( 'Pages:', 'neptune-real-estate' ),
				/* translators: 1: Post type label */
				'string-single-navigation-next'          => __( 'Next %s', 'neptune-real-estate' ) . ' <span class="ast-right-arrow">&rarr;</span>',
				/* translators: 1: Post type label */
				'string-single-navigation-previous'      => '<span class="ast-left-arrow">&larr;</span> ' . __( 'Previous %s', 'neptune-real-estate' ),

				// Content None.
				'string-content-nothing-found-message'   => __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'neptune-real-estate' ),

			)
		);

		$output = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';

		/**
		 * Print or return
		 */
		if ( $echo ) {
			echo esc_html($output);
		} else {
			return $output;
		}
	}
}// End if().
