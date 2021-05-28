<?php

add_action( 'admin_menu', 'construction_realestate_gettingstarted' );
function construction_realestate_gettingstarted() {    	
	add_theme_page( esc_html__('About Theme', 'construction-realestate'), esc_html__('About Theme', 'construction-realestate'), 'edit_theme_options', 'construction-realestate-guide-page', 'construction_realestate_guide');   
}

function construction_realestate_admin_theme_style() {
   wp_enqueue_style('construction-realestate-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/get_started_info.css');
}
add_action('admin_enqueue_scripts', 'construction_realestate_admin_theme_style');

function construction_realestate_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {?>
    <div class="notice notice-success is-dismissible getting_started">
		<div class="notice-content">
			<h2><?php esc_html_e( 'Thanks for installing Construction Realestate Lite, you rock!', 'construction-realestate' ) ?> </h2>
			<p><?php esc_html_e( 'Take benefit of a variety of features, functionalities, elements, and an exclusive set of customization options to build your own professional real estate business website. Please Click on the link below to know the theme setup information.', 'construction-realestate' ) ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=construction-realestate-guide-page' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Getting Started', 'construction-realestate' ); ?></a></p>
		</div>
	</div>
	<?php }
}
add_action('admin_notices', 'construction_realestate_notice');

/**
 * Theme Info Page
 */
