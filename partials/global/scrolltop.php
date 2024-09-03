<?php
/**
 * Scroll to top button.
 */

defined( 'ABSPATH' ) || exit;

?>

<a href="#" title="<?php esc_attr_e( 'Top', 'wpex-today' ); ?>" class="wpex-site-scroll-top"><?php echo wpex_get_icon( 'angle-up' ); ?><span class="screen-reader-text"><?php esc_html_e( 'back to top', 'wpex-today' ); ?></span></a>