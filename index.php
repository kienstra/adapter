<?php defined( 'ABSPATH' ) or die( 'No direct access!' );

get_header();
	?>	
	<div class="row">
		<div class="col-md-12">
			<?php AWP_Theme::the_breadcrumbs(); ?>
			<h1><?php wp_title( '' ); ?></h1>
			<?php get_template_part( 'query-post-previews' ); ?>
		</div>
	</div>
<?php get_footer();
