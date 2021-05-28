<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/20/15
 * Time: 4:53 PM
 */
add_action("wp_ajax_nopriv_g5plusframework_gallery_load_by_category", "g5plusframework_gallery_load_by_category");
add_action("wp_ajax_g5plusframework_gallery_load_by_category", "g5plusframework_gallery_load_by_category");
function g5plusframework_gallery_load_by_category()
{
    $current_page = $_REQUEST['current_page'];
    $dataSource =  $_REQUEST['data_source'];
    $show_paging = $_REQUEST['data_show_paging'];
    $galleryIds =  $_REQUEST['galleryIds'];
    $posts_per_page = $_REQUEST['postsPerPage'];
    $layout_type = $_REQUEST['layoutType'];
    $column = $_REQUEST['columns'];
    $padding = $_REQUEST['colPadding'];
    $category = $_REQUEST['category'];
    $order = $_REQUEST['order'];
    $short_code = sprintf('[g5plusframework_gallery category="%s" column="%s" item="%s" show_pagging="%s" padding="%s" current_page="%s" order="%s" data_source="%s" gallery_ids = "%s" ajax_load="%s" ]', $category, $column,$posts_per_page, $show_paging,$padding, $current_page, $order, $dataSource, $galleryIds, 1);
    echo do_shortcode($short_code);
    die();
}
