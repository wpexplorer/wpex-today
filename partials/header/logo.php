<?php
/**
 * Outputs the header logo.
 */

defined( 'ABSPATH' ) || exit;

$logo      = get_theme_mod( 'logo' );
$blog_name = get_bloginfo( 'name' ) ?: '';

$logo_id = ( $logo && ! is_numeric( $logo ) ) ? attachment_url_to_postid( $logo ) : $logo;

?>

<div class="wpex-site-logo">

	<?php if ( $logo_id ) :

		// Get retina logo.
		$retina_logo = get_theme_mod( 'logo_retina' );
		$retina_logo_id = ( $retina_logo && ! is_numeric( $retina_logo ) ) ? attachment_url_to_postid( $logo ) : $retina_logo;

		// Define logo image attributes.
		$logo_attrs = [
			'loading'       => false,
			'fetchpriority' => 'high'
		];

		if ( $retina_logo_id ) {
			$logo_img = wp_get_attachment_url( $logo_id, 'full' );
			$logo_img_retina = wp_get_attachment_url( $retina_logo_id, 'full' );
			$logo_attrs['srcset'] = "{$logo_img} 1x,{$logo_img_retina} 2x";
		} ?>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home"><?php
			echo wp_get_attachment_image(
				$logo_id,
				'full',
				false,
				$logo_attrs
			);
		?></a>

	<?php else : ?>

		<div class="site-text-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( $blog_name ); ?></a>
		</div><!-- .site-text-logo -->

	<?php endif; ?>

</div><!-- .wpex-site-logo -->