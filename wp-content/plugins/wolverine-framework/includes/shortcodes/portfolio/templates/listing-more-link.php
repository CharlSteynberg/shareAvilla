<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/19/15
 * Time: 5:31 PM
 */
$args = array(
    'orderby' =>'post__in',
    'post__in' => explode(",",$portfolio_ids),
    'posts_per_page' => -1,
    'post_type' => G5PLUS_PORTFOLIO_POST_TYPE,
    'post_status' => 'publish');

if($data_source==''){
    $args = array(
        'offset' => $offset,
        'posts_per_page'   => $post_per_page,
        'orderby'          => 'post_date',
        'order'            => $order,
        'post_type'        => G5PLUS_PORTFOLIO_POST_TYPE,
        G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY    => strtolower($category),
        'post_status'      => 'publish');
}

$posts_array  = new WP_Query( $args );
$total_post = $posts_array->found_posts;
$col_class='wolverine-col-md-'.$column;
$paging_style = $show_pagging== 2 ? 'slider' : 'paging';
$data_section_id = uniqid();
?>
<div class="portfolio overflow-hidden <?php echo esc_attr($g5plus_animation . ' '. $styles_animation  . ' '.$paging_style) ?>" >
    <div  class="portfolio-wrapper <?php echo sprintf('%s %s %s', $col_class,$padding,$layout_type)  ?> more-link-<?php echo esc_attr($data_section_id) ?>">
        <?php
        $index = 0;

        while ( $posts_array->have_posts() ) : $posts_array->the_post();
            $index++;
            $permalink = get_permalink();
            $title_post = get_the_title();
            $terms = wp_get_post_terms( get_the_ID(), array( G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));
            $cat = $cat_filter = '';
            foreach ( $terms as $term ){
                $cat_filter .= preg_replace('/\s+/', '', $term->name) .' ';
                $cat .= $term->name.', ';
            }
            $cat = rtrim($cat,', ');

            ?>

            <?php
            include(plugin_dir_path( __FILE__ ).'/loop/title-more-link-item.php');
            ?>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
        <div class="more-link-wrap portfolio-item  <?php echo esc_attr($col_class) ?> ">
            <div class="more-link-inner line-height-1">
                <a href="<?php echo esc_url($link_more_item) ?>" class="bold-color primary-color-hover secondary-font">
                    <?php _e("More items",'wolverine')?>
                    <i class="wicon icon-outline-vector-icons-pack-149"></i>
                </a>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    (function($) {
        "use strict";

        <?php if (g5framework_is_enable_hover_dir($overlay_style)) {?>
            $(document).ready(function(){
                $('.portfolio-item.hover-dir > div.entry-thumbnail').hoverdir();
            })
        <?php } ?>

        //init height title short_code
        var $more_link = $('.more-link-wrap','.more-link-<?php echo esc_attr($data_section_id) ?>');
        $more_link.css('opacity','0');
        function initTitleShortCode(){
            var $height = $('.portfolio-item:first','.more-link-<?php echo esc_attr($data_section_id) ?>').outerHeight() -1;
            var $more_link_inner = $('.more-link-inner','.more-link-<?php echo esc_attr($data_section_id) ?>');
            var $link = $('a', $more_link_inner).attr('href');
            if($link!=''){
                $($more_link_inner).click(function(){
                    window.location.href = $link;
                });
            }
            $more_link.css('height',$height );
            $('.portfolio-item','.more-link-<?php echo esc_attr($data_section_id) ?>').css('height',$height);
            $more_link.css('opacity','1');
        }
        $(window).resize(function(){
            initTitleShortCode();
        });
        $(window).load(function(){
            setTimeout(function(){
                initTitleShortCode();
            },500);
        });

    })(jQuery);
</script>


