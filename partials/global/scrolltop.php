<?php
/**
 * Scroll to top button
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2019, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<a href="#" title="<?php esc_html_e( 'Top', 'wpex-today' ); ?>" class="wpex-site-scroll-top"><span class="fa fa-angle-up" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'back to top', 'wpex-today' ); ?></span></a>