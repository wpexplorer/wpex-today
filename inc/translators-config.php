<?php
/**
 * Configures Translators (WPMl, Polylang, etc)
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

/**
 * Strings to translate
 *
 * @since 2.1.0
 */
function wpex_register_theme_mod_strings() {
	return apply_filters( 'wpex_register_theme_mod_strings', array(
		'logo'                    => false,
		'logo_retina'             => false,
		'logo_retina_height'      => false,
		'entry_readmore_text'     => null,
		'post_related_heading'    => null,
		'ad_homepage_top'         => null,
		'ad_homepage_bottom'      => null,
		'ad_archives_top'         => null,
		'ad_archives_bottom'      => null,
		'ad_single_top'           => null,
		'ad_single_bottom'        => null,
		'ad_homepage_top'         => null,
	) );
}

/**
 * Registers strings
 *
 * @since 1.0.0
 */
function wpex_wpml_register_strings( $key, $default = null ) {

	// Get strings
	$strings = wpex_register_theme_mod_strings();

	// Register strings for WPMl
	if ( function_exists( 'icl_register_string' ) ) {
		foreach( $strings as $string => $default ) {
			icl_register_string( 'Theme Mod', $string, get_theme_mod( $string, $default ) );
		}
	}

	// Register strings for Polylang
	if ( function_exists( 'pll_register_string' ) ) {
		foreach( $strings as $string => $default ) {
			pll_register_string( $string, get_theme_mod( $string, $default ), 'Theme Mod', true );
		}
	}

}
add_action( 'admin_init', 'wpex_wpml_register_strings' );