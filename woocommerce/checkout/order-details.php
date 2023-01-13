<?php
/**
 * Order details
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
<div class="woocommerce-checkout__aside p-4">
	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

	<h3 class="is-style-no-uppercase"><?php esc_html_e( 'Cart Total Summary', 'woocommerce' ); ?></h3>

  <div class="woocommerce-checkout-review-order">
    <table class="table table-responsive overflow-x-md-hidden">

        <?php
        foreach ( $order->get_order_item_totals() as $key => $total ) {
          ?>
            <tr class="row px-4 <?= $key === 'order_total' ? 'order-total' : '' ?>">
              <th class="col-4"><?php echo esc_html( $total['label'] ); ?></th>
              <td class="col-8"><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
            </tr>
            <?php
        }
        ?>
        <?php if ( $order->get_customer_note() ) : ?>
          <tr class="row">
            <th class="col-4"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
            <td class="col-8"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
          </tr>
        <?php endif; ?>

    </table>

	  <?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
  </div>
</div>

<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );
