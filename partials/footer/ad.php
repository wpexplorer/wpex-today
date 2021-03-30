<?php
/**
 * Footer advertisement.
 */

defined( 'ABSPATH' ) || exit;

$default = '<a href="https://total.wpexplorer.com" target="_blank"><img src="'. get_template_directory_uri() .'/images/banner.png" /></a>';
if ( $ad = wpex_get_theme_mod( 'ad_footer', $default ) ) : ?>
	<div class="wpex-footer-ad wpex-container wpex-clr">
		<div class="wpex-footer-ad-inner wpex-clr"><?php echo $ad; ?></div>
	</div><!-- .wpex-footer-ad -->
<?php endif; ?>