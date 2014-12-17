( function( $ ) {
	$( function() {
		var $parentOfThirdLevelMenuItems = $( '.menu-item-has-children .menu-item-has-children' ),
		    $firstLevelMenuItemWithChildren = $parentOfThirdLevelMenuItems.parents( '.dropdown' ),
		    cssValuesForHidden =
			{
			  'display' : 'none' ,
			  'opacity' : 0
			};

		$parentOfThirdLevelMenuItems.find( 'ul.dropdown-menu' )
			.removeClass( 'dropdown-menu' )
			.addClass( 'third-level-menu' )
			.css( cssValuesForHidden );

		$parentOfThirdLevelMenuItems.on( 'mouseenter' , function() {
			$( this ).find( '.third-level-menu' )
				 .css( 'display' , 'block' )
				 .animate( { 'opacity' : 1 } , 200 );
		} );

		$firstLevelMenuItemWithChildren.on( 'mouseleave' , function() {
			$( this ).find( '.third-level-menu' )
				 .css( cssValuesForHidden );
		} );

	} );
} ( jQuery ) );
