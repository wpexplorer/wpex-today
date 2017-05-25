<?php
/**
 * Single post layout
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

// Check password protection
$pass_protected = post_password_required(); ?>

<article class="wpex-post-article wpex-clr">

	<?php
	// Entry media should display only if not protected
	if ( ! $pass_protected ) : ?>


		<?php
		// Display post video
		if ( wpex_has_post_video() ) : ?>

			<?php get_template_part( 'partials/post/video' ); ?>

		<?php
		// Display post audio
		elseif ( wpex_has_post_audio() ) : ?>

			<?php get_template_part( 'partials/post/audio' ); ?>

		<?php
		// Display post thumbnail
		elseif ( has_post_thumbnail() && wpex_get_theme_mod( 'post_thumbnail', true ) ) : ?>

			<?php get_template_part( 'partials/post/thumbnail' ); ?>

		<?php endif ?>

	<?php endif ?>

	<?php
	// Display category tag
	if ( wpex_get_theme_mod( 'post_category', true ) ) : ?>

		<?php get_template_part( 'partials/post/category' ); ?>
		
	<?php endif; ?>

	<?php
	// Display post header
	get_template_part( 'partials/post/header' ); ?>

	<?php
	// Display meta
	if ( wpex_get_theme_mod( 'post_meta', true ) ) : ?>
		<?php get_template_part( 'partials/post/meta' ); ?>
	<?php endif; ?>

	<?php
	// Display post content
	get_template_part( 'partials/post/content' ); ?>

	<?php
	// Display post edit link
	get_template_part( 'partials/global/edit' ); ?>

	<?php
	// Display post links
	get_template_part( 'partials/global/link-pages' ); ?>

	<?php
	// Display post share above post
	if ( ! $pass_protected && wpex_has_social_share() ) : ?>
		<?php get_template_part( 'partials/post/share' ); ?>
	<?php endif; ?>

	<?php
	// Display post tags
	if ( ! $pass_protected && wpex_get_theme_mod( 'post_tags', true ) ) : ?>

		<?php get_template_part( 'partials/post/tags' ); ?>

	<?php endif; ?>

	<?php
	// Display post author
	if ( ! $pass_protected && wpex_has_author_bio() ) : ?>

		<?php get_template_part( 'partials/post/author' ); ?>

	<?php endif; ?>

	<?php
	// Display related posts
	if ( ! $pass_protected && wpex_get_theme_mod( 'post_related', true ) ) : ?>

		<?php get_template_part( 'partials/post/related' ); ?>

	<?php endif; ?>

	<?php
	// Ad region
	wpex_ad_region( 'single-bottom' ); ?>

	<?php
	// Display comments
	if ( wpex_get_theme_mod( 'comments_on_posts', true ) ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>

	<?php
	// Display post nav (next/prev)
	if ( wpex_get_theme_mod ( 'post_next_prev', true ) ) {
		get_template_part( 'partials/post/navigation' );
	} ?>

</article><!-- .wpex-port-article -->