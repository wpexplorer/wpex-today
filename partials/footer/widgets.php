<?php
/**
 * Footer widgets.
 */

defined( 'ABSPATH' ) || exit;

// Get footer columns option
$columns = get_theme_mod( 'footer_widget_columns', '4' );

// Bail if columns is set to NULL
if ( ! $columns || '0' == $columns ) {
	return;
}

// Widget classes
$classes = 'wpex-footer-box';

?>

<div class="wpex-footer-widgets wpex-row wpex-cols-<?php echo sanitize_html_class( $columns ); ?>">

	<?php if ( $columns >= 1 ) : ?>

		<div class="<?php echo esc_attr( $classes ) ?>">
			<?php dynamic_sidebar( 'footer-one' ); ?>
		</div><!-- .footer-box -->

	<?php endif; ?>

	<?php if ( $columns > 1 ) : ?>

		<div class="<?php echo esc_attr( $classes ) ?>">
			<?php dynamic_sidebar( 'footer-two' ); ?>
		</div><!-- .footer-box -->

	<?php endif; ?>

	<?php if ( $columns > 2 ) : ?>

		<div class="<?php echo esc_attr( $classes ) ?>">
			<?php dynamic_sidebar( 'footer-three' ); ?>
		</div><!-- .footer-box -->

	<?php endif; ?>

	<?php if ( $columns > 3 ) : ?>

		<div class="<?php echo esc_attr( $classes ) ?>">
			<?php dynamic_sidebar( 'footer-four' ); ?>
		</div><!-- .footer-box -->
		
	<?php endif; ?>

</div><!-- .wpex-footer-widgets -->