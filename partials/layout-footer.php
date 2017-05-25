<?php
/**
 * Footer Layout
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

$has_footer_widgets = wpex_has_footer_widgets(); ?>

<?php get_template_part( 'partials/footer/ad' ); ?>

<footer class="wpex-site-footer-wrap wpex-clr">

	<div class="wpex-site-footer wpex-container wpex-clr">

		<?php if ( $has_footer_widgets ) : ?>

			<?php get_template_part( 'partials/footer/widgets' ); ?>

		<?php endif; ?>

		<?php if ( get_theme_mod( 'footer_copyright', true  ) ) : ?>
			
			<div class="wpex-footer-bottom<?php if ( $has_footer_widgets ) echo ' wpex-has-footer-widgets'; ?>">
				<?php get_template_part( 'partials/footer/copyright' ); ?>
			</div><!-- .wpex-footer-bottom -->

		<?php endif; ?>

	</div><!-- .wpex-site-footer -->

</footer><!-- .wpex-site-footer-wrap -->