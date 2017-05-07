<?php
/**
 * Display comments when calling comments_template().
 *
 * @package AdapterTheme
 */

if ( comments_open() && ( ! post_password_required() ) ) : ?>
	<h3 id="comments">
		<span class="glyphicon glyphicon-comment"></span>&nbsp;
		<?php comments_number( __( 'No comment' , 'adapter-wp' ) , __( 'A comment' , 'adapter-wp' ) , __( '% comments' , 'adapter-wp' ) ); ?>
		<a class="add-comment btn btn-med btn-primary pull-right" href="#respond">
			<span class="glyphicon glyphicon-plus"></span> &nbsp;
			<?php esc_html_e( 'Comment', 'adapter-wp' ); ?>
		</a>
	</h3>
	<ol class="comment-area media-list">
		<?php wp_list_comments( array(
			'callback' => array( 'AWP_Theme', 'comment_list' ),
		) ); ?>
	</ol>
	<ul class="pager">
		<li>
			<?php previous_comments_link( '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' . __( 'Previous comments' , 'adapter-wp' ) ); ?>
		</li>
		<li>
			<?php next_comments_link( __( 'Next comments' , 'adapter-wp' ) . '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ); ?>
		</li>
	</ul>
<?php endif;
comment_form( array(
	'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" class="form-control input-lg" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>',
	'class_submit' => 'btn btn-primary btn-sm',
) );
