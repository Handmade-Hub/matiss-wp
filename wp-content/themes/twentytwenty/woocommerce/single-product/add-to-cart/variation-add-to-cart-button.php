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
        <button type="submit" class="product__button button__primary add-to-cart single_add_to_cart_button button"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
        <button type="submit" class="product__button button__outline add-to-cart single_add_to_cart_button button"><?php echo __( 'Купити в один клік', 'twentytwenty' ); ?></button>
    </div>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
