<?php
/**
 *
 Template Name: Full Width Page No Title
 *
 * @package base
 */

get_header(); ?>

	<div id="primary" class="content-area sixteen columns">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'pagenotitle' ); ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
