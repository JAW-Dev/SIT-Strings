<?php
/**
 * Block: Animated Hero
 */
?>
<div class="animated-hero alignfull <?= $block["className"] ?>">
  <div class="animated-hero__animation" id="hero" data-json-path="<?= asset_path(
    "lottie/hero/data.json",
  ) ?>"></div>
  <div class="animated-hero__inner">
    <div class="container">
      <h1><?php the_field("title"); ?></h1>
    </div>
  </div>
</div>
