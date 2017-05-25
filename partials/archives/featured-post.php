<?php
/**
 * Featured Post
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;
$featured_post = wpex_get_featured_post( $wp_query );
$allow_embeds  = wpex_get_theme_mod( 'entry_embeds', false );

if ( $featured_post ) :

	// Set featured post global var
	global $is_featured_post;
	$is_featured_post = true;

	// Query featured post
	$args = apply_filters( 'wpex_featured_post_args', array(
		'post_type'     => 'post',
		'no_found_rows' => true,
		'post__in'      => array( $featured_post ),
	) );
	$wpex_query = new WP_Query( $args );

	// Display featured post
	if ( $wpex_query->have_posts() ) :
		while ( $wpex_query->have_posts() ) : $wpex_query->the_post();
			// Get entry template part
			get_template_part( 'partials/layout-entry' );
		endwhile;
	$is_featured_post = false;
	endif;
	// Restore original post data
	wp_reset_postdata(); ?>

<?php endif; ?>