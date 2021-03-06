<?php
get_header();

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$cv_post = get_posts(array(
  'numberposts' => '1',
  'post_type' => 'cv',
  'tax_query' => array(
    array(
      'taxonomy' => 'artist',
      'field'    => 'slug',
      'terms'    => $term->slug,
    ),
  ),
));
?>

<main id="main-content" class="padding-top-large">
  <article id="taxonomy-archive">
    <header class="padding-bottom-mid">
      <div class="container">
        <div class="grid-row margin-bottom-basic">
          <div class="grid-item item-s-12 font-size-tiny font-light">
            <h3>Artist</h3>
          </div>
        </div>
        <div class="grid-row align-items-baseline">
          <div class="grid-item item-s-10 item-m-8 item-l-7 item-xl-8">
            <h1 class="font-size-large font-serif"><?php echo $term->name; ?></h1>
          </div>
<?php
if ($cv_post) {
?>
          <div id="cv-link-holder" class="grid-item font-bold">
            <a href="<?php echo get_the_permalink($cv_post[0]->ID); ?>">CV</a>
          </div>
<?php
}
?>
        </div>
      </div>
    </header>
<?php

$events = new WP_Query(array(
  'post_type' => array('event'),
  'tax_query' => array(
    array(
      'taxonomy' => 'artist',
      'field'    => 'slug',
      'terms'    => $term->slug,
    ),
  ),
));

if ($events->have_posts()) {
?>
    <section id="single-artist-events" class="padding-bottom-mid">
      <div class="container">
        <div class="grid-row">
<?php
  while ($events->have_posts()) {
    $events->the_post();
?>

          <article <?php post_class('grid-item item-s-12 item-m-4 item-l-3'); ?> id="post-<?php the_ID(); ?>">
            <a href="<?php the_permalink() ?>" class="js-hover-item">
              <?php echo get_the_post_thumbnail($post->ID, 'hover-image', 'class=hover-image'); ?>
              <?php get_template_part('partials/related-event'); ?>
            </a>
          </article>

<?php
  }
?>
        </div>
      </div>
    </section>
<?php
}

wp_reset_postdata();

$works = new WP_Query(array(
  'post_type' => 'work',
  'tax_query' => array(
    array(
      'taxonomy' => 'artist',
      'field'    => 'slug',
      'terms'    => $term->slug,
    ),
  ),
));

if ($works->have_posts()) {
?>
    <section id="single-artist-works" class="padding-top-basic border-top-white padding-bottom-mid background-grey">
      <div class="container">
        <div class="grid-row margin-bottom-basic">
          <div class="grid-item item-s-12 font-size-tiny font-light">
            <?php _e('[:en]Works[:es]Obras[:]'); ?>
          </div>
        </div>
        <div class="grid-row">
<?php
  while ($works->have_posts()) {
    $works->the_post();
?>
          <article <?php post_class('grid-item item-s-12 item-m-4 margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">

            <?php get_template_part('partials/artist-work'); ?>

          </article>
<?php
  }
?>
        </div>
      </div>
    </section>
<?php
}

wp_reset_postdata();
?>
  </article>
</main>

<?php
get_footer();
?>
