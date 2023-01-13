<?php
/**
 * Thankyou page
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
      <a class="woocommerce-checkout__cart-link d-none d-lg-block py-6 font-weight-bold text-uppercase" href="/products/"><span class="mr-2"><?= inline_svg('images/icon-chevron-right.svg'); ?></span> Return to Products</a>

      <h1 class="woocommerce-order__heading has-white-color mt-6 mb-5">Checkout</h1>

      <div class="row m-0 mb-6">
        <div class="woocommerce-checkout__main col-xl-9 col-xxl-8 mx-0 mb-4 p-4">
          <div class="checkout-steps mx-n2 mb-4 d-none d-lg-flex">
            <div class="checkout-steps__step disabled btn is-rounded btn-outline-dark mx-md-2 mb-2 mb-md-0 p-3">1. Sign in</div>
            <div class="checkout-steps__step disabled btn is-rounded btn-outline-dark mx-md-2 mb-2 mb-md-0 p-3">2. Shipping & Handling</div>
            <div class="checkout-steps__step disabled btn is-rounded btn-outline-dark mx-md-2 mb-2 mb-md-0 p-3">3. Payment</div>
            <div class="checkout-steps__step current btn is-rounded btn-outline-dark mx-md-2 mb-2 mb-md-0 p-3">4. Order Summary</div>
          </div>

          <?php do_action( 'woocommerce_order_details_before_order_table_items', $order ); ?>

          <div class="woocommerce-order__subheading pb-3">What you bought</div>

          <table class="table table-responsive woocommerce-order__contents" cellspacing="0">
            <thead class="invisible sr-only">
              <tr>
                <th class="product-remove">&nbsp;</th>
                <th class="product-thumbnail">&nbsp;</th>
                <th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                <th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                <th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php do_action( 'woocommerce_before_cart_contents' ); ?>

              <?php
              foreach ( $order_items as $item_id => $item ) {
                $product = $item->get_product();

                wc_get_template(
                  'order/order-details-item.php',
                  array(
                    'order'              => $order,
                    'item_id'            => $item_id,
                    'item'               => $item,
                    'show_purchase_note' => $show_purchase_note,
                    'purchase_note'      => $product ? $product->get_purchase_note() : '',
                    'product'            => $product,
                  )
                );
              }

              do_action( 'woocommerce_order_details_after_order_table_items', $order );
              ?>
            </tbody>
          </table>

          <?php wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) ); ?>
        </div>

        <div class="col-xl-3 col-xxl-4 p-0 pl-xl-4">
          <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
        </div>
      </div>

		<?php endif; ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
