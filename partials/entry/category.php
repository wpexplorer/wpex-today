<?php
/**
 * Displays the entry category(ies).
 */

defined( 'ABSPATH' ) || exit;

// Show only when needed
if ( 'post' !== get_post_type() || is_category() ) {
	return;
}

// Get category
if ( get_theme_mod( 'entry_category_first_only', true ) ) {
	$category = wpex_get_post_terms( 'category', true, 'wpex-accent-bg' );
} else {
	$category = wpex_get_post_terms( 'category', false, 'wpex-accent-bg' );
}

// Display category
if ( $category ) : ?>

	<div class="wpex-entry-cat wpex-clr wpex-button-typo">
		<?php echo wpex_sanitize( $category, 'link' ); ?>
	</div><!-- .wpex-entry-cat -->

<?php endif; ?>