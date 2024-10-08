<?php
/**
 * The Template for displaying all single posts.
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="wpex-content-area">

			<?php wpex_ad_region( 'single-top' ); ?>

			<main class="wpex-site-main">

				<div class="site-main-inner">

					<?php get_template_part( 'partials/layout-post' ); ?>

				</div><!-- .site-main-inner -->

			</main><!-- .wpex-main -->

		</div><!-- .wpex-content-area -->

	<?php endwhile; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>