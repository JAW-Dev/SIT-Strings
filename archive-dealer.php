<?php get_header(); ?>

<article>
  <header class="wave-wrapped-section wave-wrapped-section--flip-x wave-wrapped-section--flip-y bb-section alignfull wp-block-acf-wave-wrapped-section alignfull border-bottom border-light">
    <div class="bb-container container">
      <div class="row justify-content-center">
        <div class="wave-wrapped-section__col col-sm-auto">
          <div class="wave-wrapped-section__content py-6">
            <h1 class="has-text-align-center is-style-outline">Find Us</h1>
          </div>
          <div class="wave-wrapped-section__left">
            <img src="<?= asset_path("images/wave-left.svg") ?>" alt="">
          </div>
          <div class="wave-wrapped-section__right">
            <img src="<?= asset_path("images/wave-right.svg") ?>" alt="">
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="container">
    <?php if (have_posts()) : ?>
      <?php $dealers = sit_dealer_data(); ?>
      <?php $distributors = sit_distributor_data(); ?>
      <?php $dealers = array_merge($dealers, $distributors);
      ?>

      <div class="dealer-search" id="dealer-search" data-cluster-path="<?= str_replace("1.svg", "", asset_path("map-cluster-images/map-cluster-1.svg")) ?>" data-google-maps-api-key="<?= defined("GOOGLE_API_KEY") ? GOOGLE_API_KEY : "" ?>" data-dealers="<?= htmlspecialchars(json_encode($dealers), ENT_QUOTES, "UTF-8") ?>">
        <div class="row dealer-search__row">
          <script>
            document.querySelector('.dealer-search__row').classList.add('d-none');
          </script>

          <?php foreach ($dealers as $dealer) : ?>
            <div class="dealer col-sm-2 col-md-4 col-lg-3 pb-6">
              <h2 class="dealer__title h6 mb-2"><?= $dealer["post_title"] ?></h2>
              <address class="dealer__address"><?= str_replace("\n", "<br>", $dealer["address"] ?: "") ?></address>
              <p class="dealer__phone">
                <?php if (!empty(($phone = trim($dealer["phone"] ?: "")))) : ?>
                  <a href="tel:<?= $phone ?>"><?= $phone ?></a>
                <?php endif; ?>
              </p>
              <?php if (!empty(($location = $dealer["location"]))) : ?>
                <a target="_blank" class="dealer_directions-link" href="https://maps.google.com/maps?saddr=My+Location&daddr=<?= urlencode($location["address"]) ?>">
                  Get Directions
                </a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>



      </div>
    <?php endif; ?>
  </div>

  <!-- <details class="dealer-wrap container">
    <summary><h2>International Dealers and Distributors</h2></summary>

    <?php if (have_posts()) : ?>
      <div class="dealer-search">
        <div class="row dealer-search__row">
          <?php
          $terms = get_terms('distributor-country');

          if ($terms) :
            foreach ($terms as $term) :
              echo '<div class="col-sm-6 col-md-4 pb-6">';
              echo '<h2 class="h4 text-capitalize">' . $term->name . '</h2>';

              // Query with only the current country
              $args = array(
                'post_type' => 'distributor',
                'post_status' => 'publish',
                // 'orderby'               => 'menu_order',
                // 'order'                 => 'DESC',
                'tax_query'  => array(
                  array(
                    'taxonomy' => 'distributor-country',
                    'field' => 'slug',
                    'terms' => $term->slug,
                    'operator' => 'IN'
                  ),
                )
              );
              $loop = new WP_Query($args);

              if ($loop->have_posts()) :
                while ($loop->have_posts()) :
                  $loop->the_post();
                  $address = get_field('Address');
                  $phone = get_field('phone');
                  $email = get_field('email');
                  $fax = get_field('fax');
                  $website = get_field('website');


          ?>
                  <div class="dealer">
                    <?php if (!empty($website)) : ?>
                      <h3 class="dealer__title h6 mb-2"><a href="<?= $website; ?>" target="_blank" rel="noreferrer"><?php the_title() ?></a></h3>
                    <?php else : ?>
                      <h3 class="dealer__title h6 mb-2"><?php the_title() ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($address)) : ?>
                      <address class="dealer__address mb-2"><?= $address; ?></address>
                    <?php endif; ?>

                    <?php if (!empty($phone = trim($phone ?: ''))) : ?>
                      <p class="dealer__phone">
                        <a href="tel:<?= $phone ?>"><?= $phone ?></a>
                      </p>
                    <?php endif; ?>

                    <?php if (!empty($fax = trim($fax ?: ''))) : ?>
                      <p class="dealer__phone mt-n2">
                        <a href="tel:<?= $fax ?>"><?= $fax ?> (Fax)</a>
                      </p>
                    <?php endif; ?>

                    <?php if (!empty($email)) : ?>
                      <a target="_blank" class="dealer__email-link" href="mailto:<?= $email ?>"><svg viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M1.00001 0C0.734792 0 0.480438 0.105357 0.292902 0.292893C0.105365 0.48043 8.58307e-06 0.734784 8.58307e-06 1V1.99551C-2.91055e-06 1.99829 -2.90919e-06 2.00106 8.58307e-06 2.00384V17C8.58307e-06 17.5523 0.447724 18 1.00001 18L21 18C21.2652 18 21.5196 17.8946 21.7071 17.7071C21.8947 17.5196 22 17.2652 22 17V2.00402C22 2.00112 22 1.99823 22 1.99533V1C22 0.447716 21.5523 0 21 0H1.00001ZM19.5052 2L2.49486 2L11 9.65464L19.5052 2ZM2.00001 4.24536V16L20 16V4.24536L11.669 11.7433C11.2887 12.0856 10.7113 12.0856 10.331 11.7433L2.00001 4.24536Z" fill="#BF1E2E" />
                        </svg>Email</a>
                    <?php endif; ?>

                  </div>
                <?php endwhile; ?>
              <?php endif; ?>
              <?php echo '</div>'; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </details> -->

</article>
<div class="mb-md mb-md-lg mb-lg-xl"></div>
<?php get_footer(); ?>
