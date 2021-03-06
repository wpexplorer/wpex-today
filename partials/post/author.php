<?php
/**
 * The template for displaying Author bios.
 */

defined( 'ABSPATH' ) || exit;

// Author description required
if ( $description = get_the_author_meta( 'description' ) ) : ?>

	<section class="wpex-author-info wpex-clr">

		<h4 class="wpex-heading" itemscope itemtype="http://schema.org/Person"><?php esc_html_e( 'Article written by', 'wpex-today' ); ?>: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php esc_attr( esc_html_e( 'Visit Author Page', 'wpex-today' ) ); ?>"><span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php echo strip_tags( get_the_author() ); ?></span></span></a></h4>

		<div class="wpex-author-info-inner wpex-clr">

			<div class="wpex-author-info-avatar">

				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php esc_attr( esc_html_e( 'Visit Author Page', 'wpex-today' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 70 ) ); ?></a>

			</div><!-- .wpex-author-info-avatar -->

			<div class="wpex-author-info-content wpex-entry wpex-clr">
				<p><?php echo wpex_sanitize( $description, 'html' ); ?></p>
			</div><!-- .wpex-author-info-content -->

			<div class="wpex-author-info-social wpex-clr">

				<?php
				// Display twitter url
				if ( $url = get_the_author_meta( 'wpex_twitter', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="Twitter" class="wpex-twitter" target="_blank"><span class="fa fa-twitter" aria-hidden="true"></span></a>
				<?php }
				// Display facebook url
				if ( $url = get_the_author_meta( 'wpex_facebook', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="Facebook" class="wpex-facebook" target="_blank"><span class="fa fa-facebook" aria-hidden="true"></span></a>
				<?php }
				// Display Linkedin url
				if ( $url = get_the_author_meta( 'wpex_linkedin', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="LinkedIn" class="wpex-linkedin" target="_blank"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
				<?php }
				// Display pinterest plus url
				if ( $url = get_the_author_meta( 'wpex_pinterest', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="Pinterest" class="wpex-pinterest" target="_blank"><span class="fa fa-pinterest" aria-hidden="true"></span></a>
				<?php }
				// Display instagram plus url
				if ( $url = get_the_author_meta( 'wpex_instagram', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="Instagram" class="wpex-instagram" target="_blank"><span class="fa fa-instagram" aria-hidden="true"></span></a>
				<?php } ?>

			</div><!-- .wpex-author-info-social -->

		</div><!-- .wpex-author-info-inner -->

	</section><!-- .wpex-author-info -->

<?php endif; ?>