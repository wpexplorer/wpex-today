<?php
/**
 * Main Customizer functions
 *
 * This is a SUPER trimmed down version of our Customizer class used in
 * popular premium themes such as Total, Noir, Chic...etc.
 *
 * @package     WordPress Customizer Class
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @version     1.0.0
 */

// Start Class
if ( ! class_exists( 'WPEX_Customizer' ) ) {
	class WPEX_Customizer {

		/**
		 * Start things up
		 *
		 * @version 1.0.0
		 */
		public function __construct() {

			// Create array of options
			add_action( 'init', array( $this, 'init' ) );

			// Register and unregister Customizer settings
			add_action( 'customize_register', array( $this, 'customize_register' ) );

			// Customizer directory paths
			$this->class_path         = '/inc/classes/customizer/';
			$this->class_path         = apply_filters( 'wpex_customizer_class_path',  $this->class_path );
			$this->customizer_dir     = get_template_directory() . $this->class_path;
			$this->customizer_dir_uri = get_template_directory_uri() . $this->class_path;

		}

		/**
		 * Register panels on init
		 *
		 * @version 1.0.0
		 */
		public function init() {
			$this->panels = array();
			$this->panels = apply_filters( 'wpex_customizer_panels', $this->panels );
		}


		/**
		 * Runs when customizer is saved
		 *
		 * @link    https://developer.wordpress.org/reference/hooks/customize_save_after/
		 * @version 1.0.0
		 */
		public function save_after() {
			// Nothing yet...
		}

		/**
		 * Registers new controls
		 * Adds new customizer panels, sections, settings & controls
		 *
		 * @link    http://codex.wordpress.org/Theme_Customization_API
		 * @since   1.0.0
		 */
		public function customize_register( $wp_customize ) {

			// Register only during customize preview
			if ( ! is_customize_preview() ) {
				return;
			}

			// Return if $this->panels var is empty
			if ( empty( $this->panels ) ) {
				return;
			}

			// Register panels
			$panel_priority = 140; // add panels at the bottom

			// Loop through and add panels
			foreach( $this->panels as $panel_id => $panel ) {

				// Add prefix to panel id
				$panel_id = 'wpex_'. $panel_id;

				// Register panel
				$panel_priority++;
				$wp_customize->add_panel( $panel_id, array(
					'priority'      => $panel_priority,
					'capability'    => 'edit_theme_options',
					'title'         => $panel['title'],
				) );

				// Loop through panel sections and add sections
				$section_priority = 0;
				foreach( $panel['sections'] as $section ) {
					$section_priority++;
					$description = isset( $section['desc'] ) ? $section['desc'] : NULL;
					$wp_customize->add_section( $section['id'], array(
						'title'         => $section['title'],
						'panel'         => $panel_id,
						'priority'      => $section_priority,
						'description'   => $description,
					) );

					// Loop through section settings and add settings
					$control_priority   = 0;
					foreach ( $section['settings'] as $setting ) {

						$control_priority++;

						$id                 = isset( $setting['id'] ) ? $setting['id'] : '';
						$transport          = isset( $setting['transport'] ) ? $setting['transport'] : 'refresh';
						$default            = isset( $setting['default'] ) ? $setting['default'] : '';
						$sanitize_callback  = isset( $setting['sanitize_callback'] ) ? $setting['sanitize_callback'] : false;
						$label              = isset( $setting['control']['label'] ) ? $setting['control']['label'] : '';
						$control_desc       = isset( $setting['control']['desc'] ) ? $setting['control']['desc'] : '';
						$type               = isset( $setting['control']['type'] ) ? $setting['control']['type'] : 'text';
						$choices            = isset( $setting['control']['choices'] ) ? $setting['control']['choices'] : array();
						$active_callback    = isset( $setting['control']['active_callback'] ) ? $setting['control']['active_callback'] : null;

						// If no ID continue
						if ( ! $id ) {
							continue;
						}

						// Control object
						if ( isset( $setting['control']['object'] ) ) {
							$control_object = $setting['control']['object'];
						} elseif ( 'color' == $type ) {
							$control_object = 'WP_Customize_Color_Control';
						} elseif ( 'upload' == $type ) {
							$control_object = 'WP_Customize_Image_Control';
						} elseif ( 'sorter' == $type ) {
							$control_object = 'WPEX_Customize_Control_Sorter';
						} elseif ( 'google_font' == $type ) {
							$control_object = 'WPEX_Fonts_Dropdown_Control';
						} elseif ( 'ui-slider' == $type ) {
							$control_object = 'WPEX_Customize_Sliderui_Control';
						} else {
							$control_object = false;
						}

						// Add setting and control
						$wp_customize->add_setting( $id, array(
							'type'              => 'theme_mod',
							'transport'         => $transport,
							'default'           => $default,
							'sanitize_callback' => $sanitize_callback,
						) );

						if ( $control_object ) {
							$wp_customize->add_control( new $control_object ( $wp_customize, $id, array(
								'label'           => $label,
								'section'         => $section['id'],
								'settings'        => $id,
								'priority'        => $control_priority,
								'description'     => $control_desc,
								'type'            => $type,
								'choices'         => $choices,
								'active_callback' => $active_callback,
							) ) );
						} else {
							$wp_customize->add_control( $id, array(
								'label'           => $label,
								'section'         => $section['id'],
								'settings'        => $id,
								'priority'        => $control_priority,
								'description'     => $control_desc,
								'type'            => $type,
								'choices'         => $choices,
								'active_callback' => $active_callback,
							) );
						}

					 } // End foreach $section['settings']

				} // End foreach $panel['sections']

			} // END foreach $this->panels

		}

	}
}
$wpex_customizer = new WPEX_Customizer;