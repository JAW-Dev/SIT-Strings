import { tns } from "tiny-slider/src/tiny-slider";

(function ($) {
  function initSlider(slider, isAdmin = false) {
    const $slider = $(slider);
    const $slides = $slider.find(".product-slider__slides");

    // helper to toggle next/previous controls
    // based on the current number of slider pages
    const toggleControls = (pages) => {
      $slider.toggleClass("product-slider--no-controls", !pages || pages < 2);
    };

    if ($slides.children().length) {
      const prev = $slider.find(".tns-prev");
      const next = $slider.find(".tns-next");

      const tinySlider = tns({
        container: $slides.get(0),
        controls: true,
        items: 1.2,
        loop: false,
        nav: true,
        mouseDrag: true,
        prevButton: prev[0],
        nextButton: next[0],
        onInit: ({ pages }) => {
          let canScroll = true;
          let scrollTimeout;
          let lastDir;

          toggleControls(pages);

          slider.addEventListener("wheel", (event) => {
            const dX = Math.abs(event.deltaX);
            const dY = Math.abs(event.deltaY);
            const isHorizontal = dX > dY;
            if (isHorizontal && dX >= 15) {
              event.preventDefault();

              const scrollDir = event.deltaX > 0 ? "next" : "prev";
              if (canScroll || lastDir !== scrollDir) {
                lastDir = scrollDir;
                canScroll = false;
                tinySlider.goTo(scrollDir);
              }

              if (scrollTimeout) {
                clearTimeout(scrollTimeout);
              }
              scrollTimeout = setTimeout(() => {
                canScroll = true;
              }, 200);
            }
          });
        },
        responsive: {
          576: {
            items: 2.2,
          },
          768: {
            items: 3.2,
          },
          992: {
            items: 4,
          },
        },
      });

      // toggle prev/next controls at each breakpoint
      tinySlider.events.on("newBreakpointEnd", ({ pages }) => {
        toggleControls(pages);

        // re-init on breakpoint change
        // fixes issue where next button may be incorrectly disabled
        setTimeout(() => {
          tinySlider.rebuild();
        }, 0);
      });
    }

    // Disable links in admin
    if (isAdmin) {
      $slider.find(".btn").click((event) => event.preventDefault());
    }
  }

  if (typeof window.acf !== "undefined") {
    window.acf.addAction(
      "render_block_preview/type=product-slider",
      (preview) => initSlider($(preview).find(".product-slider").get(0), true)
    );
  } else {
    $(".product-slider").each((index, slider) => initSlider(slider));
  }
})(jQuery);
