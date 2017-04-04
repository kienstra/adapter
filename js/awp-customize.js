( function( $ ) {
	$( function() {

		wp.customize( 'header_image' , function( value ) {
			value.bind( function( to ) {
				$( '.header-banner' ).css( 'background' , to );
			} );
		} );

		wp.customize( 'awp_banner_background_color' , function( value ) {
			value.bind( function( to ) {
				$( '.header-banner-wrapper' ).css( 'background' , to );
			} );
		} );

	} );
} ) ( jQuery );
