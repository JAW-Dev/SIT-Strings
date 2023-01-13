<?php

function sit_category_slider($args)
{
	wp_enqueue_script(
		"block-acf-product-slider",
		asset_path("scripts/product-slider.js"),
		["jquery"],
		null,
		true
	);

	extract(
		shortcode_atts(
			[
				"categories" => [],
				"className" => null,
				"disable_link" => null,
				"is_preview" => false,
			],
			$args
		)
	);

	$classNames = array_filter(["product-slider", "category-slider", "alignfull", $className]);

	$categories = $args["categories"];

	if (!empty($categories)): ?>

	<div class="<?= implode(" ", $classNames) ?>">
      <div class="container">
        <div class="product-slider__inner mx-n4">
		      <button class="tns-prev d-flex justify-content-center align-items-center"><?= inline_svg("images/icon-slider-nav-left.svg") ?></button>
          <ol class="product-slider__slides list-unstyled row mx-0 flex-nowrap mb-0">
            <?php foreach ($categories as $category): ?>
              <li class="product-slider__item col-md-3">
                <?php sit_category_preview(['category' => $category, 'className' => 'h-100']) ?>
              </li>
            <?php endforeach; ?>
          </ol>
		      <button class="tns-next d-flex justify-content-center align-items-center"><?= inline_svg("images/icon-slider-nav-right.svg") ?></button>
        </div>
      </div>
    </div>

	<?php elseif ($is_preview): ?>
		<div class="small p-5 text-center">Please select some categories to display.</div>
	<?php endif;
}
function render_sit_category_slider()
{
	sit_category_slider([
		"categories" => get_field("categories"),
		"className" => $block["className"],
		"is_preview" => $is_preview,
	]);
}
