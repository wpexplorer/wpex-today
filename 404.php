<?php
/**
 * The template for the 404 not found page.
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

	<div class="wpex-content-area">
		<main class="wpex-site-main">
			<?php get_template_part( 'partials/entry/none' ); ?>
		</main><!-- .wpex-site-main -->
	</div><!-- .wpex-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>