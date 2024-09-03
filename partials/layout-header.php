<?php
/**
 * The main header layout.
 */

defined( 'ABSPATH' ) || exit;

?>

<header class="wpex-site-header-wrap">
	<div class="wpex-container">
		<div class="wpex-site-header">
			<div class="wpex-site-branding">
				<?php get_template_part( 'partials/header/logo' ); ?>
				<?php get_template_part( 'partials/header/description' ); ?>
			</div><!-- .wpex-site-branding -->
			<?php get_template_part( 'partials/header/ad' ); ?>
		</div><!-- .wpex-site-header -->
		<?php get_template_part( 'partials/header/nav' ); ?>
	</div>
</header><!-- .wpex-site-header-wrap -->