<?php
get_header();
?>

<main id="main-content">
  <section id="posts">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $work_cats = wp_get_post_terms($post->ID, 'work_cat');
    $work_artists = igv_get_post_artists($post->ID);
    $work_details = get_post_meta($post->ID, '_igv_work_details', true);
?>

      <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="container">
          <div class="grid-row margin-bottom-basic">
<?php
      if (!empty($work_cats)) {
?>
            <div class="grid-item item-s-12 font-sans margin-bottom-basic"><?php echo $work_cats[0]->name; ?></div>
<?php
      }
?>
            <div class="grid-item item-s-10 item-l-6">
              <h1 class="font-serif font-italic"><?php echo get_the_title($post->ID); ?></h1>

<?php
      if (!empty($work_artists)) {
?>
              <div class="font-serif"><?php echo $work_artists; ?></div>
<?php
      }
?>
            </div>
            <div class="grid-item item-s-2 item-l-6 text-align-right">
              Inquire
            </div>
          </div>

          <div class="grid-row margin-bottom-basic">
<?php
      if (!empty($work_details)) {
?>
            <div class="grid-item item-s-12 item-l-4 font-sans">
              <?php echo apply_filters('the_content', $work_details); ?>
            </div>
<?php
      }
?>
            <div class="grid-item item-s-12 item-l-4 <?php echo empty($work_details) ? 'offset-l-4' : ''; ?> font-serif">
              <?php the_content(); ?>
            </div>
          </div>
        </div>

        <?php render_gallery($post->ID); ?>

        <?php
          if (!empty($work_artists)) {
            render_related_by_artists($post->ID);
          }
        ?>

      </article>

<?php
  }
}
?>

  </section>
</main>

<?php
get_footer();
?>
