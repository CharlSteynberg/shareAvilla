<?php
// Paging Load More
//--------------------------------------------------------------
if (!function_exists('g5plus_paging_load_more')) {
	function g5plus_paging_load_more() {
		global $wp_query;
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}
		$link = get_next_posts_page_link($wp_query->max_num_pages);
		if (!empty($link)) :
			?>
			<div class="blog-load-more-wrapper">
				<button data-href="<?php echo esc_url($link); ?>" type="button"  data-loading-text="<span class='fa fa-spinner fa-spin'></span> <?php _e("Loading...",'wolverine'); ?>" class="blog-load-more wolverine-button style1 button-2x" autocomplete="off">
					<span class="fa fa-plus"></span> <?php _e("Load More",'wolverine'); ?>
				</button>
			</div>
		<?php
		endif;
	}
}

// Paging Infinite Scroll
//--------------------------------------------------------------
if (!function_exists('g5plus_paging_infinitescroll')) {
	function g5plus_paging_infinitescroll(){
		global $wp_query;
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}
		$link = get_next_posts_page_link($wp_query->max_num_pages);
		if (!empty($link)) :
			?>
			<nav id="infinite_scroll_button">
				<a href="<?php echo esc_url($link); ?>"></a>
			</nav>
			<div id="infinite_scroll_loading" class="text-center infinite-scroll-loading"></div>
		<?php
		endif;
	}
}

// Paging Infinite Scroll
//--------------------------------------------------------------
if ( ! function_exists( 'g5plus_paging_nav' ) ) {
	function g5plus_paging_nav() {
		global $wp_query, $wp_rewrite;
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url(remove_query_arg( array_keys( $query_args ), $pagenum_link ));
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$page_links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-double-left"></i>',
			'next_text' => '<i class="fa fa-angle-double-right"></i>',
			'type' => 'array'
		) );

		if (count($page_links) == 0) return;





		$links = "<ul class='pagination'>\n\t<li>";
		$links .= join("</li>\n\t<li>", $page_links);
		$links .= "</li>\n</ul>\n";
		return $links;
	}
}

