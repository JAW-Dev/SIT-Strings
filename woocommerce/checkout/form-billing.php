<?php
/**
 * Checkout billing information form
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields mt-5">


    <input id="bill-to-different-address-checkbox" class="form-check-input woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" type="checkbox" name="bill_to_different_address" value="1" />
    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox mb-0" for="bill-to-different-address-checkbox">
      <?php esc_html_e( 'Bill to a different address?', 'woocommerce' ); ?>
    </label>

	<div id="billing">
		<h2 class="text-capitalize h4 mt-6 mb-4">Billing Address</h2>
		<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

		<div class="woocommerce-billing-fields__field-wrapper">
			<?php
			$fields = $checkout->get_checkout_fields( 'billing' );

			foreach ( $fields as $key => $field ) {
				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
			}
			?>
		</div>

		<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
	</div>

</div>
