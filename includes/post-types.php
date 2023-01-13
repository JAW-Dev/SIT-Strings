<?php

// Custom Post Types

add_action('init', function () {
  // Artist
  register_post_type(
    'artist',
    array(
      'labels' => array(
        'name' => __('Artists'),
        'singular_name' => __('Artist'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Artist'),
        'edit' => __('Edit'),
        'edit_item' => __('Edit Artist'),
        'new_item' => __('New Artist'),
        'view' => __('View Artist'),
        'search_items' => __('Search Artists'),
        'all_items' => __('All Artists'),
        'not_found' => __('No Artists Found.'),
        'not_found_in_trash' => __('No Artists found in Trash.')
      ),
      'public' => true,
      'has_archive' => false,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'menu_icon' => 'dashicons-admin-generic',
      'show_in_rest' => true,
    )
  );

  // Dealer
  register_post_type(
    'dealer',
    array(
      'labels' => array(
        'name' => __('Dealers'),
        'singular_name' => __('Dealer'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Dealer'),
        'edit' => __('Edit'),
        'edit_item' => __('Edit Dealer'),
        'new_item' => __('New Dealer'),
        'view' => __('View Dealer'),
        'search_items' => __('Search Dealers'),
        'all_items' => __('All Dealers'),
        'not_found' => __('No Dealers Found.'),
        'not_found_in_trash' => __('No Dealers found in Trash.')
      ),
      'public' => true,
      'has_archive' => 'dealers',
      'supports' => array('title', 'excerpt'),
      'menu_icon' => 'dashicons-location',
      'show_in_rest' => true,
    )
  );

  // Distributors
  register_post_type(
    'distributor',
    array(
      'labels' => array(
        'name' => __('Distributors'),
        'singular_name' => __('Distributor'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Distributor'),
        'edit' => __('Edit'),
        'edit_item' => __('Edit Distributor'),
        'new_item' => __('New Distributor'),
        'view' => __('View Distributor'),
        'search_items' => __('Search Distributors'),
        'all_items' => __('All Distributors'),
        'not_found' => __('No Distributors Found.'),
        'not_found_in_trash' => __('No Distributors found in Trash.')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array(
				'with_front' => false,
				'slug' => 'dealers/distributors',
			),
      'supports' => array('title'),
      'menu_icon' => 'dashicons-admin-site-alt3',
      'show_in_rest' => true,
    )
  );
});
