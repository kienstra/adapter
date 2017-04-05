<?php
/*
Template Name: No Sidebar
*/

defined( 'ABSPATH' ) or die( 'No direct access!' );

get_header();
	?>
	<div class="row">
		<div class="col-md-12">
			<?php AWP_Theme::the_breadcrumbs(); ?>
			<?php AWP_Theme::query_for_page_content(); ?>
		</div>
	</div> 
<?php get_footer();
