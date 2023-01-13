<?php
/**
 * Cart totals
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?> has-white-background-color px-3 px-md-4 py-4">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h2 class="is-style-no-uppercase"><?php esc_html_e( 'Cart Total', 'woocommerce' ); ?></h2>

	<table cellspacing="0" class="table">
		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
			<tr class="shipping small mb-4">
				<th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
				<td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
			</tr>
		<?php endif; ?>


		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee row mx-0">
				<th class="col-5"><?php echo esc_html( $fee->name ); ?></th>
				<td class="col-7" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<tr class="cart-subtotal row mx-0">
			<th class="col-5"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			<td class="col-7" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>
		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> row mx-0">
				<th class="col-5 pr-1"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td class="col-7" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<tr class="row mx-0">
			<?php foreach( WC()->session->get('shipping_for_package_0')['rates'] as $method_id => $rate ): ?>
    		<?php if (WC()->session->get('chosen_shipping_methods')[0] == $method_id ): ?>
        	<th class="col-5">Shipping</th>
          <td class="col-7"><?= WC()->cart->get_cart_shipping_total(); ?> (<?= $rate->label?>)</td>
        <?php endif; ?>
			<?php endforeach; ?>
		</tr>

		<?php
			/**
			 * Only display the taxes link on this screen if the user is logged or has OH as the state saved int heir cache (this would mean they've ordered before but didn't create an account AND live in OH)
			 */

			// Check if they have a cached state that is OH
			foreach (WC()->customer->changes as $type => $info ) {
				if($info['state'] === 'OH') {
					$is_cached_OH = true;
				}
			}

			// Display the tax link if they are logged in or have a cached state
			if(is_user_logged_in() || $is_cached_OH) {
				if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
					$taxable_address = WC()->customer->get_taxable_address();
					$estimated_text  = '';

					if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
						/* translators: %s location. */
						$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
					}

					if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
						foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
							?>
							<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> row mx-0">
								<th class="col-5"><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
								<td class="col-7" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr class="tax-total row mx-0">
							<th class="col-5"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
							<td class="col-7" data-title="<?php //echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
						</tr>
						<?php
					}
				}
			}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<tr class="order-total row mx-0">
			<th class="col-5"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			<td class="col-7 data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</table>

	<div class="wc-proceed-to-checkout mx-n4 p-4 border-top mb-n4">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
