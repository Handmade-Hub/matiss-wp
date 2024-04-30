<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0" role="presentation">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
                    <?php
                    if ( $attribute_name !== 'Колір Рами' ) {
                        ?>
                        <tr>
                            <td class="value">
                                <div class="product__select">
                                    <p class="product__select_title"><?php echo wc_attribute_label( $attribute_name );?></p>
                                    <div class="product__select_panel" data-content="Select">
                                        <span class="--default"><?php echo __('Обрати', 'twentytwenty'); ?></span>
                                    </div>
                                    <div class="product_form_item">
                                        <?php
                                        wc_dropdown_variation_attribute_options(
                                            array(
                                                'options'   => $options,
                                                'attribute' => $attribute_name,
                                                'product'   => $product,
                                            )
                                        );
                                        ?>
                                    </div>
                                    <ul class="product__select_list">
                                        <?php
                                        foreach ( $options as $option ) {
                                            ?>
                                            <li <?php if ( $attribute_name === 'Рама' && $option !== "Без рами" ) { echo 'data-type="0"'; }?>
                                                class="product__select_item <?php if ( $attribute_name === 'Рама' && $option !== "Без рами" ) { echo 'multichoice'; }?>">
                                                <p><?php echo $option; ?></p>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                    if ( $attribute_name === 'Рама' ) {
                                        ?>
                                        <ul data-type="0" class="product__select_multi">
                                            <?php
                                            foreach ($attributes['Колір Рами'] as $attribute) {
                                                if ( $attribute !== 'Без кольору' ) {
                                                ?>
                                                <li class="product__select_multi-item">
                                                    <?php echo $attribute; ?>
                                                </li>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <div class="product_form_item_multi">
                                            <?php
                                            wc_dropdown_variation_attribute_options(
                                                array(
                                                    'options'   => $attributes['Колір Рами'],
                                                    'attribute' => 'Колір Рами',
                                                    'product'   => $product,
                                                )
                                            );
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <p class="product__select_error">
                                        <?php echo __('Будь-ласка, оберіть ', 'twentytwenty');
                                        echo mb_strtolower( $attribute_name, 'UTF-8' ); ?>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    <?php
                            }
                        ?>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_after_variations_table' ); ?>

		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
