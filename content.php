<?php
/**
 * Display the post content.
 *
 * @package AdapterTheme
 */

?>
<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" class="<?php echo esc_attr( implode( ' ', array_filter( get_post_class( 'post' ) ) ) ); ?>">
	<h1>
		<?php esc_html( get_the_title() ); ?>
		<?php if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) : ?>
			<?php edit_post_link( '<span class="glyphicon glyphicon-edit"></span>' ); ?>
		<?php endif; ?>
	</h1>
	<p>
		<?php echo wp_kses_post( AWP_Theme::get_byline() ); ?>
		<em>
			<?php if ( comments_open() && ( have_comments() ) ) : ?>
				<a class="comment-link" href="#comments">&nbsp;<span class="glyphicon glyphicon-comment"></span>&nbsp;<?php comments_number(); ?></a>
			<?php endif; ?>
		</em>
	</p>
	<?php echo wp_kses_post( get_the_content() ); ?>
</article>
