<?php
/**
 * base functions and definitions
 *
 * @package base
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 700; /* pixels */
}

if ( ! function_exists( 'base_setup' ) ) :
	
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function base_setup() {
		
/*
* Make theme available for translation.
* Translations can be filed in the /languages/ directory.
* If you're building a theme based on base, use a find and replace
* to change 'base' to the name of your theme in all the template files
*/
load_theme_textdomain( 'base', get_template_directory() . '/languages' );

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
	'primary' => __( 'Primary Menu', 'base' ),
) );

// Enable support for Post Formats.
add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
// Allows theme developers to link a custom stylesheet file to the TinyMCE visual editor.
function base_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
	}
add_action( 'init', 'base_add_editor_styles' );
	
// Setup the WordPress core custom background feature.
add_theme_support( 'custom-background', apply_filters( 'base_custom_background_args', array(
	'default-color' => 'f9f9f9',
	'default-image' => '',
) ) );

// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // base_setup
add_action( 'after_setup_theme', 'base_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function base_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'base' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
		
// Area footer 1, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'base' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'base' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
// Area footer 2, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'base' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'base' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
// Area footer 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'base' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'base' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
// Area footer 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'base' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'base' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'base_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function base_scripts() {
	wp_enqueue_style( 'base-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'skeleton', get_template_directory_uri().'/css/skeleton.css' );
	
	wp_enqueue_style( 'layout', get_template_directory_uri().'/css/layout.css' );

	wp_enqueue_script( 'base-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'base-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'sticky-nav', get_stylesheet_directory_uri() . '/js/sticky-nav.js', array( 'jquery' ), '', true );
	
	wp_enqueue_style( 'google-webfonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'base_scripts' );

function base_wp_head(){
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.js" type="text/javascript"></script>
	<![endif]-->
	<?php
}
add_action('wp_head', 'base_wp_head');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

/* 
* Option panel
*/

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */

add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

jQuery('#example_showhidden').click(function() {
  jQuery('#section-example_text_hidden').fadeToggle(400);
});

if (jQuery('#example_showhidden:checked').val() !== undefined) {
jQuery('#section-example_text_hidden').show();
}

});
</script>

<?php
}

/*
 * Options panel Customizer.
 */
if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
$optionsframework_settings = get_option('optionsframework');
// Gets the unique option id
$option_name = $optionsframework_settings['id'];
if ( get_option($option_name) ) {
$options = get_option($option_name);
}
if ( isset($options[$name]) ) {
return $options[$name];
} else {
return $default;
}
}
}

/*
 * Pagination.
 */ 
function base_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>&#8230;</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo "<li>&#8230;</li>" . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}

/*
 * Breadcrumb
 */ 
function BaseBreadcrumb() {
    echo '<div class="basebreadcrumb">';
    if (!is_home()) {
        echo '<a href="'. esc_url(home_url('/')) .'">';
        echo 'Home';
        echo "</a> &#187; ";
        if (is_category() || is_single()) {
            the_category('title_li=');
            if (is_single()) {
                echo " &#187; ";
                the_title();
            }
        } elseif (is_page()) {
            echo the_title();
        }
    }
        echo '</div>';
}

/*
 * Add favicon.
 */
 
function base_favicon() { ?>
    <link rel="shortcut icon" href="<?php echo of_get_option( 'favicon_uploader', 'no entry' ); ?>" />
<?php }
add_action('wp_head', 'base_favicon');


/*
 * Woocommerce support.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'base_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'base_wrapper_end', 10);

function base_wrapper_start() {
  echo '<section id="main" class="twelve columns">';
}

function base_wrapper_end() {
  echo '</section>';
}
add_theme_support( 'woocommerce' );