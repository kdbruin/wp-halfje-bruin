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
function hb_theme_setup()
{
	/* Localisation */
	load_child_theme_textdomain( 'halfje-bruin', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'hb_theme_setup' );

/**
 * Update hooks and actions
 */
function hb_update_actions()
{
	remove_action( 'gumbo_credits', 'gumbo_footer_credits', 10 );
}
add_action( 'init', 'hb_update_actions' );

/**
 * Other modifications
 */
require_once ( get_stylesheet_directory() . '/inc/gallery.php' );
require_once ( get_stylesheet_directory() . '/inc/series.php' );
require_once ( get_stylesheet_directory() . '/inc/template-tags.php' );
