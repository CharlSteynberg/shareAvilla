<div class="bb-item template">
    <div class="bb-item-inner first-page">

        <div class="bb-custom-firstpage">
            <div class="close-menu ">
                <a class="nav-next bold-color secondary-font primary-color-hover" href="javascript:;"><?php echo __('Close','wolverine')?></a>
            </div>
            <div class="firstpage-inner">
                <?php
                    $logo_url = "";
                    if(isset($menu_logo) && is_numeric($menu_logo)){
                        $logo = wp_get_attachment_image_src($menu_logo,'full');
                        if(isset($logo) && is_array($logo) ){
                            $logo_url = $logo[0];
                            ?>
                            <div class="logo">
                                <img src="<?php echo esc_url($logo_url) ?>" alt="logo">
                            </div>
                <?php       }
                    }
                ?>
                <?php
                $prefix = 'g5plus_';
                $page_menu = rwmb_meta($prefix. 'page_menu');
                ?>
                <?php
                $arg_menu = array(
                    'menu_id' => 'main-menu',
                    'container' => '',
                    'theme_location' => 'primary',
                    'menu_class' => 'main-menu'
                );
                if (!empty($page_menu)) {
                    $arg_menu['menu'] = $page_menu;
                }
                wp_nav_menu( $arg_menu );
                echo apply_filters('g5plus_after_main_menu_filter','');
                ?>
                <div class="social">
                    <?php
                    $arr_social = explode(',',$menu_social);
                    for($i=0;$i < count($arr_social);$i++){
                        $opt_social_url = g5plus_framework_get_option($arr_social[$i],'#');
                        if(!empty($opt_social_url)){
                    ?>
                        <a href="<?php echo esc_url($opt_social_url) ?>" target="_blank">
                            <i class="<?php echo esc_attr(G5PlusFramework_Portfolio::get_social_icon($arr_social[$i])) ?>"></i></a>
                    <?php }
                    }
                    ?>

                </div>
            </div>


            <div class="copyright secondary-font bold-color">
                <?php
                $copyright = g5plus_framework_get_option('portfolio_copyright',esc_html__('© 2015 Wolverine Template Designed By G5Theme','wolverine'));
                echo wp_kses_post($copyright);
                ?>
            </div>
        </div>
        <div class="bb-custom-side right-cover" id="post_bg_first">
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
                            <span id="post_title_first" class="primary-border-color secondary-font"></span>
                        </div>
                        <div class="thumb">
                            <img id="post_thumbnail_first"  src="#" alt="Wolverine">
                            <div class="entry-hover">
                                <div class="entry-hover-inner">
                                         <span class="icon-logo">
                                         <i class="wicon icon-indians-icons-04"></i>
                                     </span>
                                    <div class="portfolio-content">
                                        <span id="post_content_first" class="excerpt primary-font">

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
        <div class="nav-next-wrap">
            <a href="#" class="nav-next bold-color secondary-font"><?php echo __('Next','wolverine') ?></a>
        </div>
    </div>

</div>