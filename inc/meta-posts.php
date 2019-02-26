<?php
/**
 * Add metabox to posts
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
function wpex_post_meta_init() {
	new WPEX_Post_Meta_Settings();
}

/**
 * Calls the class on the post edit screen.
 *
 * @since  1.0.0
 */
add_action( 'load-post.php', 'wpex_post_meta_init' );
add_action( 'load-post-new.php', 'wpex_post_meta_init' );

/** 
 * The Class.
 */
class WPEX_Post_Meta_Settings {

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
		if ( 'post' == $post_type ) {
			add_meta_box(
				'wpex_post_settings_metabox',
				esc_html__( 'Post Settings', 'today' ),
				array( $this, 'render_meta_box_content' ),
				'post',
				'advanced',
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

			/**** POST Video ****/
			$value = htmlspecialchars_decode( stripslashes( get_post_meta( $post->ID, 'wpex_post_video', true ) ) );
			echo '<tr>';
				echo '<th><p><label for="wpex_post_layout">'. esc_html__( 'Video', 'today' ) .'</label></p></th>';
				echo '<td><pre><textarea cols="30" rows="3" type="text" id="wpex_post_video" name="wpex_post_video"">'. $value .'</textarea></pre>';
				echo '<small>'. esc_html__( 'Enter your embed code or enter in a URL that is compatible with WordPress\'s built-in oEmbed function or self-hosted video function.', 'today' ) .'</small>';
				echo '</td>';
			echo '</tr>';

			/**** POST Audio ****/
			$value = htmlspecialchars_decode( stripslashes( get_post_meta( $post->ID, 'wpex_post_audio', true ) ) );
			echo '<tr>';
				echo '<th><p><label for="wpex_post_layout">'. esc_html__( 'Audio', 'today' ) .'</label></p></th>';
				echo '<td><pre><textarea cols="30" rows="3" type="text" id="wpex_post_audio" name="wpex_post_audio"">'. $value .'</textarea></pre>';
				echo '<small>'. esc_html__( 'Enter your embed code or enter in a URL that is compatible with WordPress\'s built-in oEmbed function or self-hosted video function.', 'today' ) .'</small>';
				echo '</td>';
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

			// Save Post Video
			$val = isset( $_POST['wpex_post_video'] ) ? htmlspecialchars_decode( stripslashes( $_POST['wpex_post_video'] ) ) : '';
			update_post_meta( $post_id, 'wpex_post_video', $val );

			// Save Post Audio
			$val = isset( $_POST['wpex_post_audio'] ) ? htmlspecialchars_decode( stripslashes( $_POST['wpex_post_audio'] ) ) : '';
			update_post_meta( $post_id, 'wpex_post_audio', $val );

	}

	/**
	 * Adds metabox CSS
	 */
	public function load_css( $hook ) {
		if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
			wp_enqueue_style( 'wpex-metaboxes', get_template_directory_uri() .'/css/wpex-metaboxes.css' );
		}
	}

}