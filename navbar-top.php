<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<div class="<?php awp_the_classes_of_first_top_navbar() ; ?>" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo esc_url( site_url() );?>"><?php bloginfo('name'); ?></a> 
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
	<?php echo awp_the_top_nav_menu() ; ?>
      </ul>
    </div><!--/.navbar-collapse -->
    <?php do_action( 'awp_end_of_first_top_navbar' ) ; ?>
  </div>
</div>