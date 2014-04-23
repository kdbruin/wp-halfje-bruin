<?php

/**
 * Class Name: wp_bootstrap_gallery
 * GitHub URI: https://github.com/twittem/wp-bootstrap-gallery
 * Description: A custom Wordpress gallery for dynamic thumbnail layout using Twitter Bootstrap 2 thumbnail layouts.
 * Version: 1.0
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

function wp_bootstrap_gallery( $content, $attr ) {
	global $instance, $post;
	$instance++;

	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract( shortcode_atts( array(
		'order'			=>	'ASC',
		'orderby'		=>	'menu_order ID',
		'id'			=>	$post->ID,
		'itemtag'		=>	'figure',
		'icontag'		=>	'div',
		'captiontag'	=>	'figcaption',
		'columns'		=>	3,
		'size'			=>	'thumbnail',
		'include'		=>	'',
		'exclude'		=>	''
	), $attr ) );

	$id = intval( $id );

	if ( 'RAND' == $order ) {
		$orderby = 'none';
	}

	if ( $include ) {
		
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		
		$_attachments = get_posts( array(
			'include'			=>	$include,
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	$order,
			'orderby'			=>	$orderby
		) );

		$attachments = array();
		
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}

	} elseif ( $exclude ) {
		
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		
		$attachments = get_children( array(
			'post_parent'		=>	$id,
			'exclude'			=>	$exclude,
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	$order,
			'orderby'			=>	$orderby
		) );

	} else {
		
		$attachments = get_children( array(
			'post_parent'		=>	$id,
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	$order,
			'orderby'			=>	$orderby
		) );

	}

	if ( empty( $attachments ) ) {
		return;
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
		return $output;
	}

	$itemtag	=	tag_escape( $itemtag );
	$captiontag	=	tag_escape( $captiontag );
	$columns	=	intval( min( array( 8, $columns ) ) );
	$float		=	(is_rtl()) ? 'right' : 'left';

	$selector	=	"gallery-{$instance}";
	$size_class	=	sanitize_html_class( $size );
	$output		=	"<div class='row gallery galleryid-$id gallery-size-$size' id='$selector'>";

	$column_class	=	"gallery-item col-xs-12 col-sm-6 col-md-3";

	foreach ( $attachments as $id => $attachment ) {

		$image_link = wp_get_attachment_url($id);
		$image_src = wp_get_attachment_image_src($id, 'thumbnail');
		if ($image_src) {
			list($src, $width, $height) = $image_src;

			$output .= "\n" . '<figure class="' . $column_class . '">';
			$output .= '<div class="gallery-icon">';
			$output .= "\n\t" . '<a href="' . $image_link . '" class="thumbnail"><img src="' . $src . '" class="img-responsive attachment-thumbnail" /></a>';
			$output .= "\n" . '</div></figure>';
		}
	}

	$output .= "\n</div>\n";

	return $output;
}

add_filter( 'post_gallery', 'wp_bootstrap_gallery', 10, 2 );

?>
