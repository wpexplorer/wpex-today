<?php
/**
 * Displays the entry video.
 */

defined( 'ABSPATH' ) || exit;

// Display video if defined
if ( $video = get_post_meta( get_the_ID(), 'wpex_post_video', true ) ) :

	// Check what type of video it is
	$type = wpex_check_meta_type( $video ); ?>

	<div class="wpex-loop-entry-video wpex-loop-entry-media wpex-responsive-embed wpex-clr">
		<?php
		// Standard Embeds
		if ( 'iframe' == $type || 'embed' == $type ) {
			echo wpex_sanitize( $video, 'video' );
		}
		// Oembeds
		else {
			echo wp_oembed_get( $video );
		} ?>
	</div><!-- .wpex-loop-entry-video -->
	
<?php endif; ?>