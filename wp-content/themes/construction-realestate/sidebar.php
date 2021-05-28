<?php
/**
 * The Sidebar containing the main widget areas.
 * @package Construction Realestate
 */
?>

<div id="sidebar">    
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
        <aside id="archives" role="complementary" aria-label="firstsidebar" class="widget">
            <h3 class="widget-title m-0"><?php esc_html_e( 'Archives', 'construction-realestate' ); ?></h3>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>
        <aside id="meta" role="complementary" aria-label="secondsidebar" class="widget">
            <h3 class="widget-title"><?php esc_html_e( 'Meta', 'construction-realestate' ); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
    <?php endif; // end sidebar widget area ?>  
</div>