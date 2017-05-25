<?php
/**
 * Outputs pagination
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

// Get pagination style
$style = wpex_get_theme_mod( 'pagination_style', 'numbered' );

// Get global query
global $wp_query, $wpex_query;

// Get total pages based on query
if ( $wpex_query ) {
	$total = $wpex_query->max_num_pages;
} else {
	$total = $wp_query->max_num_pages;
}

// Show only if there are more then 1 post
if ( $total > 1 ) :

	// Numbered pagination
	if ( 'numbered' == $style ) : ?>

		<div class="wpex-page-numbers wpex-clr"> 

			<?php
			// Get current page
			if ( ! $current_page = get_query_var( 'paged' ) ) {
				$current_page = 1;
			}

			// Get correct permalink structure
			if ( get_option( 'permalink_structure' ) ) {
				$format = 'page/%#%/';
			} else {
				$format = '&paged=%#%';
			}

			// Args
			$args = apply_filters( 'wpex_pagination_args', array(
				'base'      => str_replace( 999999999, '%#%', html_entity_decode( get_pagenum_link( 999999999 ) ) ),
				'format'    => $format,
				'current'   => max( 1, get_query_var( 'paged') ),
				'total'     => $total,
				'mid_size'  => 3,
				'type'      => 'list',
				'prev_text' => '<span class="fa fa-angle-left"></span>',
				'next_text' => '<span class="fa fa-angle-right"></span>',
			) );

			// Output pagination
			echo paginate_links( $args ); ?>

		 </div><!-- .page-numbers -->

	<?php else : 

		$next = get_previous_posts_link( esc_html__( 'Newer Entries', 'today' ) .'<span class="fa fa-chevron-right"></span>' );
		$prev = get_next_posts_link( '<span class="fa fa-chevron-left"></span>'. esc_html__( 'Older Entries', 'today' ) ); ?>

		<div class="wpex-next-prev-nav wpex-heading-font-family wpex-clr">
			<?php if ( $prev ) : ?>
				<div class="nav-next"><?php echo wpex_sanitize( $prev, 'html' ); ?></div>
			<?php endif; ?>
			<?php if ( $next ) : ?>
				<div class="nav-previous"><?php echo wpex_sanitize( $next, 'html' ); ?></div>
			<?php endif; ?>
		</div>

	<?php endif; ?>

<?php endif; ?>