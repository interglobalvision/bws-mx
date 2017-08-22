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
		'name' => esc_html__( 'Artists', 'cmb2' ),
		'id'   => $prefix . 'event_artists',
		'type' => 'post_search_text',
    'post_type'   => 'artist',
    'select_behavior' => 'replace',
	) );

  $event_metabox->add_field( array(
		'name' => esc_html__( 'Images', 'cmb2' ),
		'id'   => $prefix . 'event_images',
		'type' => 'file_list',
    'preview_size' => array( 150, 150 ),
	) );

}
?>
