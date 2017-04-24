<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>

<article class="<?php esc_attr( implode( ' ', array_filter( get_post_class( 'post-preview' ) ) ) ); ?>">
	<a href="<?php echo esc_url( get_the_permalink() ); ?>">
		<?php
		$thumbnail_args = array(
			'class' => 'pull-right img-rounded home-wp-post-image home-featured-image',
		);
		echo wp_kses_post( get_the_post_thumbnail( get_the_ID(), array( 300, 200 ), $thumbnail_args ) );
		?>
	</a>
	<h2>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
	</h2>
	<p>
		<?php echo wp_kses_post( AWP_Theme::get_author_date_category_tag() ); ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="mobile-post-permalink">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	</p>
	<p>
		<?php echo wp_kses_post( get_the_excerpt() ); ?>
		<a class="pull-right btn btn-primary btn-med read-more-button" href="<?php echo esc_url( get_the_permalink() ); ?>">
			<?php esc_html_e( 'Read more' , 'adapter-wp' ); ?>
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
		<div class="clearfix"></div>
	</p>
</article>
<hr>
