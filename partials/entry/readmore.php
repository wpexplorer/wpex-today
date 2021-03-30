<?php
/**
 * Outputs a read more link for entries.
 */

defined( 'ABSPATH' ) || exit;

// Define text
$text = get_theme_mod( 'entry_readmore_text' );
$text = $text ? $text : esc_html__( 'read more', 'wpex-today' );
$text = apply_filters( 'wpex_entry_readmore_text', $text ); ?>

<?php if ( $text ) : ?>

	<div class="wpex-loop-entry-readmore wpex-clr">
		<a href="<?php the_permalink(); ?>" class="wpex-readmore"><?php echo wpex_sanitize( $text, 'html' ); ?></a>
	</div><!-- .wpex-loop-entry-readmore -->

<?php endif; ?>