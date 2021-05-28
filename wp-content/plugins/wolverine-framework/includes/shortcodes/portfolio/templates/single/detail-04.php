<?php

do_action('g5plus_before_page');

$data_section_id = uniqid();
?>
<div class="portfolio-full detail-04" id="content">
    <div class="fullwidth">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="post-slideshow" id="post_slideshow_<?php echo esc_attr($data_section_id) ?>">
                        <?php if(count($meta_values) > 0){
                            $index = 0;
                            foreach($meta_values as $image){
                                $img = '';
                                if (function_exists('matthewruddy_image_resize_id')) {
                                    $img = matthewruddy_image_resize_id($image,1170,900);
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

            <div class="row portfolio-content-wrap">
                <div class="col-md-9">
                    <div class="portfolio-info">
                        <h2 class="portfolio-title bold-color line-height-1"><?php the_title() ?></h2>
                        <?php the_content() ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="portfolio-info spec">
                        <?php
                        $meta = get_post_meta(get_the_ID(), 'portfolio_custom_fields', TRUE);
                        if(isset($meta) && is_array($meta) && count($meta['portfolio_custom_fields'])>0){
                            for($i=0; $i<count($meta['portfolio_custom_fields']);$i++){
                                ?>
                                <div class="portfolio-info-box">
                                    <h6 class="primary-color"><?php echo wp_kses_post($meta['portfolio_custom_fields'][$i]['custom-field-title']) ?></h6>
                                    <div class="portfolio-term line-height-1"><?php echo wp_kses_post($meta['portfolio_custom_fields'][$i]['custom-field-description']) ?></div>
                                </div>
                            <?php }
                        }
                        ?>
                        <div class="portfolio-info-box">
                            <h6 class="primary-color"><?php echo __('Date','wolverine') ?></h6>
                            <div class="portfolio-term line-height-1"><?php echo date(get_option('date_format'),strtotime($post->post_date)) ?></div>
                        </div>
                        <div class="portfolio-info-box">
                            <h6 class="primary-color"><?php echo __('Category','wolverine') ?></h6>
                            <div class="portfolio-term line-height-1"><?php echo wp_kses_post($cat); ?></div>
                        </div>
                        <div class="portfolio-info-box">
                            <h6 class="primary-color"><?php echo __('Client','wolverine') ?></h6>
                            <div class="portfolio-term line-height-1"><?php echo esc_html($client) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    (function($) {
        "use strict";
        $(window).load(function(){
            $(".post-slideshow",'#content').owlCarousel({
                items: 1,
                singleItem: true,
                navigation : true,
                slideSpeed: 600,
                navigationText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                pagination: false
            });
        })
    })(jQuery);
</script>

