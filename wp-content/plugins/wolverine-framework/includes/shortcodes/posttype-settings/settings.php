<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/1/15
 * Time: 4:35 PM
 */

if (!current_user_can('edit_posts'))
{
    wp_die( __('You do not have sufficient permissions to access this page.', 'wolverine') );
}

$screen = get_current_screen();
$post_type = $screen->post_type;
if(!isset($post_type) || $post_type==''){
    if(isset( $_REQUEST['post_type'] )){
        $post_type = sanitize_key( $_REQUEST['post_type'] );
    }
}

$message = '';
$message_class='updated';

$post_type_data = get_post_type_object($post_type);
$post_type_slug = $post_type_data->rewrite['slug'];
$post_type_name = $post_type_data->labels->name;

$taxonomy =  get_object_taxonomies($post_type);
$taxonomy_name = $taxonomy_slug = '';

if(isset($taxonomy)&& is_array($taxonomy) && count($taxonomy)>0){
    $taxonomy_objects = get_object_taxonomies($post_type, 'objects');
    $taxonomy_slug = $taxonomy_objects[$taxonomy[0]]->rewrite['slug'];
    $taxonomy_name = $taxonomy_objects[$taxonomy[0]]->labels->name;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[ $post_type.'-slug' ])){


    if($_POST[ $post_type.'-slug' ]!='' || $_POST['category-'. $post_type.'-slug' ]!=''){

        $is_match_slug = preg_match_all("/[$&* #@%^!~+?]/", $_POST[ $post_type.'-slug' ], $output_reg);
        $is_match_taxonomy_slug = true;
        if(isset($_POST['category-'. $post_type.'-slug' ]))
            $is_match_taxonomy_slug = preg_match_all("/[$&* #@%^!~+?]/", $_POST['category-'. $post_type.'-slug' ], $output_reg);

        $config = array(
            'slug' => $post_type_slug,
            'name' => $post_type_name,
            'singular_name' => $post_type_name,
            'taxonomy_slug' => $taxonomy_slug,
            'taxonomy_name' => $taxonomy_name
        );

        if(!$is_match_slug){
            $post_type_slug = $_POST[ $post_type.'-slug' ];
            if($_POST[ $post_type.'-name' ] !='')
                $post_type_name = $_POST[ $post_type.'-name' ];

            $config['slug'] = $post_type_slug;
            $config['name'] = $post_type_name;
            $config['singular_name'] = $post_type_name;

        }

        if(!$is_match_taxonomy_slug){
            $taxonomy_slug = $_POST[ 'category-'. $post_type.'-slug'];
            if($_POST[ 'category-'. $post_type.'-name' ] !='')
                $taxonomy_name = $_POST[ 'category-'. $post_type.'-name' ];

            $config['taxonomy_slug'] = $taxonomy_slug;
            $config['taxonomy_name'] = $taxonomy_name;
        }

        if(!$is_match_slug || !$is_match_taxonomy_slug){
            update_option('g5plus-wolverine-'.$post_type.'-config',$config);
            $message = 'New slug has been update.';
            flush_rewrite_rules();
        }else{
            $message = 'Value not allowed to container special characters ($&* #@%^!~+?) and space.';
            $message_class = 'error';
        }
    }else{
        $message = 'Input value to new slug and name.';
        $message_class = 'error';
    }
}

if(isset($message) && $message!=''){
    ?>
    <div id="message" class="<?php echo esc_attr($message_class)?>">
        <p><?php echo esc_html($message) ?> </p>
    </div>
<?php }

?>
<style type="text/css">
    .page-post-type-setting{
        background-color: #fff;
        margin-left: 15px;
        padding: 20px;
    }
    .page-post-type-setting ul{
        display: inline-block;
    }
    .page-post-type-setting ul li.title{
        float: left;
        width: 20%;
    }
    .page-post-type-setting ul li.value{
        float: left;
        width: 80%;
    }
</style>
<form name="frmChangePostTypeSlug" method="post" action="">
    <div class="page-post-type-setting">
        <h3>Change Slug</h3>
        <ul>
            <li class="title">Current slug post type : </li>
            <li class="value"><?php echo esc_attr($post_type_slug) ?> &nbsp;</li>
            <li class="title">New slug post type: </li>
            <li class="value"><input type="text" name="<?php echo esc_attr($post_type.'-slug') ?>"/></li>

            <li class="title">Current name post type : </li>
            <li class="value"><?php echo esc_attr($post_type_name) ?> &nbsp;</li>
            <li class="title">New name post type : </li>
            <li class="value"><input type="text" name="<?php echo esc_attr($post_type.'-name') ?>"/></li>

            <?php if($taxonomy_slug!=''){ ?>
                <li class="title">Current slug post type : </li>
                <li class="value"><?php echo esc_attr($taxonomy_slug) ?> &nbsp;</li>
                <li class="title">New slug post type: </li>
                <li class="value"><input type="text" name="<?php echo esc_attr('category-'.$post_type.'-slug') ?>"/></li>

                <li class="title">Current name category : </li>
                <li class="value"><?php echo esc_attr($taxonomy_name) ?> &nbsp;</li>
                <li class="title">New name category : </li>
                <li class="value"><input type="text" name="<?php echo esc_attr('category-'.$post_type.'-name') ?>"/></li>
            <?php } ?>

            <li class="title"></li>
            <li class="value"><input class="button button-large button-primary" type="submit" value="Save Changes"/></li>
        </ul>
    </div>
</form>
