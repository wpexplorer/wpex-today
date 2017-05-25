<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
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
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

class WPEX_Today_Theme_Setup {

	/**
	 * Start things up
	 *
     * @since  1.0.0
     * @access public
	 */
	public function __construct() {

		// Paths
		$this->template_dir     = get_template_directory();
		$this->template_dir_uri = get_template_directory_uri();

		// Auto updates
		if ( is_admin() ) {
			require_once( $this->template_dir .'/inc/updates.php' );
		}

		// Tweak excerpt more text
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

		// Add responsive class to embeds
		add_filter( 'embed_oembed_html', array( $this, 'embed_oembed_html' ), 99, 4 );

		// Add user contact fields
		add_filter( 'user_contactmethods', array( $this, 'user_fields' ) );

		// Add custom body classes
		add_filter( 'body_class', array( $this, 'body_classes' ) );

		// Add theme meta generator
		add_action( 'wp_head', array( $this, 'theme_meta_generator' ), 9999 );

		// Load theme files
		add_action( 'after_setup_theme', array( $this, 'load_files' ) );

		// Theme setup
		add_action( 'after_setup_theme', array( $this, 'setup' ) );

		// Load theme CSS
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_css' ) );

		// Load responsive CSS
		add_action( 'wp_enqueue_scripts', array( $this, 'responsive_css' ), 999 );

		// Load theme js scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_js' ) );

		// Register sidebars
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );

		// Output JS for retina logo
		add_action( 'wp_head', array( $this, 'retina_logo' ) );

		// Add new post formats
		add_filter( 'tiny_mce_before_init', array( $this, 'formats' ) );

		// Move Comment textarea form field back to bottom
		if ( apply_filters( 'wpex_move_comment_form_fields', true ) ) {
			add_filter( 'comment_form_fields', array( $this, 'move_comment_form_fields' ) );
		}

		// Alter tag font size
		add_filter( 'widget_tag_cloud_args', array( $this, 'tag_font_size' ) );

