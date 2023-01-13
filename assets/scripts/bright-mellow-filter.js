(function ($) {
  function initBrightMellowFilter(section, isAdmin = false) {
    const $section = $(section).addClass("is-active");
    const $products = $section.find(".bright-mellow-filter__products");
    const $input = $section.find(".bright-mellow-filter__input");
    const $brightLabel = $section.find(".bright-mellow-range__bright-label");
    const $mellowLabel = $section.find(".bright-mellow-range__mellow-label");
    const count = $products.children().length;

    if (count) {
      let translateMax;
      const step = 100 / (count - 1);

      // Helper function to translate the product list left/right based on the range input value
      const translateProducts = (value) => {
        $products.css({
          transform: `translateX(${(translateMax * value) / 100}px)`,
        });
      };

      // Recalculate translateMax when the window is resized
      $(window)
        .resize(() => {
          translateMax =
            -1 * ($products.get(0).scrollWidth - $products.width());
        })
        .resize();

      $input
        // Transform product list when the range slider is dragged
        .on("input", (event) => {
          const value = event.target.value;
          const snapped = Math.round(value / step) * step;
          // snap to step value if close
          if (Math.abs(snapped - value) < 2) {
            event.target.value = snapped;
          }
          translateProducts(event.target.value);
        })
        // Transform product list when the range slider value changes (mouseup, touchend, etc)
        .change((event) => {
          event.preventDefault();
          const value = event.target.value;
          // snap to step value
          const snapped = Math.round(value / step) * step;
          event.target.value = snapped;
          translateProducts(event.target.value);
        })
        .change();

      // Make bright/mellow labels clickable
      $brightLabel.add($mellowLabel).click((event) => {
        event.preventDefault();
        const dir = $(event.target).is($brightLabel) ? -1 : 1;
        const value = parseFloat($input.val());
        const newValue = Math.min(100, Math.max(0, value + dir * step));
        $input.val(newValue).change();
      });
    }

    // Disable links in admin
    if (isAdmin) {
      $section.find("a").click((event) => event.preventDefault());
    }
  }

  if (typeof window.acf !== "undefined") {
    window.acf.addAction(
      "render_block_preview/type=bright-mellow-filter",
      (preview) =>
        initBrightMellowFilter(
          $(preview).find(".bright-mellow-filter").get(0),
          true
        )
    );
  } else {
    $(".bright-mellow-filter").each((index, section) =>
      initBrightMellowFilter(section)
    );
  }
})(jQuery);
