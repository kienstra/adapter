<?php

add_action( 'customize_register' , 'awp_change_customizer_sections' );
function awp_change_customizer_sections( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->title = __( 'Top Banner Image' , 'adapter-wp' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'nav' );
	$wp_customize->remove_section( 'static_front_page' );
}

add_action( 'customize_register' , 'awp_add_customizer_sections' );
function awp_add_customizer_sections( $wp_customize ) {

	$wp_customize->add_section( 'top_banner_background_color' , array(
		'title' => __( 'Top Banner Background Color' , 'adapter-wp' ) ,
		'description' => __( 'Shows below your menu.' , 'adapter-wp' ) ,
		'priority' => '61'
	) );

	$wp_customize->add_setting( 'awp_banner_background_color' , array(
		'default' => 'F8F8F8' ,
		'capability' => 'edit_theme_options' ,
		'transport' => 'postMessage' ,
		'sanitize_callback' => 'awp_sanitize_customizer_value' ,
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize ,
		'banner_background_color' ,
		array(
			'label' => __( 'Backround Color' , 'adapter-wp' ) ,
			'section' => 'top_banner_background_color' ,
			'settings' => 'awp_banner_background_color' ,
		)
	) );

} /* end function awp_add_customizer_sections */

function awp_sanitize_customizer_value( $input ) {
	if ( current_user_can( 'edit_theme_options' ) ) {
		return $input;
	}
}

add_action( 'customize_register' , 'awp_enqueue_customizer_script' );
function awp_enqueue_customizer_script() {
	wp_enqueue_script( 'awp-customize' , get_template_directory_uri() . '/js/awp-customize.js' , array( 'jquery' , 'customize-preview' ) , '' , true );
}