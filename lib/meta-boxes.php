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
		'name' => esc_html__( 'Start Date', 'cmb2' ),
		'id'   => $prefix . 'event_start_date',
		'type' => 'text_date_timestamp',
	) );

  $event_metabox->add_field( array(
		'name' => esc_html__( 'End Date', 'cmb2' ),
		'id'   => $prefix . 'event_end_date',
		'type' => 'text_date_timestamp',
	) );

  $event_metabox->add_field( array(
		'name' => esc_html__( 'Installation views', 'cmb2' ),
		'id'   => $prefix . 'event_images_install',
		'type' => 'file_list',
    'preview_size' => array( 150, 150 ),
	) );

  $event_metabox->add_field( array(
		'name' => esc_html__( 'Works', 'cmb2' ),
		'id'   => $prefix . 'event_images_works',
		'type' => 'file_list',
    'preview_size' => array( 150, 150 ),
	) );


  // WORK

  $work_metabox = new_cmb2_box( array(
    'id'            => $prefix . 'work_metabox',
    'title'         => esc_html__( 'Options', 'cmb2' ),
    'object_types'  => array( 'work' ), // Post type
  ) );

  $work_metabox->add_field( array(
		'name' => esc_html__( 'Inventory #', 'cmb2' ),
		'id'   => $prefix . 'work_inventory',
		'type' => 'text',
	) );

  $work_metabox->add_field( array(
		'name' => esc_html__( 'Year, Material, Dimensions', 'cmb2' ),
		'id'   => $prefix . 'work_details',
		'type' => 'textarea',
	) );

  $work_metabox->add_field( array(
		'name' => esc_html__( 'Additional info', 'cmb2' ),
		'id'   => $prefix . 'work_info',
		'type' => 'textarea',
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
  		'name' => esc_html__( 'Staff', 'cmb2' ),
  		'id'   => $prefix . 'info_staff',
  		'type' => 'textarea',
      'repeatable' => true,
  	) );

  }

}
?>
