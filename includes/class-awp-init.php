<?php
/**
 * Init file for the Adapter Theme
 *
 * @package AdapterTheme
 */

/**
 * Class AWP_Init
 */
class AWP_Init {

	/**
	 * Slug for theme.
	 *
	 * @var string
	 */
	public $theme_slug = 'adapter-wp';

	/**
	 * Version for theme.
	 *
	 * @var string
	 */
	public $theme_version = '1.0.6';

	/**
	 * Construct the class.
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_text_domain' ) );
		add_action( 'after_setup_theme', array( $this, 'theme_support_setup' ) );
		add_action( 'after_setup_theme', array( $this, 'editor_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_js' ) );
		add_action( 'after_setup_theme', array( $this, 'menu_setup' ) );
		add_filter( 'wp_title', array( $this, 'get_fallback_title_for_home' ), 11, 1 );
		add_action( 'after_setup_theme', array( $this, 'set_content_width' ) );
		add_action( 'comment_form', array( $this, 'maybe_enqueue_comment_reply' ) );
		add_filter( 'wp_link_pages_link', array( $this, 'pages_link_filter' ), 10, 1 );
		add_action( 'widgets_init', array( $this, 'awp_register_sidebar' ) );
		add_filter( 'upload_mimes', array( $this, 'awp_mime_types' ), 10, 1 );
		add_filter( 'comment_reply_link', array( $this, 'reply_link' ), 10, 1 );
		add_filter( 'get_avatar', array( $this, 'class_avatar' ), 10, 1 );
		add_filter( 'get_image_tag_class', array( $this, 'image_tag_class_filter' ), 10, 1 );
		add_filter( 'widget_archives_args', array( $this, 'limit_archives_count' ), 10, 1 );
		add_filter( 'widget_categories_args', array( $this, 'widget_categories_filter' ), 10, 1 );
		add_filter( 'the_content', array( $this, 'add_clearfix_to_end_of_content' ), 1, 1 );
	}

	public function theme_text_domain() {
		load_theme_textdomain( $this->theme_slug, get_template_directory() . '/languages' );
	}

	public function theme_support_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'menus' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'starter-content' );
		add_theme_support( 'title-tag' );
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		$custom_header_defaults = array(
			'width'       => 1000,
			'height'      => 250,
			'flex-height' => true,
			'flex-width'  => true,
			'uploads'     => true,
		);
		add_theme_support( 'custom-header', $custom_header_defaults );
	}

	public function editor_styles() {
		$style_path = apply_filters( 'awp_editor_style_path', '' );
		if ( $style_path ) {
			add_editor_style( esc_url( $style_path ) );
		}
	}

	public function enqueue_styles() {
		$primary_bootstrap_css_path = apply_filters( 'awp_primary_bootstrap_css_path', get_template_directory_uri() . '/bootstrap/css/bootstrap-basic.min.css' );
		$second_bootstrap_css_path = apply_filters( 'awp_second_bootstrap_css_path', '' );

		// MIT License : https://github.com/twbs/bootstrap/blob/master/LICENSE
		wp_enqueue_style( $this->theme_slug . '-primary-bootstrap-css', $primary_bootstrap_css_path, '', $this->theme_version );
		if ( $second_bootstrap_css_path ) {
			$this->enqueue_file_followed_by_style_css( $second_bootstrap_css_path );
		} else {
			$this->only_enqueue_style_css();
		}
		wp_enqueue_style( $this->theme_slug . '-print-css', get_template_directory_uri() . '/print.css', '', $this->theme_version, 'print' );
	}

	public function enqueue_file_followed_by_style_css( $second_bootstrap_css_path ) {
		wp_enqueue_style( $this->theme_slug . '-second-bootstrap-css', $second_bootstrap_css_path, array( $this->theme_slug . '-primary-bootstrap-css' ), $this->theme_version );
		wp_enqueue_style( $this->theme_slug . '-main-css', get_stylesheet_uri(), array( $this->theme_slug . '-second-bootstrap-css' ), $this->theme_version );
	}

	public function only_enqueue_style_css() {
		wp_enqueue_style( $this->theme_slug . '-main-css', get_stylesheet_uri(), array( $this->theme_slug . '-primary-bootstrap-css' ), $this->theme_version );
	}

	public function enqueue_js() {
		global $wp_scripts;

		wp_register_script( $this->theme_version . '-html5-shiv', get_template_directory() . '/js/html5shiv.js', array(), $this->theme_version, false );
		$wp_scripts->add_data( $this->theme_version . '-html5-shiv', 'conditional', 'lt IE 9' );

		wp_register_script( $this->theme_version . '-respond-js', get_template_directory() . '/js/respond.src.js', array(), $this->theme_version, false );
		$wp_scripts->add_data( $this->theme_version . '-respond-js', 'conditional', 'lt IE 9' );

		wp_enqueue_script( 'jquery' );

		// MIT License : https://github.com/twbs/bootstrap/blob/master/LICENSE
		$main_bootstrap_js_path = apply_filters( 'awp_js_for_bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js' );
		wp_enqueue_script( 'bootstrap_js', $main_bootstrap_js_path, array( 'jquery' ), $this->theme_version, true );
		wp_enqueue_script( $this->theme_slug . '-third-level-menu', get_template_directory_uri() . '/js/awp-third-level-menu', array( 'jquery' ),  $this->theme_version, true );
	}

	public function menu_setup() {
		register_nav_menu( 'awp_main_menu', __( 'Main Menu', 'adapter-wp' ) );
	}

	public function set_content_width() {
		if ( ! isset( $content_width ) ) {
			$content_width = 600;
		}
	}

	public function get_fallback_title_for_home( $title ) {
		if ( ( '' === $title ) && ( is_home() || is_front_page() ) ) {
			return get_bloginfo( 'name' );
		}
		return $title;
	}

	function maybe_enqueue_comment_reply() {
		if ( comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	public function pages_link_filter( $link_markup ) {
		$regex = '/(<a[^>]*?>).*?(<li[^>]??>)(.*)/';
		$replace_with = '$2$1$3';
		$filtered_markup = preg_replace( $regex, $replace_with, $link_markup );
		return $filtered_markup;
	}

	public function awp_register_sidebar() {
		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'adapter-wp' ),
			'id' => 'main_sidebar',
			'description' => __( 'Displays on selected pages', 'adapter-wp' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div> ',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
	}

	public function awp_mime_types( $mimes ) {
		 $mimes['svg'] = 'image/svg+xml';
		 return $mimes;
	}

	public function reply_link( $link_class ) {
		$comment_reply_classes = apply_filters( 'awp_comment_reply_classes', 'btn btn-primary btn-med' );
		$link_class = str_replace( "class='comment-reply-link", "class='comment-reply-link <?php echo $comment_reply_classes; ?>", $link_class );
		return $link_class;
	}

	public function class_avatar( $avatar_class ) {
		$avatar_class = str_replace( "class='avatar", "class='avatar img-circle img-responsive media-object", $avatar_class );
		return $avatar_class;
	}

	function image_tag_class_filter( $classes ) {
		return $classes . ' img-responsive';
	}

	public function limit_archives_count( $args ) {
		$args['limit'] = '6';
		return $args;
	}

	public function widget_categories_filter( $args ) {
		$args['number'] = 6;
		$args['orderby'] = 'count';
		$args['order'] = 'DESC';
		return $args;
	}

	public function add_clearfix_to_end_of_content( $content ) {
		return $content . '<div class="clearfix"></div>';
	}

}
