<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Return if it is full-width
if ( 'full-width' == wpex_get_post_layout() ) {
	return;
}

// Get correct sidebar
$sidebar = ( is_singular( 'page' ) && is_active_sidebar( 'sidebar_pages' ) ) ? 'sidebar_pages' : 'sidebar';
$sidebar = apply_filters( 'wpex_sidebar_id', $sidebar );

// Display sidebar if active
if ( is_active_sidebar( $sidebar ) ) : ?>

	<aside class="wpex-sidebar wpex-clr">
		<div class="wpex-widget-area">
			<?php dynamic_sidebar( $sidebar ); ?>
		</div><!-- .wpex-widget-area -->
	</aside><!-- .wpex-sidebar -->

<?php endif; ?>