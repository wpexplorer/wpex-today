<?php
/**
 * Archives header
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

// Home heading
$home_heading = null;
if ( is_front_page() ) {
	$home_heading = wpex_get_theme_mod( 'home_h1_heading' );
}

// Only used for archives and search results
if ( is_archive() || is_search() || $home_heading ) : ?>

	<header class="wpex-archive-header wpex-clr">

		<h1 class="wpex-archive-title">

			<?php if ( $home_heading ) : ?>

				<?php echo wpex_sanitize( $home_heading, 'html' ); ?>

			<?php  elseif ( $custom_archive_title = apply_filters( 'wpex_archive_title', null ) ) : ?>

				<?php echo wpex_sanitize( $custom_archive_title, 'html' ); ?>

			<?php elseif ( is_search() ) : ?>

				<?php esc_html_e( 'Search Results ', 'today' ); ?>

			<?php elseif ( is_tax() || is_category() || is_tag() ) : ?>

				<?php single_term_title(); ?>

			<?php else : ?>

				<?php the_archive_title(); ?>

			<?php endif; ?>

		</h1>

		<?php
		// Show search query
		if ( is_search() ) : ?>

			<div class="wpex-term-description wpex-clr">

				<?php printf( esc_html__( 'You searched for: %s', 'today' ), '<span>'. get_search_query() .'</span>' ); ?>

			</div><!-- #wpex-term-description -->

		<?php
		// Display archive description
		elseif ( term_description() ) : ?>

			<div class="wpex-term-description wpex-clr">

				<?php echo term_description(); ?>
				
			</div><!-- #wpex-term-description -->

		<?php endif; ?>

	</header><!-- .wpex-archive-header -->

<?php endif; ?>