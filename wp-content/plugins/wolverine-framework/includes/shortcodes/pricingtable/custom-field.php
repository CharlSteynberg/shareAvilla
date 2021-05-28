<div class="my_meta_control">
    <p style="float:right">
        <a href="#" class="dodelete-features button">Remove All</a>
    </p>
    <div style="clear: both;margin-bottom: 15px;" ></div>
    <?php while($mb->have_fields_and_multi('features',array('length' => 2))): ?>
        <?php $mb->the_group_open(); ?>
        <?php $mb->the_field('feature');?>
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php if(!is_null($metabox->get_the_value())){$mb->the_value();} elseif(!$mb->is_last()){ echo "unfeatured"; }?>" class="form-control" />
        <a onClick="buttonHandler(this)" class="button feature-button <?php if($mb->get_the_value()=="featured"){echo "g5plus-pt-featured";}else {echo "g5plus-pt-unfeatured";}?>" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;<?php _e('Feature This Column', 'wolverine'); ?>&lt;/strong&gt;" data-content="<?php _e("Click this button to feature this column. A featured column appears bigger and includes the wording 'Most Popular'. You can only feature one column per table.", 'wolverine'); ?>"><?php _e('Feature', 'wolverine'); ?></a>
        <a href="#" class="dodelete button">Remove</a>
        <?php $mb->the_field('planname'); ?>
        <label><?php _e('Name', 'wolverine'); ?></label>
        <input class="form-control" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>

        <?php $mb->the_field('planprice'); ?>
        <label><?php _e('Price', 'wolverine'); ?></label>
        <input class="form-control" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>

        <?php $mb->the_field('planfeatures'); ?>
        <label><?php _e('Features', 'wolverine'); ?></label>
        <textarea name="<?php esc_attr($mb->the_name()); ?>" class="form-control" rows="7"><?php echo esc_html(str_replace("||", "\n", $mb->get_the_value())); ?></textarea>

        <?php $mb->the_field('buttontext'); ?>
        <label><?php _e('Button Text', 'wolverine'); ?></label>
        <input class="form-control" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>

        <?php $mb->the_field('buttonurl'); ?>
        <label><?php _e('Button Url', 'wolverine'); ?></label>
        <input class="form-control" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>
        <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    <div style="clear: both;"></div>
    <p>
        <a href="#" class="docopy-features button"><?php _e('Add Features', 'wolverine'); ?></a>
    </p>
</div>
<style>
    .my_meta_control .description
    { display:none; }

    .my_meta_control label
    { display:block; font-weight:bold; margin:6px; margin-bottom:0; margin-top:12px; }

    .my_meta_control label span
    { display:inline; font-weight:normal; }

    .my_meta_control span
    { color:#999; display:block; }

    .my_meta_control textarea, .my_meta_control input[type='text']
    {
        margin-bottom:3px; width:99%;
    }
    .my_meta_control h4
    {
        color:#999; font-size:1em; margin:15px 6px; text-transform:uppercase;
    }
    .g5plus-pt-featured { background-color: gold !important; box-shadow:none !important;}
    .g5plus-pt-unfeatured{ background-color: inherit;}
    .wpa_group.wpa_group-features {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 0 15px 15px 0;
        background: #fff;
        width: 20%;
        float: left;
    }
</style>
<script type="text/javascript">
    jQuery(function(){
        "use strict";
        jQuery('#wpa_loop-features').sortable();
    });
    function buttonHandler(el)
    {
        "use strict";
        // required for wordpress
        var $ = jQuery;

        // toggle active button via css
        function toggleButtonClasses(el)
        {
            $(el).toggleClass('g5plus-pt-featured');
            $(el).toggleClass('g5plus-pt-unfeatured');
        }

        //toggle the value of our hidden input
        function setInputValue(el)
        {
            if($(el).val()=="unfeatured" || $(el).val()=="")
                $(el).val("featured");
            else if($(el).val()=="featured")
                $(el).val("unfeatured");
        }

        // toggles the elements class and value
        function myButtonClickHandler(el)
        {
            toggleButtonClasses(el);
            setInputValue(el.prev());
        }

        // use hasClass to figure out if current item is selected or not
        if (!$(el).hasClass('g5plus-pt-featured')) {
            // if the clicked item is not featured, unfeature the currently featured item ('.ptp-icon-star') by sending it to myButtonClickHandler
            myButtonClickHandler($('.g5plus-pt-featured'));
        }

        //	feature the clicked item by sending it to myButtonClickHandler
        myButtonClickHandler( $(el));

        return false;
    }
</script>