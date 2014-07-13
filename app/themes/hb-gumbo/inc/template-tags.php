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
function hb_gumbo_post_thumbnail( $id, $size, $class = '', $echo = true )
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

/**
 * Display navigation to next/previous pages when applicable
 */
function gumbo_content_nav( $nav_id )
{
	global $wp_query, $post;
	
	// Get current theme options
	$theme_options = thsp_cbp_get_options_values();
	
	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() )
	{
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );
		
		if ( !$next && !$previous ) return;
	}
	
	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) return;
	
	if ( 'nav-below' == $nav_id && !$theme_options[ 'post_navigation_below' ] ) return;
	
	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';
	
	?>
<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>"
	class="<?php echo $nav_class; ?>">
	<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'gumbo' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>
		<?php
		$previous_post = get_adjacent_post( false, '', true );
		if ( !empty( $previous_post ) )
		{
			$prev_img = hb_gumbo_post_thumbnail( $previous_post->ID, 'thumbnail', 'attachment-thumbnail wp-post-image', false );
			$prev_post_class = ( $prev_img ? 'has-image' : '' );
			echo '<div class="prev prev-post ' . $prev_post_class . '">';
			echo '<a href="' . get_permalink( $previous_post->ID ) . '" title="' . sprintf( __( 'Previous post: %1$s', 'gumbo' ), esc_attr( get_the_title( $previous_post->ID ) ) ) . '">';
			echo '<div class="clear">';
			echo $prev_img;
			echo '<span class="heading">' . __( 'Previous post', 'gumbo' ) . '</span>';
			echo '<div class="title previous-title">' . get_the_title( $previous_post->ID ) . '</div>';
			echo '</div>';
			echo '</a>';
			echo '</div>';
		}
		$next_post = get_adjacent_post( false, '', false );
		if ( !empty( $next_post ) )
		{
			$post_img = hb_gumbo_post_thumbnail( $next_post->ID, 'thumbnail', 'attachment-thumbnail wp-post-image', false );
			$next_post_class = ( $post_img ? 'has-image' : '' );
			echo '<div class="next next-post ' . $next_post_class . '">';
			echo '<a href="' . get_permalink( $next_post->ID ) . '" title="' . sprintf( __( 'Next post: %1$s', 'gumbo' ), esc_attr( get_the_title( $next_post->ID ) ) ) . '">';
			echo '<div class="clear">';
			echo $post_img;
			echo '<span class="heading">' . __( 'Next post', 'gumbo' ) . '</span>';
			echo '<div class="title next-title">' . get_the_title( $next_post->ID ) . '</div>';
			echo '</div>';
			echo '</a>';
			echo '</div>';
		}
		?>
	
	<?php elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) : // navigation links for home, archive, and search pages ?>
		<?php
		global $wp_query;
		$big = 999999999; // need an unlikely integer
		
		echo paginate_links( array( 
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ), 
			'format' => '?paged=%#%', 
			'current' => max( 1, get_query_var( 'paged' ) ), 
			'total' => $wp_query->max_num_pages, 
			'prev_text' => '&larr;', 
			'next_text' => '&rarr;' 
		) );
		?>

	<?php endif; ?>

	</nav>
<!-- #<?php echo esc_html( $nav_id ); ?> -->
<?php
}
