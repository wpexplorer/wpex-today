<?php
/**
 * Dashboard feeds
 */

defined( 'ABSPATH' ) || exit;

// Register all dashboard metaboxes.
function wpex_mdm_register_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget( 'widget_wpexplorer_feed', esc_html__( 'WordPress Articles', 'wpex-today' ), 'wpex_dashboard_rss_box' );
}
add_action( 'wp_dashboard_setup', 'wpex_mdm_register_widgets' );

// Creates the RSS metabox for WPExplorer feed.
function wpex_dashboard_rss_box() {
	echo wp_widget_rss_output( 'https://www.wpexplorer.com/feed/', array(
		'items'        => 4,
		'show_summary' => true,
	) );
	echo '<div style="margin-top:20px;padding-top:10px;border-top:1px solid #eee;">Feed from <a href="https://www.wpexplorer.com/" target="_blank">wpexplorer.com</a></div>';
}