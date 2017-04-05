<?php defined( 'ABSPATH' ) or die( 'No direct access!' );

get_header();
	?>	
	<div class="row">
		<div class="col-md-12">
			<?php AWP_Theme::the_breadcrumbs(); ?>
			<h1><?php wp_title( '' ); ?></h1>
			<?php AWP_Theme::query_for_post_previews(); ?>
		</div>
	</div>
<?php get_footer();
