<?php defined( 'ABSPATH' ) or die( 'No direct access!' );

get_header();
?>
<div class="row">
	<div class="col-md-8">
		<?php AWP_Theme::the_breadcrumbs(); ?>
		<h1><?php wp_title( '' ); ?></h1>
		<?php get_template_part( 'query-post-previews' ); ?>
	</div>
	<div class="col-md-4 main-sidebar">
		<?php wp_meta(); ?>
		<?php if ( is_active_sidebar( 'main_sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'main_sidebar' ); ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer();
