<?php
/**
 * Theme header file.
 *
 * @package AdapterTheme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>
	<head>
		<meta charset="<?php esc_attr( get_bloginfo( 'charset' ) ); ?>" >
		<title>
			<?php echo esc_html( get_the_title() ); ?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
		<?php wp_head(); ?>
	</head>
	<body <?php echo body_class(); ?>>
		<?php do_action( 'awp_before_top_nav' ); ?>
		<?php AWP_Theme::maybe_get_top_nav(); ?>
		<div class="container page-container">
			<?php do_action( 'awp_top_of_page' );
