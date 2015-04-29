<?php

function hb_gridsby_theme_setup()
{
    add_theme_support( 'post-formats', array( 'image', 'quote' ) );
}
add_action( 'after_setup_theme', 'hb_gridsby_theme_setup', 20 );

function hb_gridsby_enqueue_styles()
{
    wp_enqueue_style( 'gridsby-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'hb-gridsby-style', get_stylesheet_directory_uri() . '/style.css', array( 'gridsby-style' ) );
}
add_action( 'wp_enqueue_scripts', 'hb_gridsby_enqueue_styles' );

