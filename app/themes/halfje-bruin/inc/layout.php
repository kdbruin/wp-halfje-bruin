<?php

/*
 * Layout filtering
 */

add_filter('thsp_current_layout', 'hb_current_layout');
function hb_current_layout($layout)
{
    global $post;

    if (is_page_template('page-templates/template-portfolio.php'))
    {
	// full width portfolio index page
        $layout['default_layout'] = 'layout-c';
    }

    return $layout;
}

