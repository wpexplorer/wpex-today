<?php
/**
 * Top header navigation.
 */

defined( 'ABSPATH' ) || exit;

// Location ID
$location = 'main';

// Check to make sure menu isn't empty
if ( has_nav_menu( $location ) ) : ?>

	<nav class="wpex-site-nav-wrap wpex-clr">

		<div class="wpex-site-nav wpex-container wpex-clr">

			<div class="wpex-site-nav-inner wpex-clr">

				<a href="#mobile-nav" class="wpex-mobile-nav-toggle wpex-off-canvas-menu-btn">
					<span class="fa fa-bars wpex-mobile-nav-toggle-icon" aria-hidden="true"></span>
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
					'menu_class'      => 'wpex-dropdown-menu wpex-clr',
					'walker'          => new WPEX_Dropdown_Walker_Nav_Menu,
				) ); ?>

				<?php get_template_part( 'partials/header/social' ); ?>

				</div><!-- .wpex-site-nav-inner -->

		</div><!-- .wpex-site-nav -->

	</nav><!-- .wpex-site-nav-wrap -->

<?php endif; ?>