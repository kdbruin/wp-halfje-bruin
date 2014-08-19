<?php

/**
 * Various functions to be used in theme templates.
 */

/**
 * Check if a featured image is available.
 */
function hb_has_post_thumbnail( $post = null )
{
	if ( !$post = get_post( $post ) ) return false;

	if ( has_post_thumbnail( $post->ID ) ) return true;

	if ( class_exists( 'FooGallery_Plugin' ) )
	{
		$shortcodes = foogallery_extract_gallery_shortcodes( $post->post_content );
		if ( !empty( $shortcodes) )
		{
			reset( $shortcodes );
			$id = key( $shortcodes );
			$fg = FooGallery::get_by_id( $id );
			$feat_id = $fg->find_featured_attachment_id();
			if ( $feat_id ) return true;
		}
	}

	if ( function_exists( 'get_the_image' ) )
	{
		$args = array( 
			'post_id' => $post->ID,
			'echo' => false, 
			'link_to_post' => false
		);
		if ( get_the_image( $args ) ) return true;
	}

	return false;
}

/**
 * Display the featured image.
 */
function hb_the_post_thumbnail( $size = 'post-thumbnail', $attr = '' )
{
	echo hb_get_the_post_thumbnail( null, $size, $attr );
}

/**
 * Return the HTML code to display the featured image.
 */
function hb_get_the_post_thumbnail( $post = null, $size = 'post-thumbnail', $attr = '' )
{
	if ( !$post = get_post( $post ) ) return false;

	if ( has_post_thumbnail( $post->ID ) )
	{
		return get_the_post_thumbnail( $post->ID, $size, $attr );
	}

	if ( class_exists( 'FooGallery_Plugin' ) )
	{
		$shortcodes = foogallery_extract_gallery_shortcodes( $post->post_content );
		if ( !empty( $shortcodes) )
		{
			reset( $shortcodes );
			$id = key( $shortcodes );
			$fg = FooGallery::get_by_id( $id );
			$feat_id = $fg->find_featured_attachment_id();

			do_action( 'begin_fetch_post_thumbnail_html', $post->ID, $feat_id, $size );
			if ( $feat_id && $image = wp_get_attachment_image( $feat_id, $size, false, $attr ) ) return $image;
			do_action( 'end_fetch_post_thumbnail_html', $post->ID, $feat_id, $size );
		}
	}

	if ( function_exists( 'get_the_image' ) )
	{
		$args = array( 
			'post_id' => $post->ID,
			'size' => $size,
			'echo' => false, 
			'link_to_post' => false
		);
		if ( $image = get_the_image( $args ) ) return $image;
	}

	return '';
}

/**
 * Return the image count for the first gallery of a post.
 */
function hb_count_post_gallery_images( $post )
{
	if ( !$post = get_post( $post ) ) return 0;

	if ( class_exists( 'FooGallery_Plugin' ) )
	{
		$shortcodes = foogallery_extract_gallery_shortcodes( $post->post_content );
                if ( !empty( $shortcodes) )
                {
			reset( $shortcodes );
                        $id = key( $shortcodes );
                        $fg = FooGallery::get_by_id( $id );
			return count( $fg->attachments() );
                }
	}

	return count( get_post_gallery_images( $post ) );
}

/**
 * Display navigation to next/previous pages when applicable
 */
function gumbo_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Get current theme options
	$theme_options = thsp_cbp_get_options_values();
	
	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;
		
	if ( 'nav-below' == $nav_id && ! $theme_options['post_navigation_below'] )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'gumbo' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>
		<?php
			$previous_post = get_adjacent_post( false, '', true );
			if ( $previous_post )
			{
				$prev_post_class = ( hb_has_post_thumbnail( $previous_post->ID ) ? 'has-image' : '' );
				echo '<div class="prev prev-post ' . $prev_post_class . '">';
					echo '<a href="' . get_permalink( $previous_post->ID ) . '" title="' . sprintf( __( 'Previous post: %1$s', 'gumbo' ), esc_attr( get_the_title( $previous_post->ID ) ) ) . '">';
						echo '<div class="clear">';
							echo hb_get_the_post_thumbnail( $previous_post->ID, 'thumbnail');
							echo '<span class="heading">' . __( 'Previous post', 'gumbo' ) . '</span>';
							echo '<div class="title previous-title">' . get_the_title( $previous_post->ID ) . '</div>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
			}
			$next_post = get_adjacent_post( false, '', false );
			if ( $next_post )
			{
				$next_post_class = ( hb_has_post_thumbnail( $next_post->ID ) ? 'has-image' : '' );
				echo '<div class="next next-post ' . $next_post_class . '">';
					echo '<a href="' . get_permalink( $next_post->ID ) . '" title="' . sprintf( __( 'Next post: %1$s', 'gumbo' ), esc_attr( get_the_title( $next_post->ID ) ) ) . '">';
						echo '<div class="clear">';
							echo hb_get_the_post_thumbnail( $next_post->ID, 'thumbnail');
							echo '<span class="heading">' . __( 'Next post', 'gumbo' ) . '</span>';
							echo '<div class="title next-title">' . get_the_title( $next_post->ID ) . '</div>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
			}
		?>
	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages
		global $wp_query;
		$big = 999999999; // need an unlikely integer
		
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_text' 	=> '&larr;',
			'next_text' 	=> '&rarr;'
		) );
	endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}

