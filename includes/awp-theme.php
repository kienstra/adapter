<?php
/**
 * Adapter Theme helper functions file
 *
 * @package AdapterTheme
 */

/**
 * Class AWP_Theme
 */
class AWP_Theme {

	/**
	 * Top navbar classes to output by default.
	 *
	 * @var string
	 */
	public static $default_top_navbar_classes = 'navbar navbar-default top-navbar navbar-static-top navbar-first-top ';

	/**
	 * Second top navbar classes to output by default.
	 *
	 * @var string
	 */
	public static $default_second_top_navbar_classes = 'navbar navbar-second-top navbar-default navbar-static-top';

	/**
	 * Bottom navbar classes to output by default.
	 *
	 * @var string
	 */
	public static $default_bottom_navbar_classes = 'navbar navbar-default navbar-static-bottom';

	/**
	 * Get the classes to display in the first top navigation bar.
	 *
	 * @return string $classes First top navbar classes.
	 */
	public static function get_classes_of_first_top_navbar() {

		/**
		 * Classes to output in the top Bootstrap menu.
		 *
		 * Using the class 'navbar-fixed-top' fixes the navbar.
		 * See Bootstrap documentation for these classes.
		 *
		 * @param string $default_top_navbar_classes Bootstrap classes to output by default.
		 */
		return apply_filters( 'awp_classes_of_first_top_navbar', self::$default_top_navbar_classes );
	}

	/**
	 * Get the classes to display in the second top navigation bar.
	 *
	 * @return string $classes Second top navbar classes.
	 */
	public static function get_classes_of_second_top_navbar() {

		/**
		 * Classes to output in the second top Bootstrap menu.
		 *
		 * @param string $default_top_navbar_classes Bootstrap classes to output by default.
		 */
		return apply_filters( 'awp_classes_of_second_top_navbar', self::$default_second_top_navbar_classes );
	}

	/**
	 * Get the classes for the bottom navbar.
	 *
	 * Bootstrap uses the class navbar, but this does not have navigation.
	 * It shares classes with the navigation bar.
	 *
	 * @return string $classes Bottom navbar classes.
	 */
	public static function get_classes_of_bottom_navbar() {

		/**
		 * Classes to output in the second top Bootstrap menu.
		 *
		 * @param string $default_top_navbar_classes Bootstrap classes to output by default.
		 */
		return apply_filters( 'awp_classes_of_bottom_navbar', self::$default_bottom_navbar_classes );
	}

	public static function maybe_get_top_nav() {
		if ( self::should_page_have_top_and_bottom_navs() ) {
			self::maybe_get_top_banner_parts();
			get_template_part( 'navbar-top' );
		}
	}

	public static function should_page_have_top_and_bottom_navs() {
		if ( is_page() && ( false !== strpos( get_page_template(), 'no-nav' ) ) ) {
			return false;
		} else {
			return true;
		}
	}

	public static function maybe_get_top_banner_parts() {
		$do_get_top_banner = apply_filters( 'awp_do_get_top_banner', true );
		if ( $do_get_top_banner ) {
			get_template_part( 'top-banner' );
		}
	}

	public static function top_banner_backround_alignment() {
		$alignment = apply_filters( 'awp_top_banner_backround_alignment', 'center' );
		echo esc_attr( $alignment );
	}

	public static function maybe_bottom_nav() {
		$top_and_bottom_navs_allowed = self::should_page_have_top_and_bottom_navs();
		$do_get_bottom_nav = apply_filters( 'awp_do_get_bottom_nav', $top_and_bottom_navs_allowed );
		if ( $do_get_bottom_nav ) {
			get_template_part( 'navbar-bottom' );
		}
	}

	public static function top_nav_menu() {
		$menu_name = 'awp_main_menu';
		wp_nav_menu( array(
			'menu'           => $menu_name,
			'theme_location' => $menu_name,
			'depth'          => 3,
			'container'      => false,
			'menu_class'     => 'nav navbar-nav',
			'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
			'walker'         => new WP_Bootstrap_Navwalker(),
		) );
	}

