<?php
/**
 * Displays the entry thumbnail.
 */

defined( 'ABSPATH' ) || exit;

// Display thumbnail
if ( has_post_thumbnail() ) : ?>

	<div class="wpex-loop-entry-thumbnail wpex-loop-entry-media">
		<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="wpex-loop-entry-media-link"><?php the_post_thumbnail( wpex_get_entry_image_size() ); ?></a>
	</div><!-- .wpex-loop-entry-thumbnail -->

<?php endif; ?>