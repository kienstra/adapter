<?php
/**
 * Adapter Theme functions file
 *
 * @package AdapterTheme
 */

include_once( get_template_directory() . '/includes/awp-init.php' );
include_once( get_template_directory() . '/includes/awp-theme.php' );
include_once( get_template_directory() . '/includes/awp-customizer.php' );
include_once( get_template_directory() . '/includes/awp-admin-menu.php' );
include_once( apply_filters( 'awp_navwalker_path', get_template_directory() . '/includes/wp_bootstrap_navwalker.php' ) );

global $awp_init;
$awp_init = new AWP_Init();
