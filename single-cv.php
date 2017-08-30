<?php
get_header();
?>

<main id="main-content">
  <section id="single-cv">
    <div class="container">
      <div class="grid-row">
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $artists = igv_get_post_artists($post->ID);

    if (!empty($artists)) {
?>
        <article <?php post_class('grid-item item-s-12'); ?> id="post-<?php the_ID(); ?>">

          <h3 class="margin-bottom-small">Artist / CV</h3>
          <h1 class="margin-bottom-basic"><?php echo $artists; ?></h1>

          <?php the_content(); ?>

        </article>
<?php
    }
  }
}
?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>