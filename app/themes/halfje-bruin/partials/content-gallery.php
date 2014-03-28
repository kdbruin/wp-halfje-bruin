<?php
/**
 * @package Cazuela
 * @since Cazuela 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( !is_search() ) : // No thumbnail in Search results page ?>
		<?php get_template_part( '/partials/post', 'lead' ); ?>
	<?php endif; ?>
	
	<div class="entry-inner">
		<?php get_template_part( '/partials/post', 'header' ); ?>
	
		<div class="entry-content">
		    <?php echo hb_get_intro_gallery(); ?>
		    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cazuela' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	</div><!-- .entry-inner -->

	<?php get_template_part( '/partials/post', 'footer' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
