<?php
get_header();
$opt_title_404 = g5plus_get_option('title_404',esc_html__('Error 404 - not found','wolverine'));
$opt_subtitle_404 = g5plus_get_option('subtitle_404');
$opt_copyright_404 = g5plus_get_option('copyright_404',esc_html__('© 2015 WOLVERINE TEMPLATE. DESIGNED BY G5THEME','wolverine') );
$opt_go_back_404 = g5plus_get_option('go_back_404',esc_html__('BACK TO HOME','wolverine'));
do_action('g5plus_before_page');
?>

<div class="page404">
    <div class="container content-wrap">
        <h2><?php echo wp_kses_post($opt_title_404); ?></h2>
        <h4  class="description other-font"><?php echo wp_kses_post($opt_subtitle_404); ?></h4>
        <div class="return primary-color secondary-font">
            <?php
                $go_back_link = g5plus_get_option('go_back_url_404');
                if($go_back_link ==='')
                    $go_back_link = get_home_url();
            ?>
            <a href="<?php echo esc_url($go_back_link) ?>"><?php echo wp_kses_post($opt_go_back_404); ?></a>
        </div>
    </div>
    <div class="copyright secondary-font">
        <?php echo wp_kses_post($opt_copyright_404); ?>
    </div>
</div>
<?php wp_footer(); ?>


