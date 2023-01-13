<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="d-flex align-items-end justify-content-between flex-wrap mt-6 mb-5" style="gap: 1.25rem">
  <h1 class="woocommerce-cart__heading has-white-color mb-0 flex-shrink-0 mr-4">Shopping Cart</h1>
  <p class="mb-1"><strong>Free shipping</strong> on orders over $30.</p>
</div>

<div class="cart-checkout-row row mb-6">
  <form class="cart-checkout-col woocommerce-cart-form col-xl-8" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <table class="table table-responsive cart woocommerce-cart-form__contents" cellspacing="0">
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
      <tbody class="cart__items">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
          $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
          $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

          if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> mb-4 p-2 p-md-3 has-white-background-color">

              <td class="product-remove p-2">
                <?php
                  echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                      '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                      esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                      esc_html__( 'Remove this item', 'woocommerce' ),
                      esc_attr( $product_id ),
                      esc_attr( $_product->get_sku() )
                    ),
                    $cart_item_key
                  );
                ?>
              </td>

              <td class="product-thumbnail p-0">
              <?php
              $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

              if ( ! $product_permalink ) {
                echo $thumbnail; // PHPCS: XSS ok.
              } else {
                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
              }
              ?>
              </td>

              <td class="woocommerce-cart__details pr-2 pr-md-4">
                <span class="product-name mb-2 pr-3" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                  <?php
                  if ( ! $product_permalink ) {
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                  } else {
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                  }

                  do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                  // Meta data.
                  echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                  // Backorder notification.
                  if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                  }
                  ?>
                </span>

                <span class="product-price mb-1" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                  <?php
                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                  ?>
                </span>

                <span class="product-category mb-md-3">
                  <?php
                    $terms = get_the_terms( $product_id, 'product_cat' );
                    echo $terms[0]->name;
                  ?>
                </span>

                <div class="product-total-qty mt-auto">
                  <span class="product-total mr-3" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                    <span class="woocommerce-cart__label text-uppercase mr-1">Total</span>
                    <?php
                      echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                    ?>
                  </span>
                  <span class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                    <span class="woocommerce-cart__label mr-2">QTY</span>
                    <?php
                    if ( $_product->is_sold_individually() ) {
                      $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                    } else {
                      $product_quantity = woocommerce_quantity_input(
                        array(
                          'input_name'   => "cart[{$cart_item_key}][qty]",
                          'input_value'  => $cart_item['quantity'],
                          'max_value'    => $_product->get_max_purchase_quantity(),
                          'min_value'    => '0',
                          'product_name' => $_product->get_name(),
                        ),
                        $_product,
                        false
                      );
                    }

                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                    ?>
                  </span>
                </div>
              </td>
            </tr>
            <?php
          }
        }
        ?>

        <?php do_action( 'woocommerce_cart_contents' ); ?>

        <tr>
          <td colspan="6" class="actions float-md-left p-0">

            <?php if ( wc_coupons_enabled() ) { ?>
              <div class="coupon d-flex">
                <label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter Promo Code', 'woocommerce' ); ?>" /> <button type="submit" class="btn btn-dark text-uppercase" name="apply_coupon" value="<?php esc_attr_e( 'Add', 'woocommerce' ); ?>"><?php esc_attr_e( 'Add', 'woocommerce' ); ?></button>
                <?php do_action( 'woocommerce_cart_coupon' ); ?>
              </div>
            <?php } ?>
          </td>
          <td class="actions float-left float-md-right p-0">

            <button type="submit" class="btn btn-dark text-uppercase" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

            <?php do_action( 'woocommerce_cart_actions' ); ?>

            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
          </td>
        </tr>

        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
      </tbody>
    </table>
    <?php do_action( 'woocommerce_after_cart_table' ); ?>
  </form>

  <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

  <div class="cart-checkout-col cart-collaterals col-xl-4 px-3">
    <?php
      /**
      * Cart collaterals hook.
      *
      * @hooked woocommerce_cross_sell_display
      * @hooked woocommerce_cart_totals - 10
      */
      do_action( 'woocommerce_cart_collaterals' );
    ?>
  </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
