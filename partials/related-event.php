<?php
$event_cats = wp_get_post_terms($post->ID, 'event_cat');
$event_artists = igv_get_post_artists($post->ID);
$event_date_location = event_date_location($post->ID);

if (!empty($event_cats)) {
?>
  <div class="font-sans"><?php echo $event_cats[0]->name; ?></div>
<?php
}
?>

  <h3 class="font-serif font-italic"><?php the_title(); ?></h2>

<?php
if (!empty($event_artists)) {
?>
  <div class="font-serif"><?php echo $event_artists; ?></div>
<?php
}

if (!empty($event_date_location)) {
?>
  <div class="font-sans margin-top-small"><?php _e($event_date_location); ?></div>
<?php
}
?>
