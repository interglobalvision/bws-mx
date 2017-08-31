<?php
get_header();
?>

<main id="main-content" class="padding-top-large">
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>

    <section class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12">

          <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>

          <?php the_content(); ?>

        </div>
      </div>
    </section>

<?php
  }
}
?>

  </article>
</main>

<?php
get_footer();
?>
