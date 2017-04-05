<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>

<div class="jumbotron">
	<div class="container">
		<h2>
			<span class="glyphicon glyphicon-exclamation-sign"></span>
			<?php esc_attr_e( "Sorry, we couldn't find your page." , 'adapter-wp' ); ?>
		</h2>
		<h4>
			<?php esc_attr_e( 'Try a search, or click a link below.' , 'adapter-wp' ); ?>
		</h4>
		<div class="row">
			<div class="col-md-5">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>
