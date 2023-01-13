window.addEventListener("DOMContentLoaded", () => {
  if (
    document.readyState == "interactive" ||
    document.readyState == "complete"
  ) {
    initCheckout();
  }
});

function initCheckout() {
  const checkoutContainer = document.querySelector(".wc-checkout");
  if (checkoutContainer) {
    const checkoutSteps = document.querySelectorAll("[data-checkout-step]");
    const userLoggedIn = checkoutContainer.dataset.loggedIn == "true";

    let currentStep =
      window.location.hash.substring(1) != ""
        ? window.location.hash.substring(1)
        : "login";

    if (currentStep == "login" && userLoggedIn) {
      console.log("should change currentStep to shipping");
      currentStep = "shipping";
    }

    showTargetStep(currentStep);

    checkoutContainer.addEventListener("click", (e) => {
      const t = e.target;
      if (t.dataset.checkoutTarget) {
        const targetStep = t.dataset.checkoutTarget;

        showTargetStep(targetStep);
      }
    });

    function showTargetStep(targetStep) {
      checkoutSteps.forEach((c) => {
        const step = c.dataset.checkoutStep;

        if (step != targetStep) {
          c.classList.add("d-none");
        } else {
          c.classList.remove("d-none");
        }
      });

      checkoutContainer.dataset.currentStep = targetStep;
    }
  }
}

(function ($) {
  function updateBillingInfo() {
    $("#billing_first_name").val($("#shipping_first_name").val());
    $("#billing_last_name").val($("#shipping_last_name").val());
    $("#billing_company").val($("#shipping_company").val());
    $("#billing_address_1").val($("#shipping_address_1").val());
    $("#billing_address_2").val($("#shipping_address_2").val());
    $("#billing_city").val($("#shipping_city").val());
    $("#billing_state").val($("#shipping_state").find(":selected").val());
    $("#billing_postcode").val($("#shipping_postcode").val());
  }

  // Only copy over the info if the user doesn't have this check. This prevents the data from overwriting the billing info if this is checked should the user go between the two sections after selecting the box to use a different billing
  $("#form_shipping_continue_button").on("click", function () {
    if (!$("#bill-to-different-address-checkbox").is(":checked")) {
      updateBillingInfo();
    }
    $("body").trigger("update_checkout");
  });

  $("[data-checkout-target=payment]").on("click", function () {
    if (!$("#bill-to-different-address-checkbox").is(":checked")) {
      updateBillingInfo();
    }

    setTimeout(function () {
      $("body").trigger("update_checkout");
    }, 750);
  });

  $("#shipping_postcode").on("change", function () {
    updateBillingInfo();
    setTimeout(function () {
      $("body").trigger("update_checkout");
    }, 750);
  });

  $("#shipping_state").on("change", function () {
    updateBillingInfo();
    setTimeout(function () {
      $("body").trigger("update_checkout");
    }, 750);
  });
})(jQuery);
