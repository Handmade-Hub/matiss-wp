<?php

/**
 * Template Name: Index Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


get_header();
$banners = get_field('banner');
$slider_products = get_field('products_slider');
?>
<script>
    console.log(<?php print_r(json_encode(
                    $slider_products
                )); ?>)
</script>
<!-- banner -->
<section class="banner">
    <div class="banner__wrapper">
        <div class="banner__swiper swiper">
            <div class="banner__swiper-wrapper swiper-wrapper">

                <?php foreach ($banners as $banner) {
                ?>
                    <div class="banner__swiper-slide swiper-slide">
                        <div class="banner__image">
                            <img src="<?= $banner['main_image']['url'] ?>" alt="<?= $banner['main_image']['alt'] ?>">
                        </div>
                        <div class="banner__content">
                            <div class="container">
                                <div class="banner__inner">
                                    <h1 class="banner__title uppercase fw-600 h1"><?= $banner['title'] ?></h1>
                                    <a href="<?= $banner['button_url']['button_url'] ?>" class="banner__button button__secondary"><?= $banner['button_label'] ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
            </div>
            <div class="banner__swiper-pagination swiper-pagination"></div>
        </div>
    </div>
</section>
<!-- new-collection -->
<section class="new-collection">
    <div class="new-collection__wrapper space-sections">
        <div class="container">
            <div class="new-collection__inner">
                <h2 class="new-collection__title text-center fw-500 uppercase"><?= $slider_products['title'] ?></h2>
                <div class="new-collection__case">
                    <div class="new-collection__swiper swiper">
                        <div class="new-collection__swiper-wrapper swiper-wrapper">
                            <?php
                            $products = $slider_products['products'];
                            foreach ($products as $product_obj) {
                                $product = $product_obj['product'];
                                $wc_data = wc_get_product($product->ID);
                                $price = $wc_data->get_price();

                                $image_id = $wc_data->get_image_id();
                                $image_url = wp_get_attachment_url($image_id);
                                $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                            ?>
                                <div class="new-collection__swiper-slide swiper-slide">
                                    <div class="new-collection__swiper_image">
                                        <img src="<?= $image_url ?>" alt="<?= $image_alt ?>">
                                    </div>
                                    <div class="new-collection__swiper_content">
                                        <p class="new-collection__swiper_title fz-22 fw-500 text-center"><?= $product->post_title ?></p>
                                        <p class="new-collection__swiper_price fz-20 text-center"><?= get_woocommerce_currency_symbol() . $price ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="new-collection__swiper-button-prev swiper-button-prev swiper-button-primary">
                        <div class="arrow-primary">
                            <img src="images/icons/button-arrow-left.svg" alt="arrow-left">
                        </div>
                    </div>
                    <div class="new-collection__swiper-button-next swiper-button-next swiper-button-primary">
                        <div class="arrow-primary">
                            <img src="images/icons/button-arrow-right.svg" alt="arrow-right">
                        </div>
                    </div>
                </div>
                <div class="new-collection__swiper-pagination dots-primary swiper-pagination"></div>
                <a href="<?= $slider_products['button_url'] ?>" class="new-collection__button button__outline"><?= $slider_products['button_label'] ?></a>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
