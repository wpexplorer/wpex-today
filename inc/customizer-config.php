<?php
/**
 * Defines all settings for the customizer class
 *
 * @package Today WordPress Theme
 * @author Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link http://www.wpexplorer.com
 * @since 1.0.0
 */

if ( ! function_exists( 'wpex_customizer_config' ) ) {

	function wpex_customizer_config( $panels ) {

		/*-----------------------------------------------------------------------------------*/
		/* - Useful vars
		/*-----------------------------------------------------------------------------------*/

		// Columns
		$columns = array(
			'' => esc_html__( 'Default', 'today' ),
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
		);

		// Layouts
		$layouts = array(
			''              => esc_html__( 'Default', 'today' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'today' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'today' ),
			'full-width'    => esc_html__( 'No Sidebar', 'today' ),
		);

		/*-----------------------------------------------------------------------------------*/
		/* - General Panel
		/*-----------------------------------------------------------------------------------*/
		$panels['general'] = array(
			'title' => esc_html__( 'General Theme Settings', 'today' ),
			'sections' => array()
		);

		// Layouts
		$panels['general']['sections']['layouts'] = array(
			'id' => 'wpex_layouts',
			'title' => esc_html__( 'Layouts', 'today' ),
			'settings' => array(
				array(
					'id' => 'home_layout',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Homepage Layout', 'today' ),
						'type' => 'select',
						'choices' => $layouts,
					),
				),
				array(
					'id' => 'archives_layout',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Archives Layout', 'today' ),
						'type' => 'select',
						'choices' => $layouts,
						'desc' => esc_html__( 'Categories, tags, author...etc', 'today' ),
					),
				),
				array(
					'id' => 'search_layout',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Search Layout', 'today' ),
						'type' => 'select',
						'choices' => $layouts,
					),
				),
				array(
					'id' => 'post_layout',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Layout', 'today' ),
						'type' => 'select',
						'choices' => $layouts,
					),
				),
				array(
					'id' => 'page_layout',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Page Layout', 'today' ),
						'type' => 'select',
						'choices' => $layouts,
					),
				),
			),
		);

		// Responsive
		$panels['general']['sections']['responsive'] = array(
			'id' => 'wpex_responsive',
			'title' => esc_html__( 'Responsiveness', 'today' ),
			'settings' => array(
				array(
					'id' => 'responsive',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Enable', 'today' ),
						'type' => 'checkbox',
					),
				),
			),
		);

		// Header Section
		$panels['general']['sections']['general'] = array(
			'id' => 'wpex_general',
			'title' => esc_html__( 'Header', 'today' ),
			'settings' => array(
				array(
					'id' => 'site_description',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Display description?', 'today' ),
						'type' => 'checkbox'
					),
				),
				array(
					'id' => 'logo',
					'sanitize_callback' => 'esc_url',
					'control' => array(
						'label' => esc_html__( 'Custom Logo', 'today' ),
						'type' => 'upload',
					),
				),
				array(
					'id' => 'logo_retina',
					'sanitize_callback' => 'esc_url',
					'control' => array(
						'label' => esc_html__( 'Custom Retina Logo', 'today' ),
						'type' => 'upload',
					),
				),
				array(
					'id' => 'logo_retina_height',
					'sanitize_callback' => 'intval',
					'control' => array(
						'label' => esc_html__( 'Standard Logo Height', 'today' ),
						'desc' => esc_html__( 'Enter the standard height for your logo. Used to set your retina logo to the correct dimensions', 'today' ),
					),
				),
			),
		);

		// Topbar Social
		$social_options = wpex_header_social_options_array();
		
		if ( $social_options ) {

			$panels['general']['sections']['socialbar'] = array(
				'id' => 'wpex_social_header',
				'title' => esc_html__( 'Social', 'today' ),
				'desc' => esc_html__( 'Enter the full URL to your social media profile.', 'today' ),
				'settings' => array(
					array(
						'id' => 'header_social',
						'default' => true,
						'sanitize_callback' => 'esc_html',
						'control' => array(
							'label' => esc_html__( 'Enable Social', 'today' ),
							'type' => 'checkbox',
						),
					),
				),
			);

			$panels['general']['sections']['socialbar']['settings']['socialbar_target_blank'] = array(
				'id' => 'socialbar_target_blank',
				'transport' => 'postMessage',
				'control' => array(
					'label' => esc_html__( 'Open Social Links In New Tab?', 'today' ),
					'type' => 'checkbox',
					'active_callback' => 'wpex_active_callback_topbar_social',
				),
			);

			foreach ( $social_options as $key => $val ) {

				$panels['general']['sections']['socialbar']['settings']['socialbar_'. $key] = array(
					'id' => 'socialbar_'. $key,
					'sanitize_callback' => 'esc_url',
					'control' => array(
						'label' => $val['label'] .' - '. esc_html__( 'URL', 'today' ),
						'active_callback' => 'wpex_active_callback_topbar_social'
					),
				);


			}

		}

		// Entries
		$panels['general']['sections']['entries'] = array(
			'id' => 'wpex_entries',
			'title' => esc_html__( 'Entries', 'today' ),
			'settings' => array(
				array(
					'id' => 'archive_featured_post',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Display First Post Large?', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'pagination_style',
					'default' => 'numbered',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Pagination Style', 'today' ),
						'type' => 'select',
						'choices' => array(
							'numbered' => esc_html__( 'Numbered', 'today' ),
							'next_prev' => esc_html__( 'Next/Prev Links', 'today' ),
						),
					),
				),
				array(
					'id' => 'entry_columns',
					'default' => '2',
					'sanitize_callback' => 'absint',
					'control' => array(
						'label' => esc_html__( 'Grid Columns', 'today' ),
						'type' => 'select',
						'choices' => array(
							1 => 1,
							2 => 2,
							3 => 3,
							4 => 4,
						),
					),
				),
				array(
					'id' => 'entry_content_display',
					'default' => 'excerpt',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Entry Displays?', 'today' ),
						'type' => 'select',
						'choices' => array(
							'excerpt' => esc_html__( 'Custom Excerpt', 'today' ),
							'content' => esc_html__( 'Full Content', 'today' ),
						),
					),
				),
				array(
					'id' => 'entry_excerpt_length',
					'default' => 30,
					'sanitize_callback' => 'absint',
					'control' => array(
						'label' => esc_html__( 'Entry Excerpt Length', 'today' ),
						'type' => 'number',
						'desc' => esc_html__( 'How many words to display per excerpt', 'today' ),
						'active_callback' => 'wpex_has_custom_excerpt'
					),
				),
				array(
					'id' => 'entry_thumbnail',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Entry Thumbnail', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'entry_category',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Entry Category Tag', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'entry_category_first_only',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Display First Category Only', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'entry_meta',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Entry Meta', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'entry_meta_date',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Entry Meta Date', 'today' ),
						'type' => 'checkbox',
						'active_callback' => 'wpex_customizer_entry_has_meta'
					),
				),
				array(
					'id' => 'entry_meta_author',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Entry Meta Author', 'today' ),
						'type' => 'checkbox',
							'active_callback' => 'wpex_customizer_entry_has_meta'
					),
				),
				array(
					'id' => 'entry_meta_comments',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Entry Meta Comments', 'today' ),
						'type' => 'checkbox',
							'active_callback' => 'wpex_customizer_entry_has_meta'
					),
				),
				array(
					'id' => 'entry_readmore',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Entry Readmore', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'entry_readmore_text',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Entry Readmore Text', 'today' ),
						'type' => 'text',
					),
				),
			),
		);

		// Posts
		$panels['general']['sections']['posts'] = array(
			'id' => 'wpex_posts',
			'title' => esc_html__( 'Posts', 'today' ),
			'settings' => array(
				array(
					'id' => 'post_thumbnail',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Thumbnail', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_category',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Category Tag', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_category_first_only',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Display First Category Only', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_meta',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Meta', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_meta_date',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Meta Date', 'today' ),
						'type' => 'checkbox',
						'active_callback' => 'wpex_customizer_post_has_meta'
					),
				),
				array(
					'id' => 'post_meta_author',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Meta Author', 'today' ),
						'type' => 'checkbox',
						'active_callback' => 'wpex_customizer_post_has_meta'
					),
				),
				array(
					'id' => 'post_meta_comments',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Meta Comments', 'today' ),
						'type' => 'checkbox',
							'active_callback' => 'wpex_customizer_entry_has_meta'
					),
				),
				array(
					'id' => 'post_tags',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Tags', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_share',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Social Share', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_author_info',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Author Box', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_next_prev',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Next/Previous', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_next_prev_in_same_term',
					'default' => false,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Next/Previous From Same Category', 'today' ),
						'type' => 'checkbox',
						'active_callback' => 'wpex_customizer_post_navigation_in_same_term',
					),
				),
				array(
					'id' => 'post_related',
					'default' => true,
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Related', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_related_displays',
					'default' => 'related_category',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Related: Displays?', 'today' ),
						'type' => 'select',
						'choices' => array(
							'related_category' => esc_html__( 'Recent From Same Category', 'today' ),
							'random' => esc_html__( 'Random Posts', 'today' ),
						),
						'active_callback' => 'wpex_customizer_has_related_posts',
					),
				),
				array(
					'id' => 'post_related_heading',
					'sanitize_callback' => 'esc_html',
					'control' => array(
						'label' => esc_html__( 'Post Related: Heading', 'today' ),
						'type' => 'text',
						'active_callback' => 'wpex_customizer_has_related_posts',
					),
				),
				array(
					'id' => 'post_related_columns',
					'sanitize_callback' => 'absint',
					'default' => '3',
					'control' => array(
						'label' => esc_html__( 'Post Related: Columns', 'today' ),
						'type' => 'select',
						'choices' => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
						),
						'active_callback' => 'wpex_customizer_has_related_posts',
					),
				),
				array(
					'id' => 'post_related_count',
					'default' => 6,
					'sanitize_callback' => 'absint',
					'control' => array(
						'label' => esc_html__( 'Post Related: Count', 'today' ),
						'type' => 'number',
						'active_callback' => 'wpex_customizer_has_related_posts',
					),
				),
			),
		);

		// Footer
		$panels['general']['sections']['footer'] = array(
			'id' => 'wpex_footer',
			'title' => esc_html__( 'Footer', 'today' ),
			'settings' => array(
				array(
					'id' => 'footer_widget_columns',
					'default' => 4,
					'sanitize_callback' => 'absint',
					'control' => array(
						'label' => esc_html__( 'Footer Widgets Columns', 'today' ),
						'type' => 'select',
						'choices' => array(
							'disable' => esc_html__( 'None - Disable', 'today' ),
							1 => 1,
							2 => 2,
							3 => 3,
							4 => 4,
						)
					),
				),
			),
		);

		// Advertisement
		$default_ad = '<a href="http://themeforest.net/item/noir-responsive-wordpress-blog-shop-theme/13434670?ref=WPExplorer"><img src="'. get_template_directory_uri() .'/images/banner.jpg" /></a>';
		$panels['general']['sections']['ads'] = array(
			'id' => 'wpex_ads',
			'title' => esc_html__( 'Advertisements', 'today' ),
			'settings' => array(
				array(
					'id' => 'ad_header',
					'sanitize_callback' => '',
					'default' => $default_ad,
					'control' => array(
						'label' => esc_html__( 'Header', 'today' ),
						'type' => 'textarea',
					),
				),
				array(
					'id' => 'ad_footer',
					'sanitize_callback' => '',
					'default' => $default_ad,
					'control' => array(
						'label' => esc_html__( 'Footer', 'today' ),
						'type' => 'textarea',
					),
				),
			),
		);

		// Discussion
		$panels['general']['sections']['discussion'] = array(
			'id' => 'wpex_site_discussion',
			'title' => esc_html__( 'Discussion', 'today' ),
			'settings' => array(
				array(
					'id' => 'comments_on_pages',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Comments For Pages', 'today' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'comments_on_posts',
					'sanitize_callback' => 'esc_html',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Comments For Posts', 'today' ),
						'type' => 'checkbox',
					),
				),
			)
		);

		/*-----------------------------------------------------------------------------------*/
		/* - Image Sizes
		/*-----------------------------------------------------------------------------------*/
		$panels['image_sizes'] = array(
			'title' => esc_html__( 'Image Sizes', 'today' ),
			'sections' => array(

				// Grid Entries
				array(
					'id' => 'wpex_entry_thumbnail_sizes',
					'title' => esc_html__( 'Entries', 'today' ),
					'desc' => esc_html__( 'If you alter any image sizes you will have to regenerate your thumbnails.', 'today' ),
					'settings' => array(
						array(
							'id' => 'entry_thumbnail_width',
							'default' => 9999,
							'sanitize_callback' => 'absint',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Image Width', 'today' ),
								'type' => 'text',
							),
						),
						array(
							'id' => 'entry_thumbnail_height',
							'default' => 9999,
							'sanitize_callback' => 'absint',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Image Height', 'today' ),
								'type' => 'text',
							),
						),
						array(
							'id' => 'entry_thumbnail_crop',
							'default' => 'center-center',
							'sanitize_callback' => 'esc_html',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Crop', 'today' ),
								'type' => 'select',
								'choices' => wpex_image_crop_locations(),
							),
						),
					),
				),

				// Featured Entry
				array(
					'id' => 'wpex_featured_entry_thumbnail_sizes',
					'title' => esc_html__( 'Featured Entry', 'today' ),
					'desc' => esc_html__( 'If you alter any image sizes you will have to regenerate your thumbnails.', 'today' ),
					'settings' => array(
						array(
							'id' => 'entry_featured_thumbnail_width',
							'default' => 9999,
							'transport' => 'postMessage',
							'sanitize_callback' => 'absint',
							'control' => array(
								'label' => esc_html__( 'Image Width', 'today' ),
								'type' => 'text',
							),
						),
						array(
							'id' => 'entry_featured_thumbnail_height',
							'default' => 9999,
							'transport' => 'postMessage',
							'sanitize_callback' => 'absint',
							'control' => array(
								'label' => esc_html__( 'Image Height', 'today' ),
								'type' => 'text',
							),
						),
						array(
							'id' => 'entry_featured_thumbnail_crop',
							'default' => 'center-center',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Crop', 'today' ),
								'type' => 'select',
								'choices' => wpex_image_crop_locations(),
							),
						),
					),
				),

				// Posts
				array(
					'id' => 'wpex_post_thumbnail_sizes',
					'title' => esc_html__( 'Posts', 'today' ),
					'desc' => esc_html__( 'If you alter any image sizes you will have to regenerate your thumbnails.', 'today' ),
					'settings' => array(
						array(
							'id' => 'post_thumbnail_width',
							'default' => 9999,
							'sanitize_callback' => 'absint',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Image Width', 'today' ),
								'type' => 'text',
							),
						),
						array(
							'id' => 'post_thumbnail_height',
							'default' => 9999,
							'sanitize_callback' => 'absint',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Image Height', 'today' ),
								'type' => 'text',
							),
						),
						array(
							'id' => 'post_thumbnail_crop',
							'default' => 'center-center',
							'sanitize_callback' => 'esc_html',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Crop', 'today' ),
								'type' => 'select',
								'choices' => wpex_image_crop_locations(),
							),
						),
					),
				),

				// Related Posts
				array(
					'id' => 'wpex_posts_related_thumbnail_sizes',
					'title' => esc_html__( 'Related Posts', 'today' ),
					'desc' => esc_html__( 'If you alter any image sizes you will have to regenerate your thumbnails.', 'today' ),
					'settings' => array(
						array(
							'id' => 'post_related_thumbnail_width',
							'default' => 9999,
							'sanitize_callback' => 'absint',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Image Width', 'today' ),
								'type' => 'text',
							),
						),
						array(
							'id' => 'post_related_thumbnail_height',
							'default' => 9999,
							'sanitize_callback' => 'absint',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Image Height', 'today' ),
								'type' => 'text',
							),
						),
						array(
							'id' => 'post_related_thumbnail_crop',
							'default' => 'center-center',
							'sanitize_callback' => 'esc_html',
							'transport' => 'postMessage',
							'control' => array(
								'label' => esc_html__( 'Crop', 'today' ),
								'type' => 'select',
								'choices' => wpex_image_crop_locations(),
							),
						),
					),
				),
			),
		);

		// Return panels array
		return $panels;

	}
}
add_filter( 'wpex_customizer_panels', 'wpex_customizer_config' );

function wpex_active_callback_responsive() {
	if ( get_theme_mod( 'responsive' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_active_callback_topbar_social() {
	if ( get_theme_mod( 'topbar_social_enable', true ) ) {
		return true;
	} else {
		return false;
	}
}
function wpex_customizer_has_related_posts() {
	if ( get_theme_mod( 'post_related', true ) ) {
		return true;
	} else {
		return false;
	}
}
function wpex_customizer_post_navigation_in_same_term() {
	if ( get_theme_mod( 'post_next_prev', true ) ) {
		return true;
	} else {
		return false;
	}
}
function wpex_customizer_entry_has_meta() {
	if ( get_theme_mod( 'entry_meta', true ) ) {
		return true;
	} else {
		return false;
	}
}
function wpex_customizer_post_has_meta() {
	if ( get_theme_mod( 'post_meta', true ) ) {
		return true;
	} else {
		return false;
	}
}