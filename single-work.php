<?php
get_header();
?>

<main id="main-content" class="padding-top-large">
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $work_cats = wp_get_post_terms($post->ID, 'work_cat');
    $work_artists = igv_get_post_artists($post->ID);
    $work_details = get_post_meta($post->ID, '_igv_work_details', true);
?>

    <header class="container margin-bottom-basic">
<?php
      if (!empty($work_cats)) {
?>
      <div class="grid-row margin-bottom-basic">
        <div class="grid-item font-sans font-size-tiny font-light">
          <?php echo $work_cats[0]->name; ?>
        </div>
      </div>
<?php
      }

      if (!empty($work_artists)) {
?>
      <div class="grid-row">
        <div class="grid-item font-serif"><?php echo $work_artists; ?></div>
      </div>
<?php
      }
?>
      <div class="grid-row align-items-baseline">
        <div class="grid-item item-s-10 item-l-7 item-xl-8">
          <h1 class="font-serif font-italic"><?php echo get_the_title($post->ID); ?></h1>
        </div>
        <div class="grid-item font-bold font-size-small">
          Inquire
        </div>
      </div>
    </header>

    <section class="container">
      <div class="grid-row margin-bottom-basic">
<?php
      if (!empty($work_details)) {
?>
        <div class="grid-item item-s-12 item-m-6 item-l-4 font-sans font-size-small">
          <?php echo apply_filters('the_content', $work_details); ?>
        </div>
<?php
      }
?>
        <div class="grid-item item-s-12 item-m-6 item-l-4 <?php echo empty($work_details) ? 'offset-l-4' : ''; ?> font-sans font-size-tiny">
          <?php the_content(); ?>
        </div>
      </div>
    </section>

    <?php render_gallery($post->ID); ?>

    <?php
      if (!empty($work_artists)) {
        render_related_by_artists($post->ID);
      }
    ?>

<?php
  }
}
?>

  </article>
</main>

<?php
get_footer();
?>
