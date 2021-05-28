<?php
if (!defined('ABSPATH')) die('-1');

if (!defined('G5PLUS_GALLERY_CATEGORY_TAXONOMY'))
    define('G5PLUS_GALLERY_CATEGORY_TAXONOMY', 'gallery-category');

if (!defined('G5PLUS_GALLERY_POST_TYPE'))
    define('G5PLUS_GALLERY_POST_TYPE', 'gallery');

if (!defined('G5PLUS_GALLERY_DIR_PATH'))
    define('G5PLUS_GALLERY_DIR_PATH', plugin_dir_path(__FILE__));


if (!class_exists('G5PlusFramework_Gallery')) {

    class G5PlusFramework_Gallery
    {
        function __construct()
        {
            add_action('init', array($this, 'register_taxonomies'), 5);
            add_action('init', array($this, 'register_post_types'), 6);
            add_shortcode('g5plusframework_gallery', array($this, 'gallery_shortcode'));
            add_filter('rwmb_meta_boxes', array($this, 'register_meta_boxes'));

            if (is_admin()) {
                add_action('admin_menu', array($this, 'addMenuChangeSlug'));
            }
            $this->includes();


        }

        function front_scripts($popup_type)
        {
            $opt_enable_minifile_js = g5plus_framework_get_option('enable_minifile_js','0');
            $min_suffix = ($opt_enable_minifile_js == 1) ? '.min' : '';
            if($popup_type=='magnific_popup'){
                wp_enqueue_style('wolverine-magnific-css', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/gallery/assets/js/magnific-popup/magnific-popup.css', array(), false);
                wp_enqueue_script('wolverine-magnific', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/gallery/assets/js/magnific-popup/jquery.magnific-popup.min.js', false, true);
            }
            wp_enqueue_style('wolverine-ladda-css', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/gallery/assets/js/ladda/dist/ladda-themeless.min.css', array(), false);
            wp_enqueue_script('wolverine-ladda-spin', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/gallery/assets/js/ladda/dist/spin.min.js', false, true);
            wp_enqueue_script('wolverine-ladda', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/gallery/assets/js/ladda/dist/ladda.min.js', false, true);
            wp_enqueue_script('wolverine-modernizr', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/gallery/assets/js/hoverdir/modernizr.js', false, true);
            wp_enqueue_script('wolverine-hoverdir', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/gallery/assets/js/hoverdir/jquery.hoverdir.js', false, true);
            wp_enqueue_script('wolverine-gallery-ajax-action', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/gallery/assets/js/ajax-action' . $min_suffix . '.js', false, true);
        }

        function register_post_types()
        {

            $post_type = G5PLUS_GALLERY_POST_TYPE;

            if (post_type_exists($post_type)) {
                return;
            }

            $post_type_slug = get_option('g5plus-wolverine-' . $post_type . '-config');
            if (!isset($post_type_slug) || !is_array($post_type_slug)) {
                $slug = 'gallery';
                $name = $singular_name = 'gallery';
            } else {
                $slug = $post_type_slug['slug'];
                $name = $post_type_slug['name'];
                $singular_name = $post_type_slug['singular_name'];
            }

            register_post_type($post_type,
                array(
                    'label' => __('Gallery', 'wolverine'),
                    'description' => __('Gallery Description', 'wolverine'),
                    'labels' => array(
                        'name' => $name,
                        'singular_name' => $singular_name,
                        'menu_name' => $name,
                        'parent_item_colon' => __('Parent Item:', 'wolverine'),
                        'all_items' => sprintf(__('All %s', 'wolverine'), $name),
                        'view_item' => __('View Item', 'wolverine'),
                        'add_new_item' => sprintf(__('Add New  %s', 'wolverine'), $name),
                        'add_new' => __('Add New', 'wolverine'),
                        'edit_item' => __('Edit Item', 'wolverine'),
                        'update_item' => __('Update Item', 'wolverine'),
                        'search_items' => __('Search Item', 'wolverine'),
                        'not_found' => __('Not found', 'wolverine'),
                        'not_found_in_trash' => __('Not found in Trash', 'wolverine'),
                    ),
                    'supports' => array('title', 'thumbnail'),
                    'public' => true,
                    'show_ui' => true,
                    '_builtin' => false,
                    'has_archive' => true,
                    'menu_icon' => 'dashicons-gallery',
                    'rewrite' => array('slug' => $slug, 'with_front' => true),
                )
            );
            flush_rewrite_rules();
        }

        function register_taxonomies()
        {
            if (taxonomy_exists(G5PLUS_GALLERY_CATEGORY_TAXONOMY)) {
                return;
            }

            $post_type = G5PLUS_GALLERY_POST_TYPE;
            $taxonomy_slug = G5PLUS_GALLERY_CATEGORY_TAXONOMY;
            $taxonomy_name = 'Gallery Categories';

            $post_type_slug = get_option('g5plus-wolverine-' . $post_type . '-config');
            if (isset($post_type_slug) && is_array($post_type_slug) &&
                array_key_exists('taxonomy_slug', $post_type_slug) && $post_type_slug['taxonomy_slug'] != ''
            ) {
                $taxonomy_slug = $post_type_slug['taxonomy_slug'];
                $taxonomy_name = $post_type_slug['taxonomy_name'];
            }
            register_taxonomy(G5PLUS_GALLERY_CATEGORY_TAXONOMY, G5PLUS_GALLERY_POST_TYPE,
                array('hierarchical' => true,
                    'label' => $taxonomy_name,
                    'query_var' => true,
                    'rewrite' => array('slug' => $taxonomy_slug))
            );
            flush_rewrite_rules();
        }

        function gallery_shortcode($atts)
        {

            $popup_type = $display_type = $ajax_load = $overlay_style = $category_position = $data_source = $gallery_ids = $order = $layout_type = $offset = $current_page = $show_pagging = $show_category = $category = $column = $item = $padding = $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'popup_type' => '',
                'display_type' => '',
                'data_source' => '',
                'show_pagging' => '',
                'show_category' => '',
                'category' => '',
                'gallery_ids' => '',
                'column' => '2',
                'item' => '',
                'order' => 'DESC',
                'padding' => '',
                'el_class' => '',
                'css_animation' => '',
                'duration' => '',
                'delay' => '',
                'current_page' => '1',
                'ajax_load' => '0'
            ), $atts));
            $layout_type = 'grid';
            $overlay_style = 'icon-view';

            $this->front_scripts($popup_type);

            if ($show_pagging == '2' || $item == '') {
                $offset = 0;
                $post_per_page = -1;
            } else {
                $post_per_page = $item;
                $offset = ($current_page - 1) * $item;
            }
            if($display_type=='full'){
                $show_category = '';
                $post_per_page = -1;
            }

            $g5plus_animation .= ' ' . esc_attr($el_class);
            $g5plus_animation .= g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            $styles_animation = g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay);
            $plugin_path = untrailingslashit(plugin_dir_path(__FILE__));
            $template_path = $plugin_path . '/templates/listing.php';

            ob_start();
            include($template_path);
            $ret = ob_get_contents();
            ob_end_clean();
            return $ret;
        }

        function register_meta_boxes($meta_boxes)
        {

            $meta_boxes[] = array(
                'title' => __('Gallery Extra', 'wolverine'),
                'id' => 'wolverine-meta-box-gallery-extra',
                'pages' => array(G5PLUS_GALLERY_POST_TYPE),
                'fields' => array(
                    array(
                        'name' => __('Gallery', 'wolverine'),
                        'id' => 'gallery-format-gallery',
                        'type' => 'image_advanced',
                    )
                )
            );
            return $meta_boxes;
        }

        function addMenuChangeSlug()
        {
            add_submenu_page('edit.php?post_type=gallery', 'Setting', 'Settings', 'edit_posts', wp_basename(__FILE__), array($this, 'initPageSettings'));
        }

        function initPageSettings()
        {
            $template_path = ABSPATH . 'wp-content/plugins/wolverine-framework/includes/shortcodes/posttype-settings/settings.php';
            if (file_exists($template_path))
                require_once $template_path;
        }

        private function includes()
        {
            include_once('utils/ajax-action.php');
        }
    }

    new G5PlusFramework_Gallery();
}