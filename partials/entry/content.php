<?php
/**
 * The post entry title.
 */

defined( 'ABSPATH' ) || exit;

// Get display
if ( is_front_page() ) {
	$display = wpex_get_theme_mod( 'home_entry_content_display', 'excerpt' );
} else {
	$display = wpex_get_theme_mod( 'entry_content_excerpt', 'excerpt' );
} ?>

<div class="wpex-loop-entry-excerpt entry wpex-clr">

	<?php if ( post_password_required() ) : ?>

		<?php esc_html_e( 'This post is password protected you will need a password to access the article.', 'wpex-today' ); ?>

	<?php elseif ( 'content' != $display && wpex_has_custom_excerpt() ) : ?>

		<?php wpex_excerpt( wpex_get_entry_excerpt_length(), false ); ?>

	<?php else : ?>

	   <?php the_content(); ?>

	<?php endif; ?>

</div><!--.wpex-loop-entry-excerpt -->