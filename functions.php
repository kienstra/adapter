<?php
/**
 * Adapter Theme functions file
 *
 * @package AdapterTheme
 */

include_once( get_template_directory() . '/includes/class-awp-init.php' );
include_once( get_template_directory() . '/includes/class-awp-theme.php' );
include_once( get_template_directory() . '/includes/class-awp-customizer.php' );
include_once( get_template_directory() . '/includes/class-awp-admin-menu.php' );
include_once( get_template_directory() . '/includes/wp_bootstrap_navwalker.php' );

global $awp_init;
$awp_init = new AWP_Init();