/*================================================
GET POST THUMBNAIL
================================================== */
if (!function_exists('g5plus_post_thumbnail')) {
    function g5plus_post_thumbnail($size = '') {
        $html = '';
        $prefix = 'g5plus_';
        $width = '';
        $height = '';
        global $g5plus_image_size;
        if (isset($g5plus_image_size[$size])) {
            $width = $g5plus_image_size[$size]['width'];
            $height = $g5plus_image_size[$size]['height'];
        }

        switch(get_post_format()) {
            case 'image' :
                $args = array(
                    'size' => $size,
                    'meta_key' => $prefix.'post_format_image'
                );
                $image = g5plus_get_image($args);
                if (!$image) break;
                $html = g5plus_get_image_hover($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                break;
            case 'gallery':
                $images = g5plus_get_post_meta(get_the_ID(), $prefix.'post_format_gallery');
                if (count($images) > 0) {
                    $data_plugin_options = "data-plugin-options='{\"singleItem\" : true, \"pagination\" : false, \"navigation\" : true, \"autoHeight\" : true}'";
                    $html = "<div class='owl-carousel' $data_plugin_options>";
                    foreach ($images as $image) {

                        if (empty($width) || empty($height)) {
                            $image_src_arr = wp_get_attachment_image_src( $image, $size );
                            if ($image_src_arr) {
                                $image_src = $image_src_arr[0];
                            }
                        } else {
                            $image_src = matthewruddy_image_resize_id($image,$width,$height);
                        }

                        if (!empty($image_src)) {
                            $html .= g5plus_get_image_hover($image_src,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID(),1);
                        }
                    }
                    $html .= '</div>';
                } else {
                    $args = array(
                        'size' => $size,
                        'meta_key' => ''
                    );
                    $image = g5plus_get_image($args);
                    if (!$image) break;
                    $html = g5plus_get_image_hover($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                }
                break;
            case 'video':
                $video = g5plus_get_post_meta(get_the_ID(), $prefix.'post_format_video');
                if (!is_single()) {
                    $args = array(
                        'size' => $size,
                        'meta_key' => ''
                    );
                    $image = g5plus_get_image($args);
                    if (!$image) {
                        if (count($video) > 0) {
                            $html .= '<div class="embed-responsive embed-responsive-16by9 embed-responsive-' . $size . '">';
                            $video = $video[0];
                            // If URL: show oEmbed HTML
                            if (filter_var($video, FILTER_VALIDATE_URL)) {
                                $args = array(
                                    'wmode' => 'transparent'
                                );
                                $html .= wp_oembed_get($video, $args);
                            } // If embed code: just display
                            else {
                                $html .= $video;
                            }
                            $html .= '</div>';
                        }
                    } else {
                        $video = $video[0];
                        if (filter_var($video, FILTER_VALIDATE_URL)) {
                            $html .= g5plus_get_video_hover($image, get_permalink(), the_title_attribute('echo=0'), $video);
                        } else {
                            $html .= '<div class="embed-responsive embed-responsive-16by9 embed-responsive-' . $size . '">';
                            $html .= $video;
                            $html .= '</div>';
                        }
                    }
                } else {
                    if (count($video) > 0) {
                        $html .= '<div class="embed-responsive embed-responsive-16by9 embed-responsive-' . $size . '">';
                        $video = $video[0];
                        // If URL: show oEmbed HTML
                        if (filter_var($video, FILTER_VALIDATE_URL)) {
                            $args = array(
                                'wmode' => 'transparent'
                            );
                            $html .= wp_oembed_get($video, $args);
                        } // If embed code: just display
                        else {
                            $html .= $video;
                        }
                        $html .= '</div>';
                    }
                }
                break;
            case 'audio':
                $audio = g5plus_get_post_meta(get_the_ID(), $prefix.'post_format_audio');
                if (count($audio) > 0) {
                    $audio = $audio[0];
                    if (filter_var($audio, FILTER_VALIDATE_URL)) {
                        $html .= wp_oembed_get($audio);
                        $title = esc_attr(get_the_title());
                        $audio = esc_url($audio);
                        if (empty($html)) {
                            $id = uniqid();
                            $html .= "<div data-player='$id' class='jp-jplayer' data-audio='$audio' data-title='$title'></div>";
                            $html .= g5plus_jplayer($id);
                        }
                    } else {
                        $html .= $audio;
                    }
                    $html .= '<div style="clear:both;"></div>';
                }
                break;
            default:
                $args = array(
                    'size' => $size,
                    'meta_key' => ''
                );
                $image = g5plus_get_image($args);
                if (!$image) break;
                $html = g5plus_get_image_hover($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                break;
        }
        return $html;
    }
}

/*================================================
GET POST IMAGE
================================================== */
if (!function_exists('g5plus_get_image')) {
    function g5plus_get_image($args) {
        $default = apply_filters(
            'g5plus_get_image_default_args',
            array(
                'post_id'  => get_the_ID(),
                'size'    => '',
                'width'    => '',
                'height'   => '',
                'attr'     => '',
                'meta_key' => '',
                'scan'     => false,
                'default'  => ''
            )
        );


        $args = wp_parse_args( $args, $default );
        $size = $args['size'];



        $width = '';
        $height = '';

        global $g5plus_image_size;
        if (isset($g5plus_image_size[$size])) {
            $width = $g5plus_image_size[$size]['width'];
            $height = $g5plus_image_size[$size]['height'];
        }



        if ( ! $args['post_id'] ) {
            $args['post_id'] = get_the_ID();
        }

        // Get image from cache
        $key         = md5( serialize( $args ) );
        $image_cache = wp_cache_get( $args['post_id'], 'g5plus_get_image' );

        if ( ! is_array( $image_cache ) ) {
            $image_cache = array();
        }


        if ( empty( $image_cache[$key] ) ) {

            $image_src = '';

            // Get post thumbnail
            if (has_post_thumbnail($args['post_id'])) {
                $post_thumbnail_id   = get_post_thumbnail_id($args['post_id']);




                if (empty($width) || empty($height)) {
                    $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, $size );
                    if ($image_src_arr) {
                        $image_src = $image_src_arr[0];
                    }
                } else {
                    $image_src = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
                }
            }

            // Get the first image in the custom field
            if ((!isset($image_src) || empty($image_src))  && $args['meta_key']) {
                $post_thumbnail_id = g5plus_get_post_meta( $args['post_id'], $args['meta_key'], true );
                if ( $post_thumbnail_id ) {

                    if (empty($width) || empty($height)) {
                        $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, $size );
                        if ($image_src_arr) {
                            $image_src = $image_src_arr[0];
                        }
                    } else {
                        $image_src = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
                    }
                }
            }

            // Get the first image in the post content
            if ((!isset($image_src) || empty($image_src)) && ($args['scan'])) {
                preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );
                if ( ! empty( $matches ) ){
                    $image_src  = $matches[1];
                }
            }

            // Use default when nothing found
            if ( (!isset($image_src) || empty($image_src)) && ! empty( $args['default'] ) ){
                if ( is_array( $args['default'] ) ){
                    $image_src  = isset($args['src']) ? $args['src'] : '';
                } else {
                    $image_src = $args['default'];
                }
            }

            if (!isset($image_src) || empty($image_src)) {
                return false;
            }
            $image_cache[$key] = $image_src;
            wp_cache_set( $args['post_id'], $image_cache, 'g5plus_get_image' );
        } else {
            $image_src = $image_cache[$key];
        }
        $image_src = apply_filters( 'g5plus_get_image', $image_src, $args );
        return $image_src;
    }
}

