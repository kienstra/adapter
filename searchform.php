<?php
/**
 * Form for searching the site.
 *
 * @package AdapterTheme
 */

?>
<form role="form" action="<?php echo esc_url( get_home_url() ); ?>" method="get" id="search-form">
	<label for="s" class="sr-only"><?php esc_html_e( 'Search', 'adapter-wp' ); ?></label>
	<div class="input-group">
		<input type="text" id="s" class="form-control" name="s" placeholder="Search" <?php echo ( $search_terms ) ? ' value="' . esc_html( $search_terms ) . '"' : null; ?> />
		<div class="input-group-btn">
			<button type="submit" class="btn btn-primary btn-med">
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</div>
	</div>
</form>
