<?php

/**
 * BREADCRUMBS
 */

/**
 * Remove the WC breadcrumbs and use RankMath instead
 * Easier to modify
 */
add_action('init', 'woo_remove_wc_breadcrumbs');
function woo_remove_wc_breadcrumbs()
{
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}

add_action('woocommerce_before_main_content', 'output_breadcrumb_container', 9);
function output_breadcrumb_container()
{
	// Dont display on the top-level shop page
	if (!is_shop()) {
		if (function_exists('rank_math_the_breadcrumbs')) {
			echo '<div class="container"><div class="row"><div class="col-12"><span class="breadcrumbs breadcrumbs--short">';
			rank_math_the_breadcrumbs();
			echo '</span></div></div></div>';
		}
	}
}

/**
 * Filters Rank Math breadcrumb settings to add separator
 */
add_filter('rank_math/frontend/breadcrumb/html', function ($html, $crumbs, $class) {
	$chevron = inline_svg('images/icon-chevron-right.svg');
	return str_replace('<span class="separator"> &nbsp; </span>', "<span class='separator'> $chevron </span>", $html);
}, 10, 3);

/**
 * Distributors; add Dealers parent
 */
add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
	if (get_post_type() === 'distributor' && is_archive()) {
		$dist_crumb[] = array(
			"0" => esc_html('Distributors'),
			"1" => esc_url('/distributor/'),
			"hide_in_scheme" => false
		);

		$dealer_crumb[] = array(
			"0" => esc_html('Dealers'),
			"1" => esc_url('/dealers/'),
			"hide_in_scheme" => false
		);

		$new_crumbs = array_merge($dealer_crumb, $dist_crumb);
		array_splice($crumbs, 1, 1, $new_crumbs);

		return $crumbs;
	}
	return $crumbs;
}, 10, 2);

/**
 * Product Categories and Singles: Add main product
 */
add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {

	if (get_post_type() === 'product' || is_product_category()) {
				
		// add products crumb
		$new_crumb[] = array(
			"0" => esc_html('Products'),
			"1" => esc_url('/products/'),
			"hide_in_scheme" => false
		);

		array_splice($crumbs, 1, 0, $new_crumb);
	}

	if (get_post_type() === 'product' && !is_product_category()) {
		$product = wc_get_product(get_the_ID());

		// test if product has the gauge product attribute
		// change the content of the last breadcrumb depending
		$has_gauge = array_search('pa_gauge', array_keys($product->attributes)) !== false;
		$last_crumb_title = $has_gauge ? "Select Gauge" : "Select Option";

		// get the product primary category; function in functions.php
		$product_primary_category_id = get_product_primary_category_id(get_the_ID());
		$primary_cat = get_term($product_primary_category_id);
		$primary_cat_link = get_category_link($product_primary_category_id);

		// need to compare this down the line so we don't double up on breadcrumbs
		$next_last = $crumbs[array_key_last($crumbs) - 1];

		// update the last breadcrumb to display the title generated earlier
		$last = $crumbs[array_key_last($crumbs)];
		$last[0] = $last_crumb_title;
		$crumbs[array_key_last($crumbs)] = $last;

		// if the next last crumb is not the same as the primary category, insert the primary category after it
		if ($next_last[0] != $primary_cat->name) {
			$cat_crumb[] = array(
				"0" => esc_html($primary_cat->name),
				"1" => esc_url($primary_cat_link),
				"hide_in_scheme" => false
			);

			array_splice($crumbs, array_key_last($crumbs), 0, $cat_crumb);
		}

		return $crumbs;
	} else if (get_post_type() === 'artist') {

		$new_crumb[]  = array(
			"0" => esc_html('Artists'),
			"1" => esc_url('/artists/'),
			"hide_in_scheme" => false
		);
		array_splice($crumbs, 1, 0, $new_crumb);

		return $crumbs;
	}

	return $crumbs;
}, 10, 2);


// /**
//  * Artist parent page addition
//  */
// add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
	
// }, 10, 2);