/*================================================
GET IMAGE HOVER
================================================== */
if (!function_exists('g5plus_get_image_hover')) {
    function g5plus_get_image_hover($image,$size, $url, $title, $post_id,$gallery = 0) {
        $attachment_id = g5plus_get_attachment_id_from_url($image);

        $image_full_arr = wp_get_attachment_image_src($attachment_id,'full');

        $image_full = $image;

        if (isset($image_full_arr)) {
            $image_full = $image_full_arr[0];
        }



	    $width = '';
	    $height = '';

	    global $g5plus_image_size;
	    if (isset($g5plus_image_size[$size])) {
		    $width = $g5plus_image_size[$size]['width'];
		    $height = $g5plus_image_size[$size]['height'];
	    } else {
		    global $_wp_additional_image_sizes;
		    if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			    $width = get_option( $size . '_size_w' );
			    $height = get_option( $size . '_size_h' );

		    } elseif ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
			    $width = $_wp_additional_image_sizes[ $size ]['width'];
			    $height = $_wp_additional_image_sizes[ $size ]['height'];
		    }
	    }

        $prettyPhoto = 'prettyPhoto';
        if ($gallery == 1) {
            $prettyPhoto='prettyPhoto[blog_'.$post_id.']';
        }

	    if (empty($width) || empty($height)) {
		    return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s" class="entry-thumbnail_overlay">
                            <img class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>
                        <a data-rel="%5$s" href="%4$s" class="prettyPhoto"><i class="fa fa-expand"></i></a>
                      </div>',
			    $url,
			    $title,
			    $image,
			    $image_full,
			    $prettyPhoto
		    );
	    } else {
		    return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s" class="entry-thumbnail_overlay">
                            <img width="%6$s" height="%7$s" class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>
                        <a data-rel="%5$s" href="%4$s" class="prettyPhoto"><i class="fa fa-expand"></i></a>
                      </div>',
			    $url,
			    $title,
			    $image,
			    $image_full,
			    $prettyPhoto,
			    $width,
			    $height
		    );
	    }


    }
}

if (!function_exists('g5plus_get_video_hover')) {
    function g5plus_get_video_hover($image, $url, $title, $video_url) {
        return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s">
                            <img class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>
                        <a data-rel="prettyPhoto" href="%4$s" class="prettyPhoto"><i class="wicon icon-play43"></i></a>
                      </div>',
            $url,
            $title,
            $image,
            $video_url
        );
    }
}

/*================================================
GET ATTACHMENT ID FROM URL
================================================== */
if (!function_exists('g5plus_get_attachment_id_from_url')) {
    function g5plus_get_attachment_id_from_url($attachment_url = '') {
        global $wpdb;
        $attachment_id = false;

        // If there is no url, return.
        if ( '' == $attachment_url )
            return;

        // Get the upload directory paths
        $upload_dir_paths = wp_upload_dir();

        // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

            // Remove the upload path base directory from the attachment URL
            $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

        }
        return $attachment_id;
    }
}

