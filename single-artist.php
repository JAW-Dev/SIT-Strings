<?php get_header() ?>

<?php if (have_posts()): ?>
  <?php while(have_posts()): the_post(); ?>
    <article class="artist-single">
      <div class="artist-single__header">
        <div class="container">
          <div class="row">
            <div class="artist-single__content col-lg-7 py-6 order-last order-lg-first">
              <span class="breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></span>
              <h1 class="artist-single__heading has-white-color mb-2"><?php the_title(); ?></h1>
              <p class="h5 mb-4"><?php the_field('band', $artist->ID); ?></p>
              <?php the_content(); ?>
            </div>
            <div class="artist-single__image-container col-lg-5 extend extend--right">
              <div class="extend__inner">
                <div class="position-relative w-100 h-100">
                  <?php $video = get_field('artist_video', $artist->ID); ?>
                  <?php if ($video): ?>
                    <a href="<?= $video ?>"><?= inline_svg('images/play-video.svg') ?></a>
                  <?php endif; ?>
                  <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('large', ['class' => 'artist-single__image']); ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php $products = get_field('artist_products', $artist->ID); ?>
      <?php if ($products): ?>
        <div class="artist-single__products alignfull overflow-hidden">
          <div class="container py-6">
            <h2 class="artist-single__heading has-white-color h1 mb-5 pt-md-2">Shop <?= get_field('first_name') ?: get_the_title(); ?>&rsquo;s Strings</h2>
            <?php sit_product_slider(['products' => $products]) ?>
          </div>
        </div>
      <?php endif; ?>

      <?php
        $related_artists = get_posts([
          'post_type' => 'artist',
          'post_status' => 'publish',
          'posts_per_page' => 4,
          'post__not_in' => [get_the_ID()]
        ]);
      ?>
      <?php if ($related_artists): ?>
        <div class="artist-single__related-artists py-6">
          <div class="container">
            <h2 class="artist-single__heading has-white-color h1 mb-5 pt-md-2">Other Artists</h2>
            <div class="product-slider alignfull overflow-hidden pt-6 mt-n6">
              <div class="container">
                <div class="product-slider__inner">
                  <ol class="product-slider__slides list-unstyled row flex-nowrap mb-0">
                    <?php foreach($related_artists as $related_artist): ?>
                      <div class="artist-single__related-artist product-slider__item col-md-3">
                        <?php sit_artist_preview([
                          'artist' => $related_artist
                        ]); ?>
                      </div>
                    <?php endforeach; ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </article>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer() ?>
