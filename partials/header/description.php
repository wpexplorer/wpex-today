<?php
/**
 * Displays the site description for the header.
 */

defined( 'ABSPATH' ) || exit;

// Display description if enabled
if ( wpex_get_theme_mod( 'site_description', true ) && $description = get_bloginfo( 'description' ) ) : ?>

	<div class="wpex-site-description wpex-clr">
		<?php echo wpex_sanitize( $description, 'html' ); ?>
	</div><!-- .wpex-site-description -->

<?php endif; ?>