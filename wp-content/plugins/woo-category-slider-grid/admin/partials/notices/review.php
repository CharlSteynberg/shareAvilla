<?php
/**
 * The review admin notice.
 *
 * @since        1.2.1
 *
 * @package    Woo_Category_Slider
 * @subpackage Woo_Category_Slider/admin/partials/notices
 * @author     ShapedPlugin<support@shapedplugin.com>
 */
class Woo_Category_Slider_Review {

	public function __construct() {
		add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
		add_action( 'wp_ajax_sp-woocatslider-never-show-review-notice', array( $this, 'dismiss_review_notice' ) );
	}

	/**
	 * Display admin notice.
	 *
	 * @return void
	 */
	public function display_admin_notice() {
		// Show only to Admins.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Variable default value.
		$review = get_option( 'sp_woo_category_slider_review_notice_dismiss' );
		$time   = time();
		$load   = false;

		if ( ! $review ) {
			$review = array(
				'time'      => $time,
				'dismissed' => false,
			);
			add_option( 'sp_woo_category_slider_review_notice_dismiss', $review );
		} else {
			// Check if it has been dismissed or not.
			if ( ( isset( $review['dismissed'] ) && ! $review['dismissed'] ) && ( isset( $review['time'] ) && ( ( $review['time'] + ( DAY_IN_SECONDS * 3 ) ) <= $time ) ) ) {
				$load = true;
			}
		}

		// If we cannot load, return early.
		if ( ! $load ) {
			return;
		}
		?>
		<div id="sp-woocatslider-review-notice" class="sp-woocatslider-review-notice">
			<div class="sp-woocatslider-plugin-icon">
				<img src="<?php echo SP_WCS_URL . 'admin/css/images/wcs-pro.svg'; ?>" alt="Category Slider for Woocommerce">
			</div>
			<div class="sp-woocatslider-notice-text">
				<h3>Enjoying <strong>Category Slider for Woocommerce</strong>?</h3>
				<p>Hope that you had a good experience with the <strong>Category Slider for Woocommerce</strong>. Would you please show us a little love by rating us in the <a href="https://wordpress.org/support/plugin/woo-category-slider-grid/reviews/?filter=5#new-post" target="_blank"><strong>WordPress.org</strong></a>?
				Just a minute to rate the plugin. Thank you!</p>

				<p class="sp-woocatslider-review-actions">
					<a href="https://wordpress.org/support/plugin/woo-category-slider-grid/reviews/?filter=5#new-post" target="_blank" class="button button-primary notice-dismissed rate-woo-category-slider-grid">Ok, you deserve it</a>
					<a href="#" class="notice-dismissed remind-me-later"><span class="dashicons dashicons-clock"></span>Nope, maybe later
</a>
					<a href="#" class="notice-dismissed never-show-again"><span class="dashicons dashicons-dismiss"></span>Never show again</a>
				</p>
			</div>
		</div>

		<script type='text/javascript'>

			jQuery(document).ready( function($) {
				$(document).on('click', '#sp-woocatslider-review-notice.sp-woocatslider-review-notice .notice-dismissed', function( event ) {
					if ( $(this).hasClass('rate-woo-category-slider-grid') ) {
						var notice_dismissed_value = "1";
					}
					if ( $(this).hasClass('remind-me-later') ) {
						var notice_dismissed_value =  "2";
						event.preventDefault();
					}
					if ( $(this).hasClass('never-show-again') ) {
						var notice_dismissed_value =  "3";
						event.preventDefault();
					}

					$.post( ajaxurl, {
						action: 'sp-woocatslider-never-show-review-notice',
						notice_dismissed_data : notice_dismissed_value
					});

					$('#sp-woocatslider-review-notice.sp-woocatslider-review-notice').hide();
				});
			});

		</script>
		<?php
	}

	/**
	 * Dismiss review notice
	 *
	 * @since  2.1.14
	 *
	 * @return void
	 **/
	public function dismiss_review_notice() {
		if ( ! $review ) {
			$review = array();
		}
		switch ( $_POST['notice_dismissed_data'] ) {
			case '1':
				$review['time']      = time();
				$review['dismissed'] = false;
				break;
			case '2':
				$review['time']      = time();
				$review['dismissed'] = false;
				break;
			case '3':
				$review['time']      = time();
				$review['dismissed'] = true;
				break;
		}
		update_option( 'sp_woo_category_slider_review_notice_dismiss', $review );
		die;
	}
}

new Woo_Category_Slider_Review();
