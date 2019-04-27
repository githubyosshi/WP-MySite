<?php
/**
 * Insights functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Insights
 */

if ( ! function_exists( 'insights_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function insights_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Insights, use a find and replace
	 * to change 'insights' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'insights');

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
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
	   'header-text' => array( 'site-title', 'site-description' ),
	) );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'insights-main-banner', 1370, 550, true );


	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'insights_custom_header_args', array(
			'width'         => 1400,
			'height'        => 380,
			'flex-height'   => true,
			'header-text'   => false,
	) ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top' => esc_html__( 'Top Nav', 'insights' ),
		'primary' => esc_html__( 'Primary', 'insights' ),
		'social'   => esc_html__( 'Social Menu', 'insights' ),
		'footer'   => esc_html__( 'Footer Menu', 'insights' ),
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
	add_theme_support( 'custom-background', apply_filters( 'insights_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	if ( class_exists( 'WooCommerce' ) ){
		add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
		    return array(
		        'width'  => 250,
		        'height' => 250,
		        'crop'   => 0,
		    );
		} );
	}
	
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video',
		'gallery',
		'audio',
	) );

	/**
	 * Load Init for Hook files.
	 */
	require get_template_directory() . '/inc/hooks/hooks-init.php';

}
endif;
add_action( 'after_setup_theme', 'insights_setup' );


function insights_ocdi_files() {
    return array(
        array(
            'import_file_name'           =>  esc_html__( 'Demo Content Default', 'insights' ),
            'import_file_url'            =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/default/insights-default.xml',
            'import_widget_file_url'     =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/default/insights-default.wie',
            'import_customizer_file_url' =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/default/insights-default.dat',
            'import_preview_image_url'   =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/images/default.jpg',
        ),
        array(
            'import_file_name'           =>  esc_html__( 'Demo Content Sports', 'insights' ),
            'import_file_url'            =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/sports/insights-sports.xml',
            'import_widget_file_url'     =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/sports/insights-sports.wie',
            'import_customizer_file_url' =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/sports/insights-sports.dat',
            'import_preview_image_url'   =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/images/sports.jpg',
        ),
        array(
            'import_file_name'           =>  esc_html__( 'Demo Content Travel', 'insights' ),
            'import_file_url'            =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/travel/insights-travel.xml',
            'import_widget_file_url'     =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/travel/insights-travel.wie',
            'import_customizer_file_url' =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/travel/insights-travel.dat',
            'import_preview_image_url'   =>  trailingslashit( get_template_directory_uri() ) . 'demo-content/images/travel.jpg',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'insights_ocdi_files' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function insights_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'insights_content_width', 640 );
}
add_action( 'after_setup_theme', 'insights_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function insights_scripts() {
	wp_enqueue_style('ionicons', get_template_directory_uri() . '/assets/libraries/ionicons/css/ionicons.min.css');
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('slick', get_template_directory_uri() . '/assets/libraries/slick/css/slick.min.css');
    wp_enqueue_style('sidr-nav', get_template_directory_uri() . '/assets/libraries/sidr/css/jquery.sidr.dark.css');
	wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/libraries/magnific-popup/magnific-popup.css');
	wp_enqueue_style( 'insights-style', get_stylesheet_uri() );

	wp_add_inline_style( 'insights-style', insights_trigger_custom_css_action() );

	$fonts_url = insights_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'insights-google-fonts', $fonts_url, array(), null );
	}
	wp_enqueue_script( 'insights-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'insights-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('jquery-bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/js/bootstrap.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/js/slick.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-sidr', get_template_directory_uri() . '/assets/libraries/sidr/js/jquery.sidr.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/libraries/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '', true);
	wp_enqueue_script('theiaStickySidebar', get_template_directory_uri() . '/assets/libraries/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);
	wp_enqueue_script('insights-script', get_template_directory_uri() . '/assets/twp/js/custom-script.js', array('jquery'), '', 1);
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'insights_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function insights_admin_scripts( $hook ) {
	if ( 'widgets.php' === $hook ) {
	    wp_enqueue_media();
		wp_enqueue_script( 'insights-custom-widgets', get_template_directory_uri() . '/assets/twp/js/widgets.js', array( 'jquery' ), '1.0.0', true );
	}
	wp_enqueue_style( 'insights-custom-admin-style', get_template_directory_uri() . '/assets/twp/css/wp-admin.css', array(), '1.0.0' );

}
add_action( 'admin_enqueue_scripts', 'insights_admin_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since insights 1.0
 *
 */
function insights_post_nav_background() {
    if ( ! is_single() ) {
        return;
    }

    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );
    $css      = '';

    if ( is_attachment() && 'attachment' == $previous->post_type ) {
        return;
    }

    if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
        $prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
        $css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.single .post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
    }

    if ( $next && has_post_thumbnail( $next->ID ) ) {
        $nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
        $css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.single .post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
    }

    wp_add_inline_style( 'insights-style', $css );
}
add_action( 'wp_enqueue_scripts', 'insights_post_nav_background' );

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
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}