<?php

// Custom functions (like special queries, etc)

// Return string of Artists
function igv_get_post_artists($post_id, $link = false) {
  $artist_terms = wp_get_post_terms($post_id, 'artist');
  $count_terms = count($artist_terms);

  $artists = '';

  for ($i=0; $i < $count_terms; $i++) {
    if ($link == true) {
      $artists .= '<a href="' . get_term_link($artist_terms[$i]->term_taxonomy_id) . '">' . $artist_terms[$i]->name . '</a>';
    } else {
      $artists .= $artist_terms[$i]->name;
    }

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
    $location_class = 'font-location-' . $location_terms[0]->slug;
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

  // Get events marked as Show on home sort by
  // start_date, start_date should not be empty
  $events_args = array(
    'post_type'       =>  array('event'),
    'posts_per_page'  =>  '-1',
    'meta_key'        =>  '_igv_event_start_date',
    'orderby'         =>  'meta_value',
    'order'           =>  'ASC',
    'meta_query'      =>  array(
      array(
        'key'     =>  '_igv_event_show_home',
        'value'   =>  'on',
        'compare' =>  '='
      )
    )
  );

  $events = get_posts( $events_args );


  $works_args = array(
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

  $works = get_posts( $works_args );

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


// Render related posts section from artist array
function render_related_by_artists($current_post_id) {
  $args = array(
    'post_type' => array('event'),
    'tax_query' => array(
      array(
        'taxonomy' => 'artist',
        'field'    => 'slug',
        'terms'    => get_artist_slug_array($current_post_id),
      ),
    ),
    'posts_per_page' => '20',
    'post__not_in' => array($current_post_id)
  );

  $related = new WP_Query($args);

  if ($related->have_posts()) {
?>
  <section id="related-holder" class="margin-bottom-mid padding-top-basic border-top-white">
    <div class="container">
      <div id="related-row" class="grid-row">
<?php
    while ($related->have_posts()) {
      $related->the_post();

      $post_type = get_post_type();
?>
        <article <?php post_class('grid-item related-item'); ?> id="post-<?php the_ID(); ?>">
          <a href="<?php the_permalink() ?>">
            <?php
              get_template_part('partials/related-event');
            ?>
          </a>
        </article>
<?php
    }
?>
      </div>
    </div>
  </section>
<?php
  }
  wp_reset_postdata();
}

// Return array of artist term slugs from post
function get_artist_slug_array($post_id) {
  $artist_terms = wp_get_post_terms($post_id, 'artist');

  $artist_slug_array = array();

  foreach ($artist_terms as $artist) {
    array_push($artist_slug_array, $artist->slug);
  }

  return $artist_slug_array;
}
