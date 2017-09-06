<?php
get_header();
?>

<main id="main-content" class="padding-top-large">
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $event_cats = wp_get_post_terms($post->ID, 'event_cat');
    $event_artists = igv_get_post_artists($post->ID, true);
    $event_date_location = event_date_location($post->ID);
    $event_pdf_en = get_post_meta($post->ID, '_igv_event_pdf_en', true);
    $event_pdf_es = get_post_meta($post->ID, '_igv_event_pdf_es', true);
?>
    <header class="container">
      <div class="grid-row margin-bottom-basic">
        <div class="grid-item item-s-12 item-m-8">
<?php
      if (!empty($event_cats)) {
?>
          <div class="font-sans margin-bottom-basic font-light font-size-tiny"><?php echo $event_cats[0]->name; ?></div>
<?php
      }
?>

          <h1 class="font-serif font-italic font-size-large"><?php echo get_the_title($post->ID); ?></h1>

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
        </div>
      </div>
    </header>

    <section class="container">
      <div class="grid-row margin-bottom-mid">
        <div id="event-text-holder" class="grid-item item-s-12 text-columns text-columns-l-3 font-size-tiny">
          <?php the_content(); ?>
<?php
      if (!empty($event_pdf_en) && !empty($event_pdf_es)) {
        $current_lang = qtranxf_getLanguage();
?>
          <div class="text-align-right padding-top-tiny"><a class="link-underline" href="<?php echo $current_lang == 'en' ? $event_pdf_en : $event_pdf_es; ?>"><?php _e('[:en]Download Press PDF[:es]Descargar PDF de Prensa[:]'); ?></a></div>
<?php
      }
?>
        </div>
      </div>
    </section>

    <?php render_gallery($post->ID); ?>

    <?php
      if (!empty($event_artists)) {
        render_related_by_artists($post->ID);
      }
    ?>

<?php
  }
}
?>

  </article>
</main>

<?php
get_footer();
?>
