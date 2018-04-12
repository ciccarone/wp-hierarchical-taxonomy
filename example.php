<?php

$taxonomy_term = 'example';

$related_terms = [

  __( 'Parent' ) => [
    __( 'Child 1' ),
    __( 'Child 2' ),
  ],
  __( 'Parent 2') => [
    __( 'Child 3' ),
    __( 'Child 4' ),
  ],

];

foreach ($related_terms as $key => $term) {

  wp_insert_term(
    (string)$key,
    $taxonomy_term,
    [
      'slug' => sanitize_title_with_dashes((string)$key),
    ]
  );

  $parent_term = term_exists( $key, $taxonomy_term );
  $term_id = $parent_term['term_id'];

  foreach ($term as $term_value) {
    wp_insert_term(
      $term_value,
      $taxonomy_term,
      [
        'slug' => sanitize_title_with_dashes( $term_value ),
        'parent'=> $term_id
      ]
    );
  }
}
