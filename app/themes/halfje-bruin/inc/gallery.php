<?php

/**
 * Replace gallery shortcode to
 *
 * - set link type to 'file'
 */
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'hb_gallery_shortcode');

function hb_gallery_shortcode($atts)
{
	$atts['link'] = 'file';
	return gallery_shortcode($atts);
}

