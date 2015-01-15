<?php defined('ABSPATH') or die( "No direct access!" ); ?>

<div class="row">
	<div class="col-md-6 search-posts">
		<h3>
			<?php esc_html_e( 'Articles' , 'adapter-wp' ); ?>
		</h3>
		<?php awp_echo_posts_list_group() ?>
	</div> <!-- .search-posts -->
	<div class="col-md-6 site-pages">
		<h3>
			<?php esc_html_e( 'Pages' , 'adapter-wp' ); ?>
		</h3>
		<?php awp_echo_pages_list_group(); ?>
	</div>
</div>