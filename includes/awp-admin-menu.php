<?php

add_action( 'admin_menu' , 'awp_add_options_page' );
function awp_add_options_page() {
  add_theme_page( __( 'Header & Footer' , 'adapter-wp' ) , __( 'Header & Footer' , 'adapter-wp' ) , 'unfiltered_html' , 'awp_options' , 'awp_options_output_callback' );  
}

if ( ! function_exists( 'awp_options_output_callback' ) ) {
  function awp_options_output_callback() { 
    if ( ! current_user_can( 'unfiltered_html' ) ) {
      die( __( 'Page not allowed, see administrator' , 'adapter-wp' ) );
    }

    $name_header_extra_markup = 'awp_header_extra_markup';
    $name_footer_extra_markup = 'awp_footer_extra_markup';
    $name_hidden_input = 'awp_hidden_input';
    
    $value_header_extra_markup =  get_option( $name_header_extra_markup );
    $value_footer_extra_markup =  get_option( $name_footer_extra_markup );

    if ( isset( $_POST[ $name_hidden_input ] ) &&  ( 'Y' == $_POST[ $name_hidden_input ] ) ) : 
      $value_header_extra_markup =   stripslashes( $_POST[ $name_header_extra_markup ] );
      update_option( $name_header_extra_markup , $value_header_extra_markup ); 
      $value_footer_extra_markup =  stripslashes( $_POST[ $name_footer_extra_markup ] );
      update_option( $name_footer_extra_markup , $value_footer_extra_markup );
    ?>
      <div class="updated"><p><strong><?php _e( 'Markup saved' , 'adapter-wp' ); ?></strong></p></div>
    <?php endif; ?>
    
     <div class="wrap">
       <h1>
	 <?php _e( 'Header and Footer' , 'adapter-wp' ); ?>
       </h1>
       <form name="header-footer-markup" method="post" action="">
         <input type="hidden" name="<?php echo $name_hidden_input; ?>" value="Y" >
	 <p>
	   <h3>
    	     <?php _e( 'Header Extra Markup, ie. email opt-in form' , 'adapter-wp' ); ?>
	   </h3>
	   <textarea name="<?php echo $name_header_extra_markup; ?>" rows="10" cols="55"><?php echo esc_textarea( $value_header_extra_markup ); ?></textarea>
	 </p>
	 <br>
	 <p>
	   <h3>
	     <?php _e( 'Footer Extra Markup' , 'adapter-wp' ); ?>
	   </h3>
  	   <textarea name="<?php echo $name_footer_extra_markup; ?>" rows="10" cols="55"><?php echo esc_textarea( $value_footer_extra_markup ); ?></textarea>
	 </p>
	 <br>	 
	 <input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save changes' , 'adapter-wp' ); ?>">
       </form>
     </div> <!-- .wrap -->
  <?php
  }
}