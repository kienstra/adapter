<?php
/**
 * Display the top banner.
 *
 * @package AdapterTheme
 */

if ( false !== get_header_image() ) :
?>
	<a class="header-banner-link" href="<?php echo esc_url( home_url() ); ?>">
		<div class="header-banner-wrapper" style="background:<?php echo esc_attr( get_theme_mod( 'awp_banner_background_color' ) ); ?>">
			<div class="header-banner" style="background:url(<?php esc_attr( header_image() ); ?>) no-repeat <?php AWP_Theme::top_banner_backround_alignment() ?>; height : <?php echo esc_attr( isset( get_custom_header()->height ) ? get_custom_header()->height : '' ); ?>px;" ></div>
		</div>
	</a>
<?php endif; ?>
