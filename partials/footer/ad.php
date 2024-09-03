<?php
/**
 * Footer advertisement.
 */

defined( 'ABSPATH' ) || exit;

$ad = get_theme_mod(
	'ad_footer',
	'<a href="https://totalwptheme.com/"><img src="'. get_template_directory_uri() .'/assets/images/banner.png" alt="Total WordPress Theme"></a>'
) ;

if ( $ad ) : ?>
	<div class="wpex-footer-ad wpex-container">
		<div class="wpex-footer-ad-inner"><?php echo wp_kses_post( $ad ); ?></div>
	</div><!-- .wpex-footer-ad -->
<?php endif; ?>