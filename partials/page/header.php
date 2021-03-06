<?php
/**
 * Outputs the page title.
 */

defined( 'ABSPATH' ) || exit;

// Display the page header if it's not the front-page
if ( ! is_front_page()
	&& ( ! has_post_thumbnail() && wpex_has_page_featured_image_overlay_title() )
) : ?>
	<header class="page-header wpex-clr">
	    <h1 class="wpex-page-header-title"><?php the_title(); ?></h1>
	</header><!-- #page-header -->
<?php endif; ?>