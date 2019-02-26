<?php
/**
 * Core functions used for the theme
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

/**
 * Returns theme mod
 *
 * @since 1.0.0
 */
function wpex_get_theme_mod( $key, $default = null ) {
	if ( ! empty( $_GET[$key] ) ) {
		return ( 'false' == $_GET[$key] ) ? false : $_GET[$key];
	} else {
		return get_theme_mod( $key, $default );
	}
}

/**
 * Echos theme mod
 *
 * @since 1.0.0
 */
function wpex_theme_mod( $key, $default = null ) {
	echo wpex_get_theme_mod( $key, $default );
}

/**
 * Returns correct ID for any object
 * Used to fix issues with translation plugins such as WPML
 *
 * @since 3.1.1
 */
function wpex_parse_obj_id( $id = '', $type = 'page' ) {
	if ( $id && function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, $type );
	}
	return $id;
}

/**
 * Array of image crop locations
 *
 * @link 2.0.0
 */
function wpex_image_crop_locations() {
	return array(
		' '             => esc_html__( 'Default', 'today' ),
		'left-top'      => esc_html__( 'Top Left', 'today' ),
		'right-top'     => esc_html__( 'Top Right', 'today' ),
		'center-top'    => esc_html__( 'Top Center', 'today' ),
		'left-center'   => esc_html__( 'Center Left', 'today' ),
		'right-center'  => esc_html__( 'Center Right', 'today' ),
		'center-center' => esc_html__( 'Center Center', 'today' ),
		'left-bottom'   => esc_html__( 'Bottom Left', 'today' ),
		'right-bottom'  => esc_html__( 'Bottom Right', 'today' ),
		'center-bottom' => esc_html__( 'Bottom Center', 'today' ),
	);
}

/**
 * Parse image crop option and returns correct value for add_image_size
 *
 * @link 2.0.0
 */
function wpex_parse_image_crop( $crop = 'true' ) {
	$return = true;
	if ( $crop && is_string( $crop ) && array_key_exists( $crop, wpex_image_crop_locations() ) ) {
		$return = explode( '-', $crop );
	}
	$return = $return ? $return : true;
	return $return;
}

/**
 * Get first post with featured image in current query
 *
 * @since 1.0.0
 */
function wpex_get_featured_post( $query = '' ) {
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}
	$posts = $query->posts;
	$posts_count = count( $posts );
	if ( $posts_count == 0 ) {
		return;
	}
	$post_with_thumb = 0;
	foreach ( $posts as $post ) {
		if ( has_post_thumbnail( $post->ID ) ) {
			$post_with_thumb = $post->ID;
			break;
		}
	}
	return $post_with_thumb;
}

/**
 * Returns correct header logo src
 *
 * @since 1.0.0
 */
function wpex_get_header_logo_src() {
	$src = wpex_get_theme_mod( 'logo' );
	$src = apply_filters( 'wpex_header_logo_src', $src );
	$src = esc_url( $src );
	return $src;
}

/**
 * Returns escaped post title
 *
 * @since 1.0.0
 */
function wpex_get_esc_title() {
	return esc_attr( the_title_attribute( 'echo=0' ) );
}

/**
 * Outputs escaped post title
 *
 * @since 1.0.0
 */
function wpex_esc_title() {
	echo wpex_get_esc_title();
}

/**
 * Returns current page or post ID
 *
 * @since 1.0.0
 */
function wpex_get_the_id() {

	// If singular get_the_ID
	if ( is_singular() ) {
		return get_the_ID();
	}

	// Get ID of WooCommerce product archive
	elseif ( is_post_type_archive( 'product' ) && class_exists( 'Woocommerce' ) && function_exists( 'wc_get_page_id' ) ) {
		$shop_id = wc_get_page_id( 'shop' );
		if ( isset( $shop_id ) ) {
			return wc_get_page_id( 'shop' );
		}
	}

	// Posts page
	elseif ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
		return $page_for_posts;
	}

	// Return nothing
	else {
		return NULL;
	}

}

