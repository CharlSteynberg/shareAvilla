<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/8/2015
 * Time: 8:35 AM
 */
if (post_password_required()) {
    return;
}
?>
<?php if (comments_open() || get_comments_number()) : ?>
    <div class="entry-comments" id="comments">
	    <h3 class="comments-title">
            <span>
                <?php comments_number(__('No Comments', 'wolverine'), __('One Comment', 'wolverine'), __('Comments (%)', 'wolverine')); ?>
            </span>
	    </h3>
        <?php if (have_comments()) : ?>
            <div class="entry-comments-list">
                <div class="comment-list-wrapper">
                        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                            <nav class="comment-navigation clearfix pull-right" role="navigation">
                                <?php $paginate_comments_args = array(
                                    'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                                    'next_text' => '<i class="fa fa-angle-double-right"></i>'
                                );
                                paginate_comments_links($paginate_comments_args);
                                ?>
                            </nav>
                            <div class="clearfix"></div>
                        <?php endif; ?>

                        <ol class="commentlist clearfix">
                            <?php wp_list_comments(array(
                                'style' => 'li',
                                'callback' => 'g5plus_render_comments',
                                'avatar_size' => 100,
                                'short_ping' => true,
                            )); ?>
                        </ol>


                        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                            <nav class="comment-navigation clearfix pull-right comment-navigation-bottom" role="navigation">
                                <?php paginate_comments_links($paginate_comments_args); ?>
                            </nav>
                            <div class="clearfix"></div>
                        <?php endif; ?>

                    </div>
            </div>
        <?php endif; ?>
        <?php if (comments_open()) : ?>
            <div class="entry-comments-form">
                <?php g5plus_comment_form(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>