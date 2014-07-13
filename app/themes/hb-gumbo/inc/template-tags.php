<?php

/**
 * Various functions to be used in theme templates.
 */

/**
 * Handle the post featured image.
 *
 * If the Get The Image plugin is installed, we use this. Otherwise just use the default code.
 *
 * @param boolean $echo
 *        	if enabled, echo the output
 * @return the HTML or an empty string if no image is found
 */
function hb_the_post_thumbnail( $id, $size, $class = '', $echo = true )
{
	$img = '';
	
	if ( function_exists( 'get_the_image' ) )
	{
		/* Use the get_the_image() function to extend the search for the image. */
		$args = array( 
			'post_id' => $id, 
			'echo' => false, 
			'link_to_post' => false, 
			'image_class' => $class ? $class : false, 
			'size' => $size 
		);
		
		$img = get_the_image( $args );
	}
	elseif ( has_post_thumbnail( $id ) )
	{
		$img = get_the_post_thumbnail( $id, $size, array( 
			'class' => $class 
		) );
	}
	
	if ( $echo ) echo $img;
	
	return $img;
}
