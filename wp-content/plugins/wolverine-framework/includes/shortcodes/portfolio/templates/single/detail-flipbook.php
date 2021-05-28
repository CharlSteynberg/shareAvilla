<?php
$post_id = $_REQUEST['post_id'];
$data_section_id = uniqid();
if(isset($post_id)){
    $args = array(
        'posts_per_page' => -1,
        'post_type' => G5PLUS_PORTFOLIO_POST_TYPE,
        'post__in' => array($post_id),
        'post_status' => 'publish');
    $posts_array = new WP_Query($args);
    while ($posts_array->have_posts()) : $posts_array->the_post();
        $post_id = get_the_ID();
        $categories = get_the_terms($post_id, G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY);
        $client = get_post_meta($post_id, 'portfolio-client', true );
        $location = get_post_meta($post_id, 'portfolio-location', true );

        $meta_values = get_post_meta( get_the_ID(), 'portfolio-format-gallery', false );
        $imgThumbs = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'full');
        $cat = '';
        $arrCatId = array();
        if($categories){
            foreach($categories as $category) {
                $cat .= '<span>'.$category->name.'</span>, ';
                $arrCatId[count($arrCatId)] = $category->term_id;
            }
            $cat = trim($cat, ', ');
        }

        $bg_img_id = get_post_meta(get_the_ID(), 'portfolio-background-image', true );
        $arr_bg_img = wp_get_attachment_image_src( $bg_img_id, 'full' );
        $bg_img = '';
        if(count($arr_bg_img)>0)
            $bg_img = $arr_bg_img[0];
    ?>
        <div class="portfolio-flip-book-detail">
            <div class="bb-item">
                <div class="bb-item-inner first-page">

                    <div class="bb-custom-firstpage">
                        <div class="close-popup-detail">
                            <a href="javascript:;"><i class="fa fa-close"></i></a>
                        </div>
                        <h1 class="portfolio-title secondary-font bold-color"><?php echo __('About Project','wolverine') ?></h1>
                        <div class="firstpage-inner">
                            <div class="portfolio-info portfolio-content">
                                <?php the_content(); ?>
                            </div>
                            <div class="portfolio-info separator">
                                <?php
                                $meta = get_post_meta(get_the_ID(), 'portfolio_custom_fields', TRUE);
                                if(isset($meta) && is_array($meta) && count($meta['portfolio_custom_fields'])>0){
                                    for($i=0; $i<count($meta['portfolio_custom_fields']);$i++){
                                        ?>
                                        <div class="portfolio-info-box">
                                            <h6 class="primary-color secondary-font"><?php echo wp_kses_post($meta['portfolio_custom_fields'][$i]['custom-field-title']) ?></h6>
                                            <div class="portfolio-term line-height-1 "><?php echo wp_kses_post($meta['portfolio_custom_fields'][$i]['custom-field-description']) ?></div>
                                        </div>
                                    <?php }
                                }
                                ?>

                                <div class="portfolio-info-box">
                                    <h6 class="primary-color secondary-font"><?php echo __('Date','wolverine') ?></h6>
                                    <div class="portfolio-term"><?php echo date(get_option('date_format'),strtotime(get_the_date())) ?></div>
                                </div>
                                <div class="portfolio-info-box">
                                    <h6 class="primary-color secondary-font"><?php echo __('Category','wolverine') ?></h6>
                                    <div class="portfolio-term "><?php echo wp_kses_post($cat); ?></div>
                                </div>
                                <div class="portfolio-info-box">
                                    <?php if($client!=''){ ?>
                                        <h6 class="primary-color secondary-font"><?php echo __('Client','wolverine') ?></h6>
                                        <div class="portfolio-term "><?php echo esc_html($client); ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="copyright secondary-font bold-color">
                            <?php
                            $copyright = g5plus_framework_get_option('portfolio_copyright',esc_html__('© 2015 Wolverine Template Designed By G5Theme','wolverine') );
                            echo wp_kses_post($copyright);
                            ?>
                        </div>
                    </div>
                    <div class="bb-custom-side right-cover" id="post_bg" style="background-image: url(<?php echo esc_url($bg_img) ?>);background-size: cover">
                        <div class="close-popup-detail">
                            <a href="javascript:;"><i class="fa fa-close"></i></a>
                        </div>
                        <div class="bb-custom-side-inner">
                            <div class="bg-color-wrap"></div>
                            <?php if(isset($title) && $title!=''){?>
                                <div class="title-shortcode bold-color other-font line-height-1">
                                    <?php echo wp_kses_post($title) ?>
                                </div>
                            <?php } ?>
                            <div class="vertical-middle-wrap">
                                <div class="content-wrap">
                                    <div class="title-wrap line-height-1">
                                        <span id="post_title" class="primary-border-color secondary-font"><?php the_title() ?></span>
                                    </div>
                                    <div class="post-slideshow" id="post_slideshow_<?php echo esc_attr($data_section_id) ?>">
                                        <?php if(count($meta_values) > 0){
                                            $index = 0;
                                            foreach($meta_values as $image){
                                                $img = '';
	                                            if (function_exists('matthewruddy_image_resize_id')) {
		                                            $img = matthewruddy_image_resize_id($image, 670,516);
	                                            }

                                                ?>
                                                <div class="item">
                                                    <a class="nav-post-slideshow" href="javascript:;" data-section-id="<?php echo esc_attr($data_section_id) ?>" data-index="<?php echo esc_attr($index++) ?>">
                                                        <img alt="portfolio" src="<?php echo esc_url($img) ?>" />
                                                    </a>
                                                </div>
                                            <?php }
                                        }else { if(count($imgThumbs)>0) {?>
                                            <div class="item"><img alt="portfolio" src="<?php echo esc_url($imgThumbs[0])?>" /></div>
                                        <?php }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
<?php
    endwhile;
    wp_reset_postdata();
}
?>
<script type="text/javascript">
    (function($) {
        "use strict";
         var logo_url = $('#portfolio-detail-logo').attr('data-logo-url');
        if(logo_url!=''){
            var logoElement = '<div class="logo"><img src="' + logo_url + '" alt="logo"></div>';
            $('.bb-custom-firstpage','.portfolio-flip-book-detail').prepend(logoElement);
        }
    })(jQuery);
</script>
