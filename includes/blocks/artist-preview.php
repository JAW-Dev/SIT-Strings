<?php

/**
 * Block: Artist Preview
 */

function sit_artist_preview($args) {
  extract(shortcode_atts([
    'artist' => get_field('artist'),
    'color' => get_field('highlight_color')
  ], $args));

  $post_thumbnail_id = get_post_thumbnail_id($artist->ID);
  ?>

  <?php if($artist): ?>
    <article class="artist-preview">
      <a class="artist-preview__link" href="<?php the_permalink($artist) ?>">
        <?php if ($post_thumbnail_id) : ?>
          <div class="artist-preview__image mb-4 <?= $color; ?>">
            <?= wp_get_attachment_image($post_thumbnail_id, 'large', false, ['class' => 'img-fluid w-100', 'loading' => 'lazy']) ?>
          </div>
        <?php endif; ?>
        <div class="artist-preview__name"><?= $artist->post_title ?></div>
        <div class="artist-preview__band"><?= the_field('band', $artist->ID); ?></div>
      </a>
    </article>
  <?php endif; ?>
  <?php
}
