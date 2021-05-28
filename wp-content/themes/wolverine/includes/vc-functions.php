<?php
add_action( 'vc_before_init', 'g5plus_vcSetAsTheme' );
function g5plus_vcSetAsTheme() {
    vc_set_as_theme();
}

function g5plus_vc_remove_frontend_links() {
    vc_disable_frontend();
}
add_action( 'vc_after_init', 'g5plus_vc_remove_frontend_links' );

function g5plus_get_css_animation($css_animation){
	$output = '';
	if ($css_animation != '') {
		wp_enqueue_script('vc_waypoints');
		$output = ' wpb_animate_when_almost_visible g5plus-css-animation ' . $css_animation;
	}
	return $output;
}

function g5plus_get_style_animation($duration, $delay) {
	$styles = array();
	if ($duration != '0' && !empty($duration)) {
		$duration = (float)trim($duration, "\n\ts");
		$styles[] = "-webkit-animation-duration: {$duration}s";
		$styles[] = "-moz-animation-duration: {$duration}s";
		$styles[] = "-ms-animation-duration: {$duration}s";
		$styles[] = "-o-animation-duration: {$duration}s";
		$styles[] = "animation-duration: {$duration}s";
	}
	if ($delay != '0' && !empty($delay)) {
		$delay = (float)trim($delay, "\n\ts");
		$styles[] = "opacity: 0";
		$styles[] = "-webkit-animation-delay: {$delay}s";
		$styles[] = "-moz-animation-delay: {$delay}s";
		$styles[] = "-ms-animation-delay: {$delay}s";
		$styles[] = "-o-animation-delay: {$delay}s";
		$styles[] = "animation-delay: {$delay}s";
	}
	if (count($styles) > 1) {
		return 'style="' . implode(';', $styles) . '"';
	}
	return implode(';', $styles);
}

function  g5plus_convert_hex_to_rgba($hex,$opacity=1) {
	$hex = str_replace("#", "", $hex);
	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	}
	else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
	return $rgba;
}

