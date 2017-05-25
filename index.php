<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

get_header();

// Check if we have posts
$have_posts = have_posts() ? true : false;

// Check if featured post is enabled
$featured_post_enabled = wpex_get_theme_mod( 'archive_featured_post', true );
$featured_post_enabled = apply_filters( 'wpex_archive_featured_post', $featured_post_enabled );

if ( is_search() ) {
	$featured_post_enabled = false;
} ?>

<div class="wpex-content-area wpex-clr">

	<?php
	// Display page header
	get_template_part( 'partials/archives/header' ); ?>

	<?php
	// Featured Post
	if ( $have_posts && $featured_post_enabled ) : ?>

		<?php get_template_part( 'partials/archives/featured-post' ); ?>

	<?php endif; ?>

	<main class="wpex-site-main wpex-clr">

		<?php
		// Check if posts exist
		if ( $have_posts ) : ?>

			<div class="wpex-entries wpex-row wpex-clr">   

				<?php
				// Set counter
				$wpex_count = 0;

				// Get query
				global $wp_query;

				// Get featured post ID
				$featured_post = wpex_get_featured_post( $wp_query );

				// Loop through posts
				while ( have_posts() ) : the_post();

					// Exclude featured post
					if ( $featured_post == get_the_ID() && $featured_post_enabled ) {
						continue;
					}

					// Add to counter
					$wpex_count++;

					// Display post entry
					get_template_part( 'partials/layout-entry' );

				// End loop
				endwhile; ?>

			</div><!-- .wpex-entries -->

			<?php
			// Include pagination template part
			wpex_include_template( 'partials/global/pagination.php' ); ?>

		<?php
		// Display no posts found message
		else : ?>

			<?php get_template_part( 'partials/entry/none' ); ?>

		<?php endif; ?>

	</main><!-- .wpex-main -->

</div><!-- .wpex-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>