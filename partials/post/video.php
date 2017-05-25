<?php
/**
 * Displays the post video
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

// Display video if defined
if ( $video = get_post_meta( get_the_ID(), 'wpex_post_video', true ) ) :

	// Check what type of video it is
	$type = wpex_check_meta_type( $video ); ?>

	<div class="wpex-post-media wpex-post-video wpex-responsive-embed wpex-clr">
		<?php
		// Standard Embeds
		if ( 'iframe' == $type || 'embed' == $type ) {
			echo wpex_sanitize( $video, 'video' );
		}
		// Oembeds
		else {
			echo wp_oembed_get( $video );
		} ?>
	</div><!-- .wpex-post-video -->

<?php endif; ?>