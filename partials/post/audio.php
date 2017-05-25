<?php
/**
 * Displays the post audio
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

// Get audio
$audio = get_post_meta( get_the_ID(), 'wpex_post_audio', true );

// Check what type of audio it is
$type = wpex_check_meta_type( $audio );

// Return output
if ( 'iframe' == $type || 'embed' == $type ) {
	$audio = wpex_sanitize( $audio, 'audio' ); // Sanitize audio, see @ inc/core-functions.php
} else {
	$audio = wp_oembed_get( $audio );
} ?>

<?php if ( $audio ) : ?>

	<div class="wpex-post-media wpex-post-audio wpex-clr">
		<?php echo wpex_sanitize( $audio, 'audio' ); ?>
	</div><!-- .wpex-post-audio -->
	
<?php endif; ?>