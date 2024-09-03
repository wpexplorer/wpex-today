<?php
/**
 * Archives header.
 */

defined( 'ABSPATH' ) || exit;

if ( is_front_page() ) {
	$home_h1   = get_theme_mod( 'home_h1' );
	$home_text = get_theme_mod( 'home_text' );
} else {
	$home_h1 = $home_text = null;
}

// Only used for archives and search results
if ( is_archive() || is_search() || $home_h1 || $home_text ) : ?>

	<header class="wpex-archive-header">

		<?php if ( is_front_page() ) { ?>
			<?php if ( $home_h1 ) { ?><h1 class="wpex-archive-title"><?php echo esc_html( $home_h1 ); ?></h1><?php } ?>
		<?php } else { ?>
			<h1 class="wpex-archive-title"><?php is_search() ? esc_html_e( 'Search Results', 'wpex-today' ) : the_archive_title();  ?></h1>
		<?php } ?>

		<?php
		// Show search query
		if ( is_search() ) : ?>

			<div class="wpex-term-description">
				<?php printf( esc_html__( 'You searched for: "%s"', 'wpex-today' ), '<span>'. get_search_query() .'</span>' ); ?>
			</div><!-- #wpex-term-description -->

		<?php
		// Display archive description
		elseif ( term_description() || $home_text ) : ?>

			<div class="wpex-term-description">
				<?php echo wp_kses_post( $home_text ?: term_description() ); ?>
			</div><!-- #wpex-term-description -->

		<?php endif; ?>

	</header><!-- .wpex-archive-header -->

<?php endif; ?>