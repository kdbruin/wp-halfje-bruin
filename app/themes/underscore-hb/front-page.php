<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Underscore HB
 */
// enqueue some JavaScript in the footer
wp_enqueue_script('front-page-js', get_template_directory_uri() . '/js/front-page.js', array('bootstrap-js'), '20140427', true);

get_header('front-page');
?>

<div id="primary" class="content-area col-md-12">
    <main id="main" class="site-main" role="main">

        <?php underscore_hb_frontpage_carousel(); ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer('front-page'); ?>
