<?php
/**
 * Top header navigation.
 */

defined( 'ABSPATH' ) || exit;

$location = 'main';

if ( has_nav_menu( $location ) ) :

?>

	<nav class="wpex-site-nav-wrap">
		<div class="wpex-site-nav">
			<div class="wpex-site-nav-inner">
				<a href="#mobile-nav" class="wpex-mobile-nav-toggle wpex-off-canvas-menu-btn">
					<span class="wpex-mobile-nav-toggle-icon"><?php echo wpex_get_icon( 'menu' ); ?></span>
					<?php if ( $mvt_text = apply_filters( 'wpex_mobile_menu_text', esc_html__( 'Menu', 'wpex-today' ) ) ) : ?>
						<span class="wpex-mobile-nav-toggle-text"><?php echo esc_html( $mvt_text ); ?></span>
					<?php endif; ?>
				</a><!-- .wpex-site-nav-toggle -->
				<?php
				// Display menu
				wp_nav_menu( array(
					'theme_location'  => $location,
					'fallback_cb'     => false,
					'container_class' => null,
					'menu_class'      => 'wpex-dropdown-menu',
					'walker'          => new WPEX_Dropdown_Walker_Nav_Menu,
				) ); ?>
				<?php get_template_part( 'partials/header/social' ); ?>
			</div><!-- .wpex-site-nav-inner -->
		</div><!-- .wpex-site-nav -->
	</nav><!-- .wpex-site-nav-wrap -->

<?php endif; ?>