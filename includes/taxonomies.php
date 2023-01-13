<?php

// Custom Taxonomies

add_action('init', function () {
  // Artist Category
  register_taxonomy('artist-category', ['artist'], array(
    'labels' => array(
      'name' => __('Artist Category'),
      'singular_name' => ('Artist Category'),
      'search_items' => __('Search Artist Categories'),
      'all_items' => __('All Artist Categories'),
      'parent_item' => __('Parent Artist Categories'),
      'parent_item_colon' => __('Parent Artist Categories:'),
      'edit_item' => __('Edit Artist Category'),
      'update_item' => __('Update Artist Category'),
      'add_new_item' => __('Add New Artist Category'),
      'new_item_name' => __('New Artist Category Name'),
      'menu_name' => __('Artist Categories'),
      'not_found' => __('No Artist Categories found.'),
      'not_found_in_tash' => __('No Artist Categories found in Trash')
    ),
    'hierarchial' => true,
    'show_in_rest' => true
  ));

  // Distributor Country
  register_taxonomy('distributor-country', ['distributor'], array(
    'labels' => array(
      'name' => __('Distributor Countries'),
      'singular_name' => ('Distributor Country'),
      'search_items' => __('Search Distributor Countries'),
      'all_items' => __('All Distributor Countries'),
      'edit_item' => __('Edit Distributor Country'),
      'update_item' => __('Update Distributor Country'),
      'add_new_item' => __('Add New Distributor Country'),
      'new_item_name' => __('New Distributor Country'),
      'menu_name' => __('Countries'),
      'not_found' => __('No Distributor Countries found.'),
      'not_found_in_tash' => __('No Distributor Countries found in Trash')
    ),
    'hierarchial' => true,
    'show_in_rest' => true
  ));
});
