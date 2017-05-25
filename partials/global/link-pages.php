<?php
/**
 * Post pagination
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

// Post pagination
wp_link_pages( array(
	'before'      => '<div class="wpex-page-links wpex-clr">',
	'after'       => '</div>',
	'link_before' => '<span>',
	'link_after'  => '</span>',
) ); ?>