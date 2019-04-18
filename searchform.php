<?php
/**
 * The template for displaying search forms.
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2019, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */ ?>

<form method="get" class="wpex-site-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="field" name="s" placeholder="<?php esc_html_e( 'Search', 'wpex-today' ); ?>&hellip;" />
	<button type="submit"><span class="fa fa-search" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'submit search form', 'wpex-today' ); ?></span></button>
</form>