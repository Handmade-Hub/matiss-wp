<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}

$bage = get_field('bage');
$fitting_available = get_field('fitting_available');

?>

<li class="collection__item">
	<div class="product-card 
						<?php
						if ($fitting_available) {
							echo (' product-card--trend');
						};

						if (!empty($bage)) {
							echo (' product-card--fitting-ua');
						};

						if ($product->is_on_sale()) {
							echo (' product-card--sale');
						};

						?>
						">
		<a href="<?= $product->get_permalink() ?>" class="product-card__link"></a>
		<div class="product-card__image">
			<?php

			$image_id  = $product->get_image_id();
			$image_url = wp_get_attachment_image_url($image_id, 'full');

			?>
			<img class="product-card__image_primary" src="<?= $image_url ?>" alt="image preview of <?= $product->name ?>">
			<?php if ($product->get_gallery_image_ids() && $product->get_gallery_image_ids()[0]) : ?>
				<?php

				$second_image_id  = $product->get_gallery_image_ids()[0];
				$second_image_url = wp_get_attachment_image_url($second_image_id, 'full');

				?>
				<img class="product-card__image_preview" src="<?= $second_image_url ?>" alt="second image preview of <?= $product->name ?>">
			<?php endif; ?>
		</div>
		<div class="product-card__info">
			<h3 class="product-card__title fz-22 text-center open-sans"><?= $product->name ?></h3>
			<div class="product-card__price fz-20 text-center">
				<?php if ($product->is_on_sale()) : ?>
					<!-- <span>від</span> -->
					<span class="product-card__price_sale"><?= get_woocommerce_currency_symbol() ?><?php if ($product->get_sale_price()) {
																										echo ($product->get_sale_price());
																									} else {
																										echo ($product->get_variation_sale_price('min'));
																									} ?></span>
					<span class="product-card__price_old"><?= get_woocommerce_currency_symbol() ?><?php if ($product->get_regular_price()) {
																										echo ($product->get_regular_price());
																									} else {
																										echo ($product->get_variation_sale_price('max'));
																									} ?></span>
				<?php else : ?>
					<span><?= get_woocommerce_currency_symbol() . $product->price ?></span>
				<?php endif; ?>
			</div>

		</div>
        <?php
        if ($product->is_on_sale()) {
            ?>
            <div class="product-card__badge">
                <span>
                <?php
                if ($product->is_on_sale()) {
                    echo __('ЗНИЖКА', 'twentytwenty');
                } elseif ($fitting_available) {
                    echo __('ТРЕНД', 'twentytwenty');
                } elseif (!empty($bage)) {
                    echo __('ДОСТУПНА ПРИМІРКА', 'twentytwenty');
                }
                ?>
                </span>
            </div>
            <?php
        }
        ?>
	</div>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	// do_action('woocommerce_before_shop_loop_item');

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	// do_action('woocommerce_before_shop_loop_item_title');

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	// do_action('woocommerce_shop_loop_item_title');

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	// do_action('woocommerce_after_shop_loop_item_title');

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	// do_action('woocommerce_after_shop_loop_item');
	?>
</li>