<?php
/**
 * Returns the page layout components
 *
 * @package   Today WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article class="wpex-page-article wpex-clr">

	<?php get_template_part( 'partials/page/header' ); ?>

	<?php get_template_part( 'partials/page/content' ); ?>

	<?php do_action( 'wpex_page_after_boxed_container' ); // used for woo cart ?>

	<?php if ( get_theme_mod( 'comments_on_pages', true ) ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>

	<?php get_template_part( 'partials/global/edit' ); ?>

</article><!-- .wpex-page-article -->