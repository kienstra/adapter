<?php
/*
Filters and hooks documented in readme.txt
*/


define( 'AWP_THEME_SLUG' , 'adapter-wp' ) ;
define( 'AWP_THEME_VERSION' , '1.0.0' ) ; 

add_action('after_setup_theme', 'awp_theme_text_domain');
function awp_theme_text_domain() { 
  load_theme_textdomain( 'adapter-wp' , get_template_directory() . '/languages' ) ;
}

add_action( 'after_setup_theme', 'awp_theme_support_setup' ) ;
function awp_theme_support_setup() {
  add_theme_support( 'automatic-feed-links' ) ;
  add_theme_support( 'menus' ) ;
  add_theme_support( 'post-thumbnails' ) ;
  add_theme_support( 'custom-header' ) ;  
  add_theme_support( 'post-formats', array( 'aside', 'image',
					    'video', 'quote', 'link' ) ) ;
  $custom_header_defaults = array(
    'height' => '250px ' ,
  ) ;
  add_theme_support( 'custom-header' , $custom_header_defaults ) ;
}

add_action( 'after_setup_theme', 'awp_editor_styles' ) ;
function awp_editor_styles() {
  $style_path = apply_filters( 'awp_editor_style_path' , '' ) ;
  if ( $style_path ) {
    add_editor_style( esc_url( $style_path ) ) ;
  }
}

add_action( 'wp_enqueue_scripts', 'awp_enqueue_styles' ) ;
function awp_enqueue_styles() {
  $primary_bootstrap_css_path = apply_filters( 'awp_primary_bootstrap_css_path' , get_template_directory_uri() . '/bootstrap/css/bootstrap-basic.min.css' ) ;
  $second_bootstrap_css_path = apply_filters( 'awp_second_bootstrap_css_path' , '' ) ;  

  // MIT License : https://github.com/twbs/bootstrap/blob/master/LICENSE
  wp_enqueue_style( AWP_THEME_SLUG . '-primary-bootstrap-css' , $primary_bootstrap_css_path , '' , AWP_THEME_VERSION ) ;
  if ( $second_bootstrap_css_path ) {
    awp_enqueue_file_followed_by_style_css( $second_bootstrap_css_path ) ;
  } else {
    awp_only_enqueue_style_css() ;
  }
  wp_enqueue_style( AWP_THEME_SLUG . '-print-css' , get_template_directory_uri() . '/print.css' , '' , AWP_THEME_VERSION , 'print' ) ;
}

function awp_enqueue_file_followed_by_style_css( $second_bootstrap_css_path ) {
    wp_enqueue_style( AWP_THEME_SLUG . '-second-bootstrap-css' , $second_bootstrap_css_path , array( AWP_THEME_SLUG . '-primary-bootstrap-css' ) , AWP_THEME_VERSION ) ;
    wp_enqueue_style( AWP_THEME_SLUG . '-main-css' , get_stylesheet_uri() , array( AWP_THEME_SLUG . '-second-bootstrap-css' ) , AWP_THEME_VERSION ) ;        
}

function awp_only_enqueue_style_css() {
  wp_enqueue_style( AWP_THEME_SLUG . '-main-css' , get_stylesheet_uri() , array( AWP_THEME_SLUG . '-primary-bootstrap-css' ) , AWP_THEME_VERSION ) ;
}

