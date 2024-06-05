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
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

// main info
$product_title = $product->get_name();
$product_sku = $product->get_sku();
$product_description = $product->get_description();

// price
if ($product->is_type('variable')) {
    $variation_prices = $product->get_variation_prices();

    if ($variation_prices) {
        $min_price = min($variation_prices['price']);
    }
} else {
    $min_price = $product->get_price();
}

// product metas
$attributes = $product->get_attributes();
$product_meta = array();

foreach ($attributes as $attribute) {
    if ($attribute->get_name() === 'Матеріали') {
        $materials_name = $attribute->get_name();
        $materials_value = $attribute->get_options()[0];
        $product_meta[$attribute->get_name()] = $attribute->get_options()[0];
    } elseif ($attribute->get_name() === 'Примітки') {
        $notes_name = $attribute->get_name();
        $notes_value = $attribute->get_options()[0];
        $product_meta[$attribute->get_name()] = $attribute->get_options()[0];
    }
}

//mobile gallery
$product_image_id = $product->get_image_id();

$mobile_gallery_images = $product->get_gallery_image_ids();

array_unshift($mobile_gallery_images, $product_image_id);

foreach ($mobile_gallery_images as $image_id) {
    $image_html = wp_get_attachment_image($image_id, 'medium');
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <div class="product__wrapper">
        <div class="product__swiper swiper mobile-up-none">
            <button class="wishlist-add" data-id="<?= $product->get_id() ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 0 26 25" width="40px" height="40px">
                    <path d="M23.8,8.4c0,7.4-10.9,13.3-11.4,13.5c-0.2,0.1-0.6,0.1-0.8,0C11.1,21.7,0.2,15.8,0.2,8.4c0-3.6,2.9-6.5,6.5-6.5
	c2.2,0,4.1,0.9,5.2,2.5c1.2-1.6,3.1-2.5,5.2-2.5C20.8,1.9,23.8,4.8,23.8,8.4z" stroke="black" stroke-width="1.5px"></path>
                </svg>
            </button>
            <div class="product__swiper-wrapper swiper-wrapper">
                <?php foreach ($mobile_gallery_images as $image_id) {
                    $image_html = wp_get_attachment_image($image_id);
                ?>
                    <div class="product__swiper-slide swiper-slide">
                        <?php echo $image_html; ?>
                    </div>
                <?php
                } ?>
            </div>
            <div class="product__swiper-pagination dots-primary swiper-pagination"></div>
        </div>
        <div class="container">
            <div class="product__inner">
                <div class="product__case">
                    <div class="product__image mobile-none">
                        <?php
                        $image_id = $product->get_image_id();
                        $image_url = wp_get_attachment_image_url($image_id, 'full');
                        ?>
                        <a href="<?php echo $image_url; ?>" data-fancybox="gallery">
                            <?php
                            echo $product->get_image("large");
                            ?>
                        </a>
                    </div>
                    <div class="product__information">
                        <button class="wishlist-add mobile-none" id="wishlist-btn" data-id="<?= $product->get_id() ?>">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 0 26 25" width="40px" height="40px">
                                <path d="M23.8,8.4c0,7.4-10.9,13.3-11.4,13.5c-0.2,0.1-0.6,0.1-0.8,0C11.1,21.7,0.2,15.8,0.2,8.4c0-3.6,2.9-6.5,6.5-6.5
	c2.2,0,4.1,0.9,5.2,2.5c1.2-1.6,3.1-2.5,5.2-2.5C20.8,1.9,23.8,4.8,23.8,8.4z" stroke="black" stroke-width="1.5px"></path>
                            </svg>

                        </button>
                        <div class="product__content">
                            <h2 class="product__title"><?php echo $product_title; ?></h2>
                            <?php
                            if (!empty($product_sku)) {
                            ?>
                                <p><?php echo __('Артикул: ', 'twentytwenty');
                                    echo $product_sku; ?></p>
                            <?php
                            }
                            ?>
                            <p class="product__price">
                                <?php
                                if ($product->is_type('variable')) {
                                    echo __('від', 'twentytwenty');
                                }
                                ?>
                                <span class="product__price_normal"><?php echo wc_price($min_price); ?></span>
                            </p>
                            <div class="product__content_wrap">
                                <?php if (!empty($product_description)) { ?>
                                    <div class="product__description">
                                        <?php echo $product_description; ?>
                                    </div>
                                <?php } ?>

                                <?php
                                if (!empty($product_meta['Матеріали'])) {
                                ?>
                                    <p><?php echo __('Матеріали: ', 'twentytwenty');
                                        echo $product_meta['Матеріали']; ?></p>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($product_meta['Примітки'])) {
                                ?>
                                    <p><?php echo __('Примітки: ', 'twentytwenty');
                                        echo $product_meta['Примітки']; ?></p>
                                <?php
                                }
                                ?>
                            </div>
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
                            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
                            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
                            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
                            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
                            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
                            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
                            do_action('woocommerce_single_product_summary');

                            ?>
                        </div>
                    </div>
                </div>
                <ul class="product__media mobile-none">
                    <?php
                    $attachment_ids = $product->get_gallery_image_ids();

                    if ($attachment_ids && $product->get_image_id()) {
                        $counter = 1;
                        $product_video = get_field('product_video');

                        foreach ($attachment_ids as $attachment_id) {
                            $image_url = wp_get_attachment_image_url($attachment_id, 'full');
                            if ( ! empty( $product_video ) && $counter == 2) {
                                ?>
                            <li class="product__media_item video_item">
                                <a href="<?php echo $product_video['url'] ;?>" data-fancybox="gallery">
                                    <video src="<?php echo $product_video['url'] ;?>"></video>
                                </a>
                            </li>
                                <?php
                            }
                    ?>
                                    <script>console.log('product_video', <?php echo json_encode($product_video);?>)</script>
                            <li class="product__media_item">
                                <a href="<?php echo $image_url; ?>" data-fancybox="gallery">
                                    <?php
                                    echo wp_get_attachment_image($attachment_id, 'large');
                                    ?>
                                </a>
                            </li>
                    <?php
                            $counter++;
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
wc_get_template_part('single-product/add-to-cart/modal');
?>