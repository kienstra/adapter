<?php
/*
Filters and hooks documented in readme.txt
*/

define( 'AWP_THEME_SLUG' , 'adapter-wp' );
define( 'AWP_THEME_VERSION' , '1.0.6
' );

include_once( get_template_directory() . '/includes/awp-customizer.php' );
include_once( get_template_directory() . '/includes/awp-admin-menu.php' );
include_once( apply_filters( 'awp_navwalker_path' , get_template_directory() . '/includes/wp_bootstrap_navwalker.php' ) );

add_action('after_setup_theme', 'awp_theme_text_domain');
function awp_theme_text_domain() {
	load_theme_textdomain( 'adapter-wp' , get_template_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'awp_theme_support_setup' );
function awp_theme_support_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'aside', 'image',
							'video', 'quote', 'link' )
	);
	$custom_header_defaults = array(
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
  		'flex-width'             => true,
		'uploads'                => true,
	);
	add_theme_support( 'custom-header' , $custom_header_defaults );
}

add_action( 'after_setup_theme', 'awp_editor_styles' );
function awp_editor_styles() {
	$style_path = apply_filters( 'awp_editor_style_path' , '' );
	if ( $style_path ) {
		add_editor_style( esc_url( $style_path ) );
	}
}

add_action( 'wp_enqueue_scripts', 'awp_enqueue_styles' );
function awp_enqueue_styles() {
	$primary_bootstrap_css_path = apply_filters( 'awp_primary_bootstrap_css_path' , get_template_directory_uri() . '/bootstrap/css/bootstrap-basic.min.css' );
	$second_bootstrap_css_path = apply_filters( 'awp_second_bootstrap_css_path' , '' );

	// MIT License : https://github.com/twbs/bootstrap/blob/master/LICENSE
	wp_enqueue_style( AWP_THEME_SLUG . '-primary-bootstrap-css' , $primary_bootstrap_css_path , '' , AWP_THEME_VERSION );
	if ( $second_bootstrap_css_path ) {
		awp_enqueue_file_followed_by_style_css( $second_bootstrap_css_path );
	} else {
		awp_only_enqueue_style_css();
	}
	wp_enqueue_style( AWP_THEME_SLUG . '-print-css' , get_template_directory_uri() . '/print.css' , '' , AWP_THEME_VERSION , 'print' );
}

function awp_enqueue_file_followed_by_style_css( $second_bootstrap_css_path ) {
		wp_enqueue_style( AWP_THEME_SLUG . '-second-bootstrap-css' , $second_bootstrap_css_path , array( AWP_THEME_SLUG . '-primary-bootstrap-css' ) , AWP_THEME_VERSION );
		wp_enqueue_style( AWP_THEME_SLUG . '-main-css' , get_stylesheet_uri() , array( AWP_THEME_SLUG . '-second-bootstrap-css' ) , AWP_THEME_VERSION );
}

function awp_only_enqueue_style_css() {
	wp_enqueue_style( AWP_THEME_SLUG . '-main-css' , get_stylesheet_uri() , array( AWP_THEME_SLUG . '-primary-bootstrap-css' ) , AWP_THEME_VERSION );
}

