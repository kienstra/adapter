<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>

<nav class="<?php echo esc_attr( AWP_Theme::get_classes_of_bottom_navbar() ); ?>" role="navigation">
	<div class="container">
		<?php echo do_shortcode( get_theme_mod( 'awp_footer_extra_markup' ) ); ?>
		<?php do_action( 'awp_navbar_bottom' ); ?>
	</div>
	<p class="<?php esc_attr( AWP_Theme::get_bottom_copyright_classes() ); ?> copyright-text">
		<?php echo esc_html( AWP_Theme::get_copyright() ); ?>
	</p>
</nav>
