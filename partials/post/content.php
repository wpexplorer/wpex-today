<?php
/**
 * Outputs the post content
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

<div class="wpex-post-content wpex-entry wpex-clr">
	<?php the_content(); ?>
</div><!-- .wpex-post-content -->