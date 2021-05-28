<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/11/15
 * Time: 2:44 PM
 */
function g5framework_is_enable_hover_dir($overlay_style)
{
    if ($overlay_style == 'icon' || $overlay_style = 'title-category' || $overlay_style == 'title-excerpt-link'
            || $overlay_style == 'left-title-excerpt-link' || $overlay_style == 'title'
    ) {
        return true;
    } else
        return false;
}