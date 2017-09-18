<?php

// Custom hooks (like excerpt length etc)

// Programatically create Home, What We Do and Filming pages
function create_custom_pages() {
  $custom_pages = array(
    'home' => 'Home',
    'information' => 'Information',
  );

  foreach($custom_pages as $page_name => $page_title) {
    $page = get_page_by_path($page_name);
    if( empty($page) ) {
      wp_insert_post( array(
        'post_type' => 'page',
        'post_title' => $page_title,
        'post_name' => $page_name,
        'post_status' => 'publish'
      ));
    }
  }
}
add_filter( 'after_setup_theme', 'create_custom_pages' );


function _igv_wp_ajax_find_posts() {
    check_ajax_referer( 'find-posts' );

    $post_types = get_post_types( array( 'public' => true ), 'objects' );
    unset( $post_types['attachment'] );

    $s = wp_unslash( $_POST['ps'] );
    $args = array(
        'post_type' => array_keys( $post_types ),
        'post_status' => 'any',
        'posts_per_page' => 50,
    );
    if ( '' !== $s )
        $args['s'] = $s;

    $posts = get_posts( $args );

    if ( ! $posts ) {
        wp_send_json_error( __( 'No items found.' ) );
    }

    $html = '<table class="widefat"><thead><tr><th class="found-radio"><br /></th><th>'.__('Title').'</th><th class="no-break">'.__('Type').'</th><th class="no-break">'.__('Date').'</th><th class="no-break">'.__('Status').'</th><th class="no-break">'.__('Thumbnail').'</th></tr></thead><tbody>';
    $alt = '';
    foreach ( $posts as $post ) {
        $title = trim( $post->post_title ) ? $post->post_title : __( '(no title)' );
        $alt = ( 'alternate' == $alt ) ? '' : 'alternate';

        switch ( $post->post_status ) {
            case 'publish' :
            case 'private' :
                $stat = __('Published');
                break;
            case 'future' :
                $stat = __('Scheduled');
                break;
            case 'pending' :
                $stat = __('Pending Review');
                break;
            case 'draft' :
                $stat = __('Draft');
                break;
        }

        if ( '0000-00-00 00:00:00' == $post->post_date ) {
            $time = '';
        } else {
            $time = mysql2date(__('Y/m/d'), $post->post_date);
        }

        $thumb = get_the_post_thumbnail($post->ID, 'post-search');

        $html .= '<tr class="' . trim( 'found-posts ' . $alt ) . '"><td class="found-radio"><input type="radio" id="found-'.$post->ID.'" name="found_post_id" value="' . esc_attr($post->ID) . '"></td>';
        $html .= '<td><label for="found-'.$post->ID.'">' . esc_html( $title ) . '</label></td><td class="no-break">' . esc_html( $post_types[$post->post_type]->labels->singular_name ) . '</td><td class="no-break">'.esc_html( $time ) . '</td><td class="no-break">' . esc_html( $stat ). ' </td><td>' . $thumb . ' </td></tr>' . "\n\n";
    }

    $html .= '</tbody></table>';

    wp_send_json_success( $html );
}

add_action( 'wp_ajax_find_posts', '_igv_wp_ajax_find_posts', 0 );
