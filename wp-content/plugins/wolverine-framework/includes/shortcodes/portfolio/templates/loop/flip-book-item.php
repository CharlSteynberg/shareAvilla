<div class="bb-item <?php if($index%2==0){echo 'even';}else{echo 'odd';} ?>" data-post-id="<?php echo get_the_ID() ?>" data-page-index="<?php echo esc_attr($index) ?>" >
    <div class="bb-item-inner">
        <?php if($index>1){?>
            <div class="nav-prev-wrap">
                <a href="#" class="nav-prev bold-color secondary-font"><?php echo __('Prev', 'wolverine') ?></a>
            </div>
        <?php } ?>
        <div class="bb-custom-side bb-custom-side-100" id="post_bg_<?php echo get_the_ID()?>"
             style="background-image: url(<?php echo esc_url($bg_img) ?>);">
            <div class="menu">
                <a href="javascript:" class="bold-color secondary-font"><?php echo __('Menu','wolverine')?></a>
            </div>
            <div class="bg-left-color-wrap"></div>
            <div class="bg-right-color-wrap"></div>
            <?php if (isset($title) && $title != '') { ?>
                <div class="title-shortcode  bold-color other-font line-height-1">
                    <?php echo wp_kses_post($title) ?>
                </div>
            <?php } ?>
            <div class="vertical-middle-wrap">
                <div class="content-wrap full">
                    <div class="title-wrap line-height-1">
                    <span id="post_title_<?php echo get_the_ID()?>" class="primary-border-color secondary-font">
                        <a class="ladda-button view-detail" data-spinner-color="#000" data-style="zoom-out"  data-post-id="<?php echo esc_attr(get_the_ID()) ?>" href="javascript:;">
                            <?php echo get_the_title() ?>
                        </a>
                    </span>
                    </div>
                    <div class="thumb">
                        <img id="post_thumbnail_<?php echo get_the_ID()?>" src="<?php echo esc_attr($thumbnail_url) ?>" alt="<?php echo esc_attr($title_post) ?>">

                        <div class="entry-hover">
                            <div class="entry-hover-inner">
                                         <span class="icon-logo">
                                         <i class="wicon icon-indians-icons-04"></i>
                                     </span>

                                <div class="portfolio-content">
                                        <div class="excerpt primary-font" id="post_content_<?php echo get_the_ID()?>">
                                            <?php the_content() ?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (isset($title_contact) && $title_contact != '') { ?>
                    <div class="contact-wrap line-height-1">
                        <a href="<?php echo esc_url($link_contact) ?>"
                           class="bold-color secondary-font"><?php echo wp_kses_post($title_contact) ?></a>
                        <span class="line bold-color"></span>
                    </div>
                <?php } ?>
            </div>
            <div class="search">
                <a href="javascript:;"><i class="wicon icon-outline-vector-icons-pack-95"></i></a>
            </div>
        </div>
        <?php if ($total_post > $index) { ?>
            <div class="nav-next-wrap">
                <a href="#" class="nav-next bold-color secondary-font"><?php echo __('Next', 'wolverine') ?></a>
            </div>
        <?php } ?>
    </div>
</div>