/**
 * Returns entry image size
 *
 * @since 1.0.0
 */
function wpex_get_entry_image_size() {
	global $is_featured_post;
	if ( $is_featured_post ) {
		$size = 'wpex_entry_featured';
	} else {
		$size = 'wpex_entry';
	}
	return apply_filters( 'wpex_get_entry_image_size', $size );
}

/**
 * Returns current page or post layout
 *
 * @since 1.0.0
 */
function wpex_get_loop_columns() {

	// Default is 2
	$columns = '2';

	// Check URL
	if ( ! empty( $_GET['loop_columns'] ) ) {
		return $_GET['loop_columns'];
	}

	// Get post ID
	$post_id = wpex_get_the_id();

	// Set default layout
	if ( is_front_page() ) {
		$columns = wpex_get_theme_mod( 'home_entry_columns', '2' );
	} else {
		$columns = wpex_get_theme_mod( 'entry_columns', '2' );
	}

	// Apply filters
	$columns = apply_filters( 'wpex_loop_columns', $columns );

	// Return layout
	return $columns;

}

/**
 * Returns current page or post layout
 *
 * @since 1.0.0
 */
function wpex_get_post_layout() {

	// Check URL
	if ( ! empty( $_GET['post_layout'] ) ) {
		return $_GET['post_layout'];
	}

	// Get post ID
	$post_id = wpex_get_the_id();

	// Set default layout
	$layout = 'right-sidebar';

	// Posts
	if ( is_page() ) {
		$layout = wpex_get_theme_mod( 'page_layout' );
	}

	// Posts
	elseif ( is_singular() ) {
		$layout = wpex_get_theme_mod( 'post_layout' );
	}

	// Full-width pages
	if ( is_404()
		|| is_page_template( 'templates/login-register.php' )
		|| is_page_template( 'templates/archives.php' )
	) {
		$layout = 'full-width';
	}

	// Homepage
	elseif ( is_home() || is_front_page() ) {
		$layout = wpex_get_theme_mod( 'home_layout' );
	}

	// Search
	elseif ( is_search() ) {
		$layout = wpex_get_theme_mod( 'search_layout' );
	}

	// Archive
	elseif ( is_archive() ) {
		$layout = wpex_get_theme_mod( 'archives_layout' );
	}

	// Apply filters
	$layout = apply_filters( 'wpex_post_layout', $layout );

	// Check meta
	if ( $meta = get_post_meta( wpex_get_the_id(), 'wpex_post_layout', true ) ) {
		$layout = $meta;
	}

	// Sanitize
	$layout = $layout ? $layout : 'right-sidebar';

	// Return layout
	return $layout;

}

/**
 * Returns target blank
 *
 * @since 1.0.0
 */
function wpex_get_target_blank( $display = false ) {
	if ( $display ) {
		return ' target="_blank"';
	}
}

/**
 * Echos target blank
 *
 * @since 1.0.0
 */
function wpex_target_blank( $display = false ) {
	echo wpex_get_target_blank( $display );
}

/**
 * Sanitizes data
 *
 * @since 1.0.0
 */
