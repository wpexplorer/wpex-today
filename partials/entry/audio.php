<?php
/**
 * Displays the entry audio
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

// Return if no audio
if ( ! $audio ) {
	return;
}

// Check what type of audio it is
$type = wpex_check_meta_type( $audio );

// Sanitize Return output
if ( 'iframe' == $type || 'embed' == $type ) {
    $embed_code = $audio;
} else {
    $embed_code = wp_oembed_get( $audio );
}

// Display audio
if ( $embed_code ) : ?>

    <div class="wpex-loop-entry-audio wpex-loop-entry-media wpex-clr">
        <?php echo wpex_sanitize( $embed_code, 'audio' ); ?>
    </div><!-- .wpex-loop-entry-audio -->
    
<?php endif; ?>