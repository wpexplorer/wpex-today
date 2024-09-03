<?php
/**
 * Single related posts.
 */

defined( 'ABSPATH' ) || exit;

// Make sure we should display related items
if ( 'post' != get_post_type() ) {
	return;
}

// Get count
$count = get_theme_mod( 'post_related_count', '6' );
if ( ! $count || 0 == $count ) {
	return;
}

// Prevent stupid shit
if ( $count > 99 ) {
	$count = 10;
}

// Get Current post
$post_id = get_the_ID();

// What should be displayed?
$display = get_theme_mod( 'post_related_displays', 'related_category' );

// Related query arguments
$args = array(
	'posts_per_page' => $count,
	'post__not_in'   => array( $post_id ),
	'no_found_rows'  => true,
);
if ( 'related_category' == $display ) {
	$cats = wp_get_post_terms( $post_id, 'category' ); 
	$cats_ids = array();  
	foreach( $cats as $wpex_related_cat ) {
		$cats_ids[] = $wpex_related_cat->term_id; 
	}
	if ( ! empty( $cats_ids ) ) {
		$args['category__in'] = $cats_ids;
	}
} elseif ( 'random' == $display ) {
	$args['orderby'] = 'rand';
}

// Apply filters to the related query for child theming
$args = apply_filters( 'wpex_related_posts_args', $args );

// Run Query
$wpex_query = new wp_query( $args );

// Display related items
if ( $wpex_query->have_posts() ) {

	// Get columns
	$columns = get_theme_mod( 'post_related_columns', '3' ); ?>

	<section class="wpex-related-posts-wrap">

		<?php
		// Display heading
		$heading = get_theme_mod( 'post_related_heading' ) ?: esc_html__( 'You May Also Like', 'wpex-today' );
		if ( $heading ) : ?>
			<h4 class="wpex-heading"><?php echo esc_html( $heading ); ?></h4>
		<?php endif; ?>

		<div class="wpex-related-posts wpex-row wpex-cols-3">
			<?php
			// Loop through related posts
			foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

				<div class="wpex-related-post wpex-col wpex-col-<?php echo sanitize_html_class( $columns ); ?>">

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="wpex-related-post-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>"><?php the_post_thumbnail( 'wpex_related_entry' ); ?></a>
						</div><!-- .related-wpex-post-thumbnail -->
					<?php endif; ?>

					<div class="wpex-related-post-content">
						<h3 class="wpex-related-post-title">
							<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="wpex-related-post-meta"><?php echo get_the_date(); ?></div>
						</div><!-- .related-post-content -->
				</div><!-- .related-post -->

			<?php endforeach; ?>

		</div><!-- .wpex-related-posts -->

	</section><!-- .wpex-related-posts-wrap -->

<?php } // End related items

// Reset post data
wp_reset_postdata();