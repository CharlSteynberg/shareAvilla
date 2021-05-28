<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Our_Commitment')) {
	class g5plusFramework_Shortcode_Our_Commitment
	{
		function __construct()
		{
			add_shortcode('wolverine_our_commitment_ctn', array($this, 'our_commitment_ctn_shortcode'));
			add_shortcode('wolverine_our_commitment_sc', array($this, 'our_commitment_sc_shortcode'));
		}
		function our_commitment_ctn_shortcode($atts, $content)
		{
			/**
			 * Shortcode attributes
			 * @var $color_scheme
			 * @var $stoponhover
			 * @var $autoplay
			 * @var $el_class
			 * @var $css_animation
			 * @var $duration
			 * @var $delay
			 */
			$atts = vc_map_get_attributes( 'wolverine_our_commitment_ctn', $atts );
			extract( $atts );
			$g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);

			$data_carousel='"singleItem":true, "pagination":true,"navigation": false,"autoHeight": false, "transitionStyle":"fade"';
			$stoponhover = ($stoponhover == 'yes') ? 'true' : 'false';

			$data_carousel.=',"stopOnHover":'.$stoponhover;
			if($autoplay!='')
			{
				$data_carousel.=',"autoPlay":'.$autoplay;
			}
			ob_start();?>
			<div class="wolverine-our-commitment <?php echo esc_attr($color_scheme) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
				<div data-plugin-options='{<?php echo esc_attr($data_carousel) ?>}' class="owl-carousel">
					<?php echo do_shortcode($content); ?>
				</div>
			</div>
			<?php
			$output = ob_get_clean();
			return $output;
		}
		function our_commitment_sc_shortcode($atts,$content = nul)
		{
			$author=$image=$job=$title='';
			extract(shortcode_atts(array(
				'image'            => '',
				'title'            => '',
				'author'           => '',
				'job'              => '',
			), $atts));
			ob_start();?>
			<div class="our-commitment-item">
				<div class="our-commitment-avatar">
					<?php $img_id = preg_replace( '/[^\d]/', '', $image );
					$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '350x506'  ) );
					echo wp_kses_post($img['thumbnail']);
					?>
				</div>
				<div class="our-commitment-info">
					<?php if($author!=''):?>
						<h3><?php echo esc_html($title) ?></h3>
					<?php endif;?>
					<p><?php echo wp_strip_all_tags($content) ?></p>
					<?php if($author!=''):?>
						<h4><?php echo esc_html($author) ?></h4>
						<?php if($job!=''):?>
							<span><?php echo esc_html($job) ?></span>
						<?php endif;?>
					<?php endif;?>
					<div class="our-commitment-owl-controls"></div>
				</div>
			</div>
			<?php
			$output = ob_get_clean();
			return $output;
		}
	}
	new g5plusFramework_Shortcode_Our_Commitment();
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_wolverine_our_commitment_ctn extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_wolverine_our_commitment_sc extends WPBakeryShortCode {
	}
}