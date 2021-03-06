<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
  $args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
  ) );
  $posts = get_posts( $args );
  $post_options = array();
  if ( $posts ) {
    foreach ( $posts as $post ) {
      $post_options [ $post->ID ] = $post->post_title;
    }
  }
  return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_igv_';

  /**
   * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
   */

  // EVENT

  $event_metabox = new_cmb2_box( array(
    'id'            => $prefix . 'event_metabox',
    'title'         => esc_html__( 'Options', 'cmb2' ),
    'object_types'  => array( 'event' ), // Post type
  ) );

  $event_metabox->add_field( array(
    'name' => esc_html__( 'Show on Home', 'cmb2' ),
    'desc' => esc_html__( 'List event on home page', 'cmb2' ),
    'id'   => $prefix . 'event_show_home',
    'type' => 'checkbox',
    'column'  => true,
  ) );

  $event_metabox->add_field( array(
    'name' => esc_html__( 'Start Date', 'cmb2' ),
    'desc' => esc_html__( 'Required', 'cmb2' ),
    'id'   => $prefix . 'event_start_date',
    'type' => 'text_date_timestamp',
  ) );

  $event_metabox->add_field( array(
    'name' => esc_html__( 'End Date', 'cmb2' ),
    'id'   => $prefix . 'event_end_date',
    'type' => 'text_date_timestamp',
  ) );

  $event_metabox->add_field( array(
    'name' => esc_html__( 'Show dates', 'cmb2' ),
    'desc' => esc_html__( 'If unchecked: event date(s) will not appear', 'cmb2' ),
    'id'   => $prefix . 'event_show_dates',
    'type' => 'checkbox',
  ) );

  $event_metabox->add_field( array(
    'name' => esc_html__( 'Press PDF English', 'cmb2' ),
    'desc' => esc_html__( 'Both English and Español PDFs are required for PDF link to appear. If 1 PDF for both: use same PDF for both fields.', 'cmb2' ),
    'id'   => $prefix . 'event_pdf_en',
    'type' => 'file',
  ) );

  $event_metabox->add_field( array(
    'name' => esc_html__( 'Press PDF Español', 'cmb2' ),
    'id'   => $prefix . 'event_pdf_es',
    'type' => 'file',
  ) );


  // WORK

  $work_metabox = new_cmb2_box( array(
    'id'            => $prefix . 'work_metabox',
    'title'         => esc_html__( 'Options', 'cmb2' ),
    'object_types'  => array( 'work' ), // Post type
  ) );

  $work_metabox->add_field( array(
    'name' => esc_html__( 'Show on Home', 'cmb2' ),
    'desc' => esc_html__( 'List work on home page', 'cmb2' ),
    'id'   => $prefix . 'work_show_home',
    'type' => 'checkbox',
    'column'  => true,
  ) );

  $work_metabox->add_field( array(
    'name' => esc_html__( 'Show on Archive', 'cmb2' ),
    'desc' => esc_html__( 'List work on archive page', 'cmb2' ),
    'id'   => $prefix . 'work_show_archive',
    'type' => 'checkbox',
    'column'  => true,
  ) );

  $work_metabox->add_field( array(
    'name' => esc_html__( 'Inventory #', 'cmb2' ),
    'id'   => $prefix . 'work_inventory',
    'type' => 'text',
  ) );

  $work_metabox->add_field( array(
    'name' => esc_html__( 'Year, Material, Dimensions', 'cmb2' ),
    'desc' => esc_html__( 'Appears on work page', 'cmb2' ),
    'id'   => $prefix . 'work_details',
    'type' => 'textarea',
    'attributes' => array(
      'data-cmb2-qtranslate' => true,
    ),
  ) );

  $work_metabox->add_field( array(
    'name' => esc_html__( 'Additional info', 'cmb2' ),
    'desc' => esc_html__( 'Appears on home, archive, related posts, & artist page', 'cmb2' ),
    'id'   => $prefix . 'work_info',
    'type' => 'textarea',
    'attributes' => array(
      'data-cmb2-qtranslate' => true,
    ),
  ) );


  // DOCUMENTATION

  $documentation_metabox = new_cmb2_box( array(
    'id'            => $prefix . 'documentation_metabox',
    'title'         => esc_html__( 'Documentation', 'cmb2' ),
    'object_types'  => array( 'event', 'work' ), // Post type
  ) );

  $documentation_metabox->add_field( array(
    'name' => esc_html__( 'Work images', 'cmb2' ),
    'id'   => $prefix . 'documentation_works',
    'type' => 'file_list',
    'preview_size' => array( 150, 150 ),
  ) );

  $documentation_metabox->add_field( array(
    'name' => esc_html__( 'Installation views', 'cmb2' ),
    'id'   => $prefix . 'documentation_install',
    'type' => 'file_list',
    'preview_size' => array( 150, 150 ),
  ) );


  // INFORMATION

  $info_page = get_page_by_path('information');

  if (!empty($info_page) ) {

    $information_metabox = new_cmb2_box( array(
      'id'            => $prefix . 'info_metabox',
      'title'         => esc_html__( 'Options', 'cmb2' ),
      'object_types'  => array( 'page' ), // Post type
      'show_on'      => array( 'key' => 'id', 'value' => array($info_page->ID) ),
    ) );

    $information_metabox->add_field( array(
      'name' => esc_html__( 'Address', 'cmb2' ),
      'id'   => $prefix . 'info_address',
      'type' => 'textarea_small',
      'attributes' => array(
        'data-cmb2-qtranslate' => true,
      ),
    ) );

    $information_metabox->add_field( array(
      'name' => esc_html__( 'Hours', 'cmb2' ),
      'id'   => $prefix . 'info_hours',
      'type' => 'textarea_small',
      'attributes' => array(
        'data-cmb2-qtranslate' => true,
      ),
    ) );

    $information_metabox->add_field( array(
      'name' => esc_html__( 'Staff', 'cmb2' ),
      'id'   => $prefix . 'info_staff',
      'type' => 'textarea',
      'repeatable' => true,
      'attributes' => array(
        'data-cmb2-qtranslate' => true,
      ),
    ) );

    $staff_group = $information_metabox->add_field( array(
      'id'          => $prefix . 'info_staff',
      'type'        => 'group',
      'options'     => array(
        'group_title'   => esc_html__( 'Member {#}', 'cmb2' ), // {#} gets replaced by row number
        'add_button'    => esc_html__( 'Add Another Member', 'cmb2' ),
        'remove_button' => esc_html__( 'Remove Member', 'cmb2' ),
        'sortable'      => true, // beta
      ),
    ) );

    $information_metabox->add_group_field( $staff_group, array(
      'name'       => esc_html__( 'Name', 'cmb2' ),
      'id'         => 'name',
      'type'       => 'text',
    ) );

    $information_metabox->add_group_field( $staff_group, array(
      'name'       => esc_html__( 'Role', 'cmb2' ),
      'id'         => 'role',
      'type'       => 'text',
      'attributes' => array(
        'data-cmb2-qtranslate' => true,
      ),
    ) );

  }


  // LOCATION

  $location_metabox = new_cmb2_box( array(
    'id'               => $prefix . 'location_metabox',
    'title'            => esc_html__( 'Options', 'cmb2' ), // Doesn't output for term boxes
    'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
    'taxonomies'       => array( 'location' ), // Tells CMB2 which taxonomies should have these fields
  ) );

  $location_metabox->add_field( array(
    'name' => esc_html__( 'City', 'cmb2' ),
    'id'   => $prefix . 'location_city',
    'type' => 'text',
    'attributes' => array(
      'data-cmb2-qtranslate' => true,
    ),
  ) );


  // ATTACHMENTS

  $attachment_metabox = new_cmb2_box( array(
    'id'            => $prefix . 'attachment_metabox',
    'title'         => esc_html__( 'Options', 'cmb2' ),
    'object_types'  => array( 'attachment' ), // Post type
  ) );

  $attachment_metabox->add_field( array(
    'name'        => __( 'Related Work' ),
    'id'          => $prefix . 'attachment_work',
    'type'        => 'post_search_text',
    'post_type'   => 'work',
    'select_type' => 'radio',
    'select_behavior' => 'replace',
  ) );

  $attachment_metabox->add_field( array(
    'name' => esc_html__( 'Default Caption', 'cmb2' ),
    'id'   => $prefix . 'caption_default',
    'type' => 'textarea',
    'attributes' => array(
      'data-cmb2-qtranslate' => true,
    ),
  ) );

  $attachment_metabox->add_field( array(
    'name' => esc_html__( 'Event Caption', 'cmb2' ),
    'id'   => $prefix . 'caption_event',
    'type' => 'textarea',
    'attributes' => array(
      'data-cmb2-qtranslate' => true,
    ),
  ) );

  $attachment_metabox->add_field( array(
    'name' => esc_html__( 'Work Caption', 'cmb2' ),
    'id'   => $prefix . 'caption_work',
    'type' => 'textarea',
    'attributes' => array(
      'data-cmb2-qtranslate' => true,
    ),
  ) );

  $attachment_metabox->add_field( array(
    'name' => esc_html__( 'Artist Caption', 'cmb2' ),
    'id'   => $prefix . 'caption_artist',
    'type' => 'textarea',
    'attributes' => array(
      'data-cmb2-qtranslate' => true,
    ),
  ) );

}
?>
