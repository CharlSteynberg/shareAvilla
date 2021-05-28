<?php
function g5plus_number_settings_field($settings, $value) {
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$min = isset($settings['min']) ? $settings['min'] : '';
	$max = isset($settings['max']) ? $settings['max'] : '';
	$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
	$class = isset($settings['class']) ? $settings['class'] : '';
	$output = '<input type="number" min="'.esc_attr($min).'" max="'.esc_attr($max).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="'.esc_attr($value).'" style="max-width:100px; margin-right: 10px;" />'.esc_attr($suffix);
	return $output;
}

function g5plus_icon_text_settings_field($settings, $value) {
	return '<div class="vc-text-icon">'
	       .'<input  name="'.$settings['param_name'] .'" style="width:80%;" class="wpb_vc_param_value wpb-textinput widefat input-icon ' .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" value="' .esc_attr($value).'"/>'
	       .'<input title="'.__('Click to browse icon','wolverine').'" style="width:20%; height:34px;" class="browse-icon button-secondary" type="button" value="'. __('Browse Icon','wolverine') .'" >'
	       .'<span class="icon-preview"><i class="'. esc_attr($value).'"></i></span>'
	       .'</div>';
}

function g5plus_multi_select_settings_field_shortcode_param($settings, $value) {
	$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
	$param_option     =  isset( $settings['options'] ) ? $settings['options'] : '';
	$output     = '<input type="hidden" name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . '" value="' . $value . '"/>';
	$output .= '<select multiple id="' . $param_name . '_select2" name="' . $param_name . '_select2" class="multi-select">';
	if ( $param_option != '' && is_array( $param_option ) ) {
		foreach ( $param_option as $text_val => $val ) {
			if ( is_numeric( $text_val ) && ( is_string( $val ) || is_numeric( $val ) ) ) {
				$text_val = $val;
			}
			$output .= '<option id="' . $val.'" value="' . $val . '">' . htmlspecialchars( $text_val ) . '</option>';
		}
	}

	$output .= '</select><input type="checkbox" id="' . $param_name . '_select_all" >'.__('Select All','wolverine');
	$output.='<script type="text/javascript">
		        jQuery(document).ready(function($){

					$("#' . $param_name . '_select2").select2({width : "100%"});

					var order = $("#' . $param_name . '").val();
					if (order != "") {
						order = order.split(",");
						var choices = [];
						for (var i = 0; i < order.length; i++) {
							var option = $("#' . $param_name . '_select2 option[value="+ order[i]  + "]");
							if (option.length > 0) {
							    choices[i] = {id:order[i], text:option[0].label, element: option};
							    option.detach();
						        $("#' . $param_name . '_select2").append(option);
							}
						}

						$("#' . $param_name . '_select2").val(order).trigger("change");
					}


                    $("#' . $param_name . '_select2").on("select2:selecting",function(e){
                        var ids = $("#' . $param_name . '").val();
			            if (ids != "") {
			                ids +=",";
			            }
			            ids += e.params.args.data.id;
			            $("#' . $param_name . '").val(ids);
                    }).on("select2:unselecting",function(e){
                        var ids = $("#' . $param_name . '").val();
                         var arr_ids = ids.split(",");
                         var newIds = "";
                         for(var i = 0 ; i < arr_ids.length; i++) {
				            if (arr_ids[i] != e.params.args.data.id){
				                if (newIds != "") {
			                        newIds +=",";
					            }
					            newIds += arr_ids[i];
				            }
				          }
				          $("#' . $param_name . '").val(newIds);
                    }).on("select2:select", function(e){
                        var element = e.params.data.element;
						var $element = $(element);

						$element.detach();
						$(this).append($element);
						$(this).trigger("change");

                    });


		            $("#' . $param_name . '_select_all").click(function(){
		                if($("#' . $param_name . '_select_all").is(":checked") ){
		                    $("#' . $param_name . '_select2 > option").prop("selected","selected");
		                    $("#' . $param_name . '_select2").trigger("change");
		                    var arr_ids =  $("#' . $param_name . '_select2").select2("val");
		                    var ids = "";
                            for (var i = 0; i < arr_ids.length; i++ ) {
                                if (ids != "") {
                                    ids +=",";
                                }
                                ids += arr_ids[i];
                            }
                            $("#' . $param_name . '").val(ids);

		                }else{
		                    $("#' . $param_name . '_select2 > option").removeAttr("selected");
		                    $("#' . $param_name . '_select2").trigger("change");
		                    $("#' . $param_name . '").val("");
		                }
		            });
		        });
		        </script>
		        <style>
		            .multi-select
		            {
		              width: 100%;
		            }
		            .select2-dropdown
		            {
		                z-index: 100000;
		            }
		        </style>';
	return $output;
}

function g5plus_tags_settings_field_shortcode_param($settings, $value) {
	$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
	$output = '<input  name="' . $settings['param_name']
	          . '" class="wpb_vc_param_value wpb-textinput '
	          . $settings['param_name'] . ' ' . $settings['type']
	          . '" type="hidden" value="' . $value . '"/>';
	$output .= '<input type="text" name="'.$param_name.'_tagsinput" id="'.$param_name.'_tagsinput" value="'.$value.'" data-role="tagsinput"/>';
	$output .= '<script type="text/javascript">
							jQuery(document).ready(function($){
								$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();

								$("#'. $param_name .'_tagsinput").on("itemAdded", function(event) {
		                             $("input[name='.$param_name.']").val($(this).val());
								});

								$("#'. $param_name .'_tagsinput").on("itemRemoved", function(event) {
		                             $("input[name='.$param_name.']").val($(this).val());
								});
							});
						</script>';
	return $output;
}

function g5plus_register_vc_params() {
	vc_add_shortcode_param('number', 'g5plus_number_settings_field');
	vc_add_shortcode_param('icon_text', 'g5plus_icon_text_settings_field');
	vc_add_shortcode_param('multi-select', 'g5plus_multi_select_settings_field_shortcode_param');
	vc_add_shortcode_param('tags', 'g5plus_tags_settings_field_shortcode_param');
}
add_action('vc_load_default_params','g5plus_register_vc_params');


