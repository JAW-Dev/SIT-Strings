<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>

<form class="woocommerce-form-coupon my-3" method="post">
  <p>Have a promo code?</p>
  <div class="coupon d-inline-flex">
    <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter Promo Code', 'woocommerce' ); ?>" /> <button type="submit" class="btn btn-dark text-uppercase<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Add', 'woocommerce' ); ?>"><?php esc_attr_e( 'Add', 'woocommerce' ); ?></button>
    <?php do_action( 'woocommerce_cart_coupon' ); ?>
  </div>

	<div class="clear"></div>
</form>
