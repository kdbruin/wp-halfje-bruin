<?php

/**
 * Replace gallery shortcode to
 *
 * - force link type to 'file'
 * - set columns to 4
 */
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'hb_gallery_shortcode');

function hb_gallery_shortcode($atts)
{
    $atts['link'] = 'file';
    $atts['columns'] = '4';
    return gallery_shortcode($atts);
}

/**
 * Format a gallery in-place showing only 3 random images and return
 * this as a string. Each image links to the actual post. Also, a "show
 * gallery" link is added.
 */
function hb_get_intro_gallery()
{
    global $wpdb, $post;
    $output = "";
    $postID = $post->ID;
    $count = 4;
    $args = array(
	'post_type' => 'attachment',
	'numberposts' => $count,
	'post_status' => null,
	'order' => 'ASC',
	'orderby' => 'menu_order ID',
	'post_parent' => $postID
    );
    $attachments = get_posts($args);
    if ($attachments)
    {
	$post_url = get_permalink($postID);
	$size_class = sanitize_html_class('thumbnail');
	$itemtag = tag_escape('dl');
	$icontag = tag_escape('dt');
	$gallery_div = "\t\t<div class='hb-short-gallery galleryid-{$postID} gallery-columns-{$count} gallery-size-{$size_class}'>";
	$output = apply_filters('gallery_style', $gallery_div);
	foreach ($attachments as $attachment)
	{
	    $id = $attachment->ID;
	    $image_output = wp_get_attachment_image($id);
	    $image_meta = wp_get_attachment_metadata($id);

	    $orientation = '';
	    if (isset($image_meta['height'], $image_meta['width']))
	    {
		$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
	    }

	    $output .= "<{$itemtag} class='gallery-item'>";
	    $output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				<a href='{$post_url}'>{$image_output}</a>
			</{$icontag}>";
	    $output .= "</{$itemtag}>";
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	$output .= "\n\t\t<p><a href='{$post_url}'>" . __('Show full gallery', 'halfje-bruin') . "</a></p>";
    }

    return $output;
}
