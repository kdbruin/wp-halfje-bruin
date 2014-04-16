<?php
/**
 * The template for displaying Portfolio category pages.
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
				/* Select 9 entries per page */
				global $query_string;
				query_posts($query_string . "&posts_per_page=9");
			?>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
							$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
							printf( __( 'Portfolio: %s', 'halfje-bruin' ), '<span>' . $term->name . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<?php thsp_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="hb-portfolio-archive">
					<?php
						get_template_part( '/partials/portfolio', 'thumbnail' );
					?>
					</div><!-- .hb-portfolio-archive -->

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

<?php get_footer(); ?>
