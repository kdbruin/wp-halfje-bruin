<?php

/*
 * Layout filtering
 */

add_filter('thsp_current_layout', 'hb_current_layout');
function hb_current_layout($layout)
{
    global $post;

    if (get_post_format() == 'image')
    {
        $layout['default_layout'] = 'layout-cp';
    }

    return $layout;
}