function wpex_sanitize( $data = '', $type = null ) {

	// Advertisement
	if ( 'advertisement' == $type ) {
		return $data;
	}

	// URL
	elseif ( 'url' == $type ) {
		$data = esc_url( $data );
	}

	// CSS
	elseif ( 'css' == $type ) {
		$data = $data; // nothing yet
	}

	// Image
	elseif ( 'img' == $type || 'image' == $type ) {
		$data = wp_kses( $data, array(
			'img'       => array(
				'src'   => array(),
				'alt'   => array(),
				'title' => array(),
				'data'  => array(),
				'id'    => array(),
				'class' => array(),
			),
		) );
	}

	// Link
	elseif ( 'link' == $type ) {
		$data = wp_kses( $data, array(
			'a'         => array(
				'href'  => array(),
				'title' => array(),
				'rel'   => array(),
				'class' => array(),
				'data'  => array(),
				'id'    => array(),
			),
		) );
	}

	// HTML
	elseif ( 'html' == $type ) {
		$data = htmlspecialchars_decode( wp_kses_post( $data ) );
	}

	// Videos
	elseif ( 'video' == $type || 'audio' == $type || 'embed' ) {
		$data = wp_kses( $data, array(
			'iframe' => array(
				'src'               => array(),
				'type'              => array(),
				'allowfullscreen'   => array(),
				'allowscriptaccess' => array(),
				'height'            => array(),
				'width'             => array()
			),
			'embed' => array(
				'src'               => array(),
				'type'              => array(),
				'allowfullscreen'   => array(),
				'allowscriptaccess' => array(),
				'height'            => array(),
				'width'             => array()
			),
		) );
	}

	// Apply filters and return
	return apply_filters( 'wpex_sanitize', $data );

}

/**
 * Checks a custom field value and returns the type (embed, oembed, etc )
 *
 * @since 1.0.0
 */
function wpex_check_meta_type( $value ) {
	if ( strpos( $value, 'embed' ) ) {
		return 'embed';
	} elseif ( strpos( $value, 'iframe' ) ) {
		return 'iframe';
	} else {
		return 'url';
	}
}

/**
 * Custom menu walker
 * 
 * @link  http://codex.wordpress.org/Class_Reference/Walker_Nav_Menu
 * @since 1.0.0
 */
if ( ! class_exists( 'WPEX_Dropdown_Walker_Nav_Menu' ) ) {
	class WPEX_Dropdown_Walker_Nav_Menu extends Walker_Nav_Menu {
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( ! empty( $children_elements[$element->$id_field] ) && ( $depth == 0 ) ) {
				$element->title .= ' <span class="fa fa-angle-down wpex-dropdown-arrow-down"></span>';
			}
			if ( ! empty( $children_elements[$element->$id_field] ) && ( $depth > 0 ) ) {
				$element->title .= ' <span class="fa fa-angle-right wpex-dropdown-arrow-side"></span>';
			}
			Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}
}

/**
 * Custom comments callback
 * 
 * @link  http://codex.wordpress.org/Function_Reference/wp_list_comments
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_comment' ) ) {
	function wpex_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				// Display trackbacks differently than normal comments. ?>
				<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<p><strong><?php esc_html_e( 'Pingback:', 'today' ); ?></strong> <?php comment_author_link(); ?></p>
			<?php
			break;
			default :
				// Proceed with normal comments. ?>
				<li id="li-comment-<?php comment_ID(); ?>">
					<div id="comment-<?php comment_ID(); ?>" <?php comment_class( 'wpex-clr' ); ?>>
						<div class="comment-author vcard">
							<?php
							// Display avatar
							$avatar_size = apply_filters( 'wpex_comments_avatar_size', 40 );
							echo get_avatar( $comment, $avatar_size ); ?>
						</div><!-- .comment-author -->
						<div class="comment-details wpex-clr">
							<header class="comment-meta">
								<cite class="fn"><?php comment_author_link(); ?></cite>
								<span class="comment-date">
								<?php
									printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										get_comment_time( 'c' ),
										sprintf( _x( '%1$s', '1: date', 'today' ), get_comment_date() )
									); ?>
								</span><!-- .comment-date -->
							</header><!-- .comment-meta -->
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation">
									<?php esc_html_e( 'Your comment is awaiting moderation.', 'today' ); ?>
								</p><!-- .comment-awaiting-moderation -->
							<?php endif; ?>
							<div class="comment-content wpex-entry wpex-clr">
								<?php comment_text(); ?>
							</div><!-- .comment-content -->
							<footer class="comment-footer wpex-clr">
								<?php
								// Cancel comment link
								comment_reply_link( array_merge( $args, array(
									'reply_text'    => esc_html__( 'Reply', 'today' ) . '',
									'depth'         => $depth,
									'max_depth'     => $args['max_depth']
								) ) ); ?>
								<?php
								// Edit comment link
								edit_comment_link( esc_html__( 'Edit', 'today' ), '<div class="edit-comment">', '</div>' ); ?>
							</footer>
						</div><!-- .comment-details -->
					</div><!-- #comment-## -->
			<?php
			break;
		endswitch;
	}
}

/**
 * Returns correct entry excerpt length
 * 
 * @since 1.0.0
 */
