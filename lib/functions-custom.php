<?php

// Custom functions (like special queries, etc)

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

  if ($events || $works) {
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