function construction_realestate_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'construction-realestate' ); ?>

	<div class="wrap getting-started">
		<div class="getting-started__header">
			<div class="row">
				<div class="col-md-5 intro">
					<div class="pad-box">
						<h2><?php esc_html_e( 'Welcome to Construction Realestate', 'construction-realestate' ); ?></h2>
						<p>Version: <?php echo esc_html($theme['Version']);?></p>
						<span class="intro__version"><?php esc_html_e( 'Congratulations! You are about to use the most easy to use and flexible WordPress theme.', 'construction-realestate' ); ?>	
						</span>
						<div class="powered-by">
							<p><strong><?php esc_html_e( 'Theme created by Buy WP Templates', 'construction-realestate' ); ?></strong></p>
							<p>
								<img class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/theme-logo.png'); ?>"/>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="pro-links">
				    	<a href="<?php echo esc_url( CONSTRUCTION_REALESTATE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'construction-realestate'); ?></a>
						<a href="<?php echo esc_url( CONSTRUCTION_REALESTATE_BUY_PRO ); ?>"><?php esc_html_e('Buy Pro', 'construction-realestate'); ?></a>
						<a href="<?php echo esc_url( CONSTRUCTION_REALESTATE_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'construction-realestate'); ?></a>
					</div>
					<div class="install-plugins">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/construction-theme.png'); ?>" alt="" />
					</div>
				</div>
			</div>
			<h2 class="tg-docs-section intruction-title" id="section-4"><?php esc_html_e( '1). Setup Construction Theme', 'construction-realestate' ); ?></h2>
			<div class="row">
				<div class="theme-instruction-block col-md-7">
					<div class="pad-box">
	                    <p><?php esc_html_e( 'The exclusive Construction Realestate WordPress Theme offers you instant answers for your online activities that are related to your building industry. This is an ideal solution for real estate agents, real estate brokers, builders, woodworkers, contractors, inventors, interior designers, architects, plumbers, painters, or anybody who is interested in building construction business websites.This theme has been crafted carefully keeping in mind the latest web design standards. It offers a dynamic customizer with multiple theme options, to bring out the design of your website as per your wants. This minimal WordPress theme is built on Bootstrap that makes it highly responsive and cross-browser compatible. Being a mobile-friendly theme, it gives a cutting-edge performance on every screen size, and an advanced set of customization options to create your own professional real estate business site.', 'construction-realestate' ); ?><p><br>
						<ol>
							<li><?php esc_html_e( 'Start','construction-realestate'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','construction-realestate'); ?></a> <?php esc_html_e( 'your website.','construction-realestate'); ?></li>
							<li><?php esc_html_e( 'Construction Realestate','construction-realestate'); ?> <a target="_blank" href="<?php echo esc_url( CONSTRUCTION_REALESTATE_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation','construction-realestate'); ?></a></li>
						</ol>
                    </div>
              	</div>
				<div class="col-md-5">
					<div class="pad-box">
              			<img class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/screenshot.png'); ?>"/>
              		 </div> 
              	</div>
            </div>
			<div class="col-md-12 text-block">
					<h2 class="dashboard-install-title"><?php esc_html_e( '2.) Premium Theme Information.','construction-realestate'); ?></h2>
					<div class="row">
						<div class="col-md-7">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/Resize.png'); ?>" alt="">
							<div class="pad-box">
								<h3><?php esc_html_e( 'Pro Theme Description','construction-realestate'); ?></h3>
	                    		<p class="pad-box-p"><?php esc_html_e( 'This property Wp theme is unlike anything you have seen on the webspace, it has been made on the useful bootstrap 4 that ensures responsiveness. No stones were left unturned while the theme was designed and made. We rigorously looked into the themes functionalities and booted any errors and problems that were discovered. It has been put to scrutiny umpteen times so that a utopian real estate template can be created and served on a silver platter. Your money will not only be taken as just an investment with the purchase of our theme. Our theme has the power to reap recurring benefits and pay you back in the foreseeable future. The mesmerizing theme has gorgeous sections strewn across the entire template like the banner head with a helpful call to action button. The premium theme does not halt at that, it also comes with exclusive features that are limited to them. Not to forget the long list of features and beneficial customizer options that can empower you to take control of your website and customize it as per your wishes. This state of the art theme with clean and secure codes takes the security of your web pages very seriously. So what is the wait, hop on and become a part of our budding community of WordPress templates and show the world what you got.', 'construction-realestate' ); ?><p>
	                    	</div>
						</div>
						<div class="col-md-5 install-plugin-right">
							<div class="pad-box">								
								<h3><?php esc_html_e( 'Pro Theme Features','construction-realestate'); ?></h3>
								<div class="dashboard-install-benefit">
									<ul>
										<li><?php esc_html_e( 'Property listing','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Agents list','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Multiple image feature for each property with slider.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Meta fields to list down the features of each property.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Inquiry form for each property..','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'All Property listing using shortcode.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Property listing by Category using shortcode.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Agents list shortcode.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Testimonial listing.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Testimonial shortcode.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Social icons widget.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Latest post with the image widget.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Search for properties.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Live customize editor for the About US section.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Font Awesome integrated.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Advanced Color options and color pallets.','construction-realestate'); ?></li>
										<li><?php esc_html_e( '100+ Font Family Options.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Enable-Disable options on All sections.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Well sanitized as per WordPress standards.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Allow to set site title, tagline, logo.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Sticky post & Comment threads.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Left and Right Sidebar.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Customizable Home Page.','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Footer Widgets & Editor style','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Gallery & Banner functionality','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Multiple inner page templates','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Full-width Template','construction-realestate'); ?></li>
										<li><?php esc_html_e( 'Custom Menu, Colors Editor','construction-realestate'); ?></li>
									</ul>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
		<div class="dashboard__blocks">
			<div class="row">
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Get Support','construction-realestate'); ?></h3>
					<ol>
						<li><a target="_blank" href="<?php echo esc_url( CONSTRUCTION_REALESTATE_FREE_SUPPORT ); ?>"><?php esc_html_e( 'Free Theme Support','construction-realestate'); ?></a></li>
						<li><a target="_blank" href="<?php echo esc_url( CONSTRUCTION_REALESTATE_PRO_SUPPORT ); ?>"><?php esc_html_e( 'Premium Theme Support','construction-realestate'); ?></a></li>
					</ol>
				</div>

				<div class="col-md-3">
					<h3><?php esc_html_e( 'Getting Started','construction-realestate'); ?></h3>
					<ol>
						<li><?php esc_html_e( 'Start','construction-realestate'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','construction-realestate'); ?></a> <?php esc_html_e( 'your website.','construction-realestate'); ?></li>
					</ol>
				</div>
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Help Docs','construction-realestate'); ?></h3>
					<ol>
						<li><a target="_blank" href="<?php echo esc_url( CONSTRUCTION_REALESTATE_FREE_DOC ); ?>"><?php esc_html_e( 'Free Theme Documentation','construction-realestate'); ?></a></li>
						<li><a target="_blank" href="<?php echo esc_url( CONSTRUCTION_REALESTATE_PRO_DOC ); ?>"><?php esc_html_e( 'Premium Theme Documentation','construction-realestate'); ?></a></li>
					</ol>
				</div>
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Buy Premium','construction-realestate'); ?></h3>
					<ol>
						<a href="<?php echo esc_url( CONSTRUCTION_REALESTATE_BUY_PRO ); ?>"><?php esc_html_e('Buy Pro', 'construction-realestate'); ?></a>
					</ol>
				</div>
			</div>
		</div>
	</div>

<?php }?>