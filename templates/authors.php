<?php
/**
 * Template Name: Authors
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

	<?php get_template_part( 'partials/page/thumbnail' ); ?>

	<div class="wpex-content-area wpex-clr">

		<main class="wpex-site-main wpex-clr">

			<?php
			// Get a list of users.
			$administrators = get_users( array(
				'orderby' => 'post_count',
				'role'    => 'administrator',
				'order'   => 'DESC',
			) );
			$authors = get_users( array(
				'orderby' => 'post_count',
				'role'    => 'author',
				'order'   => 'DESC',
			) );
			$contributors = get_users( array(
				'orderby' => 'post_count',
				'role'    => 'contributor',
				'order'   => 'DESC',
			) );
			$users = array_merge( $administrators, $authors );
			$users = array_merge( $users, $contributors ); ?>

			<div class="wpex-authors-listing wpex-clr">

				<?php foreach( $users as $wpex_author ) : ?>

					<?php get_template_part( 'partials/archives/author-entry' ); ?>

				<?php endforeach; ?>

			</div><!-- .wpex-authors-listing -->

			<?php comments_template(); ?>

		</main><!-- .wpex-main -->

	</div><!-- .wpex-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>