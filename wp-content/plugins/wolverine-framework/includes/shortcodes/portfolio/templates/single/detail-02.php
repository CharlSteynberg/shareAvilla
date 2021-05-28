<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/13/15
 * Time: 11:14 AM
 */

do_action('g5plus_before_page');
?>
<div class="portfolio-full detail-02" id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="post-slideshow">
                    <?php if(count($meta_values) > 0){
                        foreach($meta_values as $image){
                            $img = '';
                            if (function_exists('matthewruddy_image_resize_id')) {
                                $img = matthewruddy_image_resize_id($image,670,518);
                            }
                            ?>
                            <div class="item"><img alt="portfolio" src="<?php echo esc_url($img) ?>" /></div>
                        <?php }
                    }else { if(count($imgThumbs)>0) {?>
                        <div class="item"><img alt="portfolio" src="<?php echo esc_url($imgThumbs[0])?>" /></div>
                    <?php }
                    }
                    ?>
                </div>

            </div>
            <div class="col-md-4">
                <div class="portfolio-info">
                    <h2 class="portfolio-title"><?php the_title() ?></h2>
                    <?php the_content(); ?>
                </div>
                <div class="separator"></div>
                <div class="portfolio-info">
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
                        <div class="portfolio-term "><?php echo date(get_option('date_format'),strtotime($post->post_date)) ?></div>
                    </div>
                    <div class="portfolio-info-box">
                        <h6 class="primary-color"><?php echo __('Category','wolverine') ?></h6>
                        <div class="portfolio-term"><?php echo wp_kses_post($cat); ?></div>
                    </div>
                    <div class="portfolio-info-box">
                        <?php if($client!=''){ ?>
                            <h6 class="primary-color"><?php echo __('Client','wolverine') ?></h6>
                            <div class="portfolio-term"><?php echo esc_html($client); ?></div>
                        <?php } ?>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>