<?php
/**
 * Post pagination.
 */

defined( 'ABSPATH' ) || exit;

// Post pagination
wp_link_pages( array(
	'before'      => '<div class="wpex-page-links wpex-clr">',
	'after'       => '</div>',
	'link_before' => '<span>',
	'link_after'  => '</span>',
) ); ?>