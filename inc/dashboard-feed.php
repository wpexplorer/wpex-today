<?php
/**
 * Dashboard feeds
 */

// Register all dashboard metaboxes
function rc_mdm_register_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget( 'widget_wpexplorer_feed', esc_html__( 'WPExplorer Blog', 'wpex-zero' ), 'wpex_dashboard_rss_box' );
	wp_add_dashboard_widget( 'widget_wdexplorer_feed', esc_html__( 'Web Design Blog', 'wpex-zero' ), 'wde_dashboard_rss_box' );
}
add_action('wp_dashboard_setup', 'rc_mdm_register_widgets');

// Creates the RSS metabox for WPExplorer feed
function wpex_dashboard_rss_box() {
	echo wp_widget_rss_output( 'http://www.wpexplorer.com/feed/', array(
		'items'        => 4,
		'show_summary' => true,
	) );
	echo '<div style="margin-top:20px;padding-top:10px;border-top:1px solid #eee;">Feed from <a href="http://www.wpexplorer.com/" target="_blank">wpexplorer.com</a></div>';
}

// Creates the RSS metabox for WPExplorer feed
function wde_dashboard_rss_box() {
	echo wp_widget_rss_output( 'https://www.wdexplorer.com/feed/', array(
		'items'        => 4,
		'show_summary' => true,
	) );
	echo '<div style="margin-top:20px;padding-top:10px;border-top:1px solid #eee;">Feed from <a href="https://www.wdexplorer.com/" target="_blank">wdexplorer.com</a></div>';
}