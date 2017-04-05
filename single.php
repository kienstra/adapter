<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>
<?php get_header(); ?>

<div class="row">
	<div class="col-md-8"> 
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content' , get_post_format() ); ?>
			<?php AWP_Theme::custom_wp_link_pages(); ?>
			<hr>
			<?php do_action( 'awp_after_full_single_post_content' );
				AWP_Theme::display_comment_form_or_template();
			?>
			<ul class="pager">
				<?php echo next_post_link( '<li>%link</li>' , '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;%title' ); ?>
				<?php echo previous_post_link( '<li>%link</li>' , '%title&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ); ?>
			</ul>
		<?php endwhile; else :
			get_template_part( 'no-post-found' );
			get_template_part( 'awp-posts-and-pages' );
		endif;
		?>
	</div>
	<div class="col-md-4 main-sidebar"> <!--span4 -->
		<?php wp_meta(); ?>	 
		<?php if ( is_active_sidebar( 'main_sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'main_sidebar' ); ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer();
