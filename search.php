<?php
/**
 * Display on searching for a string.
 *
 * @package AdapterTheme
 */

get_header();
	global $wp_query;
	$number_of_results = property_exists( $wp_query, 'found_posts' ) ? $wp_query->found_posts : 0;
	?>
	<div class="jumbotron">
		<div class="container">
			<h3><?php esc_html_e( 'Search for:' , 'adapter-wp' ); ?>&nbsp;<span class="search-keyword">&ldquo;<?php the_search_query(); ?>&rdquo;</span></h3>
			<?php if ( ( '' === $number_of_results ) || ( 0 === $number_of_results ) ) : ?>
				<p>
					<span class="label label-danger">
						<?php esc_html_e( 'Sorry, no search results.' , 'adapter-wp' ); ?>
					</span>
					&nbsp;<?php esc_html_e( 'Try different terms.' , 'adapter-wp' ); ?>
				</p>
			<?php else : ?>
				<p>
					<span class="label label-success">
						<?php /* translators: %s: single result, %s: multiple results */ ?>
						<?php echo esc_html( sprintf( _n( '%s result', '%s results', $number_of_results, 'adapter-wp' ), $number_of_results ) ); ?>
					</span>
				</p>
			<?php endif; ?>
			<div class="row">
				<div class="col-md-5">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="container" id="main-container">
		<div class="row">
			<div class="col-md-8">
				<?php if ( have_posts() ) : ?>
					<h1><?php esc_html_e( 'Search Results' , 'adapter-wp' ); ?></h1>
					<?php while ( have_posts() ) :
						the_post();
						get_template_part( 'content' , 'post-preview' );
					endwhile;
					?>
					<ul class="pager">
						<li>
							<?php previous_posts_link( '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' . __( 'Previous results' , 'adapter-wp' ) ); ?>
						</li>
						<li>
							<?php next_posts_link( 'Next results&nbsp;<span class="glyphicon glyphicon-chevron-right"</span>' ); ?>
						</li>
					</ul>
				<?php wp_reset_postdata();
				else :
					get_template_part( 'awp-posts-and-pages' );
				endif; ?>
			</div>
				<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer();
