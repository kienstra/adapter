<?php

add_action( 'admin_menu' , 'awp_add_options_page' );
function awp_add_options_page() {
	add_theme_page( __( 'Header & Footer' , 'adapter-wp' ) , __( 'Header & Footer' , 'adapter-wp' ) , 'edit_theme_options' , 'awp_options' , 'awp_options_output_callback' );
}

if ( ! function_exists( 'awp_options_output_callback' ) ) {
	function awp_options_output_callback() {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			die( __( 'Page not allowed, see administrator' , 'adapter-wp' ) );
		}

		$name_header_extra_markup = 'awp_header_extra_markup';
		$name_footer_extra_markup = 'awp_footer_extra_markup';
		$theme_option_form_action = 'action_header_footer';
		$theme_option_form_name = 'header-footer-markup';

		if ( ( ! empty( $_POST ) ) && check_admin_referer( $theme_option_form_action , $theme_option_form_name ) ) :
			$value_header_extra_markup = isset( $_POST[ $name_header_extra_markup ] ) ? $_POST[ $name_header_extra_markup ] : "";
			set_theme_mod( $name_header_extra_markup , stripslashes( $value_header_extra_markup ) );
			$value_footer_extra_markup = isset( $_POST[ $name_footer_extra_markup ] ) ? $_POST[ $name_footer_extra_markup ] : "";
			set_theme_mod( $name_footer_extra_markup , stripslashes( $value_footer_extra_markup ) );
			?>
			<div class="updated"><p><strong><?php _e( 'Markup saved' , 'adapter-wp' ); ?></strong></p></div>
		<?php endif; ?>

		<div class="wrap">
			<h1>
				<?php _e( 'Header and Footer' , 'adapter-wp' ); ?>
			</h1>
			<form name="<?php echo $theme_option_form_name; ?>" method="post" action="">
				<?php wp_nonce_field( $theme_option_form_action , $theme_option_form_name ); ?>
				<p>
					<h3>
						<?php _e( 'Header Extra Markup, ie. email opt-in form' , 'adapter-wp' ); ?>
					</h3>
					<textarea name="<?php echo esc_attr( $name_header_extra_markup ); ?>" rows="10" cols="55"><?php echo esc_textarea( get_theme_mod( $name_header_extra_markup ) ); ?></textarea>
				</p>
				<br>
				<p>
					<h3>
						<?php _e( 'Footer Extra Markup' , 'adapter-wp' ); ?>
					</h3>
					<textarea name="<?php echo esc_attr( $name_footer_extra_markup );  ?>" rows="10" cols="55"><?php echo esc_textarea( get_theme_mod( $name_footer_extra_markup ) ); ?></textarea>
				</p>
				<br>
				<input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save changes' , 'adapter-wp' ); ?>">
		 	</form>
		 </div> <!-- .wrap -->
	<?php
	}
}