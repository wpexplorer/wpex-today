<?php
/**
 * The post entry title.
 */

defined( 'ABSPATH' ) || exit;

$allows_embeds = get_theme_mod( 'entry_embeds', false ); ?>

<header class="wpex-loop-entry-header wpex-clr">
	<h2 class="wpex-loop-entry-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2><!-- .wpex-loop-entry-title -->
</header><!-- .wpex-loop-entry-header -->