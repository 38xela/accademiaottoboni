<?php 
/*
 * Set up the content width value based on the theme's design.
 */
if ( ! function_exists( 'impressive_setup' ) ) :
function impressive_setup() {
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Main Menu', 'impressive' ),	
	) );
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 900;
			/*
		 * Make impressive theme available for translation.
		 */

	load_theme_textdomain( 'impressive', get_template_directory() . '/languages' );
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style(array('css/editor-style.css', impressive_font_url()));
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');
	add_theme_support( 'title-tag' );
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(672, 372, true);
	add_image_size('impressive-full-width', 1110, 576, true);
	add_image_size('impressive-home-blog-image', 570, 190, true);
	/*        
	* Switch default core markup for search form, comment form, and comments        
	* to output valid HTML5.        
	*/
	add_theme_support('html5', array(
	   'search-form', 'comment-form', 'comment-list',
	));
	// Add support for featured content.
	add_theme_support('featured-content', array(
	   'featured_content_filter' => 'impressive_get_featured_posts',
	   'max_posts' => 6,
	));
	
	add_theme_support( 'custom-header', apply_filters( 'impressive_custom_header_args', array(
	'uploads'       => true,
	'flex-height'   => true,
	'default-text-color' => '#fff',
	'header-text' => true,
	'height' => '120',
	'width'  => '1260'
 	) ) );
	add_theme_support( 'custom-background', apply_filters( 'impressive_custom_background_args', array(
	'default-color' => 'f5f5f5',
	) ) );
	// This theme uses its own gallery styles.       
	add_filter('use_default_gallery_style', '__return_false');   	
}

endif; // impressive_setup
add_action( 'after_setup_theme', 'impressive_setup' );


/***  excerpt Length ***/ 
function impressive_change_excerpt_more( $more ) {
    return '<div class="read-more"><a class="site-btn" href="'. get_permalink() . '" >'.__('READ MORE','impressive').'</a></div>';
}
add_filter('excerpt_more', 'impressive_change_excerpt_more');


add_action('wp_head','impressive_header_bg_img_css');
function impressive_header_bg_img_css()
{
	$impressive_options = get_option('impressive_theme_options');
	$impressive_header_bg_img = esc_url($impressive_options['headertop-bg']);
	$impressive_touch_bg_img = esc_url($impressive_options['get-in-touch-background']);
	$impressive_header_output="<style> .header_bg { background :url('".$impressive_header_bg_img."'); } </style>";
	$impressive_touch_output="<style> .get-in-touch { background :url('".$impressive_touch_bg_img."'); } </style>";
	echo $impressive_header_output;
	echo $impressive_touch_output;
}

/*** Enqueue css and js files ***/
require get_template_directory() . '/functions/enqueue-files.php';

/*** Theme Default Setup ***/
require get_template_directory() . '/functions/theme-default-setup.php';

/*** Breadcrumbs ***/
require get_template_directory() . '/functions/breadcrumbs.php';

/*** Theme Option ***/
require get_template_directory() . '/theme-options/theme-options.php';

