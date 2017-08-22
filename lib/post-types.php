<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>

<style>
#menu-posts-work .dashicons-admin-post:before {
    content: '\f319';
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types

// WORK

add_action( 'init', 'register_cpt_work' );

function register_cpt_work() {

  $labels = array(
    'name' => _x( 'Works', 'work' ),
    'singular_name' => _x( 'Work', 'work' ),
    'add_new' => _x( 'Add New', 'work' ),
    'add_new_item' => _x( 'Add New Work', 'work' ),
    'edit_item' => _x( 'Edit Work', 'work' ),
    'new_item' => _x( 'New Work', 'work' ),
    'view_item' => _x( 'View Work', 'work' ),
    'search_items' => _x( 'Search Works', 'work' ),
    'not_found' => _x( 'No works found', 'work' ),
    'not_found_in_trash' => _x( 'No works found in Trash', 'work' ),
    'parent_item_colon' => _x( 'Parent Work:', 'work' ),
    'menu_name' => _x( 'Works', 'work' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'work', $args );
}

// EVENT

add_action( 'init', 'register_cpt_event' );

function register_cpt_event() {

  $labels = array(
    'name' => _x( 'Events', 'event' ),
    'singular_name' => _x( 'Event', 'event' ),
    'add_new' => _x( 'Add New', 'event' ),
    'add_new_item' => _x( 'Add New Event', 'event' ),
    'edit_item' => _x( 'Edit Event', 'event' ),
    'new_item' => _x( 'New Event', 'event' ),
    'view_item' => _x( 'View Event', 'event' ),
    'search_items' => _x( 'Search Events', 'event' ),
    'not_found' => _x( 'No events found', 'event' ),
    'not_found_in_trash' => _x( 'No events found in Trash', 'event' ),
    'parent_item_colon' => _x( 'Parent Event:', 'event' ),
    'menu_name' => _x( 'Events', 'event' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'event', $args );
}

// ARTIST

add_action( 'init', 'register_cpt_artist' );

function register_cpt_artist() {

  $labels = array(
    'name' => _x( 'Artists', 'artist' ),
    'singular_name' => _x( 'Artist', 'artist' ),
    'add_new' => _x( 'Add New', 'artist' ),
    'add_new_item' => _x( 'Add New Artist', 'artist' ),
    'edit_item' => _x( 'Edit Artist', 'artist' ),
    'new_item' => _x( 'New Artist', 'artist' ),
    'view_item' => _x( 'View Artist', 'artist' ),
    'search_items' => _x( 'Search Artists', 'artist' ),
    'not_found' => _x( 'No artists found', 'artist' ),
    'not_found_in_trash' => _x( 'No artists found in Trash', 'artist' ),
    'parent_item_colon' => _x( 'Parent Artist:', 'artist' ),
    'menu_name' => _x( 'Artists', 'artist' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'artist', $args );
}
