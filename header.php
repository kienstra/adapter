<?php defined( 'ABSPATH' ) or die( "No direct access!" ) ; ?>

<!DOCTYPE html> 
<html <?php esc_attr( language_attributes( 'html' ) ) ; ?>>
  <head>
    <meta charset="<?php esc_attr( bloginfo( 'charset' ) ) ; ?>" >
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ) ; ?>" >
    <!-- style.css enqueued in functions.php using get_stylesheet_uri() -->
    <?php wp_head() ; ?>
  </head>
  <body <?php echo esc_attr( body_class() ) ; ?>>
    <?php do_action( 'awp_before_top_nav' ) ; ?>
    <?php awp_maybe_get_top_nav() ; ?>
    <div class="container">
      <?php do_action( 'awp_top_of_page' ) ; ?>
