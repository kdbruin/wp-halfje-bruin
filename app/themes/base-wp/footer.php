<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package base
 */
?>

	</div><!-- #content -->
	</div><!-- wide contenitor-->
	<footer id="colophon" class="site-footer" role="contentinfo">
  		 <div class="widget-footer container">
   			<?php get_sidebar( 'footer' ); ?>
   		</div><!-- .widget-footer -->
		<div class="site-info">
		<?php esc_attr_e( '&copy;', 'base' ); ?> <?php _e( date( 'Y' ) ); ?> <a href="<?php echo esc_url(home_url( '/' )) ?>" target="_blank" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		<?php bloginfo( 'name' ); ?>
        </a>        
        <span class="sep"> | </span>		 
		<?php printf( __( 'Theme: %1$s by %2$s ', 'base' ), 'Base WP', '<a href="http://iografica.it/" rel="designer">iografica.it</a>' ); ?>
        <span class="sep"> | </span>
		<?php printf( __( 'Powered by ', 'base' )); ?><a href="http://wordpress.org/" rel="generator">
		<?php printf( __( '%s', 'base' ), 'WordPress' ); ?></a>             
        </div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>