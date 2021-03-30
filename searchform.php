<?php
/**
 * The template for displaying search forms.
 */

defined( 'ABSPATH' ) || exit;

?>

<form method="get" class="wpex-site-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="field" name="s" placeholder="<?php esc_attr_e( 'Search', 'wpex-today' ); ?>&hellip;" />
	<button type="submit"><span class="fa fa-search" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'submit search form', 'wpex-today' ); ?></span></button>
</form>