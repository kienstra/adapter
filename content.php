<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>

<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" class="<?php echo esc_attr( implode( ' ', array_filter( get_post_class( 'post' ) ) ) ); ?>">
	<h1>
		<?php the_title(); ?>
		<?php
		if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
			edit_post_link( '<span class="glyphicon glyphicon-edit"></span>' );
		}
		?>
	</h1>
	<p>
		<?php AWP_Theme::author_date_category_tag(); ?>
		<em>
			<?php if ( 0 !== get_comments_number() ) : ?>
				<a class="comment-link" href="#comments">&nbsp;<span class="glyphicon glyphicon-comment"></span>&nbsp;<?php comments_number(); ?></a>
			<?php endif; ?>
		</em>
	</p>
	<?php the_content(); ?>
</article>
