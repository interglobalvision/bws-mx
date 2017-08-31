<?php
$work_info = get_post_meta($post->ID, '_igv_work_info', true);
$work_artists = igv_get_post_artists($post->ID);
?>

<a href="<?php the_permalink(); ?>">

  <?php the_post_thumbnail('item-l-4'); ?>

<?
if (!empty($work_artists)) {
?>
  <div class="font-serif"><?php echo $work_artists; ?></div>
<?php
}
?>

  <h3 class="font-serif font-italic"><?php the_title(); ?></h2>

<?
if (!empty($work_info)) {
?>
  <div class="font-serif"><?php echo $work_info; ?></div>
<?php
}
?>

</a>

<div class="margin-top-small font-sans">
  <a href="<?php the_permalink(); ?>" class="link-underline"><?php _e('[:en]Learn more[:es]Más info[:]'); ?></a>
</div>
