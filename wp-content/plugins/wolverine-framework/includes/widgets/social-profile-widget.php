<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/26/15
 * Time: 5:24 PM
 */
class G5plus_Social_Profile extends  G5Plus_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-social-profile';
        $this->widget_description = __( "Social profile widget", 'wolverine' );
        $this->widget_id          = 'g5plus-social-profile';
        $this->widget_name        = __( 'G5Plus: Social Profile', 'wolverine' );
        $this->settings           = array(
            'label' => array(
		        'type' => 'text',
		        'std' => '',
		        'label' => __('Label','wolverine')
            ),
	        'type'  => array(
                'type'    => 'select',
                'std'     => '',
                'label'   => __( 'Type', 'wolverine' ),
                'options' => array(
                    'social-icon-no-border' => __( 'No Border', 'wolverine' ),
                    'social-icon-bordered'  => __( 'Bordered', 'wolverine' ),
	                'social-icon-text'  => __( 'Text Only', 'wolverine' )
                )
            ),
            'icons' => array(
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
        extract( $args, EXTR_SKIP );
	    $label = empty( $instance['label'] ) ? '' : apply_filters( 'widget_label', $instance['label'] );
        $type         = empty( $instance['type'] ) ? '' : apply_filters( 'widget_type', $instance['type'] );
        $icons        = empty( $instance['icons'] ) ? '' : apply_filters( 'widget_icons', $instance['icons'] );
        $widget_id    = $args['widget_id'];
	    $social_icons = g5plus_get_social_icon($icons,'widget-social-profile ' . $type );
	    echo wp_kses_post( $before_widget );
	    ?>
	    <?php if (!empty($label)) : ?>
		    <span><?php echo wp_kses_post($label); ?></span>
		 <?php endif; ?>
		    <?php echo wp_kses_post( $social_icons ); ?>
	    <?php
	    echo wp_kses_post( $after_widget );
    }
}
if (!function_exists('g5plus_register_social_profile')) {
    function g5plus_register_social_profile() {
        register_widget('G5plus_Social_Profile');
    }
    add_action('widgets_init', 'g5plus_register_social_profile', 1);
}