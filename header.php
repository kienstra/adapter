<?php defined( 'ABSPATH' ) or die( "No direct access!" ); ?>
<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" >
		<title>
			<?php wp_title(); ?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php do_action( 'awp_before_top_nav' ); ?>
		<?php awp_maybe_get_top_nav(); ?>
		<div class="container page-container">
			<?php do_action( 'awp_top_of_page' );