<?php
/*
Template Name: No Sidebar
*/

defined( 'ABSPATH' ) or die( 'No direct access!' );

get_header();
	?>
	<div class="row">
		<div class="col-md-12">
			<?php get_template_part( 'breadcrumbs' ); ?>
			<?php get_template_part( 'query-page-content' ); ?>
		</div>
	</div> 
<?php get_footer();
