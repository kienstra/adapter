<?php defined( 'ABSPATH' ) or die( "No direct access!" ) ; ?>

<nav class="<?php awp_the_classes_of_bottom_navbar() ; ?>" role="navigation">
  <div class="container">
    <?php echo do_shortcode( get_option( 'awp_footer_extra_markup' ) ) ; ?>
    <?php do_action( 'awp_navbar_bottom' ) ; ?>
  </div>
  <p class="<?php awp_the_bottom_copyright_classes() ; ?> copyright-text"><?php awp_simple_copyright() ; ?></p>
</nav>