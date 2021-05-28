<?php
/*---------------------------------------------------
/* THEME ADD ACTION
/*---------------------------------------------------*/

remove_action('g5plus_after_single_post_content','g5plus_share',15);

/*================================================
COMMENT FORM BEFORE
================================================== */
if (!function_exists('g5plus_comment_form_before_fields')) {
    function g5plus_comment_form_before_fields() {
        ?>
        <div class="comment-fields-wrap">
            <div class="entry-comments-form-avatar">
                <?php echo get_avatar(get_current_user_id(), '100'); ?>
            </div>
            <div class="comment-fields-inner clearfix">
                <div class="row">
        <?php
    }
    //add_action('comment_form_before_fields','g5plus_comment_form_before_fields');
    //add_action('comment_form_logged_in_after','g5plus_comment_form_before_fields');
}

/*================================================
COMMENT BOTTOM FORM
================================================== */
if (!function_exists('g5plus_bottom_comment_form')) {
    function g5plus_bottom_comment_form() {
        echo '</div></div></div>';
    }
    //add_action('comment_form','g5plus_bottom_comment_form');
}

add_action('g5plus_after_single_post_content','comments_template',35);



if (!function_exists('g5plus_get_font_family')) {
	function g5plus_get_font_family($name) {
		if ((strpos($name, ',') === false) || (strpos($name, ' ') === false)) {
			return $name;
		}
		return "'{$name}'";
	}
}

if (!function_exists('g5plus_process_font')) {
	function g5plus_process_font($fonts) {
		if (isset($fonts['font-weight']) && (($fonts['font-weight'] === '') || ($fonts['font-weight'] === 'regular')) ) {
			$fonts['font-weight'] = '400';
		}

		if (isset($fonts['font-style']) && ($fonts['font-style'] === '') ) {
			$fonts['font-style'] = 'normal';
		}
		return $fonts;
	}
}

if (!function_exists('g5plus_custom_css_editor_callback')) {
	function g5plus_custom_css_editor_callback() {
		$custom_css = g5plus_custom_css_editor();

		/**
		 * Make sure we set the correct MIME type
		 */
		header( 'Content-Type: text/css' );
		/**
		 * Render RTL CSS
		 */
		echo sprintf('%s',$custom_css);
		die();
	}
	add_action( 'wp_ajax_gsf_custom_css_editor', 'g5plus_custom_css_editor_callback');
	add_action( 'wp_ajax_nopriv_gsf_custom_css_editor', 'g5plus_custom_css_editor_callback');
}

if (!function_exists('g5plus_custom_css_editor')) {
	function g5plus_custom_css_editor() {
		$custom_css =<<<CSS
        body {
              margin: 9px 10px;
            }
CSS;
		$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';

		if (!empty($post_id)) {

			$prefix = 'g5plus_';

			$sidebar_layout = g5plus_rwmb_meta($prefix.'page_sidebar',array(),$post_id);
			if (($sidebar_layout === '') || ($sidebar_layout == '-1')) {
				$sidebar_layout = g5plus_get_option('single_blog_sidebar','none');
			}

			$left_sidebar = g5plus_rwmb_meta($prefix.'page_left_sidebar', array(),$post_id);
			if (($left_sidebar === false) || ($left_sidebar === '') || ($left_sidebar == '-1')) {
				$left_sidebar = g5plus_get_option('single_blog_left_sidebar','sidebar-1');
			}

			$right_sidebar = g5plus_rwmb_meta($prefix.'page_right_sidebar',array(), $post_id);
			if (($right_sidebar === false) || ($right_sidebar === '') || ($right_sidebar == '-1')) {
				$right_sidebar = g5plus_get_option('single_blog_right_sidebar','sidebar-2');
			}


			$sidebar_width = g5plus_rwmb_meta($prefix.'sidebar_width',array(),$post_id);
			if (($sidebar_width === false) || ($sidebar_width === '') || ($sidebar_width == '-1')) {
				$sidebar_width = g5plus_get_option('single_blog_sidebar_width','small');
			}

			$content_width = 1170;
			$sidebar_text = esc_html__('Sidebar', 'wolverine');
			if ($sidebar_width === 'large') {
				$sidebar_width = 770;
			} else {
				$sidebar_width = 870;
			}

			$custom_css .= <<<CSS
            
            .mceContentBody::after {
              display: block;
              position: absolute;
              top: 0;
              left: 102%;
              width: 10px;
              -ms-word-break: break-all;
              word-break: break-all;
              font-size: 14px;
              color: #d8d8d8;
              text-align: center;
              height: 100%;
              max-width: 330px;
              z-index: 1;
              text-transform: uppercase;
              font-family: sans-serif;
              font-weight: 600;
              line-height: 26px;
              pointer-events: none;
            }
            
            .mceContentBody.mceContentBody {
              padding-right: 25px !important;
              padding-left: 15px !important;
              border-right: 1px solid #eee;
              position: relative;
              
            }
            .mceContentBody.mceContentBody[data-site_layout="none"] {
                max-width: 1170px;
                
              }
            .mceContentBody.mceContentBody[data-site_layout="none"]:after {
                  content: '';
             }
CSS;

			if ((is_active_sidebar($left_sidebar) && (($sidebar_layout == 'both') || ($sidebar_layout == 'left')))
			    || (is_active_sidebar($right_sidebar) && (($sidebar_layout == 'both') || ($sidebar_layout == 'right')))) {
				$content_width = $sidebar_width;

				$custom_css .= <<<CSS
				.mceContentBody::after {
				    content: '{$sidebar_text}';
				}
CSS;
			}


			$custom_css .= <<<CSS
            

			.mceContentBody[data-site_layout="left"],
			.mceContentBody[data-site_layout="right"]{
			    max-width: {$sidebar_width}px;
			}
			
			.mceContentBody[data-site_layout="left"]::after,
			 .mceContentBody[data-site_layout="right"]::after{
				    content: '{$sidebar_text}';
				}

			.mceContentBody {
				max-width: {$content_width}px;
			}
			
CSS;
		}

		$custom_css .= g5plus_get_fonts_css();

		// Remove comments
		$custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
		// Remove space after colons
		$custom_css = str_replace(': ', ':', $custom_css);
		// Remove whitespace
		$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
		return $custom_css;
	}
}

