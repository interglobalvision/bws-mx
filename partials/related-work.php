<?php
$work_cats = wp_get_post_terms($post->ID, 'work_cat');
$work_info = get_post_meta($post->ID, '_igv_work_info', true);
$work_artists = igv_get_post_artists($post->ID);

if (!empty($work_cats)) {
?>
  <div class="font-sans font-size-tiny font-light margin-bottom-basic"><?php echo $work_cats[0]->name; ?></div>
<?php
}
?>

  <h3 class="font-serif font-italic font-size-mid"><?php the_title(); ?></h2>

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
