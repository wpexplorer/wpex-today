<?php
/**
 * Footer copyright
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

// Get copyright data
$copy = apply_filters( 'wpex_footer_copyright', '<a href="http://www.wpexplorer.com/today-wordpress-theme/" target="_blank" title="Today WordPress Theme">Today</a> Theme by <a href="http://themeforest.net/user/wpexplorer?ref=WPExplorer" title="WPExplorer Themes">WPExplorer</a> Powered by <a href="https://wordpress.org/" title="WordPress" target="_blank">WordPress</a>' );
$copy = wpex_sanitize( $copy, 'html' ); // Sanitize output, see inc/core-functions.php

// Display copyright
if ( $copy ) : ?>

	<div class="footer-copyright wpex-clr">
		<?php echo do_shortcode( wpex_sanitize( $copy, 'html' ) ); ?>
	</div><!-- .footer-copyright -->
<?php endif; ?>