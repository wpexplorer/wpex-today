<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 */

defined( 'ABSPATH' ) || exit;

final class WPEX_Today_Theme_Setup {

	/**
	 * Start things up
	 *
     * @since  1.0.0
     * @access public
	 */
	public function __construct() {

		// Tweak excerpt more text.
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

		// Add user contact fields.
		add_filter( 'user_contactmethods', array( $this, 'user_fields' ) );

		// Add custom body classes.
		add_filter( 'body_class', array( $this, 'body_classes' ) );

		// Load theme files.
		add_action( 'after_setup_theme', array( $this, 'load_files' ) );

		// Theme setup.
		add_action( 'after_setup_theme', array( $this, 'setup' ) );

		// Load theme CSS.
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_css' ) );

		// Load theme js scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_js' ) );

		// Register sidebars.
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );

		// Move Comment textarea form field back to bottom.
		if ( apply_filters( 'wpex_move_comment_form_fields', true ) ) {
			add_filter( 'comment_form_fields', array( $this, 'move_comment_form_fields' ) );
		}

		// Alter tag font size.
		add_filter( 'widget_tag_cloud_args', array( $this, 'tag_font_size' ) );

		// Remove default gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

	}

	/**
	 * Include functions and classes.
	 *
     * @since  1.0.0
     * @access public
	 */
	public function load_files() {

		// Include Theme Functions.
		require_once get_parent_theme_file_path( '/inc/core-functions.php' );
		require_once get_parent_theme_file_path( '/inc/conditionals.php' );
		require_once get_parent_theme_file_path( '/inc/customizer-config.php' );
		require_once get_parent_theme_file_path( '/inc/accent-config.php' );

		// Include Classes.
		require_once get_parent_theme_file_path( '/inc/classes/customizer/customizer.php' );

		// WPML/Polilang config.
		require_once get_parent_theme_file_path( '/inc/translators-config.php' );

	}

	/**
	 * Functions called during each page load, after the theme is initialized.
	 * Perform basic setup, registration, and init actions for the theme.
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 */
	public function setup() {

		// Define content_width variable.
		if ( ! isset( $content_width ) ) {
			$content_width = 745;
		}

		// Register navigation menus.
		register_nav_menus ( array(
			'main' => esc_html__( 'Main', 'wpex-today' ),
		) );

		// Add editor styles.
		add_editor_style( 'assets/css/editor-style.css' );

		// Localization support.
		load_theme_textdomain( 'wpex-today', get_template_directory() . '/languages' );

		// Add theme support.
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-header' );

		// Add image sizes.
		add_image_size(
			'wpex_entry',
			get_theme_mod( 'entry_thumbnail_width', 9999 ),
			get_theme_mod( 'entry_thumbnail_height', 9999 ),
			wpex_parse_image_crop( get_theme_mod( 'entry_thumbnail_crop' ) )
		);
		add_image_size(
			'wpex_entry_featured',
			get_theme_mod( 'entry_featured_thumbnail_width', 9999 ),
			get_theme_mod( 'entry_featured_thumbnail_height', 9999 ),
			wpex_parse_image_crop( get_theme_mod( 'entry_featured_thumbnail_crop' ) )
		);
		add_image_size(
			'wpex_post',
			get_theme_mod( 'post_thumbnail_width', 9999 ),
			get_theme_mod( 'post_thumbnail_height', 9999 ),
			wpex_parse_image_crop( get_theme_mod( 'post_thumbnail_crop' ) )
		);
		add_image_size(
			'wpex_related_entry',
			get_theme_mod( 'post_related_thumbnail_width', 9999 ),
			get_theme_mod( 'post_related_thumbnail_height', 9999 ),
			wpex_parse_image_crop( get_theme_mod( 'post_related_thumbnail_crop' ) )
		);

	}

	/**
	 * Load custom CSS scripts in the front end.
	 *
     * @since  1.0.0
     * @access public
     *
     * @link   https://codex.wordpress.org/Function_Reference/wp_enqueue_style
	 */
	public function theme_css() {
		wp_enqueue_style( 'style', get_stylesheet_uri() );

		if ( get_theme_mod( 'responsive', true ) ) {
			wp_enqueue_style( 'wpex-responsive', get_parent_theme_file_uri( 'assets/css/responsive.css' ) );
		}
	}

	/**
	 * Load custom JS scripts in the front end.
	 *
     * @since  1.0.0
     * @access public
     *
	 * @link   https://codex.wordpress.org/Function_Reference/wp_enqueue_script
	 */
	public function theme_js() {

		// Comment reply.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Localize scripts.
		$localize  = apply_filters( 'wpex_localize', array(
			'isRTL'           => is_rtl(),
			'mobileMenuOpen'  => get_theme_mod( 'mobile_menu_open_text' ) ?: esc_html__( 'Menu', 'wpex-today' ),
			'mobileMenuClose' => get_theme_mod( 'mobile_menu_close_text' ) ?: esc_html__( 'Menu', 'wpex-today' ),
		) );

		// Theme functions.
		wp_enqueue_script( 'wpex-functions', get_parent_theme_file_uri( 'assets/js/functions.js' ), array( 'jquery' ), false, true );
		wp_localize_script( 'wpex-functions', 'wpexLocalize', $localize );
	}

	/**
	 * Registers the theme sidebars.
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	public function register_sidebars() {

		// Sidebar.
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar - Main', 'wpex-today' ),
			'id'            => 'sidebar',
			'before_widget' => '<div class="wpex-sidebar-widget %2$s wpex-clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		) );

		// Sidebar.
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar - Pages', 'wpex-today' ),
			'id'            => 'sidebar_pages',
			'before_widget' => '<div class="wpex-sidebar-widget %2$s wpex-clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		) );

		// Get footer columns.
		$cols = get_theme_mod( 'footer_columns', '4' );

		// Footer 1.
		if ( $cols >= 1 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 1', 'wpex-today' ),
				'id'            => 'footer-one',
				'before_widget' => '<div class="footer-widget %2$s wpex-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title">',
				'after_title'   => '</div>',
			) );

		}

		// Footer 2.
		if ( $cols > 1 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 2', 'wpex-today' ),
				'id'            => 'footer-two',
				'before_widget' => '<div class="footer-widget %2$s wpex-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title">',
				'after_title'   => '</div>',
			) );

		}

		// Footer 3.
		if ( $cols > 2 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 3', 'wpex-today' ),
				'id'            => 'footer-three',
				'before_widget' => '<div class="footer-widget %2$s wpex-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title">',
				'after_title'   => '</div>',
			) );

		}

		// Footer 4.
		if ( $cols > 3 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 4', 'wpex-today' ),
				'id'            => 'footer-four',
				'before_widget' => '<div class="footer-widget %2$s wpex-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title">',
				'after_title'   => '</div>',
			) );

		}

	}

	/**
	 * Adds classes to the body_class function.
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link http://codex.wordpress.org/Function_Reference/body_class
	 */
	public function body_classes( $classes ) {
		$classes[] = wpex_get_post_layout();
		return $classes;
	}

	/**
	 * Return custom excerpt more string.
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_more
	 */
	public function excerpt_more( $more ) {
		return $more;
	}

	/**
	 * Add new user fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Filter_Reference/user_contactmethods
	 */
	public function user_fields( $contactmethods ) {

		// Add Twitter.
		if ( ! isset( $contactmethods['wpex_twitter'] ) ) {
			$contactmethods['wpex_twitter'] = 'Today - X';
		}

		// Add Facebook.
		if ( ! isset( $contactmethods['wpex_facebook'] ) ) {
			$contactmethods['wpex_facebook'] = 'Today - Facebook';
		}

		// Add LinkedIn.
		if ( ! isset( $contactmethods['wpex_linkedin'] ) ) {
			$contactmethods['wpex_linkedin'] = 'Today - LinkedIn';
		}

		// Add Pinterest.
		if ( ! isset( $contactmethods['wpex_pinterest'] ) ) {
			$contactmethods['wpex_pinterest'] = 'Today - Pinterest';
		}

		// Add Instagram.
		if ( ! isset( $contactmethods['wpex_instagram'] ) ) {
			$contactmethods['wpex_instagram'] = 'Today - Instagram';
		}

		// Return contactmethods.
		return $contactmethods;

	}


	/**
	 * Move Comment form field back to bottom which was altered in WP 4.4.
	 *
	 * @since 1.1.0
	 */
	public function move_comment_form_fields( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}


	/**
	 * Alter the default tag font sizes.
	 *
	 * @since 1.0.0
	 */
	public function tag_font_size( $args ) {
		$args['smallest'] = '0.857';
		$args['largest']  = '0.857';
		$args['unit']     = 'em';
		return $args;
	}

}

$wpex_today_theme_setup = new WPEX_Today_Theme_Setup;
