<?php

/**
 * Block: Product Slider
 */

function sit_product_slider($args) {
  wp_enqueue_script('block-acf-product-slider', asset_path('scripts/product-slider.js'), ['jquery'], null, true);

  extract(shortcode_atts([
    'products' => [],
    'className' => null,
    'disable_link' => null,
    'is_preview' => false,
  ], $args));

  $classNames = array_filter([
    'product-slider',
    'alignfull',
    $className,
  ]);

  $products = !$products ? [] : array_filter(array_map('wc_get_product', $products));

  if (!empty($products)): ?>
    <div class="<?= implode(' ', $classNames) ?>">
      <div class="container">
        <div class="product-slider__inner mx-n4">
      		<button class="tns-prev d-flex justify-content-center align-items-center"><?= inline_svg("images/icon-slider-nav-left.svg")?></button>
          <ol class="product-slider__slides list-unstyled row mx-0 flex-nowrap mb-0">
            <?php foreach($products as $product): ?>
              <li class="product-slider__item col-md-3">
                <?php sit_product_preview(['product' => $product, 'className' => 'h-100']); ?>
              </li>
            <?php endforeach; ?>
          </ol>
          <button class="tns-next d-flex justify-content-center align-items-center"><?= inline_svg("images/icon-slider-nav-right.svg")?></button>
        </div>
      </div>
    </div>
  <?php elseif ($is_preview): ?>
    <div class="small p-5 text-center">Please select some products to display.</div>
  <?php endif;
}

/**
 * Product Slider - ACF Block render function
 */
function render_sit_product_slider($block, $content = '', $is_preview = false, $post_id = 0) {
  sit_product_slider([
    'products' => get_field('products'),
    'className' => $block['className'],
    'is_preview' => $is_preview,
  ]);
}
