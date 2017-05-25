<?php
/**
 * Footer widgets
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

// Get footer columns option
$columns = get_theme_mod( 'footer_widget_columns', '4' );

// Bail if columns is set to NULL
if ( ! $columns || '0' == $columns ) {
	return;
}

// Widget classes
$classes = 'wpex-footer-box wpex-col wpex-clr';
$classes .= ' wpex-col-' . intval( $columns ); ?>

<div class="wpex-footer-widgets wpex-row wpex-clr">

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