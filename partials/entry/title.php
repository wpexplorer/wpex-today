<?php
/**
 * The post entry title
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2019, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$allows_embeds = wpex_get_theme_mod( 'entry_embeds', false ); ?>

<header class="wpex-loop-entry-header wpex-clr">
	<h2 class="wpex-loop-entry-title">
		<a href="<?php the_permalink(); ?>">
			<?php
			// Show play icon
			if ( ! $allows_embeds && wpex_has_post_video() ) {
				echo '<span class="fa fa-play-circle wpex-video-icon" aria-hidden="true"></span>';
			}
			// Show music icon
			if ( ! $allows_embeds && wpex_has_post_audio() ) {
				echo '<span class="fa fa-music wpex-music-icon" aria-hidden="true"></span>';
			}
			// Show title
			the_title(); ?>
		</a>
	</h2><!-- .wpex-loop-entry-title -->
</header><!-- .wpex-loop-entry-header -->