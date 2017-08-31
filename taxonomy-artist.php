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

<main id="main-content">
  <article id="taxonomy-archive">
    <header class="container margin-bottom-mid">
      <div class="grid-row margin-bottom-basic">
        <div class="grid-item item-s-12">
          <h3>Artist</h3>
        </div>
      </div>
      <div class="grid-row align-items-end">
        <div class="grid-item item-s-12 item-m-6">
          <h1><?php echo $term->name; ?></h1>
        </div>
<?php
if ($cv_post) {
?>
        <div class="grid-item item-s-12 item-m-6">
          <a href="<?php echo get_the_permalink($cv_post[0]->ID); ?>">CV</a>
        </div>
<?php
}
?>
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
    <section id="single-artist-events" class="container margin-bottom-basic">
      <div class="grid-row">
<?php
  while ($events->have_posts()) {
    $events->the_post();
?>

        <article <?php post_class('grid-item item-s-12 item-m-4 item-l-3'); ?> id="post-<?php the_ID(); ?>">
          <a href="<?php the_permalink() ?>">
            <?php get_template_part('partials/related-event'); ?>
          </a>
        </article>

<?php
  }
?>
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
    <section id="single-artist-works" class="container padding-top-basic top-border">
      <div class="grid-row margin-bottom-small">
        <div class="grid-item item-s-12">
          <?php _e('[:en]Works[:es]Obras[:]'); ?>
        </div>
      </div>
      <div class="grid-row">
<?php
  while ($works->have_posts()) {
    $works->the_post();
?>
        <article <?php post_class('grid-item item-s-12 item-m-4'); ?> id="post-<?php the_ID(); ?>">

          <?php get_template_part('partials/artist-work'); ?>

        </article>
<?php
  }
?>
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
