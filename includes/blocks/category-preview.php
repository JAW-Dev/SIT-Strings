<?php

/**
 * Block: Product Category Preview
 */

function sit_category_preview($args) {
  extract(shortcode_atts([
    'category' => null,
    'className' => null,
    'is_preview' => false,
  ], $args));

  $classNames = array_filter([
    'category-preview',
    'product-preview',
    $className,
  ]);

  if (!empty($category) && 'product_cat' === $category->taxonomy): ?>
    <?php
      $category_link = get_term_link($category);
      $category_description = term_description($category);
      $parent = !empty($category->parent) ? get_term($category->parent) : null;
    ?>
    <article class="<?= implode(' ', $classNames) ?>">
      <div class="product-preview__image mx-auto mb-3">
        <a href="<?= $category_link ?>">
          <?= sit_category_image($category, 'medium', false, ['class' => 'img-fluid w-100']) ?>
        </a>
      </div>
      <?php if ($parent): ?>
        <div class="product-preview__category font-weight-bold">
          <a href="<?= get_term_link($parent) ?>"><?= $parent->name ?></a>
        </div>
      <?php endif; ?>
      <a class="product-preview__name font-weight-bold" href="<?= $category_link ?>">
        <?= $category->name ?>
      </a>
      <?php if (!empty($category_description)): ?>
        <div class="product-preview__description mt-2"><?= $category_description; ?></div>
      <?php endif; ?>
      <div class="wp-block-button is-style-outline-rounded pt-3">
        <a class="wp-block-button__link has-dark-color has-white-background-color" href="<?= $category_link ?>">Learn More</a>
      </div>
    </article>
  <?php endif;
}

function render_sit_category_preview($block, $content = '', $is_preview = false, $post_id = 0) {
  sit_category_preview([
    'category' => get_field('category'),
    'className' => $block['className'],
    'is_preview' => $is_preview,
  ]);
}
