<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<div class="d-flex align-items-end justify-content-between flex-wrap mt-6 mb-5" style="gap: 1.25rem">
	<h1 class="woocommerce-checkout__heading has-white-color mb-0">Checkout</h1>
  <p class="mb-1"><strong>Free shipping</strong> on orders over $30.</p>
</div>


	<?php if ($checkout->get_checkout_fields()): ?>
		<div class="d-flex flex-column-reverse flex-lg-row mb-6">
		<div class="wc-checkout has-white-background-color p-4 border-black col-12 col-lg-8" data-logged-in="<?= is_user_logged_in() ? "true" : "false" ?>" data-current-step="login">
			<nav class="checkout-nav">
				<ul>
					<li><a data-checkout-target="login" class="btn is-rounded btn-outline-dark mx-md-2 mb-2 mb-md-0 p-3" href="#login">1. Sign in</a></li>
					<li><a data-checkout-target="shipping" class="btn is-rounded btn-outline-dark mx-md-2 mb-2 mb-md-0 p-3" href="#shipping">2. Shipping</a></li>
					<li><a data-checkout-target="payment" class="btn is-rounded btn-outline-dark mx-md-2 mb-2 mb-md-0 p-3" href="#payment">3. Payment</a></li>
					<li><a data-checkout-target="review" class="btn disabled is-rounded btn-outline-dark mb-2 mb-md-0 mx-md-2 p-3" href="#review">4. Order Summary</a>	</li>
				</ul>
			</nav>
			<div class="checkout-steps mx-n2 mb-4 d-none d-lg-flex">

			</div>

			<div class="" data-checkout-step="login">
				<?php do_action("woocommerce_checkout_login"); ?>
			</div>

			<form name="checkout" method="post" class="checkout woocommerce-checkout pb-5" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				<div class="d-none" data-checkout-step="shipping">
					<!-- <?php wc_cart_totals_shipping_html(); ?> -->
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>

				<div class="d-none" data-checkout-step="payment">

					<?php do_action("woocommerce_checkout_payment"); ?>

					<?php do_action( 'woocommerce_checkout_billing' ); ?>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				</div>

			</form>
		</div>
		<div class="col-12 col-lg-4 flex-shrink-0 p-0 mb-4 mb-lg-0 ml-lg-4">
		<div class="woocommerce-checkout__aside p-4">
			<?php do_action("woocommerce_checkout_before_order_review_heading"); ?>

			<h3 id="order_review_heading" class="is-style-no-uppercase mb-4">
        <?php esc_html_e("Cart Total", "woocommerce"); ?>
      </h3>

			<?php do_action("woocommerce_checkout_before_order_review"); ?>

			<div id="order_review" class="woocommerce-checkout-review-order calculated_shipping cart_totals">
				<?php do_action("woocommerce_checkout_order_review"); ?>
			</div>

			<?php do_action("woocommerce_checkout_after_order_review"); ?>
		</div>
	</div>
	</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>