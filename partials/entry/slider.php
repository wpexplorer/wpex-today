<?php
/**
 * Outputs the post slider
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

// Get gallery image ids
$imgs             = wpex_get_gallery_ids();
$lightbox_enabled = false;

// Post vars
global $post;
$post_id = $post->ID;

// Show slider if there are images to display
if ( $imgs ) : ?>

	<?php
	// Enqueue scripts
	if ( ! wpex_has_minified_js() ) {
		wp_enqueue_script( 'lightslider' );
	} ?>

	<div class="wpex-post-slider-wrap wpex-loop-entry-media wpex-clr">

		<?php
		// Display category tab
		if ( wpex_get_theme_mod( 'entry_category', true ) ) : ?>
		
			<?php get_template_part( 'partials/entry/category' ); ?>

		<?php endif; ?>
	
		<?php
		// Get first image to display as a placeholder while the slider simplexml_load_string(
		$first_img     = $imgs[0];
		$first_img     = wp_get_attachment_image_src( $first_img, 'wpex_entry', false );
		$first_img_alt = strip_tags( get_post_meta( $first_img, '_wp_attachment_image_alt', true ) );
		if ( isset( $first_img[0] ) ) : ?>

			<div class="slider-first-image-holder">
				<img src="<?php echo esc_url( $first_img[0] ); ?>" alt="<?php echo esc_attr( $first_img_alt ); ?>" width="<?php echo esc_attr( $first_img[1] ); ?>" height="<?php echo esc_attr( $first_img[2] ); ?>" />
			</div><!-- .slider-first-image-holder -->

		<?php endif; ?>

		<div class="wpex-post-slider wpex-lightbox-gallery lightslider">

			<?php
			// Loop through each attachment ID
			foreach ( $imgs as $img ) :

				// Get image data
				$img_url       = wp_get_attachment_image_src( $img, 'full', false );
				$img_url       = $img_url[0];
				$thumbnail_url = wp_get_attachment_image_src( $img, 'wpex_entry', false );
				$img_alt       = strip_tags( get_post_meta( $img, '_wp_attachment_image_alt', true ) );
				$caption       = get_post_field( 'post_excerpt', $img );

				// Display slide if thumbnail_url exists
				if ( $thumbnail_url ) : ?>

					<div class="wpex-post-slider-slide">

						<?php
						// Display image with lightbox
						if ( 'on' == $lightbox_enabled ) : ?>

							<a href="<?php echo esc_url( $img_url ); ?>" title="<?php echo esc_attr( $img_alt ); ?>" class="wpex-lightbox-item"><img src="<?php echo esc_url( $thumbnail_url[0] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" width="<?php echo esc_attr( $thumbnail_url[1] ); ?>" height="<?php echo esc_attr( $thumbnail_url[2] ); ?>" /></a>

						<?php
						// Lightbox is disabled, only show image
						else : ?>

							<img src="<?php echo esc_url( $thumbnail_url[0] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" width="<?php echo esc_attr( $thumbnail_url[1] ); ?>" height="<?php echo esc_attr( $thumbnail_url[2] ); ?>" />

						<?php endif; ?>

						<?php if ( $caption ) : ?>

							<div class="wpex-post-slider-caption wpex-clr">
								<?php echo wpex_sanitize( $caption, 'html' ); ?>
							</div><!-- .wpex-post-slider-caption -->

						<?php endif; ?>

					</div><!-- .wpex-post-slider-slide -->

				<?php endif; ?>

			<?php endforeach; ?>

		</div><!-- .wpex-post-slider -->

	</div><!-- .wpex-post-slider-wrap -->
	
<?php endif; ?>