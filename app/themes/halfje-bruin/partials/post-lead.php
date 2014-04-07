<?php
/**
 * Template part for displaying post lead image in archives.
 *
 * @package Cazuela
 * @subpackage Halfje-Bruin
 * @since Cazuela 1.0
 */

// Add post thumbnail, if it exists
if ( ! is_single() && ( has_post_thumbnail() || get_post_format() == 'image' ) ) {
	$args = array(
		'size' => 'lead-image',
		'echo' => 'false',
		'link_to_post' => false
	);
	$lead = get_the_image( $args );
	if ( ! empty( $lead ) ) {
		echo '<div class="entry-lead">';
			echo '<a href="' . get_permalink() . '">' . $lead . '</a>';
		echo '</div><!-- .entry-lead -->';
	}
}
