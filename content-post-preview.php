<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>

<article <?php esc_attr( get_post_class( 'post-preview' ) ); ?>>
	<a href="<?php echo esc_url( get_the_permalink() ); ?>">
	<?php the_post_thumbnail( array( 300, 200 ), array( 'class' => 'pull-right img-rounded home-wp-post-image home-featured-image' ) ); ?>
	</a>
	<h2>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
	</h2>
	<p>
		<?php AWP_Theme::author_date_category_tag(); ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="mobile-post-permalink">
	<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	</p>
	<p>
		<?php echo get_the_excerpt(); ?>
		<a class="pull-right btn btn-primary btn-med read-more-button" href="<?php echo esc_url( get_the_permalink() ); ?>">
			<?php esc_html_e( 'Read more' , 'adapter-wp' ); ?>
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
		<div class="clearfix"></div>
	</p>
</article>
<hr>
