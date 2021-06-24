<?php
/**
 * SalimBrothers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SalimBrothers
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'salimbrothers_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function salimbrothers_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on SalimBrothers, use a find and replace
		 * to change 'salimbrothers' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'salimbrothers', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'salimbrothers' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'salimbrothers_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		global $wpdb;

        $buying_table = $wpdb->prefix . "product_buy"; 

		$selling_table = $wpdb->prefix . "product_sell"; 

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $buying_table (
          id bigint(9) NOT NULL AUTO_INCREMENT,
          size tinytext NOT NULL,
		  load_truck bigint(9) NOT NULL,
          quantity bigint(9) NOT NULL,          
          price bigint(9) NULL,
          buying_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,     
		  buying_from tinytext NOT NULL,           
          UNIQUE KEY ( id ), PRIMARY KEY (id)
        ) $charset_collate;";

        $sql2 = "CREATE TABLE $selling_table (
          id bigint(9) NOT NULL AUTO_INCREMENT,
          size tinytext NOT NULL,
		  load_truck bigint(9) NOT NULL,
          quantity bigint(9) NOT NULL,          
          price bigint(9) NULL,
          selling_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,  
		  sellig_to tinytext NOT NULL,              
          UNIQUE KEY ( id ), PRIMARY KEY (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta( $sql );

		dbDelta( $sql2 );
	}
endif;
add_action( 'after_setup_theme', 'salimbrothers_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function salimbrothers_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'salimbrothers_content_width', 640 );
}
add_action( 'after_setup_theme', 'salimbrothers_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function salimbrothers_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'salimbrothers' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'salimbrothers' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'salimbrothers_widgets_init' );

/**
 * Enqueue scripts and styles For Front-end.
 **********************************************/
function salimbrothers_scripts() {
	wp_enqueue_style( 'salimbrothers-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'salimbrothers-style', 'rtl', 'replace' );
	wp_enqueue_style( 'salimbrothers-bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css');			
	wp_enqueue_style( 'salimbrothers-preloader.min', get_template_directory_uri() . '/css/preloader.min.css');			
	wp_enqueue_style( 'salimbrothers-circle', get_template_directory_uri() . '/css/circle.css');			
	wp_enqueue_style( 'salimbrothers-font-awesome.min', get_template_directory_uri() . '/css/font-awesome.min.css');			
	wp_enqueue_style( 'salimbrothers-fm.revealator.jquery.min', get_template_directory_uri() . '/css/fm.revealator.jquery.min.css');
	wp_enqueue_style( 'salimbrothers-theme-style', get_template_directory_uri() . '/css/style.css');
	wp_enqueue_style( 'salimbrothers-skin-yellow', get_template_directory_uri() . '/css/skins/yellow.css');

	wp_enqueue_script( 'salimbrothers-modernizr.custom', get_template_directory_uri() . '/js/modernizr.custom.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-jquery-3.5.0.min', get_template_directory_uri() . '/js/jquery-3.5.0.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-preloader.min', get_template_directory_uri() . '/js/preloader.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-fm.revealator.jquery.min', get_template_directory_uri() . '/js/fm.revealator.jquery.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-imagesloaded.pkgd.min', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-masonry.pkgd.min', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-classie', get_template_directory_uri() . '/js/classie.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-cbpGridGallery', get_template_directory_uri() . '/js/cbpGridGallery.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-jquery.hoverdir', get_template_directory_uri() . '/js/jquery.hoverdir.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-popper.min', get_template_directory_uri() . '/js/popper.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-custom', get_template_directory_uri() . '/js/custom.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'salimbrothers-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'salimbrothers_scripts' );

/**
 * Enqueue scripts and styles For Backend.
 ********************************************/
add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() { 	 
	/*
	## Admin Backend Style Customization
	***************************************/
  wp_enqueue_style( 'salimbrothers-admin_css', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'salimbrothers-bootstrap', get_template_directory_uri() . '/css/bootstrap.css');	 

	/*
	## Admin Backend Custom Scripts
	***************************************/
	wp_enqueue_script( 'salimbrothers-admin-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'salimbrothers-bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array(), _S_VERSION, true );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*
 * Custom Menu.
 */ 
require get_template_directory(). '/inc/custom-menu.php';

/*
 * Custom Post Type.
 */ 
require get_template_directory(). '/inc/custom-post-type.php';

/*
 * Custom Post Meta.
 */ 
require get_template_directory(). '/inc/custom-meta.php';

/*
 * Custom Functions.
 */ 
require get_template_directory(). '/inc/custom-functions.php'; 

/*
 * Invoice Meta Function.
 */ 
require get_template_directory(). '/inc/invoice-meta.php';

/*
 * Invoice Meta Function.
 */ 
require get_template_directory(). '/inc/invoice-pdf.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function currency_price($amount, $poisa){

	$taka = '<span class="currency">Tk.</span> '.number_format($amount,$poisa);

	return $taka;
} 

add_filter('show_admin_bar', '__return_false');