/*================================================
GET JPLAYER
================================================== */
if (!function_exists('g5plus_jplayer')) {
    function g5plus_jplayer($id = 'jp_container_1') {
        ob_start();
        ?>
        <div id="<?php echo esc_attr($id); ?>" class="jp-audio">
            <div class="jp-type-playlist">
                <div class="jp-gui jp-interface">
                    <ul class="jp-controls jp-play-pause">
                        <li><a href="javascript:;" class="jp-play" tabindex="1"><i
                                    class="fa fa-play"></i> <?php _e('play', 'wolverine'); ?></a></li>
                        <li><a href="javascript:;" class="jp-pause" tabindex="1"><i
                                    class="fa fa-pause"></i> <?php _e('pause', 'wolverine'); ?></a></li>
                    </ul>

                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>

                    <ul class="jp-controls jp-volume">
                        <li>
                            <a href="javascript:;" class="jp-mute" tabindex="1" title="mute"><i
                                    class="fa  fa-volume-up"></i> <?php _e('mute', 'wolverine'); ?></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"><i
                                    class="fa fa-volume-off"></i><?php _e('unmute', 'wolverine'); ?></a>
                        </li>
                        <li>
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </li>

                    </ul>

                    <div class="jp-time-holder">
                        <div class="jp-current-time"></div>
                        <div class="jp-duration"></div>
                    </div>
                    <ul class="jp-toggles">
                        <li>
                            <a href="javascript:;" class="jp-shuffle" tabindex="1"
                               title="shuffle"><?php _e('shuffle', 'wolverine'); ?></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="jp-shuffle-off" tabindex="1"
                               title="shuffle off"><?php _e('shuffle off', 'wolverine'); ?></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="jp-repeat" tabindex="1"
                               title="repeat"><?php _e('repeat', 'wolverine'); ?></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="jp-repeat-off" tabindex="1"
                               title="repeat off"><?php _e('repeat off', 'wolverine'); ?></a>
                        </li>
                    </ul>
                </div>

                <div class="jp-no-solution">
                    <?php printf(__('<span>Update Required</span> To play the media you will need to either update your browser to a recent version or update your <a href="%s" target="_blank">Flash plugin</a>.', 'wolverine'), 'http://get.adobe.com/flashplayer/'); ?>
                </div>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        return $content;
    }
}


/*================================================
GET POST DATE
================================================== */
if (!function_exists('g5plus_post_date')) {
    function g5plus_post_date()
    {
        ob_start();
        ?>
        <div class="entry-date">
            <div class="entry-date-inner">
                <div class="day">
                    <?php echo get_the_time('d'); ?>
                </div>
                <div class="month">
                    <?php echo get_the_date('M'); ?>
                </div>
            </div>
        </div>
    <?php
        $content = ob_get_clean();
        echo sprintf('%s',$content);
    }
}

/*================================================
GET POST META
================================================== */
if (!function_exists('g5plus_post_meta')) {
    function g5plus_post_meta() {
        g5plus_get_template('archive/post-meta');
    }
}

/*================================================
GET POST META RELATED
================================================== */
if (!function_exists('g5plus_post_meta_related')) {
    function g5plus_post_meta_related() {
        g5plus_get_template('archive/post-meta-related');
    }
}



