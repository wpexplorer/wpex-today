<?php
/**
 * Displays the site description for the header.
 */

defined( 'ABSPATH' ) || exit;

if ( get_theme_mod( 'site_description', true ) && $description = get_bloginfo( 'description' ) ) { ?>

	<div class="wpex-site-description">
		<?php echo wp_kses_post( $description ); ?>
	</div><!-- .wpex-site-description -->

<?php } ?>