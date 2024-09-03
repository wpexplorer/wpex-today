<?php
/**
 * Footer Layout.
 */

defined( 'ABSPATH' ) || exit;

$has_footer_widgets = wpex_has_footer_widgets(); ?>

<?php get_template_part( 'partials/footer/ad' ); ?>

<footer class="wpex-site-footer-wrap">

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