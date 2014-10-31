<?php defined('ABSPATH') or die( "No direct access!" ); ?>

<div class="row">
  <div class="col-md-6 search-posts">
    <h3>
      <?php _e( 'Articles' , 'adapter-wp' ); ?>
    </h3>
    <?php
      $arguments = array(
	'numberposts' => '10' ,
	'post_status' => 'publish'
      );
      $recent_posts = wp_get_recent_posts( $arguments );

      echo '<div class="list-group">';
	foreach( $recent_posts as $post ) {
	  echo '<a class="list-group-item" href="' . esc_attr( get_permalink( $post[ "ID" ] ) ) . '">' . $post[ "post_title" ] . '</a>';
	}
      echo '</div>'; // .list-group

    ?>
  </div> <!-- .search-posts -->
  <div class="col-md-6 site-pages">
    <h3>
      <?php _e( 'Pages' , 'adapter-wp' ); ?>
    </h3>

    <?php $pages = get_pages();
    awp_echo_list_group_of_pages( $pages ); 
    ?>	  
  </div>
</div>