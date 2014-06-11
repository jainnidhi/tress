<?php

/* 
 * Tress extra functions that extend the look and feel 
 * of the theme. 
 * 
 * @package Tress
 * @since Tress 1.0 
 */


/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Tress 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function tress_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the blog name.
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'tress' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'tress_wp_title', 10, 2 );


/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Tress 1.0
 *
 * @param string html ID
 * @return void
 */
if ( ! function_exists( 'tress_content_nav' ) ) {
	function tress_content_nav( $nav_id ) {
		global $wp_query;
		$big = 999999999; // need an unlikely integer

		$nav_class = 'site-navigation paging-navigation';
		if ( is_single() ) {
			$nav_class = 'site-navigation post-navigation nav-single';
		}
		?>
		<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
			<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'tress' ); ?></h3>

			<?php if ( is_single() ) { // navigation links for single posts ?>

				<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '<i class="fa fa-angle-left"></i>', 'Previous post link', 'tress' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '<i class="fa fa-angle-right"></i>', 'Next post link', 'tress' ) . '</span>' ); ?>

			<?php } 
			elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { // navigation links for home, archive, and search pages ?>

				<?php echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var( 'paged' ) ),
					'total' => $wp_query->max_num_pages,
					'type' => 'list',
					'prev_text' => wp_kses( __( '<i class="fa fa-angle-left"></i> Previous', 'tress' ), array( 'i' => array( 
						'class' => array() ) ) ),
					'next_text' => wp_kses( __( 'Next <i class="fa fa-angle-right"></i>', 'tress' ), array( 'i' => array( 
						'class' => array() ) ) )
				) ); ?>

			<?php } ?>

		</nav><!-- #<?php echo $nav_id; ?> -->
		<?php
	}
}


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own tress_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 * (Note the lack of a trailing </li>. WordPress will add it itself once it's done listing any children and whatnot)
 *
 * @since Tress 1.0
 *
 * @param array Comment
 * @param array Arguments
 * @param integer Comment depth
 * @return void
 */
if ( ! function_exists( 'tress_comment' ) ) {
	function tress_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="pingback">
					<p><?php esc_html_e( 'Pingback:', 'tress' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'tress' ), '<span class="edit-link">', '</span>' ); ?></p>
				</article> <!-- #comment-##.pingback -->
			<?php
			break;
		default :
			// Proceed with normal comments.
			global $post; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard">
						<?php
						echo get_avatar( $comment, 44 );
						printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span> ' . esc_html__( 'Post author', 'tress' ) . '</span>' : '' );
						printf( '<a href="%1$s" title="Posted %2$s"><time itemprop="datePublished" datetime="%3$s">%4$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							sprintf( esc_html__( '%1$s @ %2$s', 'tress' ), esc_html( get_comment_date() ), esc_attr( get_comment_time() ) ),
							get_comment_time( 'c' ),
							/* Translators: 1: date, 2: time */
							sprintf( esc_html__( '%1$s at %2$s', 'tress' ), get_comment_date(), get_comment_time() )
						);
						?>
					</header> <!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) { ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'tress' ); ?></p>
					<?php } ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'tress' ), '<p class="edit-link">', '</p>' ); ?>
					</section> <!-- .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses( __( 'Reply <span>&darr;</span>', 'tress' ), array( 'span' => array() ) ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div> <!-- .reply -->
				</article> <!-- #comment-## -->
			<?php
			break;
		} // end comment_type check
	}
}



/**
 * Prints HTML with meta information for current post: author and date
 *
 * @since Tress 1.0
 *
 * @return void
 */
