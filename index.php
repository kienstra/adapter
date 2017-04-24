<?php
/**
 * Theme index file.
 *
 * @package AdapterTheme
 */

get_header();
	?>
	<div class="row">
		<div class="col-md-12">
			<?php get_template_part( 'breadcrumbs' ); ?>
			<h1><?php wp_title( '' ); ?></h1>
			<?php get_template_part( 'query-post-previews' ); ?>
		</div>
	</div>
<?php get_footer();
