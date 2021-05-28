<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
/**
 *
 * Field: shortcode
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SP_WCS_Field_shortcode' ) ) {
	class SP_WCS_Field_shortcode extends SP_WCS_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			// Get the Post ID.
			$post_id = get_the_ID();

			echo ( ! empty( $post_id ) ) ? '<div class="wcsp-scode-wrap">
				<div class="wcsp-col-lg-3">
					<div class="wcsp-scode-content">
						<h2 class="wcsp-scode-title">Shortcode</h2>
						<p>Copy and paste this shortcode into your posts or pages:</p>
						<div class="shortcode-wrap">
						<img class="wcsp-copy-btn" src="' . SP_WCS_URL . 'admin/img/copy.svg"><div class="selectable">[woocatslider id="' . $post_id . '"]</div></div>
						<div class="wcsp-after-copy-text"><i class="fa fa-check-circle"></i>  Shortcode  Copied to Clipboard! </div>
					</div>
				</div>
				<div class="wcsp-col-lg-3">
					<div class="wcsp-scode-content">
						<h2 class="wcsp-scode-title">Template Include</h2>
						<p>Paste the PHP code into your template file:</p>
						<div class="shortcode-wrap">
						<img class="wcsp-copy-btn" src="' . SP_WCS_URL . 'admin/img/copy.svg"><div class="selectable">&lt;?php echo do_shortcode(\'[woocatslider id="' . $post_id . '"]\'); ?&gt;</div>
						</div>
					</div>
				</div>
			</div>' : '';
		}

	}
}
