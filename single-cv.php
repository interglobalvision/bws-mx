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

    $artists = wp_get_post_terms($post->ID, 'artist');

    if (count($artists)) {
?>
        <article <?php post_class('grid-item item-s-12'); ?> id="post-<?php the_ID(); ?>">

          <h3 class="margin-bottom-small"><a href="<?php echo get_term_link($artists[0]); ?>">Artist</a> / CV</h3>
          <h1 class="margin-bottom-basic"><?php echo $artists[0]->name; ?></h1>

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