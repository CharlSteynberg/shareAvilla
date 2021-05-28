<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/11/2015
 * Time: 8:55 AM
 */
class G5Plus_Widget_About extends G5Plus_Widget {
	public function __construct() {
		$this->widget_cssclass    = 'widget-about';
		$this->widget_description = __( "About Widget", 'wolverine' );
		$this->widget_id          = 'g5plus-about';
		$this->widget_name        = __( 'G5Plus: About', 'wolverine' );
		$this->settings           = array(
			'title' => array(
				'type' => 'text',
				'std' => '',
				'label' => __('Title','wolverine')
			),
			'avatar' => array(
				'type' => 'image',
				'std' => '',
				'label' => __('Avatar','wolverine')
			),
			'social' => array(
				'type'  => 'multi-select',
				'label'   => __( 'Select social profiles', 'wolverine' ),
				'std'   => '',
				'options' => array(
					'twitter'  => __( 'Twitter', 'wolverine' ),
					'facebook'  => __( 'Facebook', 'wolverine' ),
					'dribbble'  => __( 'Dribbble', 'wolverine' ),
					'vimeo'  => __( 'Vimeo', 'wolverine' ),
					'tumblr'  => __( 'Tumblr', 'wolverine' ),
					'skype'  => __( 'Skype', 'wolverine' ),
					'linkedin'  => __( 'LinkedIn', 'wolverine' ),
					'googleplus'  => __( 'Google+', 'wolverine' ),
					'flickr'  => __( 'Flickr', 'wolverine' ),
					'youtube'  => __( 'YouTube', 'wolverine' ),
					'pinterest' => __( 'Pinterest', 'wolverine' ),
					'foursquare'  => __( 'Foursquare', 'wolverine' ),
					'instagram' => __( 'Instagram', 'wolverine' ),
					'github'  => __( 'GitHub', 'wolverine' ),
					'xing' => __( 'Xing', 'wolverine' ),
					'behance'  => __( 'Behance', 'wolverine' ),
					'deviantart'  => __( 'Deviantart', 'wolverine' ),
					'soundcloud'  => __( 'SoundCloud', 'wolverine' ),
					'yelp'  => __( 'Yelp', 'wolverine' ),
					'rss'  => __( 'RSS Feed', 'wolverine' ),
					'email'  => __( 'Email address', 'wolverine' ),
				)
			)

		);
		parent::__construct();
	}
	function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) )
			return;
		extract( $args, EXTR_SKIP );
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$avatar = ( ! empty( $instance['avatar'] ) ) ? $instance['avatar'] : '';
		$social        = empty( $instance['social'] ) ? '' : apply_filters( 'widget_icons', $instance['social'] );

		$social_icons = g5plus_get_social_icon($social,'about-social');
		$class = array('widget-about-wrap');

		ob_start();
		if (!empty($avatar)) : ?>
			<?php echo $args['before_widget']; ?>
			<?php if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			} ?>
			<div class="<?php echo join(' ',$class); ?>">
				<img alt="<?php echo esc_attr(__('About me','wolverine')) ?>" src="<?php echo esc_url($avatar) ?>" />
				<?php echo wp_kses_post( $social_icons ); ?>
			</div>
			<?php echo $args['after_widget']; ?>
		<?php endif;
		// Reset the global $the_post as this query will have stomped on it
		$content =  ob_get_clean();
		echo sprintf('%s',$content);
		$this->cache_widget( $args, $content );
	}
}

if (!function_exists('g5plus_register_widget_about')) {
	function g5plus_register_widget_about() {
		register_widget('G5Plus_Widget_About');
	}
	add_action('widgets_init', 'g5plus_register_widget_about', 1);
}