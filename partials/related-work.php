<?php
$work_cats = wp_get_post_terms($post->ID, 'work_cat');
$work_info = get_post_meta($post->ID, '_igv_work_info', true);
$work_artists = get_post_artists($post->ID);
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php
if (!empty($work_cats)) {
?>
  <div class="font-sans"><?php echo $work_cats[0]->name; ?></div>
<?php
}
?>

  <h3 class="font-serif font-italic"><?php the_title(); ?></h2>

<?php
if (!empty($work_artists)) {
?>
  <div class="font-serif"><?php echo $work_artists; ?></div>
<?php
}

if (!empty($work_info)) {
?>
  <div class="font-sans margin-top-small"><?php echo $work_info; ?></div>
<?php
}
?>

</article>
