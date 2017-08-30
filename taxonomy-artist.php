<?php
get_header();

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>

<main id="main-content">
  <section id="taxonomy-archive">
    <header class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12">
          <h3 class="margin-bottom-small">Artist</h3>
        </div>
        <div class="grid-item item-s-12 item-m-6">
          <h1 class="margin-bottom-basic"><?php echo $term->name; ?></h1>
        </div>
        <div class="grid-item item-s-12 item-m-6">
          <a href="<?php // echo $getcvlinkhere; ?>">CV</a>
        </div>
      </div>
    </header>
<?php

$events = new WP_Query(array(
  'post_type' => 'event',
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
    <section id="single-artist-events" class="container">
      <div class="grid-row">
<?php
  while ($events->have_posts()) {
    $events->the_post();
?>

        <article <?php post_class('grid-item item-s-12 item-m-3'); ?> id="post-<?php the_ID(); ?>">

          <a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>

          <?php the_content(); ?>

        </article>

<?php
  }
?>
      </div>
    </section>
<?php
}

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
    <section id="single-artist-works" class="container">
      <div class="grid-row margin-bottom-small">
        <div class="grid-item item-s-12">
          Works
        </div>
      </div>
      <div class="grid-row">
<?php
  while ($works->have_posts()) {
    $works->the_post();
?>

        <article <?php post_class('grid-item item-s-12 item-m-3'); ?> id="post-<?php the_ID(); ?>">

          <a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>

          <?php the_post_thumbnail(); ?>

        </article>

<?php
  }
?>
      </div>
    </section>
<?php
}
?>
    </div>
  </section>

</main>

<?php
get_footer();
?>
