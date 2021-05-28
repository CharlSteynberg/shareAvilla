<?php
global $post;
$prefix = 'g5plus_';
$show_related_post = g5plus_rwmb_meta($prefix.'show_related_post');
if ($show_related_post == -1 || $show_related_post === '') {
    $show_related_post = g5plus_get_option('show_related_post',1);
}


if ($show_related_post == 0) {
    return;
}

if (!isset($post) ||   empty($post)) {
    return;
}
$posts_per_page = g5plus_get_option('related_post_count',6);
$related = g5plus_get_related_post($post->ID, $posts_per_page);
if ( sizeof( $related ) == 0 ) return;
$columns = g5plus_get_option('related_post_columns',3);
$args = apply_filters( 'g5plus_related_post_args', array(
    'post_type'            => 'post',
    'ignore_sticky_posts'  => 1,
    'no_found_rows'        => 1,
    'posts_per_page'       => $posts_per_page,
    'post__in'             => $related,
	'tax_query'            => array(
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio'),
			'operator' => 'NOT IN'
		)
	)
));


$data_plugin_options = '{"items" :' . $columns . ',"pagination" : false, "navigation" : false, "autoPlay": true, "stopOnHover": true';
switch ($columns) {
    case 3 :
        $data_plugin_options .= ',"itemsDesktop" : [1199,3],"itemsTablet" : [768, 2], "itemsTabletSmall": [600, 2]';
        break;
    case 2 :
        $data_plugin_options .= ',"itemsDesktop" : [1199,2], "itemsDesktopSmall" : [980,2]';
        break;
    case 1 :
        $data_plugin_options .= ',"singleItem": true';
        break;
    default:
        $data_plugin_options .= ',"itemsDesktop" : [1199,'.$columns.'], "itemsDesktopSmall" : [980,3], "itemsTablet" : [768, 2], "itemsTabletSmall": [600, 2]';
        break;
}
$data_plugin_options .= '}';

$query = new WP_Query( $args );
if ( $query->have_posts() ) : ?>
    <div class="post-related-wrap">
        <h2 class="post-related-title"> <span><?php _e( 'Related Posts', 'wolverine' ); ?></span></h2>
        <div class="post-related-inner">
            <div class="owl-carousel"  data-plugin-options='<?php echo wp_kses_post($data_plugin_options); ?>'>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                   <?php g5plus_get_template('single-blog/content','related'); ?>
                <?php endwhile; // end of the loop. ?>
            </div>
        </div>
    </div>
<?php endif;
wp_reset_postdata();
