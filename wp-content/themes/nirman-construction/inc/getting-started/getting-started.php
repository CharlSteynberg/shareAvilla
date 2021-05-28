<?php
//about theme info
add_action( 'admin_menu', 'nirman_construction_gettingstarted' );
function nirman_construction_gettingstarted() {    	
	add_theme_page( esc_html__('About Theme', 'nirman-construction'), esc_html__('About Theme', 'nirman-construction'), 'edit_theme_options', 'nirman_construction_guide', 'nirman_construction_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function nirman_construction_admin_theme_style() {
   wp_enqueue_style('custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getting-started/getting-started.css');
}
add_action('admin_enqueue_scripts', 'nirman_construction_admin_theme_style');

//guidline for about theme
function nirman_construction_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'nirman-construction' );

?>

<div class="wrapper-info">
	<div class="col-left">
		<div class="intro">
			<h3><?php esc_html_e( 'Welcome to Nirman Construction WordPress Theme', 'nirman-construction' ); ?> <span>Version: <?php echo esc_html($theme['Version']);?></span></h3>
		</div>
		<div class="started">
			<hr>
			<div class="free-doc">
				<div class="lz-4">
					<h4><?php esc_html_e( 'Start Customizing', 'nirman-construction' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Go to', 'nirman-construction' ); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizer', 'nirman-construction' ); ?> </a> <?php esc_html_e( 'and start customizing your website', 'nirman-construction' ); ?></span>
					</ul>
				</div>
				<div class="lz-4">
					<h4><?php esc_html_e( 'Support', 'nirman-construction' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Send your query to our', 'nirman-construction' ); ?> <a href="<?php echo esc_url( NIRMAN_CONSTUCTION_SUPPORT ); ?>" target="_blank"> <?php esc_html_e( 'Support', 'nirman-construction' ); ?></a></span>
					</ul>
				</div>
			</div>
			<p><?php esc_html_e( 'Nirman Construction is a bold, powerful, resourceful and eye-catching construction WordPress theme to fully utilize the online space to display your work and services in the most convincing way. The theme is best suited for construction business, contractors, builders, architectural firms, renovation and repairing services, property dealers, building material trader, infrastructure companies, plumbing and roofing services and all such businesses. It gives ample number of layout options and header and footer styles to make your website stand out among competitors. This construction WordPress theme is fully responsive, cross-browser compatible, translation ready, SEO friendly and retina ready. Its colour palette has a spectrum of colours to choose the one that represents your brand. With compatibility to the latest WordPress 5.0 version, various customization options are available to easily tweak website without any previous coding knowledge. The gallery has beautiful layouts to attract visitors to see it at least once. Nirman Construction supports various post formats like text, gallery, image, video etc. It has all the important sections pre-built which makes this theme suitable to be used for multiple purposes like real estate firms, interior designing, civil engineering work and many other types of businesses. Promote your services through so many social media icons included in the theme.', 'nirman-construction')?></p>
			<hr>			
			<div class="col-left-inner">
				<h3><?php esc_html_e( 'Get started with Free Nirman Construction Theme', 'nirman-construction' ); ?></h3>
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/customizer-image.png" alt="" />
			</div>
		</div>
	</div>
	<div class="col-right">
		<div class="col-left-area">
			<h3><?php esc_html_e('Premium Theme Information', 'nirman-construction'); ?></h3>
			<hr>
		</div>
		<div class="centerbold">
			<a href="<?php echo esc_url( NIRMAN_CONSTUCTION_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'nirman-construction'); ?></a>
			<a href="<?php echo esc_url( NIRMAN_CONSTUCTION_BUY_NOW ); ?>"><?php esc_html_e('Buy Pro', 'nirman-construction'); ?></a>
			<a href="<?php echo esc_url( NIRMAN_CONSTUCTION_PRO_DOCS ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'nirman-construction'); ?></a>
			<hr class="secondhr">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/nirman-constructions.jpg" alt="" />
		</div>
		<h3><?php esc_html_e( 'PREMIUM THEME FEATURES', 'nirman-construction'); ?></h3>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon01.png" alt="" />
			<h4><?php esc_html_e( 'Banner Slider', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon02.png" alt="" />
			<h4><?php esc_html_e( 'Theme Options', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon03.png" alt="" />
			<h4><?php esc_html_e( 'Custom Innerpage Banner', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon04.png" alt="" />
			<h4><?php esc_html_e( 'Custom Colors and Images', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon05.png" alt="" />
			<h4><?php esc_html_e( 'Fully Responsive', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon06.png" alt="" />
			<h4><?php esc_html_e( 'Hide/Show Sections', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon07.png" alt="" />
			<h4><?php esc_html_e( 'Woocommerce Support', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon08.png" alt="" />
			<h4><?php esc_html_e( 'Limit to display number of Posts', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon09.png" alt="" />
			<h4><?php esc_html_e( 'Multiple Page Templates', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon10.png" alt="" />
			<h4><?php esc_html_e( 'Custom Read More link', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon11.png" alt="" />
			<h4><?php esc_html_e( 'Code written with WordPress standard', 'nirman-construction'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon12.png" alt="" />
			<h4><?php esc_html_e( '100% Multi language', 'nirman-construction'); ?></h4>
		</div>
	</div>
</div>
<?php } ?>