add_action( 'wp_enqueue_scripts', 'awp_enqueue_js' ) ;
function awp_enqueue_js() { 
  global $wp_scripts ;
  
  wp_register_script( 'html5_shiv' , 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js' , '' , AWP_THEME_VERSION , false ) ;
  $wp_scripts->add_data( 'html5_shiv' , 'conditional' , 'lt IE 9' ) ;
  
  wp_register_script( 'respond_js' , 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js' , '' , AWP_THEME_VERSION , false ) ;
  $wp_scripts->add_data( 'respond_js' , 'conditional' , 'lt IE 9' ) ;
  
  wp_enqueue_script( 'jquery' ) ;

  // MIT License : https://github.com/twbs/bootstrap/blob/master/LICENSE  
  $main_bootstrap_js_path = apply_filters( 'awp_js_for_bootstrap' , get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js' ) ;
  wp_enqueue_script( 'bootstrap_js' , $main_bootstrap_js_path , array( 'jquery' ) , AWP_THEME_VERSION , true ) ;
}

function awp_the_classes_of_first_top_navbar() {
  // 'navbar-fixed-top' fixes navbar 
  $type = apply_filters( 'awp_classes_of_first_top_navbar' , 'navbar navbar-default top-navbar navbar-static-top' ) ;
  echo esc_attr( $type ) ;
}

function awp_the_classes_of_second_top_navbar() {
  $type = apply_filters( 'awp_classes_of_second_top_navbar' , 'navbar navbar-default navbar-static-top' ) ;
  echo esc_attr( $type ) ;
}

add_action( 'after_setup_theme', 'awp_menu_setup' ) ;
function awp_menu_setup() {
  register_nav_menu( 'awp_main_menu' , __( 'Main Menu', 'adapter-wp' ) ) ;
}


include_once( apply_filters( 'awp_navwalker_path' , get_template_directory() . '/inc/wp_bootstrap_navwalker.php' ) ) ;

if ( ! function_exists( 'awp_maybe_get_top_nav' ) ) {
  function awp_maybe_get_top_nav() {
    if ( should_page_have_top_and_bottom_navs() ) { 
      get_template_part( 'navbar-top' ) ;
      awp_maybe_get_top_banner_parts() ;
    }
  }
}

if ( ! function_exists( 'should_page_have_top_and_bottom_navs' ) ) {
  function should_page_have_top_and_bottom_navs() {
    if ( is_page() && ( strpos( get_page_template() , 'no-nav' ) ) ) {
      return false ;    
    }
    return true ;
  }
}

if ( ! function_exists( 'awp_maybe_get_top_banner_parts' ) ) { 
  function awp_maybe_get_top_banner_parts() {
    $do_get_top_banner = apply_filters( 'awp_do_get_top_banner' , true ) ;
    if ( $do_get_top_banner ) { 
      get_template_part( 'top-banner' ) ;
    }
  }
}

if ( ! function_exists( 'awp_the_top_banner_backround_alignment' ) ) { 
  function awp_the_top_banner_backround_alignment() {
    $alignment = apply_filters( 'awp_top_banner_backround_alignment' , 'center' ) ;
    echo esc_attr( $alignment ) ;
  }
}

if( ! function_exists( 'awp_maybe_get_bottom_nav' ) ) {
  function awp_maybe_get_bottom_nav() {
    $top_and_bottom_navs_allowed = should_page_have_top_and_bottom_navs() ;
    $do_get_bottom_nav = apply_filters( 'awp_do_get_bottom_nav' , $top_and_bottom_navs_allowed ) ;
    if ( $do_get_bottom_nav ) {
      get_template_part( 'navbar-bottom' ) ;
    }
  }
}

if ( ! function_exists( 'awp_the_top_nav_menu' ) ) { 
  function awp_the_top_nav_menu() {
    $menu_name = 'awp_main_menu' ;
    wp_nav_menu( array( 
      'menu' => $menu_name ,
      'theme_location' => $menu_name , 
      'depth' => 2 ,
      'container' => false ,
      'menu_class' => 'nav navbar-nav' ,
      'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
      'walker' => new wp_bootstrap_navwalker() ,
    ) ) ;
  }
}
  
if ( ! isset( $content_width ) ) {
   $content_width = 600 ;
}

add_action( 'comment_form' , 'awp_maybe_enqueue_comment_reply' ) ;  
function awp_maybe_enqueue_comment_reply() {
  if ( comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' ) ;
  }
}

remove_action( 'wp_head', 'rsd_link' ) ;
remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;

add_filter( 'login_errors', 'awp_error_message_no_details' ) ;
function awp_error_message_no_details( $message ) {
  $message = 'Sorry, please try again.' ;
  return $message ;
}


if ( ! function_exists( 'awp_simple_copyright' ) ) { 
  function awp_simple_copyright() {
    $name = apply_filters( 'awp_name_next_to_copyright_in_footer' , sprintf( __( '%s' , 'adapter-wp' ) , get_bloginfo( 'admin' ) ) ) ; 
    echo "&copy;" . " " . $name . " " . date( 'Y' ) ;
  }
}

function awp_the_bottom_copyright_classes() {
  echo apply_filters( 'awp_bottom_copyright_classes' , '' ) ; 
}

if ( ! function_exists( 'awp_paginate_links' ) ) {
  function awp_paginate_links() {
    global $wp_query ;
    $awp_big = 999999999 ;    

    $pagination_args = array( 
      'base' => str_replace( $awp_big, '%#%', esc_url( get_pagenum_link( $awp_big ) ) ),
      'format' => '/page/%#%',
      'type' => 'array' ,
      'current' => max( 1, get_query_var( 'paged' ) ),
      'total'  => $wp_query->max_num_pages,
      'prev_next' => True,
      'prev_text' => sprintf( __( '%sNewer' , 'adapter-wp' ) , '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' ) ,
      'next_text' => sprintf( __( 'Older%s' , 'adapter-wp' ) , '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ) ,
    ) ;
    
    $pagination = paginate_links( $pagination_args ) ;
    $pagination_size = apply_filters( 'awp_pagination_size' , '' ) ;
    
    ?>
    <ul class="pagination pagination-<?php echo $pagination_size ; ?>">
    <?php
    if ( $pagination ) {
      foreach ( $pagination as $page ) {
      $class = strpos( $page , 'href' ) ? 'active' : 'disabled' ;
	echo " <li class='$class'>$page</li> " ;
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
      'after'  => '</ul>' ,
      'link_before' => '<li>' ,
      'link_after' => '</li>' ,
      'previouspagelink' => sprintf( __( '%sBack' , 'adapter-wp' ) , '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' ) ,
      'nextpagelink' => sprintf( __( 'Next%s' , 'adapter-wp' ) , '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ) ,
      'next_or_number' => 'next' ,
    ) ; 
    wp_link_pages( $awp_link_pages_args ) ;
  }
}

add_filter( 'wp_link_pages_link' , 'awp_pages_link_filter' ) ;
function awp_pages_link_filter( $link_markup ) {
  $regex = '/(<a[^>]*?>).*?(<li[^>]??>)(.*)/' ;
  $replace_with = '$2$1$3' ; 
  $filtered_markup = preg_replace( $regex , $replace_with , $link_markup ) ;
  return $filtered_markup ;
}

if ( ! function_exists( 'awp_author_date_category_tag' ) ) { 
  function awp_author_date_category_tag() {
    global $post ;
    $post_date = get_the_time( get_option( 'date_format' ) ) ;
    if ( '' == $post->post_title ) {
      $post_date = '<a href="' . get_the_permalink() . '">' . $post_date . '</a>' ; 
    }
    ?>
      <em>
	By:
	<?php the_author() ; ?>
	on:
       <?php echo $post_date ; 
        if ( has_category() ) {
  	  echo "&nbsp;in:&nbsp;" ;
	  the_category( ', ' ) ;
        }
        if ( has_tag() )  {
	  echo ', ' ; 
        }
        the_tags( '' , ', ' , '' ) ; ?>
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
	   'before_widget'	=> '<div id="%1$s" class="widget %2$s">' ,
	   'after_widget'	=> '</div> ' ,
	   'before_title'	=> '<h2>' ,
	   'after_title'	=> '</h2>' ,
    ) ) ;
  }
}
  
add_action( 'widgets_init', 'awp_widgets_init' ) ; 
function awp_widgets_init() { 
  awp_register_sidebar( 'Main Sidebar' , 'main_sidebar', 'Diplays on selected pages' ) ;
}

add_filter( 'upload_mimes', 'awp_mime_types' );
function awp_mime_types( $mimes ){
	 $mimes['svg'] = 'image/svg+xml';
	 return $mimes;
}

add_filter( 'comment_reply_link' , 'awp_reply_link' ) ;
function awp_reply_link( $link_class ) {
  $comment_reply_classes = apply_filters( 'awp_comment_reply_classes' , 'btn btn-primary btn-med' ) ; 
  $link_class = str_replace( "class='comment-reply-link" , "class='comment-reply-link <?php echo $comment_reply_classes ; ?>" , $link_class ) ;
  return $link_class ;
}

if ( ! function_exists( 'awp_comment_list' ) ) { 
  function awp_comment_list( $comment , $arguments , $depth ) {
    $_GLOBALS[ 'comment' ] = $comment ;
    ?>
    <li <?php echo comment_class( 'media' ) ; ?> id="comment-<?php echo comment_ID() ?>">
	  <article>
	    <div class="meta-comment pull-left"> 
	      <?php echo get_avatar( $comment , 96 ) ; ?>
	    </div> 
	    <div class="content-comment media-body">
	      <p class="date-comment pull-right text-right text-muted">
		<?php echo human_time_diff( get_comment_time( 'U' ) , current_time( 'timestamp' ) ) ; ?> ago &nbsp;
		<a class="permalink-comment" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ; ?>" title="Comment link">
		  <span class="glyphicon glyphicon-ink"></span>
		</a>
	      </p>
	      <?php if ( '0' == $comment->comment_approved ) : ?>	    
		<em>
		  <?php _e( 'The comment is in the queue for moderation' , 'adapter-wp' ) ; ?>
		</em>
	      <?php else : ?>
		<p><?php echo comment_author_link() ; ?></p>
		<?php comment_text() ; ?>             
		<div class="reply-comment pull-right">
		  <?php comment_reply_link( array_merge( $arguments , array(
		     'reply_text' => '<span class="glyphicon glyphicon-edit"></span> &nbsp; Reply' ,
		     'depth'     =>  $depth ,
		     'max_depth' =>  $arguments[ 'max_depth' ] ,
		  ) ) ) ;
		  ?>
		</div>
	      <?php endif ; ?>
	    </div> <!-- content-comment -->
	  </article>
  <?php
  }
}

add_filter( 'get_avatar' , 'awp_class_avatar' ) ;
function awp_class_avatar( $avatar_class ) {
  $avatar_class = str_replace( "class='avatar" , "class='avatar img-circle img-responsive media-object" , $avatar_class ) ;
  return $avatar_class ;
}

if ( ! function_exists( 'awp_echo_list_group_of_pages' ) ) { 
  function awp_echo_list_group_of_pages( $posts ) {
    echo '<div class="list-group">' ;	   
    foreach( $posts as $post ) {             
      echo '<a class="list-group-item" href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a>' ;
    }
    echo '</div>' ;
  }
}

add_filter( 'get_image_tag_class' , 'awp_image_tag_class_filter' ) ;
function awp_image_tag_class_filter( $classes ) {
  return $classes . ' img-responsive' ;
}

add_filter( 'widget_archives_args' , 'awp_limit_archives_count' ) ; 
function awp_limit_archives_count( $args ) {
  $args[ 'limit' ] = '6' ;
  return $args ; 
}

add_filter( 'widget_categories_args' , 'awp_widget_categories_filter' ) ;
function awp_widget_categories_filter( $args ) {
  $args[ 'number' ] = 6 ;
  $args[ 'orderby' ] = 'count' ;      
  $args[ 'order' ] = 'DESC' ;
  return $args ; 
}

if ( ! function_exists( 'awp_query_for_page_content' ) ) { 
  function awp_query_for_page_content() {
    if ( have_posts() ) :  while ( have_posts() ) : the_post() ; 
       get_template_part( 'content' , 'page' ) ;
     endwhile ; else : 
      get_template_part( 'no-post-found' ) ; 
      get_template_part( 'awp-posts-and-pages' ) ; 
    endif; 
    wp_reset_query() ;
  }
}

if ( ! function_exists( 'awp_query_for_post_previews' ) ) {
  function awp_query_for_post_previews() {     
    if ( have_posts() ) :
      while ( have_posts() ) :
	the_post() ;
	get_template_part( 'content' , 'post-preview' ) ;
      endwhile;
      awp_paginate_links() ;                      
    else :
      get_template_part( 'no-post-found' ) ; 
      get_template_part( 'awp-posts-and-pages' ) ;
      wp_reset_query() ; 
    endif ; 
  }
}


// add_filter( 'comments_open' , 'awp_only_allow_comments_on_single_post_page' ) ; 
function awp_only_allow_comments_on_single_post_page( $are_comments_open ) {
  global $post ; 
  if ( isset( $post ) && ( 'post' == $post->post_type ) && ( is_single( $post->ID ) ) ) { 
    return true  ; 
  }
}

function awp_display_comment_form_or_template() {
  $do_use_comment_form = apply_filters( 'awp_use_unstyled_comment_form' , false ) ;
  if ( $do_use_comment_form ) {
    comment_form() ;
  } else {
    comments_template() ;
  }
}

add_action( 'customize_register' , 'awp_change_customizer_sections' ) ;
function awp_change_customizer_sections( $wp_customize ) {
  $wp_customize->get_section( 'header_image' )->title = __( 'Top Banner' , 'adapter-wp' ) ; 
  $wp_customize->remove_section( 'colors' ) ;
  $wp_customize->remove_section( 'background_image' ) ;
  $wp_customize->remove_section( 'nav' ) ;
  $wp_customize->remove_section( 'static_front_page' ) ;
}

add_action( 'customize_register' , 'awp_add_customizer_sections' ) ;
function awp_add_customizer_sections( $wp_customize ) {

  $wp_customize->add_section( 'top_banner' , array(
    'title' => __( 'Top Banner' , 'adapter-wp' ) ,
    'priority' => '3'
  ) ) ;

  $wp_customize->add_setting( 'awp_banner_background_color' , array(
    'default'    =>  'F8F8F8' ,
    'capability' => 'edit_theme_options' ,
    'transport'  => 'postMessage' ,
  ) ) ;

  $wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize ,
    'banner_background_color' ,
    array(
      'label' => __( 'Header Backround Color' , 'adapter-wp' ) ,
      'section' => 'header_image' ,
      'settings' => 'awp_banner_background_color' ,
    )
  ) ) ;

  $wp_customize->add_setting( 'awp_banner_image' , array(
    'default'    =>  '' ,
    'capability' => 'edit_theme_options' ,
    'transport'  => 'postMessage' ,
  ) ) ;
  
  $wp_customize->add_control( new WP_Customize_Header_Image_Control(
    $wp_customize ,
    'header_image' , 
    array(
      'label' => __( 'Banner Image' , 'adapter-wp' ) ,
      'section' => 'top_banner' ,
      'settings' => 'awp_banner_image' ,
    )
  ) ) ;
}

add_action( 'customize_register' , 'awp_enqueue_customizer_script' ) ;
function awp_enqueue_customizer_script() { 
  wp_enqueue_script( 'awp-customize' , get_template_directory_uri() . '/js/awp-customize.js' , array( 'jquery' , 'customize-preview' ) , '' , true ) ;
}

add_action( 'admin_menu' , 'awp_add_options_page' ) ;
function awp_add_options_page() {
  add_theme_page( __( 'Header & Footer' , 'adapter-wp' ) , __( 'Header & Footer' , 'adapter-wp' ) , 'unfiltered_html' , 'awp_options' , 'awp_options_output_callback' ) ;  
}

if ( ! function_exists( 'awp_options_output_callback' ) ) {
  function awp_options_output_callback() { 
    if ( ! current_user_can( 'unfiltered_html' ) ) {
      die( __( 'Page not allowed, see administrator' , 'adapter-wp' ) ) ;
    }

    $name_header_extra_markup = 'awp_header_extra_markup' ;
    $name_footer_extra_markup = 'awp_footer_extra_markup' ;
    $name_hidden_input = 'awp_hidden_input' ;
    
    $value_header_extra_markup =  get_option( $name_header_extra_markup ) ;
    $value_footer_extra_markup =  get_option( $name_footer_extra_markup ) ;

    if ( isset( $_POST[ $name_hidden_input ] ) &&  ( 'Y' == $_POST[ $name_hidden_input ] ) ) : 
      $value_header_extra_markup =   stripslashes( $_POST[ $name_header_extra_markup ] ) ;
      update_option( $name_header_extra_markup , $value_header_extra_markup ) ; 
      $value_footer_extra_markup =  stripslashes( $_POST[ $name_footer_extra_markup ] ) ;
      update_option( $name_footer_extra_markup , $value_footer_extra_markup ) ;
    ?>
      <div class="updated"><p><strong><?php _e( 'Markup saved' , 'adapter-wp' ) ; ?></strong></p></div>
    <?php endif ; ?>
    
     <div class="wrap">
       <h1>
	 <?php _e( 'Header and Footer' , 'adapter-wp' ) ; ?>
       </h1>
       <form name="header-footer-markup" method="post" action="">
         <input type="hidden" name="<?php echo $name_hidden_input ; ?>" value="Y" >
	 <p>
	   <h3>
    	     <?php _e( 'Header Extra Markup, ie. email opt-in form' , 'adapter-wp' ) ; ?>
	   </h3>
	   <textarea name="<?php echo $name_header_extra_markup ; ?>" rows="10" cols="55"><?php echo esc_textarea( $value_header_extra_markup ) ; ?></textarea>
	 </p>
	 <br>
	 <p>
	   <h3>
	     <?php _e( 'Footer Extra Markup' , 'adapter-wp' ) ; ?>
	   </h3>
  	   <textarea name="<?php echo $name_footer_extra_markup ; ?>" rows="10" cols="55"><?php echo esc_textarea( $value_footer_extra_markup ) ; ?></textarea>
	 </p>
	 <br>	 
	 <input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save changes' , 'adapter-wp' ) ; ?>">
       </form>
     </div> <!-- .wrap -->
  <?php
  }
}

if ( ! function_exists( 'awp_the_breadcrumbs' ) ) { 
  function awp_the_breadcrumbs() {
    global $post ; 
    if ( isset( $post ) ) {
      $parent_title = get_the_title( $post->post_parent ) ;
      if ( $parent_title != the_title( '' , '' , false ) ) {
        awp_manage_breadcrumbs( $parent_title ) ; 
      }
    }
  }
}

if ( ! function_exists( 'awp_manage_breadcrumbs' ) ) { 
  function awp_manage_breadcrumbs( $parent_title ) {
    global $post ;
    if ( isset( $post ) ) {  
      ?>
	<ol class="breadcrumb">
	  <li><a href="<?php echo home_url() ; ?>">Home</a></li>
	  <?php awp_echo_post_parent_for_breadcrumb() ; ?>
	  <li class="active"><?php the_title() ; ?></li>
	</ol>
    <?php       
    }
  }
}

if ( ! function_exists( 'awp_echo_post_parent_for_breadcrumb' ) ) { 
  function awp_echo_post_parent_for_breadcrumb() {
    global $post ;
    if ( isset( $post ) ) {
      $post_parent = get_post( $post->post_parent ) ;
      $parent_title = get_the_title( $post_parent ) ;
      $parent_link = get_permalink( $post_parent ) ; 
      if ( '' == $post_parent->post_content ) {
	echo '<li class="active">' . $parent_title  . '</li>' ; 
      } else {
	?>
	  <li><a href="<?php echo $parent_link ; ?>" title="<?php echo $parent_title ; ?>"><?php echo $parent_title ; ?></a></li>
	<?php
      }
    }
  }
}

if ( ! function_exists( 'awp_maybe_echo_edit_link' ) ) { 
  function awp_maybe_echo_edit_link() {
    if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
      edit_post_link( '<span class="pull-right glyphicon glyphicon-edit"></span>' ) ;
    }
  }
}