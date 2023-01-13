<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
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
<div <?php wc_product_cat_class("$column_class mb-6", $category); ?>>
  <?php sit_category_preview(['category' => $category, 'className' => 'h-100']) ?>
</div>
