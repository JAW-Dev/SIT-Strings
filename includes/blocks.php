<?php

// Custom ACF Blocks

add_action('acf/init', function () {
  if (function_exists('acf_register_block_type')):
    acf_register_block_type(array(
      'name' => 'artist-list',
      'title' => __('Artist List'),
      'description' => __('Displays a list of artists within a chosen category.'),
      'render_template' => './templates/blocks/artist-list.php',
      'category' => 'layout',
      'icon' => 'grid-view',
      'keywords' => array('artist', 'list')
    ));

    acf_register_block_type(array(
      'name' => 'artist-preview',
      'title' => __('Artist Preview'),
      'description' => __('Displays an artist image, name and band name.'),
      'render_template' => './templates/blocks/artist-preview.php',
      'category' => 'layout',
      'icon' => 'grid-view',
      'keywords' => array('artist', 'preview')
    ));

    acf_register_block_type(array(
      'name' => 'Product Preview',
      'title' => __('Product Preview'),
      'description' => __('Displays an product image, name and price.'),
      'render_callback' => 'render_sit_product_preview',
      'category' => 'layout',
      'icon' => 'grid-view',
      'keywords' => array('product', 'preview')
    ));

    acf_register_block_type(array(
      'name' => 'product-slider',
      'title' => __('Product Slider'),
      'description' => __('Displays a horizontal list of products.'),
      'render_callback' => 'render_sit_product_slider',
      'enqueue_script' => asset_path('scripts/product-slider.js'),
      'category' => 'layout',
      'icon' => 'image-flip-horizontal',
      'keywords' => array('product', 'slider'),
      'mode' => 'edit',
    ));

    acf_register_block_type(array(
      'name' => 'Video',
      'title' => __('Video'),
      'description' => __('Displays a video with poster image and play button.'),
      'render_template' => './templates/blocks/video.php',
      'category' => 'layout',
      'icon' => 'media-video',
      'keywords' => array('video', 'player')
    ));

    acf_register_block_type(array(
      'name' => 'staggered-images',
      'title' => __('Staggered Images'),
      'description' => __('Displays a gallery of images staggered vertically.'),
      'render_template' => './templates/blocks/staggered-images.php',
      'category' => 'layout',
      'icon' => 'images-alt',
      'keywords' => array('staggered', 'images')
    ));

    acf_register_block_type(array(
      'name' => 'wave-wrapped-section',
      'title' => __('Wave Wrapped Section'),
      'description' => __('Displays a section with the content bordered by wavy lines.'),
      'render_template' => './templates/blocks/wave-wrapped-section.php',
      'category' => 'layout',
      'icon' => 'slides',
      'keywords' => array('wave', 'wrapped', 'section'),
      'align' => 'full',
      'supports' => array('jsx' => true, 'align' => ['full'])
    ));

    acf_register_block_type(array(
      'name' => 'Accordion',
      'title' => __('Accordion'),
      'description' => __('Displays collapsible sections of content'),
      'render_template' => './templates/blocks/accordion.php',
      'enqueue_script' => asset_path('scripts/accordion.js'),
      'category' => 'layout',
      'icon' => 'editor-insertmore',
      'keywords' => array('accordion', 'dropdown')
    ));

    acf_register_block_type(array(
      'name' => 'diagonal-image-callout',
      'title' => __('Diagonal Image Callout'),
      'description' => __('Displays a section with an image and content callout.'),
      'render_template' => './templates/blocks/diagonal-image-callout.php',
      'category' => 'layout',
      'icon' => 'slides',
      'keywords' => array('diagonal', 'image', 'callout'),
      'align' => 'full',
      'supports' => array('jsx' => true, 'align' => ['full'])
    ));

    acf_register_block_type(array(
      'name' => 'animated-hero',
      'title' => __('Animated Hero'),
      'description' => __('Displays an animated hero section.'),
      'render_template' => './templates/blocks/animated-hero.php',
      'enqueue_script' => asset_path('scripts/animated-hero.js'),
      'category' => 'layout',
      'icon' => 'slides',
      'keywords' => array('animated', 'hero'),
      'align' => 'full',
      'supports' => array('align' => ['full'])
    ));

	acf_register_block_type(array(
		'name' => 'category-slider',
		'title' => __('Category Slider'),
		'description' => __('Displays a horizontal list of categories.'),
		'render_callback' => 'render_sit_category_slider',
		'category' => 'layout',
		'icon' => 'image-flip-horizontal',
		'keywords' => array('category', 'slider')
	));
  endif;
});
