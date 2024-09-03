<?php
/**
 * Outputs the header advertisement.
 */

defined( 'ABSPATH' ) || exit;

$ad = get_theme_mod(
	'ad_header',
	'<a href="https://totalwptheme.com/"><img src="' . get_template_directory_uri() . '/assets/images/banner.png" alt="Total WordPress Theme"></a>'
);

if ( $ad ) : ?>
	<div class="wpex-header-ad"><?php echo wp_kses_post( $ad ); ?></div><!-- .wpex-header-ad -->
<?php endif; ?>