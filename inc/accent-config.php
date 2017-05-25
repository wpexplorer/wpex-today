<?php
/**
 * Defines all settings for the customizer class
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Set global var
global $wpex_accent_config;

// Start Class
if ( ! class_exists( 'WPEX_Accent_Config' ) ) {
	
	class WPEX_Accent_Config {

		/**
		 * Main constructor
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			add_filter( 'wpex_default_accent', array( $this, 'default_accent' ) );
			add_filter( 'wpex_accent_texts', array( $this, 'texts' ) );
			add_filter( 'wpex_accent_backgrounds', array( $this, 'backgrounds' ) );
			add_filter( 'wpex_accent_borders', array( $this, 'borders' ) );
		}

		/**
		 * Define default accent
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function default_accent() {
			return '#f27684';
		}

		/**
		 * Create array of texts with accent color
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function texts( $array ) {
			return array_merge( $array, array(

				// Logo
				'.site-text-logo a',
			

			) );
		}

		/**
		 * Create array of backgrounds with accent color
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function backgrounds( $array ) {
			return array_merge( $array, array(

				// Site Nav
				'.wpex-site-nav .wpex-dropdown-menu > li.current-menu-item > a',
				'.wpex-site-nav .wpex-dropdown-menu > li.parent-menu-item > a',
				'.wpex-site-nav .wpex-dropdown-menu > li.current-menu-ancestor > a',

				// Header
				'.wpex-page-thumbnail-title h1 span',

				// Buttons
				'button',
				'.wpex-theme-button',
				'.theme-button',
				'input[type="button"]',
				'input[type="submit"]',
				'a.wpex-site-scroll-top:hover',

				// Sidebar
				'.wpex-sidebar-widget .widget-title',

				// Cat tag
				'.wpex-entry-cat a',
				'.wpex-post-cat a',

				// Pagination
				'.wpex-page-links span',
				'.wpex-page-links a:hover',
				'.wpex-page-links a:hover span',
				'.wpex-page-links span:hover',
				'.page-numbers a:hover',
				'.page-numbers span.current',
				'.page-links span, .page-links a span:hover',
				
				// Comments
				'a#cancel-comment-reply-link:hover',
				'.comment-footer a:hover',
				'#comments a#cancel-comment-reply-link:hover',
				'#comments .comment-footer a:hover',

			) );
		}

		/**
		 * Create array of borders with accent color
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function borders( $array ) {
			return array_merge( $array, array(
				'.site-text-logo a',
				'a.wpex-site-scroll-top:hover',
				'.wpex-sidebar-widget .widget-title:after'  => array( 'top' ),
				'.wpex-loop-entry-social-share-list:before' => array( 'top' ),
			) );
		}

	}

}
$wpex_accent_config = new WPEX_Accent_Config();