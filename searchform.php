<?php
/**
 * The template for displaying search forms.
 */

defined( 'ABSPATH' ) || exit;

?>

<form method="get" class="wpex-site-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="wpex-site-searchform-input" class="screen-reader-text"><?php esc_html_e( 'site search', 'wpex-today' ); ?></label>
	<input id="wpex-site-searchform-input" type="search" class="field" name="s" placeholder="<?php esc_attr_e( 'Search', 'wpex-today' ); ?>&hellip;" required>
	<button type="submit"><?php echo wpex_get_icon( 'search' ); ?><span class="screen-reader-text"><?php esc_html_e( 'submit search form', 'wpex-today' ); ?></span></button>
</form>