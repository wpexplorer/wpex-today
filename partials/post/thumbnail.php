<?php
/**
 * Displays the post thumbnail.
 */

defined( 'ABSPATH' ) || exit;

?>

<?php if ( has_post_thumbnail() ) : ?>

	<div class="wpex-post-media wpex-post-thumbnail wpex-clr">

		<?php the_post_thumbnail( 'wpex_post' ); ?>

	</div><!-- .wpex-post-media -->

<?php endif; ?>