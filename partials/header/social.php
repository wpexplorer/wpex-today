<?php
/**
 * Socialbar.
 */

defined( 'ABSPATH' ) || exit;

// Display topbar social
if ( wpex_get_theme_mod( 'topbar_social_enable', true )
		&& $social_options = wpex_header_social_options_array()
) : ?>

	<div class="wpex-socialbar wpex-clr">
		<?php foreach ( $social_options as $key => $val ) :
			if ( $url = esc_url( wpex_get_theme_mod( 'socialbar_'. $key ) ) ) :
			$target_blank = wpex_get_theme_mod( 'socialbar_target_blank' ) ? true : false; ?>
				<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $val['label'] ); ?>"<?php wpex_target_blank( $target_blank ); ?>><span class="<?php echo esc_attr( $val['icon_class'] ); ?>"></span></a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div><!-- .wpex-socialbar -->

<?php endif; ?>