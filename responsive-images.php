<?php
  $image = get_field('the_amazing_images');
  $size = 'special-header-image_other'; // (thumbnail, medium, large, full or custom size)
    if( $image ) {
      echo wp_get_attachment_image( $image, $size );
    }

?>
