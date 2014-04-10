<?php
/**
 * Halfje-Bruin WordPress thema gebaseerd op het Cazuela thema
 *
 * @package Cazuela
 * @subpackage Halfje-Bruin
 * @author Kees de Bruin
 */

/**
 *  Localization
 */
add_action('after_setup_theme', 'hb_theme_setup');
function hb_theme_setup()
{
    load_child_theme_textdomain('halfje-bruin', get_stylesheet_directory() . '/languages');

    add_image_size('portfolio-thumbnail', 290, 170, true);
    add_image_size('portfolio-full', 960, 9999, false);
}

/**
 * Other modifications
 */
//require_once('inc/layout.php');
require_once('inc/image.php');
require_once('inc/gallery.php');
require_once('inc/series.php');

/**
 * Google analytics
 *
 * Make sure to set the correct Tracking-ID in the include file!
 */
//require_once('inc/google_analytics.php');

