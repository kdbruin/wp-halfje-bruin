<?php
/**
 * Template part for displaying post header.
 *
 * @package Cazuela
 * @subpackage Halfje-Bruin
 * @since Cazuela 1.0
 */
?>

<header class="entry-header">
    <?php if (is_singular()) { ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php } else { ?>
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'halfje-bruin'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    <?php } ?>

    <?php if ('post' == get_post_type()) : ?>
        <div class="entry-meta">
            <?php thsp_posted_on(); ?>
            <?php hb_series_post_meta(); ?>
        </div><!-- .entry-meta -->
    <?php endif; ?>
</header><!-- .entry-header -->