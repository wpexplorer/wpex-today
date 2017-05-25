<?php
/**
 * Topbar Layout
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

// Check display
$display = apply_filters( 'wpex_topbar_enable', wpex_get_theme_mod( 'topbar_enable', true ) );

// Show topbar if enabled
if ( $display ) : ?>

	<div class="wpex-topbar-wrap wpex-clr">
		<div class="wpex-topbar wpex-container wpex-clr">
			<?php get_template_part( 'partials/topbar/topbar-trending' ); ?>
			<?php get_template_part( 'partials/topbar/topbar-social' ); ?>
		</div><!-- .wpex-topbar -->
	</div><!-- .wpex-topbar-wrap -->

<?php endif; ?>