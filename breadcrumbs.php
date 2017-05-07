<?php
/**
 * Breadcrumbs, displaying links to the parents of the post.
 *
 * @package AdapterTheme
 */

$parent_id = wp_get_post_parent_id( get_the_ID() );
if ( 0 !== $parent_id ) :
?>
	<ol class="breadcrumb">
		<li><a href="<?php echo esc_url( get_home_url() ); ?>">Home</a></li>
		<li>
			<?php
			if ( AWP_Theme::post_is_only_a_placeholder_and_has_no_content( $parent_id ) ) {
				echo esc_html( get_the_title( $parent_id ) );
			} else {
				echo '<a href="' . esc_url( get_permalink( $parent_id ) ) . '" title="' . esc_attr( get_the_title( $parent_id ) ) . '">'
					. esc_html( get_the_title( $parent_id ) )
				. '</a>';
			}
			?>
		</li>
		<li class="active"><?php echo esc_html( get_the_title() ); ?></li>
	</ol>
<?php endif; ?>
