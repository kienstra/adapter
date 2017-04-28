<?php
/**
 * Display the top banner.
 *
 * @package AdapterTheme
 */

if ( false !== get_header_image() ) :
?>
	<a class="header-banner-link" href="<?php echo esc_url( home_url() ); ?>">
		<div class="header-banner-wrapper">
			<div class="header-banner"></div>
		</div>
	</a>
<?php endif; ?>
