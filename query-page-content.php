<?php
/**
 * Query for page content
 *
 * @package AdapterTheme
 */

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', 'page' );
	}
	wp_reset_postdata();
} else {
	get_template_part( 'no-post-found' );
	get_template_part( 'awp-posts-and-pages' );
}
