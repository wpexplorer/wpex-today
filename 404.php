<?php
/**
 * The template for the 404 not found page.
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

get_header(); ?>

	<div class="wpex-content-area wpex-clr">
		<main class="wpex-site-main wpex-clr">
			<?php get_template_part( 'partials/entry/none' ); ?>
		</main><!-- .wpex-site-main -->
	</div><!-- .wpex-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>