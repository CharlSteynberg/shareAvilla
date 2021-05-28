<?php
/**
 * The template for displaying the footer.
 * @package Construction Realestate
 */
?>
<?php if( get_theme_mod( 'construction_realestate_hide_show_scroll',true) != '' || get_theme_mod( 'construction_realestate_display_scrolltop', true) != '') { ?>
    <?php $construction_realestate_theme_lay = get_theme_mod( 'construction_realestate_footer_options','Right');
        if($construction_realestate_theme_lay == 'Left align'){ ?>
            <a href="#" id="scrollbutton" class="left"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_back_to_top_icon','fas fa-long-arrow-alt-up')); ?> py-4 px-3 rounded-circle"></i><span class="screen-reader-text"><?php esc_html_e( 'Back to Top', 'construction-realestate' ); ?></span></a>
        <?php }else if($construction_realestate_theme_lay == 'Center align'){ ?>
            <a href="#" id="scrollbutton" class="center"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_back_to_top_icon','fas fa-long-arrow-alt-up')); ?> text-center py-4 px-3 rounded-circle"></i><span class="screen-reader-text"><?php esc_html_e( 'Back to Top', 'construction-realestate' ); ?></span></a>
        <?php }else{ ?>
            <a href="#" id="scrollbutton"><i class="<?php echo esc_attr(get_theme_mod('construction_realestate_back_to_top_icon','fas fa-long-arrow-alt-up')); ?> py-4 px-3 rounded-circle"></i><span class="screen-reader-text"><?php esc_html_e( 'Back to Top', 'construction-realestate' ); ?></span></a>
    <?php }?>
<?php }?>
<footer role="contentinfo">
    <?php 
        $construction_realestate_widget_areas = get_theme_mod('footer_widget_areas', '4');
        if ($construction_realestate_widget_areas == '3') {
            $cols = 'col-md-4';
        } elseif ($construction_realestate_widget_areas == '4') {
            $cols = 'col-md-3';
        } elseif ($construction_realestate_widget_areas == '2') {
            $cols = 'col-md-6';
        } else {
            $cols = 'col-md-12';
        }
    ?>
    <aside id="sidebar-footer" class="footer-wp" role="complementary">
        <div class="container">
            <div class="row">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="sidebar-column <?php echo ( $cols ); ?>">
                        <?php dynamic_sidebar( 'footer-1'); ?>
                    </div>
                <?php endif; ?> 
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div class="sidebar-column <?php echo ( $cols ); ?>">
                        <?php dynamic_sidebar( 'footer-2'); ?>
                    </div>
                <?php endif; ?> 
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <div class="sidebar-column <?php echo ( $cols ); ?>">
                        <?php dynamic_sidebar( 'footer-3'); ?>
                    </div>
                <?php endif; ?> 
                <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                    <div class="sidebar-column <?php echo ( $cols ); ?>">
                        <?php dynamic_sidebar( 'footer-4'); ?>
                    </div>
                <?php endif; ?>
            </div> 
        </div>  
    </aside>
	<div class="copyright-wrapper text-center py-3 px-0">
        <div class="container">
            <p class="m-0"><?php construction_realestate_credit(); ?> <?php echo esc_html(get_theme_mod('construction_realestate_footer_copy',__('By Buywptemplate','construction-realestate'))); ?></p>
        </div>
        <div class="clear"></div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>