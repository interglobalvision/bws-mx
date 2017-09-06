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
    <header class="container margin-bottom-mid">
      <div class="grid-row">
        <div class="grid-item">

          <div class="font-size-tiny font-light margin-bottom-basic"><a class="link-underline" href="<?php echo get_term_link($artists[0]); ?>">Artist</a>&emsp;/&emsp;CV</div>

          <h1 class="font-serif font-size-large"><?php echo $artists[0]->name; ?></h1>

        </div>
      </div>
    </header>

    <section class="container">
      <div class="grid-row">
        <div id="cv-content-holder" class="grid-item item-s-12 item-m-10 item-l-8 font-size-tiny">

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
