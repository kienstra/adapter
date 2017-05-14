<?php
/**
 * Display the top navbar.
 *
 * @package AdapterTheme
 */

?>
<nav class="<?php echo esc_attr( AWP_Theme::get_classes_of_first_top_navbar() ); ?>" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo esc_url( get_site_url() );?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<?php AWP_Theme::top_nav_menu(); ?>
			</ul>
		</div>
		<?php do_action( 'awp_end_of_first_top_navbar' ); ?>
	</div>
</nav>
<?php
if ( '' !== trim( get_bloginfo( 'description' ) ) ) :
?>
	<nav class="<?php echo esc_attr( AWP_Theme::get_classes_of_second_top_navbar() ); ?> navbar-opt-in">
		<div class="container">
			<div class="navbar-header">
				<span class="navbar-brand">
					<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
				</span>
			</div>
			<?php do_action( 'awp_end_of_top_banner' ); ?>
		</div>
	</nav>
<?php endif;
