<?php

/**
 * Block: Artist List
 */

$category = get_field('category');
$use_random_color = get_field('use_random_color');

$args = [
  'post_type' => 'artist',
  'post_status' => 'publish',
  'posts_per_page' => -1,
];

if (!empty($category)):
  $args['tax_query'] = [[
    'taxonomy' => 'artist-category',
    'terms' => $category->term_id
  ]];
endif;

$artists = get_posts($args);

?>

<?php if ($artists): ?>
  <div class="row">
    <?php foreach($artists as $artist): ?>
      <div class="col-md-3 my-3">
      <?php sit_artist_preview([
        'artist' => $artist,
		'color' => $use_random_color ? random_color_class() : get_field('highlight_color')
      ]); ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
