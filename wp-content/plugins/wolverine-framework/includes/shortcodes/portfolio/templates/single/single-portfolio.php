<?php
get_header();


if ( have_posts() ) {
    // Start the Loop.
    while ( have_posts() ) : the_post();
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
        $detail_style =  get_post_meta(get_the_ID(),'portfolio_detail_style',true);
        if (!isset($detail_style) || $detail_style == 'none' || $detail_style == '') {
            $detail_style = g5plus_framework_get_option('portfolio-single-style','detail-01');
        }

        include_once(plugin_dir_path( __FILE__ ).'/'.$detail_style.'.php');

    endwhile;
    }
?>
<?php get_footer(); ?>
