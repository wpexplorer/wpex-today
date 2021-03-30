<?php
/**
 * Returns the page layout components.
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="wpex-entry wpex-clr">
    <?php the_content(); ?>
    <?php get_template_part( 'partials/global/link-pages' ); ?>
</div><!-- .wpex-entry -->