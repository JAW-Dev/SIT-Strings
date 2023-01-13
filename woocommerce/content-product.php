<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;
$this_products_filters = strip_tags(wc_get_product_tag_list(get_the_ID()) ?: '');
if (!empty($this_products_filters)) {
  $filter_class = '';
}
// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
  return;
}

$column_class = 'col-sm-6 col-lg-3';
switch (wc_get_loop_prop('columns')):
  case 2:
    $column_class = 'col-sm-6';
    break;
  case 3:
    $column_class = 'col-sm-6 col-lg-4';
    break;
  case 4:
    $column_class = 'col-sm-6 col-lg-3';
    break;
  case 6:
    $column_class = 'col-sm-6 col-lg-2';
    break;
  default:
endswitch;

?>
<div <?php wc_product_class("$column_class mb-6 js-filterable-product", $product); ?> data-filters="[All<?= !empty($this_products_filters) ? ', ' . $this_products_filters : '' ?>]">
  <?php sit_product_preview(['product' => $product]) ?>
</div>
