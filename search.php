<?php

/**
 * Template Name: Search
 */

get_header() ?>

<header class="wave-wrapped-section wave-wrapped-section--flip-x wave-wrapped-section--flip-y bb-section alignfull wp-block-acf-wave-wrapped-section alignfull mb-6">
  <div class="bb-container container">
    <div class="row justify-content-center">
      <div class="wave-wrapped-section__col col-sm-auto">
        <div class="wave-wrapped-section__content py-6">
          <h1 class="has-text-align-center is-style-outline">Search</h1>
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

<div class="container my-sm">
  <div class="row justify-content-center">
    <div class="col-md-6"><?php get_search_form(); ?></div>
  </div>
</div>

<?php if (is_search()): ?>
  <?php
    $products = [];
    $posts_or_pages = [];
    wp_enqueue_script('block-acf-product-slider', asset_path('scripts/product-slider.js'), ['jquery'], null, true);
  ?>
  <div class="container mb-md">
    <?php if (have_posts()): ?>
      <h2 class="mt-6 mb-5">Results for "<?= get_search_query(); ?>"</h2>

      <?php while ( have_posts() ) : the_post(); ?>
        <?php if (get_post_type() == 'product' || get_post_type() == 'product_variation'): ?>
          <?php
            $products[] = $product;
          ?>
        <?php else: ?>
          <?php $posts_or_pages[] = get_the_title(); ?>
        <?php endif; ?>
      <?php endwhile; ?>

      <?php if (!empty($products)): ?>
        <?php if (!empty($posts_or_pages)): ?>
          <h3 class="is-style-outline mb-6">Products</h3>
        <?php endif; ?>
        <div class="alignfull mb-6">
          <div class="container">
			<div class="d-flex flex-wrap">
				<?php foreach ($products as $product) : ?>
					<?php if (!is_a($product, 'WC_Product_Variable')) : ?>
						<?php sit_product_preview(['product' => $product, 'className' => 'h-100 col-12 col-sm-6 col-md-4 col-xl-3 mb-3']); ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
          </div>
        </div>
      <?php endif; ?>

      <?php if (!empty($posts_or_pages)): ?>
        <div class="mt-sm mb-md">
          <?php if (!empty($products)): ?>
            <h3 class="is-style-outline mb-6">Other Results</h3>
          <?php endif; ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <?php if (get_post_type() !== 'product' && get_post_type() !== 'product_variation'): ?>
              <div class="mb-6">
                <h4>
                  <a class="d-block font-weight-bold text-uppercase mb-3 text-dark" href="<?= the_permalink(); ?>">
                    <?= the_title() ?>
                  </a>
                </h4>
                <div class="lead"><?= the_excerpt(); ?></div>
              </div>
            <?php endif; ?>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <h2 class="h3 mt-6 mb-md text-center">No results found for "<?= the_search_query(); ?>"</h2>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php get_footer() ?>
