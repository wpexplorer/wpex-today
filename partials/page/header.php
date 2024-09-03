<?php
/**
 * Outputs the page title.
 */

defined( 'ABSPATH' ) || exit;

// Display the page header if it's not the front-page
if ( ! is_front_page() ) : ?>
	<header class="page-header">
	    <h1 class="wpex-page-header-title"><?php the_title(); ?></h1>
	</header><!-- #page-header -->
<?php endif; ?>