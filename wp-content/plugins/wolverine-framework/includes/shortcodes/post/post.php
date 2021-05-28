<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/4/15
 * Time: 2:41 PM
 */
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Post')):
	class g5plusFramework_Shortcode_Post
	{
		function __construct()
		{
			add_shortcode('wolverine_post', array($this, 'post_shortcode'));
		}
        function post_shortcode($atts)
        {
	        /**
	         * Shortcode attributes
	         * @var $layout_style
	         * @var $category
	         * @var $display
	         * @var $item_amount
	         * @var $column
	         * @var $is_slider
	         * @var $el_class
	         * @var $css_animation
	         * @var $duration
	         * @var $delay
	         */
	        $atts = vc_map_get_attributes( 'wolverine_post', $atts );
	        extract( $atts );
	        $g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            $query['posts_per_page'] = $item_amount;
            $query['no_found_rows'] = true;
            $query['post_status'] = 'publish';
            $query['ignore_sticky_posts'] =  true;
            $query['post_type'] =  'post';
            if (!empty($category)) {
                $query['tax_query'] = array(
                    array(
                        'taxonomy' => 'post_format',
                        'field' => 'slug',
                        'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio'),
                        'operator' => 'NOT IN'
                    ),
                    array(
                        'taxonomy' 		=> 'category',
                        'terms' 		=>  explode(',',$category),
                        'field' 		=> 'slug',
                        'operator' 		=> 'IN'
                    )
                );
            }
            else
            {
                $query['tax_query'] = array(
                    array(
                        'taxonomy' => 'post_format',
                        'field' => 'slug',
                        'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio'),
                        'operator' => 'NOT IN'
                    )
                );
            }
            if ( $display == 'random' ) {
                $query['orderby'] = 'rand';
            } elseif ( $display == 'popular' ) {
                $query['orderby'] = 'comment_count';
            } elseif ( $display == 'recent' ) {
                $query['orderby'] = 'post_date';
                $query['order']   = 'DESC';
            } else {
                $query['orderby'] = 'post_date';
                $query['order']   = 'ASC';
            }
            $r = new WP_Query( $query );
            ob_start();
            if ($r->have_posts()) :
                ?>
                <div class="wolverine-post <?php echo esc_attr($layout_style) ?> <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
                <?php if  ($layout_style=='style1') : ?>
                    <div class="row">
                    <?php if  ($is_slider) : ?>
                        <div data-plugin-options='{"items": <?php echo esc_attr($column) ?>,"itemsDesktop":[1199, 3],"itemsDesktopSmall":[980, 2],"itemsTablet":[768, 1],"pagination":false,"navigation":false, "autoPlay": true }' class="owl-carousel">
                            <?php while ($r->have_posts()) : $r->the_post(); ?>
                                <div class="wolverine-post-item">
                                    <?php
                                    $thumbnail = g5plus_post_thumbnail('blog-related');
                                    if (!empty($thumbnail)) : ?>
                                        <div class="wolverine-post-image">
                                            <?php echo wp_kses_post($thumbnail); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="wolverine-post-content">
                                        <div class="post-entry-meta">
                                        <?php
                                        $cate = get_the_category();
                                        $check=false;
                                        $cate_search=explode(',',$category);
                                        if (is_array($cate)) {
                                            foreach ($cate as $cat) {
                                                if (strlen($category)>0 && is_array($cate_search)) {
                                                    foreach ($cate_search as $cat2) {
                                                        if($cat->slug == $cat2)
                                                        {
                                                            echo '<a class="wolverine-post-cate" href="'.get_category_link($cat->cat_ID).'">' . $cat->cat_name  . '</a> / ';
                                                            $check=true;
                                                            break;
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<a class="wolverine-post-cate" href="'.get_category_link($cat->cat_ID).'">' . $cat->cat_name  . '</a> / ';
                                                    break;
                                                }
                                                if($check) break;
                                            }
                                        }
                                        ?>
                                        <span><?php echo get_the_date(get_option('date_format')); ?></span>
                                        </div>
                                        <h3><a href="<?php the_permalink(); ?>"
                                           rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else:
                        while ($r->have_posts()) : $r->the_post();?>
                                <div class="col-md-<?php echo (12/esc_attr($column))?> col-sm-6">
                                    <div class="wolverine-post-item margin-bottom-30">
                                        <?php
                                        $thumbnail = g5plus_post_thumbnail('blog-related');
                                        if (!empty($thumbnail)) : ?>
                                            <div class="wolverine-post-image">
                                                <?php echo wp_kses_post($thumbnail); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="wolverine-post-content">
                                            <div class="post-entry-meta">
                                                <?php
                                                $cate = get_the_category();
                                                $check=false;
                                                $cate_search=explode(',',$category);
                                                if (is_array($cate)) {
                                                    foreach ($cate as $cat) {
                                                        if (strlen($category)>0 && is_array($cate_search)) {
                                                            foreach ($cate_search as $cat2) {
                                                                if($cat->slug == $cat2)
                                                                {
                                                                    echo '<a class="wolverine-post-cate" href="'.get_category_link($cat->cat_ID).'">' . $cat->cat_name  . '</a> / ';
                                                                    $check=true;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo '<a class="wolverine-post-cate" href="'.get_category_link($cat->cat_ID).'">' . $cat->cat_name  . '</a> / ';
                                                            break;
                                                        }
                                                        if($check) break;
                                                    }
                                                }
                                                ?>
                                                <span><?php echo get_the_date(get_option('date_format')); ?></span>
                                            </div>
                                            <h3><a href="<?php the_permalink(); ?>"
                                               rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                    endif;?>
                    </div>
                <?php elseif($layout_style=='style2') :
                    $i=0; ?>
                    <div class="wolverine-post-isotope">
                        <?php while ($r->have_posts()) : $r->the_post(); $i++;?>
                            <div class="wolverine-post-item">
                                <?php if((($i+1)%4)!=0 && ($i%4!=0)) :?>
                                    <div class="wolverine-post-image">
                                        <?php
                                        $thumbnail = g5plus_post_thumbnail('blog-thumbnail');
                                        if (!empty($thumbnail)) :
                                            echo wp_kses_post($thumbnail);
                                        endif; ?>
                                    </div>
                                    <div class="wolverine-post-content">
                                        <div class="content-middle-inner">
                                            <span><?php echo get_the_date(get_option('date_format')); ?></span>
                                            <h3><a href="<?php the_permalink(); ?>"
                                               rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                            <?php
                                            $excerpt = get_the_excerpt();
                                            $excerpt = g5plusFramework_Shortcodes::substr($excerpt, 272, '...');
                                            ?>
                                            <p><?php echo($excerpt); ?></p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="wolverine-post-content">
                                        <div class="content-middle-inner">
                                            <span><?php echo get_the_date(get_option('date_format')); ?></span>
                                            <h3><a href="<?php the_permalink(); ?>"
                                               rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                            <?php
                                            $excerpt = get_the_excerpt();
                                            $excerpt = g5plusFramework_Shortcodes::substr($excerpt, 272, '...');
                                            ?>
                                            <p><?php echo ($excerpt); ?></p>
                                        </div>
                                    </div>
                                    <div class="wolverine-post-image">
                                        <?php
                                        $thumbnail = g5plus_post_thumbnail('blog-thumbnail');
                                        if (!empty($thumbnail)) :
                                            echo wp_kses_post($thumbnail);
                                        endif; ?>
                                    </div>
                                <?php endif;?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else :?>
	                <div class="wolverine-post-isotope">
                        <?php while ($r->have_posts()) : $r->the_post();?>
				            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 wolverine-post-item">
					            <div class="wolverine-post-image">
						            <?php
						            $thumbnail = g5plus_post_thumbnail('blog-garden');
						            if (!empty($thumbnail)) :
							            echo wp_kses_post($thumbnail);
						            endif; ?>
					            </div>
					            <div class="wolverine-post-content vc-content-middle">
						            <div class="wolverine-post-content-inner">
							            <span><?php echo get_the_date(get_option('date_format')); ?></span>
							            <h3><a href="<?php the_permalink(); ?>"
							                   rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
							            <a class="wolverine-button style4 button-2x" href="<?php the_permalink(); ?>"
							               rel="bookmark" title="<?php the_title(); ?>"><?php _e('Read More','wolverine'); ?></a>
						            </div>
					            </div>
				            </div>
			            <?php endwhile; ?>
                    </div>
                <?php endif;?>
                </div>
            <?php
            endif;
            wp_reset_postdata();
            g5plus_archive_loop_reset();
            $content = ob_get_clean();
            return $content;
        }
	}
    new g5plusFramework_Shortcode_Post();
endif;