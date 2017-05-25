<?php
/**
 * Outputs social sharing links for single posts
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Heading text
$heading = apply_filters( 'wpex_social_share_heading', null ); ?>

<div class="wpex-post-share wpex-heading-font-family wpex-clr">

	<?php if ( $heading ) : ?>
		<h4 class="heading"><?php echo wpex_sanitize( $heading, 'html' ); ?></h4>
	<?php endif; ?>

	<ul class="wpex-post-share-list wpex-clr">
	
		<li class="wpex-twitter">
			<a href="http://twitter.com/share?text=<?php echo urlencode( esc_attr( the_title_attribute( 'echo=0' ) ) ); ?>&amp;url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" title="<?php esc_html_e( 'Share on Twitter', 'today' ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<span class="fa fa-twitter"></span><?php esc_html_e( 'Tweet', 'today' ); ?>
			</a>
		</li>

		<li class="wpex-facebook">
			<a href="http://www.facebook.com/share.php?u=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" title="<?php esc_html_e( 'Share on Facebook', 'today' ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<span class="fa fa-facebook"></span><?php esc_html_e( 'Share', 'today' ); ?>
			</a>
		</li>

		<li class="wpex-pinterest">
			<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>&amp;media=<?php echo urlencode( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>&amp;description=<?php echo urlencode( wpex_sanitize( get_the_excerpt(), 'html' ) ); ?>" title="<?php esc_html_e( 'Share on Pinterest', 'today' ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<span class="fa fa-pinterest"></span><?php esc_html_e( 'Pin it', 'today' ); ?>
			</a>
		</li>

		<li class="wpex-comment">
			<a href="#comments" title="<?php esc_html_e( 'Comment', 'today' ); ?>" rel="nofollow">
				<span class="fa fa-commenting-o"></span><?php esc_html_e( 'Comment', 'today' ); ?>
			</a>
		</li>

	</ul>

</div><!-- .wpex-post-share -->