<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cazuela
 * @subpackage Halfje-Bruin
 * @since Cazuela 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php
				// Before Content theme hook callback
				thsp_hook_before_content();
			?>

			<?php
				/* Reverse order of posts in series */
				global $query_string; query_posts($query_string . "&order=ASC");
			?>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
							$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
							printf( __( 'Series Archives: %s', 'halfje-bruin' ), '<span>' . $term->name . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<?php thsp_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="archive-post">
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( '/partials/content', get_post_format() );
					?>
					</div><!-- .archive-post -->

				<?php endwhile; ?>

				<?php thsp_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( '/partials/no-results', 'archive' ); ?>

			<?php endif; ?>

			<?php
				// After Content theme hook callback
				thsp_hook_after_content();
			?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>