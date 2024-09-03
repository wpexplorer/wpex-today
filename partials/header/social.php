<?php
/**
 * Social bar.
 */

defined( 'ABSPATH' ) || exit;

if ( get_theme_mod( 'header_social', true )
	&& $social_options = wpex_header_social_options_array()
) :

$target_blank = wp_validate_boolean( get_theme_mod( 'socialbar_target_blank' ) );
?>

	<div class="wpex-socialbar">
		<?php foreach ( $social_options as $key => $val ) :
			if ( $url = get_theme_mod( 'socialbar_' . $key ) ) : ?>
				<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $val['label'] ); ?>"<?php echo $target_blank ? ' target="_blank"' : ''; ?>><?php echo wpex_get_icon( $key ); ?></a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div><!-- .wpex-socialbar -->

<?php endif; ?>