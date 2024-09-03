<?php
/**
 * The template for displaying Author bios.
 */

defined( 'ABSPATH' ) || exit;

// Author description required
if ( $description = get_the_author_meta( 'description' ) ) :

	global $post;
	$user_id = $post->post_author;
	?>

	<section class="wpex-author-info">

		<h4 class="wpex-heading" itemscope itemtype="http://schema.org/Person"><?php esc_html_e( 'Article written by', 'wpex-today' ); ?>: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php esc_attr( esc_html_e( 'Visit Author Page', 'wpex-today' ) ); ?>"><span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php echo strip_tags( get_the_author() ); ?></span></span></a></h4>

		<div class="wpex-author-info-inner">

			<div class="wpex-author-info-avatar">

				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php esc_attr( esc_html_e( 'Visit Author Page', 'wpex-today' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 70 ) ); ?></a>

			</div><!-- .wpex-author-info-avatar -->

			<div class="wpex-author-info-desc">
				
				<div class="wpex-author-info-content wpex-entry">
					<p><?php echo wp_kses_post( $description ); ?></p>
				</div><!-- .wpex-author-info-content -->

				<div class="wpex-author-info-social">
					<?php
					// Display twitter url
					if ( $url = get_the_author_meta( 'wpex_twitter', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Twitter" class="wpex-twitter"><?php echo wpex_get_icon( 'twitter' ); ?></a>
					<?php }

					// Display facebook url
					if ( $url = get_the_author_meta( 'wpex_facebook', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Facebook" class="wpex-facebook"><?php echo wpex_get_icon( 'facebook' ); ?></a>
					<?php }

					// Display Linkedin url
					if ( $url = get_the_author_meta( 'wpex_linkedin', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Facebook" class="wpex-linkedin"><?php echo wpex_get_icon( 'linkedin' ); ?></a>
					<?php }

					// Display pinterest plus url
					if ( $url = get_the_author_meta( 'wpex_pinterest', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Pinterest" class="wpex-pinterest"><?php echo wpex_get_icon( 'pinterest' ); ?></a>
					<?php }

					// Display instagram url
					if ( $url = get_the_author_meta( 'wpex_instagram', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Instagram" class="wpex-instagram"><?php echo wpex_get_icon( 'instagram' ); ?></a>
					<?php }

					// Website URL
					if ( $url = get_the_author_meta( 'url', $post->post_author ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php echo wpex_get_icon( 'website' ); ?></a>
					<?php } ?>
				</div><!-- .author-info-social -->

			</div><!-- .wpex-author-info-desc -->

		</div><!-- .wpex-author-info-inner -->

	</section><!-- .wpex-author-info -->

<?php endif; ?>