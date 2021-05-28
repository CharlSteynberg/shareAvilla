<?php
if (!defined('ABSPATH')) die('-1');

if (!defined('G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY'))
    define('G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY', 'portfolio-category');

if (!defined('G5PLUS_PORTFOLIO_POST_TYPE'))
    define('G5PLUS_PORTFOLIO_POST_TYPE', 'portfolio');

if (!defined('G5PLUS_PORTFOLIO_DIR_PATH'))
    define('G5PLUS_PORTFOLIO_DIR_PATH', plugin_dir_path(__FILE__));

include_once(plugin_dir_path(__FILE__) . 'metaboxes/spec.php');
if (!class_exists('G5PlusFramework_Portfolio')) {
    class G5PlusFramework_Portfolio
    {
        function __construct()
        {
            $enable_single_style = g5plus_framework_get_option('portfolio-single-style-enable','1');
            add_action('init', array($this, 'register_taxonomies'), 5);
            add_action('init', array($this, 'register_post_types'), 6);
            add_shortcode('g5plusframework_portfolio', array($this, 'portfolio_shortcode'));
            add_shortcode('g5plusframework_portfolio_taxonomy', array($this, 'portfolio_taxonomy_shortcode'));
            add_filter('rwmb_meta_boxes', array($this, 'register_meta_boxes'));
            if($enable_single_style == '1'){
                add_filter('single_template', array($this, 'get_portfolio_single_template'));
            }
            add_filter('archive_template',array($this,'get_portfolio_archive_template' ) );
            if (is_admin()) {
                add_filter('manage_edit-' . G5PLUS_PORTFOLIO_POST_TYPE . '_columns', array($this, 'add_portfolios_columns'));
                add_action('manage_' . G5PLUS_PORTFOLIO_POST_TYPE . '_posts_custom_column', array($this, 'set_portfolios_columns_value'), 10, 2);
                add_action('restrict_manage_posts', array($this, 'portfolio_manage_posts'));
                add_filter('parse_query', array($this, 'convert_taxonomy_term_in_query'));
                add_action('admin_menu', array($this, 'addMenuChangeSlug'));
                $this->register_taxonomy_meta_box();
            }
            $this->includes();

        }

        function front_scripts()
        {
            $opt_enable_minifile_js = g5plus_framework_get_option('enable_minifile_js','0');
            $min_suffix = ($opt_enable_minifile_js == 1) ? '.min' : '';
            wp_enqueue_style('wolverine-ladda-css', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/ladda/dist/ladda-themeless.min.css', array(),false);
            wp_enqueue_style('wolverine-book-block-css', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/bookblock/bookblock.css', array());
            wp_enqueue_script('wolverine-ladda-spin', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/ladda/dist/spin.min.js', false, true);
            wp_enqueue_script('wolverine-ladda', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/ladda/dist/ladda.min.js', false, true);
            wp_enqueue_script('wolverine-modernizr', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/hoverdir/modernizr.js', false, true);
            wp_enqueue_script('wolverine-hoverdir', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/hoverdir/jquery.hoverdir.js', false, true);
            wp_enqueue_script('wolverine-book-block-modernizr', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/bookblock/modernizr.custom.js', false, true);
            wp_enqueue_script('wolverine-book-block-pp', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/bookblock/jquerypp.custom.js', false, true);
            wp_enqueue_script('wolverine-book-block', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/bookblock/jquery.bookblock.min.js', false, true);
            wp_enqueue_script('wolverine-portfolio-flipbook', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/flipbook' . $min_suffix . '.js', array( 'wolverine-book-block-modernizr','wolverine-book-block-pp','wolverine-book-block' ), true, true);
            wp_enqueue_script('wolverine-portfolio-ajax-action', PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/portfolio/assets/js/ajax-action' . $min_suffix . '.js', false, true);
        }

        function register_post_types()
        {

            $post_type = G5PLUS_PORTFOLIO_POST_TYPE;

            if (post_type_exists($post_type)) {
                return;
            }

            $post_type_slug = get_option('g5plus-wolverine-' . $post_type . '-config');
            if (!isset($post_type_slug) || !is_array($post_type_slug)) {
                $slug = 'portfolio';
                $name = $singular_name = 'Portfolio';
            } else {
                $slug = $post_type_slug['slug'];
                $name = $post_type_slug['name'];
                $singular_name = $post_type_slug['singular_name'];
            }

            register_post_type($post_type,
                array(
                    'label' => __('Portfolio', 'wolverine'),
                    'description' => __('Portfolio Description', 'wolverine'),
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
                    'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
                    'public' => true,
                    'show_ui' => true,
                    '_builtin' => false,
                    'has_archive' => true,
                    'menu_icon' => 'dashicons-screenoptions',
                    'rewrite' => array('slug' => $slug, 'with_front' => true),
                )
            );
            flush_rewrite_rules();
        }

        function register_taxonomies()
        {
            if (taxonomy_exists(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY)) {
                return;
            }

            $post_type = G5PLUS_PORTFOLIO_POST_TYPE;
            $taxonomy_slug = G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY;
            $taxonomy_name = 'Portfolio Categories';

            $post_type_slug = get_option('g5plus-wolverine-' . $post_type . '-config');
            if (isset($post_type_slug) && is_array($post_type_slug) &&
                array_key_exists('taxonomy_slug', $post_type_slug) && $post_type_slug['taxonomy_slug'] != ''
            ) {
                $taxonomy_slug = $post_type_slug['taxonomy_slug'];
                $taxonomy_name = $post_type_slug['taxonomy_name'];
            }
            register_taxonomy(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY, G5PLUS_PORTFOLIO_POST_TYPE,
                array('hierarchical' => true,
                    'label' => $taxonomy_name,
                    'query_var' => true,
                    'rewrite' => array('slug' => $taxonomy_slug))
            );
            //flush_rewrite_rules();

        }

        function register_taxonomy_meta_box(){
            if (is_admin()){
                /*
                 * prefix of meta keys, optional
                 */
                $prefix = 'g5plus_';
                /*
                 * configure your meta box
                 */
                $config = array(
                    'id' => 'portfolio_category_meta_box',          // meta box id, unique per meta box
                    'title' => 'Portfolio category meta box',          // meta box title
                    'pages' => array('portfolio-category'),        // taxonomy name, accept categories, post_tag and custom taxonomies
                    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
                    'fields' => array(),            // list of meta fields (can be added by field arrays)
                    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
                    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
                );


                /*
                 * Initiate your meta box
                 */
                if(class_exists('Tax_Meta_Class')){
                    $my_meta =  new Tax_Meta_Class($config);
                    $my_meta->addFile($prefix.'thumbnail_id',array('name'=> __('Thumbnail','wolverine')));
                    //Finish Meta Box Decleration
                    $my_meta->Finish();
                }

            }
        }

        function portfolio_shortcode($atts)
        {
            $this->front_scripts();

            $category_position = $data_source = $menu_social = $menu_logo = $search_logo = $detail_logo = $portfolio_ids = $title_contact = $link_contact = $order = $title = $subtitle = $link_more_item = $overlay_align = $column_masonry = $image_size = $layout_type = $show_title = $offset = $current_page = $overlay_style = $show_pagging_masonry = $show_pagging = $show_category = $category = $column = $item = $padding = $layout_type = $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type' => 'grid',
                'menu_logo' => '',
                'search_logo' => '',
                'detail_logo' => '',
                'menu_social' => '',
                'title' => '',
                'subtitle' => '',
                'title_contact' => '',
                'link_contact' => '',
                'link_more_item' => '',
                'data_source' => '',
                'show_title' => '',
                'show_pagging' => '',
                'show_pagging_masonry' => '',
                'show_category' => '',
                'category' => '',
                'category_position' => '',
                'portfolio_ids' => '',
                'column' => '2',
                'column_masonry' => '3',
                'item' => '',
                'order' => 'DESC',
                'padding' => '',
                'image_size' => '585x585',
                'schema_style' => '',
                'overlay_style' => 'icon',
                'el_class' => '',
                'css_animation' => '',
                'duration' => '',
                'delay' => '',
                'current_page' => '1'
            ), $atts));

            if ($show_pagging == '2' || $item=='') {
                $offset = 0;
                $post_per_page = -1;
            } else {
                $post_per_page = $item;
                $offset = ($current_page - 1) * $item;
            }
            if ($overlay_style == 'left-title-excerpt-link' || $overlay_style == 'title-excerpt-link-no-icon' )
                $overlay_align = 'hover-align-left';
            else
                $overlay_align = 'hover-align-center';

            $g5plus_animation .= ' ' . esc_attr($el_class);
            $g5plus_animation .= g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            $styles_animation = g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay);
            if ($layout_type == 'masonry' || $layout_type == 'masonry-style-02' || $layout_type == 'masonry-classic') {
                $column = $column_masonry;
                $show_pagging = $show_pagging_masonry;
            }
            $plugin_path = untrailingslashit(plugin_dir_path(__FILE__));

            switch ($layout_type) {
                case 'title-more-link':
                {
                    $column = 4;
                    $template_path = $plugin_path . '/templates/listing-title-more-link.php';
                    break;
                }
                case 'more-link':
                {
                    $template_path = $plugin_path . '/templates/listing-more-link.php';
                    break;
                }
                case 'one-page':
                {
                    $template_path = $plugin_path . '/templates/listing-onepage.php';
                    break;
                }
                case 'left-menu':{
                    $column = 4;
                    $template_path = $plugin_path . '/templates/listing-left-menu.php';
                    break;
                }
                case 'masonry-style-02':
                {
                    $column = 3;
                    $template_path = $plugin_path . '/templates/listing-masonry-style-02.php';
                    break;
                }
                case 'flip-book':
                {
                    $template_path = $plugin_path . '/templates/listing-flip-book.php';
                    break;
                }
                case 'masonry-classic':
                {
                    $column = 4;
                }
                default:
                    {
                    $template_path = $plugin_path . '/templates/listing.php';
                    }
            }
            ob_start();
            include($template_path);
            $ret = ob_get_contents();
            ob_end_clean();
            return $ret;
        }

        function portfolio_taxonomy_shortcode($atts){
            $this->front_scripts();

            $portfolio_taxonomy_ids = $order = $overlay_align = $column_masonry = $image_size = $layout_type = $offset = $current_page = $overlay_style =  $show_category = $category = $column = $item = $padding = $layout_type = $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type' => 'grid',
                'portfolio_taxonomy_ids' => '',
                'column' => '2',
                'column_masonry' => '3',
                'order' => 'DESC',
                'padding' => '',
                'image_size' => '585x585',
                'schema_style' => '',
                'overlay_style' => 'title',
                'el_class' => '',
                'css_animation' => '',
                'duration' => '',
                'delay' => '',
                'current_page' => '1'
            ), $atts));

            if ($overlay_style == 'left-title-excerpt-link' || $overlay_style == 'title-excerpt-link-no-icon' )
                $overlay_align = 'hover-align-left';
            else
                $overlay_align = 'hover-align-center';

            $g5plus_animation .= ' ' . esc_attr($el_class);
            $g5plus_animation .= g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            $styles_animation = g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay);
            if ($layout_type == 'masonry' || $layout_type == 'masonry-style-02' || $layout_type == 'masonry-classic') {
                $column = $column_masonry;
            }
            $plugin_path = untrailingslashit(plugin_dir_path(__FILE__));

            switch ($layout_type) {
                case 'one-page':
                {
                    $template_path = $plugin_path . '/taxonomy-templates/listing-onepage.php';
                    break;
                }
                case 'left-menu':{
                    $column = 4;
                    $template_path = $plugin_path . '/taxonomy-templates/listing-left-menu.php';
                    break;
                }
                case 'masonry-style-02':
                {
                    $column = 3;
                    $template_path = $plugin_path . '/taxonomy-templates/listing-masonry-style-02.php';
                    break;
                }
                case 'masonry-classic':
                {
                    $column = 4;
                }
                default:
                    {
                    $template_path = $plugin_path . '/taxonomy-templates/listing.php';
                    }
            }
            ob_start();
            include($template_path);
            $ret = ob_get_contents();
            ob_end_clean();
            return $ret;
        }

        function register_meta_boxes($meta_boxes)
        {
            $meta_boxes[] = array(
                'title' => __('Portfolio Extra', 'wolverine'),
                'id' => 'wolverine-meta-box-portfolio-format-gallery',
                'pages' => array(G5PLUS_PORTFOLIO_POST_TYPE),
                'fields' => array(
                    array(
                        'name' => __('Link to detail', 'wolverine'),
                        'id' => 'portfolio-link',
                        'type' => 'text',
                    ),
                    array(
                        'name' => __('Client', 'wolverine'),
                        'id' => 'portfolio-client',
                        'type' => 'text',
                    ),
                    array(
                        'name' => __('Gallery', 'wolverine'),
                        'id' => 'portfolio-format-gallery',
                        'type' => 'image_advanced',
                    ),
                    array(
                        'name' => __('Background Image', 'wolverine'),
                        'id' => 'portfolio-background-image',
                        'type' => 'image_advanced',
                    ),
                    array(
                        'name'     => __( 'View Detail Style', 'wolverine' ),
                        'id'       => 'portfolio_detail_style',
                        'type'     => 'select',
                        'options'  => array(
                            'none' => __('Inherit from theme options','wolverine'),
                            'detail-01' 	=> __( 'Horizontal slide', 'wolverine' ),
                            'detail-02' 	=> __( 'Vertical slide', 'wolverine' ),
                            'detail-03' 	=> __( 'Small slide', 'wolverine' ),
                            'detail-04' 	=> __( 'Big Slide', 'wolverine' )
                        ),
                        'multiple'    => false,
                        'std'         => 'none',
                    )
                )
            );
            return $meta_boxes;
        }

        function get_portfolio_single_template($single)
        {
            global $post;
            /* Checks for single template by post type */
            if ($post->post_type == G5PLUS_PORTFOLIO_POST_TYPE) {
                $this->front_scripts();
                $plugin_path = untrailingslashit(G5PLUS_PORTFOLIO_DIR_PATH);
                $template_path = $plugin_path . '/templates/single/single-portfolio.php';
                if (file_exists($template_path))
                    return $template_path;
            }
            return $single;
        }

        function get_portfolio_archive_template($archive_template) {
            /* Checks for archive template by post type */
            $post_types =  get_post_type();
             if ( is_archive() && isset($post_types) && $post_types==G5PLUS_PORTFOLIO_POST_TYPE  ) {
                $plugin_path =  untrailingslashit( G5PLUS_PORTFOLIO_DIR_PATH );
                $template_path = $plugin_path . '/templates/archive/archive-portfolio.php';
                if(file_exists($template_path))
                    return $template_path;
             }
            return $archive_template;
        }

        function add_portfolios_columns($columns)
        {
            unset(
            $columns['cb'],
            $columns['title'],
            $columns['date']
            );
            $cols = array_merge(array('cb' => ('')), $columns);
            $cols = array_merge($cols, array('title' => __('Name', 'wolverine')));
            $cols = array_merge($cols, array('thumbnail' => __('Thumbnail', 'wolverine')));
            $cols = array_merge($cols, array(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY => __('Categories', 'wolverine')));
            $cols = array_merge($cols, array('date' => __('Date', 'wolverine')));
            return $cols;
        }

        function set_portfolios_columns_value($column, $post_id)
        {

            switch ($column) {
                case 'id':
                {
                    echo wp_kses_post($post_id);
                    break;
                }
                case 'thumbnail':
                {
                    echo get_the_post_thumbnail($post_id, 'thumbnail');
                    break;
                }
                case G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY:
                {
                    $terms = wp_get_post_terms(get_the_ID(), array(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));
                    $cat = '<ul>';
                    foreach ($terms as $term) {
                        $cat .= '<li><a href="' . get_term_link($term, G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY) . '">' . $term->name . '<a/></li>';
                    }
                    $cat .= '</ul>';
                    echo wp_kses_post($cat);
                    break;
                }
            }
        }

        function portfolio_manage_posts()
        {
            global $typenow;
            if ($typenow == G5PLUS_PORTFOLIO_POST_TYPE) {
                $selected = isset($_GET[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY]) ? $_GET[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY] : '';
                $args = array(
                    'show_count' => true,
                    'show_option_all' => __('Show All Categories', 'wolverine'),
                    'taxonomy' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY,
                    'name' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY,
                    'selected' => $selected,

                );
                wp_dropdown_categories($args);
            }
        }

        function convert_taxonomy_term_in_query($query)
        {
            global $pagenow;
            $qv = & $query->query_vars;
            if ($pagenow == 'edit.php' &&
                isset($qv[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY]) &&
                is_numeric($qv[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY])
            ) {
                $term = get_term_by('id', $qv[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY], G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY);
                $qv[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY] = $term->slug;
            }
        }

        function addMenuChangeSlug()
        {
            add_submenu_page('edit.php?post_type=portfolio', 'Setting', 'Settings', 'edit_posts', wp_basename(__FILE__), array($this, 'initPageSettings'));
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
            include_once('utils/utils.php');
        }

        public static function get_flip_book_detail_path(){
            return  $template_path = untrailingslashit(plugin_dir_path(__FILE__)) . '/templates/single/detail-flipbook.php';
        }

        public static function get_social_icon($social){
            switch ($social){
                case 'facebook_url':{
                    return 'fa fa-facebook';
                }
                case 'twitter_url':{
                    return 'fa fa-twitter';
                }
                case 'dribbble_url':{
                    return 'fa fa-dribbble';
                }
                case 'vimeo_url':{
                    return 'fa fa-vimeo-square';
                }
                case 'pinterest_url':{
                    return 'fa fa-pinterest-p';
                }
                case 'googleplus_url':{
                    return 'fa fa-google-plus';
                }
                case 'linkedin_url':{
                    return 'fa fa-linkedin';
                }
                case 'youtube_url':{
                    return 'fa fa-youtube';
                }
                case 'instagram_url':{
                    return 'fa fa-instagram';
                }
            }
        }

    }

    new G5PlusFramework_Portfolio();
}
