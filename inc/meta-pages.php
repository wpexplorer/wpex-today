<?php
/**
 * Add metabox to pages
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Only needed for the admin side
if ( ! is_admin() ) {
	return;
}

/**
 * Helper function stars up meta class
 *
 * @since  1.0.0
 */
function wpex_page_meta_init() {
	new WPEX_Page_Meta_Settings();
}

/**
 * Calls the class on the post edit screen.
 *
 * @since  1.0.0
 */
add_action( 'load-post.php', 'wpex_page_meta_init' );
add_action( 'load-post-new.php', 'wpex_page_meta_init' );

/** 
 * The Class.
 */
class WPEX_Page_Meta_Settings {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_css' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
		if ( 'page' == $post_type ) {
			add_meta_box(
				'wpex_page_settings_metabox',
				esc_html__( 'Page Settings', 'today' ),
				array( $this, 'render_meta_box_content' ),
				'page',
				'side',
				'high'
			);
		}
	}

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'wpe_page_meta_settings_action', 'wpe_page_meta_settings_nonce' );

		// Open metabox
		echo '<table class="form-table wpex-metabox-table"><tbody>';

			// Use get_post_meta to retrieve an existing value from the database.
			$value = esc_attr( get_post_meta( $post->ID, 'wpex_post_layout', true ) );

			// Layout options
			$post_layouts = array(
				''               => esc_html__( 'Default', 'today' ),
				'right-sidebar'  => esc_html__( 'Right Sidebar', 'today' ),
				'left-sidebar'   => esc_html__( 'Left Sidebar', 'today' ),
				'full-width'     => esc_html__( 'No Sidebar', 'today' ),
			);

			// Display the form, using the current value.
			echo '<tr>';
				echo '<th><p><label for="wpex_post_layout">'. esc_html__( 'Layout', 'today' ) .'</label></p></th>';
				echo '<td><select type="text" id="wpex_post_layout" name="wpex_post_layout">';
					foreach( $post_layouts as $key => $val ) {
						echo '<option value="'. esc_attr( $key ) .'" '. selected( $value, $key ) .'>'. esc_attr( $val ) .'</option>';
					}
				echo '</select></td>';
			echo '</tr>';

		// Close metabox
		echo '</tbody></table>';

	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['wpe_page_meta_settings_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['wpe_page_meta_settings_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'wpe_page_meta_settings_action' ) ) {
			return $post_id;
		}

		// If this is an autosave, our form has not been submitted,
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}

		}

		/* OK, its safe for us to save the data now. */

			// Save Post Layout
			$val = isset( $_POST['wpex_post_layout'] ) ? floatval( $_POST['wpex_post_layout'] ) : '';
			update_post_meta( $post_id, 'wpex_post_layout', $val );

	}

	/**
	 * Adds metabox CSS
	 */
	public function load_css( $hook ) {
		if ( $hook == 'post.php' || $hook == 'post-new.php' || $hook == 'page-new.php' || $hook == 'page.php' ) {
			wp_enqueue_style( 'wpex-metaboxes', get_template_directory_uri() .'/css/wpex-metaboxes.css' );
		}
	}

}