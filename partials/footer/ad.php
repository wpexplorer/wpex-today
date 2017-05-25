<?php
/**
 * Footer advertisement
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

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$default = '<a href="http://themeforest.net/item/noir-responsive-wordpress-blog-shop-theme/13434670?ref=WPExplorer" target="_blank"><img src="'. get_template_directory_uri() .'/images/banner.jpg" /></a>';
if ( $ad = wpex_get_theme_mod( 'ad_footer', $default ) ) : ?>
	<div class="wpex-footer-ad wpex-container wpex-clr">
		<div class="wpex-footer-ad-inner wpex-clr"><?php echo $ad; ?></div>
	</div><!-- .wpex-footer-ad -->
<?php endif; ?>