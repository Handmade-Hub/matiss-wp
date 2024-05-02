<?php

/**
 * Template Name: Wishlist Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


get_header(); ?>

<section class="wishlist">
    <div class="wishlist__wrapper">
        <div class="container">
            <div class="wishlist__inner">
                <div class="wishlist-empty hidden">
                    <div class="wishlist-empty__case">
                        <div class="wishlist-empty__icon">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M55.7499 14.25C53.0327 11.5397 49.3529 10.0155 45.5151 10.0108C41.6772 10.0061 37.9937 11.5213 35.2699 14.225L31.9999 17.2625L28.7274 14.215C26.0043 11.4996 22.314 9.97704 18.4683 9.98244C14.6227 9.98783 10.9366 11.5207 8.22115 14.2438C5.50566 16.9669 3.98315 20.6572 3.98854 24.5029C3.99393 28.3485 5.52679 32.0346 8.2499 34.75L30.5874 57.415C30.7735 57.604 30.9953 57.7541 31.24 57.8565C31.4846 57.959 31.7472 58.0117 32.0124 58.0117C32.2776 58.0117 32.5402 57.959 32.7848 57.8565C33.0295 57.7541 33.2513 57.604 33.4374 57.415L55.7499 34.75C58.4673 32.031 59.9938 28.3442 59.9938 24.5C59.9938 20.6559 58.4673 16.9691 55.7499 14.25ZM52.9124 31.94L31.9999 53.15L11.0749 31.92C9.10567 29.9508 7.99936 27.28 7.99936 24.495C7.99936 21.7101 9.10567 19.0393 11.0749 17.07C13.0441 15.1008 15.715 13.9945 18.4999 13.9945C21.2848 13.9945 23.9557 15.1008 25.9249 17.07L25.9749 17.12L30.6374 21.4575C31.0075 21.802 31.4943 21.9934 31.9999 21.9934C32.5055 21.9934 32.9923 21.802 33.3624 21.4575L38.0249 17.12L38.0749 17.07C40.0455 15.1021 42.7171 13.9976 45.502 13.9995C48.2869 14.0014 50.957 15.1095 52.9249 17.08C54.8928 19.0506 55.9973 21.7222 55.9954 24.5071C55.9936 27.292 54.8855 29.9621 52.9149 31.93L52.9124 31.94Z" fill="black"></path>
                            </svg>
                        </div>
                        <h3 class="wishlist-empty__title">Ваш список вибраного порожній</h3>
                        <p class="wishlist-empty__text">Додайте всі свої улюблені товари до цього списку для збереження та натхнення
                        </p>
                        <a href="#" class="wishlist-empty__button button__primary">до покупок</a>
                    </div>
                </div>

                <h2 class="wishlist__title">Улюблені товари</h2>
                <ul class="wishlist__list">
                    <li class="wishlist__item">
                        <div class="product-card">
                            <a href="#" class="product-card__link"></a>
                            <div class="product-card__image">
                                <img class="product-card__image_primary" src="images/product-card/product-two.jpg" alt="product">
                                <img class="product-card__image_preview" src="images/product-card/product-two-preview.jpg" alt="product">
                            </div>
                            <div class="product-card__info">
                                <h3 class="product-card__title fz-22 text-center open-sans">Impression</h3>
                                <div class="product-card__price fz-20 text-center"><span>від $330</span></div>
                            </div>
                            <button class="product-card__remove">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 18L18 6M6 6L18 18" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </li>
                    <li class="wishlist__item">
                        <div class="product-card">
                            <a href="#" class="product-card__link"></a>
                            <div class="product-card__image">
                                <img class="product-card__image_primary" src="images/product-card/product-four.jpg" alt="product">
                                <img class="product-card__image_preview" src="images/product-card/product-four-preview.jpg" alt="product">
                            </div>
                            <div class="product-card__info">
                                <h3 class="product-card__title fz-22 text-center open-sans">Rime</h3>
                                <div class="product-card__price fz-20 text-center">
                                    <span>від</span>
                                    <span class="product-card__price_sale">$240</span>
                                    <span class="product-card__price_old">$290</span>
                                </div>
                            </div>
                            <button class="product-card__remove">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 18L18 6M6 6L18 18" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </li>
                    <li class="wishlist__item">
                        <div class="product-card">
                            <a href="#" class="product-card__link"></a>
                            <div class="product-card__image">
                                <img class="product-card__image_primary" src="images/product-card/product-five.jpg" alt="product">
                                <img class="product-card__image_preview" src="images/product-card/product-five-preview.jpg" alt="product">
                            </div>
                            <div class="product-card__info">
                                <h3 class="product-card__title fz-22 text-center open-sans">Rime 2</h3>
                                <div class="product-card__price fz-20 text-center"><span>від $290</span></div>
                            </div>
                            <button class="product-card__remove">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 18L18 6M6 6L18 18" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
