<div class="portfolio-item <?php echo esc_attr($cat_filter) ?>">

    <?php
    $post_thumbnail_id = get_post_thumbnail_id(  get_the_ID() );
    $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
    $width = 585;
    $height = 585;
    if($image_size=='590x393')
    {
        $width = 590;
        $height = 393;
    }
    $thumbnail_url = $url_origin = '';
    if(count($arrImages)>0){
        if (function_exists('matthewruddy_image_resize_id')) {
            $thumbnail_url = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
        }
	    $url_origin = $arrImages[0];
    }


    $cat = '';
    foreach ( $terms as $term ){
        $cat .= $term->name.', ';
    }
    $cat = rtrim($cat,', ');
    $link ='#';
    $opt_portfolio_disable_link_detail = g5plus_framework_get_option('portfolio_disable_link_detail','0');
    if($opt_portfolio_disable_link_detail == '0')
    {
        $link = get_post_meta(get_the_ID(), 'portfolio-link', true );
        if(!isset($link) || $link=='') {
	        $link = get_permalink(get_the_ID());
        }

    }

    ?>

    <div class="entry-thumbnail title">
        <a href="<?php echo esc_url($link) ?>" >
            <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>

            <div class="entry-title-wrapper line-height-1 primary-bg-color-hover primary-border-color-hover">
                <div class="entry-title-inner">
                    <a href="<?php echo esc_url($link) ?>" class="bold-color"><div class="title secondary-font"><?php the_title() ?></div> </a>
                    <span class="category other-font primary-color display-inline-block"><?php echo wp_kses_post($cat) ?></span>
                </div>
            </div>
        </a>

    </div>

</div>
<?php if($index%$column==0 && $show_pagging != '2') {?>
    <div style="clear:both"></div>
<?php }?>