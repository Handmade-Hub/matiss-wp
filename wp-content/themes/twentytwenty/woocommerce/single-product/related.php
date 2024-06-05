<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$terms = wp_get_post_terms($product->get_id(), 'product_cat');

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    $category = $terms[0];
    $category_related_products = get_field('_category_related_products', 'term_' . $category->term_id);
    $enable_manual_adding = get_field('_enable_manual_adding', 'term_' . $category->term_id);

    if ( ! empty( $category_related_products ) && $enable_manual_adding ) {
        $product_list = array();

        foreach ( $category_related_products as $category_related_product ) {
           $wc_product =  wc_get_product( $category_related_product );
            array_push( $product_list, $wc_product );
        }

        $related_products = $product_list;
    }
}

if ( $related_products ) : ?>

	<section class="featured-product">
        <div class="featured-product__wrapper">
            <div class="container">
                <div class="featured-product__inner">
                    <?php
                    $heading = __( 'ВАМ ТАКОЖ МОЖЕ СПОДОБАТИСЯ', 'woocommerce' );

                    if ( $heading ) :
                        ?>
                        <h4 class="featured-product__title"><?php echo esc_html( $heading ); ?></h4>
                    <?php endif; ?>
                    <div class="featured-product__swiper swiper">
                        <div class="featured-product__swiper-wrapper swiper-wrapper">
                            <?php foreach ( $related_products as $related_product ) : ?>

                                <div class="featured-product__swiper-slide swiper-slide">
                                    <?php
                                    $post_object = get_post( $related_product->get_id() );

                                    setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                                    wc_get_template_part( 'content', 'product-related' );
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="featured-product__swiper-button-prev swiper-button-prev swiper-button-primary">
                        <div class="arrow-primary">
                            <img src="<?= home_url(); ?>/images/icons/button-arrow-left.svg" alt="arrow-left">
                        </div>
                    </div>
                    <div class="featured-product__swiper-button-next swiper-button-next swiper-button-primary">
                        <div class="arrow-primary">
                            <img src="<?= home_url(); ?>/images/icons/button-arrow-right.svg" alt="arrow-right">
                        </div>
                    </div>
                    <div class="featured-product__swiper-pagination dots-primary swiper-pagination"></div>
                    <?php
                    $terms = wp_get_post_terms( $product->get_id(), 'product_cat' );

                    if ( $terms ) {
                        $category = reset( $terms );
                        $category_url = get_term_link( $category, 'product_cat' );

                        if ( !is_wp_error( $category_url ) ) {
                            ?>
                            <a href="<?php echo esc_url( $category_url ); ?>" class="featured-product__button button__return"><?php echo __("В каталог", "twentytwenty"); ?></a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
	</section>
	<?php
endif;

wp_reset_postdata();
