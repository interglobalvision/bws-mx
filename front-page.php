<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">

<?php
$posts = front_page_posts();

if ($posts) {
  $i = 0;

  while ($i < count($posts)) {
    $post_id = $posts[$i]->ID;
    $post_type = $posts[$i]->post_type;

    if ($post_type == 'event') {
?>
      <div class="grid-row">

        <article <?php post_class('grid-item item-s-12 item-m-7 item-l-6', $post_id); ?> id="post-<?php echo $post_id; ?>">

          <a href="<?php echo get_the_permalink($post_id) ?>"><?php echo get_the_title($post_id); ?></a>

          <?php echo get_the_content($post_id); ?>

        </article>

<?php
      if (!isset($posts[$i+1])) {
?>
      </div>
<?php
      } else {
        if ($posts[$i+1]->post_type != 'work') {
?>
      </div>
<?php
        }
      }
    }

    if ($post_type == 'work') {
      $classes = 'grid-item item-s-12 item-m-4 offset-m-1 item-l-4 offset-l-2';

      if (!isset($posts[$i-1])) {
        $classes = 'grid-item item-s-12 item-m-4 offset-m-8 item-l-4 offset-l-8';
?>
      <div class="grid-row">
<?php
      } else {
        if ($posts[$i-1]->post_type != 'event') {
          $classes = 'grid-item item-s-12 item-m-4 offset-m-8 item-l-4 offset-l-8';
?>
      <div class="grid-row">
<?php
        }
      }
?>

        <article <?php post_class($classes, $post_id); ?> id="post-<?php echo $post_id; ?>">

          <a href="<?php echo get_the_permalink($post_id) ?>"><?php echo get_the_title($post_id); ?></a>

          <?php echo get_the_content($post_id); ?>

        </article>

      </div>

<?php
    }
    $i++;
  }
} else {
?>
        <article class="u-alert grid-item item-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
}
?>

      </div>
    </div>
  </section>

</main>

<?php
get_footer();
?>
