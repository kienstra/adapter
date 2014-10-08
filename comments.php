<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php if ( ( have_comments() ) && ( ! post_password_required() ) ) : ?>
  <h3 id="comments">
    <span class="glyphicon glyphicon-comment"></span> &nbsp;
    <?php comments_number( __( 'No comment' , 'adapter-wp' ) , __( 'A comment' , 'adapter-wp' ) , __( '% comments' , 'adapter-wp' ) ) ; ?>
    <a class="add-comment btn btn-med btn-primary pull-right" href="#respond">
      <span class="glyphicon glyphicon-plus"></span> &nbsp;
      Comment
    </a>
  </h3>

  <ol class="comment-area media-list">
    <?php wp_list_comments( 'callback=awp_comment_list' ) ; ?>
  </ol>
  <ul class="pager">
    <li>
      <?php previous_comments_link( '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' . __( "Previous comments" , "adapter-wp" ) ) ; ?>
    </li>
    <li>
      <?php next_comments_link( __( "Next comments" , "adapter-wp" ) . '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ) ; ?>
    </li>
  </ul>
<?php endif ; ?>
<?php if ( comments_open( $post->post_id ) ) : ?>
  <div id="respond">
    <h4><?php comment_form_title( __( 'Leave a comment' , 'adapter-wp' ) , __( 'Leave a comment for %' , 'adapter-wp' ) ) ; ?></h4>
    <div class="cancel-reply-comment">
      <?php cancel_comment_reply_link() ; ?>
    </div>

    <?php if ( ( ! is_user_logged_in() ) && ( get_option( 'comment_registration' ) ) ) : ?>
	<p><?php _e( 'Please' , 'adapter-wp' ) ; ?>&nbsp;<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ) ; ?>"><?php _e( 'log in' , 'adapter-wp' ) ; ?></a>&nbsp;<?php _e( 'to make a comment.' , 'adapter-wp' ) ; ?></p>
    <?php else : ?>
      <form class="form-horizontal" role="form" action="<?php echo esc_url( site_url( 'wp-comments-post.php' ) ) ; ?>" method="post" id="comment-form">
      <?php if ( is_user_logged_in() ) : ?> 
	<p>
	  <?php _e( 'Welcome,' , 'adapter-wp' ) ;?>&nbsp;<a href="<?php echo esc_url( site_url( 'wp-admin/profile.php' ) ) ; ?>"><?php echo $user_identity ; ?></a>.
	  <a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ) ; ?>" title="<?php _e( 'Log out' , 'adapter-wp' ) ; ?>"><?php _e( 'Log out' , 'adapter-wp' ) ; ?></a>
	</p>
      <?php else : ?>
	<div class="form-group">
	  <label for="author" class="sr-only"><?php _e( 'Name' , 'adapter-wp' ) ; ?></label>
	  <div class="col-md-5">
	    <input type="text" id="author" class="form-control" name="author" value="<?php echo esc_attr( $comment_author ) ; ?>" tabindex="1" placeholder="<?php _e( 'Name' , 'adapter-wp' ) ; ?>" <?php if ( $req ) echo "aria-required='true'" ; ?> />
	  </div>
	</div>
	<div class="form-group">
	  <label for="email" class="sr-only"><?php _e( 'Email' , 'adapter-wp' ) ; ?></label>
	  <div class="col-md-5">
	    <input type="text" id="email" name="email" class="form-control" value="<?php echo esc_attr( $comment_author_email ) ; ?>" tabindex="2" placeholder="<?php _e( 'Email' , 'adapter-wp' ) ; ?>" <?php if ( $req ) echo "aria-required='true'" ; ?> />
	  </div>
	</div>
	<div class="form-group">
	  <label for="url" class="sr-only"><?php _e( 'Url' , 'adapter-wp' ) ; ?></label>
	  <div class="col-md-5">
	    <input type="text" id="url" name="url" class="form-control" value="<?php echo esc_attr( $comment_author_url ) ; ?>" tabindex="3" placeholder="<?php _e( 'Url' , 'adapter-wp' ) ; ?>" />
	  </div>
	</div>
      <?php endif ; ?>
      <div class="form-group">
        <label class="sr-only" for="comment"><?php _e( 'Comment' , 'adapter-wp' ) ; ?></label>
        <div class="col-md-10">
          <textarea class="input-lg form-control" id="comment" name="comment" tabindex="4" placeholder="<?php _e( 'Comment' , 'adapter-wp' ) ; ?>"></textarea>
        </div>
      </div> 
      <div class="form-group">
	<div class="col-md-10">
	  <input type="submit" class="btn btn-primary btn-sm" tabindex="5" value="Post comment"/>
	  <?php comment_id_fields() ; ?>
	</div> 
      </div>
      <?php do_action( 'comment_form' , $post->ID ) ; ?>
    </form>
    <?php endif ; ?>            
  </div> <!-- #respond -->    
<?php do_action( 'awp_after_comments' ) ; ?>
<?php endif ; ?>