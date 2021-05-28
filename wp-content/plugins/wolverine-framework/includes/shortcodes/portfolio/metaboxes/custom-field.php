<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/6/15
 * Time: 11:07 AM
 */
?>
<div class="portfolio-custom-field">
    <?php
    while($mb->have_fields_and_multi('portfolio_custom_fields',array('length' => 1))): ?>
        <?php $mb->the_group_open(); ?>

        <?php $mb->the_field('custom-field-title'); ?>
        <label><?php _e('Title', 'wolverine') ; ?></label>
        <input class="form-control" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

        <?php $mb->the_field('custom-field-description'); ?>
        <label><?php _e('Description', 'wolverine'); ?></label>
        <textarea name="<?php $mb->the_name(); ?>" class="form-control" rows="3"><?php echo wp_kses_post($mb->the_value()); ?></textarea>
        <a href="#" class="dodelete button">Remove</a>
        <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    <div style="clear: both;"></div>
    <p>
        <a href="#" class="docopy-portfolio_custom_fields button"><?php _e('Add custom field', 'wolverine'); ?></a>

        <a href="#" class="dodelete-portfolio_custom_fields button">Remove All</a>
    </p>
</div>

<style>
    .portfolio-custom-field .description
    { display:none; }
    .wpa_group-portfolio_custom_fields{
        width: 50%;
        float: left;
    }
    .portfolio-custom-field label
    { display:block; font-weight:bold; margin-bottom:0; margin-top:12px; }

    .portfolio-custom-field label span
    { display:inline; font-weight:normal; }

    .portfolio-custom-field span
    { color:#999; display:block; }

    .portfolio-custom-field textarea, .portfolio-custom-field input[type='text']
    { margin-bottom:3px; width:99%; }

    .portfolio-custom-field h4
    { color:#999; font-size:1em; margin:15px 6px; text-transform:uppercase; }
    .wpa_group.wpa_group-process {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 0 15px 15px 0;
        background: #fff;
        width: 20%;
        float: left;
    }
</style>