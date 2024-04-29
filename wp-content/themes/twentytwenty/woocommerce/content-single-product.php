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

// main info
$product_title = $product->get_name();
$product_sku = $product->get_sku();
$product_description = $product->get_description();

// price
$variation_prices = $product->get_variation_prices();

if ( $variation_prices ) {
    $min_price = min( $variation_prices['price'] );
}

// product metas
$attributes = $product->get_attributes();
$product_meta = array();

foreach ( $attributes as $attribute ) {
    if ( $attribute->get_name() === 'Матеріали' ) {
        $materials_name = $attribute->get_name();
        $materials_value = $attribute->get_options()[ 0 ];
        $product_meta[ $attribute->get_name() ] = $attribute->get_options()[ 0 ];
    } elseif ( $attribute->get_name() === 'Примітки' ) {
        $notes_name = $attribute->get_name();
        $notes_value = $attribute->get_options()[ 0 ];
        $product_meta[ $attribute->get_name() ] = $attribute->get_options()[ 0 ];
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
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="product__wrapper">
        <div class="product__swiper swiper mobile-up-none">
            <button class="wishlist-add">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M27.8125 5C24.5859 5 21.7609 6.3875 20 8.73281C18.2391 6.3875 15.4141 5 12.1875 5C9.6191 5.00289 7.15673 6.02447 5.3406 7.8406C3.52447 9.65673 2.50289 12.1191 2.5 14.6875C2.5 25.625 18.7172 34.4781 19.4078 34.8438C19.5898 34.9417 19.7933 34.9929 20 34.9929C20.2067 34.9929 20.4102 34.9417 20.5922 34.8438C21.2828 34.4781 37.5 25.625 37.5 14.6875C37.4971 12.1191 36.4755 9.65673 34.6594 7.8406C32.8433 6.02447 30.3809 5.00289 27.8125 5ZM20 32.3125C17.1469 30.65 5 23.0766 5 14.6875C5.00248 12.782 5.76053 10.9553 7.10791 9.60791C8.45529 8.26053 10.282 7.50248 12.1875 7.5C15.2266 7.5 17.7781 9.11875 18.8438 11.7188C18.9379 11.948 19.0981 12.1441 19.304 12.2821C19.5099 12.4201 19.7521 12.4938 20 12.4938C20.2479 12.4938 20.4901 12.4201 20.696 12.2821C20.9019 12.1441 21.0621 11.948 21.1562 11.7188C22.2219 9.11406 24.7734 7.5 27.8125 7.5C29.718 7.50248 31.5447 8.26053 32.8921 9.60791C34.2395 10.9553 34.9975 12.782 35 14.6875C35 23.0641 22.85 30.6484 20 32.3125Z"
                            fill="black" />
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
<!--                <div class="product__swiper-slide swiper-slide">-->
<!--                    <a href="images/paintings/big-one.jpg" data-fancybox="gallery">-->
<!--                        <img src="images/paintings/big-one.jpg" alt="image">-->
<!--                    </a>-->
<!--                </div>-->
            </div>
            <div class="product__swiper-pagination dots-primary swiper-pagination"></div>
        </div>
        <div class="container">
            <div class="product__inner">
                <div class="product__case">
                    <div class="product__image mobile-none">
                        <?php
                        $image_id = $product->get_image_id();
                        $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                        ?>
                        <a href="<?php echo $image_url; ?>" data-fancybox="gallery">
                            <?php
                            echo $product->get_image( "large" );
                            ?>
                        </a>
                    </div>
                    <div class="product__information">
                        <button class="wishlist-add mobile-none">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M27.8125 5C24.5859 5 21.7609 6.3875 20 8.73281C18.2391 6.3875 15.4141 5 12.1875 5C9.6191 5.00289 7.15673 6.02447 5.3406 7.8406C3.52447 9.65673 2.50289 12.1191 2.5 14.6875C2.5 25.625 18.7172 34.4781 19.4078 34.8438C19.5898 34.9417 19.7933 34.9929 20 34.9929C20.2067 34.9929 20.4102 34.9417 20.5922 34.8438C21.2828 34.4781 37.5 25.625 37.5 14.6875C37.4971 12.1191 36.4755 9.65673 34.6594 7.8406C32.8433 6.02447 30.3809 5.00289 27.8125 5ZM20 32.3125C17.1469 30.65 5 23.0766 5 14.6875C5.00248 12.782 5.76053 10.9553 7.10791 9.60791C8.45529 8.26053 10.282 7.50248 12.1875 7.5C15.2266 7.5 17.7781 9.11875 18.8438 11.7188C18.9379 11.948 19.0981 12.1441 19.304 12.2821C19.5099 12.4201 19.7521 12.4938 20 12.4938C20.2479 12.4938 20.4901 12.4201 20.696 12.2821C20.9019 12.1441 21.0621 11.948 21.1562 11.7188C22.2219 9.11406 24.7734 7.5 27.8125 7.5C29.718 7.50248 31.5447 8.26053 32.8921 9.60791C34.2395 10.9553 34.9975 12.782 35 14.6875C35 23.0641 22.85 30.6484 20 32.3125Z"
                                        fill="black" />
                            </svg>
                        </button>
                        <div class="product__content">
                            <h2 class="product__title"><?php echo $product_title; ?></h2>
                            <p><?php echo __( 'Артикул: ', 'twentytwenty' ); echo $product_sku; ?></p>
                            <p class="product__price"><?php echo __( 'від', 'twentytwenty' ); ?>
                                <span class="product__price_normal"><?php echo wc_price( $min_price ); ?></span>
                                <!-- <span class="product__price_sale">$165</span> -->
                            </p>
                            <div class="product__content_wrap">
                                <?php
                                if ( ! empty ( $product_meta[ 'Матеріали' ] ) ) {
                                ?>
                                    <p><?php echo __('Матеріали: ', 'twentytwenty'); echo $product_meta[ 'Матеріали' ]; ?></p>
                                    <?php
                                }
                                ?>
                                <?php
                                if ( ! empty ( $product_meta[ 'Примітки' ] ) ) {
                                    ?>
                                    <p><?php echo __('Примітки: ', 'twentytwenty'); echo $product_meta[ 'Примітки' ]; ?></p>
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
                                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
                                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
                                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
                                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
                                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
                                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
                                do_action( 'woocommerce_single_product_summary' );

                                ?>
                        </div>
                    </div>
                </div>
                <ul class="product__media mobile-none">
                    <?php
                    $attachment_ids = $product->get_gallery_image_ids();

                    if ( $attachment_ids && $product->get_image_id() ) {
                        foreach ( $attachment_ids as $attachment_id ) {
                            $image_url = wp_get_attachment_image_url( $attachment_id, 'full' );
                            ?>
                            <li class="product__media_item">
                                <a href="<?php echo $image_url; ?>" data-fancybox="gallery">
                                    <?php
                                    echo wp_get_attachment_image( $attachment_id, 'large' );
                                    ?>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
wc_get_template_part( 'single-product/add-to-cart/modal');
?>


