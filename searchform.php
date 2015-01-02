<?php $search_terms = ( isset( $_GET[ 's' ] ) ?	 $_GET[ 's' ] : '' ); ?>

	<form role="form" action="<?php echo esc_url( home_url() ); ?>" method="get" id="search-form">
	<label for="s" class="sr-only"><?php _e( 'Search' , 'adapter-wp' ); ?></label>
	<div class="input-group">
		<input type="text" id="s" class="form-control" name="s" placeholder="Search" <?php if ( '' !== $search_terms ) { echo ' value="' . esc_html( $search_terms ) . '"'; } ?> />
		<div class="input-group-btn">
			<button type="submit" class="btn btn-primary btn-med">
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</div>
	</div>
</form>