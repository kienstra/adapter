<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>

<article id="post-<?php esc_attr( get_the_ID() ); ?>" <?php esc_attr( get_post_class( 'post' ) ); ?>>
	<h1>
		<?php the_title( '<header class="entry-header"><h1 class="entry-title">', AWP_Theme::maybe_echo_edit_link() . '</h1></header>' ); ?>
	</h1>
	<div class="entry-content">
		<?php the_content();
		AWP_Theme::custom_wp_link_pages();
		AWP_Theme::display_comment_form_or_template();
		?>
	</div>
</article>
