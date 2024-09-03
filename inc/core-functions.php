<?php

defined( 'ABSPATH' ) || exit;

/**
 * Array of image crop locations
 *
 * @link 2.0.0
 */
function wpex_image_crop_locations() {
	return array(
		' '             => esc_html__( 'Default', 'wpex-today' ),
		'left-top'      => esc_html__( 'Top Left', 'wpex-today' ),
		'right-top'     => esc_html__( 'Top Right', 'wpex-today' ),
		'center-top'    => esc_html__( 'Top Center', 'wpex-today' ),
		'left-center'   => esc_html__( 'Center Left', 'wpex-today' ),
		'right-center'  => esc_html__( 'Center Right', 'wpex-today' ),
		'center-center' => esc_html__( 'Center Center', 'wpex-today' ),
		'left-bottom'   => esc_html__( 'Bottom Left', 'wpex-today' ),
		'right-bottom'  => esc_html__( 'Bottom Right', 'wpex-today' ),
		'center-bottom' => esc_html__( 'Bottom Center', 'wpex-today' ),
	);
}

/**
 * Parse image crop option and returns correct value for add_image_size
 *
 * @link 2.0.0
 */
function wpex_parse_image_crop( $crop = 'true' ) {
	$return = true;
	if ( $crop
		&& is_string( $crop )
		&& array_key_exists( $crop, wpex_image_crop_locations() )
	) {
		$return = explode( '-', $crop );
	}
	return $return ?: true;
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
	$columns = get_theme_mod( 'entry_columns' ) ?: 2;
	$columns = apply_filters( 'wpex_loop_columns', $columns );
	return (int) $columns;
}

/**
 * Returns current page or post layout
 *
 * @since 1.0.0
 */
