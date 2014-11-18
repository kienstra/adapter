<?php defined('ABSPATH') or die( "No direct access!" ); ?>

<?php if ( '' != get_header_image() ) : ?>
	<a class="header-banner-link" href="<?php echo esc_url( home_url() ); ?>">
		<div class="header-banner-wrapper" style="background:<?php echo esc_attr( get_theme_mod( 'awp_banner_background_color' ) ); ?>">
			<div class="header-banner" style="background:url(<?php esc_attr( header_image() ); ?>) no-repeat <?php awp_the_top_banner_backround_alignment() ?>; height : <?php echo esc_attr( get_custom_header()->height ); ?>px;" >
			</div>
		</div>
	</a>
<?php endif; ?>

<?php
$awp_tagline = trim( get_bloginfo( 'description' ) );
$awp_header_extra_markup = do_shortcode( get_option( 'awp_header_extra_markup' ) );
if ( ( '' != $awp_tagline ) || ( '' != $awp_header_extra_markup ) ) :
?>

<nav class="<?php awp_the_classes_of_second_top_navbar(); ?> navbar-opt-in">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand">
	<?php printf( __( '%s' , 'adapter-wp' ) , $awp_tagline ); ?>
			</span>
		</div>
		<?php echo $awp_header_extra_markup; ?>
		<?php do_action( 'awp_end_of_top_banner' ); ?>
	</div>
</nav>

<?php endif;