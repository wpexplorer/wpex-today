 <?php
/**
 * The template for displaying Comments.
 */

defined( 'ABSPATH' ) || exit;

// Return if not needed.
if ( post_password_required() || ( ! comments_open() && get_comment_pages_count() == 0 ) ) {
	return;
}

// Return if comments disabled.
if ( ! wpex_has_comments() ) {
	return;
} ?>

<div id="comments" class="comments-area wpex-clr">

	<?php
	// Display comments if we have some.
	if ( have_comments() ) : ?>

		<h2 class="wpex-comments-title wpex-heading"><span><?php esc_html_e( 'Join the discussion', 'wpex-today' ); ?></span></h2>

		<ol class="commentlist">

			<?php
			// Display comments.
			wp_list_comments( array(
				'callback'	=> 'wpex_comment',
			) ); ?>

		</ol><!-- .commentlist -->

		<?php
		// Display comment pagination.
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav class="navigation comment-navigation row wpex-clr" role="navigation">
				<h3 class="assistive-text wpex-heading">
					<span><?php esc_html_e( 'Comment navigation', 'wpex-today' ); ?></span>
				</h3>
				<div class="wpex-clr">
					<div class="wpex-nav-previous">
						<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'wpex-today' ) ); ?>
					</div>
					<div class="wpex-nav-next">
						<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'wpex-today' ) ); ?>
					</div>
				</div><!-- .wpex-clr -->
			</nav>

		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
	// Display comments closed notice.
	if ( ! comments_open() ) : ?>

		<div class="comments-closed-notice wpex-clr">

			<?php esc_html_e( 'Comments are now closed.', 'wpex-today' ); ?>

		</div><!-- .comments-closed-notice -->

	<?php endif; ?>

	<?php
	// Display comment submission form.
	$args = array();
	if ( get_theme_mod( 'disable_comment_form_notes' ) ) {
		$args['comment_notes_after'] = null;
	}
	comment_form( $args ); ?>

</div><!-- #comments -->