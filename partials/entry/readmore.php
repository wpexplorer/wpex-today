<?php
/**
 * Outputs a read more link for entries.
 */

defined( 'ABSPATH' ) || exit;

$text = get_theme_mod( 'entry_readmore_text' ) ?: esc_html__( 'read more', 'wpex-today' );
$text = apply_filters( 'wpex_entry_readmore_text', $text );

?>

<?php if ( $text ) : ?>

	<div class="wpex-loop-entry-readmore">
		<a aria-hidden="true" href="<?php the_permalink(); ?>" class="wpex-readmore"><?php echo esc_html( $text ); ?></a>
	</div><!-- .wpex-loop-entry-readmore -->

<?php endif; ?>