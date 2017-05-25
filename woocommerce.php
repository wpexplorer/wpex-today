<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

get_header(); ?>

	<?php
	// Display page thumbnail
	get_template_part( 'partials/woocommerce/header-image' );

	// Display shop categories
	get_template_part( 'partials/woocommerce/shop-categories' ); ?>

	<div class="wpex-content-area wpex-clr">

		<?php
		// Display page header
		get_template_part( 'partials/woocommerce/header' ); ?>

		<main class="wpex-site-main wpex-clr">

			<?php
			// Search display
			if ( is_search() && ! have_posts() ) : ?>

				<?php get_template_part( 'partials/entry/none' ); ?>
			
			<?php
			// Standard content
			else : ?>

				<div class="wpex-entry wpex-clr">

					<?php woocommerce_content(); ?>
					
				</div><!-- .wpex-entry -->

			<?php endif; ?>

		</main><!-- .wpex-main -->

	</div><!-- .wpex-content-area -->

<?php get_sidebar( 'woocommerce' ); ?>

<?php get_footer(); ?>