function g5plus_add_vc_param() {
	if(function_exists('vc_remove_param')){
		vc_remove_param('vc_tta_accordion', 'style' );
		vc_remove_param('vc_tta_tabs', 'style' );
	}
	if(function_exists('vc_add_param')){
		$add_css_animation = array(
			'type' => 'dropdown',
			'heading' => __('CSS Animation', 'wolverine'),
			'param_name' => 'css_animation',
			'value' => array(__('No','wolverine') => '',__('Fade In','wolverine') => 'wpb_fadeIn',__('Fade Top to Bottom','wolverine') => 'wpb_fadeInDown', __('Fade Bottom to Top','wolverine') => 'wpb_fadeInUp', __('Fade Left to Right','wolverine') => 'wpb_fadeInLeft', __('Fade Right to Left','wolverine') => 'wpb_fadeInRight', __('Bounce In','wolverine') => 'wpb_bounceIn',__('Bounce Top to Bottom','wolverine') => 'wpb_bounceInDown',__('Bounce Bottom to Top','wolverine') => 'wpb_bounceInUp', __('Bounce Left to Right','wolverine') => 'wpb_bounceInLeft', __('Bounce Right to Left','wolverine') => 'wpb_bounceInRight', __('Zoom In','wolverine') => 'wpb_zoomIn', __('Flip Vertical','wolverine') => 'wpb_flipInX',__('Flip Horizontal','wolverine') => 'wpb_flipInY', __('Bounce','wolverine') => 'wpb_bounce', __('Flash','wolverine') => 'wpb_flash',__('Shake','wolverine') => 'wpb_shake',__( 'Pulse','wolverine') => 'wpb_pulse',__( 'Swing','wolverine') => 'wpb_swing', __('Rubber band','wolverine') => 'wpb_rubberBand', __('Wobble','wolverine') => 'wpb_wobble', __('Tada','wolverine') => 'wpb_tada'),
			'description' => __('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'wolverine')
		);

		$add_duration_animation = array(
			'type' => 'textfield',
			'heading' => __('Animation Duration', 'wolverine'),
			'param_name' => 'duration',
			'value' => '',
			'description' => __('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'wolverine'),
			'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown','wpb_fadeInUp','wpb_fadeInLeft','wpb_fadeInRight','wpb_bounceIn','wpb_bounceInDown','wpb_bounceInUp','wpb_bounceInLeft','wpb_bounceInRight','wpb_zoomIn','wpb_flipInX','wpb_flipInY','wpb_bounce', 'wpb_flash', 'wpb_shake','wpb_pulse','wpb_swing','wpb_rubberBand','wpb_wobble','wpb_tada')),
		);

		$add_delay_animation = array(
			'type' => 'textfield',
			'heading' => __('Animation Delay', 'wolverine'),
			'param_name' => 'delay',
			'value' => '',
			'description' => __('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'wolverine'),
			'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown','wpb_fadeInUp','wpb_fadeInLeft','wpb_fadeInRight','wpb_bounceIn','wpb_bounceInDown','wpb_bounceInUp','wpb_bounceInLeft','wpb_bounceInRight','wpb_zoomIn','wpb_flipInX','wpb_flipInY','wpb_bounce', 'wpb_flash', 'wpb_shake','wpb_pulse','wpb_swing','wpb_rubberBand','wpb_wobble','wpb_tada')),
		);
		$wolverine_icons = array(
			array('wicon icon-outline-vector-icons-pack-1' => 'icon-outline-vector-icons-pack-1'),array('wicon icon-outline-vector-icons-pack-2' => 'icon-outline-vector-icons-pack-2'),array('wicon icon-outline-vector-icons-pack-3' => 'icon-outline-vector-icons-pack-3'),array('wicon icon-outline-vector-icons-pack-4' => 'icon-outline-vector-icons-pack-4'),array('wicon icon-outline-vector-icons-pack-5' => 'icon-outline-vector-icons-pack-5'),array('wicon icon-outline-vector-icons-pack-6' => 'icon-outline-vector-icons-pack-6'),array('wicon icon-outline-vector-icons-pack-7' => 'icon-outline-vector-icons-pack-7'),array('wicon icon-outline-vector-icons-pack-14' => 'icon-outline-vector-icons-pack-14'),array('wicon icon-outline-vector-icons-pack-15' => 'icon-outline-vector-icons-pack-15'),array('wicon icon-outline-vector-icons-pack-16' => 'icon-outline-vector-icons-pack-16'),array('wicon icon-outline-vector-icons-pack-17' => 'icon-outline-vector-icons-pack-17'),array('wicon icon-outline-vector-icons-pack-18' => 'icon-outline-vector-icons-pack-18'),array('wicon icon-outline-vector-icons-pack-19' => 'icon-outline-vector-icons-pack-19'),array('wicon icon-outline-vector-icons-pack-20' => 'icon-outline-vector-icons-pack-20'),array('wicon icon-outline-vector-icons-pack-27' => 'icon-outline-vector-icons-pack-27'),array('wicon icon-outline-vector-icons-pack-28' => 'icon-outline-vector-icons-pack-28'),array('wicon icon-outline-vector-icons-pack-29' => 'icon-outline-vector-icons-pack-29'),array('wicon icon-outline-vector-icons-pack-30' => 'icon-outline-vector-icons-pack-30'),array('wicon icon-outline-vector-icons-pack-31' => 'icon-outline-vector-icons-pack-31'),array('wicon icon-outline-vector-icons-pack-32' => 'icon-outline-vector-icons-pack-32'),array('wicon icon-outline-vector-icons-pack-33' => 'icon-outline-vector-icons-pack-33'),array('wicon icon-outline-vector-icons-pack-40' => 'icon-outline-vector-icons-pack-40'),array('wicon icon-outline-vector-icons-pack-41' => 'icon-outline-vector-icons-pack-41'),array('wicon icon-outline-vector-icons-pack-42' => 'icon-outline-vector-icons-pack-42'),array('wicon icon-outline-vector-icons-pack-43' => 'icon-outline-vector-icons-pack-43'),array('wicon icon-outline-vector-icons-pack-44' => 'icon-outline-vector-icons-pack-44'),array('wicon icon-outline-vector-icons-pack-45' => 'icon-outline-vector-icons-pack-45'),array('wicon icon-outline-vector-icons-pack-46' => 'icon-outline-vector-icons-pack-46'),array('wicon icon-outline-vector-icons-pack-53' => 'icon-outline-vector-icons-pack-53'),array('wicon icon-outline-vector-icons-pack-54' => 'icon-outline-vector-icons-pack-54'),array('wicon icon-outline-vector-icons-pack-55' => 'icon-outline-vector-icons-pack-55'),array('wicon icon-outline-vector-icons-pack-56' => 'icon-outline-vector-icons-pack-56'),array('wicon icon-outline-vector-icons-pack-57' => 'icon-outline-vector-icons-pack-57'),array('wicon icon-outline-vector-icons-pack-58' => 'icon-outline-vector-icons-pack-58'),array('wicon icon-outline-vector-icons-pack-59' => 'icon-outline-vector-icons-pack-59'),array('wicon icon-outline-vector-icons-pack-66' => 'icon-outline-vector-icons-pack-66'),array('wicon icon-outline-vector-icons-pack-67' => 'icon-outline-vector-icons-pack-67'),array('wicon icon-outline-vector-icons-pack-68' => 'icon-outline-vector-icons-pack-68'),array('wicon icon-outline-vector-icons-pack-69' => 'icon-outline-vector-icons-pack-69'),array('wicon icon-outline-vector-icons-pack-70' => 'icon-outline-vector-icons-pack-70'),array('wicon icon-outline-vector-icons-pack-71' => 'icon-outline-vector-icons-pack-71'),array('wicon icon-outline-vector-icons-pack-72' => 'icon-outline-vector-icons-pack-72'),array('wicon icon-outline-vector-icons-pack-79' => 'icon-outline-vector-icons-pack-79'),array('wicon icon-outline-vector-icons-pack-80' => 'icon-outline-vector-icons-pack-80'),array('wicon icon-outline-vector-icons-pack-81' => 'icon-outline-vector-icons-pack-81'),array('wicon icon-outline-vector-icons-pack-82' => 'icon-outline-vector-icons-pack-82'),array('wicon icon-outline-vector-icons-pack-83' => 'icon-outline-vector-icons-pack-83'),array('wicon icon-outline-vector-icons-pack-84' => 'icon-outline-vector-icons-pack-84'),array('wicon icon-outline-vector-icons-pack-85' => 'icon-outline-vector-icons-pack-85'),array('wicon icon-outline-vector-icons-pack-92' => 'icon-outline-vector-icons-pack-92'),array('wicon icon-outline-vector-icons-pack-93' => 'icon-outline-vector-icons-pack-93'),array('wicon icon-outline-vector-icons-pack-94' => 'icon-outline-vector-icons-pack-94'),array('wicon icon-outline-vector-icons-pack-95' => 'icon-outline-vector-icons-pack-95'),array('wicon icon-outline-vector-icons-pack-96' => 'icon-outline-vector-icons-pack-96'),array('wicon icon-outline-vector-icons-pack-97' => 'icon-outline-vector-icons-pack-97'),array('wicon icon-outline-vector-icons-pack-98' => 'icon-outline-vector-icons-pack-98'),array('wicon icon-outline-vector-icons-pack-105' => 'icon-outline-vector-icons-pack-105'),array('wicon icon-outline-vector-icons-pack-106' => 'icon-outline-vector-icons-pack-106'),array('wicon icon-outline-vector-icons-pack-107' => 'icon-outline-vector-icons-pack-107'),array('wicon icon-outline-vector-icons-pack-108' => 'icon-outline-vector-icons-pack-108'),array('wicon icon-outline-vector-icons-pack-109' => 'icon-outline-vector-icons-pack-109'),array('wicon icon-outline-vector-icons-pack-110' => 'icon-outline-vector-icons-pack-110'),array('wicon icon-outline-vector-icons-pack-111' => 'icon-outline-vector-icons-pack-111'),array('wicon icon-outline-vector-icons-pack-118' => 'icon-outline-vector-icons-pack-118'),array('wicon icon-outline-vector-icons-pack-119' => 'icon-outline-vector-icons-pack-119'),array('wicon icon-outline-vector-icons-pack-120' => 'icon-outline-vector-icons-pack-120'),array('wicon icon-outline-vector-icons-pack-121' => 'icon-outline-vector-icons-pack-121'),array('wicon icon-outline-vector-icons-pack-122' => 'icon-outline-vector-icons-pack-122'),array('wicon icon-outline-vector-icons-pack-123' => 'icon-outline-vector-icons-pack-123'),array('wicon icon-outline-vector-icons-pack-124' => 'icon-outline-vector-icons-pack-124'),array('wicon icon-outline-vector-icons-pack-131' => 'icon-outline-vector-icons-pack-131'),array('wicon icon-outline-vector-icons-pack-132' => 'icon-outline-vector-icons-pack-132'),array('wicon icon-outline-vector-icons-pack-133' => 'icon-outline-vector-icons-pack-133'),array('wicon icon-outline-vector-icons-pack-134' => 'icon-outline-vector-icons-pack-134'),array('wicon icon-outline-vector-icons-pack-135' => 'icon-outline-vector-icons-pack-135'),array('wicon icon-outline-vector-icons-pack-136' => 'icon-outline-vector-icons-pack-136'),array('wicon icon-outline-vector-icons-pack-137' => 'icon-outline-vector-icons-pack-137'),array('wicon icon-outline-vector-icons-pack-144' => 'icon-outline-vector-icons-pack-144'),array('wicon icon-outline-vector-icons-pack-145' => 'icon-outline-vector-icons-pack-145'),array('wicon icon-outline-vector-icons-pack-146' => 'icon-outline-vector-icons-pack-146'),array('wicon icon-outline-vector-icons-pack-147' => 'icon-outline-vector-icons-pack-147'),array('wicon icon-outline-vector-icons-pack-148' => 'icon-outline-vector-icons-pack-148'),array('wicon icon-outline-vector-icons-pack-149' => 'icon-outline-vector-icons-pack-149'),array('wicon icon-outline-vector-icons-pack-150' => 'icon-outline-vector-icons-pack-150'),array('wicon icon-outline-vector-icons-pack-157' => 'icon-outline-vector-icons-pack-157'),array('wicon icon-outline-vector-icons-pack-158' => 'icon-outline-vector-icons-pack-158'),array('wicon icon-outline-vector-icons-pack-159' => 'icon-outline-vector-icons-pack-159'),array('wicon icon-outline-vector-icons-pack-160' => 'icon-outline-vector-icons-pack-160'),array('wicon icon-outline-vector-icons-pack-161' => 'icon-outline-vector-icons-pack-161'),array('wicon icon-outline-vector-icons-pack-162' => 'icon-outline-vector-icons-pack-162'),array('wicon icon-outline-vector-icons-pack-163' => 'icon-outline-vector-icons-pack-163'),array('wicon icon-outline-vector-icons-pack-8' => 'icon-outline-vector-icons-pack-8'),array('wicon icon-outline-vector-icons-pack-9' => 'icon-outline-vector-icons-pack-9'),array('wicon icon-outline-vector-icons-pack-10' => 'icon-outline-vector-icons-pack-10'),array('wicon icon-outline-vector-icons-pack-11' => 'icon-outline-vector-icons-pack-11'),array('wicon icon-outline-vector-icons-pack-12' => 'icon-outline-vector-icons-pack-12'),array('wicon icon-outline-vector-icons-pack-13' => 'icon-outline-vector-icons-pack-13'),array('wicon icon-outline-vector-icons-pack-21' => 'icon-outline-vector-icons-pack-21'),array('wicon icon-outline-vector-icons-pack-22' => 'icon-outline-vector-icons-pack-22'),array('wicon icon-outline-vector-icons-pack-23' => 'icon-outline-vector-icons-pack-23'),array('wicon icon-outline-vector-icons-pack-24' => 'icon-outline-vector-icons-pack-24'),array('wicon icon-outline-vector-icons-pack-25' => 'icon-outline-vector-icons-pack-25'),array('wicon icon-outline-vector-icons-pack-26' => 'icon-outline-vector-icons-pack-26'),array('wicon icon-outline-vector-icons-pack-34' => 'icon-outline-vector-icons-pack-34'),array('wicon icon-outline-vector-icons-pack-35' => 'icon-outline-vector-icons-pack-35'),array('wicon icon-outline-vector-icons-pack-36' => 'icon-outline-vector-icons-pack-36'),array('wicon icon-outline-vector-icons-pack-37' => 'icon-outline-vector-icons-pack-37'),array('wicon icon-outline-vector-icons-pack-38' => 'icon-outline-vector-icons-pack-38'),array('wicon icon-outline-vector-icons-pack-39' => 'icon-outline-vector-icons-pack-39'),array('wicon icon-outline-vector-icons-pack-47' => 'icon-outline-vector-icons-pack-47'),array('wicon icon-outline-vector-icons-pack-48' => 'icon-outline-vector-icons-pack-48'),array('wicon icon-outline-vector-icons-pack-49' => 'icon-outline-vector-icons-pack-49'),array('wicon icon-outline-vector-icons-pack-50' => 'icon-outline-vector-icons-pack-50'),array('wicon icon-outline-vector-icons-pack-51' => 'icon-outline-vector-icons-pack-51'),array('wicon icon-outline-vector-icons-pack-52' => 'icon-outline-vector-icons-pack-52'),array('wicon icon-outline-vector-icons-pack-60' => 'icon-outline-vector-icons-pack-60'),array('wicon icon-outline-vector-icons-pack-61' => 'icon-outline-vector-icons-pack-61'),array('wicon icon-outline-vector-icons-pack-62' => 'icon-outline-vector-icons-pack-62'),array('wicon icon-outline-vector-icons-pack-63' => 'icon-outline-vector-icons-pack-63'),array('wicon icon-outline-vector-icons-pack-64' => 'icon-outline-vector-icons-pack-64'),array('wicon icon-outline-vector-icons-pack-65' => 'icon-outline-vector-icons-pack-65'),array('wicon icon-outline-vector-icons-pack-73' => 'icon-outline-vector-icons-pack-73'),array('wicon icon-outline-vector-icons-pack-74' => 'icon-outline-vector-icons-pack-74'),array('wicon icon-outline-vector-icons-pack-75' => 'icon-outline-vector-icons-pack-75'),array('wicon icon-outline-vector-icons-pack-76' => 'icon-outline-vector-icons-pack-76'),array('wicon icon-outline-vector-icons-pack-77' => 'icon-outline-vector-icons-pack-77'),array('wicon icon-outline-vector-icons-pack-78' => 'icon-outline-vector-icons-pack-78'),array('wicon icon-outline-vector-icons-pack-86' => 'icon-outline-vector-icons-pack-86'),array('wicon icon-outline-vector-icons-pack-87' => 'icon-outline-vector-icons-pack-87'),array('wicon icon-outline-vector-icons-pack-88' => 'icon-outline-vector-icons-pack-88'),array('wicon icon-outline-vector-icons-pack-89' => 'icon-outline-vector-icons-pack-89'),array('wicon icon-outline-vector-icons-pack-90' => 'icon-outline-vector-icons-pack-90'),array('wicon icon-outline-vector-icons-pack-91' => 'icon-outline-vector-icons-pack-91'),array('wicon icon-outline-vector-icons-pack-99' => 'icon-outline-vector-icons-pack-99'),array('wicon icon-outline-vector-icons-pack-100' => 'icon-outline-vector-icons-pack-100'),array('wicon icon-outline-vector-icons-pack-101' => 'icon-outline-vector-icons-pack-101'),array('wicon icon-outline-vector-icons-pack-102' => 'icon-outline-vector-icons-pack-102'),array('wicon icon-outline-vector-icons-pack-103' => 'icon-outline-vector-icons-pack-103'),array('wicon icon-outline-vector-icons-pack-104' => 'icon-outline-vector-icons-pack-104'),array('wicon icon-outline-vector-icons-pack-112' => 'icon-outline-vector-icons-pack-112'),array('wicon icon-outline-vector-icons-pack-113' => 'icon-outline-vector-icons-pack-113'),array('wicon icon-outline-vector-icons-pack-114' => 'icon-outline-vector-icons-pack-114'),array('wicon icon-outline-vector-icons-pack-115' => 'icon-outline-vector-icons-pack-115'),array('wicon icon-outline-vector-icons-pack-116' => 'icon-outline-vector-icons-pack-116'),array('wicon icon-outline-vector-icons-pack-117' => 'icon-outline-vector-icons-pack-117'),array('wicon icon-outline-vector-icons-pack-125' => 'icon-outline-vector-icons-pack-125'),array('wicon icon-outline-vector-icons-pack-126' => 'icon-outline-vector-icons-pack-126'),array('wicon icon-outline-vector-icons-pack-127' => 'icon-outline-vector-icons-pack-127'),array('wicon icon-outline-vector-icons-pack-128' => 'icon-outline-vector-icons-pack-128'),array('wicon icon-outline-vector-icons-pack-129' => 'icon-outline-vector-icons-pack-129'),array('wicon icon-outline-vector-icons-pack-130' => 'icon-outline-vector-icons-pack-130'),array('wicon icon-outline-vector-icons-pack-138' => 'icon-outline-vector-icons-pack-138'),array('wicon icon-outline-vector-icons-pack-139' => 'icon-outline-vector-icons-pack-139'),array('wicon icon-outline-vector-icons-pack-140' => 'icon-outline-vector-icons-pack-140'),array('wicon icon-outline-vector-icons-pack-141' => 'icon-outline-vector-icons-pack-141'),array('wicon icon-outline-vector-icons-pack-142' => 'icon-outline-vector-icons-pack-142'),array('wicon icon-outline-vector-icons-pack-143' => 'icon-outline-vector-icons-pack-143'),array('wicon icon-outline-vector-icons-pack-151' => 'icon-outline-vector-icons-pack-151'),array('wicon icon-outline-vector-icons-pack-152' => 'icon-outline-vector-icons-pack-152'),array('wicon icon-outline-vector-icons-pack-153' => 'icon-outline-vector-icons-pack-153'),array('wicon icon-outline-vector-icons-pack-154' => 'icon-outline-vector-icons-pack-154'),array('wicon icon-outline-vector-icons-pack-155' => 'icon-outline-vector-icons-pack-155'),array('wicon icon-outline-vector-icons-pack-156' => 'icon-outline-vector-icons-pack-156'),array('wicon icon-outline-vector-icons-pack-164' => 'icon-outline-vector-icons-pack-164'),array('wicon icon-outline-vector-icons-pack-165' => 'icon-outline-vector-icons-pack-165'),array('wicon icon-outline-vector-icons-pack-166' => 'icon-outline-vector-icons-pack-166'),array('wicon icon-outline-vector-icons-pack-167' => 'icon-outline-vector-icons-pack-167'),array('wicon icon-outline-vector-icons-pack-168' => 'icon-outline-vector-icons-pack-168'),array('wicon icon-indians-icons-02' => 'icon-indians-icons-02'),array('wicon icon-indians-icons-03' => 'icon-indians-icons-03'),array('wicon icon-indians-icons-04' => 'icon-indians-icons-04'),array('wicon icon-indians-icons-05' => 'icon-indians-icons-05'),array('wicon icon-indians-icons-06' => 'icon-indians-icons-06'),array('wicon icon-indians-icons-07' => 'icon-indians-icons-07'),array('wicon icon-indians-icons-08' => 'icon-indians-icons-08'),array('wicon icon-indians-icons-09' => 'icon-indians-icons-09'),array('wicon icon-wolverine-logo-01' => 'icon-wolverine-logo-01'),array('wicon icon-wolverine-logo-02' => 'icon-wolverine-logo-02'),array('wicon icon-wolverine-logo-03' => 'icon-wolverine-logo-03'),array('wicon icon-wolverine-logo-04' => 'icon-wolverine-logo-04'),array('wicon icon-wolverine-logo-05' => 'icon-wolverine-logo-05'),array('wicon icon-wolverine-logo-06' => 'icon-wolverine-logo-06'),array('wicon icon-wolverine-logo-08' => 'icon-wolverine-logo-08'),array('wicon icon-wolverine-logo-09' => 'icon-wolverine-logo-09'),array('wicon icon-wolverine-logo-10' => 'icon-wolverine-logo-10'),array('wicon icon-address' => 'icon-address'),array('wicon icon-adjust' => 'icon-adjust'),array('wicon icon-air' => 'icon-air'),array('wicon icon-alert' => 'icon-alert'),array('wicon icon-archive' => 'icon-archive'),array('wicon icon-arrow-combo' => 'icon-arrow-combo'),array('wicon icon-arrows-ccw' => 'icon-arrows-ccw'),array('wicon icon-attach' => 'icon-attach'),array('wicon icon-attention' => 'icon-attention'),array('wicon icon-back' => 'icon-back'),array('wicon icon-back-in-time' => 'icon-back-in-time'),array('wicon icon-bag' => 'icon-bag'),array('wicon icon-basket' => 'icon-basket'),array('wicon icon-battery' => 'icon-battery'),array('wicon icon-behance' => 'icon-behance'),array('wicon icon-bell' => 'icon-bell'),array('wicon icon-block' => 'icon-block'),array('wicon icon-book' => 'icon-book'),array('wicon icon-book-open' => 'icon-book-open'),array('wicon icon-bookmark' => 'icon-bookmark'),array('wicon icon-bookmarks' => 'icon-bookmarks'),array('wicon icon-box' => 'icon-box'),array('wicon icon-briefcase' => 'icon-briefcase'),array('wicon icon-brush' => 'icon-brush'),array('wicon icon-bucket' => 'icon-bucket'),array('wicon icon-calendar' => 'icon-calendar'),array('wicon icon-camera' => 'icon-camera'),array('wicon icon-cancel' => 'icon-cancel'),array('wicon icon-cancel-circled' => 'icon-cancel-circled'),array('wicon icon-cancel-squared' => 'icon-cancel-squared'),array('wicon icon-cc' => 'icon-cc'),array('wicon icon-cc-by' => 'icon-cc-by'),array('wicon icon-cc-nc' => 'icon-cc-nc'),array('wicon icon-cc-nc-eu' => 'icon-cc-nc-eu'),array('wicon icon-cc-nc-jp' => 'icon-cc-nc-jp'),array('wicon icon-cc-nd' => 'icon-cc-nd'),array('wicon icon-cc-pd' => 'icon-cc-pd'),array('wicon icon-cc-remix' => 'icon-cc-remix'),array('wicon icon-cc-sa' => 'icon-cc-sa'),array('wicon icon-cc-share' => 'icon-cc-share'),array('wicon icon-cc-zero' => 'icon-cc-zero'),array('wicon icon-ccw' => 'icon-ccw'),array('wicon icon-cd' => 'icon-cd'),array('wicon icon-chart-area' => 'icon-chart-area'),array('wicon icon-chart-bar' => 'icon-chart-bar'),array('wicon icon-chart-line' => 'icon-chart-line'),array('wicon icon-chart-pie' => 'icon-chart-pie'),array('wicon icon-chat' => 'icon-chat'),array('wicon icon-check' => 'icon-check'),array('wicon icon-clipboard' => 'icon-clipboard'),array('wicon icon-clock' => 'icon-clock'),array('wicon icon-cloud' => 'icon-cloud'),array('wicon icon-cloud-thunder' => 'icon-cloud-thunder'),array('wicon icon-code' => 'icon-code'),array('wicon icon-cog' => 'icon-cog'),array('wicon icon-comment' => 'icon-comment'),array('wicon icon-compass' => 'icon-compass'),array('wicon icon-credit-card' => 'icon-credit-card'),array('wicon icon-cup' => 'icon-cup'),array('wicon icon-cw' => 'icon-cw'),array('wicon icon-database' => 'icon-database'),array('wicon icon-db-shape' => 'icon-db-shape'),array('wicon icon-direction' => 'icon-direction'),array('wicon icon-doc' => 'icon-doc'),array('wicon icon-doc-landscape' => 'icon-doc-landscape'),array('wicon icon-doc-text' => 'icon-doc-text'),array('wicon icon-doc-text-inv' => 'icon-doc-text-inv'),array('wicon icon-docs' => 'icon-docs'),array('wicon icon-dot' => 'icon-dot'),array('wicon icon-dot-2' => 'icon-dot-2'),array('wicon icon-dot-3' => 'icon-dot-3'),array('wicon icon-down' => 'icon-down'),array('wicon icon-down-bold' => 'icon-down-bold'),array('wicon icon-down-circled' => 'icon-down-circled'),array('wicon icon-down-dir' => 'icon-down-dir'),array('wicon icon-down-open' => 'icon-down-open'),array('wicon icon-down-open-big' => 'icon-down-open-big'),array('wicon icon-down-open-mini' => 'icon-down-open-mini'),array('wicon icon-down-thin' => 'icon-down-thin'),array('wicon icon-download' => 'icon-download'),array('wicon icon-dribbble' => 'icon-dribbble'),array('wicon icon-dribbble-circled' => 'icon-dribbble-circled'),array('wicon icon-drive' => 'icon-drive'),array('wicon icon-dropbox' => 'icon-dropbox'),array('wicon icon-droplet' => 'icon-droplet'),array('wicon icon-erase' => 'icon-erase'),array('wicon icon-evernote' => 'icon-evernote'),array('wicon icon-export' => 'icon-export'),array('wicon icon-eye' => 'icon-eye'),array('wicon icon-facebook' => 'icon-facebook'),array('wicon icon-facebook-circled' => 'icon-facebook-circled'),array('wicon icon-facebook-squared' => 'icon-facebook-squared'),array('wicon icon-fast-backward' => 'icon-fast-backward'),array('wicon icon-fast-forward' => 'icon-fast-forward'),array('wicon icon-feather' => 'icon-feather'),array('wicon icon-flag' => 'icon-flag'),array('wicon icon-flash' => 'icon-flash'),array('wicon icon-flashlight' => 'icon-flashlight'),array('wicon icon-flattr' => 'icon-flattr'),array('wicon icon-flickr' => 'icon-flickr'),array('wicon icon-flickr-circled' => 'icon-flickr-circled'),array('wicon icon-flight' => 'icon-flight'),array('wicon icon-floppy' => 'icon-floppy'),array('wicon icon-flow-branch' => 'icon-flow-branch'),array('wicon icon-flow-cascade' => 'icon-flow-cascade'),array('wicon icon-flow-line' => 'icon-flow-line'),array('wicon icon-flow-parallel' => 'icon-flow-parallel'),array('wicon icon-flow-tree' => 'icon-flow-tree'),array('wicon icon-folder' => 'icon-folder'),array('wicon icon-forward' => 'icon-forward'),array('wicon icon-gauge' => 'icon-gauge'),array('wicon icon-github' => 'icon-github'),array('wicon icon-github-circled' => 'icon-github-circled'),array('wicon icon-globe' => 'icon-globe'),array('wicon icon-google-circles' => 'icon-google-circles'),array('wicon icon-gplus' => 'icon-gplus'),array('wicon icon-gplus-circled' => 'icon-gplus-circled'),array('wicon icon-graduation-cap' => 'icon-graduation-cap'),array('wicon icon-heart' => 'icon-heart'),array('wicon icon-heart-empty' => 'icon-heart-empty'),array('wicon icon-help' => 'icon-help'),array('wicon icon-help-circled' => 'icon-help-circled'),array('wicon icon-home' => 'icon-home'),array('wicon icon-hourglass' => 'icon-hourglass'),array('wicon icon-inbox' => 'icon-inbox'),array('wicon icon-infinity' => 'icon-infinity'),array('wicon icon-info' => 'icon-info'),array('wicon icon-info-circled' => 'icon-info-circled'),array('wicon icon-instagrem' => 'icon-instagrem'),array('wicon icon-install' => 'icon-install'),array('wicon icon-key' => 'icon-key'),array('wicon icon-keyboard' => 'icon-keyboard'),array('wicon icon-lamp' => 'icon-lamp'),array('wicon icon-language' => 'icon-language'),array('wicon icon-lastfm' => 'icon-lastfm'),array('wicon icon-lastfm-circled' => 'icon-lastfm-circled'),array('wicon icon-layout' => 'icon-layout'),array('wicon icon-leaf' => 'icon-leaf'),array('wicon icon-left' => 'icon-left'),array('wicon icon-left-bold' => 'icon-left-bold'),array('wicon icon-left-circled' => 'icon-left-circled'),array('wicon icon-left-dir' => 'icon-left-dir'),array('wicon icon-left-open' => 'icon-left-open'),array('wicon icon-left-open-big' => 'icon-left-open-big'),array('wicon icon-left-open-mini' => 'icon-left-open-mini'),array('wicon icon-left-thin' => 'icon-left-thin'),array('wicon icon-level-down' => 'icon-level-down'),array('wicon icon-level-up' => 'icon-level-up'),array('wicon icon-lifebuoy' => 'icon-lifebuoy'),array('wicon icon-light-down' => 'icon-light-down'),array('wicon icon-light-up' => 'icon-light-up'),array('wicon icon-link' => 'icon-link'),array('wicon icon-linkedin' => 'icon-linkedin'),array('wicon icon-linkedin-circled' => 'icon-linkedin-circled'),array('wicon icon-list' => 'icon-list'),array('wicon icon-list-add' => 'icon-list-add'),array('wicon icon-location' => 'icon-location'),array('wicon icon-lock' => 'icon-lock'),array('wicon icon-lock-open' => 'icon-lock-open'),array('wicon icon-login' => 'icon-login'),array('wicon icon-logo-db' => 'icon-logo-db'),array('wicon icon-logout' => 'icon-logout'),array('wicon icon-loop' => 'icon-loop'),array('wicon icon-magnet' => 'icon-magnet'),array('wicon icon-mail' => 'icon-mail'),array('wicon icon-map' => 'icon-map'),array('wicon icon-megaphone' => 'icon-megaphone'),array('wicon icon-menu' => 'icon-menu'),array('wicon icon-mic' => 'icon-mic'),array('wicon icon-minus' => 'icon-minus'),array('wicon icon-minus-circled' => 'icon-minus-circled'),array('wicon icon-minus-squared' => 'icon-minus-squared'),array('wicon icon-mixi' => 'icon-mixi'),array('wicon icon-mobile' => 'icon-mobile'),array('wicon icon-monitor' => 'icon-monitor'),array('wicon icon-moon' => 'icon-moon'),array('wicon icon-mouse' => 'icon-mouse'),array('wicon icon-music' => 'icon-music'),array('wicon icon-mute' => 'icon-mute'),array('wicon icon-network' => 'icon-network'),array('wicon icon-newspaper' => 'icon-newspaper'),array('wicon icon-note' => 'icon-note'),array('wicon icon-note-beamed' => 'icon-note-beamed'),array('wicon icon-palette' => 'icon-palette'),array('wicon icon-paper-plane' => 'icon-paper-plane'),array('wicon icon-pause' => 'icon-pause'),array('wicon icon-paypal' => 'icon-paypal'),array('wicon icon-pencil' => 'icon-pencil'),array('wicon icon-phone' => 'icon-phone'),array('wicon icon-picasa' => 'icon-picasa'),array('wicon icon-picture' => 'icon-picture'),array('wicon icon-pinterest' => 'icon-pinterest'),array('wicon icon-pinterest-circled' => 'icon-pinterest-circled'),array('wicon icon-play' => 'icon-play'),array('wicon icon-plus' => 'icon-plus'),array('wicon icon-plus-circled' => 'icon-plus-circled'),array('wicon icon-plus-squared' => 'icon-plus-squared'),array('wicon icon-popup' => 'icon-popup'),array('wicon icon-print' => 'icon-print'),array('wicon icon-progress-0' => 'icon-progress-0'),array('wicon icon-progress-1' => 'icon-progress-1'),array('wicon icon-progress-2' => 'icon-progress-2'),array('wicon icon-progress-3' => 'icon-progress-3'),array('wicon icon-publish' => 'icon-publish'),array('wicon icon-qq' => 'icon-qq'),array('wicon icon-quote' => 'icon-quote'),array('wicon icon-rdio' => 'icon-rdio'),array('wicon icon-rdio-circled' => 'icon-rdio-circled'),array('wicon icon-record' => 'icon-record'),array('wicon icon-renren' => 'icon-renren'),array('wicon icon-reply' => 'icon-reply'),array('wicon icon-reply-all' => 'icon-reply-all'),array('wicon icon-resize-full' => 'icon-resize-full'),array('wicon icon-resize-small' => 'icon-resize-small'),array('wicon icon-retweet' => 'icon-retweet'),array('wicon icon-right' => 'icon-right'),array('wicon icon-right-bold' => 'icon-right-bold'),array('wicon icon-right-circled' => 'icon-right-circled'),array('wicon icon-right-dir' => 'icon-right-dir'),array('wicon icon-right-open' => 'icon-right-open'),array('wicon icon-right-open-big' => 'icon-right-open-big'),array('wicon icon-right-open-mini' => 'icon-right-open-mini'),array('wicon icon-right-thin' => 'icon-right-thin'),array('wicon icon-rocket' => 'icon-rocket'),array('wicon icon-rss' => 'icon-rss'),array('wicon icon-search' => 'icon-search'),array('wicon icon-share' => 'icon-share'),array('wicon icon-shareable' => 'icon-shareable'),array('wicon icon-shuffle' => 'icon-shuffle'),array('wicon icon-signal' => 'icon-signal'),array('wicon icon-sina-weibo' => 'icon-sina-weibo'),array('wicon icon-skype' => 'icon-skype'),array('wicon icon-skype-circled' => 'icon-skype-circled'),array('wicon icon-smashing' => 'icon-smashing'),array('wicon icon-sound' => 'icon-sound'),array('wicon icon-soundcloud' => 'icon-soundcloud'),array('wicon icon-spotify' => 'icon-spotify'),array('wicon icon-spotify-circled' => 'icon-spotify-circled'),array('wicon icon-star' => 'icon-star'),array('wicon icon-star-empty' => 'icon-star-empty'),array('wicon icon-stop' => 'icon-stop'),array('wicon icon-stumbleupon' => 'icon-stumbleupon'),array('wicon icon-stumbleupon-circled' => 'icon-stumbleupon-circled'),array('wicon icon-suitcase' => 'icon-suitcase'),array('wicon icon-sweden' => 'icon-sweden'),array('wicon icon-switch' => 'icon-switch'),array('wicon icon-tag' => 'icon-tag'),array('wicon icon-tape' => 'icon-tape'),array('wicon icon-target' => 'icon-target'),array('wicon icon-thermometer' => 'icon-thermometer'),array('wicon icon-thumbs-down' => 'icon-thumbs-down'),array('wicon icon-thumbs-up' => 'icon-thumbs-up'),array('wicon icon-ticket' => 'icon-ticket'),array('wicon icon-to-end' => 'icon-to-end'),array('wicon icon-to-start' => 'icon-to-start'),array('wicon icon-tools' => 'icon-tools'),array('wicon icon-traffic-cone' => 'icon-traffic-cone'),array('wicon icon-trash' => 'icon-trash'),array('wicon icon-trophy' => 'icon-trophy'),array('wicon icon-tumblr' => 'icon-tumblr'),array('wicon icon-tumblr-circled' => 'icon-tumblr-circled'),array('wicon icon-twitter' => 'icon-twitter'),array('wicon icon-twitter-circled' => 'icon-twitter-circled'),array('wicon icon-up' => 'icon-up'),array('wicon icon-up-bold' => 'icon-up-bold'),array('wicon icon-up-circled' => 'icon-up-circled'),array('wicon icon-up-dir' => 'icon-up-dir'),array('wicon icon-up-open' => 'icon-up-open'),array('wicon icon-up-open-big' => 'icon-up-open-big'),array('wicon icon-up-open-mini' => 'icon-up-open-mini'),array('wicon icon-up-thin' => 'icon-up-thin'),array('wicon icon-upload' => 'icon-upload'),array('wicon icon-upload-cloud' => 'icon-upload-cloud'),array('wicon icon-user' => 'icon-user'),array('wicon icon-user-add' => 'icon-user-add'),array('wicon icon-users' => 'icon-users'),array('wicon icon-vcard' => 'icon-vcard'),array('wicon icon-video' => 'icon-video'),array('wicon icon-vimeo' => 'icon-vimeo'),array('wicon icon-vimeo-circled' => 'icon-vimeo-circled'),array('wicon icon-vkontakte' => 'icon-vkontakte'),array('wicon icon-volume' => 'icon-volume'),array('wicon icon-water' => 'icon-water'),array('wicon icon-window' => 'icon-window'),array('wicon icon-wolverine-logo-07' => 'icon-wolverine-logo-07'),array('wicon icon-key21' => 'icon-key21'),array('wicon icon-password1' => 'icon-password1'),array('wicon icon-user14' => 'icon-user14'),array('wicon icon-shopping111' => 'icon-shopping111'),array('wicon icon-icon-search' => 'icon-icon-search'),array('wicon icon-arrow413' => 'icon-arrow413'),array('wicon icon-arrow427' => 'icon-arrow427'),array('wicon icon-wrong6' => 'icon-wrong6'),array('wicon icon-icon-opened29' => 'icon-icon-opened29'),array('wicon icon-icon-opened29-1' => 'icon-icon-opened29-1'),array('wicon icon-dark37' => 'icon-dark37'),array('wicon icon-dark37-1' => 'icon-dark37-1'),array('wicon icon-list23' => 'icon-list23'),array('wicon icon-menu27' => 'icon-menu27'),array('wicon icon-menu45' => 'icon-menu45'),array('wicon icon-menu53' => 'icon-menu53'),array('wicon icon-menu55' => 'icon-menu55'),array('wicon icon-list23-1' => 'icon-list23-1'),array('wicon icon-wrong6-1' => 'icon-wrong6-1'),array('wicon icon-previous11' => 'icon-previous11'),array('wicon icon-thin36' => 'icon-thin36'),array('wicon icon-thin35' => 'icon-thin35'),array('wicon icon-up77' => 'icon-up77'),array('wicon icon-right106' => 'icon-right106'),array('wicon icon-next15' => 'icon-next15'),array('wicon icon-collapse3' => 'icon-collapse3'),array('wicon icon-expand22' => 'icon-expand22'),array('wicon icon-play43' => 'icon-play43'),array('wicon icon-search-icon' => 'icon-search-icon'),array('wicon icon-cart-icon' => 'icon-cart-icon'),array('wicon icon-minus-1' => 'icon-minus-1'),array('wicon icon-plus-1' => 'icon-plus-1'),array('wicon icon-185100-caddie-shop-shopping-streamline' => 'icon-185100-caddie-shop-shopping-streamline'),array('wicon icon-185101-caddie-shopping-streamline' => 'icon-185101-caddie-shopping-streamline'),array('wicon icon-ecommerce-bag' => 'icon-ecommerce-bag'),array('wicon icon-ecommerce-bag-check' => 'icon-ecommerce-bag-check'),array('wicon icon-ecommerce-bag-cloud' => 'icon-ecommerce-bag-cloud'),array('wicon icon-ecommerce-bag-download' => 'icon-ecommerce-bag-download'),array('wicon icon-ecommerce-bag-minus' => 'icon-ecommerce-bag-minus'),array('wicon icon-ecommerce-bag-plus' => 'icon-ecommerce-bag-plus'),array('wicon icon-ecommerce-bag-refresh' => 'icon-ecommerce-bag-refresh'),array('wicon icon-ecommerce-bag-remove' => 'icon-ecommerce-bag-remove'),array('wicon icon-ecommerce-bag-search' => 'icon-ecommerce-bag-search'),array('wicon icon-ecommerce-bag-upload' => 'icon-ecommerce-bag-upload'),array('wicon icon-svg-icon-02' => 'icon-svg-icon-02'),array('wicon icon-svg-icon-03' => 'icon-svg-icon-03'),array('wicon icon-svg-icon-04' => 'icon-svg-icon-04'),array('wicon icon-svg-icon-05' => 'icon-svg-icon-05'),array('wicon icon-svg-icon-06' => 'icon-svg-icon-06'),array('wicon icon-svg-icon-07' => 'icon-svg-icon-07'),array('wicon icon-svg-icon-08' => 'icon-svg-icon-08'),array('wicon icon-svg-icon-09' => 'icon-svg-icon-09'),array('wicon icon-svg-icon-10' => 'icon-svg-icon-10'),array('wicon icon-svg-icon-11' => 'icon-svg-icon-11'),array('wicon icon-svg-icon-12' => 'icon-svg-icon-12'),array('wicon icon-svg-icon-13' => 'icon-svg-icon-13'),array('wicon icon-svg-icon-14' => 'icon-svg-icon-14'),array('wicon icon-svg-icon-15' => 'icon-svg-icon-15'),array('wicon icon-svg-icon-16' => 'icon-svg-icon-16'),array('wicon icon-svg-icon-17' => 'icon-svg-icon-17'),array('wicon icon-svg-icon-18' => 'icon-svg-icon-18'),
		);
		vc_add_param('vc_tta_accordion',array(
				'type' => 'dropdown',
				'param_name' => 'style',
				'value' => array(
					__( 'style 1', 'wolverine' ) => 'style1',
					__( 'style 2', 'wolverine' ) => 'style2',
					__( 'style 3', 'wolverine' ) => 'style3',
					__( 'style 4', 'wolverine' ) => 'style4',
					__( 'Classic', 'wolverine' ) => 'classic',
					__( 'Modern', 'wolverine' ) => 'modern',
					__( 'Flat', 'wolverine' ) => 'flat',
					__( 'Outline', 'wolverine' ) => 'outline',
				),
				'heading' => __( 'Style', 'wolverine' ),
				'description' => __( 'Select accordion display style.', 'wolverine' ),
				'weight' => 1,
			)
		);
		vc_add_param('vc_tta_tabs',array(
				'type' => 'dropdown',
				'param_name' => 'style',
				'value' => array(
					__( 'style 1', 'wolverine' ) => 'style1',
					__( 'style 2', 'wolverine' ) => 'style2',
					__( 'style 3', 'wolverine' ) => 'style3',
					__( 'Classic', 'wolverine' ) => 'classic',
					__( 'Modern', 'wolverine' ) => 'modern',
					__( 'Flat', 'wolverine' ) => 'flat',
					__( 'Outline', 'wolverine' ) => 'outline',
				),
				'heading' => __( 'Style', 'wolverine' ),
				'description' => __( 'Select accordion display style.', 'wolverine' ),
				'weight' => 1,
			)
		);
		vc_remove_param('vc_icon', 'type' );
		vc_add_param('vc_icon', array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'wolverine' ),
				'value' => array(
					__( 'Wolverine', 'wolverine') => 'wolverine',
					__( 'Font Awesome', 'wolverine' ) => 'fontawesome',
					__( 'Open Iconic', 'wolverine' ) => 'openiconic',
					__( 'Typicons', 'wolverine' ) => 'typicons',
					__( 'Entypo', 'wolverine' ) => 'entypo',
					__( 'Linecons', 'wolverine' ) => 'linecons',
				),
				'admin_label' => true,
				'weight'=>2,
				'param_name' => 'type',
				'description' => __( 'Select icon library.', 'wolverine' ),
			)
		);
		vc_add_param('vc_icon', array(
				'type' => 'iconpicker',
				'heading' => __('Icon', 'wolverine'),
				'param_name' => 'icon_wolverine',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					'type' => 'wolverine',
					'source' => $wolverine_icons,
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'wolverine',
				),
				'weight'=>1,
				'description' => __('Select icon from library.', 'wolverine'),
			)
		);

		vc_add_param('vc_progress_bar',array(
				'type'        => 'dropdown',
				'heading'     => __( 'Layout Style', 'wolverine' ),
				'param_name'  => 'layout_style',
				'admin_label' => true,
				'value'       => array( __( 'style 1', 'wolverine' ) => 'style1', __( 'style 2', 'wolverine' ) => 'style2', __( 'style 3', 'wolverine' ) => 'style3'),
				'description' => __( 'Select Layout Style.', 'wolverine' ),
				'weight' => 1
			)
		);
		$settings_vc_map = array (
			'category' => array( __( 'Content', 'wolverine' ),__( 'Wolverine Shortcodes', 'wolverine' ))
		);
		vc_map_update( 'vc_tta_tabs', $settings_vc_map );
		vc_map_update( 'vc_tta_accordion', $settings_vc_map );
		vc_map_update( 'vc_progress_bar', $settings_vc_map );
	}
}
add_action('vc_after_init','g5plus_add_vc_param');