if (!function_exists('g5plus_enqueue_block_editor_assets')) {
	function g5plus_enqueue_block_editor_assets() {
		wp_enqueue_style('fontawesome', THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css', array(),'4.5.0');

		wp_enqueue_style('block-editor', THEME_URL . '/assets/css/editor-blocks.css');

		$screen = get_current_screen();
		$post_id = '';
		if ( is_admin() && ($screen->id == 'post') ) {
			global $post;
			$post_id = $post->ID;
		}

		wp_enqueue_style('gsf_custom_css_block_editor', admin_url('admin-ajax.php') . '?action=gsf_custom_css_block_editor&post_id=' . $post_id);


		$fonts_url = g5plus_get_fonts_url();
		$fonts_css = g5plus_get_fonts_css(false);
		wp_enqueue_style('google-fonts',$fonts_url);
		wp_add_inline_style('google-fonts',$fonts_css);
	}
	add_action('enqueue_block_editor_assets','g5plus_enqueue_block_editor_assets');
}

if (!function_exists('g5plus_custom_css_block_editor_callback')) {
	function g5plus_custom_css_block_editor_callback() {
		$custom_css = g5plus_custom_css_block_editor();

		/**
		 * Make sure we set the correct MIME type
		 */
		header( 'Content-Type: text/css' );
		/**
		 * Render RTL CSS
		 */
		echo sprintf('%s',$custom_css);
		die();
	}
	add_action( 'wp_ajax_gsf_custom_css_block_editor', 'g5plus_custom_css_block_editor_callback');
	add_action( 'wp_ajax_nopriv_gsf_custom_css_block_editor', 'g5plus_custom_css_block_editor_callback');
}

if (!function_exists('g5plus_custom_css_block_editor')) {
	function g5plus_custom_css_block_editor() {
		$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';

		$prefix = 'g5plus_';

		$sidebar_layout = g5plus_rwmb_meta($prefix.'page_sidebar',array(),$post_id);
		if (($sidebar_layout === '') || ($sidebar_layout == '-1')) {
			$sidebar_layout = g5plus_get_option('single_blog_sidebar','none');
		}

		$left_sidebar = g5plus_rwmb_meta($prefix.'page_left_sidebar', array(),$post_id);
		if (($left_sidebar === false) || ($left_sidebar === '') || ($left_sidebar == '-1')) {
			$left_sidebar = g5plus_get_option('single_blog_left_sidebar','sidebar-1');
		}

		$right_sidebar = g5plus_rwmb_meta($prefix.'page_right_sidebar',array(), $post_id);
		if (($right_sidebar === false) || ($right_sidebar === '') || ($right_sidebar == '-1')) {
			$right_sidebar = g5plus_get_option('single_blog_right_sidebar','sidebar-2');
		}


		$sidebar_width = g5plus_rwmb_meta($prefix.'sidebar_width',array(),$post_id);
		if (($sidebar_width === false) || ($sidebar_width === '') || ($sidebar_width == '-1')) {
			$sidebar_width = g5plus_get_option('single_blog_sidebar_width','small');
		}


		$content_width = 1170;
		if ($sidebar_width === 'large') {
			$sidebar_width = 770;
		} else {
			$sidebar_width = 870;
		}

		$custom_css = '';
		if ((is_active_sidebar($left_sidebar) && (($sidebar_layout == 'both') || ($sidebar_layout == 'left')))
		    || (is_active_sidebar($right_sidebar) && (($sidebar_layout == 'both') || ($sidebar_layout == 'right')))) {
			$content_width = $sidebar_width;
		}
		$custom_css .= <<<CSS
            
            .edit-post-layout__content[data-site_layout="left"] .wp-block,
			.edit-post-layout__content[data-site_layout="right"] .wp-block,
			.edit-post-layout__content[data-site_layout="left"] .wp-block[data-align="wide"],
			.edit-post-layout__content[data-site_layout="right"] .wp-block[data-align="wide"],
			.edit-post-layout__content[data-site_layout="left"] .wp-block[data-align="full"],
			.edit-post-layout__content[data-site_layout="right"] .wp-block[data-align="full"]{
			    max-width: {$sidebar_width}px;
			}
			
			.wp-block[data-align="full"] {
			    margin-left: auto !important;
			    margin-right: auto !important;
			}
			
            
            .wp-block,
            .wp-block[data-align="wide"],
             .wp-block[data-align="full"]{
                max-width: {$content_width}px;
            }
			
CSS;
		// Remove comments
		$custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
		// Remove space after colons
		$custom_css = str_replace(': ', ':', $custom_css);
		// Remove whitespace
		$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);

		return $custom_css;
	}
}
