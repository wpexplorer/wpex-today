<?php
/**
 * Footer copyright.
 */

defined( 'ABSPATH' ) || exit;

// Get copyright data
$copy = get_theme_mod( 'footer_copy' ) ?: 'Copyright ' . get_the_date( 'Y' ) . ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
$copy = apply_filters( 'wpex_footer_copyright', $copy );

// Display copyright
if ( $copy ) : ?>

	<div class="footer-copyright">
		<?php echo do_shortcode( wp_kses_post( $copy ) ); ?>
	</div><!-- .footer-copyright -->

<?php endif; ?>