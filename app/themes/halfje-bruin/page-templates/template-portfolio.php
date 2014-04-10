<?php
/**
 * Template Name: Portfolio Index Page
 *
 * @package Cazuela
 * @subpackage Halfje-Bruin
 * @since Cazuela 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php
				// Before Content theme hook callback
				thsp_hook_before_content();
			?>

			<?php
				$args = array('hide_empty=0');
				$terms = get_terms('portfolio_category', $args);
				if (!empty($terms) && !is_wp_error($terms)) {
					$count = count($terms);
					$i = 0;
					$term_list = '<p class="portfolio-archive">';
					foreach ($terms as $term) {
						$i++;
						$term_list .= '<a href="' . get_term_link($term) . '" title="' . sprintf(__('View all post filed under %s', 'halfje-bruin'), $term->name) . '">' . $term->name . '</a>';
						if ($count != $i) {
							$term_list .= ' &middot; ';
						} else {
							$term_list .= '</p>';
						}
					}
					echo $term_list;
				}
			?>
			<?php
				// After Content theme hook callback
				thsp_hook_after_content();
			?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>
