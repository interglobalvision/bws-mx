<?php
get_header();

?>

<main id="main-content" class="padding-top-large">
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <section class="container">
      <div class="grid-row">

<?php
// Events

$args = array(
  'post_type' => 'event',
  'posts_per_page' => -1,
);

$event_query = new WP_Query($args);

if ($event_query->have_posts()) {
?>
        <div class="grid-item item-s-12 item-l-6 grid-row no-gutter align-content-start">
          <h2 class="grid-item item-s-12 font-sans font-size-tiny font-light margin-bottom-basic"><?php echo __('[:es]Exposiciones y Eventos[:en]Exhibitions & Events'); ?></h2>
<?php
  while ($event_query->have_posts()) {
    $event_query->the_post();
?>
          <div class="grid-item item-s-6 margin-bottom-mid js-hover-item">
            <?php echo get_the_post_thumbnail($post->ID, 'hover-image', 'class=hover-image'); ?>
            <a href="<?php the_permalink(); ?>">
              <?php get_template_part('partials/related-event'); ?>
            </a>
          </div>
<?php
  }
?>
        </div>
<?php
  wp_reset_postdata();
}


// Artist list

$args =  array(
  'taxonomy' => 'artist',
);

$artists = get_terms($args);

if (!empty($artists)) {
?>
        <div class="grid-item item-s-12 item-m-6 item-l-3 grid-row no-gutter align-content-start margin-bottom-mid">
          <h2 class="grid-item item-s-12 font-sans font-size-tiny font-light margin-bottom-basic"><?php echo __('[:es]Artistas expuestos[:en]Exhibited Artists'); ?></h2>
<?php
  foreach ($artists as $artist) {
?>
          <div class="grid-item item-s-12 margin-bottom-micro">
            <a href="<?php echo home_url('artist') . '/' . $artist->slug; ?>" class="link-underline">
              <?php echo $artist->name; ?>
            </a>
          </div>
<?php
  }
?>
        </div>
<?php
}

// Select works

$args = array(
  'post_type' => 'work',
  'posts_per_page' => -1,
  'meta_query'      =>  array(
    array(
      'key'     =>  '_igv_work_show_archive',
      'value'   =>  'on',
      'compare' =>  '='
    )
  )
);

$work_query = new WP_Query($args);

if ($work_query->have_posts()) {
?>
        <div class="grid-item item-s-12 item-m-6 item-l-3 grid-row no-gutter align-content-start">
          <h2 class="grid-item item-s-12 font-sans font-size-tiny font-light margin-bottom-basic"><?php echo __('[:es]Obras seleccionadas[:en]Select Works'); ?></h2>
<?php
  while ($work_query->have_posts()) {
    $work_query->the_post();
?>
          <div class="grid-item item-s-12 margin-bottom-mid js-hover-item">
            <?php echo get_the_post_thumbnail($post->ID, 'hover-image', 'class=hover-image'); ?>
            <a href="<?php the_permalink(); ?>">
              <?php get_template_part('partials/related-work'); ?>
            </a>
          </div>
<?php
  }
?>
        </div>
<?php
  wp_reset_postdata();
}
?>

      </div>
    </section>
  </article>
</main>

<?php
get_footer();
?>
