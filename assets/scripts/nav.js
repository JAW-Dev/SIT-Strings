const { doc } = require("prettier");

const $ = window.jQuery;
const $menuItem = $("#primary-nav .menu-item");

$(".navbar-collapse")
  .on("show.bs.collapse hide.bs.collapse", () => {
    $("body").addClass("is-locked nav-open");
  })
  .on("hidden.bs.collapse", () => {
    $("body").removeClass("is-locked nav-open");
  });

// show products menu by default
var productsOpened = false;
var $productsNav = $($menuItem[0]);

function openProductsNav() {
  $productsNav.find(".sub-menu").addClass("d-flex sub-menu--active");
  $productsNav.addClass("menu-item--active");
  productsOpened = true;
}

function closeProductsNav() {
  $productsNav.find(".sub-menu").removeClass("d-flex sub-menu--active");
  $productsNav.removeClass("menu-item--active");
  productsOpened = false;
}

function toggleProductsNav(currWindowSize) {
  if (!productsOpened && currWindowSize >= 992) {
    openProductsNav();
  } else if (productsOpened && currWindowSize <= 991) {
    closeProductsNav();
  }
}

$(document).ready(function () {
  toggleProductsNav($(window).outerWidth());
});

$(window).on("resize", function () {
  toggleProductsNav($(window).outerWidth());
});

// toggle sub menus
$("#primary-nav .menu-item-has-children").on("click", (e) => {
	const $menu = $(e.currentTarget);
	const $submenu = $menu.find(".sub-menu");

	// Close other items
	$menuItem.find(".sub-menu").removeClass("d-flex sub-menu--active");
	$menuItem.removeClass("menu-item--active");

	if ($submenu.hasClass("sub-menu--active")) {
		e.preventDefault();
		$menu.removeClass("menu-item--active");
		$submenu.removeClass("d-flex sub-menu--active");
	} else {
		$menu.addClass("menu-item--active");
		$submenu.addClass("d-flex sub-menu--active");
	}
});
