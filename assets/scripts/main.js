import "@fancyapps/fancybox";
import "bootstrap/js/dist/collapse";
import "./nav";
import "./checkout";
import "./bright-mellow-filter";
import "./product-filters";
import "./product-videos";
import "../styles/main.scss";

(function ($) {
  $('a[href$=".mp4"]').fancybox();
  $(
    ".woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image a"
  ).fancybox({ animationEffect: false });
})(jQuery);
