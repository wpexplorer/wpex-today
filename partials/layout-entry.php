<?php
/**
 * The default template for displaying post entries.
 */

defined( 'ABSPATH' ) || exit;

// Base classes for entry
$classes = array( 'wpex-loop-entry' );

// Counter
global $is_featured_post;

// Check if embeds are allowed
$allow_embeds = apply_filters( 'wpex_entry_embeds', false );

// Entry columns
if ( $is_featured_post ) {
	$classes[] = 'wpex-featured-entry';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<div class="wpex-loop-entry-inner">

		<?php if ( get_theme_mod( 'entry_thumbnail', true ) && has_post_thumbnail() ) : ?>
			<?php get_template_part( 'partials/entry/thumbnail' ); ?>
		<?php endif; ?>

		<div class="wpex-loop-entry-content">

			<?php
			// Display category tab
			if ( get_theme_mod( 'entry_category', true ) ) : ?>
				<?php get_template_part( 'partials/entry/category' ); ?>
			<?php endif; ?>

			<?php
			// Display title
			get_template_part( 'partials/entry/title' ); ?>

			<?php
			// Display entry meta
			if ( get_theme_mod( 'entry_meta', true ) ) : ?>
				<?php get_template_part( 'partials/entry/meta' ); ?>
			<?php endif; ?>

			<?php
			// Display entry excerpt/content
			get_template_part( 'partials/entry/content' ); ?>

			<?php
			// Entry Footer
			if ( get_theme_mod( 'entry_readmore', true )
				|| get_theme_mod( 'entry_social_share', true )
			) : ?>

			<?php
			// Display entry readmore
			if ( get_theme_mod( 'entry_readmore', true ) ) : ?>
			 	<?php get_template_part( 'partials/entry/readmore' ); ?>
			<?php endif; ?>

			<?php endif; ?>

		</div><!-- .wpex-loop-entry-content -->

	</div><!-- .wpex-boxed-container -->

</article><!-- .wpex-loop-entry -->