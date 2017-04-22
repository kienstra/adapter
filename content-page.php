<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>

<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" class="<?php echo esc_attr( implode( ' ', array_filter( get_post_class( 'post' ) ) ) ); ?>">
	<h1>
		<?php the_title( '<header class="entry-header"><h1 class="entry-title">', AWP_Theme::maybe_echo_edit_link() . '</h1></header>' ); ?>
	</h1>
	<div class="entry-content">
		<?php the_content();
		AWP_Theme::custom_wp_link_pages();
		comments_template();
		?>
	</div>
</article>