function wpex_get_entry_excerpt_length() {
	if ( is_front_page() ) {
		$length = wpex_get_theme_mod( 'home_entry_excerpt_length', 30 );
	} else {
		$length = wpex_get_theme_mod( 'entry_excerpt_length', 30 );
	}
	$length = intval( $length ) ? intval( $length ) : 30;
	return $length;
}

/**
 * Custom excerpts based on wp_trim_words
 * Created for child-theming purposes
 * 
 * @link  http://codex.wordpress.org/Function_Reference/wp_trim_words
 * @since 1.0.0
 */
function wpex_excerpt( $length = 45, $readmore = false ) {

	// Get global post data
	global $post;

	// Check for custom excerpt
	if ( has_excerpt( $post->ID ) ) {
		$output = $post->post_excerpt;
	}

	// No custom excerpt...so lets generate one
	else {

		// Redmore text
		$readmore_text = get_theme_mod( 'entry_readmore_text', esc_html__( 'read more', 'today' ) );

		// Readmore link
		$readmore_link = '<a href="'. get_permalink( $post->ID ) .'" title="'. $readmore_text .'">'. $readmore_text .'<span class="wpex-readmore-rarr">&rarr;</span></a>';

		// Check for more tag and return content if it exists
		if ( strpos( $post->post_content, '<!--more-->' ) ) {
			$output = get_the_content( '' );
		}

		// No more tag defined so generate excerpt using wp_trim_words
		else {

			// Generate excerpt
			$output = wp_trim_words( strip_shortcodes( get_the_content( $post->ID ) ), $length );

			// Add readmore to excerpt if enabled
			if ( $readmore == true ) {
				$output .= apply_filters( 'wpex_readmore_link', $readmore_link );
			}

		}

	}

	// Apply filters and echo
	echo apply_filters( 'wpex_excerpt', $output );

}

/**
 * Remove more link
 *
 * @since 1.0.0
 */
function wpex_remove_more_link( $link ) {
	return null;
}
add_filter( 'the_content_more_link', 'wpex_remove_more_link' );

/**
 * Includes correct template part
 *
 * @since 1.0.0
 */
function wpex_include_template( $template ) {

	// Return if no template is defined
	if ( ! $template ) {
		return;
	}

	// Locate template
	$template = locate_template( $template, false );

	// Load template if it exists
	if ( $template ) {
		include( $template );
	}

}

/**
 * List categories for specific taxonomy
 * 
 * @link    http://codex.wordpress.org/Function_Reference/wp_get_post_terms
 * @since   1.0.0
 */
if ( ! function_exists( 'wpex_get_post_terms' ) ) {

	function wpex_get_post_terms( $taxonomy = 'category', $first_only = false, $classes = '' ) {

		// Define return var
		$return = array();

		// Get terms
		$terms = wp_get_post_terms( get_the_ID(), $taxonomy );

		// Loop through terms and create array of links
		foreach ( $terms as $term ) {

			// Add classes
			$add_classes = 'wpex-term-'. $term->term_id;
			if ( $classes ) {
				$add_classes .= ' '. $classes;
			}
			if ( $add_classes ) {
				$add_classes = ' class="'. $add_classes .'"';
			}

			// Get permalink
			$permalink = get_term_link( $term->term_id, $taxonomy );

			// Add term to array
			$return[] = '<a href="'. esc_url( $permalink ) .'" title="'. $term->name .'"'. $add_classes .'>'. $term->name .'</a>';

		}

		// Return if no terms are found
		if ( ! $return ) {
			return;
		}

		// Return first category only
		if ( $first_only ) {
			
			$return = $return[0];

		}

		// Turn terms array into comma seperated list
		else {

			$return = implode( '', $return );

		}

		// Return or echo
		return $return;

	}

}

