<?php
/**
 * Display a single post.
 *
 * @package AdapterTheme
 */

get_header();
?>
<div class="row">
	<div class="col-md-8"> 
		<?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'content', get_post_format() );
				AWP_Theme::custom_wp_link_pages();
				?>
				<hr>
				<?php do_action( 'awp_after_full_single_post_content' ); ?>
				<?php comments_template(); ?>
				<ul class="pager">
					<?php next_post_link( '<li>%link</li>' , '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;%title' ); ?>
					<?php previous_post_link( '<li>%link</li>' , '%title&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ); ?>
				</ul>
				<?php
			endwhile;
		else :
			get_template_part( 'no-post-found' );
			get_template_part( 'awp-posts-and-pages' );
		endif;
		?>
	</div>
	<div class="col-md-4 main-sidebar">
		<?php wp_meta(); ?>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer();
