<?php
/**
 * Displays the post tags.
 */

defined( 'ABSPATH' ) || exit;

// Return if post tags shouldn't display
if ( post_password_required() ) {
	return;
}

the_tags(
	'<div class="wpex-post-tags wpex-clr"><h4 class="wpex-heading">' . esc_html__( 'Tagged', 'wpex-today' ) . '</h4>',
	null,
	'</div><!-- .wpex-post-tags -->'
); ?>