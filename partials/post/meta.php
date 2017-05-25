<?php
/**
 * Used to output post meta info - date, category, comments, author...etc
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

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get items to display
$meta_items = array( 'date', 'author', 'comments' );
$meta_items	= array_combine( $meta_items, $meta_items );

// Remove date
if ( ! wpex_get_theme_mod( 'post_meta_date', true ) ) {
	unset( $meta_items['date'] );
}

// Remove author
if ( ! wpex_get_theme_mod( 'post_meta_author', true ) ) {
	unset( $meta_items['author'] );
}

// Remove comments
if ( ! wpex_get_theme_mod( 'post_meta_comments', true ) ) {
	unset( $meta_items['comments'] );
}

// You can tweak the meta output via a function, yay!
$meta_items = apply_filters( 'wpex_meta_items', $meta_items );

// Get taxonomy for the posted under section
if ( 'post' == get_post_type() ) {
	$taxonomy = 'category';
} else {
	$taxonomy = NULL;
}

// Get terms
if ( $taxonomy ) {
	$terms = wpex_get_post_terms( $taxonomy );
} else {
	$terms = NULL;
} ?>

<div class="wpex-post-meta wpex-clr">

	<ul class="wpex-clr">

		<?php
		// Loop through meta options
		foreach ( $meta_items as $meta_item ) : ?>

			<?php
			// Display date
			if ( 'date' == $meta_item ) : ?>

				<li class="wpex-date"><span class="wpex-spacer">&middot;</span><?php echo get_the_date(); ?></li>

			<?php endif; ?>

			<?php
			// Display author
			if ( 'author' == $meta_item ) : ?>

				<li class="wpex-author"><span class="wpex-spacer">&middot;</span><?php the_author_posts_link(); ?></li>

			<?php endif; ?>

			<?php
			// Display category
			if ( 'category' == $meta_item && isset( $terms ) ) : ?>

				<li class="wpex-categories"><span class="wpex-spacer">&middot;</span><?php echo wpex_sanitize( $terms, 'html' ); ?></li>

			<?php endif; ?>

			<?php
			// Display comments
			if ( 'comments' == $meta_item && comments_open() && wpex_has_comments() && ! post_password_required() ) : ?>

				<li class="wpex-comments"><span class="wpex-spacer">&middot;</span><?php comments_popup_link( esc_html__( '0 Comments', 'today' ), esc_html__( '1 Comment',  'today' ), esc_html__( '% Comments', 'today' ), 'comments-link' ); ?></li>

			<?php endif; ?>

		<?php endforeach; ?>

	</ul>

</div><!-- .wpex-post-meta -->