if ( ! function_exists( 'tress_posted_on' ) ) {
	function tress_posted_on() {
		$post_icon = '';
		switch ( get_post_format() ) {
			case 'aside':
				$post_icon = 'fa-file-o';
				break;
			case 'audio':
				$post_icon = 'fa-volume-up';
				break;
			case 'chat':
				$post_icon = 'fa-comment';
				break;
			case 'gallery':
				$post_icon = 'fa-camera';
				break;
			case 'image':
				$post_icon = 'fa-picture-o';
				break;
			case 'link':
				$post_icon = 'fa-link';
				break;
			case 'quote':
				$post_icon = 'fa-quote-left';
				break;
			case 'status':
				$post_icon = 'fa-user';
				break;
			case 'video':
				$post_icon = 'fa-video-camera';
				break;
			default:
				$post_icon = 'fa-calendar';
				break;
		}

		// Translators: 1: Icon 2: Permalink 3: Post date and time 4: Publish date in ISO format 5: Post date
		$date = sprintf( '<i class="fa fa-clock-o"></i> <a href="%2$s" title="Posted %3$s" rel="bookmark"><time class="entry-date" datetime="%4$s" itemprop="datePublished">%5$s</time></a>',
			$post_icon,
			esc_url( get_permalink() ),
			sprintf( esc_html__( '%1$s @ %2$s', 'tress' ), esc_html( get_the_date() ), esc_attr( get_the_time() ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		// Translators: 1: Date link 2: Author link 3: Categories 4: No. of Comments
		$author = sprintf( '<i class="fa fa-user"></i> <address class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></address>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'tress' ), get_the_author() ) ),
			get_the_author()
		);

		// Return the Categories as a list
		$categories_list = get_the_category_list( esc_html__( ' ', 'tress' ) );

		// Translators: 1: Permalink 2: Title 3: No. of Comments
		$comments = sprintf( '<span class="comments-link"><i class="fa fa-comment"></i> <a href="%1$s" title="%2$s">%3$s</a></span>',
			esc_url( get_comments_link() ),
			esc_attr( esc_html__( 'Comment on ' . the_title_attribute( 'echo=0' ) ) ),
			( get_comments_number() > 0 ? sprintf( _n( '%1$s Comment', '%1$s Comments', get_comments_number() ), get_comments_number() ) : esc_html__( 'No Comments', 'tress' ) )
		);

		// Translators: 1: Date 2: Author 3: Categories 4: Comments
		printf( wp_kses( __( '<div class="header-meta">%1$s%2$s<span class="post-categories">%3$s</span>%4$s</div>', 'tress' ), array( 
			'div' => array ( 
				'class' => array() ), 
			'span' => array( 
				'class' => array() ) ) ),
			$date,
			$author,
			$categories_list,
			( is_search() ? '' : $comments )
		);
	}
}


/* Display icon for blog post using 
 * Post Format - get_post_format() function 
 * 
 * @since Tress 1.0
 */

function tress_post_format_icon() { 
    if(!is_single()) {
    ?>
     <?php $format = get_post_format();
      ?>
     <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>" ><span class="post_format">
     <?php if ($format == 'video')  { ?>
     <i class="fa fa-film"></i>
     <?php } elseif ($format == 'gallery')  { ?>
     <i class="fa fa-picture-o"></i>
     <?php } elseif ($format == 'image')  { ?>
     <i class="fa fa-user"></i>
     <?php } elseif ($format == 'quote')  { ?>
     <i class="fa fa-quote-left"></i>
     <?php } elseif ($format == 'link')  { ?>
     <i class="fa fa-link"></i>
     <?php } else { ?>
     <i class="fa fa-file-text"></i>

     <?php } ?>
     </span></a>
<?php }
}

/**
 * Prints HTML with meta information for current post: categories, tags, permalink
 *
 * @since Tress 1.0
 *
 * @return void
 */
if ( ! function_exists( 'tress_entry_meta' ) ) {
	function tress_entry_meta() {
		// Return the Tags as a list
		$tag_list = "";
		if ( get_the_tag_list() ) {
			$tag_list = get_the_tag_list( '<span class="post-tags">', esc_html__( ' ', 'tress' ), '</span>' );
		}

		// Translators: 1 is tag
		if ( $tag_list ) {
			printf( wp_kses( __( '<i class="fa fa-tag"></i> %1$s', 'tress' ), array( 'i' => array( 'class' => array() ) ) ), $tag_list );
		}
	}
}


/**
 * Extend the user contact methods to include Twitter, Facebook and Google+
 *
 * @since Tress 1.0
 *
 * @param array List of user contact methods
 * @return array The filtered list of updated user contact methods
 */
function tress_new_contactmethods( $contactmethods ) {
	// Add Twitter
	$contactmethods['twitter'] = 'Twitter';

	//add Facebook
	$contactmethods['facebook'] = 'Facebook';

	//add Google Plus
	$contactmethods['googleplus'] = 'Google+';

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'tress_new_contactmethods', 10, 1 );


/**
 * Add a filter for wp_nav_menu to add an extra class for menu items that have children (ie. sub menus)
 * This allows us to perform some nicer styling on our menu items that have multiple levels (eg. dropdown menu arrows)
 *
 * @since Tress 1.0
 *
 * @param Menu items
 * @return array An extra css class is on menu items with children
 */
function tress_add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item';
		}
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'tress_add_menu_parent_class' );


/* ******************************** */
/* Add body class for color scheme */
/* ******************************** */
add_filter('body_class', 'tress_body_classes');
function tress_body_classes($classes) {
    
    if(get_theme_mod('tress_color_scheme')) {
        $slug = strtolower(get_theme_mod('tress_color_scheme'));
        $classes[] = 'tress-' . $slug;
        
    }
    
    $bg_slug = get_theme_mod('tress_bg_color_scheme');
    if (is_front_page()) {
        $classes[] = $bg_slug . '-tress-front-page';
    }
    $classes[] = 'tress-bg-'.$bg_slug; 
        
    return $classes; 
    
}


/* ***************************************** */
/* Add License key for Envira Gallery Plugin */
/* ***************************************** */

add_action( 'after_setup_theme', 'tress_envira_define_license_key' );
function tress_envira_define_license_key() {
    
    // If the key has not already been defined, define it now.
    if ( ! defined( 'ENVIRA_LICENSE_KEY' ) ) {
        define( 'ENVIRA_LICENSE_KEY', 'f21b503f7793be583daab680a7f8bda7' );
    }
    
}



/* ******************************** */
/* WooCommerce specific functions */
/* ******************************** */

// Remove default WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );

add_theme_support( 'woocommerce' );
// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}


/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'tress_woocommerce_image_dimensions', 1 );
 
/**
 * Define image sizes
 */
function tress_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '349',	// px
		'height'	=> '349',	// px
		'crop'		=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '362',	// px
		'height'	=> '362',	// px
		'crop'		=> 1 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '150',	// px
		'height'	=> '150',	// px
		'crop'		=> 0 		// false
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

//Remove the upsell display so that woo doesn't show upsell items on the single page and we can use our combo display
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );