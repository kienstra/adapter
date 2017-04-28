j<?php
/**
 * Display if no posts are found.
 *
 * @package AdapterTheme
 */

?>
<div class="jumbotron">
	<div class="container">
		<h2>
			<span class="glyphicon glyphicon-exclamation-sign"></span>
			<?php esc_html_e( 'Sorry, we could not find your page.', 'adapter-wp' ); ?>
		</h2>
		<h4>
			<?php esc_html_e( 'Try a search, or click a link below.' , 'adapter-wp' ); ?>
		</h4>
		<div class="row">
			<div class="col-md-5">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>
