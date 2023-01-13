<?php
/**
 * Order Customer Details
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">

  <div class="woocommerce-order__subheading pb-3">Shipping Address</div>

  <address class="p-0 mb-4">
    <?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
  </address>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>


  <div class="woocommerce-order__subheading pb-3">Billing Address</div>

  <address class="p-0 mb-4">
    <?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
  </address>


  <?php if ( $order->get_payment_method_title() ) : ?>
    <div class="woocommerce-order__subheading pb-3">Payment Method</div>
		<?php echo wp_kses_post( $order->get_payment_method_title() ); ?>
	<?php endif; ?>

</section>
