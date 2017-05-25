<?php
/**
 * Displays the post category(ies)
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

// Show only when needed
if ( 'post' != get_post_type() ) {
	return;
}

// Get category
if ( get_theme_mod( 'post_category_first_only', true ) ) {
	$category = wpex_get_post_terms( 'category', true, 'wpex-accent-bg' );
} else {
	$category = wpex_get_post_terms( 'category', false, 'wpex-accent-bg' );
}

// Display category
if ( $category ) : ?>

	<div class="wpex-entry-cat wpex-post-cat wpex-clr wpex-button-typo">
		<?php echo wpex_sanitize( $category, 'html' ); ?>
	</div><!-- .wpex-post-cat -->

<?php endif; ?>