<?php
/**
 * Outputs the header advertisement
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

$default = '<a href="http://themeforest.net/item/noir-responsive-wordpress-blog-shop-theme/13434670?ref=WPExplorer" target="_blank"><img src="'. get_template_directory_uri() .'/images/banner.jpg" /></a>';
if ( $ad = wpex_get_theme_mod( 'ad_header', $default ) ) : ?>
	<div class="wpex-header-ad wpex-clr"><?php echo $ad; ?></div><!-- .wpex-header-ad -->
<?php endif; ?>