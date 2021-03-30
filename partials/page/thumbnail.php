<?php
/**
 * Displays the page thumbnail.
 */

defined( 'ABSPATH' ) || exit;

?>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="wpex-page-thumbnail wpex-clr">
		<?php if ( wpex_has_page_featured_image_overlay_title() ) : ?>
			<div class="wpex-page-thumbnail-title">
				<div class="wpex-page-thumbnail-title-inner">
					<h1><span><?php the_title(); ?></span></h1>
				</div><!-- .wpex-page-thumbnail-title-inner -->
			</div><!-- .wpex-page-thumbnail-title -->
		<?php endif; ?>
		<?php the_post_thumbnail( apply_filters( 'wpex_page_thumbnail_size', 'full' ) ); ?>
	</div><!-- .wpex-page-thumbnail -->
<?php endif; ?>