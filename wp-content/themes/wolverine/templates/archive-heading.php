<?php
$prefix = 'g5plus_';
$portfolio_post_type = 'portfolio';

$show_page_title = g5plus_get_option('show_archive_title','1');

$on_front = get_option('show_on_front');
$page_sub_title = strip_tags(term_description());
$page_title = '';

$post_types =  get_post_type();
$cat = get_queried_object();

if (!have_posts()) {
    $page_title = __("Nothing Found", 'wolverine');
} elseif (is_home()) {
    if (($on_front == 'page' && get_queried_object_id() == get_post(get_option('page_for_posts'))->ID) || ($on_front == 'posts')) {
        $page_title = __("Blog", 'wolverine');
    } else {
        $page_title = '';
    }
} elseif (is_category()) {
    $page_title = single_cat_title('', false);
} elseif (is_tag()) {
    $page_title = single_tag_title(__("Tags: ", 'wolverine'), false);
} elseif (is_author()) {
    $page_title = sprintf(__('Author: %s', 'wolverine'), get_the_author());
} elseif (is_day()) {
    $page_title = sprintf(__('Daily Archives: %s', 'wolverine'), get_the_date());
} elseif (is_month()) {
    $page_title = sprintf(__('Monthly Archives: %s', 'wolverine'), get_the_date(_x('F Y', 'monthly archives date format', 'wolverine')));
} elseif (is_year()) {
    $page_title = sprintf(__('Yearly Archives: %s', 'wolverine'), get_the_date(_x('Y', 'yearly archives date format', 'wolverine')));
} elseif (is_search()) {
    $page_title = sprintf(__('Search Results for: %s', 'wolverine'), get_search_query());
} elseif (is_tax('post_format', 'post-format-aside')) {
    $page_title = __('Asides', 'wolverine');
} elseif (is_tax('post_format', 'post-format-gallery')) {
    $page_title = __('Galleries', 'wolverine');
} elseif (is_tax('post_format', 'post-format-image')) {
    $page_title = __('Images', 'wolverine');
} elseif (is_tax('post_format', 'post-format-video')) {
    $page_title = __('Videos', 'wolverine');
} elseif (is_tax('post_format', 'post-format-quote')) {
    $page_title = __('Quotes', 'wolverine');
} elseif (is_tax('post_format', 'post-format-link')) {
    $page_title = __('Links', 'wolverine');
} elseif (is_tax('post_format', 'post-format-status')) {
    $page_title = __('Statuses', 'wolverine');
} elseif (is_tax('post_format', 'post-format-audio')) {
    $page_title = __('Audios', 'wolverine');
} elseif (is_tax('post_format', 'post-format-chat')) {
    $page_title = __("Chats", 'wolverine');
}elseif(isset($post_types) && $post_types== $portfolio_post_type){
    if(isset($cat) && property_exists($cat,'labels')){
        $page_title = $cat->labels->name;
    }
}else {
    $page_title = __("Archives", 'wolverine');
}


//archive
$page_title_bg_image = '';
$page_title_height = '';

if ($cat && property_exists( $cat, 'term_id' )) {
    $page_title_bg_image = g5plus_get_tax_meta($cat->term_id,$prefix.'page_title_background');
    $page_title_height = g5plus_get_tax_meta($cat->term_id,$prefix.'page_title_height');
}
if(isset($post_types) && $post_types== $portfolio_post_type){
    $page_title_bg_image = g5plus_get_option('portfolio_archive_title_bg_image',array(
	    'url' => THEME_URL . 'assets/images/bg-page-title.jpg'
    ));
}


if(!$page_title_bg_image || ($page_title_bg_image === '')) {
    $page_title_bg_image = g5plus_get_option('archive_title_bg_image',array(
	    'url' => THEME_URL . 'assets/images/bg-page-title.jpg'
    ));
}


if (is_array($page_title_bg_image) && isset($page_title_bg_image['url'])) {
    $page_title_bg_image_url = $page_title_bg_image['url'];
}

$breadcrumbs_in_page_title = isset($_GET['breadcrumbs']) ? $_GET['breadcrumbs'] : '';
if (!in_array($breadcrumbs_in_page_title, array('1','0'))) {
    $breadcrumbs_in_page_title = g5plus_get_option('breadcrumbs_in_archive_title','1');
}

if(isset($post_types) && $post_types== $portfolio_post_type){
    $breadcrumbs_in_page_title = g5plus_get_option('breadcrumbs_in_portfolio_archive','0');
}


$class = array();
$class[] = 'page-title-wrap archive-title-height';

$custom_styles = array();

if ($page_title_bg_image_url != '') {
    $class[] = 'page-title-wrap-bg';
    $custom_styles[] = 'background-image: url(' . $page_title_bg_image_url . ');';
}

if ( ($page_title_height != '') && ($page_title_height > 0)) {
    $custom_styles[] = 'height:' . $page_title_height . 'px';
}



$custom_style= '';
if ($custom_styles) {
    $custom_style = 'style="'. join(';',$custom_styles).'"';
}


$page_title_parallax = g5plus_get_option('archive_title_parallax','0');

if(isset($post_types) && $post_types== $portfolio_post_type){
    $page_title_parallax = g5plus_get_option('portfolio_archive_title_parallax','0');
}

if (!empty($page_title_bg_image_url) && ($page_title_parallax == '1')) {
    $custom_style.= ' data-stellar-background-ratio="0.5"';
    $class[] = 'page-title-parallax';
}

$page_title_text_align = g5plus_get_option('archive_title_text_align','left');

if(isset($post_types) && $post_types== $portfolio_post_type){
    $page_title_text_align = g5plus_get_option('portfolio_archive_title_text_align','left');
}

if (!isset($page_title_text_align) || empty($page_title_text_align)) {
    $page_title_text_align = 'left';
}

$class[] = 'page-title-' . $page_title_text_align;

$class_name = join(' ', $class);
?>

<?php if ($show_page_title == 1) : ?>
<section class="<?php echo esc_attr($class_name) ?>" <?php echo wp_kses_post($custom_style); ?>>
    <div class="page-title-overlay"></div>
    <div class="container">
        <div class="page-title-inner block-center">
            <div class="block-center-inner">
                <h1><?php echo esc_html($page_title); ?></h1>
                <?php if ($page_sub_title != '') : ?>
                    <span class="page-sub-title"><?php echo esc_html($page_sub_title) ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if($breadcrumbs_in_page_title == 1) : ?>
    <section class="breadcrumb-wrap">
        <div class="container">
            <?php g5plus_the_breadcrumb(); ?>
        </div>
    </section>
<?php endif; ?>
