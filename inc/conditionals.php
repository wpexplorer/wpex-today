<?php
/**
 * Useful conditionals for this theme.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Check if comments are enabled
 *
 * @since 1.0.0
 */
function wpex_has_comments( $bool = true ) {
	if ( 'page' == get_post_type() && ! get_theme_mod( 'page_comments', true ) ) {
		$bool = false;
	}
	return apply_filters( 'wpex_has_comments', $bool );
}

/**
 * Check if social share is enabled
 *
 * @since 1.0.0
 */
function wpex_has_social_share( $bool = true ) {
	$bool = get_theme_mod( 'post_share', true );
	if ( post_password_required() ) {
		$bool = false;
	}
	$bool = apply_filters( 'wpex_has_social_share', $bool );
	return $bool;
}

/**
 * Check if social share is enabled
 *
 * @since 1.0.0
 */
function wpex_has_author_bio( $bool = true ) {
	$bool = get_theme_mod( 'post_author_info', true );
	$bool = apply_filters( 'wpex_has_author_bio', $bool );
	return $bool;
}

/**
 * Check if footer widgets are enabled
 *
 * @since 1.0.0
 */
function wpex_has_footer_widgets( $bool = true ) {
	$columns = get_theme_mod( 'footer_widget_columns', '4' );
	if ( ! $columns || '0' == $columns || 'disable' == $columns ) {
		$bool = false;
	}
	if ( $bool ) {
		if ( is_active_sidebar( 'footer-one' )
			|| is_active_sidebar( 'footer-two' )
			|| is_active_sidebar( 'footer-three' )
			|| is_active_sidebar( 'footer-four' )
		) {
			$bool = true;
		} else {
			$bool = false;
		}
	}
	$bool = apply_filters( 'wpex_has_footer_widgets', $bool );
	return $bool;
}

/**
 * Check if custom excerpt is enabled
 *
 * @since 1.0.0
 */
function wpex_has_custom_excerpt() {
	$display = get_theme_mod( 'entry_content_display', 'excerpt' );
	$length  = get_theme_mod( 'entry_excerpt_length', 45 );
	if ( 'excerpt' == $display && $length > 0 ) {
		$bool = true;
	} else {
		$bool = false;
	}
	$bool = apply_filters( 'wpex_has_custom_excerpt', $bool );
	return $bool;
}