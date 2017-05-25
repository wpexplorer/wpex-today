<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPEX_Welcome Class
 *
 * A general class for About and Credits page.
 *
 * @since 1.4
 */
class WPEX_Welcome {

	/**
	 * Get things started
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_init', array( $this, 'welcome' ) );
	}

	/**
	 * Register the Dashboard Pages which are later hidden but these pages
	 * are used to render the Welcome and Credits pages.
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function admin_menus() {
		
		// Recommended
		add_theme_page(
			__( 'Today Theme', 'wpex-today' ),
			__( 'Today Theme', 'wpex-today' ),
			'manage_options',
			'wpex-theme',
			array( $this, 'recommended_screen' ),
			'dashicons-desktop'
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

			<h1>Today Theme v<?php echo esc_html( $theme_version ); ?></h1>

			<div class="about-text" style="margin-bottom:40px;min-height:0;"><?php esc_html_e( 'A free WordPress theme by WPExplorer.com', 'wpex-today' ); ?></div>

			<div style="padding-bottom:100px;">

				<h2 style="text-align:left;font-size:18px;font-weight:bold;margin:0 0 5px;line-height:1em;"><?php esc_html_e( 'About', 'wpex-today' ); ?></h2>
				<hr />

				<div>
					<h4><?php esc_html_e( 'GPL License', 'wpex-today' ); ?></h4>
					<p><?php esc_html_e( 'This theme is licensed under the GPL license. This means you can use it for anything you like as long as it remains GPL.', 'wpex-today' ); ?></p>
				</div>

				<div>
					<h4><?php esc_html_e( 'Credits', 'wpex-today' ); ?></h4>
					<p>
					<?php esc_html_e( 'This theme was created by WPExplorer.com.', 'wpex-today' ); ?>
					<br />
					<?php esc_html_e( 'We work hard to develop and update this theme.', 'wpex-today' ); ?>
					<br />
					<?php esc_html_e( 'A back-link to our website is very much appreciated or you can follow us via our social media!', 'wpex-today' ); ?>
					</p>
					<p>
						<a href="https://twitter.com/WPExplorer" class="button button-secondary">Twitter</a>
						<a href="https://www.facebook.com/WPExplorerThemes/" class="button button-secondary">Facebook</a>
						<a href="https://www.youtube.com/user/wpexplorertv" class="button button-secondary">Youtube</a>
					</p>
				</div>

				<div>
					<h4><?php esc_html_e( 'Liability', 'wpex-today' ); ?></h4>
					<p>
					<?php esc_html_e( 'WPExplorer.com shall not be held liable for any damages, including, but not limited to, the loss of data or profit, arising from the use of, or inability to use, this theme.', 'wpex-today' ); ?>
					</p>
				</div>

				<br /><br />

				<h2 style="text-align:left;font-size:18px;font-weight:bold;margin:0 0 5px;line-height:1em;"><?php esc_html_e( 'Getting Started', 'wpex-today' ); ?></h2>

				<hr />

				<div>
					<p>
					<?php esc_html_e( 'Below you will find some useful links to get you started with this theme.', 'wpex-today' ); ?>
					</p>
					<?php
					// Customizer url
					$customize_url = add_query_arg(
						array(
							'return' => urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ),
						),
						'customize.php'
					); ?>
					<a href="<?php echo esc_url( $customize_url ); ?>" class="button button-primary load-customize hide-if-no-customize"><?php esc_html_e( 'Customize Your Site', 'wpex-today' ); ?></a>
					<a href="http://www.wpexplorer.com/today-free-wordpress/" target="_blank" class="button button-primary"><?php esc_html_e( 'Theme Page', 'wpex-today' ); ?></a>
				</div>

				<br /><br />

				<h2 style="text-align:left;font-size:18px;font-weight:bold;margin:0 0 5px;line-height:1em;"><?php esc_html_e( 'Recommendations', 'wpex-today' ); ?></h2>

				<hr />

				<div>
				<h4><?php esc_html_e( 'Plugins', 'wpex-today' ); ?></h4>
				<p><?php esc_html_e( 'Below you will find links to plugins we (WPExplorer.com staff) personally like and recommend. None of these plugins are required for your theme to work, they simply add additional functionality.', 'wpex-today' ); ?></p>

					<ul style="list-style: disc;margin: 20px 0 0 20px;">
						<li><span style="font-weight:bold">Backups:</span> <a href="https://vaultpress.com/" target="_blank">VaultPress</a></li>
						<li><span style="font-weight:bold">Shortcodes:</span> <a href="http://www.wpexplorer.com/symple-shortcodes/" target="_blank">Symple Shortcodes</a></li>
						<li><span style="font-weight:bold">Contact Forms:</span> <a href="http://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7</a> or <a href="http://www.wpexplorer.com/gravity-forms-plugin/" target="_blank">Gravity Forms</a></li>
						<li><span style="font-weight:bold">Page Builder:</span> <a href="http://www.wpexplorer.com/visual-composer-guide/" target="_blank">Visual Composer</a></li>
						<li><span style="font-weight:bold">Image Sliders:</span class> <a href="http://www.wpexplorer.com/revolution-slider-review-guide/" target="_blank">Slider Revolution</a></li>
						<li><span style="font-weight:bold">Other:</span> <a href="http://jetpack.me/" target="_blank">JetPack</a></li>
					</ul>
				</div>

				<br />
				<hr />

				<div>
					<h4><?php esc_html_e( 'Total Drag & Drop Theme', 'wpex-today' ); ?></h4>
					<p><?php esc_html_e( 'Check out our most advanced (yet easy to use) and flexible theme to date.', 'wpex-today' ); ?></p>
					<a href="http://wpexplorer-themes.com/total/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/inc/total.png" alt="Total WordPress Theme" /></a>
				</div>

				<br />
				<hr />

				<div>
					<h4><?php esc_html_e( 'WordPress Hosting', 'wpex-today' ); ?></h4>
					<p><?php esc_html_e( 'If you need fast and reliable hosting we recommend the same host we use and love WPEngine.', 'wpex-today' ); ?></p>
					<a href="http://www.wpexplorer.com/wordpress-hosting/" class="button button-primary" target="_blank"> WordPress Hosting</a>
				</div>

				<br />
				<hr />

				<div>
					<h4><?php esc_html_e( 'Deals & Coupons', 'wpex-today' ); ?></h4>
					<p><?php esc_html_e( 'Check out our coupons page for great deals on WordPress resources.', 'wpex-today' ); ?></p>
					<a href="http://www.wpexplorer.com/coupons/" class="button button-primary" target="_blank">View Deals/Coupons</a>
				</div>

			</div>

		</div><!-- .wrap about-wrap -->


		<?php
	}

	/**
	 * Sends user to the Welcome page on theme activation
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function welcome() {
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
	
}
new WPEX_Welcome();