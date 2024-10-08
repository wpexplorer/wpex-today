<?php
/**
 * The template for displaying a "No posts found" message.
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="wpex-entry-none">

	<?php if ( is_home() ) { ?>

		<p><?php esc_html_e( 'There aren\'t any posts currently published on this site.', 'wpex-today' ); ?></p>

	<?php } elseif ( is_search() ) { ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms.', 'wpex-today' ); ?></p>

	<?php } elseif ( is_category() ) { ?>

		<p><?php esc_html_e( 'There aren\'t any posts currently published in this category.', 'wpex-today' ); ?></p>

	<?php } elseif ( is_tax() ) { ?>

		<p><?php esc_html_e( 'There aren\'t any posts currently published under this taxonomy.', 'wpex-today' ); ?></p>

	<?php } elseif ( is_tag() ) { ?>

		<p><?php esc_html_e( 'There aren\'t any posts currently published under this tag.', 'wpex-today' ); ?></p>

	<?php } elseif ( is_404() ) { ?>

		<h1>404</h1>
		<p><?php esc_html_e( 'Unfortunately, the page you are looking for does not exist.', 'wpex-today' ); ?></p>

	<?php } else { ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'wpex-today' ); ?></p>

	<?php } ?>

</div><!-- .wpex-entry-none -->