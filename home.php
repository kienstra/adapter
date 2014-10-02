<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header(); ?>
<div class="row">
  <div class="col-md-8">
    <?php awp_the_breadcrumbs() ; ?>  
    <h1><?php wp_title( '' ) ; ?></h1>
    <?php awp_query_for_post_previews() ; ?>
  </div>
  <div class="col-md-4 main-sidebar">
    <?php wp_meta() ; ?>
    <?php if ( dynamic_sidebar( 'main_sidebar' ) ) ; ?>
  </div>
</div>
<?php get_footer() ; ?>