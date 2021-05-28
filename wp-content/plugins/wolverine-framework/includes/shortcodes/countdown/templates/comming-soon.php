<?php
wp_enqueue_script('wolverine-jquery-countdown',PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/countdown/assets/jquery.countdown/jquery.countdown.min.js', false, true);
wp_enqueue_script('wolverine-jquery-knob',PLUGIN_G5PLUS_FRAMEWORK_URL . 'includes/shortcodes/countdown/assets/jquery.countdown/jquery.knob.min.js', false, true);
$args = array(
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => 'countdown',
    'post_status'      => 'publish');
$posts_array  = new WP_Query( $args );
$opening_hours = $countdown_type= '';
$urlRedirect = '';
while ( $posts_array->have_posts() ) : $posts_array->the_post();
    $type= rwmb_meta('countdown-type');
    if($type=='comming-soon'){
        $countdown_type = $type;
        $urlRedirect = rwmb_meta('countdown-url');
        $opening_hours = rwmb_meta('countdown-opening');
        break;
    }
endwhile;
wp_reset_postdata();
$color = g5plus_framework_get_option('count_down_color','#fff');
$font_family = g5plus_framework_get_option('count_down_font', array(
	'font-family'=>'Lato',
));
if(is_array($font_family) && isset($font_family['font-family'])) {
	$font_family = $font_family['font-family'];
}

$data_section_id = 'opening-hours-'.uniqid();
?>
<div class="countdown">
    <div class="container">
        <div id="<?php echo esc_attr($data_section_id)?>" class="opening-hours">
            <div class="circle">
                <div class="canvas">
                    <input type="text" data-min="0" data-max="31" data-width="130" data-height="130" data-readOnly="true"
                           data-thickness=".1" value="0" class="months" id="months"
                           data-fgColor="<?php echo esc_attr($color)?>"  data-inputColor="#fff" data-bgColor="rgba(255, 255, 255, 0.4)"
                           data-font="<?php echo esc_attr($font_family) ?>"
                        >
                    <span class="title"><?php _e('Months','wolverine') ?></span>
                </div>
                <div class="canvas">
                    <input type="text" data-min="0" data-max="31" data-width="130" data-height="130" data-readOnly="true"
                           data-thickness=".1" value="0" class="days" id="days"
                           data-fgColor="<?php echo esc_attr($color)?>" data-inputColor="#fff" data-bgColor="rgba(255, 255, 255, 0.4)"
                           data-font="<?php echo esc_attr($font_family) ?>"
                        >
                    <span class="title"><?php _e('Days','wolverine') ?></span>
                </div>
                <div class="canvas">
                    <input type="text" data-min="0" data-max="23" data-width="130" data-height="130" data-readOnly="true"
                           data-thickness=".1" value="0" class="hours" id="hours"
                           data-fgColor="<?php echo esc_attr($color)?>"  data-inputColor="#fff" data-bgColor="rgba(255, 255, 255, 0.4)"
                           data-font="<?php echo esc_attr($font_family) ?>"
                        >
                    <span class="title"><?php _e('Hours','wolverine') ?></span>
                </div>
                <div class="canvas">
                    <input type="text" data-min="0" data-max="59" data-width="130" data-height="130" data-readOnly="true"
                           data-thickness=".1"  value="0" class="minutes" id="minutes"
                           data-fgColor="<?php echo esc_attr($color)?>" data-inputColor="#fff" data-bgColor="rgba(255, 255, 255, 0.4)"
                           data-font="<?php echo esc_attr($font_family) ?>"
                        >
                    <span class="title"><?php _e('Minutes','wolverine') ?></span>
                </div>
                <div class="canvas">
                    <input type="text" data-min="0" data-max="59" data-width="130" data-height="130" data-readOnly="true"
                           data-thickness=".1"  value="0" class="second" id="second"
                           data-fgColor="<?php echo esc_attr($color)?>"  data-inputColor="#fff" data-bgColor="rgba(255, 255, 255, 0.4)"
                           data-font="<?php echo esc_attr($font_family) ?>"
                        >
                    <span class="title"><?php _e('Seconds','wolverine') ?></span>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>

</div>
<script type="text/javascript">
    (function($) {
        "use strict";
        var elm = $('#<?php echo esc_attr($data_section_id)?>');
        $(document).ready(function(){
            var isInitCountdown = 0;
            $("#<?php echo esc_attr($data_section_id)?>").countdown('<?php echo esc_html($opening_hours); ?>',function(event){
                var months = parseInt(event.strftime('%m'));
                $('#months').attr('data-max',months);
                if(isInitCountdown==0){
                    $('input','#<?php echo esc_attr($data_section_id)?>').knob();
                    isInitCountdown=1;
                }
                setTimeout(function(){
                    $(elm).css('opacity','1');
                },500);
            });

            $("#<?php echo esc_attr($data_section_id)?>").countdown('<?php echo esc_html($opening_hours); ?>').on('update.countdown', function(event) {
                var second = parseInt(event.strftime('%S'));
                var minutes = parseInt(event.strftime('%M'));
                var hours = parseInt(event.strftime('%H'));
                var days = parseInt(event.strftime('%d'));
                var months = parseInt(event.strftime('%m'));
                var weeks = parseInt(event.strftime('%w'));
                if(months>0){
                    var bufferDay = weeks%4 * 7;
                    if(bufferDay>0){
                        days = bufferDay;
                    }
                }
                else{
                    days =  weeks*7 + days;
                }
                if(second<10)
                    second = '0' + second;
                if(minutes<10)
                    minutes = '0' + minutes;
                if(hours<10)
                    hours = '0' + hours;
                if(days<10)
                    days = '0' + days;
                if(months<10)
                    months = '0' + months;

                var elm = $('#<?php echo esc_attr($data_section_id)?>');
                $('#second',elm).val(second).trigger('change');
                $('#minutes',elm).val(minutes).trigger('change');
                $('#hours',elm).val(hours).trigger('change');
                $('#days',elm).val(days).trigger('change');
                $('#months',elm).val(months).trigger('change');

            }).on('finish.countdown', function(event){
                var elm = $('#<?php echo esc_attr($data_section_id)?>');
                $('#seconds',elm).val(0);
                <?php if( $urlRedirect!=''){ ?>
                window.location.href= '<?php echo esc_url($urlRedirect); ?>';
                <?php } ?>
            });


            $('input',elm).css('font-size','54px');
            $('input',elm).css('font-weight','400');
            if(navigator.userAgent.indexOf("Chrome") != -1 ){
                var height, width;
                var height, width;
                var marginTop = '30px';
                height = '60px';
                width = '70px';
                $('input',elm).css('height',height);
                $('input',elm).css('width',width);
                $('input',elm).css('margin-top',marginTop);
            }


        });
    })(jQuery);
</script>
