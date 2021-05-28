<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woo Quick View- popup class
 *
 * @since 1.0
 */
class SP_WQV_Popup {

	/**
	 * @var SP_WQV_Popup single instance of the class
	 *
	 * @since 1.0
	 */
	protected static $_instance = null;


	/**
	 * @since 1.0
	 *
	 * @static
	 *
	 * @return SP_WQV_Popup
	 */
	public static function getInstance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'wp_ajax_wqv_popup_content', array( $this, 'wqv_popup_content' ) );
		add_action( 'wp_ajax_nopriv_wqv_popup_content', array( $this, 'wqv_popup_content' ) );
		add_action( 'wqv_product_content', 'woocommerce_template_single_title', 5 );
		add_action( 'wqv_product_content', 'woocommerce_template_single_rating', 10 );
		add_action( 'wqv_product_content', 'woocommerce_template_single_price', 15 );
		add_action( 'wqv_product_content', 'woocommerce_template_single_excerpt', 20 );
		add_action( 'wqv_product_content', 'woocommerce_template_single_add_to_cart', 25 );
		add_action( 'wqv_product_content', 'woocommerce_template_single_meta', 30 );
	}

	/**
	 * Popup Content
	 *
	 * @return void
	 */
	public function wqv_popup_content() {

		global $post, $product;
		$post = get_post( absint( $_GET['product_id'] ) );
		setup_postdata( $post );
		$post_id   = $post->ID;
		$product   = wc_get_product( $post_id );
		$thumb_ids = array();
		$image_ids = $product->get_gallery_image_ids();
		$thumb_ids = array_merge( $thumb_ids, $image_ids );
		?>

		<div id="wqv-quick-view-content" class="mfp-with-anim sp-wqv-content sp-wqv-content-<?php echo get_the_id(); ?>">

			<div class="wqv-product-images" data-attachments="<?php echo count( $thumb_ids ); ?>">
				<div class="wqv-product-images-slider">
					<?php
					if ( has_post_thumbnail( $post->ID ) ) {
						$attachment_id	= get_post_thumbnail_id();
						$props          = wc_get_product_attachment_props( $attachment_id, $post );
						$image          = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, $props );
						$thumb_image 	= wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0 );

						echo apply_filters(
							'woocommerce_single_product_image_html',
							sprintf(
								'<span data-thumb="%s" class="selected" itemprop="image" title="%s">%s</span>',
								$thumb_image[0],
								esc_attr( $props['caption'] ),
								$image
							),
							$post->ID
						);

					} else {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<span data-thumb="%s" class="selected" itemprop="image"><img src="%s" alt="%s" /></span>', wc_placeholder_img_src(), wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
					} ?>
				</div> <!-- wqv-product-images-slider -->	

			</div>

			<div class="wqv-product-info">
				<div class="wqv-product-content">

				<?php do_action( 'wqv_product_content' ); ?>

				</div>
			</div>

		</div>
		<?php
		wp_reset_postdata();
		die();

	}

}

new SP_WQV_Popup();
