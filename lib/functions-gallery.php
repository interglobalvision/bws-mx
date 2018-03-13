<?php
// Render image gallery sliders
function render_gallery($post_id) {
  $post_type = get_post_type($post_id);
  $works_images = get_post_meta($post_id, '_igv_documentation_works', true);
  $install_images = get_post_meta($post_id, '_igv_documentation_install', true);
?>
<section id="gallery-holder" class="margin-bottom-mid border-top-white padding-top-basic">
  <div id="sliders">

<?php
  if (!empty($works_images) || !empty($install_images)) {
    if (!empty($works_images)) {
      $active = $post_type == 'work' || empty($install_images) ? true : false;
      build_slider($works_images, $active, 'works', $post_type);
    }

    if (!empty($install_images)) {
      $active = $post_type == 'event' || empty($works_images) ? true : false;
      build_slider($install_images, $active, 'install', $post_type);
    }
  } else {
?>
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 text-align-center">
          <?php the_post_thumbnail('gallery'); ?>
        </div>
      </div>
    </div>
<?
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
        <div class="slider-switch <?php echo !empty($install_images) ? 'active' : ''; ?>" data-target="works"><?php _e('[:en]Work[:es]Obra[:]');?></div>
<?php
    }

    if (!empty($install_images)) {
?>
        <div class="slider-switch <?php echo empty($works_images) ? 'active' : ''; ?>" data-target="install"><?php _e('[:en]Installation Views[:es]Vistas de Instalación[:]'); ?></div>
<?php
    }
  } else if ($post_type == 'event') {
    if (!empty($install_images)) {
?>
        <div class="slider-switch <?php echo !empty($works_images) ? 'active' : ''; ?>" data-target="install"><?php _e('[:en]Installation Views[:es]Vistas de Instalación[:]'); ?></div>
<?php
    }

    if (!empty($works_images)) {
?>
        <div class="slider-switch <?php echo empty($install_images) ? 'active' : ''; ?>" data-target="works"><?php _e('[:en]Works[:es]Obras[:]');?></div>
<?php
    }
  }
?>
      </div>

      <div id="slider-controls-caption-holder" class="grid-item item-m-4 margin-top-micro text-align-center font-serif font-size-tiny">
<?php
    if (!empty($works_images)) {
      $active = $post_type == 'work' || empty($install_images) ? true : false;
      return_controls_captions($works_images, $active, 'works', $post_type);
    }
    if (!empty($install_images)) {
      $active = $post_type == 'event' || empty($works_images) ? true : false;
      return_controls_captions($install_images, $active, 'install', $post_type);
    }
?>
      </div>

      <div class="grid-item item-s-6 item-m-4 text-align-right">
<?php
    if (!empty($works_images)) {
      $active = $post_type == 'work' || empty($install_images) ? true : false;
      slider_buttons($active, 'works');
    }
    if (!empty($install_images)) {
      $active = $post_type == 'event' || empty($works_images) ? true : false;
      slider_buttons($active, 'install');
    }
?>
      </div>
    </div>

  </div>
</section>
<div id="gallery-zoom" class="grid-row justify-center align-items-center"><div><img id="gallery-zoom-image" /></div></div>
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
  <h3 class="text-align-center margin-bottom-basic font-size-basic font-bold"><?php echo $type == 'works' ? 'Works' : 'Installation Views'; ?></h3>
  <div id="slick-<?php echo $type; ?>" class="slick-container">
<?php
  foreach($images as $image_id => $image) {
    $caption_default = wp_get_attachment_caption($image_id);
    $caption_type = get_post_meta($image_id, '_igv_caption_' . $post_type, true);
    $work = get_post_meta($image_id, '_igv_attachment_work', true);
?>
    <div class="slick-slide gallery-item text-align-center u-pointer" data-id="<?php echo $image_id; ?>">
      <?php echo wp_get_attachment_image($image_id, 'gallery', false, 'data-no-lazysizes'); ?>
      <div class="slide-caption text-align-center font-size-tiny margin-top-small font-serif">
<?php
    if (!empty($caption_type)) {
?>
        <? echo apply_filters('the_content', $caption_type); ?>
<?php
    } else if (!empty($caption_default)) {
?>
        <? echo apply_filters('the_content', $caption_default); ?>
<?php
    }

    if ($post_type == 'event' && !empty($work)) {

      $work_link = get_the_permalink($work);
?>
        <p class="font-sans"><a class="link-underline" href="<?php echo $work_link; ?>"><?php _e('[:en]Learn more[:es]Saber más[:]'); ?></a></p>
<?php
    }
?>
      </div>
    </div>
<?php
  }
?>
  </div>
</div>
<?php
}

// Output captions in control bar row
function return_controls_captions($images, $active, $type, $post_type) {
?>
<div id="slider-controls-caption-<?php echo $type; ?>" class="slider-controls-caption-wrapper<?php echo $active ? ' active' : '';?>">
<?php
  foreach ($images as $image_id => $image) {
    $caption_default = wp_get_attachment_caption($image_id);
    $caption_type = get_post_meta($image_id, '_igv_caption_' . $post_type, true);
    $work = get_post_meta($image_id, '_igv_attachment_work', true);

    if (!empty($caption_type) || !empty($caption_default)) {
?>
  <div class="slider-controls-caption" data-id="<?php echo $image_id; ?>">
    <?php
      if (!empty($caption_type)) {
        echo apply_filters('the_content', $caption_type);
      } else if (!empty($caption_default)) {
        echo apply_filters('the_content', $caption_default);
      }
      if ($post_type == 'event' && !empty($work)) {

        $work_link = get_the_permalink($work);
    ?>
    <p class="font-sans"><a class="link-underline" href="<?php echo $work_link; ?>"><?php _e('[:en]Learn more[:es]Saber más[:]'); ?></a></p>
    <?php
      }
    ?>
  </div>
<?php
    }
  }
?>
</div>
<?php
}
