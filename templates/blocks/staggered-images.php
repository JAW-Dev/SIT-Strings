<?php

/**
 * Block: Staggered Images
 */

?>
<?php if (have_rows('images')): ?>
  <div class="staggered-images alignfull <?= $block['className'] ?>">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 offset-sm-1">
          <div class="bb-columns row is-style-wide-gutters">
            <?php while (have_rows('images')): the_row(); ?>
              <?php $image_id = get_sub_field('image'); ?>
              <div class="staggered-images__col bb-column col-md-6">
                <figure>
                  <a href="<?= wp_get_attachment_image_src($image_id, 'full')[0] ?>" data-fancybox="<?= $block['id'] ?>">
                    <?= wp_get_attachment_image($image_id, 'large') ?>
                  </a>
                  <figcaption>
                    <?php the_sub_field('caption') ?>
                  </figcaption>
                </figure>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php elseif ($is_preview): ?>
  <div class="small p-5 text-center">Please select some images to display.</div>
<?php endif; ?>
