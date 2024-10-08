<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

	<div class="wpex-content-area">

		<main class="wpex-site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/layout-page' ); ?>

			<?php endwhile; ?>

		</main><!-- .wpex-site-main -->

	</div><!-- .wpex-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>