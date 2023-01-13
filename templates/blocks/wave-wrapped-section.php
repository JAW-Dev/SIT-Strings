<?php

/**
 * Block: Wave Wrapped Section
 */

$flip_x = get_field('flip_x');
$flip_y = get_field('flip_y');

$className = implode(' ', array_filter([
  $flip_x ? 'wave-wrapped-section--flip-x' : null,
  $flip_y ? 'wave-wrapped-section--flip-y' : null,
  $block['className']
]));

?>
<div class="wave-wrapped-section bb-section alignfull <?= $className ?>">
  <div class="bb-container container">
    <div class="row justify-content-center">
      <div class="wave-wrapped-section__col col-sm-auto">
        <div class="wave-wrapped-section__content <?= get_field('content_class') ?>">
          <InnerBlocks />
        </div>
        <div class="wave-wrapped-section__left">
          <img src="<?= asset_path('images/wave-left.svg') ?>" alt="" />
        </div>
        <div class="wave-wrapped-section__right">
          <img src="<?= asset_path('images/wave-right.svg') ?>" alt="" />
        </div>
      </div>
    </div>
  </div>
</div>
