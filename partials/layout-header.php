<?php
/**
 * The main header layout.
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="wpex-site-header-wrap wpex-clr">

	<header class="wpex-site-header wpex-container wpex-clr">

		<div class="wpex-site-branding wpex-clr">

			<?php get_template_part( 'partials/header/logo' ); ?>

			<?php get_template_part( 'partials/header/description' ); ?>

		</div><!-- .wpex-site-branding -->

		<?php get_template_part( 'partials/header/ad' ); ?>

	</header><!-- .wpex-site-header -->

</div><!-- .wpex-site-header-wrap -->

<?php get_template_part( 'partials/header/nav' ); ?>