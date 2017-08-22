<?php

// Add custom meta fields for attachments

function igv_add_attachment_fields( $form_fields, $post ) {
    $artist_caption = get_post_meta( $post->ID, 'artist_caption', true );
    $event_caption = get_post_meta( $post->ID, 'event_caption', true );
    $work_caption = get_post_meta( $post->ID, 'work_caption', true );

    $form_fields['artist_caption'] = array(
        'value' => $artist_caption ? $artist_caption : '',
        'label' => __( 'Artist Caption' ),
        'helps' => __( 'Caption used for image on Artist page' ),
        'input' => 'textarea'
    );

    $form_fields['event_caption'] = array(
        'value' => $event_caption ? $event_caption : '',
        'label' => __( 'Event Caption' ),
        'helps' => __( 'Caption used for image on Event page' ),
        'input' => 'textarea'
    );

    $form_fields['work_caption'] = array(
        'value' => $work_caption ? $work_caption : '',
        'label' => __( 'Work Caption' ),
        'helps' => __( 'Caption used for image on Work page' ),
        'input' => 'textarea'
    );

    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'igv_add_attachment_fields', 10, 2 );


// Save attachments custom meta fields

function igv_save_attachment_meta( $attachment_id ) {
  if ( isset( $_REQUEST['attachments'][$attachment_id]['artist_caption'] ) ) {
    $artist_caption = $_REQUEST['attachments'][$attachment_id]['artist_caption'];
    update_post_meta( $attachment_id, 'artist_caption', $artist_caption );
  }

  if ( isset( $_REQUEST['attachments'][$attachment_id]['event_caption'] ) ) {
    $event_caption = $_REQUEST['attachments'][$attachment_id]['event_caption'];
    update_post_meta( $attachment_id, 'event_caption', $event_caption );
  }

  if ( isset( $_REQUEST['attachments'][$attachment_id]['work_caption'] ) ) {
    $work_caption = $_REQUEST['attachments'][$attachment_id]['work_caption'];
    update_post_meta( $attachment_id, 'work_caption', $work_caption );
  }
}
add_action( 'edit_attachment', 'igv_save_attachment_meta' );
