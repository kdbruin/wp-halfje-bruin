<?php
/**
 * The template part that displays a single gallery post in archives.
 *
 * @package Gumbo
 * @since Gumbo 1.0
 */
?>

<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php tha_entry_top(); ?>
	
	<header class="entry-header">
		<a href="<?php the_permalink(); ?>"
			title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'gumbo' ), the_title_attribute( 'echo=0' ) ) ); ?>"
			rel="bookmark">
			<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'thsp-archives-featured', array( 'class' => 'entry-featured' ) );
			endif; // has_post_thumbnail()
			?>		
			
			<?php $count = count( get_post_gallery_images( $post ) ); ?>
			<h1 class="entry-title"><?php the_title(); ?> <span>(<?php echo $count; ?> <?php _e( 'images', 'gumbo' ); ?>)</span>
			</h1>
		</a>
	</header>

	<?php gumbo_post_meta_bottom_compact(); ?>
		
<?php tha_entry_bottom(); ?>
</article>
<!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after(); ?>
