<?php
/**
 * Footer copyright.
 */

defined( 'ABSPATH' ) || exit;

// Get copyright data
$copy = apply_filters( 'wpex_footer_copyright', get_theme_mod( 'footer_copyright', '<a href="https://www.wpexplorer.com/today-free-wordpress/" target="_blank" title="Today WordPress Theme">Today</a> Theme by <a href="https://www.wpexplorer.com" target="_blank">WPExplorer</a> Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>' ) );

// Display copyright
if ( $copy ) : ?>

	<div class="footer-copyright wpex-clr">
		<?php echo do_shortcode( wpex_sanitize( $copy, 'html' ) ); ?>
	</div><!-- .footer-copyright -->
<?php endif; ?>