<?php

/**
 * Shortcode to show an image using the specified ID.
 * 
 * The following attributes are possible:
 * 
 * - id:	attachment ID (req)
 * - size:	image size (def: large)
 * - class:	image class
 * - alt:	alternate text
 * - link:	link to post, fullsize image or none (def: full)
 * - norel:	suppress rel="lightbox" when set
 * 
 * @param unknown $atts shortcode attributes
 * @param string $content enclosed content, default unset
 * @return string HTML for the image shortcode
 */
add_shortcode('hb-image', 'hb_image_shortcode');
function hb_image_shortcode($atts, $content = null) {

	extract(shortcode_atts(array('id' => '',
				     'size' => 'large',
				     'class' => '',
				     'alt' => '',
				     'link' => 'full',
				     'norel' => ''), $atts));

	if (empty($id)) return '';

	$html = '';
	$image = wp_get_attachment_image_src($id, $size);
	if ($image)
	{
		list($src, $width, $height) = $image;

		$attachment = get_post($id);
		$default_attr = array(
			'src' => $src,
			'class' => "attachment-$size",
			'alt' => $alt
		);
		if (empty($default_attr['alt']))
			$default_attr['alt'] = trim(strip_tags(get_post_meta($id, '_wp_attachment_image_alt', true)));
		if (empty($default_attr['alt']))
			$default_attr['alt'] = trim(strip_tags($attachment->post_excerpt)); // If not, use the caption
		if (empty($default_attr['alt']))
			$default_attr['alt'] = trim(strip_tags($attachment->post_title)); // Finally, use the title
		if (!empty($class))
			$default_attr['class'] = $class . ' ' . $default_attr['class'];

		$attr = wp_parse_args($atts, $default_attr);
		$attr = apply_filters('wp_get_attachment_image_attributes', $attr, $attachment);
		$attr = array_map('esc_attr', $attr);
		$html = "<img ";
		foreach ($attr as $name => $value)
		{
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';
		
		$rel = '';
		if (empty($norel)) $rel = ' rel="lightbox"';
		if ($link == 'post')
		{
			$html = '<a href="' . wp_get_attachment_url($id) . '">' . $html . '</a>';
		}
		else if ($link == 'full')
		{
			$html = '<a href="' . wp_get_attachment_url($id) . '"' . $rel . '>' . $html . '</a>';
		}
	}

	return $html;
}

