<?php

// Custom functions (like special queries, etc)

// Return string of Artists
function get_post_artists($post_id) {
  $artist_terms = wp_get_post_terms($post_id, 'artist');
  $count_terms = count($artist_terms);

  $artists = '';

  for ($i=0; $i < $count_terms; $i++) {
    $artists .= $artist_terms[$i]->name;

    if ($count_terms > 1 && ($i + 1) !== $count_terms) {
      if (($i + 2) === $count_terms) {
        $artists .= ' & ';
      } else {
        $artists .= ', ';
      }
    }
  }

  return $artists;
}

// Return string of Event dates & location
function event_date_location($post_id) {
  $date_location = '';

  $show_dates = get_post_meta($post_id, '_igv_event_show_dates', true);
  $location_terms = wp_get_post_terms($post_id, 'location');

  if (!empty($show_dates)) {
    $start_time = get_post_meta($post_id, '_igv_event_start_date', true);
    $end_time = get_post_meta($post_id, '_igv_event_end_date', true);

    if (!empty($start_time)) {
      $date_location .= translate_datetime('j F, Y', $start_time);

      if (!empty($end_time)) {
        $date_location .= ' — ' . translate_datetime('j F, Y', $end_time);
      }

      if ($location_terms) {
        $date_location .= ' ';
      }
    }

  }

  if ($location_terms) {
    $location = $location_terms[0]->name;
    $location_class = '.location-' . $location_terms[0]->slug;
    $city = get_term_meta($location_terms[0]->term_id, '_igv_location_city', true);

    $date_location .= '[:en]at[:es]en[:] <span class="' . $location_class . '">' . $location . '</span>';

    if (!empty($city)) {
      $date_location .= ', ' . $city;
    }
  }

  return $date_location;
}

// Retrieve, sort, and return array
// of Event and Work posts for Home
// alterneting 1 event, 1 work
function front_page_posts() {
  $args = array(
    'post_type'       =>  array('event'),
    'posts_per_page'  =>  '-1',
    'meta_key'        =>  '_igv_event_start_date',
    'meta_query'      =>  array(
      array(
        'key'     =>  '_igv_event_show_home',
        'value'   =>  'on',
        'compare' =>  '='
      )
    )
  );

  $events = get_posts( $args );

  $args = array(
    'post_type'       =>  array('work'),
    'posts_per_page'  =>  '-1',
    'meta_query'      =>  array(
      array(
        'key'     =>  '_igv_work_show_home',
        'value'   =>  'on',
        'compare' =>  '='
      )
    )
  );

  $works = get_posts( $args );

  $posts = array();

  if (!empty($events) || !empty($works)) {
    $total = count($events) + count($works);

    $total_counter = 0;
    $events_counter = 0;
    $works_counter = 0;

    // iterate over total num of posts
    while ($total_counter < $total) {

      // if event, add to posts array
      if (isset($events[$events_counter])) {
        $posts[] = $events[$events_counter];
      }

      // if work, add to posts array
      if (isset($works[$works_counter])) {
        $posts[] = $works[$works_counter];
      }

      // increment counters
      if (isset($events[$events_counter]) && isset($works[$works_counter])) {
        // increment both
        $events_counter++;
        $works_counter++;
      } else {
        // increment individual
        if (isset($events[$events_counter])) {
          $events_counter++;
        }
        if (isset($works[$works_counter])) {
          $works_counter++;
        }
      }

      // total counters
      $total_counter = $events_counter + $works_counter;
    }
  }

  return $posts;
}
