<?php

/**
 * Halfje-Bruin WordPress thema gebaseerd op het Gumbo thema
 *
 * @package Gumbo
 * @subpackage Halfje-Bruin - Gumbo
 * @author Kees de Bruin
 */

/**
 * Theme setup
 */
add_action('after_setup_theme', 'hb_theme_setup');

function hb_theme_setup()
{
	/* Localisation */
	load_child_theme_textdomain('halfje-bruin', get_stylesheet_directory() . '/languages');
}

/**
 * Other modifications
 */
require_once ('inc/gallery.php');
require_once ('inc/series.php');
require_once ('inc/template-tags.php');

/**
 * Google analytics
 *
 * Make sure to set the correct Tracking-ID in the include file!
 */
//require_once('inc/google-analytics.php');