	/**
	 * Get the copyright text to output in the bottom navbar.
	 *
	 * @return string $copyrigh_text To display in the footer.
	 */
	public static function get_copyright() {

		/**
		 * The name to display after the copyright text.
		 *
		 * @param string $admin The administrator of the site.
		 */
		$name = apply_filters( 'awp_name_next_to_copyright_in_footer', get_bloginfo( 'admin' ) );
		return esc_html( '&copy;&nbsp;' . $name . '&nbsp;' . date( 'Y' ) );
	}

	public static function get_bottom_copyright_classes() {
		return apply_filters( 'awp_bottom_copyright_classes', '' );
	}

	public static function paginate_links() {
		global $wp_query;
		$awp_big = 999999999;

		$pagination_args = array(
			'base' => str_replace( $awp_big, '%#%', esc_url( get_pagenum_link( $awp_big ) ) ),
			'format'    => '/page/%#%',
			'type'      => 'array',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'prev_next' => true,
			'prev_text' => sprintf( __( '%sNewer', 'adapter-wp' ), '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' ),
			'next_text' => sprintf( __( 'Older%s', 'adapter-wp' ), '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ),
		);

		$pagination = paginate_links( $pagination_args );
		$pagination_size = apply_filters( 'awp_pagination_size', '' );

		?>
		<ul class="pagination pagination-<?php echo esc_attr( $pagination_size ); ?>">
		<?php
		if ( $pagination ) {
			foreach ( $pagination as $page ) {
				$has_href = ( false !== strpos( $page, 'href' ) );
				$class = $has_href ? 'active' : 'disabled';
				echo '<li class="' . esc_attr( $class ) . '">'
					. $page
					. '</li>';
			}
		}
		?>
		</ul>
	<?php
	}

	public static function custom_wp_link_pages() {
		$awp_link_pages_args = array(
			'before' => '<ul class="pagination">',
			'after'	 => '</ul>',
			'link_before' => '<li>',
			'link_after' => '</li>',
			'previouspagelink' => sprintf( __( '%sBack', 'adapter-wp' ), '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' ),
			'nextpagelink' => sprintf( __( 'Next%s', 'adapter-wp' ), '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ),
			'next_or_number' => 'next',
		);
		wp_link_pages( $awp_link_pages_args );
	}

	public static function author_date_category_tag() {
		global $post;
		$post_date = get_the_time( get_option( 'date_format' ) );
		if ( '' == $post->post_title ) {
				// The post has no title, so make the date a link to the post page
			$post_date = '<a href="' . esc_url( get_the_permalink() ) . '">'
				   . esc_html( $post_date )
				   . '</a>';
		}
		?>
			<em>
				By:&nbsp;<?php echo esc_html( get_the_author() ); ?>&nbsp;on:&nbsp;<?php echo esc_html( $post_date ); ?>
				<?php
				if ( has_category() ) {
					echo '&nbsp;in:&nbsp;';
					the_category( ', ' );
				}
				if ( has_tag() ) {
					echo ', ';
					the_tags( '', ', ', '' );
				}
				?>
			</em>
		<?php
	}

	public static function comment_list( $comment, $arguments, $depth ) {
		?>
		<li <?php echo comment_class( 'media' ); ?> id="comment-<?php echo comment_ID() ?>">
		<article>
			<div class="meta-comment pull-left">
				<?php echo get_avatar( $comment, 96 ); ?>
			</div>
			<div class="content-comment media-body">
				<p class="date-comment pull-right text-right text-muted">
		<?php echo human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ); ?> ago &nbsp;
		<a class="permalink-comment" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="Comment link">
			<span class="glyphicon glyphicon-ink"></span>
		</a>
				</p>
				<?php if ( '0' == $comment->comment_approved ) : ?>
		<em>
			<?php _e( 'The comment is in the queue for moderation', 'adapter-wp' ); ?>
		</em>
				<?php else : ?>
		<p><?php echo comment_author_link(); ?></p>
		<?php comment_text(); ?>
		<div class="reply-comment pull-right">
			<?php comment_reply_link( array_merge( $arguments, array(
				 'reply_text' => '<span class="glyphicon glyphicon-edit"></span> &nbsp; Reply',
				 'depth'		 => $depth,
				 'max_depth' => $arguments['max_depth'],
			) ) );
			?>
		</div>
				<?php endif; ?>
			</div> <!-- content-comment -->
		</article>
	<?php
	}

	/**
	 * Get the pages in a format that uses Bootstrap's styling for list-group.
	 *
	 * @return string $markup Bootstrap .list-group markup for pages.
	 */
	public static function get_pages_list_group() {
		$pages = get_pages();
		$markup = '<div class="list-group">';
		foreach ( $pages as $page ) {
			$markup .= '<a class="list-group-item" href="' . esc_url( get_permalink( $page->ID ) ) . '">'
				. esc_html( $page->post_title )
				. '</a>';
		}
		return $markup . '</div>';
	}

	/**
	 * Get the posts Bootstrap's .list-group format.
	 *
	 * @return string $markup Bootstrap .list-group markup for posts.
	 */
	public static function get_posts_list_group() {
		$arguments = array(
			'numberposts' => '10',
			'post_status' => 'publish',
		);
		$recent_posts = wp_get_recent_posts( $arguments );
		$markup = '<div class="list-group">';

		foreach ( $recent_posts as $post ) {
			$markup .= '<a class="list-group-item" href="' . esc_attr( get_permalink( $post['ID'] ) ) . '">'
			. esc_html( $post['post_title'] )
			. '</a>';
		}
		return $markup . '</div>';
	}

	public static function display_comment_form_or_template() {
		$do_use_comment_form = apply_filters( 'awp_use_unstyled_comment_form', false );
		if ( $do_use_comment_form ) {
			comment_form();
		} else {
			comments_template();
		}
	}

	public static function the_breadcrumbs() {
		global $post;
		if ( ! isset( $post ) ) {
			return;
		}
		if ( self::current_post_has_parent() ) {
			self::echo_breadcrumbs();
		}
	}

	public static function current_post_has_parent() {
		$post_parent_id = wp_get_post_parent_id( get_the_ID() );
		return ( ( false !== $post_parent_id ) && ( 0 !== $post_parent_id ) );
	}

	// @todo: refactor into content-breadcrumbs.php
	public static function echo_breadcrumbs() {
		?>
			<ol class="breadcrumb">
				<li><a href="<?php echo esc_url( get_home_url() ); ?>">Home</a></li>
				<li><?php self::echo_post_parent_for_breadcrumb(); ?></li>
				<li class="active"><?php the_title(); ?></li>
			</ol>
		<?php
	}

	public static function echo_post_parent_for_breadcrumb() {
		global $post;
		$post_parent = get_post( $post->post_parent );

		if ( self::post_is_only_a_placeholder_and_has_no_content( $post_parent ) ) {
			echo get_the_title( $post_parent );
		} else {
			self::echo_post_title_wrapped_in_a_link( $post_parent );
		}
	}

	public static function post_is_only_a_placeholder_and_has_no_content( $post_parent ) {
		return ( property_exists( $post_parent, 'post_content' ) && ( '' === $post_parent->post_content ) );
	}

	public static function echo_post_title_wrapped_in_a_link( $post_parent ) {
		$parent_title = get_the_title( $post_parent );
		$parent_link = get_permalink( $post_parent );
		echo '<a href="' . esc_url( $parent_link ) . '" title="' . esc_attr( $parent_title ) . '">'
			. esc_html( $parent_title )
			. '</a>';
	}

	public static function maybe_echo_edit_link() {
		if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
			edit_post_link( '<span class="pull-right glyphicon glyphicon-edit"></span>' );
		}
	}

}
