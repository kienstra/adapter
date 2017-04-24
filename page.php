<?php
/*
Template Name: With Sidebar
*/

defined( 'ABSPATH' ) or die( 'No direct access!' );

get_header();
?>
	<div class="row">
		<div class="col-md-8">
			<?php get_template_part( 'breadcrumbs' ); ?>
			<?php get_template_part( 'query-page-content' ); ?>
		</div>
		<div class="col-md-4 main-sidebar">
			<?php wp_meta(); ?>
			<?php if ( is_active_sidebar( 'main_sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'main_sidebar' ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php get_footer();
