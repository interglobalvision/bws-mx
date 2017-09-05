<?php
// Render image gallery sliders
function render_gallery($post_id) {
  $post_type = get_post_type($post_id);
  $works_images = get_post_meta($post_id, '_igv_documentation_works', true);
  $install_images = get_post_meta($post_id, '_igv_documentation_install', true);
?>
<section id="gallery-holder" class="margin-bottom-mid">
  <div id="sliders">

<?php
  if (!empty($works_images)) {
    $active = $post_type == 'work' ? true : false;
    build_slider($works_images, $active, 'works', $post_type);
  }

  if (!empty($install_images)) {
    $active = $post_type == 'event' ? true : false;
    build_slider($install_images, $active, 'install', $post_type);
  }

?>

  </div>

  <div id="slider-controls" class="container margin-top-small">

    <div class="grid-row justify-between align-items-start">
      <div class="grid-item item-s-6 item-m-4 font-size-small font-bold">
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
      <div class="grid-item item-m-4 slider-controls-caption margin-top-micro text-align-center font-serif font-size-tiny"></div>
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
</section>
<?php
}

// Make Prev / Next slider buttons
function slider_buttons($active, $type) {
?>
<div id="slider-buttons-<?php echo $type; ?>" class="slider-buttons<?php echo $active ? ' active' : '';?>">
  <div class="u-inline-block slider-button slider-prev-<?php echo $type; ?>"><?php echo url_get_contents(get_template_directory_uri() . '/dist/img/arrow-left.svg'); ?></div>
  <div class="u-inline-block slider-button slider-next-<?php echo $type; ?>"><?php echo url_get_contents(get_template_directory_uri() . '/dist/img/arrow-right.svg'); ?></div>
</div>
<?php
}

// Make Swiper slider
function build_slider($images, $active, $type, $post_type) {
?>
<div id="slider-holder-<?php echo $type; ?>" class="slider-holder<?php echo $active ? ' active' : '';?>">
  <div id="slick-<?php echo $type; ?>" class="slick-container">
<?php
  foreach($images as $image_id => $image) {
    // Get captions by post type in both langs
    $caption_en = get_post_meta($image_id, $post_type . '_caption_en', true);
    $caption_es = get_post_meta($image_id, $post_type . '_caption_es', true);
?>
    <div class="slick-slide text-align-center u-pointer">
      <?php echo wp_get_attachment_image($image_id, 'gallery', false, 'data-no-lazysizes'); ?>
<?php
    if (!empty($caption_en) || !empty($caption_es)) {
?>
      <div class="slide-caption margin-top-small text-align-center font-serif font-size-tiny"><? _e('[:en]' . $caption_en . '[:es]' . $caption_es . '[:]'); ?></div>
<?php
    }
?>
    </div>
<?php
  }
?>
  </div>
</div>
<?php
}
