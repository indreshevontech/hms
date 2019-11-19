<?php
/**
 * hospital functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hospital
 */

if ( ! function_exists( 'hospital_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hospital_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hospital use a find and replace
		 * to change 'hospital' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hospital', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary','hospital'),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hospital_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'hospital_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hospital_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hospital_content_width', 640 );
}
add_action( 'after_setup_theme', 'hospital_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/widgets/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/tgm_plugins_activation.php';
require get_template_directory() . '/inc/bs4navwalker.php';
require get_template_directory() . '/inc/extra.php';
require get_template_directory() . '/inc/breadcrubs.php';



define('HOSPITAL_DIR_IMG', get_template_directory_uri().'/assets/images');


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function widget_display_callback( $params ) {

    global $wp_registered_widgets;
    global $my_widget_num; // Global a counter array    

    $id = $params[0]['widget_id'];
    $sidebar_id = $params[0]['id'];

    /*  Set some count for each widgets  */
    if( !$my_widget_num ) { // If the counter array doesn't exist, create it
        $my_widget_num = array();
    }

    if( isset( $my_widget_num[ $sidebar_id ] ) ) { // See if the counter array has an entry for this sidebar
        $my_widget_num[ $sidebar_id ] ++;
    } else { // If not, create it starting with 1
        $my_widget_num[ $sidebar_id ] = 1;
    }

    $widget_counter = $my_widget_num[ $sidebar_id ];
    if( $widget_counter == 1 ) {
        $the_class ='col-md-3';
    } 
    elseif( $widget_counter == 2 ){
        $the_class ='col-md-3';
    } 

    elseif( $widget_counter == 3 ){
        $the_class ='col-md-3';
    }  
    else {
        $the_class ='col-md-3';
    }   

    if ($sidebar_id == 'footer_widgets' && !empty( $the_class ) ) {
        // add  your classes
        $classe_to_add = ' ' . $the_class . ' '; // make sure you leave a space at the end
       $classe_to_add = 'class=" ' . $classe_to_add;
        $params[0]['before_widget'] = str_replace( 'class="', $classe_to_add, $params[0]['before_widget'] );
    }
    return $params;
    }
add_filter( 'dynamic_sidebar_params', 'widget_display_callback', 10 );












