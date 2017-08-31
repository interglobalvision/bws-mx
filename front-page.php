<?php
get_header();
?>

<main id="main-content" class="padding-top-large">

  <section id="posts">
    <div class="container">

<?php
$posts = front_page_posts();

if ($posts) {
  $i = 0;

  while ($i < count($posts)) {
    $post_id = $posts[$i]->ID;
    $post_type = $posts[$i]->post_type;


// EVENT

    if ($post_type == 'event') {
      $event_cats = wp_get_post_terms($post_id, 'event_cat');
      $event_artists = igv_get_post_artists($post_id);
      $event_date_location = event_date_location($post_id);
?>
      <div class="grid-row">

        <article <?php post_class('grid-item item-s-12 item-m-7 item-l-6 margin-bottom-mid', $post_id); ?> id="post-<?php echo $post_id; ?>">

<?php
      if (!empty($event_cats)) {
?>
          <div class="font-sans font-size-tiny margin-bottom-basic"><?php echo $event_cats[0]->name; ?></div>
<?php
      }
?>
          <a href="<?php echo get_the_permalink($post_id) ?>" class="js-hover-item">
            <?php echo get_the_post_thumbnail($post_id, 'hover-image', 'class=hover-image'); ?>
            <h2 class="font-serif font-italic font-size-large"><?php echo get_the_title($post_id); ?></h2>

<?php
      if (!empty($event_artists)) {
?>
            <div class="font-serif font-size-mid"><?php echo $event_artists; ?></div>
<?php
      }

      if (!empty($event_date_location)) {
?>
            <div class="font-sans margin-top-small"><?php _e($event_date_location); ?></div>
<?php
      }
?>
          </a>
        </article>

<?php
      if (!isset($posts[$i+1])) {
        // This is the last post
?>
      </div>
<?php
      } else {
        // This is not the last post
        if ($posts[$i+1]->post_type != 'work') {
          // but the next post is not Work
?>
      </div>
<?php
        }
      }
    }


// WORK

    if ($post_type == 'work') {
      $work_cats = wp_get_post_terms($post_id, 'work_cat');
      $work_info = get_post_meta($post_id, '_igv_work_info', true);
      $work_artists = igv_get_post_artists($post_id);

      if (!isset($posts[$i-1])) {
        // This is the first post
?>
      <div class="grid-row justify-end">
<?php
      } else {
        // This is not the first post
        if ($posts[$i-1]->post_type != 'event') {
          // but the previous was not Event
?>
      <div class="grid-row justify-end">
<?php
        }
      }
?>

        <article <?php post_class('grid-item item-s-12 item-m-4 item-l-4 margin-bottom-mid offset-m-1 offset-l-2', $post_id); ?> id="post-<?php echo $post_id; ?>">

<?php
      if ($work_cats) {
?>
          <div class="font-sans font-size-tiny margin-bottom-basic"><?php echo $work_cats[0]->name; ?></div>
<?php
      }
?>
          <a href="<?php echo get_the_permalink($post_id) ?>" class="js-hover-item">
            <?php echo get_the_post_thumbnail($post_id, 'hover-image', 'class=hover-image'); ?>
            <h2 class="font-serif font-italic font-size-mid"><?php echo get_the_title($post_id); ?></h2>

<?php
      if (!empty($work_artists)) {
?>
            <div class="font-serif font-size-small"><?php echo $work_artists; ?></div>
<?php
      }

      if (!empty($work_info)) {
?>
            <div class="font-sans margin-top-small font-size-tiny"><?php echo $work_info; ?></div>
<?php
      }
?>
          </a>

        </article>

      </div>

<?php
    }

    $i++;
  }

}
?>

    </div>
  </section>

</main>

<?php
get_footer();
?>