add_action( 'wp_enqueue_scripts', 'awp_enqueue_js' );
function awp_enqueue_js() {
	global $wp_scripts;

	wp_register_script( AWP_THEME_VERSION . '-html5-shiv' , get_template_directory() . '/js/html5shiv.js' , array() , AWP_THEME_VERSION , false );
	$wp_scripts->add_data( AWP_THEME_VERSION . '-html5-shiv' , 'conditional' , 'lt IE 9' );

	wp_register_script( AWP_THEME_VERSION . '-respond-js' , get_template_directory() . '/js/respond.min.js' , array() , AWP_THEME_VERSION , false );
	$wp_scripts->add_data( AWP_THEME_VERSION . '-respond-js' , 'conditional' , 'lt IE 9' );

	wp_enqueue_script( 'jquery' );

	// MIT License : https://github.com/twbs/bootstrap/blob/master/LICENSE
	$main_bootstrap_js_path = apply_filters( 'awp_js_for_bootstrap' , get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js' );
	wp_enqueue_script( 'bootstrap_js' , $main_bootstrap_js_path , array( 'jquery' ) , AWP_THEME_VERSION , true );
	wp_enqueue_script( AWP_THEME_SLUG . '-third-level-menu' , get_template_directory_uri() . '/js/awp-third-level-menu' , array( 'jquery' ) ,  AWP_THEME_VERSION , true );
}

function awp_the_classes_of_first_top_navbar() {
	// 'navbar-fixed-top' fixes navbar
	$type = apply_filters( 'awp_classes_of_first_top_navbar' , 'navbar-default top-navbar navbar-static-top' );
	echo 'navbar navbar-first-top ' . esc_attr( $type );
}

function awp_the_classes_of_second_top_navbar() {
	$type = apply_filters( 'awp_classes_of_second_top_navbar' , 'navbar-default navbar-static-top' );
	echo 'navbar navbar-second-top ' . esc_attr( $type );
}

function awp_the_classes_of_bottom_navbar() {
	$classes = apply_filters( 'awp_classes_of_bottom_navbar' , 'navbar-default navbar-static-bottom' );
	echo 'navbar ' . esc_attr( $classes );
}

add_action( 'after_setup_theme', 'awp_menu_setup' );
function awp_menu_setup() {
	register_nav_menu( 'awp_main_menu' , __( 'Main Menu', 'adapter-wp' ) );
}

add_action( 'after_setup_theme' , 'awp_set_content_width' );
function awp_set_content_width() {
	if ( ! isset( $content_width ) ) {
		$content_width = 600;
	}
}

add_filter( 'wp_title' , 'awp_fallback_title_for_home' , 11 );
function awp_fallback_title_for_home( $title ) {
	if ( ( "" == $title ) && ( is_home() || is_front_page() ) ) {
		return get_bloginfo( 'name' );
	}
	return $title;
}

if ( ! function_exists( 'awp_maybe_get_top_nav' ) ) {
	function awp_maybe_get_top_nav() {
		if ( awp_should_page_have_top_and_bottom_navs() ) {
			awp_maybe_get_top_banner_parts();
			get_template_part( 'navbar-top' );
		}
	}
}

if ( ! function_exists( 'awp_should_page_have_top_and_bottom_navs' ) ) {
	function awp_should_page_have_top_and_bottom_navs() {
		if ( is_page() && ( false != strpos( get_page_template() , 'no-nav' ) ) ) {
			return false;
		}
		return true;
	}
}

if ( ! function_exists( 'awp_maybe_get_top_banner_parts' ) ) {
	function awp_maybe_get_top_banner_parts() {
		$do_get_top_banner = apply_filters( 'awp_do_get_top_banner' , true );
		if ( $do_get_top_banner ) {
			get_template_part( 'top-banner' );
		}
	}
}

if ( ! function_exists( 'awp_the_top_banner_backround_alignment' ) ) {
	function awp_the_top_banner_backround_alignment() {
		$alignment = apply_filters( 'awp_top_banner_backround_alignment' , 'center' );
		echo esc_attr( $alignment );
	}
}

if( ! function_exists( 'awp_maybe_get_bottom_nav' ) ) {
	function awp_maybe_get_bottom_nav() {
		$top_and_bottom_navs_allowed = awp_should_page_have_top_and_bottom_navs();
		$do_get_bottom_nav = apply_filters( 'awp_do_get_bottom_nav' , $top_and_bottom_navs_allowed );
		if ( $do_get_bottom_nav ) {
			get_template_part( 'navbar-bottom' );
		}
	}
}

if ( ! function_exists( 'awp_the_top_nav_menu' ) ) {
	function awp_the_top_nav_menu() {
		$menu_name = 'awp_main_menu';
		wp_nav_menu( array(
			'menu'           => $menu_name ,
			'theme_location' => $menu_name ,
			'depth'   	 => 3 ,
			'container' 	 => false ,
			'menu_class' 	 => 'nav navbar-nav' ,
			'fallback_cb' 	 => 'WP_Bootstrap_Navwalker::fallback',
			'walker' 	 => new WP_Bootstrap_Navwalker() ,
		) );
	}
}

add_action( 'comment_form' , 'awp_maybe_enqueue_comment_reply' );
function awp_maybe_enqueue_comment_reply() {
	if ( comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );

if ( ! function_exists( 'awp_simple_copyright' ) ) {
	function awp_simple_copyright() {
		$name = apply_filters( 'awp_name_next_to_copyright_in_footer' , get_bloginfo( 'admin' ) );
		echo esc_html( "&copy;&nbsp;" . $name . "&nbsp;" . date( 'Y' ) );
	}
}

function awp_the_bottom_copyright_classes() {
	echo apply_filters( 'awp_bottom_copyright_classes' , '' );
}

if ( ! function_exists( 'awp_paginate_links' ) ) {
	function awp_paginate_links() {
		global $wp_query;
		$awp_big = 999999999;

		$pagination_args = array(
			'base' => str_replace( $awp_big, '%#%', esc_url( get_pagenum_link( $awp_big ) ) ),
			'format'    => '/page/%#%',
			'type' 	    => 'array' ,
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'	    => $wp_query->max_num_pages,
			'prev_next' => True,
			'prev_text' => sprintf( __( '%sNewer' , 'adapter-wp' ) , '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' ) ,
			'next_text' => sprintf( __( 'Older%s' , 'adapter-wp' ) , '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ) ,
		);

		$pagination = paginate_links( $pagination_args );
		$pagination_size = apply_filters( 'awp_pagination_size' , '' );

		?>
		<ul class="pagination pagination-<?php echo $pagination_size; ?>">
		<?php
		if ( $pagination ) {
			foreach ( $pagination as $page ) {
				$has_href = ( false !== strpos( $page , 'href' ) ); 
				$class = $has_href ? 'active' : 'disabled';
				echo '<li class="' . esc_attr( $class ) . '">'
				   .	     $page 
				   . '</li>';
			}
		}
		?>
		</ul>
	<?php
	}
}

if ( ! function_exists( 'awp_custom_wp_link_pages' ) ) {
	function awp_custom_wp_link_pages() {
		$awp_link_pages_args = array(
			'before' => '<ul class="pagination">' ,
			'after'	 => '</ul>' ,
			'link_before' => '<li>' ,
			'link_after' => '</li>' ,
			'previouspagelink' => sprintf( __( '%sBack' , 'adapter-wp' ) , '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' ) ,
			'nextpagelink' => sprintf( __( 'Next%s' , 'adapter-wp' ) , '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ) ,
			'next_or_number' => 'next' ,
		);
		wp_link_pages( $awp_link_pages_args );
	}
}

add_filter( 'wp_link_pages_link' , 'awp_pages_link_filter' );
function awp_pages_link_filter( $link_markup ) {
	$regex = '/(<a[^>]*?>).*?(<li[^>]??>)(.*)/';
	$replace_with = '$2$1$3';
	$filtered_markup = preg_replace( $regex , $replace_with , $link_markup );
	return $filtered_markup;
}

if ( ! function_exists( 'awp_author_date_category_tag' ) ) {
	function awp_author_date_category_tag() {
		global $post;
		$post_date = get_the_time( get_option( 'date_format' ) );
		if ( '' == $post->post_title ) {
		        // The post has no title, so make the date a link to the post page
			$post_date = '<a href="' . esc_url( get_the_permalink() ) . '">' 
				   .         esc_html( $post_date )
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
						the_tags( '' , ', ' , '' );
					}
				?>
			</em>
		<?php
	}
}

if ( ! function_exists( 'awp_register_sidebar' ) ) {
	function awp_register_sidebar($name, $id, $description ) {
		register_sidebar(array(
			'name'		=> sprintf( __( '%s' , 'adapter-wp' ) , $name ) ,
			'id'		=> $id ,
		 	'description'	=> sprintf( __( '%s' , 'adapter-wp' ) , $description ) ,
		 	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
		 	'after_widget'	=> '</div> ' ,
		 	'before_title'	=> '<h2>' ,
		 	'after_title'	=> '</h2>' ,
		) );
	}
}

add_action( 'widgets_init', 'awp_widgets_init' );
function awp_widgets_init() {
	awp_register_sidebar( 'Main Sidebar' , 'main_sidebar', 'Diplays on selected pages' );
}

add_filter( 'upload_mimes', 'awp_mime_types' );
function awp_mime_types( $mimes ){
	 $mimes['svg'] = 'image/svg+xml';
	 return $mimes;
}

add_filter( 'comment_reply_link' , 'awp_reply_link' );
function awp_reply_link( $link_class ) {
	$comment_reply_classes = apply_filters( 'awp_comment_reply_classes' , 'btn btn-primary btn-med' );
	$link_class = str_replace( "class='comment-reply-link" , "class='comment-reply-link <?php echo $comment_reply_classes; ?>" , $link_class );
	return $link_class;
}

if ( ! function_exists( 'awp_comment_list' ) ) {
	function awp_comment_list( $comment , $arguments , $depth ) {
		$_GLOBALS[ 'comment' ] = $comment;
		?>
		<li <?php echo comment_class( 'media' ); ?> id="comment-<?php echo comment_ID() ?>">
		<article>
			<div class="meta-comment pull-left">
				<?php echo get_avatar( $comment , 96 ); ?>
			</div>
			<div class="content-comment media-body">
				<p class="date-comment pull-right text-right text-muted">
		<?php echo human_time_diff( get_comment_time( 'U' ) , current_time( 'timestamp' ) ); ?> ago &nbsp;
		<a class="permalink-comment" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="Comment link">
			<span class="glyphicon glyphicon-ink"></span>
		</a>
				</p>
				<?php if ( '0' == $comment->comment_approved ) : ?>
		<em>
			<?php _e( 'The comment is in the queue for moderation' , 'adapter-wp' ); ?>
		</em>
				<?php else : ?>
		<p><?php echo comment_author_link(); ?></p>
		<?php comment_text(); ?>
		<div class="reply-comment pull-right">
			<?php comment_reply_link( array_merge( $arguments , array(
				 'reply_text' => '<span class="glyphicon glyphicon-edit"></span> &nbsp; Reply' ,
				 'depth'		 =>	 $depth ,
				 'max_depth' =>	 $arguments[ 'max_depth' ] ,
			) ) );
			?>
		</div>
				<?php endif; ?>
			</div> <!-- content-comment -->
		</article>
	<?php
	}
}

add_filter( 'get_avatar' , 'awp_class_avatar' );
function awp_class_avatar( $avatar_class ) {
	$avatar_class = str_replace( "class='avatar" , "class='avatar img-circle img-responsive media-object" , $avatar_class );
	return $avatar_class;
}

if ( ! function_exists( 'awp_echo_pages_list_group' ) ) {
	function awp_echo_pages_list_group() { 
		$pages = get_pages();	
		echo '<div class="list-group">';
		foreach( $pages as $page ) {
			echo '<a class="list-group-item" href="' . esc_url( get_permalink( $page->ID ) ) . '">'
			   .	     esc_html( $page->post_title )
			   . '</a>';
		}
		echo '</div>';
	}
}

if ( ! function_exists( 'awp_echo_posts_list_group' ) ) {
        function awp_echo_posts_list_group() { 
		$arguments = array(
				   'numberposts' => '10' ,
				   'post_status' => 'publish'
		);
		$recent_posts = wp_get_recent_posts( $arguments );

		echo '<div class="list-group">';
		foreach( $recent_posts as $post ) {
			 echo '<a class="list-group-item" href="' . esc_attr( get_permalink( $post[ "ID" ] ) ) . '">'
			    .	      esc_html( $post[ "post_title" ] )
			    . '</a>';
		}
		echo '</div>'; // .list-group
	}
}

add_filter( 'get_image_tag_class' , 'awp_image_tag_class_filter' );
function awp_image_tag_class_filter( $classes ) {
	return $classes . ' img-responsive';
}

add_filter( 'widget_archives_args' , 'awp_limit_archives_count' );
function awp_limit_archives_count( $args ) {
	$args[ 'limit' ] = '6';
	return $args;
}

add_filter( 'widget_categories_args' , 'awp_widget_categories_filter' );
function awp_widget_categories_filter( $args ) {
	$args[ 'number' ] = 6;
	$args[ 'orderby' ] = 'count';
	$args[ 'order' ] = 'DESC';
	return $args;
}

add_filter( 'the_content' , 'awp_add_clearfix_to_end_of_content' , 1 );
function awp_add_clearfix_to_end_of_content( $content ) {
	return $content . "<div class='clearfix'></div>";
}

if ( ! function_exists( 'awp_query_for_page_content' ) ) {
	function awp_query_for_page_content() {
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			 get_template_part( 'content' , 'page' );
		 endwhile; else :
			get_template_part( 'no-post-found' );
			get_template_part( 'awp-posts-and-pages' );
		endif;
		wp_reset_query();
	}
}

if ( ! function_exists( 'awp_query_for_post_previews' ) ) {
	function awp_query_for_post_previews() {
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
	get_template_part( 'content' , 'post-preview' );
			endwhile;
			awp_paginate_links();
		else :
			get_template_part( 'no-post-found' );
			get_template_part( 'awp-posts-and-pages' );
			wp_reset_query();
		endif;
	}
}


// add_filter( 'comments_open' , 'awp_only_allow_comments_on_single_post_page' );
function awp_only_allow_comments_on_single_post_page( $are_comments_open ) {
	global $post;
	if ( isset( $post ) && ( 'post' == $post->post_type ) && ( is_single( $post->ID ) ) ) {
		return true ;
	}
}

function awp_display_comment_form_or_template() {
	$do_use_comment_form = apply_filters( 'awp_use_unstyled_comment_form' , false );
	if ( $do_use_comment_form ) {
		comment_form();
	} else {
		comments_template();
	}
}

if ( ! function_exists( 'awp_the_breadcrumbs' ) ) {
	function awp_the_breadcrumbs() {
		global $post;
		if ( ! isset( $post ) ) {
			return;
		}
		if ( awp_current_post_has_parent() ) {
			awp_echo_breadcrumbs();
		}
	}
}

function awp_current_post_has_parent() {
	global $post;
	$parent_title = get_the_title( $post->post_parent );
	return ( $parent_title != the_title( "" , "" , false ) );
}

if ( ! function_exists( 'awp_echo_breadcrumbs' ) ) {
	function awp_echo_breadcrumbs() {
		global $post;
		?>
			<ol class="breadcrumb">
	<li><a href="<?php echo home_url(); ?>">Home</a></li>
	<li><?php awp_echo_post_parent_for_breadcrumb(); ?></li>
	<li class="active"><?php the_title(); ?></li>
			</ol>
		<?php
	}
}

if ( ! function_exists( 'awp_echo_post_parent_for_breadcrumb' ) ) {
	function awp_echo_post_parent_for_breadcrumb() {
		global $post;
		$post_parent = get_post( $post->post_parent );

		if ( awp_post_is_only_a_placeholder_and_has_no_content( $post_parent ) ) {
			echo get_the_title( $post_parent );
		} else {
			awp_echo_post_title_wrapped_in_a_link( $post_parent );
		}
	}
}

function awp_post_is_only_a_placeholder_and_has_no_content( $post_parent ) {
	return ( "" == $post_parent->post_content );
}

function awp_echo_post_title_wrapped_in_a_link( $post_parent ) {
	$parent_title = get_the_title( $post_parent );
	$parent_link = get_permalink( $post_parent );
	echo '<a href="' . esc_url( $parent_link ) . '" title="' . esc_attr( $parent_title ) . '">'
	   .	     esc_html( $parent_title )
	   . '</a>';
}

if ( ! function_exists( 'awp_maybe_echo_edit_link' ) ) {
	function awp_maybe_echo_edit_link() {
		if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
			edit_post_link( '<span class="pull-right glyphicon glyphicon-edit"></span>' );
		}
	}
}