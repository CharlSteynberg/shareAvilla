<?php if($overlay_style=='icon'|| $overlay_style=='title-category-link' || $overlay_style=='title-excerpt-link'
|| $overlay_style=='left-title-excerpt-link'){ ?>
    <div style="display: none">
        <?php
        $meta_values = get_post_meta(get_the_ID(), 'portfolio-format-gallery', false);
        if (count($meta_values) > 0) {
            foreach ($meta_values as $image) {
                $urls = wp_get_attachment_image_src($image, 'full');
                $gallery_img = '';
                if (count($urls) > 0 && is_array($urls))
                    $gallery_img = $urls[0];
                ?>
                <div>
                    <a href="<?php echo esc_url($gallery_img) ?>"
                       data-rel="prettyPhoto[pp_gal_<?php echo get_the_ID() ?>]"
                       title="<?php echo "<a href='" . $permalink . "'>" . $title_post . "</a>" ?>"></a>
                </div>
            <?php
            }
        }
        ?>
    </div>
<?php  } ?>
