<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Underscore HB
 */
if (!function_exists('underscore_hb_paging_nav')) :

    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function underscore_hb_paging_nav() {
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <nav class="navigation paging-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e('Posts navigation', 'underscore-hb'); ?></h1>
            <ul class="pager">

                <?php if (get_next_posts_link()) : ?>
                    <li class="previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'underscore-hb')); ?></li>
                <?php endif; ?>

                <?php if (get_previous_posts_link()) : ?>
                    <li class="next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'underscore-hb')); ?></li>
                <?php endif; ?>

            </ul><!-- .pager -->
        </nav><!-- .navigation -->
        <?php
    }

endif;

if (!function_exists('underscore_hb_post_nav')) :

    /**
     * Display navigation to next/previous post when applicable.
     */
    function underscore_hb_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e('Post navigation', 'underscore-hb'); ?></h1>
            <ul class="pager">
                <?php
                previous_post_link('<li class="previous">%link</li>', _x('<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'underscore-hb'));
                next_post_link('<li class="next">%link</li>', _x('%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'underscore-hb'));
                ?>
            </ul><!-- .pager -->
        </nav><!-- .navigation -->
        <?php
    }

endif;

if (!function_exists('underscore_hb_page_nav')) :

    /**
     * Display navigation for the individual pages of a page
     */
    function underscore_hb_page_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        global $multipage;
        if (!$multipage)
            return;
        ?>
        <nav class="navigation page-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e('Page navigation', 'underscore-hb'); ?></h1>
            <?php
            $args = array(
                'before' => '<div><ul class="pagination">',
                'after' => '</ul></div>',
                'before_link' => '<li>',
                'after_link' => '</li>',
                'current_before' => '<li class="active">',
                'current_after' => '</li>',
                'previouspagelink' => '&laquo;',
                'nextpagelink' => '&raquo;'
            );
            bootstrap_link_pages($args);
            ?>
        </nav><!-- .navigation -->
        <?php
    }

endif;

if (!function_exists('underscore_hb_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function underscore_hb_posted_on() {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
        );

        printf(__('<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'underscore-hb'), sprintf('<a href="%1$s" rel="bookmark">%2$s</a>', esc_url(get_permalink()), $time_string
                ), sprintf('<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())
                )
        );
    }

endif;

if (!function_exists('underscore_hb_post_title')) :

    /**
     * Prints the post title prefixed with the proper glyphicon for the post format.
     */
    function underscore_hb_post_title() {
        $format = get_post_format();
        $glyphicon = 'align-left';
        if ($format == 'image') {
            $glyphicon = 'picture';
        } else if ($format == 'gallery') {
            $glyphicon = 'th';
        }
        printf('<span class="small glyphicon glyphicon-%s"></span>%s', $glyphicon, get_the_title());
    }

endif;

if (!function_exists('underscore_hb_frontpage_carousel')) :

    /**
     * Prints the front page carousel based on the portfolio custom post type.
     */
    function underscore_hb_frontpage_carousel() {

        // select the last 20 entries
        $args = array(
            'post_type' => 'portfolio',
            'post_status' => 'published',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 20
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) {

            $indicators = '<ol class="carousel-indicators">';
            $slides = '<div class="carousel-inner">';

            $slide_count = 0;

            while ($slide_count < 5 && $query->have_posts()) {
                $query->the_post();
                
                // check the orientation of the image
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($query->post->ID), 'full');
                if ($image[1] < $image[2]) continue;
                
                // add indicator
                $indicators .= "\n" . '<li data-target="#front-page-carousel" data-slide-to="' . $slide_count . '"';
                if ($slide_count == 0) $indicators .= ' class="active"';
                $indicators .= '></li>';
                
                // add slide
                $slides .= "\n" . '<div class="item';
                if ($slide_count == 0) $slides .= ' active';
                $slides .= '">';
                $slides .= "\n" . '<a href="' . get_the_permalink() . '">';
                $slides .= "\n" . get_the_post_thumbnail($query->post->ID, 'front-page-slide', array('class' => 'img-responsive'));
                $slides .= "\n" . '</a>';
                $slides .= "\n" . '<div class="carousel-caption"><h3>' . get_the_title() . '</h3></div>';
                $slides .= "\n" . '</div>';
                
                // increase slide count
                $slide_count++;
            }
            
            $indicators .= "\n" . '</ol>';
            $slides .= "\n" . '</div>';
            
            if ($slide_count > 0) {
                echo '<div id="front-page-carousel" class="carousel slide" data-ride="carousel">';
                echo "\n" . $indicators;
                echo "\n" . $slides;
                echo "\n" . '<a class="left carousel-control" href="#front-page-carousel" data-slide="prev"><span class="glyphicon glyphicon-arrow-left"></span></a>';
                echo "\n" . '<a class="right carousel-control" href="#front-page-carousel" data-slide="next"><span class="glyphicon glyphicon-arrow-right"></span></a>';
                echo "\n" . '</div>';
            }
        }
        
        wp_reset_postdata();
    }

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function underscore_hb_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('underscore_hb_categories') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('underscore_hb_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so underscore_hb_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so underscore_hb_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in underscore_hb_categorized_blog.
 */
function underscore_hb_category_transient_flusher() {
    // Like, beat it. Dig?
    delete_transient('underscore_hb_categories');
}

add_action('edit_category', 'underscore_hb_category_transient_flusher');
add_action('save_post', 'underscore_hb_category_transient_flusher');
