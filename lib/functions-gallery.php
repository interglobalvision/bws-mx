<?php
// Generate image gallery sliders
function generate_gallery($post_id) {
  $post_type = get_post_type($post_id);
  $works_images = get_post_meta($post_id, '_igv_documentation_works', true);
  $install_images = get_post_meta($post_id, '_igv_documentation_install', true);
?>
<div id="gallery-holder" class="margin-bottom-mid">
  <div id="sliders">

<?php
  if (!empty($works_images)) {
    $active = $post_type == 'work' ? true : false;
    build_slider($works_images, $active, 'works');
  }

  if (!empty($install_images)) {
    $active = $post_type == 'event' ? true : false;
    build_slider($install_images, $active, 'install');
  }

?>

  </div>

  <div id="slider-controls">

    <div class="grid-row justify-between align-items-start">
      <div class="grid-item item-s-6 item-m-4">
<?php
  if ($post_type == 'work') {
    if (!empty($works_images)) {
?>
        <div class="slider-switch active" data-target="works"><?php _e('[:en]Work[:es]Obra[:]');?></div>
<?php
    }

    if (!empty($install_images)) {
?>
        <div class="slider-switch" data-target="install">Installation Views</div>
<?php
    }
  } else if ($post_type == 'event') {
    if (!empty($install_images)) {
?>
        <div class="slider-switch active" data-target="install">Installation Views</div>
<?php
    }

    if (!empty($works_images)) {
?>
        <div class="slider-switch" data-target="works"><?php _e('[:en]Works[:es]Obras[:]');?></div>
<?php
    }
  }
?>
      </div>
      <div class="grid-item item-m-4 desktop-only js-slide-caption"></div>
      <div class="grid-item item-s-6 item-m-4 text-align-right">
<?php
    if (!empty($works_images)) {
      $active = $post_type == 'work' ? true : false;
      slider_buttons($active, 'works');
    }
    if (!empty($install_images)) {
      $active = $post_type == 'event' ? true : false;
      slider_buttons($active, 'install');
    }
?>
      </div>
    </div>

  </div>
</div>
<?php
}

// Make Prev / Next slider buttons
function slider_buttons($active, $type) {
?>
<div id="slider-buttons-<?php echo $type; ?>" class="slider-buttons<?php echo $active ? ' active' : '';?>">
  <div class="u-inline-block slider-button slider-prev-<?php echo $type; ?>"><</div>
  <div class="u-inline-block slider-button slider-next-<?php echo $type; ?>">></div>
</div>
<?php
}

// Make Swiper slider
function build_slider($images, $active, $type) {
?>
<div id="slider-holder-<?php echo $type; ?>" class="grid-row slider-holder<?php echo $active ? ' active' : '';?>">
  <div class="swiper-container swiper-<?php echo $type; ?> grid-item item-s-10">
    <div class="swiper-wrapper align-items-center margin-bottom-mid">
<?php
  foreach($images as $image_id => $image) {
?>
      <div class="swiper-slide text-align-center u-pointer">
        <?php echo wp_get_attachment_image($image_id, 'gallery'); ?>
        <div class="mobile-only">Caption</div>
      </div>
<?php
  }
?>
    </div>
  </div>
</div>
<?php
}
