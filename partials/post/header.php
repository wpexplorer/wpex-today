<?php
/**
 * Outputs the post header
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
} ?>

<header class="wpex-post-header wpex-clr">

	<h1 class="wpex-post-title"><?php the_title(); ?></h1>
	
</header><!-- .wpex-post-header -->