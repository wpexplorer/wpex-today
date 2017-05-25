<?php
/**
 * Useful conditionals for this theme
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

/**
 * Check if page titles should be over featured images
 *
 * @since 1.0.0
 */
function wpex_has_page_featured_image_overlay_title() {
	$return = false;
	// Pages
	if ( is_page() && has_post_thumbnail() ) {
		$return = true;
	}
	// Shop
	if ( function_exists( 'is_shop' ) && is_shop() ) {
		if ( has_post_thumbnail( woocommerce_get_page_id( 'shop' ) ) ) {
			$return = true;
		}
	}
	// Shop tax
	if ( is_tax( 'product_cat' ) && function_exists( 'get_woocommerce_term_meta' ) ) {
		if ( get_woocommerce_term_meta( get_queried_object()->term_id, 'thumbnail_id', true ) ) {
			$return = true;
		}
	}
	return $return;
}

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
 * Check if post has a video
 *
 * @since 1.0.0
 */
function wpex_has_post_video( $bool = false ) {
	if ( get_post_meta( get_the_ID(), 'wpex_post_video', true ) ) {
		$bool = true;
	}
	return apply_filters( 'wpex_has_post_video', $bool );
}

/**
 * Check if post has a audio
 *
 * @since 1.0.0
 */
function wpex_has_post_audio( $bool = false ) {
	if ( get_post_meta( get_the_ID(), 'wpex_post_audio', true ) ) {
		$bool = true;
	}
	return apply_filters( 'wpex_has_post_audio', $bool );
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
	$display = wpex_get_theme_mod( 'entry_content_display', 'excerpt' );
	$length  = wpex_get_theme_mod( 'entry_excerpt_length', 45 );
	if ( 'excerpt' == $display && $length > 0 ) {
		$bool = true;
	} else {
		$bool = false;
	}
	$bool = apply_filters( 'wpex_has_custom_excerpt', $bool );
	return $bool;
}