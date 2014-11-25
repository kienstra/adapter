Adapter Theme
Theme URI: http://ryankienstra.com/themes/adapter
Author: ryankienstra
Author URI: http://ryankienstra.com
Version: 1.0.5
License: GNU General Public License v2 or later


DEPENDENCY LICENSES

/bootstrap/* : MIT license , https://github.com/twbs/bootstrap/blob/master/LICENSE
/bootstrap/fonts/* : MIT license , http://glyphicons.com/license/
/includes/wp_bootstrap_navwalker.php : GPL2 , http://www.gnu.org/licenses/gpl-2.0.txt
/js/html5shiv.js : MIT/GPL2 , source : https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js
/js/respond.min.js : MIT , https://github.com/scottjehl/Respond/blob/master/LICENSE-MIT
	 source : https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js


TEMPLATES

Default Template (With Sidebar)
	Description: Full navbar and sidebar
	Main file: page.php

Landing Page
	Description: No navbar or sidebar
		     Blank page, but has same stylesheets as other templates
	Main file: page-no-nav.php

No Sidebar
	Description: No sidebar, but has a navbar
	Main file: page-no-sidebar.php


FILTERS

awp_editor_style_path
	@param string $path The path to a custom css file for the editor
	default : ""

awp_primary_bootstrap_css_path
	@param string $path The path to the primary bootstrap file
	default : get_template_directory_uri() . '/bootstrap/css/bootstrap-basic.min.css'

awp_second_bootstrap_css_path
	@param string $path The path to the secondary bootstrap file
	default : ""

awp_js_for_bootstrap
	@param string $path The path to the main bootstrap javascript file

awp_classes_of_first_top_navbar
	@param string $classes Classes for the top navbar
	default : 'navbar-default top-navbar navbar-static-top'
	also accepts: 'navbar-fixed-top' to fix navbar

awp_classes_of_second_top_navbar
	@param string $classes Classes for the top navbar
	default : navbar-default navbar-static-top

awp_classes_of_bottom_navbar
	@param string $classes Classes for the footer navbar
	default : navbar-default navbar-static-bottom

awp_navwalker_path
	@param string $path Path to the Bootstrap Navwalker

awp_do_get_top_banner
	@param boolean $do_get_banner Whether to use a top banner with an optional image, tagline, and opt-in form
	default : true

awp_top_banner_backround_alignment
	$param string $alignment Type of alignment
	default : 'center'
	accepts : 'left' , 'center' , 'right'

awp_do_get_bottom_nav
	@param boolean $do_get_nav Whether to get the bottom bar, which has a copyright tag and an option for extra markup, like an opt-in form
	default : true

awp_name_next_to_copyright_in_footer
	@param string $name Name in the bottom navbar next to copyright
	default : get_bloginfo( 'admin' );

awp_bottom_copyright_classes
	@param string $classes Classes of bottom copyright text
	default : ""
	accepts : 'text-muted' , 'navbar-brand' ( bigger font )

awp_pagination_size
	@param string $size Size of the pagination links in function awp_paginate_links
	default : ""	( causes medium-sized links )
	accepts : 'sm' , 'lg'

awp_comment_reply_classes
	@param string $classes Classes in button to reply to each comment
	default : 'btn btn-primary btn-med'
	also accepts : 'btn-sm' ,	'btn-lg' , 'btn-default' , 'btn-danger'

awp_use_unstyled_comment_form
	@param boolean $do_use Use the default wp comment form
	default : false , causes this theme's comment form to be used instead of the wp default form

To only allow comments on single posts pages, insert this code in a child theme's functions.php file:
	add_filter( 'comments_open' , 'awp_only_allow_comments_on_single_post_page' );


ACTION HOOKS

awp_end_of_first_top_navbar
	After the menu of the top navbar, ideal for a search form

awp_end_of_top_banner
	The top banner is below the first top navbar. It echoes the tagline and the optional markup in Appearance > Header & Footer. Then it fires this action.

awp_navbar_bottom
	In bottom navbar, after the optional markup in menu Appearance > Header & Footer. The copyright information echoes after this. This would be good for social sharing links, or a menu.
	Because the bottom navbar is fixed, you must set the body's padding-bottom for different viewport sizes.

awp_after_full_single_post_content
	In single.php, after the post's content

awp_before_top_nav
	In header.php, before either of the navbars

awp_top_of_page
	In header.php, after <div class="container">
	At the top of every page

awp_after_comments
	In comments.php, after closing tag of comments
