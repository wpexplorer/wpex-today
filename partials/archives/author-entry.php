<?php
/**
 * Author bio.
 */

defined( 'ABSPATH' ) || exit;

// Vars
global $wpex_author;
$user_id			= $wpex_author->ID;
$display_name		= $wpex_author->display_name;
$author_profile_url	= get_author_posts_url( $user_id ); ?>

<article class="wpex-author-info wpex-boxed wpex-clr">

	<div class="wpex-author-info-inner wpex-clr">

		<div class="wpex-author-info-avatar">
			<a href="<?php echo esc_url( $author_profile_url ); ?>" title="<?php esc_attr_e( 'Posts by', 'wpex-today' ); ?> <?php echo esc_attr( $display_name ); ?>">
				<?php echo get_avatar( $user_id , '80' ); ?>
			</a>
		</div><!-- .wpex-author-info-avatar -->

		<div class="wpex-author-info-desc">

			<h2 class="wpex-author-info-title">
				<a href="<?php echo esc_url( $author_profile_url ); ?>" title="<?php esc_attr_e( 'Posts by', 'wpex-today' ); ?> <?php echo esc_attr( $display_name ); ?>">
					<?php echo esc_html( $display_name ); ?>
				</a>
			</h2><!-- .wpex-author-info-title -->

			<p><?php echo get_user_meta( $user_id, 'description', true ); ?></p>

			<?php
			// If any social option is defined display the social links
			if ( wpex_author_has_social( $user_id ) ) : ?>

				<div class="wpex-author-info-social wpex-clr">

					<?php
					// Display twitter url
					if ( $url = get_the_author_meta( 'wpex_twitter', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Twitter" class="wpex-twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
					<?php }

					// Display facebook url
					if ( $url = get_the_author_meta( 'wpex_facebook', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Facebook" class="wpex-facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
					<?php }

					// Display Linkedin url
					if ( $url = get_the_author_meta( 'wpex_linkedin', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Facebook" class="wpex-linkedin"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
					<?php }

					// Display pinterest plus url
					if ( $url = get_the_author_meta( 'wpex_pinterest', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Pinterest" class="wpex-pinterest"><span class="fa fa-pinterest" aria-hidden="true"></span></a>
					<?php }

					// Display instagram plus url
					if ( $url = get_the_author_meta( 'wpex_instagram', $user_id ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Instagram" class="wpex-instagram"><span class="fa fa-instagram" aria-hidden="true"></span></a>
					<?php }

					// Website URL
					if ( $url = get_the_author_meta( 'url', $post->post_author ) ) { ?>

						<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>" target="_blank"><span class="fa fa-external-link-square" aria-hidden="true"></span></a>

					<?php } ?>

				</div><!-- .author-bio-social -->

			<?php endif; ?>

		</div><!-- .wpex-author-info-desc -->

	</div><!-- .wpex-author-info-inner -->

</article><!-- .wpex-author-info -->