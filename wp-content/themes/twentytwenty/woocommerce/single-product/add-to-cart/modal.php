<?php
/**
 * Simple product add to cart modal
 */

global $product;
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
                <h4 class="modal-add-to-cart__title">Товар додано до кошика!</h4>
                <div class="modal-add-to-cart__item">
                    <div class="modal-add-to-cart__content">
                        <div class="modal-add-to-cart__image">
                            <img src="images/paintings/one.jpg" alt="image">
                        </div>
                        <div class="modal-add-to-cart__case">
                            <div class="modal-add-to-cart__case_block">
                                <h6 class="modal-add-to-cart__case_title">Impression</h6>
                                <p>Розмір: 80х120 см</p>
                                <p>Рама: біла деревʼяна</p>
                            </div>
                            <p class="modal-add-to-cart__case_quantity">Кількість: 1</p>
                        </div>
                    </div>
                    <p class="modal-add-to-cart__price">$195</p>
                </div>
                <div class="modal-add-to-cart__buttons">
                    <button class="modal-add-to-cart__button button__outline modal-add-to-cart__button_close">продовжити
                        покупки</button>
                    <a href="#" class="modal-add-to-cart__button button__primary">оформити замовлення</a>
                </div>
            </div>
        </div>
    </div>
</section>
