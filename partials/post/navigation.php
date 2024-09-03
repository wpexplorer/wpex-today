<?php
/**
 * Displays the next/previous post links.
 */

defined( 'ABSPATH' ) || exit;

// Get post navigation
$args = array(
	'prev_text'	=> '<span>' . esc_html__( 'Next Article', 'wpex-today' ) . ' &rarr;</span>',
	'next_text'	=> '<span>&larr; ' . esc_html__( 'Previous Article', 'wpex-today' ) . '</span>',
);

if ( 'post' == get_post_type() && get_theme_mod( 'post_next_prev_in_same_term', false ) ) {
	$args['in_same_term'] = true;
	$args['taxonomy'] = 'category';
}

$post_nav = get_the_post_navigation( $args );
$post_nav = str_replace( 'role="navigation"', '', $post_nav );

// Display post navigation
if ( ! is_attachment() && $post_nav ) : ?>
	<div class="wpex-post-navigation"><?php echo wp_kses_post( $post_nav ); ?></div>
<?php endif; ?>