<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
    <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>

        <?php
        $product_category = wp_get_post_terms( get_the_ID(), 'product_cat', array( 'fields' => 'names' ) )[0];

        if ( $product_category === 'Картини' || $product_category === 'Постери' ) {
            wc_get_template_part( 'content', 'single-product' );
        } elseif ($product_category === 'Розпис') {
            wc_get_template_part( 'content', 'single-product-painting-wall' );
        }
        ?>

    <?php endwhile; // end of the loop. ?>

    <?php
    /**
     * woocommerce_after_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );
    ?>
<?php
do_action( 'woocommerce_after_single_product_summary' );
do_action('woocommerce_after_single_product');
get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
