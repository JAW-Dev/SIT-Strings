import "bootstrap/js/dist/collapse";

(function ($) {
  function initAccordion(accordion, isAdmin = false) {
    const $accordion = $(accordion);
    $accordion.find(".collapse").collapse({ toggle: false });

    // Disable links in admin
    if (isAdmin) {
      $accordion.find("a").click((event) => event.preventDefault());
    }
  }

  if (typeof window.acf !== "undefined") {
    window.acf.addAction("render_block_preview/type=accordion", (preview) =>
      initAccordion($(preview).find(".accordion").get(0), true)
    );
  } else {
    $(".accordion").each((index, accordion) => initAccordion(accordion));
  }
})(jQuery);
