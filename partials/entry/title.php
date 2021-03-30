<?php
/**
 * The post entry title.
 */

defined( 'ABSPATH' ) || exit;

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