<?php
defined( 'ABSPATH' ) || exit;

/**
 * WPEX_Theme_Admin_About Class.
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

		$this->info = wpex_theme_info();

		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'admin_head', array( $this, 'admin_head' ) );

	}

	/**
	 * Sends user to the About page on theme activation.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function admin_init() {

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
	 * Register the Dashboard Pages.
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function admin_menus() {

		add_theme_page(
			esc_html( 'Theme Details', 'wpex-today' ),
			esc_html( 'Theme Details', 'wpex-today' ),
			'manage_options',
			'wpex-theme',
			array( $this, 'recommended_screen' )
		);

	}

	/**
	 * Hide dashboard tabs from the menu.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function admin_head() {
		remove_submenu_page( 'index.php', 'wpex-about' );
	}

	/**
	 * Render Recommended Screen.
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

			<div class="about-text" style="margin-bottom:45px;min-height:0;"><?php echo esc_html_x( 'A free WordPress theme by WPExplorer', 'theme about page', 'wpex-today' ); ?> | <a href="<?php echo esc_url( $this->info[ 'url' ] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html_x( 'Theme Details', 'theme about page', 'wpex-today' ); ?></a><?php if ( ! empty( $this->info[ 'support' ] ) ) { ?> | <a href="<?php echo esc_url( $this->info[ 'support' ] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html_x( 'Report a Bug', 'theme about page', 'wpex-today' ); ?></a><?php } ?></div>

			<div style="padding-bottom:100px;">

				<div>
					<h4><?php echo esc_html_x( 'GPL License', 'theme about page', 'wpex-today' ); ?></h4>
					<p><?php echo esc_html_x( 'This theme is licensed under the GPL license. This means you can use it for anything you like as long as it remains GPL.', 'theme about page', 'wpex-today' ); ?></p>
				</div>

				<div>
					<h4><?php echo esc_html_x( 'Disclaimer', 'theme about page', 'wpex-today' ); ?></h4>
					<p><?php echo esc_html_x( 'This theme is provided “as is”. WPExplorer and Symple Workz LLC disclaim all warranties of any kind to the fullest extent of the law. You agree that your use of the theme is at your own risk.', 'theme about page', 'wpex-today' ); ?></p>
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
						<a href="https://twitter.com/WPExplorer" class="button button-secondary" target="_blank" rel="noopener noreferrer">Twitter</a>
						<a href="https://www.facebook.com/WPExplorerThemes/" class="button button-secondary" target="_blank" rel="noopener noreferrer">Facebook</a>
						<a href="https://www.youtube.com/user/wpexplorertv" class="button button-secondary" target="_blank" rel="noopener noreferrer">Youtube</a>
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
						<li>- <a href="https://www.wpexplorer.com/wordpress-hosting/" target="_blank" rel="noopener noreferrer">Choosing The Best WordPress Hosting for Your Site</a></li>
						<li>- <a href="https://www.wpexplorer.com/wordpress-seo/" target="_blank" rel="noopener noreferrer">WordPress SEO Guide</a></li>
						<li>- <a href="https://www.wpexplorer.com/wordpress-security/" target="_blank" rel="noopener noreferrer">Improve your WordPress Site Security</a></li>
						<li>- <a href="https://www.wpexplorer.com/how-to-speed-up-wordpress/" target="_blank" rel="noopener noreferrer">Speed Up Your WordPress Site</a></li>
						<li>- <a href="https://vaultpress.com/" target="_blank" rel="noopener noreferrer"><a href="https://www.wpexplorer.com/coupons/" target="_blank" rel="noopener noreferrer">Deals & Coupons for WordPress Products & Services</a></a></li>
						<li>- <a href="https://profiles.wordpress.org/wpexplorer/#content-plugins" target="_blank" rel="noopener noreferrer">Our Plugins</a></li>
						<li>- <a href="https://www.wpexplorer.com/wordpress-themes/" target="_blank" rel="noopener noreferrer">More Themes</a></li>
					</ul>
				</div>

				<hr />

				<h3><?php echo esc_html_x( 'Total Drag & Drop Theme', 'theme about page', 'wpex-today' ); ?></h3>

				<div>
					<p><?php echo esc_html_x( 'Check out our most advanced (yet easy to use) and flexible theme to date.', 'theme about page', 'wpex-today' ); ?></p>
					<a href="https://total.wpexplorer.com/" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( get_template_directory_uri() . '/admin/total-theme.jpg' ); ?>" alt="Total WordPress Theme" style="max-width:100%;" /></a>
				</div>

			</div>

		</div><!-- .wrap -->

		<?php
	}

}
new WPEX_Theme_Admin_About();