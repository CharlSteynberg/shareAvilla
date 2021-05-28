<?php
/**
 * The plugin premium page.
 *
 * @link       https://shapedplugin.com/
 * @since      1.2.0
 * @package    Woo_Category_Slider
 * @subpackage Woo_Category_Slider/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class Woo_Category_Slider_Premium {

	/**
	 * Add SubMenu Page
	 */
	public function premium_page() {
		add_submenu_page( 'edit.php?post_type=sp_wcslider', __( 'Category Slider for WooCommerce Premium', 'woo-category-slider' ), __( 'Premium', 'woo-category-slider' ), 'manage_options', 'wcsp_premium', array( $this, 'premium_page_callback' ) );
	}

	/**
	 * Happy users.
	 *
	 * @param boolean $username
	 * @param array   $args
	 * @return void
	 */
	public function happy_users( $username = 'shapedplugin', $args = array() ) {
		if ( $username ) {
			$params = array(
				'timeout'   => 10,
				'sslverify' => false,
			);

			$raw = wp_remote_retrieve_body( wp_remote_get( 'http://wptally.com/api/' . $username, $params ) );
			$raw = json_decode( $raw, true );

			if ( array_key_exists( 'error', $raw ) ) {
				$data = array(
					'error' => $raw['error'],
				);
			} else {
				$data = $raw;
			}
		} else {
			$data = array(
				'error' => __( 'No data found!', 'woo-category-slider' ),
			);
		}

		return $data;
	}

	/**
	 * Premium Page Callback
	 */
	public function premium_page_callback() {
		wp_enqueue_style( 'woo-category-free-admin-premium', SP_WCS_URL . 'admin/css/premium-page.min.css', array(), SP_WCS_VERSION );
		wp_enqueue_style( 'woo-category-free-admin-premium-modal', SP_WCS_URL . 'admin/css/modal-video.min.css', array(), SP_WCS_VERSION );
		wp_enqueue_script( 'woo-category-free-admin-premium', SP_WCS_URL . 'admin/js/jquery-modal-video.min.js', array( 'jquery' ), SP_WCS_VERSION, true );
		?>
	<div class="sp-woo-cat-slider-premium-page">
		<!-- Banner section start -->
		<section class="sp-wcsp-banner">
			<div class="sp-wcsp-container">
				<div class="row">
					<div class="sp-wcsp-col-xl-6">
						<div class="sp-wcsp-banner-content">
							<h2 class="sp-wcsp-font-30 main-color sp-wcsp-font-weight-500"><?php _e( 'Upgrade To WooCommerce Category Slider Pro', 'woo-category-slider' ); ?></h2>
							<p class="sp-wcsp-mt-25 text-color-2 line-height-20 sp-wcsp-font-weight-400">
							<?php
							_e(
								'Filter and Display your WooCommerce products categories 
                                atheistically in strategic position to your shop or website and boost sales magically!',
								'woo-category-slider'
							);
							?>
							</p>
						</div>
						<div class="sp-wcsp-banner-button sp-wcsp-mt-40">
							<a class="sp-wcsp-btn sp-wcsp-btn-sky" href="https://shapedplugin.com/plugin/woocommerce-category-slider-pro/?ref=115" target="_blank">Upgrade To Pro Now</a>
							<a class="sp-wcsp-btn sp-wcsp-btn-border ml-16 sp-wcsp-mt-15" href="https://demo.shapedplugin.com/woocommerce-category-slider/" target="_blank">Live Demo</a>
						</div>
					</div>
					<div class="sp-wcsp-col-xl-6">
						<div class="sp-wcsp-banner-img">
							<img src="<?php echo SP_WCS_URL . 'admin/css/images/boost-sales-wcs.svg'; ?>" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Banner section End -->

		<!-- Count section Start -->
		<section class="sp-wcsp-count">
			<div class="sp-wcsp-container">
				<div class="sp-wcsp-count-area">
					<div class="count-item">
						<h3 class="sp-wcsp-font-24">
						<?php
						$plugin_data  = $this->happy_users();
						$plugin_names = array_values( $plugin_data['plugins'] );

						$active_installations = array_column( $plugin_names, 'installs', 'url' );
						echo esc_attr( $active_installations['http://wordpress.org/plugins/woo-category-slider-grid'] ) . '+';
						?>
						</h3>
						<span class="sp-wcsp-font-weight-400">Active Installations</span>
					</div>
					<div class="count-item">
						<h3 class="sp-wcsp-font-24">
						<?php
						$active_installations = array_column( $plugin_names, 'downloads', 'url' );
						echo esc_attr( $active_installations['http://wordpress.org/plugins/woo-category-slider-grid'] );
						?>
						</h3>
						<span class="sp-wcsp-font-weight-400">all time downloads</span>
					</div>
					<div class="count-item">
						<h3 class="sp-wcsp-font-24">
						<?php
						$active_installations = array_column( $plugin_names, 'rating', 'url' );
						echo esc_attr( $active_installations['http://wordpress.org/plugins/woo-category-slider-grid'] ) . '/5';
						?>
						</h3>
						<span class="sp-wcsp-font-weight-400">user reviews</span>
					</div>
				</div>
			</div>
		</section>
		<!-- Count section End -->

		<!-- Video Section Start -->
		<section class="sp-wcsp-video">
			<div class="sp-wcsp-container">
				<div class="section-title text-center">
					<h2 class="sp-wcsp-font-28">Boost your WooCommerce Store Sales</h2>
					<h4 class="sp-wcsp-font-16 sp-wcsp-mt-10 sp-wcsp-font-weight-400">Learn why WooCommerce Category Slider Pro is the best Category Showcase plugin.</h4>
				</div>
				<div class="video-area text-center">
					<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/learn-how-to-boost-sales.svg'; ?>" alt="">
					<div class="video-button">
						<a class="js-video-button" href="#" data-channel="youtube" data-video-url="//www.youtube.com/embed/m5y4LBC1-48">
							<span><i class="fa fa-play"></i></span>
						</a>
					</div>
				</div>
			</div>
		</section>
		<!-- Video Section End -->

		<!-- Features Section Start -->
		<section class="sp-wcsp-feature">
			<div class="sp-wcsp-container">
				<div class="section-title text-center">
					<h2 class="sp-wcsp-font-28">Amazing Pro Key Features</h2>
					<h4 class="sp-wcsp-font-16 sp-wcsp-mt-10 sp-wcsp-font-weight-400">Upgrade To Pro and can get access to our full suite of features. It matters for boosting sales!.</h4>
				</div>
				<div class="feature-wrapper">
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/1.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">Mobile Responsive & SEO Friendly</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">WooCommerce Category Slider Pro is fully mobile responsive & SEO-friendly plugin. You can control device-wise specific columns as you wish. It adapts to fit any screen size or mobile device well.</p>
							</div>
						</div>

						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="
								<?php echo SP_WCS_URL . 'admin/css/images/premium/wcs-icon.svg'; ?>
								" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">More Than Just Category Slider</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">Why only display WooCommerce Categories in a carousel Slider layout when you can filter and display categories in Grid or Block layout? And the best part, you can control over styling!</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="
								<?php echo SP_WCS_URL . 'admin/css/images/premium/custom.svg'; ?>
								" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">Customize Everything Easily</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">You will be able to make it look exactly how you want with layout and colors & typography settings! You have full control over styling to design your way. No coding skills required!</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/easy.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">Easily Find Offered Categories</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">WooCommerce Category Slider Pro lets your visitors find the category they are looking for without struggling and looking all over the store. This effectively boosts your conversion rate!</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/specific.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">Display Specific Categories with Child</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">You can display specific product categories with or without a child in a slider or grid view so that your potential customers can see them all. Put it in strategic spots of your store and boost sales!</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/child-cat.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">Display Child Categories</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">The plugin allows you to show the child or subcategories along with the parent. You can display the chid categories beside parent, below parent or child only with product count or not.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/slider-grid.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">Create Unlimited Category Showcases</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">Create as many beautiful sliders, grids, and blocks as you like across your WooCommerce store or site. This makes your store popular and you can achieve goals by selling more quickly!</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/layout.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">3+ Layouts (Slider, Grid, and Block)</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">The WooCommerce Category Slider Pro comes with 5 modern layouts to display your categories. The layout presets are fully customizable and can amazingly fit your store or site design.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/typography.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">950+ Google Fonts(Typography & Colors)</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">This is very important to be able to set fonts & colors to match your brand. WooCommerce Category Slider Pro supports 900+ Google fonts. You can enable/disable Google fonts loading.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/slider-control.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">20+ Slider Controls</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">The plugin comes with the following built-in slider controls, e.g. autoplay, speed, scroll speed, slide to scroll, pause on hover, loop, navigation, pagination, touch-swipe, auto height, etc.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/multisite.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">RTL, Multisite, and Multilingual Supported</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">
								WooCommerce Category Slider Pro is RTL, multisite, and multilingual ready. For Arabic, Hebrew, Persian, etc. languages, you can select the right-to-left option for slider direction, without writing any CSS.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/flat-icon.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">915+ Category Flat Icons</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">Choose from any of the 915+ category flat icon fonts to showcase your WooCommerce categories with amazing flat font icons. We’ve added two popular flat icons library in the Pro version.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/page-bilder.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">Page Builders & Countless Theme Compatibility</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">The plugin works smoothly with the popular themes and page builders plugins, e,g: Gutenberg, WPBakery, Elementor/Pro, Divi builder, BeaverBuilder, Fusion Builder, SiteOrgin, Themify Builder, etc.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/premium/support.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wcsp-font-18 sp-wcsp-font-weight-600">Fast Support and Regular Updates</h3>
								<p class="sp-wcsp-font-15 sp-wcsp-mt-15 sp-wcsp-line-height-24">Our dedicated expert support team is always ready to offer you world-class support and help when needed. We are continuously working to improve the plugin and release new versions!</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Features Section End -->

		<!-- Buy Section Start -->
		<section class="sp-wcsp-buy">
			<div class="sp-wcsp-container">
				<div class="row">
					<div class="sp-wcsp-col-xl-12">
						<div class="buy-content text-center">
							<h2 class="sp-wcsp-font-28">Join 
							<?php
							$install = 0;
							foreach ( $plugin_names as &$plugin_name ) {
								$install += $plugin_name['installs'];
							}
							echo esc_attr( $install + '15000' ) . '+';
							?>
							 Happy Users in 160+ Countries </h2>
							<p class="sp-wcsp-font-16 sp-wcsp-mt-25 sp-wcsp-line-height-22">98% of customers are happy with <b>ShapedPlugin's</b> products and support. <br>
								So it’s a great time to join them.</p>
							<a class="sp-wcsp-btn sp-wcsp-btn-buy sp-wcsp-mt-40" href="https://shapedplugin.com/plugin/woocommerce-category-slider-pro/?ref=115" target="_blank">Get Started for $39 Today!</a>
							<span>14 Days Money-back Guarantee! No Question Asked.</span>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Buy Section End -->

		<!-- Testimonial section start -->
		<div class="testimonial-wrapper">
		<section class="sp-wcsp-premium testimonial">
			<div class="row">
				<div class="col-lg-6">
					<div class="testimonial-area">
						<div class="testimonial-content">
							<p>Nice plugin and it does what it promises. Well written, good UI. Works like a charm! I’m very happy with the high quality pro plugin from ShapedPlugin. </p>
						</div>
						<div class="testimonial-info">
							<div class="img">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/Eeva-Lamminen.jpeg'; ?>" alt="">
							</div>
							<div class="info">
								<h3>Eeva Lamminen</h3>
								<p>WordPress Developer</p>
								<div class="star">
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="testimonial-area">
						<div class="testimonial-content">
							<p>Very Useful plugin! Good slider for displaying product categories. Useful and easy to use! I advise Category Slider for WooCommerce to everyone. Thank you!</p>
						</div>
						<div class="testimonial-info">
							<div class="img">
								<img src="<?php echo SP_WCS_URL . 'admin/css/images/Silperman.jpeg'; ?>" alt="">
							</div>
							<div class="info">
								<h3>Silperman</h3>
								<p>Web Designer</p>
								<div class="star">
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		</div>
		<!-- Testimonial section end -->
	</div>
	<!-- End premium page -->
		<?php
	}
}