function wpex_get_post_layout() {

	// Set default layout
	$layout = 'right-sidebar';

	// Posts
	if ( is_page() ) {
		$layout = get_theme_mod( 'page_layout' );
	}

	// Posts
	elseif ( is_singular() ) {
		$layout = get_theme_mod( 'post_layout' );
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
		$layout = get_theme_mod( 'home_layout' );
	}

	// Search
	elseif ( is_search() ) {
		$layout = get_theme_mod( 'search_layout' );
	}

	// Archive
	elseif ( is_archive() ) {
		$layout = get_theme_mod( 'archives_layout' );
	}

	// Apply filters
	$layout = (string) apply_filters( 'wpex_post_layout', $layout );

	// Sanitize
	$layout = $layout ?: 'right-sidebar';

	// Return layout
	return $layout;

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
 * Custom menu walker
 *
 * @link  http://codex.wordpress.org/Class_Reference/Walker_Nav_Menu
 * @since 1.0.0
 */
if ( ! class_exists( 'WPEX_Dropdown_Walker_Nav_Menu' ) ) {
	class WPEX_Dropdown_Walker_Nav_Menu extends Walker_Nav_Menu {
		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( ! empty( $children_elements[ $element->$id_field ] ) && ( $depth === 0 ) ) {
				$element->title = '<span class="menu-item-title">' . $element->title . '</span><span class="menu-item-arrow">' . wpex_get_icon( 'angle-down' ) . '</span>';
			}
			if ( ! empty( $children_elements[ $element->$id_field ] ) && ( $depth > 0 ) ) {
				$element->title = '<span class="menu-item-title">' . $element->title . '</span><span class="menu-item-arrow">' . wpex_get_icon( 'angle-right' ) . '</span>';
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
				<p><strong><?php esc_html_e( 'Pingback:', 'wpex-today' ); ?></strong> <?php comment_author_link(); ?></p>
			<?php
			break;
			default :
				// Proceed with normal comments. ?>
				<li id="li-comment-<?php comment_ID(); ?>">
					<div id="comment-<?php comment_ID(); ?>" <?php comment_class( 'wpex-clr' ); ?>>
						<div class="comment-author vcard">
							<?php
							// Display avatar
							$avatar_size = apply_filters( 'wpex_comments_avatar_size', 50 );
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
										sprintf( _x( '%1$s', '1: date', 'wpex-today' ), get_comment_date() )
									); ?>
								</span><!-- .comment-date -->
							</header><!-- .comment-meta -->
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation">
									<?php esc_html_e( 'Your comment is awaiting moderation.', 'wpex-today' ); ?>
								</p><!-- .comment-awaiting-moderation -->
							<?php endif; ?>
							<div class="comment-content wpex-entry wpex-clr">
								<?php comment_text(); ?>
							</div><!-- .comment-content -->
							<footer class="comment-footer">
								<?php
								// Cancel comment link
								comment_reply_link( array_merge( $args, array(
									'reply_text'    => esc_html__( 'Reply', 'wpex-today' ) . '',
									'depth'         => $depth,
									'max_depth'     => $args['max_depth']
								) ) ); ?>
								<?php
								// Edit comment link
								edit_comment_link( esc_html__( 'Edit', 'wpex-today' ), '<div class="edit-comment">', '</div>' ); ?>
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
	return apply_filters( 'wpex_get_entry_excerpt_length', get_theme_mod( 'entry_excerpt_length', 30 ) );
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
	if ( ! empty( $post->post_excerpt ) && ! ctype_space( $post->post_excerpt ) ) {
		$output = wp_kses_post( $post->post_excerpt );
	}

	// No custom excerpt...so lets generate one
	else {

		// Redmore text
		$readmore_text = get_theme_mod( 'entry_readmore_text', esc_html__( 'read more', 'wpex-today' ) );

		// Readmore link
		$readmore_link = '<a aria-hidden="true" href="'. get_permalink( $post->ID ) .'">'. esc_html( $readmore_text ) .'<span class="wpex-readmore-rarr">&rarr;</span></a>';

		// Check for more tag and return content if it exists
		if ( strpos( $post->post_content, '<!--more-->' ) ) {
			$output = get_the_content( '' );
			if ( $output ) {
				$output = wp_kses_post( $output );
			}
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
	if ( $template = locate_template( $template, false ) ) {
		include $template;
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
			$return[] = '<a href="' . esc_url( $permalink ) . '"' . $add_classes . '>' . $term->name . '</a>';

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
	if ( get_the_author_meta( 'wpex_twitter', $user_id )
		|| get_the_author_meta( 'wpex_facebook', $user_id )
		|| get_the_author_meta( 'wpex_linkedin', $user_id )
		|| get_the_author_meta( 'wpex_instagram', $user_id )
		|| get_the_author_meta( 'wpex_pinterest', $user_id )
	) {
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
	get_template_part( 'partials/ads/' . $location );
}

/**
 * Header Social Options array
 *
 * @since 1.0.0
 */
function wpex_header_social_options_array() {
	$options = array(
		'twitter' => array(
			'label' => 'Twitter X',
		),
		'facebook' => array(
			'label' => 'Facebook',
		),
		'pinterest' => array(
			'label' => 'Pinterest',
		),
		'dribbble' => array(
			'label' => 'Dribbble',
		),
		'vk' => array(
			'label' => 'Vk',
		),
		'instagram' => array(
			'label' => 'Instagram',
		),
		'linkedin' => array(
			'label' => 'LinkedIn',
		),
		'tumblr' => array(
			'label' => 'Tumblr',
		),
		'github' => array(
			'label' => 'Github',
		),
		'flickr' => array(
			'label' => 'Flickr',
		),
		'skype' => array(
			'label' => 'Skype',
		),
		'youtube' => array(
			'label' => 'Youtube',
		),
		'vimeo' => array(
			'label' => 'Vimeo',
		),
		'snapchat' => array(
			'label' => 'Snapchat',
		),
		'xing' => array(
			'label' => 'Xing',
		),
		'yelp' => array(
			'label' => 'Yelp',
		),
		'rss' => array(
			'label' => 'RSS',
		),
		'email' => array(
			'label' => esc_html__( 'Email', 'wpex-today' ),

		),
	);
	return (array) apply_filters( 'wpex_header_social_options_array', $options );
}

/**
 * Get svg icon.
 * 
 * @since 2.0
 */
function wpex_get_icon( $name ) {
	$icon = locate_template( "assets/icons/{$name}.svg", false );
	$icon_html = $icon ? file_get_contents( $icon ) : '';
	if ( $icon_html ) {
		return '<span class="wpex-svg-icon" aria-hidden="true">' . $icon_html . '</span>';
	}
}
