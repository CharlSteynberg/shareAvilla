<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_ShortCode_Vertical_Progress_Bar')) {
    class g5plusFramework_ShortCode_Vertical_Progress_Bar
    {
        function __construct(){
            add_shortcode('wolverine_vertical_progress_bar', array($this, 'vertical_progress_bar_shortcode'));
        }
        function vertical_progress_bar_shortcode($atts){
	        /**
	         * Shortcode attributes
	         * @var $layout_style
	         * @var $values
	         * @var $units
	         * @var $bgcolor
	         * @var $custombgcolor
	         * @var $options
	         * @var $el_class
	         */
	        $atts = vc_map_get_attributes( 'wolverine_vertical_progress_bar', $atts );
	        extract( $atts );
            wp_enqueue_script( 'vc_waypoints' );
            $bar_options = '';
            $options = explode( ",", $options );
            if ( in_array( "animated", $options ) ) $bar_options .= " animated";
            if ( in_array( "striped", $options ) ) $bar_options .= " striped";

            if ( $bgcolor == "custom" && $custombgcolor != '' ) {
                $custombgcolor = ' style="' . vc_get_css_color( 'background-color', $custombgcolor ) . '"';
                $bgcolor = "";
            }
            if ( $bgcolor != "" ) $bgcolor = " " . $bgcolor;

            $html = '<div class="wolverine-vertical-progress-bar '. $layout_style. ' ' . $el_class.'">';

            $graph_lines = explode( ",", $values );
            $max_value = 0.0;
            $graph_lines_data = array();
            foreach ( $graph_lines as $line ) {
                $new_line = array();
                $color_index = 2;
                $data = explode( "|", $line );
                $new_line['value'] = isset( $data[0] ) ? $data[0] : 0;
                $new_line['percentage_value'] = isset( $data[1] ) && preg_match( '/^\d{1,2}\%$/', $data[1] ) ? (float)str_replace( '%', '', $data[1] ) : false;
                if ( $new_line['percentage_value'] != false ) {
                    $color_index += 1;
                    $new_line['label'] = isset( $data[2] ) ? $data[2] : '';
                } else {
                    $new_line['label'] = isset( $data[1] ) ? $data[1] : '';
                }
                $new_line['bgcolor'] = ( isset( $data[$color_index] ) ) ? ' style="background-color: ' . $data[$color_index] . ';"' : $custombgcolor;

                if ( $new_line['percentage_value'] === false && $max_value < (float)$new_line['value'] ) {
                    $max_value = $new_line['value'];
                }

                $graph_lines_data[] = $new_line;
            }
            //$bar_count=count($graph_lines);
            $bar_width=100 / count($graph_lines);
            foreach ( $graph_lines_data as $line ) {
                $unit = ( $units != '' ) ? ' <span class="vc_label_units">' . $line['value'] . $units . '</span>' : '';
                $html .= '<div class="vc_single_bar' . $bgcolor . '" style="width:'.$bar_width.'%;">';

                if ( $line['percentage_value'] !== false ) {
                    $percentage_value = $line['percentage_value'];
                } elseif ( $max_value > 100.00 ) {
                    $percentage_value = (float)$line['value'] > 0 && $max_value > 100.00 ? round( (float)$line['value'] / $max_value * 100, 4 ) : 0;
                } else {
                    $percentage_value = $line['value'];
                }
                $html .= '<span class="vc_bar' . $bar_options . '" data-percentage-value="' . ( $percentage_value ) . '" data-value="' . $line['value'] . '"' . $line['bgcolor'] . '></span>';
                $html .= '<div class="vc_label_wapper"><small class="vc_label">' . $line['label'] .'</small>'. $unit.'</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
            return $html;
        }
    }
    new g5plusFramework_ShortCode_Vertical_Progress_Bar();
}