function g5plus_register_vc_map()
{
	$add_css_animation = array(
		'type' => 'dropdown',
		'heading' => __('CSS Animation', 'wolverine'),
		'param_name' => 'css_animation',
		'value' => array(__('No','wolverine') => '',__('Fade In','wolverine') => 'wpb_fadeIn',__('Fade Top to Bottom','wolverine') => 'wpb_fadeInDown', __('Fade Bottom to Top','wolverine') => 'wpb_fadeInUp', __('Fade Left to Right','wolverine') => 'wpb_fadeInLeft', __('Fade Right to Left','wolverine') => 'wpb_fadeInRight', __('Bounce In','wolverine') => 'wpb_bounceIn',__('Bounce Top to Bottom','wolverine') => 'wpb_bounceInDown',__('Bounce Bottom to Top','wolverine') => 'wpb_bounceInUp', __('Bounce Left to Right','wolverine') => 'wpb_bounceInLeft', __('Bounce Right to Left','wolverine') => 'wpb_bounceInRight', __('Zoom In','wolverine') => 'wpb_zoomIn', __('Flip Vertical','wolverine') => 'wpb_flipInX',__('Flip Horizontal','wolverine') => 'wpb_flipInY', __('Bounce','wolverine') => 'wpb_bounce', __('Flash','wolverine') => 'wpb_flash',__('Shake','wolverine') => 'wpb_shake',__( 'Pulse','wolverine') => 'wpb_pulse',__( 'Swing','wolverine') => 'wpb_swing', __('Rubber band','wolverine') => 'wpb_rubberBand', __('Wobble','wolverine') => 'wpb_wobble', __('Tada','wolverine') => 'wpb_tada'),
		'description' => __('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'wolverine'),
		'group' => __('Animation Settings', 'wolverine')
	);

	$add_duration_animation = array(
		'type' => 'textfield',
		'heading' => __('Animation Duration', 'wolverine'),
		'param_name' => 'duration',
		'value' => '',
		'description' => __('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'wolverine'),
		'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown','wpb_fadeInUp','wpb_fadeInLeft','wpb_fadeInRight','wpb_bounceIn','wpb_bounceInDown','wpb_bounceInUp','wpb_bounceInLeft','wpb_bounceInRight','wpb_zoomIn','wpb_flipInX','wpb_flipInY','wpb_bounce', 'wpb_flash', 'wpb_shake','wpb_pulse','wpb_swing','wpb_rubberBand','wpb_wobble','wpb_tada')),
		'group' => __('Animation Settings', 'wolverine')
	);

	$add_delay_animation = array(
		'type' => 'textfield',
		'heading' => __('Animation Delay', 'wolverine'),
		'param_name' => 'delay',
		'value' => '',
		'description' => __('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'wolverine'),
		'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown','wpb_fadeInUp','wpb_fadeInLeft','wpb_fadeInRight','wpb_bounceIn','wpb_bounceInDown','wpb_bounceInUp','wpb_bounceInLeft','wpb_bounceInRight','wpb_zoomIn','wpb_flipInX','wpb_flipInY','wpb_bounce', 'wpb_flash', 'wpb_shake','wpb_pulse','wpb_swing','wpb_rubberBand','wpb_wobble','wpb_tada')),
		'group' => __('Animation Settings', 'wolverine')
	);
	$wolverine_icons = array(
		array('wicon icon-outline-vector-icons-pack-1' => 'icon-outline-vector-icons-pack-1'),array('wicon icon-outline-vector-icons-pack-2' => 'icon-outline-vector-icons-pack-2'),array('wicon icon-outline-vector-icons-pack-3' => 'icon-outline-vector-icons-pack-3'),array('wicon icon-outline-vector-icons-pack-4' => 'icon-outline-vector-icons-pack-4'),array('wicon icon-outline-vector-icons-pack-5' => 'icon-outline-vector-icons-pack-5'),array('wicon icon-outline-vector-icons-pack-6' => 'icon-outline-vector-icons-pack-6'),array('wicon icon-outline-vector-icons-pack-7' => 'icon-outline-vector-icons-pack-7'),array('wicon icon-outline-vector-icons-pack-14' => 'icon-outline-vector-icons-pack-14'),array('wicon icon-outline-vector-icons-pack-15' => 'icon-outline-vector-icons-pack-15'),array('wicon icon-outline-vector-icons-pack-16' => 'icon-outline-vector-icons-pack-16'),array('wicon icon-outline-vector-icons-pack-17' => 'icon-outline-vector-icons-pack-17'),array('wicon icon-outline-vector-icons-pack-18' => 'icon-outline-vector-icons-pack-18'),array('wicon icon-outline-vector-icons-pack-19' => 'icon-outline-vector-icons-pack-19'),array('wicon icon-outline-vector-icons-pack-20' => 'icon-outline-vector-icons-pack-20'),array('wicon icon-outline-vector-icons-pack-27' => 'icon-outline-vector-icons-pack-27'),array('wicon icon-outline-vector-icons-pack-28' => 'icon-outline-vector-icons-pack-28'),array('wicon icon-outline-vector-icons-pack-29' => 'icon-outline-vector-icons-pack-29'),array('wicon icon-outline-vector-icons-pack-30' => 'icon-outline-vector-icons-pack-30'),array('wicon icon-outline-vector-icons-pack-31' => 'icon-outline-vector-icons-pack-31'),array('wicon icon-outline-vector-icons-pack-32' => 'icon-outline-vector-icons-pack-32'),array('wicon icon-outline-vector-icons-pack-33' => 'icon-outline-vector-icons-pack-33'),array('wicon icon-outline-vector-icons-pack-40' => 'icon-outline-vector-icons-pack-40'),array('wicon icon-outline-vector-icons-pack-41' => 'icon-outline-vector-icons-pack-41'),array('wicon icon-outline-vector-icons-pack-42' => 'icon-outline-vector-icons-pack-42'),array('wicon icon-outline-vector-icons-pack-43' => 'icon-outline-vector-icons-pack-43'),array('wicon icon-outline-vector-icons-pack-44' => 'icon-outline-vector-icons-pack-44'),array('wicon icon-outline-vector-icons-pack-45' => 'icon-outline-vector-icons-pack-45'),array('wicon icon-outline-vector-icons-pack-46' => 'icon-outline-vector-icons-pack-46'),array('wicon icon-outline-vector-icons-pack-53' => 'icon-outline-vector-icons-pack-53'),array('wicon icon-outline-vector-icons-pack-54' => 'icon-outline-vector-icons-pack-54'),array('wicon icon-outline-vector-icons-pack-55' => 'icon-outline-vector-icons-pack-55'),array('wicon icon-outline-vector-icons-pack-56' => 'icon-outline-vector-icons-pack-56'),array('wicon icon-outline-vector-icons-pack-57' => 'icon-outline-vector-icons-pack-57'),array('wicon icon-outline-vector-icons-pack-58' => 'icon-outline-vector-icons-pack-58'),array('wicon icon-outline-vector-icons-pack-59' => 'icon-outline-vector-icons-pack-59'),array('wicon icon-outline-vector-icons-pack-66' => 'icon-outline-vector-icons-pack-66'),array('wicon icon-outline-vector-icons-pack-67' => 'icon-outline-vector-icons-pack-67'),array('wicon icon-outline-vector-icons-pack-68' => 'icon-outline-vector-icons-pack-68'),array('wicon icon-outline-vector-icons-pack-69' => 'icon-outline-vector-icons-pack-69'),array('wicon icon-outline-vector-icons-pack-70' => 'icon-outline-vector-icons-pack-70'),array('wicon icon-outline-vector-icons-pack-71' => 'icon-outline-vector-icons-pack-71'),array('wicon icon-outline-vector-icons-pack-72' => 'icon-outline-vector-icons-pack-72'),array('wicon icon-outline-vector-icons-pack-79' => 'icon-outline-vector-icons-pack-79'),array('wicon icon-outline-vector-icons-pack-80' => 'icon-outline-vector-icons-pack-80'),array('wicon icon-outline-vector-icons-pack-81' => 'icon-outline-vector-icons-pack-81'),array('wicon icon-outline-vector-icons-pack-82' => 'icon-outline-vector-icons-pack-82'),array('wicon icon-outline-vector-icons-pack-83' => 'icon-outline-vector-icons-pack-83'),array('wicon icon-outline-vector-icons-pack-84' => 'icon-outline-vector-icons-pack-84'),array('wicon icon-outline-vector-icons-pack-85' => 'icon-outline-vector-icons-pack-85'),array('wicon icon-outline-vector-icons-pack-92' => 'icon-outline-vector-icons-pack-92'),array('wicon icon-outline-vector-icons-pack-93' => 'icon-outline-vector-icons-pack-93'),array('wicon icon-outline-vector-icons-pack-94' => 'icon-outline-vector-icons-pack-94'),array('wicon icon-outline-vector-icons-pack-95' => 'icon-outline-vector-icons-pack-95'),array('wicon icon-outline-vector-icons-pack-96' => 'icon-outline-vector-icons-pack-96'),array('wicon icon-outline-vector-icons-pack-97' => 'icon-outline-vector-icons-pack-97'),array('wicon icon-outline-vector-icons-pack-98' => 'icon-outline-vector-icons-pack-98'),array('wicon icon-outline-vector-icons-pack-105' => 'icon-outline-vector-icons-pack-105'),array('wicon icon-outline-vector-icons-pack-106' => 'icon-outline-vector-icons-pack-106'),array('wicon icon-outline-vector-icons-pack-107' => 'icon-outline-vector-icons-pack-107'),array('wicon icon-outline-vector-icons-pack-108' => 'icon-outline-vector-icons-pack-108'),array('wicon icon-outline-vector-icons-pack-109' => 'icon-outline-vector-icons-pack-109'),array('wicon icon-outline-vector-icons-pack-110' => 'icon-outline-vector-icons-pack-110'),array('wicon icon-outline-vector-icons-pack-111' => 'icon-outline-vector-icons-pack-111'),array('wicon icon-outline-vector-icons-pack-118' => 'icon-outline-vector-icons-pack-118'),array('wicon icon-outline-vector-icons-pack-119' => 'icon-outline-vector-icons-pack-119'),array('wicon icon-outline-vector-icons-pack-120' => 'icon-outline-vector-icons-pack-120'),array('wicon icon-outline-vector-icons-pack-121' => 'icon-outline-vector-icons-pack-121'),array('wicon icon-outline-vector-icons-pack-122' => 'icon-outline-vector-icons-pack-122'),array('wicon icon-outline-vector-icons-pack-123' => 'icon-outline-vector-icons-pack-123'),array('wicon icon-outline-vector-icons-pack-124' => 'icon-outline-vector-icons-pack-124'),array('wicon icon-outline-vector-icons-pack-131' => 'icon-outline-vector-icons-pack-131'),array('wicon icon-outline-vector-icons-pack-132' => 'icon-outline-vector-icons-pack-132'),array('wicon icon-outline-vector-icons-pack-133' => 'icon-outline-vector-icons-pack-133'),array('wicon icon-outline-vector-icons-pack-134' => 'icon-outline-vector-icons-pack-134'),array('wicon icon-outline-vector-icons-pack-135' => 'icon-outline-vector-icons-pack-135'),array('wicon icon-outline-vector-icons-pack-136' => 'icon-outline-vector-icons-pack-136'),array('wicon icon-outline-vector-icons-pack-137' => 'icon-outline-vector-icons-pack-137'),array('wicon icon-outline-vector-icons-pack-144' => 'icon-outline-vector-icons-pack-144'),array('wicon icon-outline-vector-icons-pack-145' => 'icon-outline-vector-icons-pack-145'),array('wicon icon-outline-vector-icons-pack-146' => 'icon-outline-vector-icons-pack-146'),array('wicon icon-outline-vector-icons-pack-147' => 'icon-outline-vector-icons-pack-147'),array('wicon icon-outline-vector-icons-pack-148' => 'icon-outline-vector-icons-pack-148'),array('wicon icon-outline-vector-icons-pack-149' => 'icon-outline-vector-icons-pack-149'),array('wicon icon-outline-vector-icons-pack-150' => 'icon-outline-vector-icons-pack-150'),array('wicon icon-outline-vector-icons-pack-157' => 'icon-outline-vector-icons-pack-157'),array('wicon icon-outline-vector-icons-pack-158' => 'icon-outline-vector-icons-pack-158'),array('wicon icon-outline-vector-icons-pack-159' => 'icon-outline-vector-icons-pack-159'),array('wicon icon-outline-vector-icons-pack-160' => 'icon-outline-vector-icons-pack-160'),array('wicon icon-outline-vector-icons-pack-161' => 'icon-outline-vector-icons-pack-161'),array('wicon icon-outline-vector-icons-pack-162' => 'icon-outline-vector-icons-pack-162'),array('wicon icon-outline-vector-icons-pack-163' => 'icon-outline-vector-icons-pack-163'),array('wicon icon-outline-vector-icons-pack-8' => 'icon-outline-vector-icons-pack-8'),array('wicon icon-outline-vector-icons-pack-9' => 'icon-outline-vector-icons-pack-9'),array('wicon icon-outline-vector-icons-pack-10' => 'icon-outline-vector-icons-pack-10'),array('wicon icon-outline-vector-icons-pack-11' => 'icon-outline-vector-icons-pack-11'),array('wicon icon-outline-vector-icons-pack-12' => 'icon-outline-vector-icons-pack-12'),array('wicon icon-outline-vector-icons-pack-13' => 'icon-outline-vector-icons-pack-13'),array('wicon icon-outline-vector-icons-pack-21' => 'icon-outline-vector-icons-pack-21'),array('wicon icon-outline-vector-icons-pack-22' => 'icon-outline-vector-icons-pack-22'),array('wicon icon-outline-vector-icons-pack-23' => 'icon-outline-vector-icons-pack-23'),array('wicon icon-outline-vector-icons-pack-24' => 'icon-outline-vector-icons-pack-24'),array('wicon icon-outline-vector-icons-pack-25' => 'icon-outline-vector-icons-pack-25'),array('wicon icon-outline-vector-icons-pack-26' => 'icon-outline-vector-icons-pack-26'),array('wicon icon-outline-vector-icons-pack-34' => 'icon-outline-vector-icons-pack-34'),array('wicon icon-outline-vector-icons-pack-35' => 'icon-outline-vector-icons-pack-35'),array('wicon icon-outline-vector-icons-pack-36' => 'icon-outline-vector-icons-pack-36'),array('wicon icon-outline-vector-icons-pack-37' => 'icon-outline-vector-icons-pack-37'),array('wicon icon-outline-vector-icons-pack-38' => 'icon-outline-vector-icons-pack-38'),array('wicon icon-outline-vector-icons-pack-39' => 'icon-outline-vector-icons-pack-39'),array('wicon icon-outline-vector-icons-pack-47' => 'icon-outline-vector-icons-pack-47'),array('wicon icon-outline-vector-icons-pack-48' => 'icon-outline-vector-icons-pack-48'),array('wicon icon-outline-vector-icons-pack-49' => 'icon-outline-vector-icons-pack-49'),array('wicon icon-outline-vector-icons-pack-50' => 'icon-outline-vector-icons-pack-50'),array('wicon icon-outline-vector-icons-pack-51' => 'icon-outline-vector-icons-pack-51'),array('wicon icon-outline-vector-icons-pack-52' => 'icon-outline-vector-icons-pack-52'),array('wicon icon-outline-vector-icons-pack-60' => 'icon-outline-vector-icons-pack-60'),array('wicon icon-outline-vector-icons-pack-61' => 'icon-outline-vector-icons-pack-61'),array('wicon icon-outline-vector-icons-pack-62' => 'icon-outline-vector-icons-pack-62'),array('wicon icon-outline-vector-icons-pack-63' => 'icon-outline-vector-icons-pack-63'),array('wicon icon-outline-vector-icons-pack-64' => 'icon-outline-vector-icons-pack-64'),array('wicon icon-outline-vector-icons-pack-65' => 'icon-outline-vector-icons-pack-65'),array('wicon icon-outline-vector-icons-pack-73' => 'icon-outline-vector-icons-pack-73'),array('wicon icon-outline-vector-icons-pack-74' => 'icon-outline-vector-icons-pack-74'),array('wicon icon-outline-vector-icons-pack-75' => 'icon-outline-vector-icons-pack-75'),array('wicon icon-outline-vector-icons-pack-76' => 'icon-outline-vector-icons-pack-76'),array('wicon icon-outline-vector-icons-pack-77' => 'icon-outline-vector-icons-pack-77'),array('wicon icon-outline-vector-icons-pack-78' => 'icon-outline-vector-icons-pack-78'),array('wicon icon-outline-vector-icons-pack-86' => 'icon-outline-vector-icons-pack-86'),array('wicon icon-outline-vector-icons-pack-87' => 'icon-outline-vector-icons-pack-87'),array('wicon icon-outline-vector-icons-pack-88' => 'icon-outline-vector-icons-pack-88'),array('wicon icon-outline-vector-icons-pack-89' => 'icon-outline-vector-icons-pack-89'),array('wicon icon-outline-vector-icons-pack-90' => 'icon-outline-vector-icons-pack-90'),array('wicon icon-outline-vector-icons-pack-91' => 'icon-outline-vector-icons-pack-91'),array('wicon icon-outline-vector-icons-pack-99' => 'icon-outline-vector-icons-pack-99'),array('wicon icon-outline-vector-icons-pack-100' => 'icon-outline-vector-icons-pack-100'),array('wicon icon-outline-vector-icons-pack-101' => 'icon-outline-vector-icons-pack-101'),array('wicon icon-outline-vector-icons-pack-102' => 'icon-outline-vector-icons-pack-102'),array('wicon icon-outline-vector-icons-pack-103' => 'icon-outline-vector-icons-pack-103'),array('wicon icon-outline-vector-icons-pack-104' => 'icon-outline-vector-icons-pack-104'),array('wicon icon-outline-vector-icons-pack-112' => 'icon-outline-vector-icons-pack-112'),array('wicon icon-outline-vector-icons-pack-113' => 'icon-outline-vector-icons-pack-113'),array('wicon icon-outline-vector-icons-pack-114' => 'icon-outline-vector-icons-pack-114'),array('wicon icon-outline-vector-icons-pack-115' => 'icon-outline-vector-icons-pack-115'),array('wicon icon-outline-vector-icons-pack-116' => 'icon-outline-vector-icons-pack-116'),array('wicon icon-outline-vector-icons-pack-117' => 'icon-outline-vector-icons-pack-117'),array('wicon icon-outline-vector-icons-pack-125' => 'icon-outline-vector-icons-pack-125'),array('wicon icon-outline-vector-icons-pack-126' => 'icon-outline-vector-icons-pack-126'),array('wicon icon-outline-vector-icons-pack-127' => 'icon-outline-vector-icons-pack-127'),array('wicon icon-outline-vector-icons-pack-128' => 'icon-outline-vector-icons-pack-128'),array('wicon icon-outline-vector-icons-pack-129' => 'icon-outline-vector-icons-pack-129'),array('wicon icon-outline-vector-icons-pack-130' => 'icon-outline-vector-icons-pack-130'),array('wicon icon-outline-vector-icons-pack-138' => 'icon-outline-vector-icons-pack-138'),array('wicon icon-outline-vector-icons-pack-139' => 'icon-outline-vector-icons-pack-139'),array('wicon icon-outline-vector-icons-pack-140' => 'icon-outline-vector-icons-pack-140'),array('wicon icon-outline-vector-icons-pack-141' => 'icon-outline-vector-icons-pack-141'),array('wicon icon-outline-vector-icons-pack-142' => 'icon-outline-vector-icons-pack-142'),array('wicon icon-outline-vector-icons-pack-143' => 'icon-outline-vector-icons-pack-143'),array('wicon icon-outline-vector-icons-pack-151' => 'icon-outline-vector-icons-pack-151'),array('wicon icon-outline-vector-icons-pack-152' => 'icon-outline-vector-icons-pack-152'),array('wicon icon-outline-vector-icons-pack-153' => 'icon-outline-vector-icons-pack-153'),array('wicon icon-outline-vector-icons-pack-154' => 'icon-outline-vector-icons-pack-154'),array('wicon icon-outline-vector-icons-pack-155' => 'icon-outline-vector-icons-pack-155'),array('wicon icon-outline-vector-icons-pack-156' => 'icon-outline-vector-icons-pack-156'),array('wicon icon-outline-vector-icons-pack-164' => 'icon-outline-vector-icons-pack-164'),array('wicon icon-outline-vector-icons-pack-165' => 'icon-outline-vector-icons-pack-165'),array('wicon icon-outline-vector-icons-pack-166' => 'icon-outline-vector-icons-pack-166'),array('wicon icon-outline-vector-icons-pack-167' => 'icon-outline-vector-icons-pack-167'),array('wicon icon-outline-vector-icons-pack-168' => 'icon-outline-vector-icons-pack-168'),array('wicon icon-indians-icons-02' => 'icon-indians-icons-02'),array('wicon icon-indians-icons-03' => 'icon-indians-icons-03'),array('wicon icon-indians-icons-04' => 'icon-indians-icons-04'),array('wicon icon-indians-icons-05' => 'icon-indians-icons-05'),array('wicon icon-indians-icons-06' => 'icon-indians-icons-06'),array('wicon icon-indians-icons-07' => 'icon-indians-icons-07'),array('wicon icon-indians-icons-08' => 'icon-indians-icons-08'),array('wicon icon-indians-icons-09' => 'icon-indians-icons-09'),array('wicon icon-wolverine-logo-01' => 'icon-wolverine-logo-01'),array('wicon icon-wolverine-logo-02' => 'icon-wolverine-logo-02'),array('wicon icon-wolverine-logo-03' => 'icon-wolverine-logo-03'),array('wicon icon-wolverine-logo-04' => 'icon-wolverine-logo-04'),array('wicon icon-wolverine-logo-05' => 'icon-wolverine-logo-05'),array('wicon icon-wolverine-logo-06' => 'icon-wolverine-logo-06'),array('wicon icon-wolverine-logo-08' => 'icon-wolverine-logo-08'),array('wicon icon-wolverine-logo-09' => 'icon-wolverine-logo-09'),array('wicon icon-wolverine-logo-10' => 'icon-wolverine-logo-10'),array('wicon icon-address' => 'icon-address'),array('wicon icon-adjust' => 'icon-adjust'),array('wicon icon-air' => 'icon-air'),array('wicon icon-alert' => 'icon-alert'),array('wicon icon-archive' => 'icon-archive'),array('wicon icon-arrow-combo' => 'icon-arrow-combo'),array('wicon icon-arrows-ccw' => 'icon-arrows-ccw'),array('wicon icon-attach' => 'icon-attach'),array('wicon icon-attention' => 'icon-attention'),array('wicon icon-back' => 'icon-back'),array('wicon icon-back-in-time' => 'icon-back-in-time'),array('wicon icon-bag' => 'icon-bag'),array('wicon icon-basket' => 'icon-basket'),array('wicon icon-battery' => 'icon-battery'),array('wicon icon-behance' => 'icon-behance'),array('wicon icon-bell' => 'icon-bell'),array('wicon icon-block' => 'icon-block'),array('wicon icon-book' => 'icon-book'),array('wicon icon-book-open' => 'icon-book-open'),array('wicon icon-bookmark' => 'icon-bookmark'),array('wicon icon-bookmarks' => 'icon-bookmarks'),array('wicon icon-box' => 'icon-box'),array('wicon icon-briefcase' => 'icon-briefcase'),array('wicon icon-brush' => 'icon-brush'),array('wicon icon-bucket' => 'icon-bucket'),array('wicon icon-calendar' => 'icon-calendar'),array('wicon icon-camera' => 'icon-camera'),array('wicon icon-cancel' => 'icon-cancel'),array('wicon icon-cancel-circled' => 'icon-cancel-circled'),array('wicon icon-cancel-squared' => 'icon-cancel-squared'),array('wicon icon-cc' => 'icon-cc'),array('wicon icon-cc-by' => 'icon-cc-by'),array('wicon icon-cc-nc' => 'icon-cc-nc'),array('wicon icon-cc-nc-eu' => 'icon-cc-nc-eu'),array('wicon icon-cc-nc-jp' => 'icon-cc-nc-jp'),array('wicon icon-cc-nd' => 'icon-cc-nd'),array('wicon icon-cc-pd' => 'icon-cc-pd'),array('wicon icon-cc-remix' => 'icon-cc-remix'),array('wicon icon-cc-sa' => 'icon-cc-sa'),array('wicon icon-cc-share' => 'icon-cc-share'),array('wicon icon-cc-zero' => 'icon-cc-zero'),array('wicon icon-ccw' => 'icon-ccw'),array('wicon icon-cd' => 'icon-cd'),array('wicon icon-chart-area' => 'icon-chart-area'),array('wicon icon-chart-bar' => 'icon-chart-bar'),array('wicon icon-chart-line' => 'icon-chart-line'),array('wicon icon-chart-pie' => 'icon-chart-pie'),array('wicon icon-chat' => 'icon-chat'),array('wicon icon-check' => 'icon-check'),array('wicon icon-clipboard' => 'icon-clipboard'),array('wicon icon-clock' => 'icon-clock'),array('wicon icon-cloud' => 'icon-cloud'),array('wicon icon-cloud-thunder' => 'icon-cloud-thunder'),array('wicon icon-code' => 'icon-code'),array('wicon icon-cog' => 'icon-cog'),array('wicon icon-comment' => 'icon-comment'),array('wicon icon-compass' => 'icon-compass'),array('wicon icon-credit-card' => 'icon-credit-card'),array('wicon icon-cup' => 'icon-cup'),array('wicon icon-cw' => 'icon-cw'),array('wicon icon-database' => 'icon-database'),array('wicon icon-db-shape' => 'icon-db-shape'),array('wicon icon-direction' => 'icon-direction'),array('wicon icon-doc' => 'icon-doc'),array('wicon icon-doc-landscape' => 'icon-doc-landscape'),array('wicon icon-doc-text' => 'icon-doc-text'),array('wicon icon-doc-text-inv' => 'icon-doc-text-inv'),array('wicon icon-docs' => 'icon-docs'),array('wicon icon-dot' => 'icon-dot'),array('wicon icon-dot-2' => 'icon-dot-2'),array('wicon icon-dot-3' => 'icon-dot-3'),array('wicon icon-down' => 'icon-down'),array('wicon icon-down-bold' => 'icon-down-bold'),array('wicon icon-down-circled' => 'icon-down-circled'),array('wicon icon-down-dir' => 'icon-down-dir'),array('wicon icon-down-open' => 'icon-down-open'),array('wicon icon-down-open-big' => 'icon-down-open-big'),array('wicon icon-down-open-mini' => 'icon-down-open-mini'),array('wicon icon-down-thin' => 'icon-down-thin'),array('wicon icon-download' => 'icon-download'),array('wicon icon-dribbble' => 'icon-dribbble'),array('wicon icon-dribbble-circled' => 'icon-dribbble-circled'),array('wicon icon-drive' => 'icon-drive'),array('wicon icon-dropbox' => 'icon-dropbox'),array('wicon icon-droplet' => 'icon-droplet'),array('wicon icon-erase' => 'icon-erase'),array('wicon icon-evernote' => 'icon-evernote'),array('wicon icon-export' => 'icon-export'),array('wicon icon-eye' => 'icon-eye'),array('wicon icon-facebook' => 'icon-facebook'),array('wicon icon-facebook-circled' => 'icon-facebook-circled'),array('wicon icon-facebook-squared' => 'icon-facebook-squared'),array('wicon icon-fast-backward' => 'icon-fast-backward'),array('wicon icon-fast-forward' => 'icon-fast-forward'),array('wicon icon-feather' => 'icon-feather'),array('wicon icon-flag' => 'icon-flag'),array('wicon icon-flash' => 'icon-flash'),array('wicon icon-flashlight' => 'icon-flashlight'),array('wicon icon-flattr' => 'icon-flattr'),array('wicon icon-flickr' => 'icon-flickr'),array('wicon icon-flickr-circled' => 'icon-flickr-circled'),array('wicon icon-flight' => 'icon-flight'),array('wicon icon-floppy' => 'icon-floppy'),array('wicon icon-flow-branch' => 'icon-flow-branch'),array('wicon icon-flow-cascade' => 'icon-flow-cascade'),array('wicon icon-flow-line' => 'icon-flow-line'),array('wicon icon-flow-parallel' => 'icon-flow-parallel'),array('wicon icon-flow-tree' => 'icon-flow-tree'),array('wicon icon-folder' => 'icon-folder'),array('wicon icon-forward' => 'icon-forward'),array('wicon icon-gauge' => 'icon-gauge'),array('wicon icon-github' => 'icon-github'),array('wicon icon-github-circled' => 'icon-github-circled'),array('wicon icon-globe' => 'icon-globe'),array('wicon icon-google-circles' => 'icon-google-circles'),array('wicon icon-gplus' => 'icon-gplus'),array('wicon icon-gplus-circled' => 'icon-gplus-circled'),array('wicon icon-graduation-cap' => 'icon-graduation-cap'),array('wicon icon-heart' => 'icon-heart'),array('wicon icon-heart-empty' => 'icon-heart-empty'),array('wicon icon-help' => 'icon-help'),array('wicon icon-help-circled' => 'icon-help-circled'),array('wicon icon-home' => 'icon-home'),array('wicon icon-hourglass' => 'icon-hourglass'),array('wicon icon-inbox' => 'icon-inbox'),array('wicon icon-infinity' => 'icon-infinity'),array('wicon icon-info' => 'icon-info'),array('wicon icon-info-circled' => 'icon-info-circled'),array('wicon icon-instagrem' => 'icon-instagrem'),array('wicon icon-install' => 'icon-install'),array('wicon icon-key' => 'icon-key'),array('wicon icon-keyboard' => 'icon-keyboard'),array('wicon icon-lamp' => 'icon-lamp'),array('wicon icon-language' => 'icon-language'),array('wicon icon-lastfm' => 'icon-lastfm'),array('wicon icon-lastfm-circled' => 'icon-lastfm-circled'),array('wicon icon-layout' => 'icon-layout'),array('wicon icon-leaf' => 'icon-leaf'),array('wicon icon-left' => 'icon-left'),array('wicon icon-left-bold' => 'icon-left-bold'),array('wicon icon-left-circled' => 'icon-left-circled'),array('wicon icon-left-dir' => 'icon-left-dir'),array('wicon icon-left-open' => 'icon-left-open'),array('wicon icon-left-open-big' => 'icon-left-open-big'),array('wicon icon-left-open-mini' => 'icon-left-open-mini'),array('wicon icon-left-thin' => 'icon-left-thin'),array('wicon icon-level-down' => 'icon-level-down'),array('wicon icon-level-up' => 'icon-level-up'),array('wicon icon-lifebuoy' => 'icon-lifebuoy'),array('wicon icon-light-down' => 'icon-light-down'),array('wicon icon-light-up' => 'icon-light-up'),array('wicon icon-link' => 'icon-link'),array('wicon icon-linkedin' => 'icon-linkedin'),array('wicon icon-linkedin-circled' => 'icon-linkedin-circled'),array('wicon icon-list' => 'icon-list'),array('wicon icon-list-add' => 'icon-list-add'),array('wicon icon-location' => 'icon-location'),array('wicon icon-lock' => 'icon-lock'),array('wicon icon-lock-open' => 'icon-lock-open'),array('wicon icon-login' => 'icon-login'),array('wicon icon-logo-db' => 'icon-logo-db'),array('wicon icon-logout' => 'icon-logout'),array('wicon icon-loop' => 'icon-loop'),array('wicon icon-magnet' => 'icon-magnet'),array('wicon icon-mail' => 'icon-mail'),array('wicon icon-map' => 'icon-map'),array('wicon icon-megaphone' => 'icon-megaphone'),array('wicon icon-menu' => 'icon-menu'),array('wicon icon-mic' => 'icon-mic'),array('wicon icon-minus' => 'icon-minus'),array('wicon icon-minus-circled' => 'icon-minus-circled'),array('wicon icon-minus-squared' => 'icon-minus-squared'),array('wicon icon-mixi' => 'icon-mixi'),array('wicon icon-mobile' => 'icon-mobile'),array('wicon icon-monitor' => 'icon-monitor'),array('wicon icon-moon' => 'icon-moon'),array('wicon icon-mouse' => 'icon-mouse'),array('wicon icon-music' => 'icon-music'),array('wicon icon-mute' => 'icon-mute'),array('wicon icon-network' => 'icon-network'),array('wicon icon-newspaper' => 'icon-newspaper'),array('wicon icon-note' => 'icon-note'),array('wicon icon-note-beamed' => 'icon-note-beamed'),array('wicon icon-palette' => 'icon-palette'),array('wicon icon-paper-plane' => 'icon-paper-plane'),array('wicon icon-pause' => 'icon-pause'),array('wicon icon-paypal' => 'icon-paypal'),array('wicon icon-pencil' => 'icon-pencil'),array('wicon icon-phone' => 'icon-phone'),array('wicon icon-picasa' => 'icon-picasa'),array('wicon icon-picture' => 'icon-picture'),array('wicon icon-pinterest' => 'icon-pinterest'),array('wicon icon-pinterest-circled' => 'icon-pinterest-circled'),array('wicon icon-play' => 'icon-play'),array('wicon icon-plus' => 'icon-plus'),array('wicon icon-plus-circled' => 'icon-plus-circled'),array('wicon icon-plus-squared' => 'icon-plus-squared'),array('wicon icon-popup' => 'icon-popup'),array('wicon icon-print' => 'icon-print'),array('wicon icon-progress-0' => 'icon-progress-0'),array('wicon icon-progress-1' => 'icon-progress-1'),array('wicon icon-progress-2' => 'icon-progress-2'),array('wicon icon-progress-3' => 'icon-progress-3'),array('wicon icon-publish' => 'icon-publish'),array('wicon icon-qq' => 'icon-qq'),array('wicon icon-quote' => 'icon-quote'),array('wicon icon-rdio' => 'icon-rdio'),array('wicon icon-rdio-circled' => 'icon-rdio-circled'),array('wicon icon-record' => 'icon-record'),array('wicon icon-renren' => 'icon-renren'),array('wicon icon-reply' => 'icon-reply'),array('wicon icon-reply-all' => 'icon-reply-all'),array('wicon icon-resize-full' => 'icon-resize-full'),array('wicon icon-resize-small' => 'icon-resize-small'),array('wicon icon-retweet' => 'icon-retweet'),array('wicon icon-right' => 'icon-right'),array('wicon icon-right-bold' => 'icon-right-bold'),array('wicon icon-right-circled' => 'icon-right-circled'),array('wicon icon-right-dir' => 'icon-right-dir'),array('wicon icon-right-open' => 'icon-right-open'),array('wicon icon-right-open-big' => 'icon-right-open-big'),array('wicon icon-right-open-mini' => 'icon-right-open-mini'),array('wicon icon-right-thin' => 'icon-right-thin'),array('wicon icon-rocket' => 'icon-rocket'),array('wicon icon-rss' => 'icon-rss'),array('wicon icon-search' => 'icon-search'),array('wicon icon-share' => 'icon-share'),array('wicon icon-shareable' => 'icon-shareable'),array('wicon icon-shuffle' => 'icon-shuffle'),array('wicon icon-signal' => 'icon-signal'),array('wicon icon-sina-weibo' => 'icon-sina-weibo'),array('wicon icon-skype' => 'icon-skype'),array('wicon icon-skype-circled' => 'icon-skype-circled'),array('wicon icon-smashing' => 'icon-smashing'),array('wicon icon-sound' => 'icon-sound'),array('wicon icon-soundcloud' => 'icon-soundcloud'),array('wicon icon-spotify' => 'icon-spotify'),array('wicon icon-spotify-circled' => 'icon-spotify-circled'),array('wicon icon-star' => 'icon-star'),array('wicon icon-star-empty' => 'icon-star-empty'),array('wicon icon-stop' => 'icon-stop'),array('wicon icon-stumbleupon' => 'icon-stumbleupon'),array('wicon icon-stumbleupon-circled' => 'icon-stumbleupon-circled'),array('wicon icon-suitcase' => 'icon-suitcase'),array('wicon icon-sweden' => 'icon-sweden'),array('wicon icon-switch' => 'icon-switch'),array('wicon icon-tag' => 'icon-tag'),array('wicon icon-tape' => 'icon-tape'),array('wicon icon-target' => 'icon-target'),array('wicon icon-thermometer' => 'icon-thermometer'),array('wicon icon-thumbs-down' => 'icon-thumbs-down'),array('wicon icon-thumbs-up' => 'icon-thumbs-up'),array('wicon icon-ticket' => 'icon-ticket'),array('wicon icon-to-end' => 'icon-to-end'),array('wicon icon-to-start' => 'icon-to-start'),array('wicon icon-tools' => 'icon-tools'),array('wicon icon-traffic-cone' => 'icon-traffic-cone'),array('wicon icon-trash' => 'icon-trash'),array('wicon icon-trophy' => 'icon-trophy'),array('wicon icon-tumblr' => 'icon-tumblr'),array('wicon icon-tumblr-circled' => 'icon-tumblr-circled'),array('wicon icon-twitter' => 'icon-twitter'),array('wicon icon-twitter-circled' => 'icon-twitter-circled'),array('wicon icon-up' => 'icon-up'),array('wicon icon-up-bold' => 'icon-up-bold'),array('wicon icon-up-circled' => 'icon-up-circled'),array('wicon icon-up-dir' => 'icon-up-dir'),array('wicon icon-up-open' => 'icon-up-open'),array('wicon icon-up-open-big' => 'icon-up-open-big'),array('wicon icon-up-open-mini' => 'icon-up-open-mini'),array('wicon icon-up-thin' => 'icon-up-thin'),array('wicon icon-upload' => 'icon-upload'),array('wicon icon-upload-cloud' => 'icon-upload-cloud'),array('wicon icon-user' => 'icon-user'),array('wicon icon-user-add' => 'icon-user-add'),array('wicon icon-users' => 'icon-users'),array('wicon icon-vcard' => 'icon-vcard'),array('wicon icon-video' => 'icon-video'),array('wicon icon-vimeo' => 'icon-vimeo'),array('wicon icon-vimeo-circled' => 'icon-vimeo-circled'),array('wicon icon-vkontakte' => 'icon-vkontakte'),array('wicon icon-volume' => 'icon-volume'),array('wicon icon-water' => 'icon-water'),array('wicon icon-window' => 'icon-window'),array('wicon icon-wolverine-logo-07' => 'icon-wolverine-logo-07'),array('wicon icon-key21' => 'icon-key21'),array('wicon icon-password1' => 'icon-password1'),array('wicon icon-user14' => 'icon-user14'),array('wicon icon-shopping111' => 'icon-shopping111'),array('wicon icon-icon-search' => 'icon-icon-search'),array('wicon icon-arrow413' => 'icon-arrow413'),array('wicon icon-arrow427' => 'icon-arrow427'),array('wicon icon-wrong6' => 'icon-wrong6'),array('wicon icon-icon-opened29' => 'icon-icon-opened29'),array('wicon icon-icon-opened29-1' => 'icon-icon-opened29-1'),array('wicon icon-dark37' => 'icon-dark37'),array('wicon icon-dark37-1' => 'icon-dark37-1'),array('wicon icon-list23' => 'icon-list23'),array('wicon icon-menu27' => 'icon-menu27'),array('wicon icon-menu45' => 'icon-menu45'),array('wicon icon-menu53' => 'icon-menu53'),array('wicon icon-menu55' => 'icon-menu55'),array('wicon icon-list23-1' => 'icon-list23-1'),array('wicon icon-wrong6-1' => 'icon-wrong6-1'),array('wicon icon-previous11' => 'icon-previous11'),array('wicon icon-thin36' => 'icon-thin36'),array('wicon icon-thin35' => 'icon-thin35'),array('wicon icon-up77' => 'icon-up77'),array('wicon icon-right106' => 'icon-right106'),array('wicon icon-next15' => 'icon-next15'),array('wicon icon-collapse3' => 'icon-collapse3'),array('wicon icon-expand22' => 'icon-expand22'),array('wicon icon-play43' => 'icon-play43'),array('wicon icon-search-icon' => 'icon-search-icon'),array('wicon icon-cart-icon' => 'icon-cart-icon'),array('wicon icon-minus-1' => 'icon-minus-1'),array('wicon icon-plus-1' => 'icon-plus-1'),array('wicon icon-185100-caddie-shop-shopping-streamline' => 'icon-185100-caddie-shop-shopping-streamline'),array('wicon icon-185101-caddie-shopping-streamline' => 'icon-185101-caddie-shopping-streamline'),array('wicon icon-ecommerce-bag' => 'icon-ecommerce-bag'),array('wicon icon-ecommerce-bag-check' => 'icon-ecommerce-bag-check'),array('wicon icon-ecommerce-bag-cloud' => 'icon-ecommerce-bag-cloud'),array('wicon icon-ecommerce-bag-download' => 'icon-ecommerce-bag-download'),array('wicon icon-ecommerce-bag-minus' => 'icon-ecommerce-bag-minus'),array('wicon icon-ecommerce-bag-plus' => 'icon-ecommerce-bag-plus'),array('wicon icon-ecommerce-bag-refresh' => 'icon-ecommerce-bag-refresh'),array('wicon icon-ecommerce-bag-remove' => 'icon-ecommerce-bag-remove'),array('wicon icon-ecommerce-bag-search' => 'icon-ecommerce-bag-search'),array('wicon icon-ecommerce-bag-upload' => 'icon-ecommerce-bag-upload'),array('wicon icon-svg-icon-02' => 'icon-svg-icon-02'),array('wicon icon-svg-icon-03' => 'icon-svg-icon-03'),array('wicon icon-svg-icon-04' => 'icon-svg-icon-04'),array('wicon icon-svg-icon-05' => 'icon-svg-icon-05'),array('wicon icon-svg-icon-06' => 'icon-svg-icon-06'),array('wicon icon-svg-icon-07' => 'icon-svg-icon-07'),array('wicon icon-svg-icon-08' => 'icon-svg-icon-08'),array('wicon icon-svg-icon-09' => 'icon-svg-icon-09'),array('wicon icon-svg-icon-10' => 'icon-svg-icon-10'),array('wicon icon-svg-icon-11' => 'icon-svg-icon-11'),array('wicon icon-svg-icon-12' => 'icon-svg-icon-12'),array('wicon icon-svg-icon-13' => 'icon-svg-icon-13'),array('wicon icon-svg-icon-14' => 'icon-svg-icon-14'),array('wicon icon-svg-icon-15' => 'icon-svg-icon-15'),array('wicon icon-svg-icon-16' => 'icon-svg-icon-16'),array('wicon icon-svg-icon-17' => 'icon-svg-icon-17'),array('wicon icon-svg-icon-18' => 'icon-svg-icon-18'),
	);
	$params_row=array(
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Layout', 'wolverine' ),
			'param_name' => 'layout',
			'value'      => array(
				__( 'Full Width', 'wolverine' )  => 'wide',
				__( 'Container', 'wolverine' ) => 'boxed',
				__( 'Container Fluid', 'wolverine' ) => 'container-fluid',
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'wolverine' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'wolverine' ),
			'value' => array( __( 'Yes', 'wolverine' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'wolverine' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Middle', 'wolverine' ) => 'middle',
				__( 'Top', 'wolverine' ) => 'top',
			),
			'description' => __( 'Select content position within row.', 'wolverine' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Use video background?', 'wolverine' ),
			'param_name' => 'video_bg',
			'description' => __( 'If checked, video will be used as row background.', 'wolverine' ),
			'value' => array( __( 'Yes', 'wolverine' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'YouTube link', 'wolverine' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k', // default video url
			'description' => __( 'Add YouTube link.', 'wolverine' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'wolverine' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				__( 'None', 'wolverine' ) => '',
				__( 'Simple', 'wolverine' ) => 'content-moving',
				__( 'With fade', 'wolverine' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row.', 'wolverine' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'wolverine' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'None', 'wolverine' ) => '',
				__( 'Simple', 'wolverine' ) => 'content-moving',
				__( 'With fade', 'wolverine' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'wolverine' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'wolverine' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'wolverine' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __('Parallax speed', 'wolverine'),
			'param_name' => 'parallax_speed',
			'value' =>'1.5',
			'dependency' => Array('element' => 'parallax','value' => array('content-moving','content-moving-fade')),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Show background overlay', 'wolverine' ),
			'param_name' => 'overlay_set',
			'description' => __( 'Hide or Show overlay on background images.', 'wolverine' ),
			'value' => array(
				__( 'Hide, please', 'wolverine' ) =>'hide_overlay',
				__( 'Show Overlay Color', 'wolverine' ) =>'show_overlay_color',
				__( 'Show Overlay Image', 'wolverine' ) =>'show_overlay_image',
			)
		),
		array(
			'type'        => 'attach_image',
			'heading'     => __( 'Image Overlay:', 'wolverine' ),
			'param_name'  => 'overlay_image',
			'value'       => '',
			'description' => __( 'Upload image overlay.', 'wolverine' ),
			'dependency'  => Array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image' ) ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Overlay color', 'wolverine' ),
			'param_name' => 'overlay_color',
			'description' => __( 'Select color for background overlay.', 'wolverine' ),
			'value' => '',
			'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color')),
		),
		array(
			'type' => 'number',
			'class' => '',
			'heading' => __( 'Overlay opacity', 'wolverine' ),
			'param_name' => 'overlay_opacity',
			'value' =>'50',
			'min'=>'1',
			'max'=>'100',
			'suffix'=>'%',
			'description' => __( 'Select opacity for overlay.', 'wolverine' ),
			'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color','show_overlay_image')),
		),
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'wolverine' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'wolverine' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'wolverine' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wolverine' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'wolverine' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'wolverine' )
		),
		$add_css_animation,
		$add_duration_animation,
		$add_delay_animation,
	);
	vc_map( array(
		'name' => __( 'Row', 'wolverine' ),
		'base' => 'vc_row',
		'is_container' => true,
		'icon' => 'icon-wpb-row',
		'show_settings_on_create' => false,
		'category' => __( 'Content', 'wolverine' ),
		'description' => __( 'Place content elements inside the row', 'wolverine' ),
		'params' => $params_row,
		'js_view' => 'VcRowView'
	) );
	vc_map( array(
		'name' => __( 'Row', 'wolverine' ), //Inner Row
		'base' => 'vc_row_inner',
		'content_element' => false,
		'is_container' => true,
		'icon' => 'icon-wpb-row',
		'weight' => 1000,
		'show_settings_on_create' => false,
		'description' => __( 'Place content elements inside the row', 'wolverine' ),
		'params' => $params_row,
		'js_view' => 'VcRowView'
	) );
	$params_icon = array(
		array(
			'type' => 'iconpicker',
			'heading' => __('Icon', 'wolverine'),
			'param_name' => 'i_icon_wolverine',
			'value' => 'wicon icon-indians-icons-04', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000,
				'type' => 'wolverine',
				'source' => $wolverine_icons,
			),
			'dependency' => array(
				'element' => 'i_type',
				'value' => 'wolverine',
			),
			'description' => __('Select icon from library.', 'wolverine'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wolverine' ),
			'param_name' => 'i_icon_fontawesome',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' => array(
				'element' => 'i_type',
				'value' => 'fontawesome',
			),
			'description' => __( 'Select icon from library.', 'wolverine' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wolverine' ),
			'param_name' => 'i_icon_openiconic',
			'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'i_type',
				'value' => 'openiconic',
			),
			'description' => __( 'Select icon from library.', 'wolverine' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wolverine' ),
			'param_name' => 'i_icon_typicons',
			'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'i_type',
				'value' => 'typicons',
			),
			'description' => __( 'Select icon from library.', 'wolverine' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wolverine' ),
			'param_name' => 'i_icon_entypo',
			'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'i_type',
				'value' => 'entypo',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wolverine' ),
			'param_name' => 'i_icon_linecons',
			'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'i_type',
				'value' => 'linecons',
			),
			'description' => __( 'Select icon from library.', 'wolverine' ),
		),
	);
	$params_section = array_merge(
		array(
			array(
				'type' => 'textfield',
				'param_name' => 'title',
				'heading' => __( 'Title', 'wolverine' ),
				'description' => __( 'Enter section title (Note: you can leave it empty).', 'wolverine' ),
			),
			array(
				'type' => 'el_id',
				'param_name' => 'tab_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'heading' => __( 'Section ID', 'wolverine' ),
				'description' => __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'wolverine' ),
			),
			array(
				'type' => 'checkbox',
				'param_name' => 'add_icon',
				'heading' => __( 'Add icon?', 'wolverine' ),
				'description' => __( 'Add icon next to section title.', 'wolverine' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'i_position',
				'value' => array(
					__( 'Before title', 'wolverine' ) => 'left',
					__( 'After title', 'wolverine' ) => 'right',
				),
				'dependency' => array(
					'element' => 'add_icon',
					'value' => 'true',
				),
				'heading' => __( 'Icon position', 'wolverine' ),
				'description' => __( 'Select icon position.', 'wolverine' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'wolverine' ),
				'value' => array(
					__( 'Wolverine', 'wolverine') => 'wolverine',
					__( 'Font Awesome', 'wolverine' ) => 'fontawesome',
					__( 'Open Iconic', 'wolverine' ) => 'openiconic',
					__( 'Typicons', 'wolverine' ) => 'typicons',
					__( 'Entypo', 'wolverine' ) => 'entypo',
					__( 'Linecons', 'wolverine' ) => 'linecons',
				),
				'admin_label' => true,
				'param_name' => 'i_type',
				'description' => __( 'Select icon library.', 'wolverine' ),
				'dependency' => array(
					'element' => 'add_icon',
					'value' => 'true',
				),
			),

		),
		$params_icon,
		array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'wolverine' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wolverine' )
			)
		)
	);
	vc_map( array(
		'name' => __( 'Section', 'wolverine' ),
		'base' => 'vc_tta_section',
		'icon' => 'icon-wpb-ui-tta-section',
		'allowed_container_element' => 'vc_row',
		'is_container' => true,
		'show_settings_on_create' => false,
		'as_child' => array(
			'only' => 'vc_tta_tour,vc_tta_tabs,vc_tta_accordion',
		),
		//'content_element' => false,
		'category' => __( 'Content', 'wolverine' ),
		'description' => __( 'Section for Tabs, Tours, Accordions.', 'wolverine' ),
		'params' => $params_section,
		'js_view' => 'VcBackendTtaSectionView',
		'custom_markup' => '
<div class="vc_tta-panel-heading">
    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
</div>
<div class="vc_tta-panel-body">
	{{ editor_controls }}
	<div class="{{ container-class }}">
	{{ content }}
	</div>
</div>',
		'default_content' => '',
	) );
	/**
	 * Pie chart
	 */
	$params_piechart = array_merge(
		array(
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Layout Style', 'wolverine' ),
				'param_name'  => 'layout_style',
				'admin_label' => true,
				'value'       => array( __( 'Normal', 'wolverine' ) => '', __( 'Icon', 'wolverine' ) => 'pie_icon'),
				'description' => __( 'Select Layout Style.', 'wolverine' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Value', 'wolverine' ),
				'param_name' => 'value',
				'description' => __( 'Enter value for graph (Note: choose range from 0 to 100).', 'wolverine' ),
				'value' => '50',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Label value', 'wolverine' ),
				'param_name' => 'label_value',
				'description' => __( 'Enter label for pie chart (Note: leaving empty will set value from "Value" field).', 'wolverine' ),
				'value' => ''
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Units', 'wolverine' ),
				'param_name' => 'units',
				'description' => __( 'Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'wolverine' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Pie chart color', 'wolverine' ),
				'param_name' => 'color',
				'value' => getVcShared( 'colors-dashed' ) + array( __( 'Custom', 'wolverine' ) => 'custom' ),
				'description' => __( 'Select pie chart color.', 'wolverine' ),
				'admin_label' => true,
				'param_holder_class' => 'vc_colored-dropdown',
				'std' => 'grey'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Custom color', 'wolverine' ),
				'param_name' => 'custom_color',
				'description' => __( 'Select custom color.', 'wolverine' ),
				'dependency' => array(
					'element' => 'color',
					'value' => array( 'custom' )
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'wolverine' ),
				'value' => array(
					__( '[None]', 'wolverine') => '',
					__( 'Wolverine', 'wolverine') => 'wolverine',
					__( 'Font Awesome', 'wolverine' ) => 'fontawesome',
					__( 'Open Iconic', 'wolverine' ) => 'openiconic',
					__( 'Typicons', 'wolverine' ) => 'typicons',
					__( 'Entypo', 'wolverine' ) => 'entypo',
					__( 'Linecons', 'wolverine' ) => 'linecons',
					__( 'Image', 'wolverine') => 'image',
				),
				'admin_label' => true,
				'param_name' => 'i_type',
				'description' => __( 'Select icon library.', 'wolverine' ),
				'dependency'  => Array( 'element' => 'layout_style', 'value' => array( 'pie_icon') ),
			),
		),
		$params_icon,
		array(
			array(
				'type' => 'attach_image',
				'heading' => __('Upload Image Icon:', 'wolverine'),
				'param_name' => 'i_icon_image',
				'value' => '',
				'description' => __('Upload the custom image icon.', 'wolverine'),
				'dependency' => Array('element' => 'i_type', 'value' => array('image')),
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Value/Icon color', 'wolverine' ),
				'param_name' => 'value_color',
				'description' => __( 'Select value/icon color.', 'wolverine' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __('Title', 'wolverine'),
				'param_name' => 'title',
				'value' => '',
			),
			array(
				'type' => 'textarea',
				'heading' => __('Description', 'wolverine'),
				'param_name' => 'description',
				'value' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'wolverine' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wolverine' )
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'wolverine' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'wolverine' )
			),
		)
	);
	vc_map( array(
		'name' => __( 'Pie Chart', 'wolverine' ),
		'base' => 'vc_pie',
		'class' => '',
		'icon' => 'icon-wpb-vc_pie',
		'category' => array( __( 'Content', 'wolverine' ),__( 'Wolverine Shortcodes', 'wolverine' )),
		'description' => __( 'Animated pie chart', 'wolverine' ),
		'params' => $params_piechart,
	) );
}
add_action( 'vc_after_init', 'g5plus_register_vc_map' );