<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) die( '-1' );
// Include post types
global $pricingtable_metabox;
$pricingtable_metabox = new WPAlchemy_MetaBox(array
(
    'id' => 'wolverine_pricingtable_settings',
    'title' => __('Pricing Tables Settings', 'wolverine'),
    'template' => plugin_dir_path( __FILE__ ) . 'custom-field.php',
    'types' => array('pricingtable'),
    'autosave' => TRUE,
    'priority' => 'high',
    'context' => 'normal',
    'hide_editor' => TRUE
));
add_filter( 'wp_insert_post_data' , 'pricing_table_filter_post_data' , '99', 2 );
function pricing_table_filter_post_data( $data , $postarr ) {
    if ( 'pricingtable' != $data['post_type'] ) {
        return $data;
    }
    if(!empty($postarr['wolverine_pricingtable_settings']))
    {
        for	($i = 0; $i < count($postarr['wolverine_pricingtable_settings']['features']) ; $i++) {
            if (!empty($_POST['wolverine_pricingtable_settings']['features'][$i]['planfeatures'])) {
                $_POST['wolverine_pricingtable_settings']['features'][$i]['planfeatures'] = str_replace("\r\n","\n", $_POST['wolverine_pricingtable_settings']['features'][$i]['planfeatures']);
                $_POST['wolverine_pricingtable_settings']['features'][$i]['planfeatures'] = str_replace("\n","||", $_POST['wolverine_pricingtable_settings']['features'][$i]['planfeatures']);
            }
        }
    }
    return $data;
}
if(!class_exists('g5plusFramework_Shortcode_Pricingtable')){
    class g5plusFramework_Shortcode_Pricingtable{
        function __construct(){
            add_action('init', array($this, 'register_post_types'), 5);
            add_shortcode('wolverine_pricingtable', array($this, 'pricingtable_shortcode'));
            if (is_admin()) {
                add_action('admin_menu', array($this, 'addMenuChangeSlug'));
            }
        }
        function register_post_types()
        {
            $post_type = 'pricingtable';

            if ( post_type_exists($post_type) ) {
                return;
            }

            $post_type_slug = get_option('g5plus-wolverine-' . $post_type . '-config');
            if (!isset($post_type_slug) || !is_array($post_type_slug)) {
                $slug = 'pricingtable';
                $name = $singular_name = 'Pricing Table';
            } else {
                $slug = $post_type_slug['slug'];
                $name = $post_type_slug['name'];
                $singular_name = $post_type_slug['singular_name'];
            }

            register_post_type($post_type,
                array(
                    'label' => __('Pricing Table','wolverine'),
                    'description' => __( 'Pricing Table Description', 'wolverine' ),
                    'labels' => array(
                        'name'					=> $name,
                        'singular_name' 		=>  $singular_name,
                        'menu_name'    			=> $name,
                        'parent_item_colon'  	=> __( 'Parent Item:', 'wolverine' ),
                        'all_items'          	=> sprintf(__('All %s','wolverine'),$name),
                        'view_item'          	=> __( 'View Item', 'wolverine' ),
                        'add_new_item'       	=>  sprintf(__('Add New  %s' , 'wolverine' ),$name) ,
                        'add_new'            	=> __( 'Add New', 'wolverine' ),
                        'edit_item'          	=> __( 'Edit Item', 'wolverine' ),
                        'update_item'        	=> __( 'Update Item', 'wolverine' ),
                        'search_items'       	=> __( 'Search Item', 'wolverine' ),
                        'not_found'          	=> __( 'Not found', 'wolverine' ),
                        'not_found_in_trash' 	=> __( 'Not found in Trash', 'wolverine' ),
                    ),
                    'supports'    => array( 'title','revisions'),
                    'public'      => true,
                    'show_ui'     => true,
                    '_builtin'    => false,
                    'has_archive' => true,
                    'menu_icon' => 'dashicons-pricing-table',
                    'rewrite'     => array('slug' => $slug, 'with_front' => true),
                )
            );
            flush_rewrite_rules();
        }
        function addMenuChangeSlug()
        {
            add_submenu_page('edit.php?post_type=pricingtable', 'Setting', 'Settings', 'edit_posts', wp_basename(__FILE__), array($this, 'initPageSettings'));
        }

        function initPageSettings()
        {
            $template_path = ABSPATH . 'wp-content/plugins/wolverine-framework/includes/shortcodes/posttype-settings/settings.php';
            if (file_exists($template_path))
                require_once $template_path;
        }

        function pricing_table_features_to_html ($plan_features)
        {
            // the string to be returned
            $html = '';

            // explode string into a useable array
            $features = explode("||", $plan_features);

            //how many features does this column have?
            $this_columns_number_of_features = count($features);

            for ($i=0; $i<$this_columns_number_of_features; $i++) {
                $html .= '<li><span>' . str_replace(array("\n", "\r"), '', wp_kses_post($features[$i])) . '</span></li>';
            }

            return $html;
        }
        function pricingtable_shortcode($atts){
	        /**
	         * Shortcode attributes
	         * @var $layout_style
	         * @var $column
	         * @var $is_slider
	         * @var $post_name
	         * @var $el_class
	         * @var $css_animation
	         * @var $duration
	         * @var $delay
	         */
	        $atts = vc_map_get_attributes( 'wolverine_pricingtable', $atts );
	        extract( $atts );
	        $g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            global $pricingtable_metabox;
            global $meta;
            $pt_post = get_posts( array(
                'posts_per_page'   	=> 1,
                'name'      => $post_name,
                'post_type'      => 'pricingtable',
                'post_status'      	=> 'publish'
            ) );
            if(count($pt_post)<1)
            {
                return "";
            }
            $pt_post=$pt_post[0];
            $meta = get_post_meta($pt_post->ID, $pricingtable_metabox->get_the_id(), TRUE);
            ob_start();
            $class_col='col-md-'.(12/esc_attr($column)).' col-sm-6';?>
            <div class="wolverine-pricingtable <?php echo esc_attr($layout_style) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
                <?php if($layout_style=='style2'):?>
                <div class="row">
                <?php endif;?>
                    <?php if($is_slider=='yes'): $class_col=''; ?>
                    <div class="owl-carousel" data-plugin-options='{"items" : <?php echo esc_attr($column) ?>,"pagination":false, "autoPlay": true }'>
                    <?php endif;
                    foreach ($meta['features'] as $col)
                    {
                        $planname = isset($col['planname'])?$col['planname']:'';
                        $planprice = isset($col['planprice'])?$col['planprice']:'';
                        $planfeatures = isset($col['planfeatures'])?$col['planfeatures']:'';
                        $buttonurl = isset($col['buttonurl'])?$col['buttonurl']:'';
                        $buttontext = isset($col['buttontext'])?$col['buttontext']:'';
                        if(isset($col['feature'])) {
                            if ($col['feature'] == "featured") {
                                $feature = " w-pt-active";
                            } else {
                                $feature = '';
                            }
                        } else {
                            $feature = '';
                        }
                        ?>
                        <div class="<?php echo esc_attr($class_col) ?> w-pt-item <?php echo esc_attr($feature) ?>">
                            <div class="w-pt-content">
                                <div><span><?php echo esc_html($planname) ?></span></div>
                                <?php if($layout_style!='style1'):?>
                                <p><?php echo wp_kses_post($planprice) ?></p>
                                <?php endif;?>
                                <ul><?php echo $this->pricing_table_features_to_html($planfeatures) ?></ul>
                                <?php if($layout_style=='style1'):?>
                                <p><?php echo wp_kses_post($planprice) ?></p>
                                <a class="wolverine-button style1 button-2x" href="<?php echo esc_url($buttonurl) ?>" title="<?php echo esc_attr($buttontext) ?>"><?php echo esc_html($buttontext) ?></a>
                                <?php else:?>
                                <a class="wolverine-button style5 button-2x" href="<?php echo esc_url($buttonurl) ?>" title="<?php echo esc_attr($buttontext) ?>"><?php echo esc_html($buttontext) ?></a>
                                <?php endif;?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php if($is_slider=='yes'): ?>
                    </div>
                    <?php endif;?>
                <?php if($layout_style=='style2'):?>
                </div>
                <?php endif;?>
            </div>
            <?php $content = ob_get_clean();
            return $content;
        }
    }
    new g5plusFramework_Shortcode_Pricingtable();
}