<?php
/**
 * Single variation cart button
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="product__buttons">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <div class="product__buttons">
        <a class="product__button button__primary add-to-cart"><?php echo __( 'Додати в кошик', 'twentytwenty' ); ?></a>
        <a class="product__button button__outline quick_buy"><?php echo __( 'Купити в один клік', 'twentytwenty' ); ?></a>
    </div>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
