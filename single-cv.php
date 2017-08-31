<?php
get_header();
?>

<main id="main-content" class="padding-top-large">
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $artists = wp_get_post_terms($post->ID, 'artist');

    if (count($artists)) {
?>
    <header class="container">
      <div class="grid-row">
        <div class="grid-item">

          <h3 class="margin-bottom-small"><a href="<?php echo get_term_link($artists[0]); ?>">Artist</a> / CV</h3>
          <h1 class="margin-bottom-basic"><?php echo $artists[0]->name; ?></h1>

        </div>
      </div>

    <section class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-10 item-l-8">

          <?php the_content(); ?>

        </div>
      </div>
    </section>
<?php
    }
  }
}
?>

  </article>
</main>

<?php
get_footer();
?>