/*================================================
GET POST META SMALL
================================================== */
if (!function_exists('g5plus_post_meta_small')) {
    function g5plus_post_meta_small() {
        ob_start();
        ?>
        <ul class="entry-meta-small">
            <li class="entry-meta-author">
                <?php _e('By','wolverine') ?> : <?php printf('<a href="%1$s">%2$s</a>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())); ?>
            </li>
            <li class="entry-meta-read-more">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php _e('Read more','wolverine') ?></a>
            </li>
        </ul>
        <?php
        $content = ob_get_clean();
        echo sprintf('%s',$content);
    }
}

/*================================================
ARCHIVE LOOP RESET
================================================== */
if (!function_exists('g5plus_archive_loop_reset')) {
    function g5plus_archive_loop_reset()
    {
        global $g5plus_archive_loop;
        $g5plus_archive_loop['image-size'] = '';
        $g5plus_archive_loop['style'] = '';
    }
}

/*================================================
POST NAV
================================================== */
if (!function_exists('g5plus_post_nav')) {
    function g5plus_post_nav() {
        g5plus_get_template('single-blog/post-nav');
    }
    add_action('g5plus_after_single_post_content','g5plus_post_nav',20);
}


/*================================================
LINK PAGES
================================================== */
if (!function_exists('g5plus_link_pages')) {
    function g5plus_link_pages() {
        wp_link_pages(array(
            'before' => '<div class="g5plus-page-links"><span class="g5plus-page-links-title">' . __('Pages:', 'wolverine') . '</span>',
            'after' => '</div>',
            'link_before' => '<span class="g5plus-page-link">',
            'link_after' => '</span>',
        ));
    }
    add_action('g5plus_after_single_post_content','g5plus_link_pages',5);
}

/*================================================
POST TAGS
================================================== */
if (!function_exists('g5plus_post_tags')) {
    function g5plus_post_tags() {
        g5plus_get_template('single-blog/post-tags');
    }
    add_action('g5plus_after_single_post_content','g5plus_post_tags',10);
}

/*================================================
SHARE
================================================== */
if (!function_exists('g5plus_share')) {
    function g5plus_share() {
        g5plus_get_template('social-share');
    }
    add_action('g5plus_after_single_post_content','g5plus_share',15);
}

/*================================================
AUTHOR INFO
================================================== */
if (!function_exists('g5plus_post_author_info')) {
    function g5plus_post_author_info() {
        g5plus_get_template('single-blog/post-author-info');
    }
    add_action('g5plus_after_single_post_content','g5plus_post_author_info',25);
}

/*================================================
POSTS RELATED
================================================== */
if (!function_exists('g5plus_post_related')) {
    function g5plus_post_related() {
        g5plus_get_template('single-blog/related');
    }
    add_action('g5plus_after_single_post_content','g5plus_post_related',30);
}

/*================================================
GET POSTS RELATED
================================================== */
if (!function_exists('g5plus_get_related_post')) {
    function g5plus_get_related_post($post_id,$limit = 5) {

        // Related products are found from category and tag
        $tags_array = g5plus_get_related_terms( $post_id,'post_tag' );
        $cats_array = g5plus_get_related_terms( $post_id,'category' );
        if ( sizeof( $cats_array ) == 1 && sizeof( $tags_array ) == 1 ) {
            $related_posts = array();
        } else {
            global $wpdb;
            $query = g5plus_build_related_post_query( $post_id, $cats_array, $tags_array, $limit );
            // Get the posts
            $related_posts = $wpdb->get_col( implode( ' ', $query ));
        }
        return $related_posts;
    }
}

/*================================================
GET RELATED TERM
================================================== */
if (!function_exists('g5plus_get_related_terms')) {
    function g5plus_get_related_terms($post_id,$term) {
        $terms_array = array(0);
        $terms = apply_filters( 'g5plus_get_related_' . $term . '_terms', wp_get_post_terms( $post_id, $term ), $post_id );
        foreach ( $terms as $term ) {
            $terms_array[] = $term->term_id;
        }
        return array_map( 'absint', $terms_array );
    }
}

/*================================================
GET RELATED QUERY
================================================== */
if (!function_exists('g5plus_build_related_post_query')) {
    function g5plus_build_related_post_query($post_id, $cats_array, $tags_array,$limit) {
        global $wpdb;

        $limit = absint( $limit );

        $query           = array();
        $query['fields'] = "SELECT DISTINCT ID FROM {$wpdb->posts} p";
        $query['join']  = " INNER JOIN {$wpdb->term_relationships} tr ON (p.ID = tr.object_id)";
        $query['join']  .= " INNER JOIN {$wpdb->term_taxonomy} tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)";
        $query['join']  .= " INNER JOIN {$wpdb->terms} t ON (t.term_id = tt.term_id)";


        $query['where']  = " WHERE 1=1";
        $query['where'] .= " AND p.post_status = 'publish'";
        $query['where'] .= " AND p.post_type = 'post'";
        $query['where'] .= " AND p.ID <> {$post_id}";

        $related_post_condition = g5plus_get_option('related_post_condition', array(
	        'category'      => '1',
	        'tag'      => '1',
        ));
        $related_by_category = (isset($related_post_condition['category']) && ( $related_post_condition['category'] == 1)) ? true : false;


        if ( apply_filters( 'g5plus_post_related_posts_relate_by_category', $related_by_category, $post_id ) ) {
            $query['where'] .= " AND ( ( tt.taxonomy = 'category' AND t.term_id IN ( " . implode( ',', $cats_array ) . " ) )";
            $andor = 'OR';
        } else {
            $andor = 'AND';
        }

        $related_by_tag = (isset($related_post_condition['tag']) && ( $related_post_condition['tag'] == 1)) ? true : false;

        // when query is OR - need to check against excluded ids again
        if ( apply_filters( 'g5plus_post_related_posts_relate_by_tag', $related_by_tag, $post_id ) ) {
            $query['where'] .= " {$andor}  ( tt.taxonomy = 'post_tag' AND t.term_id IN ( " . implode( ',', $tags_array ) . " ) )";
        }

        if ( apply_filters( 'g5plus_post_related_posts_relate_by_category', $related_by_category, $post_id ) ) {
            $query['where'] .= ")";
        }


        $query['limits'] = " LIMIT {$limit} ";
        $query           = apply_filters( 'g5plus_post_related_posts_query', $query, $post_id );
        return $query;
    }
}

/*================================================
RENDER COMMENTS
================================================== */
if (!function_exists('g5plus_render_comments')) {
    function g5plus_render_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
                <?php echo get_avatar($comment, $args['avatar_size']); ?>
                <div class="comment-text">
                    <div class="author">
                        <div class="author-name"><?php printf(__('%s', 'wolverine'), get_comment_author_link()) ?></div>
                        <div class="comment-meta">
                            <span class="comment-meta-date">
                                <?php echo get_comment_date('M j, Y'); ?>
                            </span>

                            <?php edit_comment_link(__('Edit', 'wolverine'), '<span class="comment-meta-edit">', '</span>') ?>
                        </div>
                    </div>
                    <div class="text"><?php comment_text() ?></div>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em><?php _e('Your comment is awaiting moderation.', 'wolverine') ?></em>
                    <?php endif; ?>
                    <div class="comment-meta-bottom">
                        <span class="comment-like">
                            <a data-like-comment="true" data-id="<?php comment_ID(); ?>" href="javascript:;">
                                <?php _e('Like:','wolverine') ?> <label><?php echo get_comment_meta(get_comment_ID(),'g5plus-like',true) == '' ? 0 : get_comment_meta(get_comment_ID(),'g5plus-like',true); ?></label> </a>
                        </span>
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </div>
                </div>
            </div>
    <?php
    }
}

