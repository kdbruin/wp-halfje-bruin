<?php

function hb_widget_posts_args_filter($args)
{
	$args['tax_query'] = array( array(
		'taxonomy' => 'post_format',
		'field' => 'slug',
		'terms' => array( 'post-format-aside', 'post-format-quote', 'post-format-link' ),
		'operator' => 'NOT IN',
	) );
	return $args;
}
add_filter('widget_posts_args', 'hb_widget_posts_args_filter');

