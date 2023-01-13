<?php

/**
 * Block: Video
 */

$video = get_field('video_file');
$poster = get_field('poster_image');
?>
<?php if ($video): ?>
  <div class="video">
    <a href="<?= $video ?>">
      <?= inline_svg('images/play-video.svg') ?>
    </a>
    <?php if ($poster): ?>
      <img class="w-100 video__poster" src="<?= $poster ?>"/>
    <?php endif; ?>
  </div>
<?php elseif ($is_preview): ?>
  <p class="border p-3 m-0 text-center">Please select a video.</p>
<?php endif; ?>
