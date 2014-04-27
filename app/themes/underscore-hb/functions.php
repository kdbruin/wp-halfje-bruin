<?php
/**
 * Underscore HB functions and definitions
 *
 * @package Underscore HB
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750; /* pixels */
}

if ( ! function_exists( 'underscore_hb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function underscore_hb_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Underscore HB, use a find and replace
	 * to change 'underscore-hb' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'underscore-hb', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'frontpage' => __( 'Front Page Menu', 'underscore-hb' ),
		'primary' => __( 'Primary Menu', 'underscore-hb' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'underscore_hb_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // underscore_hb_setup
add_action( 'after_setup_theme', 'underscore_hb_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function underscore_hb_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'underscore-hb' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'underscore_hb_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function underscore_hb_scripts() {
	wp_enqueue_style( 'underscore-hb-style', get_stylesheet_uri() );

	wp_enqueue_script( 'underscore-hb-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'underscore-hb-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.1.1', true );

	wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array( 'underscore-hb-style' ), '3.1.1', 'all' );

	wp_register_style( 'theme-custom-css', get_template_directory_uri() . '/css/custom.min.css', array( 'bootstrap-css' ), '20140416', 'all' );

	wp_enqueue_script( 'bootstrap-js' );
	wp_enqueue_style( 'bootstrap-css' );
	wp_enqueue_style( 'theme-custom-css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'underscore_hb_scripts' );

/**
 * Bootstrap customizations
 */
require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
//require_once get_template_directory() . '/inc/wp_bootstrap_gallery.php';
require_once get_template_directory() . '/inc/wp_bootstrap_link_pages.php';

/**
 * Suppress inline gallery styles
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Do not auto-insert line breaks
 */
remove_filter( 'the_content', 'wpautop' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
