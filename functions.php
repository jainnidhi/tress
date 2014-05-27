<?php
/**
 * Prism functions and definitions
 *
 * @package Prism
 * @since Prism 1.0
 */

require( get_template_directory() . '/inc/customizer.php' ); // new customizer options


if (!class_exists('prism_SL_Theme_Updater')) {
    // Load our custom theme updater
    include( dirname(__FILE__) . '/inc/theme-updater.php' );
}

// configuration file for theme licensing 
// theme updater and licensing

include(get_stylesheet_directory() . '/inc/theme-updater-config.php');


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Prism 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 790; /* Default the embedded content width to 790px */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Prism 1.0
 *
 * @return void
 */
if ( ! function_exists( 'prism_setup' ) ) {
	function prism_setup() {
		global $content_width;

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Prism, use a find and replace
		 * to change 'prism' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'prism', trailingslashit( get_template_directory_uri() ) . 'languages' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Create an extra image size for the Post featured image
		add_image_size( 'post_feature_full_width', 680, 300, true );
                
                
		// Create an extra image size for the Post thumbnail image
		add_image_size( 'post_feature_thumb', 368, 243, true );
                
                // hard crop store front and taxonomy product images for downloads
                add_image_size( 'product-image-large', 680, 300, true );
                
                // hard crop store front and taxonomy product images thumbnail for downloads
                add_image_size( 'product-image-thumb', 370, 243, true );
                
                
		// This theme uses wp_nav_menu() in one location
		register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'prism' )
			) );

		// This theme supports a variety of post formats
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

		// Enable support for Custom Backgrounds
		add_theme_support( 'custom-background', array(
				// Background color default
				'default-color' => 'eee',
				// Background image default
				'default-image' => ''
                                
			) );
               
	}
}
add_action( 'after_setup_theme', 'prism_setup' );



/**
 * Enqueue scripts and styles
 *
 * @since Prism 1.0
 *
 * @return void
 */
