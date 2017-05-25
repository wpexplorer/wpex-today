<?php
/**
 * Displays the next/previous post links
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

// Get post navigation
$args = array(
	'prev_text'	=> '<span>'. esc_html__( 'Next Article', 'today' ) .'</span><span class="fa fa-chevron-right"></span>',
	'next_text'	=> '<span class="fa fa-chevron-left"></span><span>'. esc_html__( 'Previous Article', 'today' ) .'</span>',
);
if ( 'post' == get_post_type() && wpex_get_theme_mod( 'post_next_prev_in_same_term', false ) ) {
	$args['in_same_term'] = true;
	$args['taxonomy'] = 'category';
}
$post_nav = get_the_post_navigation( $args );
$post_nav = str_replace( 'role="navigation"', '', $post_nav );

// Display post navigation
if ( ! is_attachment() && $post_nav ) : ?>

	<div class="wpex-post-navigation wpex-clr"><?php echo wpex_sanitize( $post_nav, 'html' ); ?></div>

<?php endif; ?>