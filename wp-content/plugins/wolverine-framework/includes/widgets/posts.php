<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2015
 * Time: 5:29 PM
 */
class G5Plus_Widget_Posts extends  G5Plus_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-posts';
        $this->widget_description = __( "Posts widget", 'wolverine' );
        $this->widget_id          = 'g5plus-posts';
        $this->widget_name        = __( 'G5Plus: Posts', 'wolverine' );
        $this->settings           = array(
            'title' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Title','wolverine')
            ),
            'source'  => array(
                'type'    => 'select',
                'std'     => '',
                'label'   => __( 'Source', 'wolverine' ),
                'options' => array(
                    'random' => __('Random','wolverine'),
                    'popular' => __('Popular','wolverine'),
                    'recent'  => __( 'Recent', 'wolverine' ),
                    'oldest' => __('Oldest','wolverine')
                )
            ),
            'number' => array(
                'type'  => 'number',
                'std'   => '5',
                'label' => __( 'Number of posts to show', 'wolverine' ),
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) )
            return;

        extract( $args, EXTR_SKIP );
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
        $source        = empty( $instance['source'] ) ? '' : $instance['source'];
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $query_args = array();

        switch ($source) {
            case 'random' :
                $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'rand',
                    'order' => 'DESC',
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio','post-format-video'),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
            case 'popular':
                $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'comment_count',
                    'order' => 'DESC',
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio','post-format-video'),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;

            case 'recent':
                $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio','post-format-video'),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
            case 'oldest':
                $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'post_date',
                    'order' => 'ASC',
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio','post-format-video'),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
        }

        $class = array('widget-posts-wrap');

        ob_start();
        $r = new WP_Query( $query_args);
        if ($r->have_posts()) : ?>
            <?php echo $args['before_widget']; ?>
            <?php if ( $title ) {
		        echo $args['before_title'] . $title . $args['after_title'];
	        } ?>
            <div class="<?php echo join(' ',$class); ?>">
                <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <div class="widget_posts_item clearfix">
                        <?php
                            $thumbnail = g5plus_post_thumbnail('blog-sidebar');
                            if (!empty($thumbnail)) : ?>
                                <div class="widget-posts-thumbnail">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php endif; ?>
                        <div class="widget-posts-content-wrap">
                            <a class="widget-posts-title" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            <div class="widget-posts-date">
                                <?php echo get_the_date(); ?>
                            </div>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>
            <?php echo $args['after_widget']; ?>
        <?php endif;
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
        $content =  ob_get_clean();
        echo sprintf('%s',$content);
        $this->cache_widget( $args, $content );
    }
}

if (!function_exists('g5plus_register_widget_posts')) {
    function g5plus_register_widget_posts() {
        register_widget('G5Plus_Widget_Posts');
    }
    add_action('widgets_init', 'g5plus_register_widget_posts', 1);
}