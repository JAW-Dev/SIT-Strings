<?php

/**
 * Block: Diagonal Image Callout
 */

$image_id = get_field('image');

?>
<div class="diagonal-image-callout alignfull">
  <div class="container">
    <div class="row">
      <div class="diagonal-image-callout__content col-md-7">
        <InnerBlocks />
      </div>
      <div class="col-md-5">
        <div class="extend extend--right extend--md">
          <div class="extend__inner">
            <div class="diagonal-image-callout__image">
              <?= wp_get_attachment_image($image_id, 'large') ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
