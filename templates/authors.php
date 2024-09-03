<?php
/**
 * Template Name: Authors
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

	<div class="wpex-content-area">

		<header class="wpex-archive-header">
			<h1 class="wpex-archive-title"><?php the_title(); ?></h1>
		</header>

		<main class="wpex-site-main">

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

			<div class="wpex-authors-listing">

				<?php foreach( $users as $wpex_author ) : ?>

					<?php get_template_part( 'partials/archives/author-entry' ); ?>

				<?php endforeach; ?>

			</div><!-- .wpex-authors-listing -->

			<?php comments_template(); ?>

		</main><!-- .wpex-main -->

	</div><!-- .wpex-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>