function prism_scripts_styles() {

	// Register and enqueue our icon font
	// We're using the awesome Font Awesome icon font. http://fortawesome.github.io/Font-Awesome
	wp_enqueue_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'assets/css/font-awesome.min.css' , array(), '4.0.3', 'all' );
        
        if (class_exists('woocommerce')) {
            wp_enqueue_style( 'prism-woocommerce', trailingslashit( get_template_directory_uri() ) . 'assets/css/prism-woocommerce.css' , array(), '1.0', 'all' );
        }
        wp_enqueue_style( 'flexslider', trailingslashit( get_template_directory_uri() ) . 'assets/css/flexslider.css' , array(), '1.0', 'all' );
        
	$fonts_url = 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,700|Montserrat:400,700';
	if ( !empty( $fonts_url ) ) {
		wp_enqueue_style( 'prism-fonts', esc_url_raw( $fonts_url ), array(), null );
	}

	// Enqueue the default WordPress stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.0', 'all' );
       

	/**
	 * Register and enqueue our scripts
	 */

	// Load Modernizr at the top of the document, which enables HTML5 elements and feature detects
	wp_enqueue_script( 'modernizr', trailingslashit( get_template_directory_uri() ) . 'assets/js/modernizr-2.7.1-min.js', array(), '2.7.1', false );
        wp_enqueue_script('jquery'); 
        wp_enqueue_script('prism-slider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array('jquery'));
        wp_enqueue_script('prism-smint', get_template_directory_uri() . '/assets/js/jquery.smint.js', array());
	wp_enqueue_script( 'prism-slicknav', get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js' );
        wp_enqueue_script('prism-custom-scripts', get_template_directory_uri() . '/assets/js/custom-scripts.js', array(), '1.0', 'all', false);
        
	
	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'prism_scripts_styles' );



/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @since Prism 1.2.5
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string The filtered CSS paths list.
 */
function prism_mce_css( $mce_css ) {
	$fonts_url = 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,700|Montserrat:400,700';

	if ( empty( $fonts_url ) ) {
		return $mce_css;
	}

	if ( !empty( $mce_css ) ) {
		$mce_css .= ',';
	}

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $fonts_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'prism_mce_css' );


/**
 * Register widgetized areas
 *
 * @since Prism 1.0
 *
 * @return void
 */
function prism_widgets_init() {
	register_sidebar( array(
			'name' => esc_html__( 'Main Sidebar', 'prism' ),
			'id' => 'sidebar-main',
			'description' => esc_html__( 'Appears in the sidebar on posts and pages except the optional Front Page template, which has its own widgets', 'prism' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Footer #1', 'prism' ),
			'id' => 'sidebar-footer1',
			'description' => esc_html__( 'Appears in the footer sidebar', 'prism' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Footer #2', 'prism' ),
			'id' => 'sidebar-footer2',
			'description' => esc_html__( 'Appears in the footer sidebar', 'prism' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Footer #3', 'prism' ),
			'id' => 'sidebar-footer3',
			'description' => esc_html__( 'Appears in the footer sidebar', 'prism' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Footer #4', 'prism' ),
			'id' => 'sidebar-footer4',
			'description' => esc_html__( 'Appears in the footer sidebar', 'prism' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
}
add_action( 'widgets_init', 'prism_widgets_init' );


/**
 * Adjusts content_width value for full-width templates and attachments
 *
 * @since Prism 1.0
 *
 * @return void
 */
function prism_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1100;
	}
}
add_action( 'template_redirect', 'prism_content_width' );


/**
 * Change the "read more..." link so it links to the top of the page rather than part way down
 *
 * @since Prism 1.0
 *
 * @param string The 'Read more' link
 * @return string The link to the post url without the more tag appended on the end
 */
function prism_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'prism_remove_more_jump_link' );


/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Prism 1.0
 *
 * @return string The 'Continue reading' link
 */
function prism_continue_reading_link() {
	return '&hellip;<p><a class="more-link" href="'. esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue reading', 'prism' ) . ' &lsquo;' . get_the_title() . '&rsquo;">' . wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'prism' ), array( 'span' => array( 
			'class' => array() ) ) ) . '</a></p>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with the prism_continue_reading_link().
 *
 * @since Prism 1.0
 *
 * @param string Auto generated excerpt
 * @return string The filtered excerpt
 */
function prism_auto_excerpt_more( $more ) {
	return prism_continue_reading_link();
}
add_filter( 'excerpt_more', 'prism_auto_excerpt_more' );



/*
 * 
 * Set excerpt length for post on front page
 * and post excerpts on rest of the pages.
 * 
 */
function prism_excerpt_length($length) {
    global $post;
    if ($post->post_type == 'post') {
        return 20;
    }
   
    else {
        return 50;
    }
}
add_filter('excerpt_length', 'prism_excerpt_length');


/**
 * Add Filter to allow Shortcodes to work in the Sidebar
 *
 * @since Prism 1.0
 */
add_filter( 'widget_text', 'do_shortcode' );

/** 
 * Additional settings for Easy Digital Downloads
 * 
 * @since Prism 1.0
 */


/**
 * Recreate the default filters on the_content
 * This will make it much easier to output the Theme Options Editor content with proper/expected formatting.
 * We don't include an add_filter for 'prepend_attachment' as it causes an image to appear in the content, on attachment pages.
 * Also, since the Theme Options editor doesn't allow you to add images anyway, no big deal.
 *
 * @since Prism 1.0
 */
add_filter( 'meta_content', 'wptexturize' );
add_filter( 'meta_content', 'convert_smilies' );
add_filter( 'meta_content', 'convert_chars'  );
add_filter( 'meta_content', 'wpautop' );
add_filter( 'meta_content', 'shortcode_unautop'  );


/*
 * Check if the front page is set 
 * to display latest blog posts
 * or a static front page
 * 
 * If it's set to display blog posts
 * then ignore the front-page.php 
 * template and head over to index.php
 * 
 *  
 * @since Prism 1.0
 */


function prism_filter_front_page_template( $template ) {
     return is_home() ? '' : $template ;
}
add_filter( 'frontpage_template', 'prism_filter_front_page_template' );


function prism_custom_favicon(){ 
    if(get_theme_mod('custom_favicon')) { ?>
    <link rel="shortcut icon" href="<?php echo get_theme_mod('custom_favicon'); ?> " />
    <?php }
}
add_action('wp_head','prism_custom_favicon');


/* Add theme extras */
require( get_template_directory() . '/inc/theme-extras.php' );

/**
 * Add support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );