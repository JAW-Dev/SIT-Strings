<?php
/**
 * Shipping Methods Display
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
?>
<tr class="woocommerce-shipping-totals shipping">
  <td colspan="2" data-title="<?php echo esc_attr( $package_name ); ?>">
    <?php if ( $available_methods ) : ?>
      <?php if ( is_cart() ) : ?>
        <p class="woocommerce-shipping-destination mb-3 small">
          <?php
          if ( $formatted_destination ) {
            // Translators: $s shipping destination.
            printf( '<span class="font-weight-bold d-block">' . esc_html__( 'Ship to %s', 'woocommerce' ) . ' ', '</span>' . esc_html( $formatted_destination ));
            $calculator_text = esc_html__( 'Change address', 'woocommerce' );
          } else {
            echo wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', __( 'Taxes will be calculated and shipping options may be updated during checkout.', 'woocommerce' ) ) );
          }
          ?>
        </p>
      <?php endif; ?>
    <?php
      elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
        echo '<div class="mb-3 small">';
        if ( is_cart() && 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
          echo wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html', __( 'Shipping and taxes are calculated during checkout.', 'woocommerce' ) ) );
        } else {
          echo wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'woocommerce' ) ) );
        }
        echo '</div>';
      elseif ( ! is_cart() ) :
        echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) );
      else :
        // Translators: $s shipping destination.
        echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
        $calculator_text = esc_html__( 'Enter a different address', 'woocommerce' );
      endif;
      ?>
    <?php if ( $show_package_details ) : ?>
      <?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
    <?php endif; ?>
    <?php if ( $show_shipping_calculator ) : ?>
      <?php woocommerce_shipping_calculator( $calculator_text ); ?>
    <?php endif; ?>
  </td>
</tr>
