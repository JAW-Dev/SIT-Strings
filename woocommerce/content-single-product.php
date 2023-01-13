<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

$product_videos = get_field('product_videos');

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
  <div class="row">
    <div class="col-md-5 pb-4 pb-md-6">
      <div class="position-relative">
        <?php
          /**
           * Hook: woocommerce_before_single_product_summary.
           *
           * @hooked woocommerce_show_product_sale_flash - 10
           * @hooked woocommerce_show_product_images - 20
           */

          add_action( 'woocommerce_before_single_product_summary', function() {
            ?>
              <div class="d-md-none">
                <?php
                  woocommerce_template_single_title();
                  woocommerce_template_single_add_to_cart();
                  woocommerce_template_single_price();
                ?>
              </div>
            <?php
          }, 30 );
          do_action( 'woocommerce_before_single_product_summary' );
        ?>
      </div>
    </div>
    <div class="col-md-7 pb-md-6">
      <div class="row d-md-none sticky-top">
        <button class="btn btn-lg btn-block btn-dark justify-content-center text-uppercase p-4" id="mobile-cart">
          Add to Cart
        </button>
        <script>
          document.getElementById('mobile-cart').addEventListener('click', function() {
            var form = document.querySelector('.d-md-none form.cart');
            if (form) {
              form.submit();
            }
          });
        </script>
      </div>
      <div class="summary entry-summary mt-5 mt-md-0">
        <?php
          /**
           * Hook: woocommerce_single_product_summary.
           *
           * @hooked woocommerce_template_single_title - 5
           * @hooked woocommerce_template_single_rating - 10
           * @hooked woocommerce_template_single_price - 10
           * @hooked woocommerce_template_single_excerpt - 20
           * @hooked woocommerce_template_single_add_to_cart - 30
           * @hooked woocommerce_template_single_meta - 40
           * @hooked woocommerce_template_single_sharing - 50
           * @hooked WC_Structured_Data::generate_product_data() - 60
           */
          remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
          remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
          remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
          remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
          remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
          remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
          add_action( 'woocommerce_single_product_summary', function() {
            global $product;
            if (!empty($product->get_short_description())):
              ?><h2 class="h6 no-uppercase"><strong>Description</strong></h2><?php
            endif;
          }, 19);
          add_action( 'woocommerce_single_product_summary', function() {
            ?>
              <div class="d-none d-md-block">
                <?php
                  woocommerce_template_single_title();
                  woocommerce_template_single_add_to_cart();
                  woocommerce_template_single_price();
                ?>
              </div>
            <?php
          }, 0 );
          do_action( 'woocommerce_single_product_summary' );
        ?>
        <?php if ($product->is_type('variable')): ?>
          <?php foreach($product->get_available_variations() as $variation): ?>
            <?php
              $variation = new WC_Product_Variation($variation['variation_id']);
              $gauges = explode(' ', $variation->get_meta('gauges'));
            ?>
            <?php if(!empty($gauges)): ?>
              <div class="gauges mt-4 d-none" data-sku="<?= $variation->get_sku() ?>">
                <h2 class="gauges__heading mb-4 h6 no-uppercase">Gauges</h2>
                <div class="gauges__table text-center">
                  <div class="gauges__row row m-0">
                    <?php foreach($gauges as $index=>$gauge): ?>
                      <div class="gauges__column col p-2 font-weight-bold"><?= $index+1 ?></div>
                    <?php endforeach; ?>
                  </div>
                  <div class="gauges__row row m-0">
                    <?php foreach($gauges as $gauge): ?>
                      <div class="gauges__column col p-2"><?= $gauge ?></div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>

          <script>
            // hide label for Gauge attribute
            var labels = document.querySelectorAll('label[for="pa_gauge"]');
            if (labels) {
              for (i = 0; i < labels.length; i++) {
                var label = labels[i];
                label.parentElement.classList.add('sr-only');
              }
            }

            // show Gauges table for selected variation
            var $gauges = jQuery('.gauges');
            if ($gauges.length) {
              var handleVariationChange = function (event, variation) {
                $gauges.addClass('d-none');
                if (variation) {
                  var sku = variation.sku || null;
                  $gauges.filter('[data-sku="' + sku + '"]').removeClass('d-none');
                }
              };
              jQuery('.single_variation_wrap').on('show_variation', handleVariationChange);
              jQuery('.single_variation_wrap').on('hide_variation', handleVariationChange);
            }
          </script>
        <?php endif; ?>
      </div>
    </div>
  </div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
  remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
  remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
  remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
  add_action('woocommerce_after_single_product_summary', function() {
    // Combine upsells, cross sells, and related products to display a minimum of 4 suggested products
    global $post;
    $product = wc_get_product($post);
    $upsell_ids = $product->get_upsell_ids();
    $cross_sell_ids = $product->get_cross_sell_ids();
    $suggested_ids = array_unique(array_merge($upsell_ids, $cross_sell_ids));
    $suggested_products = array_map('wc_get_product', $suggested_ids);
    if (4 > count($suggested_products)):
      $suggested_products = array_merge($suggested_products, wc_get_related_products($post->ID, 4 - count($suggested_products), $suggested_ids));
    endif;
    ?>
      <section class="bb-section bb-pt-8 bb-pb-6 bg-off-white alignfull">
        <div class="container">
          <h2 class="is-style-h1 is-style-outline fill-light mb-5">Suggested Products</h2>
          <?php sit_product_slider(['products' => $suggested_products]); ?>
        </div>
      </section>
    <?php
  }, 20);
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>
<!-- simple solution for product video embeds -->
<?php if (count($product_videos) > 0): ?>
	<div class="product-video-container">
		<?php foreach ($product_videos as $video) : ?>
			<?php if ($video['use_embed'] != 'false'): ?>
				<div class="product-video product-video--embed" data-thumb="<?= $video['video_thumbnail'] ?>">
				

						<?= $video['video_embed']; ?>

				<?php else : ?>
					<div class="product-video product-video--local" data-thumb="<?= $video['video_thumbnail'] ?>">
						<video poster="<?= $video['video_thumbnail']; ?>" controls preload="none" controls>
							<source src="<?= $video['video_url']; ?>"></source>
						</video>

				<?php endif; ?>

			</div>
		<?php endforeach; ?>
		<button class="close-product-video">⨯ <span class="visually-hidden">Close Product Video</span></button>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>
