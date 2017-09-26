<?php
get_header();
?>

<main id="main-content" class="padding-top-large">
  <article <?php post_class('margin-bottom-mid'); ?> id="post-<?php the_ID(); ?>">


<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $address = get_post_meta($post->ID, '_igv_info_address', true);
    $hours = get_post_meta($post->ID, '_igv_info_hours', true);
    $staff = get_post_meta($post->ID, '_igv_info_staff', true);
?>

    <h1 class="u-visuallyhidden"><?php the_title(); ?></h1>

    <section class="container">

      <div class="grid-row align-items-end margin-bottom-basic">
        <div class="grid-item item-s-12 item-m-10 item-l-7 flex-grow margin-bottom-basic">
          <?php the_post_thumbnail('item-l-7'); ?>
        </div>

        <div id="information-text" class="grid-item item-s-12 item-m-10 text-columns text-columns-m-2 text-columns-l-1 item-l-4 offset-l-1 margin-bottom-basic font-size-tiny">
          <?php the_content(); ?>
        </div>
      </div>

    </section>

    <section class="container">

      <div class="grid-row font-sans font-size-tiny">
        <div class="grid-item item-s-12 item-m-4 item-l-4 flex-grow margin-bottom-basic">
<?php
    if (!empty($address)) {
?>
          <h2 class="margin-bottom-small"><?php _e('[:en]Location[:es]Ubicación[:]'); ?></h2>
          <?php echo apply_filters('the_content', $address); ?>
<?php
    }
?>
        </div>
        <div class="grid-item item-s-12 item-m-4 item-l-4 flex-grow margin-bottom-basic">
<?php
    if (!empty($hours)) {
?>
          <h2 class="margin-bottom-small"><?php _e('[:en]Hours[:es]Horario[:]'); ?></h2>
          <?php echo apply_filters('the_content', $hours); ?>
<?php
    }
?>
        </div>
        <div class="grid-item item-s-12 item-m-4 item-l-4">
<?php
    if (!empty($staff)) {
      foreach($staff as $member) {
?>
          <div class="margin-bottom-small">
            <h2 class="font-serif font-size-small"><?php echo $member['name']; ?></h2>
            <?php echo $member['role']; ?>
          </div>
<?php
      }
    }
?>
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
