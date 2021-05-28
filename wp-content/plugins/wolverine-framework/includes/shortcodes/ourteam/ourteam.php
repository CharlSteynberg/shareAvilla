<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) die( '-1' );
// Include post types
global $ourteam_metabox;
$ourteam_metabox = new WPAlchemy_MetaBox(array
(
    'id' => 'wolverine_ourteam_settings',
    'title' => __('Our Team Social Settings', 'wolverine'),
    'template' => plugin_dir_path( __FILE__ ) . 'custom-field.php',
    'types' => array('ourteam'),
    'autosave' => TRUE,
    'priority' => 'high',
    'context' => 'normal',
    'hide_editor' => TRUE
));
if(!class_exists('g5plusFramework_Shortcode_Ourteam')){
    class g5plusFramework_Shortcode_Ourteam{
        function __construct(){
            add_action('init', array($this, 'register_taxonomies'), 5);
            add_action('init', array($this, 'register_post_types'), 5);
            add_shortcode('wolverine_ourteam', array($this, 'ourteam_shortcode'));
            add_filter('rwmb_meta_boxes', array($this, 'register_meta_boxes'));
            if (is_admin()) {
                add_filter('manage_edit-ourteam_columns', array($this, 'add_columns'));
                add_action('manage_ourteam_posts_custom_column', array($this, 'set_columns_value'), 10, 2);
                add_action('admin_menu', array($this, 'addMenuChangeSlug'));
            }
        }
        function register_taxonomies()
        {
            if (taxonomy_exists('ourteam_category')) {
                return;
            }

            $post_type = 'ourteam';
            $taxonomy_slug = 'ourteam_category';
            $taxonomy_name = 'Our Team Categories';

            $post_type_slug = get_option('g5plus-wolverine-' . $post_type . '-config');
            if (isset($post_type_slug) && is_array($post_type_slug) &&
                array_key_exists('taxonomy_slug', $post_type_slug) && $post_type_slug['taxonomy_slug'] != ''
            ) {
                $taxonomy_slug = $post_type_slug['taxonomy_slug'];
                $taxonomy_name = $post_type_slug['taxonomy_name'];
            }
            register_taxonomy('ourteam_category', 'ourteam',
                array('hierarchical' => true,
                    'label' => $taxonomy_name,
                    'query_var' => true,
                    'rewrite' => array('slug' => $taxonomy_slug))
            );
            flush_rewrite_rules();
        }
        function register_post_types()
        {
            $post_type = 'ourteam';

            if ( post_type_exists($post_type) ) {
                return;
            }

            $post_type_slug = get_option('g5plus-wolverine-' . $post_type . '-config');
            if (!isset($post_type_slug) || !is_array($post_type_slug)) {
                $slug = 'ourteam';
                $name = $singular_name = 'Our Team';
            } else {
                $slug = $post_type_slug['slug'];
                $name = $post_type_slug['name'];
                $singular_name = $post_type_slug['singular_name'];
            }

            register_post_type($post_type,
                array(
                    'label' => __('Our Team','wolverine'),
                    'description' => __( 'Our Team Description', 'wolverine' ),
                    'labels' => array(
                        'name'					=> $name,
                        'singular_name' 		=>  $singular_name,
                        'menu_name'    			=> $name,
                        'parent_item_colon'  	=> __( 'Parent Item:', 'wolverine' ),
                        'all_items'          	=> sprintf(__('All %s' , 'wolverine' ),$name),
                        'view_item'          	=> __( 'View Item', 'wolverine' ),
                        'add_new_item'       	=> sprintf(__('Add New  %s' , 'wolverine' ),$name),
                        'add_new'            	=> __( 'Add New', 'wolverine' ),
                        'edit_item'          	=> __( 'Edit Item', 'wolverine' ),
                        'update_item'        	=> __( 'Update Item', 'wolverine' ),
                        'search_items'       	=> __( 'Search Item', 'wolverine' ),
                        'not_found'          	=> __( 'Not found', 'wolverine' ),
                        'not_found_in_trash' 	=> __( 'Not found in Trash', 'wolverine' ),
                    ),
                    'supports'    => array( 'title','revisions', 'thumbnail'),
                    'public'      => true,
                    'show_ui'     => true,
                    '_builtin'    => false,
                    'has_archive' => true,
                    'rewrite'     => array('slug' => $slug, 'with_front' => true),
                )
            );
            flush_rewrite_rules();
        }
        function addMenuChangeSlug()
        {
            add_submenu_page('edit.php?post_type=ourteam', 'Setting', 'Settings', 'edit_posts', wp_basename(__FILE__), array($this, 'initPageSettings'));
        }

        function initPageSettings()
        {
            $template_path = ABSPATH . 'wp-content/plugins/wolverine-framework/includes/shortcodes/posttype-settings/settings.php';
            if (file_exists($template_path))
                require_once $template_path;
        }
        function add_columns($columns)
        {
            unset(
            $columns['cb'],
            $columns['title'],
            $columns['date']
            );
            $cols = array_merge(array('cb' => ('')), $columns);
            $cols = array_merge($cols, array('title' => __('Name', 'wolverine')));
            $cols = array_merge($cols, array('job' => __('Job', 'wolverine')));
            $cols = array_merge($cols, array('thumbnail' => __('Picture', 'wolverine')));
            $cols = array_merge($cols, array('date' => __('Date', 'wolverine')));
            return $cols;
        }
        function set_columns_value($column, $post_id)
        {
            switch ($column) {
                case 'id':
                {
                    echo wp_kses_post($post_id);
                    break;
                }
                case 'job':
                {
                    echo get_post_meta($post_id, 'job', true);
                    break;
                }
                case 'thumbnail':
                {
                    echo get_the_post_thumbnail($post_id, 'thumbnail');
                    break;
                }
            }
        }
        function register_meta_boxes($meta_boxes)
        {
            $meta_boxes[] = array(
                'title' => __('Our Team Job', 'wolverine'),
                'pages' => array('ourteam'),
                'fields' => array(
                    array(
                        'name' => __('Job', 'wolverine'),
                        'id' => 'job',
                        'type' => 'text',
                    ),
                )
            );
            return $meta_boxes;
        }
        function ourteam_shortcode($atts){
	        /**
	         * Shortcode attributes
	         * @var $layout_style
	         * @var $item_amount
	         * @var $is_slider
	         * @var $column
	         * @var $category
	         * @var $el_class
	         * @var $css_animation
	         * @var $duration
	         * @var $delay
	         */
	        $atts = vc_map_get_attributes( 'wolverine_ourteam', $atts );
	        extract( $atts );
	        $g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            global $ourteam_metabox;
            global $meta;
            $args = array(
                'posts_per_page' => $item_amount,
                'post_type' => 'ourteam',
                'orderby' => 'date',
                'order' => 'ASC',
                'post_status' => 'publish'
            );
            if ( $category!='' ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'ourteam_category',
                        'field'    => 'slug',
                        'terms'    => explode(',',$category),
                        'operator' 		=> 'IN'
                    )
                );
            }
            $data = new WP_Query($args);
            ob_start();
            $class_col='col-lg-'.(12/esc_attr($column)).' col-md-'.(12/esc_attr($column)).' col-sm-6  col-xs-12';
	        if($layout_style=='style3')
	        {
		        $class_col='col-lg-'.(12/esc_attr($column)).' col-md-6 col-sm-12  col-xs-12';
	        }
            if ($data->have_posts()) :?>
            <div class="wolverine-ourteam <?php echo esc_attr($layout_style) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
                <div class="row">
                <?php if  ($is_slider) :
		            $data_carousel='"pagination":false, "autoPlay": true, "items":'.$column.',"itemsDesktop":[1199, '.$column.'],"itemsDesktopSmall":[980, '.$column.'],"itemsTablet":[768, 2]';
		            if($layout_style=='style3')
		            {
			            $data_carousel='"pagination":false, "autoPlay": true, "items":'.$column.',"itemsDesktop":[1199, 2],"itemsDesktopSmall":[980, 2],"itemsTablet":[768, 1]';
		            }
		            ?>
                    <div data-plugin-options='{<?php echo esc_attr($data_carousel) ?>}' class="owl-carousel">
	                <?php if($layout_style=='style3')
		            {
			            while ($data->have_posts()): $data->the_post();
			            $job = get_post_meta(get_the_ID(), 'job', true);
			            $img_id=get_post_thumbnail_id();
			            $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '370x528'  ) );
			            ?>
			            <div class="ourteam-item">
				            <?php echo wp_kses_post($img['thumbnail']);?>
				            <div class="ourteam-info">
					            <span class="ourteam-name"><?php echo get_the_title() ?></span>
					            <span class="ourteam-job"><?php echo esc_html($job) ?></span>
					            <i class="wicon icon-indians-icons-05"></i>
					            <ul class="ourteam-social">
						            <?php
						            $meta = get_post_meta(get_the_id(), $ourteam_metabox->get_the_id(), true);
						            foreach ($meta['ourteam'] as $col)
						            {
							            $socialName = isset($col['socialName'])?$col['socialName']:'';
							            $socialLink = isset($col['socialLink'])?$col['socialLink']:'';
							            $socialIcon = isset($col['socialIcon'])?$col['socialIcon']:'';
							            ?>
							            <li><a href="<?php echo esc_url($socialLink) ?>" title="<?php echo esc_url($socialName) ?>"><i class="<?php echo esc_attr($socialIcon) ?>"></i></a></li>
						            <?php
						            }
						            ?>
					            </ul>
				            </div>
			            </div>
		                <?php endwhile;
		            }
		            else
		            {
			            while ($data->have_posts()): $data->the_post();
			            $job = get_post_meta(get_the_ID(), 'job', true);
			            $img_id=get_post_thumbnail_id();
			            if($layout_style=='style1')
			            {
				            $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '370x249'  ) );
			            }
			            else
			            {
				            $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '370x470'  ) );
			            }
			            ?>
			            <div class="ourteam-item">
				            <div class="ourteam-avatar">
					            <?php echo wp_kses_post($img['thumbnail']);?>
					            <ul class="ourteam-social">
						            <?php
						            $meta = get_post_meta(get_the_id(), $ourteam_metabox->get_the_id(), true);
						            foreach ($meta['ourteam'] as $col)
						            {
							            $socialName = isset($col['socialName'])?$col['socialName']:'';
							            $socialLink = isset($col['socialLink'])?$col['socialLink']:'';
							            $socialIcon = isset($col['socialIcon'])?$col['socialIcon']:'';
							            ?>
							            <li><a href="<?php echo esc_url($socialLink) ?>" title="<?php echo esc_url($socialName) ?>"><i class="<?php echo esc_attr($socialIcon) ?>"></i></a></li>
						            <?php
						            }
						            ?>
					            </ul>
				            </div>
				            <div class="ourteam-info">
					            <span class="ourteam-name"><?php echo get_the_title() ?></span>
					            <span class="ourteam-job"><?php echo esc_html($job) ?></span>
				            </div>
			            </div>
		            <?php endwhile;
		            }
		            ?>
                    </div>
                <?php else:
		            if($layout_style=='style3')
		            {
			            while ($data->have_posts()): $data->the_post();
			            $job = get_post_meta(get_the_ID(), 'job', true);
			            $img_id=get_post_thumbnail_id();
			            $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '370x528'  ) );
			            ?>
		                <div class="<?php echo esc_attr($class_col); ?>">
				            <div class="ourteam-item">
					            <?php echo wp_kses_post($img['thumbnail']);?>
					            <div class="ourteam-info">
						            <span class="ourteam-name"><?php echo get_the_title() ?></span>
						            <span class="ourteam-job"><?php echo esc_html($job) ?></span>
						            <i class="wicon icon-indians-icons-05"></i>
						            <ul class="ourteam-social">
							            <?php
							            $meta = get_post_meta(get_the_id(), $ourteam_metabox->get_the_id(), true);
							            foreach ($meta['ourteam'] as $col)
							            {
								            $socialName = isset($col['socialName'])?$col['socialName']:'';
								            $socialLink = isset($col['socialLink'])?$col['socialLink']:'';
								            $socialIcon = isset($col['socialIcon'])?$col['socialIcon']:'';
								            ?>
								            <li><a href="<?php echo esc_url($socialLink) ?>" title="<?php echo esc_url($socialName) ?>"><i class="<?php echo esc_attr($socialIcon) ?>"></i></a></li>
							            <?php
							            }
							            ?>
						            </ul>
					            </div>
				            </div>
		                </div>
		                <?php endwhile;
		            }
	                else
	                {
		                while ($data->have_posts()): $data->the_post();
			                $job = get_post_meta(get_the_ID(), 'job', true);
			                $img_id=get_post_thumbnail_id();
			                if($layout_style=='style1')
			                {
				                $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '370x249'  ) );
			                }
			                else
			                {
				                $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '370x470'  ) );
			                }
			                ?>
			                <div class="<?php echo esc_attr($class_col); ?>">
				                <div class="ourteam-item margin-bottom-30">
					                <div class="ourteam-avatar">
						                <?php echo wp_kses_post($img['thumbnail']);?>
						                <ul class="ourteam-social">
							                <?php
							                $meta = get_post_meta(get_the_id(), $ourteam_metabox->get_the_id(), true);
							                foreach ($meta['ourteam'] as $col)
							                {
								                $socialName = isset($col['socialName'])?$col['socialName']:'';
								                $socialLink = isset($col['socialLink'])?$col['socialLink']:'';
								                $socialIcon = isset($col['socialIcon'])?$col['socialIcon']:'';
								                ?>
								                <li><a href="<?php echo esc_url($socialLink) ?>" title="<?php echo esc_url($socialName) ?>"><i class="<?php echo esc_attr($socialIcon) ?>"></i></a></li>
							                <?php
							                }
							                ?>
						                </ul>
					                </div>
					                <div class="ourteam-info">
						                <span class="ourteam-name"><?php echo get_the_title() ?></span>
						                <span class="ourteam-job"><?php echo esc_html($job) ?></span>
					                </div>
				                </div>
			                </div>
		                <?php endwhile;
	                }
                endif;?>
                </div>
            </div>
            <?php endif;
            wp_reset_postdata();
            $content = ob_get_clean();
            return $content;
        }
    }
    new g5plusFramework_Shortcode_Ourteam();
}