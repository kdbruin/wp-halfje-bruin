<?php

/**
 * Replace gallery shortcode to
 *
 * - force link type to 'file'
 * - set columns to 4
 */
remove_shortcode( 'gallery', 'gallery_shortcode' );
add_shortcode( 'gallery', 'hb_gallery_shortcode' );

function hb_gallery_shortcode( $atts )
{
	if ( empty( $atts[ 'link' ] ) ) $atts[ 'link' ] = 'file';
	if ( empty( $atts[ 'columns' ] ) ) $atts[ 'columns' ] = '4';
	
	return gallery_shortcode( $atts );
}
