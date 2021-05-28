<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) die( '-1' );
if(!class_exists('g5plusFramework_Shortcode_Heading')){
    class g5plusFramework_Shortcode_Heading{
        function __construct(){
            add_shortcode('wolverine_heading', array($this, 'heading_shortcode'));
        }
        function heading_shortcode($atts){
	        /**
	         * Shortcode attributes
	         * @var $layout_style
	         * @var $color_scheme
	         * @var $icon_type
	         * @var $icon_fontawesome
	         * @var $icon_wolverine
	         * @var $icon_openiconic
	         * @var $icon_typicons
	         * @var $icon_entypoicons
	         * @var $icon_linecons
	         * @var $icon_entypo
	         * @var $icon_image
	         * @var $title
	         * @var $sub_title
	         * @var $description
	         * @var $text_align
	         * @var $el_class
	         * @var $css_animation
	         * @var $duration
	         * @var $delay
	         */
	        $iconClass='';
	        $atts = vc_map_get_attributes( 'wolverine_heading', $atts );
	        extract( $atts );
	        $g5plus_animation = ' ' . esc_attr($el_class) . g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            if($icon_type!='' && $icon_type!='image')
            {
                vc_icon_element_fonts_enqueue( $icon_type );
                $iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : '';
            }
            if($layout_style=='style4')
            {
                $text_align='';
            }
            ob_start();?>
            <div class="wolverine-heading <?php echo esc_attr($layout_style) ?> <?php echo esc_attr($color_scheme) ?> <?php echo esc_attr($text_align) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>
                <?php if($layout_style=='style1'):
                    if($sub_title!=''):?>
                        <h3><?php echo  wp_kses_post($sub_title) ?></h3>
                    <?php endif;
	                if($title!=''):?>
                    <h2><?php echo  wp_kses_post($title) ?></h2>
                    <?php endif;
                    if($icon_type!=''):
                        if ( $icon_type == 'image' ) :
                            $img = wp_get_attachment_image_src( $icon_image, 'large' );
                            ?>
                            <img src="<?php echo esc_attr($img[0])?>"/>
                        <?php else :?>
                            <i class="<?php echo esc_attr($iconClass) ?>"></i>
                        <?php endif;
                    endif;
                    if($description!=''):?>
                        <p><?php echo wp_kses_post($description) ?></p>
                    <?php endif;
                elseif($layout_style=='style2'):
                    if($icon_type!=''):
                        if ( $icon_type == 'image' ) :
                            $img = wp_get_attachment_image_src( $icon_image, 'large' );
                            ?>
                            <img src="<?php echo esc_url($img[0])?>"/>
                        <?php else :?>
                            <i class="<?php echo esc_attr($iconClass) ?>"></i>
                        <?php endif;
                    endif;
                    if($sub_title!=''):?>
                    <h3><?php echo  wp_kses_post($sub_title) ?></h3>
                    <?php endif;
	                if($title!=''):?>
                    <h2><?php echo  wp_kses_post($title) ?></h2>
                    <?php endif;
                    if($description!=''):?>
                        <p><?php echo wp_kses_post($description) ?></p>
                    <?php endif;
                elseif($layout_style=='style3'):
	                if($title!=''):?>
                    <h2><?php echo  wp_kses_post($title) ?></h2>
	                <?php endif;
                    if($description!=''):?>
                        <p><?php echo wp_kses_post($description) ?></p>
                    <?php endif;
                elseif($layout_style=='style4'):?>
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
	                        <?php if($title!=''):?>
                            <h2><?php echo wp_kses_post($title) ?></h2>
	                        <?php endif;?>
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <?php if($description!=''):?>
                                <p><?php echo wp_kses_post($description) ?></p>
                            <?php endif;?>
                        </div>
                    </div>
                <?php elseif($layout_style=='style5'):
		            if($title!=''):?>
                    <h2><?php echo wp_kses_post($title) ?></h2>
		            <?php endif;
                    if($description!=''):?>
                        <p><?php echo wp_kses_post($description) ?></p>
                    <?php endif;
	            elseif($layout_style=='style6'):
                    if($icon_type!=''):
                        if ( $icon_type == 'image' ) :
                            $img = wp_get_attachment_image_src( $icon_image, 'large' );
                        ?>
                            <img src="<?php echo esc_url($img[0])?>"/>
                        <?php else :?>
                            <i class="<?php echo esc_attr($iconClass) ?>"></i>
                        <?php endif;
                    endif;
	                if($title!=''):?>
                    <h2><?php echo  wp_kses_post($title) ?></h2>
	                <?php endif;
                    if($description!=''):?>
                        <p><?php echo wp_kses_post($description) ?></p>
                    <?php endif;
                else:
	                if($sub_title!=''):?>
	                <h3><?php echo  wp_kses_post($sub_title) ?></h3>
	                <?php endif;
	                if($title!=''):?>
		                <h2><?php echo  wp_kses_post($title) ?></h2>
	                <?php endif;
	                if($description!=''):?>
		                <p><?php echo wp_kses_post($description) ?></p>
	                <?php endif;
	            endif;?>
            </div>
            <?php
            $content = ob_get_clean();
            return $content;
        }
    }
    new g5plusFramework_Shortcode_Heading();
}