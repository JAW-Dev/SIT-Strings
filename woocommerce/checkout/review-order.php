<?php

/**
 * Review order table
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>
<table class="table table-responsive woocommerce-checkout-review-order-table">
  <tr class="cart-subtotal row mx-0">
    <th class="col-4"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
    <td class="col-8"><?php wc_cart_totals_subtotal_html(); ?></td>
  </tr>

  <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
    <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> row mx-0">
      <th class="col-4"><?php wc_cart_totals_coupon_label($coupon); ?></th>
      <td class="col-8"><?php wc_cart_totals_coupon_html($coupon); ?></td>
    </tr>
  <?php endforeach; ?>

  <tr class="row mx-0">
    <?php foreach (WC()->session->get('shipping_for_package_0')['rates'] as $method_id => $rate) : ?>
      <?php if (WC()->session->get('chosen_shipping_methods')[0] == $method_id) : ?>
        <th class="col-4">Shipping</th>
        <td class="col-8"><?= WC()->cart->get_cart_shipping_total(); ?> (<?= $rate->label ?>)</td>
      <?php endif; ?>
    <?php endforeach; ?>
  </tr>

  <?php foreach (WC()->cart->get_fees() as $fee) : ?>
    <tr class="fee row mx-0">
      <th class="col-4"><?php echo esc_html($fee->name); ?></th>
      <td class="col-8"><?php wc_cart_totals_fee_html($fee); ?></td>
    </tr>
  <?php endforeach; ?>

  <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
    <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
      <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
      ?>
        <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> row">
          <th class="col-4"><?php echo esc_html($tax->label); ?></th>
          <td class="col-8"><?php echo wp_kses_post($tax->formatted_amount); ?></td>
        </tr>
      <?php endforeach; ?>
    <?php else : ?>
      <tr class="tax-total row mx-0">
        <th class="col-4"><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
        <td class="col-8"><?php wc_cart_totals_taxes_total_html(); ?></td>
      </tr>
    <?php endif; ?>
  <?php endif; ?>

  <?php do_action('woocommerce_review_order_before_order_total'); ?>

  <tr class="order-total row mx-0">
    <th class="col-4"><?php esc_html_e('Total', 'woocommerce'); ?></th>
    <td class="col-8"><?php wc_cart_totals_order_total_html(); ?></td>
  </tr>

  <?php do_action('woocommerce_review_order_after_order_total'); ?>

  </tfoot>
</table>