/*================================================
COMMENTS FORM
================================================== */
if (!function_exists('g5plus_comment_form')) {
    function g5plus_comment_form() {
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $html5 = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';;
        $fields = array(
            'author' => '<div class="form-group col-md-12">' .
                '<label for="author">'.__('Name*','wolverine').'</label>'.
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" placeholder="'.__('Name*','wolverine').'" ' . $aria_req . '>' .
                '</div>',
            'email' => '<div class="form-group col-md-12">' .
                '<label for="email">'.__('Email*','wolverine').'</label>'.
                '<input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="'.__('Email*','wolverine').'" ' . $aria_req . '>' .
                '</div>',
            'url'   => '<div class="form-group col-md-12">'.
                '<label for="url">'.__("Website",'wolverine').'</label>'.
                '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'.__('Website','wolverine').'" />'.
                '</div>'
        );
        $fields = apply_filters('g5plus_comment_fields',$fields);
        $comment_form_args = array(
            'fields' => $fields,
            'comment_field' => '<div class="form-group col-md-12">' .
                '<label for="comment">'.__('Message*','wolverine').'</label>'.
                '<textarea rows="6" id="comment" name="comment" placeholder="'.__('Message*','wolverine') .'" '. $aria_req .'></textarea>' .
                '</div>',
            'comment_notes_before' => '<p class="comment-notes">' .
                __('Your email address will not be published.', 'wolverine') /* . ( $req ? $required_text : '' ) */ .
                '</p>',
            'comment_notes_after' => '',
            'id_submit' => 'btnComment',
            'class_submit' => 'button-comment',
            'title_reply' => __('Leave a Comment', 'wolverine'),
            'title_reply_to' => __('Leave a Comment to %s', 'wolverine'),
            'cancel_reply_link' => __('Cancel reply', 'wolverine'),
            'label_submit' => __('Send', 'wolverine')
        );

        $comment_form_args = apply_filters('g5plus_comment_form_args',$comment_form_args);

        comment_form($comment_form_args);
    }
}