<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>

<?php get_header(); ?>
	<?php $number_of_results = $wp_query->found_posts; ?>
	<div class="jumbotron">
		<div class="container">
			<h3><?php esc_html_e( 'Search for:' , 'adapter-wp' ); ?>&nbsp;<span class="search-keyword">&ldquo;<?php the_search_query(); ?>&rdquo;</span></h3>
		<?php if ( ( '' === $number_of_results ) || ( 0 === $number_of_results ) ) { ?>
	<p>
		<span class="label label-danger">
			<?php esc_html_e( 'Sorry, no search results.' , 'adapter-wp' ); ?>
		</span>
		&nbsp;<?php esc_html_e( 'Try different terms.' , 'adapter-wp' ); ?>
	</p>
		<?php } else { ?>
		<p>
			<span class="label label-success">
				<?php echo esc_html( sprintf( _n( '%s result', '%s results', $number_of_results, 'adapter-wp' ), $number_of_results ) ); ?>
			</span>
		</p>
		<?php } ?>
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
		<h1><?php _e( 'Search Results' , 'adapter-wp' ); ?></h1>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content' , 'post-preview' ); ?>
		<?php endwhile; ?>
		<ul class="pager">
			<li>
				<?php previous_posts_link( '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' . __( 'Previous results' , 'adapter-wp' ) ); ?>
			</li>
			<li>
				<?php next_posts_link( 'Next results&nbsp;<span class="glyphicon glyphicon-chevron-right"</span>' ); ?>
			</li>
		</ul>
	<?php else : /* No search results */ ?>
		<?php get_template_part( 'awp-posts-and-pages' ); ?>
	<?php endif; /* have_posts */ ?>
		</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer();
