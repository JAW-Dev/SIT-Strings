<?php
/**
 * Checkout login form
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined("ABSPATH") || exit();
?>

<form class="woocommerce-checkout__section" method="post">
  <div class="woocommerce-checkout__subheading pb-3">Sign In</div>

  <?php if (is_user_logged_in()): // user is already logged in ?>
    <p class="mb-3">You are already signed in!</p>
    <a href="#shipping" class="woocommerce-checkout__continue btn btn-dark text-uppercase my-3" data-checkout-target="shipping">Continue</a>
  <?php elseif ("no" === get_option("woocommerce_enable_checkout_login_reminder")): // login at checkin is disabled ?>
    <p class="mb-3">Please continue as a guest.</p>
    <a href="#shipping" class="woocommerce-checkout__continue btn btn-dark text-uppercase my-3" data-checkout-target="shipping">Continue</a>
  <?php else: // show login form ?>

    <p class="mb-5 line-height-lg">
      <strong>Don't have an account?</strong> <a class="text-underline link-red font-weight-bold" href="#shipping" data-checkout-target="shipping">Continue as guest</a> and you'll be able to create an account during checkout.
    </p>

    <?php do_action("woocommerce_login_form_start"); ?>

    <?= $message ? wpautop(wptexturize($message)) : "" ?>

    <p class="small form-row form-row-first mb-2">
      <label for="username"><?php esc_html_e(
      "Username or email",
      "woocommerce",
    ); ?>&nbsp;<span class="required">*</span></label>
      <input type="text" class="input-text" name="username" id="username" autocomplete="username" />
    </p>
    <p class="small form-row form-row-last mb-2">
      <label for="password"><?php esc_html_e(
      "Password",
      "woocommerce",
    ); ?>&nbsp;<span class="required">*</span></label>
      <input class="input-text" type="password" name="password" id="password" autocomplete="current-password" />
    </p>
    <div class="clear"></div>

    <?php do_action("woocommerce_login_form"); ?>

    <div class="mb-4">
      <div class="mb-6" id="remember_me_section">
        <input class="form-check-input woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme checkbox small mb-0" for="rememberme"><?php esc_html_e("Remember me", "woocommerce"); ?></label>
      </div>

      <?php wp_nonce_field("woocommerce-login", "woocommerce-login-nonce"); ?>
      <input type="hidden" name="redirect" value="<?= esc_url($redirect) ?>" />
      <button type="submit" class="d-block btn btn-dark text-uppercase" name="login"
        value="<?php esc_attr_e("Login", "woocommerce"); ?>">
        <?php esc_html_e("Login", "woocommerce"); ?>
      </button>
    </div>
    <p class="lost_password mt-2 mb-0">
      <a href="<?= esc_url(wp_lostpassword_url()) ?>" class="small">
        <?php esc_html_e("Lost your password?", "woocommerce"); ?>
      </a>
    </p>
    <div class="clear"></div>

    <?php do_action("woocommerce_login_form_end"); ?>
  <?php endif; ?>
</form>
