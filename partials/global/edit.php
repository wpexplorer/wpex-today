<?php
/**
 * Edit post link.
 */

defined( 'ABSPATH' ) || exit;

// Not needed for these pages
if ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) ) {
	return;
}

// Define text
if ( is_page() ) {
	$text = esc_html__( 'Edit This Page', 'wpex-today' );
} else {
	$text = esc_html__( 'Edit This Article', 'wpex-today' );
}
$text = apply_filters( 'wpex_post_edit_text', $text );

// Display edit post link
edit_post_link(
	$text,
	'<div class="wpex-post-edit wpex-clr">', '</div>'
); ?>