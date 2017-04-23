<?php
/**
 * Query for post previews
 *
 * @package AdapterTheme
 */

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', 'post-preview' );
	}
	AWP_Theme::paginate_links();
	wp_reset_postdata();
} else {
	get_template_part( 'no-post-found' );
	get_template_part( 'awp-posts-and-pages' );
}
