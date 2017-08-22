<?php

// Add custom meta fields for attachments

function igv_add_attachment_fields( $form_fields, $post ) {

  $default_caption_es = get_post_meta( $post->ID, 'caption_es', true );

  $form_fields['caption_es'] = array(
    'value' => $default_caption_es ? $default_caption_es : '',
    'label' => __( 'Caption Español' ),
    'input' => 'textarea'
  );

  // ARTIST ARCHIVE CAPTION

  $artist_caption_en = get_post_meta( $post->ID, 'artist_caption_en', true );
  $artist_caption_es = get_post_meta( $post->ID, 'artist_caption_es', true );

  $form_fields['artist_caption_en'] = array(
    'value' => $artist_caption_en ? $artist_caption_en : '',
    'label' => __( 'Artist Caption English' ),
    'input' => 'textarea'
  );

  $form_fields['artist_caption_es'] = array(
    'value' => $artist_caption_es ? $artist_caption_es : '',
    'label' => __( 'Artist Caption Español' ),
    'helps' => __( 'Caption used for image on Artist page' ),
    'input' => 'textarea'
  );

  // EVENT PAGE CAPTION

  $event_caption_en = get_post_meta( $post->ID, 'event_caption_en', true );
  $event_caption_es = get_post_meta( $post->ID, 'event_caption_es', true );

  $form_fields['event_caption_en'] = array(
    'value' => $event_caption_en ? $event_caption_en : '',
    'label' => __( 'Event Caption English' ),
    'input' => 'textarea'
  );

  $form_fields['event_caption_es'] = array(
    'value' => $event_caption_es ? $event_caption_es : '',
    'label' => __( 'Event Caption Español' ),
    'helps' => __( 'Caption used for image on Event page' ),
    'input' => 'textarea'
  );

  // WORK PAGE CAPTION

  $work_caption_en = get_post_meta( $post->ID, 'work_caption_en', true );
  $work_caption_es = get_post_meta( $post->ID, 'work_caption_es', true );

  $form_fields['work_caption_en'] = array(
    'value' => $work_caption_en ? $work_caption_en : '',
    'label' => __( 'Work Caption English' ),
    'input' => 'textarea'
  );

  $form_fields['work_caption_es'] = array(
    'value' => $work_caption_es ? $work_caption_es : '',
    'label' => __( 'Work Caption Español' ),
    'helps' => __( 'Caption used for image on Work page' ),
    'input' => 'textarea'
  );

  return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'igv_add_attachment_fields', 10, 2 );


// Save attachments custom meta fields

function igv_save_attachment_meta( $attachment_id ) {

  igv_update_attachment_meta($attachment_id, 'caption_es');

  // ARTIST ARCHIVE CAPTION

  igv_update_attachment_meta($attachment_id, 'artist_caption_en');
  igv_update_attachment_meta($attachment_id, 'artist_caption_es');

  // EVENT PAGE CAPTION

  igv_update_attachment_meta($attachment_id, 'event_caption_en');
  igv_update_attachment_meta($attachment_id, 'event_caption_es');

  // WORK PAGE CAPTION

  igv_update_attachment_meta($attachment_id, 'work_caption_en');
  igv_update_attachment_meta($attachment_id, 'work_caption_es');
}
add_action( 'edit_attachment', 'igv_save_attachment_meta' );


// Update attachment post meta

function igv_update_attachment_meta($attachment_id, $meta_id) {
  if ( isset( $_REQUEST['attachments'][$attachment_id][$meta_id] ) ) {
    $value = $_REQUEST['attachments'][$attachment_id][$meta_id];
    update_post_meta( $attachment_id, $meta_id, $value );
  }
}
