<?php
/**
 * Displays the entry thumbnail.
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

// Display thumbnail
if ( has_post_thumbnail() ) : ?>

	<div class="wpex-loop-entry-thumbnail wpex-loop-entry-media wpex-clr">
		<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="wpex-loop-entry-media-link"><?php the_post_thumbnail( wpex_get_entry_image_size() ); ?></a>
	</div><!-- .wpex-loop-entry-thumbnail -->

<?php endif; ?>