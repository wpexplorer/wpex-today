<?php
/**
 * Displays the entry category(ies).
 */

defined( 'ABSPATH' ) || exit;

if ( 'post' !== get_post_type() || is_category() ) {
	return;
}

?>

<div class="wpex-entry-cat wpex-clr wpex-button-typo">
	<?php
	// Display categories.
	if ( get_theme_mod( 'entry_category_first_only', true ) ) {
		echo wpex_get_post_terms( 'category', true, 'wpex-accent-bg' );
	} else {
		echo wpex_get_post_terms( 'category', false, 'wpex-accent-bg' );
	} ?>
</div><!-- .wpex-entry-cat -->
