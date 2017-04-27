<?php
/**
 * Display the home page.
 *
 * @package AdapterTheme
 */

get_header();
?>
<div class="row">
	<div class="col-md-8">
		<?php get_template_part( 'breadcrumbs' ); ?>
		<h1><?php wp_title( '' ); ?></h1>
		<?php get_template_part( 'query-post-previews' ); ?>
	</div>
	<div class="col-md-4 main-sidebar">
		<?php wp_meta(); ?>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer();
