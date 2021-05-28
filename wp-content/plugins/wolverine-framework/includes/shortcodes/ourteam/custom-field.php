<div class="my_meta_control">
    <p style="float:right">
        <a href="#" class="dodelete-ourteam button">Remove All</a>
    </p>
    <div style="clear: both;margin-bottom: 15px;" ></div>
    <?php while($mb->have_fields_and_multi('ourteam',array('length' => 2))): ?>
        <?php $mb->the_group_open(); ?>
        <a href="#" class="dodelete button">Remove</a>
        <?php $mb->the_field('socialName'); ?>
        <label><?php _e('Name', 'wolverine'); ?></label>
        <input class="form-control" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>

        <?php $mb->the_field('socialLink'); ?>
        <label><?php _e('Link', 'wolverine'); ?></label>
        <input class="form-control" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>

        <?php $mb->the_field('socialIcon'); ?>
        <label><?php _e('Icon', 'wolverine'); ?></label>
        <input class="form-control input-icon" style="width:62%;" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>
        <input title="Click to browse icon" style="width:35%;" class="browse-icon button-secondary" type="button" value="Browse Icon" >
        <span class="icon-preview"><i class="'. $value.'"></i></span>
        <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    <div style="clear: both;"></div>
    <p>
        <a href="#" class="docopy-ourteam button"><?php _e('Add Social', 'wolverine'); ?></a>
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
    { margin-bottom:3px; width:99%; }

    .my_meta_control h4
    { color:#999; font-size:1em; margin:15px 6px; text-transform:uppercase; }
    .wpa_group.wpa_group-ourteam {
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
        jQuery('#wpa_loop-ourteam').sortable();
    });
</script>