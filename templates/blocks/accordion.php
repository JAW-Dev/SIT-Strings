<?php

/**
 * Block: Accordion
 */

?>

<?php if (have_rows('accordion')): ?>
  <div class="accordion" id="<?= $block['id'] ?>">
    <?php $i=0; while (have_rows('accordion')): the_row(); ?>
      <div class="card">
        <div class="accordion__header card-header p-0">
          <button type="button" class="accordion__toggle collapsed" data-toggle="collapse" data-target="#<?= $block['id'] ?>-<?= $i ?>">
            <?= get_sub_field('heading'); ?>
            <?= inline_svg('images/icon-chevron.svg') ?>
          </button>
        </div>
        <div id="<?= $block['id'] ?>-<?= $i ?>" class="accordion__content collapse" data-parent="#<?= $block['id'] ?>">
          <div class="card-body"><?= get_sub_field('content'); ?></div>
        </div>
      </div>
      <?php $i++; ?>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
