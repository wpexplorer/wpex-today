<?php
/**
 * Displays the post thumbnail
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

<?php if ( has_post_thumbnail() ) : ?>

	<div class="wpex-post-media wpex-post-thumbnail wpex-clr">

		<?php the_post_thumbnail( 'wpex_post' ); ?>

	</div><!-- .wpex-post-media -->

<?php endif; ?>