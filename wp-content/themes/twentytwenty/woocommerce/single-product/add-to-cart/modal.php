<?php
/**
 * Simple product add to cart modal
 */

global $product;

if ( $product->is_type( 'variable' ) ) {
    $attributes = $product->get_variation_attributes();
}
?>

<section class="modal-add-to-cart">
    <div class="modal-add-to-cart__wrapper bg-gray">
        <button class="modal-add-to-cart__close modal-add-to-cart__button_close">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 36L36 12M12 12L36 36" stroke="black" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
            </svg>
        </button>
        <div class="container">
            <div class="modal-add-to-cart__inner">
                <h4 class="modal-add-to-cart__title"><?php echo __('Товар додано до кошика!', 'twentytwenty'); ?></h4>
                <div class="modal-add-to-cart__item">
                    <div class="modal-add-to-cart__content">
                        <div class="modal-add-to-cart__image">
                            <?php echo $product->get_image('thumbnail'); ?>
                        </div>
                        <div class="modal-add-to-cart__case">
                            <div class="modal-add-to-cart__case_block">
                                <h6 class="modal-add-to-cart__case_title"><?php echo $product->get_title(); ?></h6>
                                <?php
                                if ( isset( $attributes[ 'Розмір' ] ) ) {
                                ?>
                                    <p class="atribute_size">
                                        <?php echo __('Розмір: ', 'twentytwenty'); ?>
                                        <span class="atribute_size_value"></span> <?php echo __('см', 'twentytwenty'); ?>
                                    </p>
                                <?php
                                }
                                ?>
                                <?php
                                if ( isset( $attributes[ 'Рама' ] ) ) {
                                ?>
                                    <p class="atribute_frame">
                                        <?php echo __('Рама: ', 'twentytwenty'); ?>
                                        <span class="atribute_frame_value"></span>
                                    </p>
                                    <?php
                                }
                                ?>
                                <?php
                                if ( isset( $attributes[ 'Вартість' ] ) ) {
                                    ?>
                                    <p class="atribute_cost">
                                        <?php echo __('Вартість: ', 'twentytwenty'); ?>
                                        <span class="atribute_cost_value"></span>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                            <p class="modal-add-to-cart__case_quantity">
                                <?php echo __('Кількість: ', 'twentytwenty'); ?>
                                <span class="modal-add-to-cart__case_quantity_value"></span>
                            </p>
                        </div>
                    </div>
                    <p class="modal-add-to-cart__price">$<span class="modal-add-to-cart__price_value"></span></p>
                </div>
                <div class="modal-add-to-cart__buttons">
                    <button class="modal-add-to-cart__button button__outline modal-add-to-cart__button_close">
                        <?php echo __('продовжити покупки', 'twentytwenty'); ?>
                    </button>
                    <a href="#" class="modal-add-to-cart__button button__primary">
                        <?php echo __('оформити замовлення', 'twentytwenty'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
