<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/13/2015
 * Time: 11:10 AM
 */
if ( ! defined( 'ABSPATH' ) ) die( '-1' );
if (!class_exists('g5plusFramework_Shortcode_Blog')) {
    class g5plusFramework_Shortcode_Blog {
        function __construct() {
            add_shortcode('wolverine_blog', array($this, 'blog_shortcode' ));
        }

        function blog_shortcode($atts) {
            $atts = vc_map_get_attributes( 'wolverine_blog', $atts );
            $type = $columns = $category = $max_items  = $paging_style =  $posts_per_page = $paging_align =  $orderby = $order  = $meta_key  =   $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'type'       => 'classic-01',
                'columns'        => '2' ,
                'category' => '',
                'max_items' => '',
                'paging_style' => 'all',
                'posts_per_page'   => '',
                'paging_align' => 'right',
                'orderby' => 'date',
                'order' => 'DESC',
                'meta_key' => '',
                'el_class'      => '',
                'css_animation' => '',
                'duration'      => '',
                'delay'         => ''
            ), $atts));


            if (is_front_page()) {
                $paged   = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
            } else {
                $paged   = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
            }


            $args = array(
                'post_type'=> 'post',
                'paged' => $paged,
                'ignore_sticky_posts' => true,
                'posts_per_page' => $max_items > 0 ? $max_items : $posts_per_page,
                'orderby' => $orderby,
                'order' => $order,
                'meta_key' => $orderby == 'meta_key' ? $meta_key : '',
            );

            if ($paging_style == 'all' && $max_items == -1) {
                $args['nopaging'] = true;
            }

            if (!empty($category)) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' 		=> 'category',
                        'terms' 		=>  explode(',',$category),
                        'field' 		=> 'slug',
                        'operator' 		=> 'IN'
                    )
                );
            }


            query_posts($args);

            $class= array('shortcode-blog-wrap');
            $class[] = $el_class;
            $class[] = g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);

            $class_name = join(' ',$class);

            $blog_wrap_class= array('blog-wrap');

            $blog_wrap_class[] = $type;


            $blog_class = array('blog-inner','clearfix');
            $blog_class[] = 'blog-style-' . $type;
            $blog_class[] = 'blog-paging-'.$paging_style;
            if (($type != 'classic-01') && ($type != 'classic-02')) {
                $blog_class[] = 'blog-col-'.$columns;
            }



            $blog_paging_class = array('blog-paging-wrapper');
            $blog_paging_class[] = 'blog-paging-'.$paging_style;

            if ($paging_style == 'default') {
                $blog_paging_class[] = 'blog-paging-align-' . $paging_align;
            }

            global $g5plus_archive_loop;
            switch ($type) {
                case 'classic-01':
                case 'classic-02':
                    $g5plus_archive_loop['image-size'] = 'blog-classic';
                    break;
                case 'grid-01':
                case 'grid-02':
                    $g5plus_archive_loop['image-size'] = 'blog-grid';
                    break;
            }
            $g5plus_archive_loop['style'] = $type;

            ob_start();
            ?>
            <div class="<?php echo esc_attr($class_name) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <div class="<?php echo join(' ',$blog_wrap_class); ?>">
                    <div class="<?php echo join(' ',$blog_class); ?>">
                        <?php
                        if ( have_posts() ) :
                            // Start the Loop.
                            while ( have_posts() ) : the_post();
                                /*
                                 * Include the post format-specific template for the content. If you want to
                                 * use this in a child theme, then include a file called called content-___.php
                                 * (where ___ is the post format) and that will be used instead.
                                 */
                                g5plus_get_template( 'archive/content' , get_post_format() );
                            endwhile;
                            g5plus_archive_loop_reset();
                        else :
                            // If no content, include the "No posts found" template.
                            g5plus_get_template( 'archive/content-none');
                        endif;
                        ?>
                    </div>

                    <?php
                    global $wp_query;
                    if ( $wp_query->max_num_pages > 1 && $max_items == -1 ) :
                        ?>
                        <div class="<?php echo join(' ',$blog_paging_class); ?>">
                            <?php
                            switch($paging_style) {
                                case 'load-more':
                                    g5plus_paging_load_more();
                                    break;
                                case 'infinity-scroll':
                                    g5plus_paging_infinitescroll();
                                    break;
                                default:
                                    echo g5plus_paging_nav();
                                    break;
                            }
                            ?>
                        </div>
                    <?php endif;?>

                </div>
            </div>
            <?php
            wp_reset_query();
            $content =  ob_get_clean();
            return $content;
        }
    }
    new g5plusFramework_Shortcode_Blog();
}