/**
 * Echos the wpex_list_post_terms function
 * 
 * @since 1.0.0
 */
function wpex_post_terms( $taxonomy = 'category', $first_only = false, $classes = '' ) {
	echo wpex_get_post_terms( $taxonomy, $first_only, $classes );
}

/**
 * Checks if a user has social options defined
 *
 * @since 1.0.0
 */

function wpex_author_has_social( $user_id = NULL ) {
	if ( get_the_author_meta( 'wpex_twitter', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_facebook', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_googleplus', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_linkedin', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_instagram', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_pinterest', $user_id ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns correct ad region template part
 *
 * @since 1.0.0
 */
function wpex_ad_region( $location ) {
	if ( ! empty( $_GET['disable_ads'] ) ) {
		return;
	}
	$location = 'partials/ads/'. $location;
	get_template_part( $location );
}

/**
 * Header Social Options array
 *
 * @since 1.0.0
 */
function wpex_header_social_options_array() {
	$options = array(
		'twitter' => array(
			'label'      => 'Twitter',
			'icon_class' => 'fa fa-twitter',
		),
		'facebook' => array(
			'label'      => 'Facebook',
			'icon_class' => 'fa fa-facebook',
		),
		'googleplus' => array(
			'label'      => 'Google Plus',
			'icon_class' => 'fa fa-google-plus',
		),
		'pinterest' => array(
			'label'      => 'Pinterest',
			'icon_class' => 'fa fa-pinterest',
		),
		'dribbble' => array(
			'label'      => 'Dribbble',
			'icon_class' => 'fa fa-dribbble',
		),
		'vk' => array(
			'label'      => 'Vk',
			'icon_class' => 'fa fa-vk',
		),
		'instagram' => array(
			'label'      => 'Instagram',
			'icon_class' => 'fa fa-instagram',
		),
		'linkedin' => array(
			'label'      => 'LinkedIn',
			'icon_class' => 'fa fa-linkedin',
		),
		'tumblr' => array(
			'label'      => 'Tumblr',
			'icon_class' => 'fa fa-tumblr',
		),
		'github' => array(
			'label'      => 'Github',
			'icon_class' => 'fa fa-github-alt',
		),
		'flickr' => array(
			'label'      => 'Flickr',
			'icon_class' => 'fa fa-flickr',
		),
		'skype' => array(
			'label'      => 'Skype',
			'icon_class' => 'fa fa-skype',
		),
		'youtube' => array(
			'label'      => 'Youtube',
			'icon_class' => 'fa fa-youtube-play',
		),
		'vimeo' => array(
			'label'      => 'Vimeo',
			'icon_class' => 'fa fa-vimeo-square',
		),
		'vine' => array(
			'label'      => 'Vine',
			'icon_class' => 'fa fa-vine',
		),
		'xing' => array(
			'label'      => 'Xing',
			'icon_class' => 'fa fa-xing',
		),
		'yelp' => array(
			'label'      => 'Yelp',
			'icon_class' => 'fa fa-yelp',
		),

		'rss' => array(
			'label'      => 'RSS',
			'icon_class' => 'fa fa-rss',
		),
		'email' => array(
			'label'      => esc_html__( 'Email', 'today' ),
			'icon_class' => 'fa fa-envelope',
		),
	);
	$options = apply_filters( 'wpex_header_social_options_array', $options );
	return $options;
}