		// Remove default gallery styles
		add_filter( 'use_default_gallery_style', '__return_false' );

	}

	/**
	 * Include functions and classes
	 *
     * @since  1.0.0
     * @access public
	 */
	public function load_files() {

		// Include Theme Functions
		require_once( $this->template_dir .'/inc/core-functions.php' );
		require_once( $this->template_dir .'/inc/conditionals.php' );
		require_once( $this->template_dir .'/inc/customizer-config.php' );
		require_once ( $this->template_dir .'/inc/accent-config.php' );
		require_once( $this->template_dir .'/inc/meta-pages.php' );
		require_once( $this->template_dir .'/inc/meta-posts.php' );
		if ( is_admin() ) {
			if ( ! defined( 'WPEX_DISABLE_THEME_ABOUT_PAGE' ) ) {
				require_once( $this->template_dir .'/inc/dashboard-feed.php' );
			}
			if ( ! defined( 'WPEX_DISABLE_THEME_DASHBOARD_FEEDS' ) ) {
				require_once( $this->template_dir .'/inc/welcome.php' );
			}
		}

		// Include Classes
		require_once ( $this->template_dir .'/inc/classes/customizer/customizer.php' );

		// WPML/Polilang config
		require_once ( $this->template_dir .'/inc/translators-config.php' );

	}

	/**
	 * Functions called during each page load, after the theme is initialized
	 * Perform basic setup, registration, and init actions for the theme
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 */
	public static function setup() {

		// Define content_width variable
		if ( ! isset( $content_width ) ) {
			$content_width = 745;
		}

		// Register navigation menus
		register_nav_menus ( array(
			'main' => esc_html__( 'Main', 'today' ),
		) );

		// Add editor styles
		add_editor_style( 'css/editor-style.css' );
		
		// Localization support
		load_theme_textdomain( 'today', get_template_directory() .'/languages' );
			
		// Add theme support
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-header' );

		// Add image sizes
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
	 * Load custom CSS scripts in the front end
	 *
     * @since  1.0.0
     * @access public
     *
     * @link   https://codex.wordpress.org/Function_Reference/wp_enqueue_style
	 */
	public function theme_css() {

		// Define css directory
		$css_dir_uri = $this->template_dir_uri .'/css/';

		// Font Awesome
		wp_enqueue_style( 'font-awesome', $css_dir_uri .'font-awesome.min.css' );

		// Montserrat font
		wp_enqueue_style( 'google-font-raleway', 'https://fonts.googleapis.com/css?family=Raleway:400,400italic,500,500italic,600,600italic,700,700italic&subset=latin,latin-ext' );

		// Main CSS
		wp_enqueue_style( 'style', get_stylesheet_uri() );

		// Remove Contact Form 7 Styles
		if ( function_exists( 'wpcf7_enqueue_styles') ) {
			wp_dequeue_style( 'contact-form-7' );
		}

	}

	/**
	 * Load responsive css
	 *
     * @since  1.0.0
     * @access public
     *
     * @link   https://codex.wordpress.org/Function_Reference/wp_enqueue_style
	 */
	public function responsive_css() {
		if ( get_theme_mod( 'responsive', true ) ) {
			wp_enqueue_style( 'wpex-responsive', $this->template_dir_uri .'/css/responsive.css' );
		}
	}

	/**
	 * Load custom JS scripts in the front end
	 *
     * @since  1.0.0
     * @access public
     *
	 * @link   https://codex.wordpress.org/Function_Reference/wp_enqueue_script
	 */
	public function theme_js() {

		// Define js directory
		$js_dir_uri = $this->template_dir_uri .'/js/';

		// Comment reply
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Localize scripts
		$localize  = apply_filters( 'wpex_localize', array(
			'isRTL'           => is_rtl(),
			'mobileMenuOpen'  => get_theme_mod( 'mobile_menu_open_text', esc_html__( 'Menu', 'today' ) ),
			'mobileMenuClose' => get_theme_mod( 'mobile_menu_close_text', esc_html__( 'Menu', 'today' ) ),
		) );

		wp_enqueue_script( 'fitvids', $js_dir_uri .'plugins/jquery.fitvids.js', array( 'jquery' ), '1.1', true );

		// Theme functions
		wp_enqueue_script( 'wpex-functions', $js_dir_uri .'functions.js', array( 'jquery' ), false, true );
		wp_localize_script( 'wpex-functions', 'wpexLocalize', $localize );

	}

	/**
	 * Registers the theme sidebars
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	public static function register_sidebars() {

		// Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar - Main', 'today' ),
			'id'            => 'sidebar',
			'before_widget' => '<div class="wpex-sidebar-widget %2$s wpex-clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		// Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar - Pages', 'today' ),
			'id'            => 'sidebar_pages',
			'before_widget' => '<div class="wpex-sidebar-widget %2$s wpex-clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		// Get footer columns
		$cols = get_theme_mod( 'footer_columns', '4' );

		// Footer 1
		if ( $cols >= 1 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 1', 'today' ),
				'id'            => 'footer-one',
				'before_widget' => '<div class="footer-widget %2$s wpex-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

		// Footer 2
		if ( $cols > 1 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 2', 'today' ),
				'id'            => 'footer-two',
				'before_widget' => '<div class="footer-widget %2$s wpex-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

		// Footer 3
		if ( $cols > 2 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 3', 'today' ),
				'id'            => 'footer-three',
				'before_widget' => '<div class="footer-widget %2$s wpex-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

		// Footer 4
		if ( $cols > 3 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 4', 'today' ),
				'id'            => 'footer-four',
				'before_widget' => '<div class="footer-widget %2$s wpex-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

	}
	
	/**
	 * Adds classes to the body_class function
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Function_Reference/body_class
	 */
	public static function body_classes( $classes ) {

		// Add post layout
		$classes[] = wpex_get_post_layout();

		// Return classes
		return $classes;

	}

	/**
	 * Return custom excerpt more string
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_more
	 */
	public static function excerpt_more( $more ) {
		return $more;
	}

	/**
	 * Alters the default oembed output
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   https://developer.wordpress.org/reference/hooks/embed_oembed_html/
	 */
	public static function embed_oembed_html( $html, $url, $attr, $post_id ) {
		return '<div class="wpex-responsive-embed">' . $html . '</div>';
	}

	/**
	 * Adds js for the retina logo
	 *
	 * @since 1.0.0
	 */
	public static function retina_logo() {
		$logo_url    = esc_url( get_theme_mod( 'logo_retina' ) );
		$logo_height = intval( get_theme_mod( 'logo_height' ) );
		if ( $logo_url && $logo_height ) {
			echo '<!-- Retina Logo --><script type="text/javascript">jQuery(function($){if (window.devicePixelRatio >= 2) {$("#wpex-site-logo img").attr("src", "'. esc_url( $logo_url ) .'");$("#wpex-site-logo img").css("height", "'. intval( $logo_height ) .'");}});</script>';
		}
	}

	/**
	 * Add new user fields
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Filter_Reference/user_contactmethods
	 */
	public static function user_fields( $contactmethods ) {

		// Add Twitter
		if ( ! isset( $contactmethods['wpex_twitter'] ) ) {
			$contactmethods['wpex_twitter'] = 'Today - Twitter';
		}

		// Add Facebook
		if ( ! isset( $contactmethods['wpex_facebook'] ) ) {
			$contactmethods['wpex_facebook'] = 'Today - Facebook';
		}

		// Add GoglePlus
		if ( ! isset( $contactmethods['wpex_googleplus'] ) ) {
			$contactmethods['wpex_googleplus'] = 'Today - Google+';
		}

		// Add LinkedIn
		if ( ! isset( $contactmethods['wpex_linkedin'] ) ) {
			$contactmethods['wpex_linkedin'] = 'Today - LinkedIn';
		}

		// Add Pinterest
		if ( ! isset( $contactmethods['wpex_pinterest'] ) ) {
			$contactmethods['wpex_pinterest'] = 'Today - Pinterest';
		}

		// Add Pinterest
		if ( ! isset( $contactmethods['wpex_instagram'] ) ) {
			$contactmethods['wpex_instagram'] = 'Today - Instagram';
		}

		// Return contactmethods
		return $contactmethods;

	}

	/**
	 * Adds meta generator for 
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function theme_meta_generator() {
		$theme = wp_get_theme();
		echo '<meta name="generator" content="Built With The Today WordPress Theme '. $theme->get( 'Version' ) .' by WPExplorer.com" />';
		echo "\r\n";
	}

	/**
	 * Add new formats
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   http://codex.wordpress.org/TinyMCE_Custom_Styles
	 */
	public static function formats( $settings ) {
		$new_formats = array(
			array(
				'title'     => esc_html__( 'Highlight', 'noir' ),
				'inline'    => 'span',
				'classes'   => 'wpex-text-highlight'
			),
			array(
				'title' => esc_html__( 'Buttons', 'noir' ),
				'items' => array(
					array(
						'title'     => esc_html__( 'Default', 'noir' ),
						'selector'  => 'a',
						'classes'   => 'wpex-theme-button'
					),
					array(
						'title'     => esc_html__( 'Red', 'noir' ),
						'selector'  => 'a',
						'classes'   => 'wpex-theme-button red'
					),
					array(
						'title'     => esc_html__( 'Green', 'noir' ),
						'selector'  => 'a',
						'classes'   => 'wpex-theme-button green'
					),
					array(
						'title'     => esc_html__( 'Blue', 'noir' ),
						'selector'  => 'a',
						'classes'   => 'wpex-theme-button blue'
					),
					array(
						'title'     => esc_html__( 'Orange', 'noir' ),
						'selector'  => 'a',
						'classes'   => 'wpex-theme-button orange'
					),
					array(
						'title'     => esc_html__( 'Black', 'noir' ),
						'selector'  => 'a',
						'classes'   => 'wpex-theme-button black'
					),
					array(
						'title'     => esc_html__( 'White', 'noir' ),
						'selector'  => 'a',
						'classes'   => 'wpex-theme-button white'
					),
					array(
						'title'     => esc_html__( 'Clean', 'noir' ),
						'selector'  => 'a',
						'classes'   => 'wpex-theme-button clean'
					),
				),
			),
			array(
				'title' => esc_html__( 'Notices', 'noir' ),
				'items' => array(
					array(
						'title'     => esc_html__( 'Default', 'noir' ),
						'block'     => 'div',
						'classes'   => 'wpex-notice'
					),
					array(
						'title'     => esc_html__( 'Info', 'noir' ),
						'block'     => 'div',
						'classes'   => 'wpex-notice wpex-info'
					),
					array(
						'title'     => esc_html__( 'Warning', 'noir' ),
						'block'     => 'div',
						'classes'   => 'wpex-notice wpex-warning'
					),
					array(
						'title'     => esc_html__( 'Success', 'noir' ),
						'block'     => 'div',
						'classes'   => 'wpex-notice wpex-success'
					),
				),
			),
		);
		$settings['style_formats'] = json_encode( $new_formats );
		return $settings;
	}

	/**
	 * Move Comment form field back to bottom which was altered in WP 4.4
	 *
	 * @since 1.1.0
	 */
	public static function move_comment_form_fields( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}


	/**
	 * Alter the default tag font sizes
	 *
	 * @since 1.0.0
	 */
	public static function tag_font_size( $args ) {
		$args['smallest'] = '0.857';
		$args['largest']  = '0.857';
		$args['unit']     = 'em';
		return $args;
	}

}
$wpex_today_theme_setup = new WPEX_Today_Theme_Setup;