<?php
/**
 * Checkout Form
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined("ABSPATH")) {
  exit();
}

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (
  $checkout->is_registration_required() &&
  !$checkout->is_registration_enabled() &&
  !is_user_logged_in()
) {
  echo esc_html(
    apply_filters(
      "woocommerce_checkout_must_be_logged_in_message",
      __("You must be logged in to checkout.", "woocommerce"),
    ),
  );
  return;
}
?>

<a class="woocommerce-checkout__cart-link d-none d-lg-inline-flex py-6 font-weight-bold text-uppercase" href="/cart/">
  <span class="mr-2"><?= inline_svg("images/icon-chevron-right.svg") ?></span>
  Return to Cart
</a>

<h1 class="woocommerce-checkout__heading has-white-color mt-4 mt-lg-0 mb-4">Checkout</h1>

	<?php if ($checkout->get_checkout_fields()): ?>
			<?php do_action("woocommerce_checkout_before_customer_details"); ?>

			<div class="row m-0">
				<div
          class="woocommerce-checkout-form col-xl-9 col-xxl-8 p-4"
          data-checkout-step="login"
          data-logged-in="<?= is_user_logged_in() ? "true" : "" ?>"
          style="<?= is_user_logged_in() ? "display: none;" : "" ?>"
        >
					<?php do_action("woocommerce_checkout_login"); ?>
				</div>
			</div>
	<?php endif; ?>

<div class="row m-0 mb-6">
	<form name="checkout" method="post" class="checkout woocommerce-checkout-form col-xl-9 col-xxl-8 mx-0 mb-4 p-4"
    action="<?php echo esc_url(wc_get_checkout_url()); ?>"
    enctype="multipart/form-data"
    style="<?= !is_user_logged_in() ? "display: none;" : "" ?>"
  >
		<div>
			<?php if ($checkout->get_checkout_fields()): ?>
        <div class="checkout-steps mx-n2 mb-4 d-none d-lg-flex">
          <a data-checkout-target="login" class="checkout-steps__step btn is-rounded btn-outline-dark mx-2 p-3" href="#login">1. Sign in</a>
          <a data-checkout-target="shipping" class="checkout-steps__step btn is-rounded btn-outline-dark mx-2 p-3" href="#shipping">2. Shipping & Handling</a>
          <a data-checkout-target="payment" class="checkout-steps__step btn is-rounded btn-outline-dark mx-2 p-3" href="#payment">3. Payment</a>
          <a data-checkout-target="review" class="checkout-steps__step disabled btn is-rounded btn-outline-dark mx-2 p-3" href="#review">4. Order Summary</a>
        </div>
				<?php do_action("woocommerce_checkout_before_customer_details"); ?>

				<div class="woocommerce-checkout__section" id="customer_details" data-checkout-step="shipping">

					<div class="mb-4">
						<div class="woocommerce-checkout__subheading">Shipping Method</div>
						<?php wc_cart_totals_shipping_html(); ?>
					</div>

					<?php do_action("woocommerce_checkout_shipping"); ?>
					<a class="woocommerce-checkout__continue btn btn-dark text-uppercase my-3" data-checkout-target="payment">Continue</a>
					<?php do_action("woocommerce_checkout_after_customer_details"); ?>
				</div>

				<div class="woocommerce-checkout__section" data-checkout-step="payment">
					<?php do_action("woocommerce_checkout_payment"); ?>
				</div>
			<?php endif; ?>
		</div>
	</form>

	<?php do_action("woocommerce_after_checkout_form", $checkout); ?>

	<div class="col-xl-3 col-xxl-4 p-0 pl-xl-4">
		<div class="woocommerce-checkout__aside p-4">
			<?php do_action("woocommerce_checkout_before_order_review_heading"); ?>

			<h3 id="order_review_heading" class="is-style-no-uppercase mb-2">
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
