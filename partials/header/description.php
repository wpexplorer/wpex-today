<?php
/**
 * Displays the site description for the header
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

// Display description if enabled
if ( wpex_get_theme_mod( 'site_description', true ) && $description = get_bloginfo( 'description' ) ) : ?>

	<div class="wpex-site-description wpex-clr">
		<?php echo wpex_sanitize( $description, 'html' ); ?>
	</div><!-- .wpex-site-description -->

<?php endif; ?>