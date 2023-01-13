<?php

/**
 * Block: Product Preview
 */

function sit_product_preview($args) {
  extract(shortcode_atts([
    'product' => null,
    'className' => null,
    'is_preview' => false,
  ], $args));

  $classNames = array_filter([
    'product-preview',
    $className,
  ]);

  if (!empty($product)): ?>
    <?php
      $is_product = false !== stripos(get_class($product), 'WC_Product');
      $product = $is_product ? $product : wc_get_product($product);
      $product_image = sit_product_image($product, 'medium', false, ['class' => 'img-fluid w-100']);
      $product_description = $product->get_description();
	  // get the parent product, just in case
		$parent = wc_get_product($product->get_parent_id());
	// if this product does not have any categories but the parent product does, return $parent's categories
		$categories = $product->get_categories(', ');

		if (!$categories && $parent) {
			$categories = $parent->get_categories(', ');
		}
    ?>
    <article class="<?= implode(' ', $classNames) ?>">
      <?php if (!empty($product_image)): ?>
        <div class="product-preview__image mx-auto mb-3">
          <a href="<?= $product->get_permalink() ?>">
            <?= $product_image ?>
          </a>
        </div>
      <?php endif; ?>
      <div class="product-preview__category font-weight-bold"><?= $categories ?></div>
      <a class="product-preview__name font-weight-bold" href="<?= $product->get_permalink() ?>"><?= $product->name ?></a>
	  <?php
	
	$discounted_price = apply_filters('advanced_woo_discount_rules_get_product_discount_price_from_custom_price', false, $product, 1, 0, 'all', true);	
		if ($discounted_price != false) :
			$artist_price = number_format((float)$discounted_price['discounted_price'], 2, '.', '');
	  ?>
	  
		<div class="product-preview__price font-weight-bold mt-2"><span class="has-red-color">$<?= $artist_price ?></span> <del>$<?= $product->get_price(); ?></del></div>
			
	<?php else : ?>
	  <div class="product-preview__price font-weight-bold mt-2">$<?= $product->get_price(); ?></div>
	<?php endif; ?>
      <?php if (!empty($product_description) && !is_search()): ?>
        <div class="product-preview__description mt-2"><?= $product_description; ?></div>
      <?php endif; ?>
      <div class="wp-block-button is-style-outline-rounded pt-3 d-flex">
        <a class="wp-block-button__link has-dark-color has-white-background-color" href="<?= $product->get_permalink() ?>">Shop Now</a>
		<!-- <a class="wp-block-button__link has-dark-color has-white-background-color" href="<?= $product->get_permalink() ?>">Add to Cart</a> -->
      </div>
    </article>
  <?php endif;
}

function render_sit_product_preview($block, $content = '', $is_preview = false, $post_id = 0) {
  sit_product_preview([
    'product' => get_field('product'),
    'className' => $block['className'],
    'is_preview' => $is_preview,
  ]);
}
