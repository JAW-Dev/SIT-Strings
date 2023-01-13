<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

global $wp_query;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

 if(is_shop()){
  remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
do_action('woocommerce_before_main_content');

$term = is_tax() ? get_queried_object() : null;

$display_products = $term && ('subcategories' !== get_term_meta($term->term_id, 'display_type', true));
?>

<header class="wave-wrapped-section wave-wrapped-section--flip-x wave-wrapped-section--flip-y bb-section alignfull wp-block-acf-wave-wrapped-section alignfull mb-6">
  <div class="bb-container container">
    <div class="row justify-content-center">
      <div class="wave-wrapped-section__col col-sm-auto">
        <div class="wave-wrapped-section__content <?= !$display_products ? 'py-6' : 'pt-sm pb-6' ?>">
          <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <h1 class="archive-heading has-text-align-center is-style-outline mb-0">
              <?= get_field('heading', $term) ?: woocommerce_page_title(false); ?>
            </h1>
          <?php endif; ?>
          <?php if (!empty($term->description)) : ?>
            <div class="archive-description has-text-align-center is-style-lead mx-auto" style="max-width: 856px;">
              <?php
              /**
               * Hook: woocommerce_archive_description.
               *
               * @hooked woocommerce_taxonomy_archive_description - 10
               * @hooked woocommerce_product_archive_description - 10
               */
              do_action('woocommerce_archive_description');
              ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="wave-wrapped-section__left">
          <img src="<?= asset_path('/images/wave-left.svg') ?>" alt="">
        </div>
        <div class="wave-wrapped-section__right">
          <img src="<?= asset_path('/images/wave-right.svg') ?>" alt="">
        </div>
      </div>
    </div>
  </div>
</header>
<?php
if (woocommerce_product_loop()) {

  /**
   * Hook: woocommerce_before_shop_loop.
   *
   * @hooked woocommerce_output_all_notices - 10
   * @hooked woocommerce_result_count - 20
   * @hooked woocommerce_catalog_ordering - 30
   */
  remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
  remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
  if ($term) :
    /**
     * Display "Shop By Sound" bright-mellow filter if enabled
     */
    add_action('woocommerce_before_shop_loop', function () use ($term) {
      if (!get_field('bright_mellow_filter', $term)) :
        return;
      endif;

      $taxonomy = is_tax() ? $term->taxonomy : null;

      $filter_categories_query = new WP_Term_Query([
        'taxonomy' => $taxonomy,
        'parent' => $term->term_id,
        'orderby' => 'brightness',
        'order' => 'DESC',
        'meta_query' => [
          'brightness' => [
            'key' => 'brightness',
            'compare' => '!=',
            'value' => 0,
            'type' => 'NUMERIC',
          ]
        ]
      ]);

      $filter_categories = $filter_categories_query->get_terms();

      if (!empty($filter_categories)) : ?>

        <div class="bright-mellow-filter alignfull mb-6">
          <script>
            document.querySelector('.bright-mellow-filter').classList.add('is-active');
          </script>
          <div class="container">
            <div class="row mb-6">
              <div class="col-12">
                <h2 class="mb-5">Shop by Sound</h2>
                <div class="bright-mellow-filter__range-wrap mb-5">
                  <label for="bright-mellow-range" class="d-flex justify-content-between font-weight-bold" id="bright-mellow-labels">
                    <button type="button" class="btn btn-link text-dark p-0 bright-mellow-range__bright-label">Bright</button>
                    <span class="sr-only">to</span>
                    <button type="button" class="btn btn-link text-dark p-0 bright-mellow-range__mellow-label">Mellow</button>
                  </label>
                  <input type="range" class="bright-mellow-filter__input" step="0.1" id="bright-mellow-range" value="0" autocomplete="off">
                </div>
                <div class="bright-mellow-filter__inner mx-n4">
                  <ol class="bright-mellow-filter__products list-unstyled row mx-0 flex-nowrap mb-0">
                    <?php foreach ($filter_categories as $category) : ?>
                      <div class="bright-mellow-filter__product col-md-3">
                        <?php sit_category_preview(['category' => $category]); ?>
                      </div>
                    <?php endforeach; ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif;
    });

    if ($display_products) :
      add_action('woocommerce_before_shop_loop', function () use ($term, $wp_query) { ?>
        <?php
        $hide_variations = get_field('hide_variations', $term);
		$is_accessories = $term->name == 'Accessories';

        $default_subheading = $hide_variations || $is_accessories ? 'Available Products' : 'Available Gauges';
        ?>
        <div class="row mb-6">
			<div class="col-md-9">
				<h2><?= get_field('subheading', $term) ?: $default_subheading ?></h2>
			</div>
          <div class="col-md-3 product-ordering">
            <?php woocommerce_catalog_ordering() ?>
          </div>
        </div>

        <?php
        $products = $wp_query->posts;
        $filter_products = $products;

        if ($hide_variations) :
          $filter_products = array_map('wc_get_product', $filter_products);
        else :
          // Get all product variations in the current category
          $filter_products = [];
          foreach ($products as $product) :
            $filter_products = array_merge($filter_products, get_product_variation_posts($product));
          endforeach;
        endif;

        // Get filter names from posts, then remove empty items and duplicates
        $filters = array_unique(array_merge([], ...array_map(function ($filter_product) {
          $available_filters = trim(strip_tags(wc_get_product_tag_list($filter_product->get_id()) ?: ''));
          return !empty($available_filters) ? preg_split('/\s*,\s*/', $available_filters) : [];
        }, $filter_products)));

        // Alphabetize filters
        sort($filters);

        // Loop through the filters to create the filter UI
        if (!empty($filters)) : ?>
          <section class="row mt-n4 mb-sm">
            <div class="col-12">
              <h3 class="h5">Filter By</h3>
              <ul class="list-inline list-unstyled product-filters">
                <li class="list-inline-item"><button data-filter-by="All" class="badge rounded-pill mb-2 js-filter-by is-active">All</button></li>
                <?php foreach ($filters as $filter) : ?>
                  <li class="list-inline-item"><button data-filter-by="<?= $filter ?>" class="badge rounded-pill js-filter-by"><?= $filter ?></button></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </section>


        <?php endif; ?>
      <?php }, 20);
    else :
      add_action('woocommerce_before_shop_loop', function () use ($term) {
      ?>
        <h2 class="mb-6">
          <?= get_field('subheading', $term) ?: "All {$term->name}" ?>
        </h2>
  <?php
      }, 20);
    endif;
  endif;


  do_action('woocommerce_before_shop_loop');

  woocommerce_product_loop_start();

  if (wc_get_loop_prop('total')) {
    while (have_posts()) {
      the_post();

      /**
       * Hook: woocommerce_shop_loop.
       */
      do_action('woocommerce_shop_loop');

      wc_get_template_part('content', 'product');
    }
  }

  woocommerce_product_loop_end();


  /**
   * Hook: woocommerce_after_shop_loop.
   *
   * @hooked woocommerce_pagination - 10
   */
  do_action('woocommerce_after_shop_loop');
} else {
  /**
   * Hook: woocommerce_no_products_found.
   *
   * @hooked wc_no_products_found - 10
   */
  do_action('woocommerce_no_products_found');
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');

get_footer('shop');
