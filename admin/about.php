<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPEX_Theme_Admin_About Class
 *
 * A general class for About and Credits page.
 *
 * @since 1.4
 */
class WPEX_Theme_Admin_About {

	/**
	 * Get things started
	 *
	 * @since 1.0
	 */
	public function __construct() {

		// Vars
		$this->info = wpex_theme_info();

		// Check if disabled
		if ( get_theme_mod( 'wpex_disable_theme_about_' . $this->info['slug'], false ) ) {
			return;
		}

		// Actions
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'admin_head', array( $this, 'admin_head' ) );

	}

	/**
	 * Sends user to the About page on theme activation
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function admin_init() {
		// Check if we should hide this page
		if ( isset( $_GET[ 'wpex_disable_theme_about' ] ) ) {
			set_theme_mod( 'wpex_disable_theme_about_' . $this->info['slug'], true, false );
			wp_safe_redirect( admin_url() );
			exit;
		}

		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
			return;
		}
		global $pagenow;
		if ( is_admin()
			&& isset( $_GET['activated'] )
			&& $pagenow == 'themes.php'
			&& current_user_can( 'manage_options' )
		) {
			wp_safe_redirect( admin_url( 'admin.php?page=wpex-theme' ) );
			exit;
		}
	}

	/**
	 * Register the Dashboard Pages which are later hidden but these pages
	 * are used to render the About and Credits pages.
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function admin_menus() {

		add_theme_page(
			$this->info[ 'name' ],
			$this->info[ 'name' ],
			'manage_options',
			'wpex-theme',
			array( $this, 'recommended_screen' ),
		);

	}

	/**
	 * Hide dashboard tabs from the menu
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function admin_head() {
		remove_submenu_page( 'index.php', 'wpex-about' );
	}

	/**
	 * Render Recommended Screen
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function recommended_screen() { ?>

		<div class="wrap about-wrap">

			<?php
			// Get theme version #
			$theme_data    = wp_get_theme();
			$theme_version = $theme_data->get( 'Version' ); ?>

			<h1><?php echo esc_html( $this->info[ 'name' ] ); ?> v<?php echo esc_html( $theme_version ); ?></h1>

			<div class="about-text" style="margin-bottom:45px;min-height:0;"><?php echo esc_html_x( 'A free WordPress theme by WPExplorer', 'theme about page', 'wpex-today' ); ?> | <a href="<?php echo esc_url( $this->info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html_x( 'Theme Details', 'theme about page', 'wpex-today' ); ?></a><?php if ( ! empty( $this->info[ 'support' ] ) ) { ?> | <a href="<?php echo esc_url( $this->info[ 'support' ] ); ?>" target="_blank"><?php echo esc_html_x( 'Report a Bug', 'theme about page', 'wpex-today' ); ?></a><?php } ?></div>

			<div style="padding-bottom:100px;">

				<h3 class="title"><?php echo esc_html_x( 'About', 'theme about page', 'wpex-today' ); ?></h3>

				<div>
					<h4><?php echo esc_html_x( 'GPL License', 'theme about page', 'wpex-today' ); ?></h4>
					<p><?php echo esc_html_x( 'This theme is licensed under the GPL license. This means you can use it for anything you like as long as it remains GPL.', 'theme about page', 'wpex-today' ); ?></p>
				</div>

				<div>
					<h4><?php echo esc_html_x( 'Credits', 'theme about page', 'wpex-today' ); ?></h4>
					<p>
					<?php echo esc_html_x( 'This theme was created by:', 'theme about page', 'wpex-today' ); ?> <a href="https://www.wpexplorer.com/">WPExplorer</a>
					<br />
					<?php echo esc_html_x( 'We work hard to develop, support and update this theme.', 'theme about page', 'wpex-today' ); ?>
					<br />
					<?php echo esc_html_x( 'A back-link to our website is very much appreciated or you can follow us via our social media!', 'theme about page', 'wpex-today' ); ?>
					</p>
					<p>
						<a href="https://twitter.com/WPExplorer" class="button button-secondary" target="_blank">Twitter</a>
						<a href="https://www.facebook.com/WPExplorerThemes/" class="button button-secondary" target="_blank">Facebook</a>
						<a href="https://www.youtube.com/user/wpexplorertv" class="button button-secondary" target="_blank">Youtube</a>
					</p>
				</div>

				<hr />

				<h3><?php echo esc_html_x( 'Getting Started', 'theme about page', 'wpex-today' ); ?></h3>

				<div>
					<p>
					<?php echo esc_html_x( 'Below you will find some useful links to get you started with this theme.', 'theme about page', 'wpex-today' ); ?>
					</p>
					<?php
					// Customizer url
					$customize_url = add_query_arg(
						array(
							'return' => urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ),
						),
						'customize.php'
					); ?>
					<a href="<?php echo esc_url( $customize_url ); ?>" class="button button-primary load-customize hide-if-no-customize"><?php echo esc_html_x( 'Customize Your Site', 'theme about page', 'wpex-today' ); ?></a>
				</div>

				<hr />

				<h3><?php echo esc_html_x( 'Useful Links', 'theme about page', 'wpex-today' ); ?></h3>

				<div>
					<ul>
						<li>- <a href="https://www.wpexplorer.com/wordpress-hosting/" target="_blank">Choosing The Best WordPress Hosting for Your Site</a></li>
						<li>- <a href="https://www.wpexplorer.com/wordpress-seo/" target="_blank">WordPress SEO Guide</a></li>
						<li>- <a href="https://www.wpexplorer.com/wordpress-security/" target="_blank">Improve your WordPress Site Security</a></li>
						<li>- <a href="https://www.wpexplorer.com/how-to-speed-up-wordpress/" target="_blank">Speed Up Your WordPress Site</a></li>
						<li>- <a href="https://vaultpress.com/" target="_blank"><a href="https://www.wpexplorer.com/coupons/" target="_blank">Deals & Coupons for WordPress Products & Services</a></a></li>
					</ul>
				</div>


				<hr />

				<h3><?php echo esc_html_x( 'Total Drag & Drop Theme', 'theme about page', 'wpex-today' ); ?></h3>

				<div>
					<p><?php echo esc_html_x( 'Check out our most advanced (yet easy to use) and flexible theme to date.', 'theme about page', 'wpex-today' ); ?></p>
					<a href="https://total.wpexplorer.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/admin/total-banner.png" alt="Total WordPress Theme" style="width:auto;" /></a>
				</div>

				<hr>

				<div>
					<h4>*** <?php echo esc_html_x( 'Disable This Page', 'theme about page', 'wpex-today' ); ?> ***</h4>
					<p><?php echo esc_html_x( 'Click the link below to disable this about page completely and never see it again.', 'theme about page', 'wpex-today' ); ?></p>
					<a class="button button-secondary" href="<?php echo admin_url( '/admin.php?page=wpex-theme&wpex_disable_theme_about=1' ); ?>"><?php echo esc_html_x( 'Disable This Page', 'theme about page', 'wpex-today' ); ?></a></a>
				</div>

			</div>

		</div><!-- .wrap -->


		<?php
	}

}
new WPEX_Theme_Admin_About();