<?php

/** Return the current post ID
 */
function hb_series_get_post_id()
{
    $post_id = 0;

    if (in_the_loop())
	$post_id = get_the_ID();

    else if (is_singular())
	$post_id = get_queried_object_id();

    return $post_id;
}

/** Return the series for the current post
 */
function hb_series_get_series($post_id)
{
    if (empty($post_id))
	return;

    $series = get_the_terms($post_id, 'series');
    if (empty($series))
	return;

    $series = reset($series);

    return $series;
}

/** Show additional post meta information for series
 */
function hb_series_post_meta()
{
    $post_id = hb_series_get_post_id();
    $series = hb_series_get_series($post_id);
    if (empty($series) || empty($series->slug))
	return;

    /* Set up the arguments. */
    $args = array(
	'series' => $series->slug,
	'order' => 'ASC',
	'orderby' => 'date',
	'posts_per_page' => -1,
	'echo' => false
    );

    $out = '';
    $loop = new WP_Query($args);

    if ($loop->have_posts())
    {
	$count = 0;
	$my_index = 0;

	while ($loop->have_posts())
	{
	    $loop->the_post();
	    $count++;
	    if ($post_id === get_the_ID())
		$my_index = $count;
	}

	$series_link = '<a href="' . get_term_link($series) . '">' . $series->name . '</a>';
	$out .= '<p>';
	$out .= sprintf(__('This is part %d of %d in the series "%s"', 'halfje-bruin'), $my_index, $count, $series_link);
	$out .= '</p>';
    }

    wp_reset_postdata();
    
    print $out;
}
