<div class="bb-item template bb-search">
    <div class="bb-item-inner first-page">

        <div class="nav-prev-wrap">
            <a href="#" class="nav-prev bold-color secondary-font"><?php echo __('Prev', 'wolverine') ?></a>
        </div>

        <div class="bb-custom-side  right-cover" id="post_bg_last">
            <div class="bb-custom-side-inner" style="height: 100%">
                <div class="bg-color-wrap"></div>
                <?php if(isset($title) && $title!=''){?>
                    <div class="title-shortcode bold-color other-font line-height-1">
                        <?php echo wp_kses_post($title) ?>
                    </div>
                <?php } ?>
                <div class="vertical-middle-wrap">
                    <div class="content-wrap">
                        <div class="title-wrap line-height-1">
                            <span id="post_title_last" class="primary-border-color secondary-font"></span>
                        </div>
                        <div class="thumb">
                            <img id="post_thumbnail_last"  src="#" alt="Wolverine">
                            <div class="entry-hover">
                                <div class="entry-hover-inner">
                                         <span class="icon-logo">
                                         <i class="wicon icon-indians-icons-04"></i>
                                     </span>
                                    <div class="portfolio-content">
                                        <span id="post_content_last" class="excerpt primary-font">

                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <?php if(isset($title_contact) && $title_contact!=''){ ?>
                        <div class="contact-wrap line-height-1">
                            <a href="<?php echo esc_url($link_contact)?>" class="bold-color secondary-font"><?php echo wp_kses_post($title_contact)?></a>
                            <span class="line"></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="bb-custom-lastpage">
            <div class="lastpage-inner">
                <div class="close-menu search">
                    <a class="nav-prev bold-color secondary-font primary-color-hover" href="javascript:;"><?php echo __('Close','wolverine')?></a>
                </div>
                <?php
                if(isset($search_logo) && is_numeric($search_logo)){
                    $logo = wp_get_attachment_image_src($search_logo,'full');
                    if(isset($logo) && is_array($logo) ){
                        $logo_url = $logo[0];
                        ?>
                        <div class="logo">
                            <img src="<?php echo esc_url($logo_url) ?>" alt="logo">
                        </div>
                    <?php       }
                }
                ?>
                <div class="search-form">
                    <input type="text"  placeholder="<?php echo __('Write search','wolverine')?>">
                    <a class="search-button secondary-font" href="javascript:;" data-title="<?php echo __('Search','wolverine')?>"><?php echo __('Search','wolverine')?></a>
                    <div class="search-result">
                        <ul>
                        </ul>
                    </div>
                </div>
                <div class="copyright secondary-font">
                    <?php
                    $copyright = g5plus_framework_get_option('portfolio_copyright',esc_html__('© 2015 Wolverine Template Designed By G5Theme','wolverine'));
                    echo wp_kses_post($copyright);
                    ?>
                </div>
            </div>

        </div>


    </div>

</div>