<?php
/**
 * Displays the post category(ies).
 */

defined( 'ABSPATH' ) || exit;

if ( 'post' !== get_post_type() ) {
	return;
}

?>

<div class="wpex-entry-cat wpex-post-cat wpex-clr wpex-button-typo"><?php
	if ( get_theme_mod( 'post_category_first_only', true ) ) {
		echo wpex_get_post_terms( 'category', true, 'wpex-accent-bg' );
	} else {
		echo wpex_get_post_terms( 'category', false, 'wpex-accent-bg' );
	}
?></div><!-- .wpex-post-cat -->