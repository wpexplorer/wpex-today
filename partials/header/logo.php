<?php
/**
 * Outputs the header logo
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

// Get data
$logo      = wpex_get_header_logo_src();
$blog_name = get_bloginfo( 'name' ); ?>

<div class="wpex-site-logo wpex-clr">

	<?php if ( $logo ) : ?>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home">
			<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $blog_name ); ?>" />
		</a>

	<?php else : ?>

		<div class="site-text-logo wpex-clr">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home">
				<?php echo wpex_sanitize( $blog_name, 'html' ); ?>
			</a>
		</div><!-- .site-text-logo -->

	<?php endif; ?>

</div><!-- .wpex-site-logo -->