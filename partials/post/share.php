<?php
/**
 * Outputs social sharing links for single posts.
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="wpex-post-share">

	<?php if ( $heading = apply_filters( 'wpex_social_share_heading', null ) ) : ?>
		<h4 class="heading"><?php echo esc_html( $heading ); ?></h4>
	<?php endif; ?>

	<ul class="wpex-post-share-list">

		<li class="wpex-twitter">
			<a href="http://twitter.com/share?text=<?php echo urlencode( esc_attr( the_title_attribute( 'echo=0' ) ) ); ?>&amp;url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<?php echo wpex_get_icon( 'twitter' ); ?><?php esc_html_e( 'Post', 'wpex-today' ); ?>
			</a>
		</li>

		<li class="wpex-facebook">
			<a href="http://www.facebook.com/share.php?u=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
			<?php echo wpex_get_icon( 'facebook' ); ?><?php esc_html_e( 'Share', 'wpex-today' ); ?>
			</a>
		</li>

		<li class="wpex-pinterest">
			<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>&amp;media=<?php echo urlencode( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>&amp;description=<?php echo urlencode( wp_kses_post( get_the_excerpt() ) ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
			<?php echo wpex_get_icon( 'pinterest' ); ?><?php esc_html_e( 'Pin it', 'wpex-today' ); ?>
			</a>
		</li>

	</ul>

</div><!-- .wpex-post-share -->