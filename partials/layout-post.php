<?php
/**
 * Single post layout.
 */

defined( 'ABSPATH' ) || exit;

// Check password protection
$pass_protected = post_password_required();

?>

<article class="wpex-post-article wpex-clr">

	<?php
	// Entry media should display only if not protected
	if ( ! $pass_protected ) : ?>
		<?php if ( has_post_thumbnail() && get_theme_mod( 'post_thumbnail', true ) ) : ?>
			<?php get_template_part( 'partials/post/thumbnail' ); ?>
		<?php endif ?>
	<?php endif ?>

	<?php
	// Display category tag
	if ( get_theme_mod( 'post_category', true ) ) : ?>

		<?php get_template_part( 'partials/post/category' ); ?>
		
	<?php endif; ?>

	<?php
	// Display post header
	get_template_part( 'partials/post/header' ); ?>

	<?php
	// Display meta
	if ( get_theme_mod( 'post_meta', true ) ) : ?>
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
	if ( ! $pass_protected && get_theme_mod( 'post_tags', true ) ) : ?>

		<?php get_template_part( 'partials/post/tags' ); ?>

	<?php endif; ?>

	<?php
	// Display post author
	if ( ! $pass_protected && wpex_has_author_bio() ) : ?>

		<?php get_template_part( 'partials/post/author' ); ?>

	<?php endif; ?>

	<?php
	// Display related posts
	if ( ! $pass_protected && get_theme_mod( 'post_related', true ) ) : ?>

		<?php get_template_part( 'partials/post/related' ); ?>

	<?php endif; ?>

	<?php
	// Ad region
	wpex_ad_region( 'single-bottom' ); ?>

	<?php
	// Display comments
	if ( get_theme_mod( 'comments_on_posts', true ) ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>

	<?php
	// Display post nav (next/prev)
	if ( get_theme_mod ( 'post_next_prev', true ) ) {
		get_template_part( 'partials/post/navigation' );
	} ?>

</article><!-- .wpex-port-article -->