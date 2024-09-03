<?php
/**
 * Used to output entry meta info - date, category, comments, author...etc
 */

defined( 'ABSPATH' ) || exit;

// Get items to display
$meta_items = array( 'date' );
$meta_items	= array_combine( $meta_items, $meta_items );

// Remove date
if ( ! get_theme_mod( 'entry_meta_date', true ) ) {
	unset( $meta_items['date'] );
}

// Remove author
if ( ! get_theme_mod( 'entry_meta_author', true ) ) {
	unset( $meta_items['author'] );
}

// Remove comments
if ( ! get_theme_mod( 'entry_meta_comments', true ) ) {
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
	$terms = wpex_get_post_terms( $taxonomy, true );
} else {
	$terms = NULL;
}

?>

<div class="wpex-loop-entry-meta">

	<ul>

		<?php
		// Loop through meta options
		$first = true;
		foreach ( $meta_items as $meta_item ) :
			if ( $first ) {
				$first = false;
			} else {
				echo '<li class="wpex-meta-spacer"><span>&middot;</span></li>';
			}
		?>

			<?php
			// Display date
			if ( 'date' == $meta_item ) : ?>

				<li class="wpex-date"><?php echo get_the_date(); ?></li>

			<?php endif; ?>

			<?php
			// Display author
			if ( 'author' == $meta_item ) : ?>

				<li class="wpex-author"><?php the_author_posts_link(); ?></li>

			<?php endif; ?>

			<?php
			// Display category
			if ( 'category' == $meta_item && isset( $terms ) ) : ?>

				<li class="wpex-categories"><?php
					echo wp_kses_post( $terms );
				?></li>

			<?php endif; ?>

			<?php
			// Display comments
			if ( 'comments' == $meta_item && comments_open() && wpex_has_comments() && ! post_password_required() ) : ?>

				<li class="wpex-comments"><span class="wpex-spacer">&middot;</span><?php comments_popup_link( esc_html__( '0 Comments', 'wpex-today' ), esc_html__( '1 Comment',  'wpex-today' ), esc_html__( '% Comments', 'wpex-today' ), 'comments-link' ); ?></li>

			<?php endif; ?>

		<?php endforeach; ?>

	</ul>

</div><!-- .wpex-entry-meta -->