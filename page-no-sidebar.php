<?php
/*
Template Name: No Sidebar
*/

defined('ABSPATH') or die( "No direct access!" ); 

get_header();
	?>
	<div class="row">
		<div class="col-md-12">
			<?php awp_the_breadcrumbs(); ?>		
			<?php awp_query_for_page_content(); ?>
		</div>
	</div> 
<?php get_footer(); ?>