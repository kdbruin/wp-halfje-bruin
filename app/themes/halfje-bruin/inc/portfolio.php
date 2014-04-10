<?php

/**
 * Portfolio support functions
 */
function hb_get_random_portfolio_item($slug) {
    $post_id = 0;
    $args = array(
        'post_type' => 'portfolio',
        'orderby' => 'rand',
        'posts_per_page' => '1',
        'category_name' => $slug
    );

    $items = new WP_Query($args);
    while ($items->have_posts()) {
        $items->the_post();
        $post_id = get_the_ID();
    }
    wp_reset_postdata();

    return $post_id;
}
