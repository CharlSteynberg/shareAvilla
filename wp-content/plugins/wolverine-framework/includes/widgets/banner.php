<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/2/2015
 * Time: 11:48 AM
 */
class G5Plus_Widget_Banner extends G5Plus_Widget {
	public function __construct() {
		$this->widget_cssclass    = 'widget-banner';
		$this->widget_description = __( "Banner Widget", 'wolverine' );
		$this->widget_id          = 'g5plus-banner';
		$this->widget_name        = __( 'G5Plus: Banner', 'wolverine' );
		$this->settings           = array(
			'title' => array(
				'type' => 'text',
				'std' => '',
				'label' => __('Title','wolverine')
			),
			'image' => array(
				'type' => 'image',
				'std' => '',
				'label' => __('Image','wolverine')
			),
			'link' => array(
				'type' => 'text',
				'std' => '',
				'label' => __('Link','wolverine')
			),
			'target' => array(
				'type' => 'checkbox',
				'std' => '',
				'label' => __('Open link in a new window/tab','wolverine')
			),
		);
		parent::__construct();
	}

	function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) )
			return;

		extract( $args, EXTR_SKIP );
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$image = ( ! empty( $instance['image'] ) ) ? $instance['image'] : '';
		$link = ( ! empty( $instance['link'] ) ) ? $instance['link'] : '#';
		$target = $instance['target'] == 1 ? '_blank' : '_self';

		$class = array('widget-image-wrap');

		ob_start();
		if (!empty($image)) : ?>
			<?php echo $args['before_widget']; ?>
			<?php if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			} ?>
			<div class="<?php echo join(' ',$class); ?>">
				<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
					<img alt="<?php echo esc_attr($title) ?>" src="<?php echo esc_url($image) ?>" />
				</a>
			</div>
			<?php echo $args['after_widget']; ?>
		<?php endif;
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
		$content =  ob_get_clean();
		echo sprintf('%s',$content);
		$this->cache_widget( $args, $content );
	}
}

if (!function_exists('g5plus_register_widget_banner')) {
	function g5plus_register_widget_banner() {
		register_widget('G5Plus_Widget_Banner');
	}
	add_action('widgets_init', 'g5plus_register_widget_banner', 1);
}