<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/20/15
 * Time: 4:53 PM
 */
add_action("wp_ajax_nopriv_g5plusframework_food_load_by_category", "g5plusframework_food_load_by_category");
add_action("wp_ajax_g5plusframework_food_load_by_category", "g5plusframework_food_load_by_category");
function g5plusframework_food_load_by_category()
{
    $current_page = $_REQUEST['current_page'];
    $overlay_style = $_REQUEST['overlay_style'];
    $dataSource =  $_REQUEST['data_source'];
    $show_paging = $_REQUEST['data_show_paging'];
    $foodIds =  $_REQUEST['foodIds'];
    $posts_per_page = $_REQUEST['postsPerPage'];
    $layout_type = $_REQUEST['layoutType'];
    $column = $_REQUEST['columns'];
    $padding = $_REQUEST['colPadding'];
    $category = $_REQUEST['category'];
    $order = $_REQUEST['order'];
    $short_code = sprintf('[g5plusframework_food category="%s" column="%s" item="%s" show_pagging="%s" layout_type="%s" padding="%s" current_page="%s" order="%s" data_source="%s" food_ids = "%s" ajax_load="%s" overlay_style="%s"]', $category, $column,$posts_per_page, $show_paging,$layout_type, $padding, $current_page, $order, $dataSource, $foodIds, 1, $overlay_style);
    echo do_shortcode($short_code);
    die();
}
