(function ($) {
  function filterProducts(filterName) {
    // Get products within selected filter
    var filteredProducts = $(".js-filterable-product").filter(function () {
      return $(this).data("filters").includes(filterName);
    });

    // Add .filter-active to selected products and hide the others
    filteredProducts.addClass("filter-active");
    $(".js-filterable-product:not(.filter-active)").addClass("d-none");
  }

  function toggleActiveButton(btn) {
    $("button.js-filter-by").removeClass("is-active");
    $('button.js-filter-by[data-filter-by="' + btn + '"]').toggleClass(
      "is-active"
    );
  }

  function resetDisplay() {
    $(".js-filterable-product").removeClass("d-none filter-active");
  }

  $(".js-filter-by").on("click", function () {
    var filterName = $(this).data("filter-by");
    resetDisplay();
    toggleActiveButton(filterName);
    filterProducts(filterName);
  });
})(jQuery);
