<?php

/**
 * Template Name: Checkout Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

global $woocommerce;
$cart_products = $woocommerce->cart->get_cart();

get_header();
?>


<?php if (is_order_received_page()) : ?>
    <section class="success">
        <div class="success__wrapper">
            <div class="container">
                <div class="success__inner">
                    <h2 class="success__title">Ваше замовлення зареєстроване. Дякуємо!</h2>
                    <div class="success__content">
                        <p>Наш менеджер звʼяжеться з вами найближчим часом.</p>
                        <p>Якщо даного розміру або картини з відповідним кольором немає в наявності, ми виготовимо її впродовж 6-10
                            робочих днів, залежно від розміру полотна. Для оформлення картини в раму додатково потрібно 1-2 робочі дні.</p>
                        <p>Дякуємо, що обрали студію Матісс!</p>
                    </div>
                    <a href="/" class="success__button button__return">на головну</a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>



<script>
    // console.log(<?php print_r(json_encode($cart_products)) ?>)

    const checkoutBlockRadios = document.querySelector('.checkout__block_radios');

    checkoutBlockRadios && setTimeout(() => {
        checkoutBlockRadios.classList.add('active')
    }, 6000)
</script>

<?php if (!is_order_received_page()) : ?>

    <div class="breadcrumbs">
        <div class="breadcrumbs__wrapper">
            <div class="container">
                <nav class="breadcrumbs__inner">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 20L8.5 12.5L16 5" stroke="#9A9A9A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <a href="/каталог" class="breadcrumbs__item_link fw-500">Продовжити покупки</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php

// Show non-cart errors.
do_action('woocommerce_before_checkout_form_cart_notices');

// Check cart has contents.
if (WC()->cart->is_empty() && !is_customize_preview() && apply_filters('woocommerce_checkout_redirect_empty_cart', true)) {
    return;
}

// Check cart contents for errors.
do_action('woocommerce_check_cart_items');

// Calc totals.
WC()->cart->calculate_totals();

// Get checkout object.
$checkout = WC()->checkout();

if (empty($_POST) && wc_notice_count('error') > 0) { // WPCS: input var ok, CSRF ok.

    wc_get_template('checkout/cart-errors.php', array('checkout' => $checkout));
    wc_clear_notices();
} else {

    $non_js_checkout = !empty($_POST['woocommerce_checkout_update_totals']); // WPCS: input var ok, CSRF ok.

    if (wc_notice_count('error') === 0 && $non_js_checkout) {
        wc_add_notice(__('The order totals have been updated. Please confirm your order by pressing the "Place order" button at the bottom of the page.', 'woocommerce'));
    }
}

?>

<section class="checkout">
    <div class="checkout__wrapper">
        <div class="container">
            <div class="checkout__inner">
                <h2 class="checkout__title text-center">Оформити замовлення</h2>
                <form id="checkout__form" class="checkout__form">
                    <div class="checkout__content">
                        <div class="checkout__case">
                            <div class="checkout__block bg-gray">
                                <p class="checkout__block_number">1</p>
                                <h3 class="checkout__block_title">Контактна інформація</h3>
                                <div class="checkout__block_case">
                                    <div class="checkout__block_wrap">
                                        <div class="checkout__block_field --required">
                                            <input type="text" name="name" placeholder="Імʼя*" id="name">
                                            <label for="name">Імʼя*</label>
                                            <p class="checkout__block_error">Будь-ласка, введіть імʼя</p>
                                        </div>
                                        <div class="checkout__block_field --required">
                                            <input type="text" name="name" placeholder="Телефон*" id="phone">
                                            <label for="phone">Телефон*</label>
                                            <p class="checkout__block_error">Будь-ласка, введіть номер</p>
                                        </div>
                                    </div>
                                    <div class="checkout__block_field">
                                        <input type="text" name="name" placeholder="Email" id="email">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="checkout__block_field">
                                        <textarea placeholder="Повідомлення" name="message" id="message"></textarea>
                                        <label for="message">Повідомлення</label>
                                    </div>
                                    <div class="checkout__block_checkboxes">
                                        <p>Оберіть додаткові поcлуги</p>
                                        <div class="checkout__block_checkbox" data-p="5">
                                            <input id="checkboxOne" type="checkbox" value="Продовження сюжету на торці + 5% (стандартно торці забарвлені в один колір)">
                                            <label for="checkboxOne">
                                                <span>Продовження сюжету на торці + 5%</span>
                                                <span>(стандартно торці забарвлені в один колір)</span>
                                            </label>
                                        </div>
                                        <div class="checkout__block_checkbox" data-p="10">
                                            <input id="checkboxTwo" type="checkbox" value="Зміна кольору/композиції + 10 % (попередньо виконується ескіз)">
                                            <label for="checkboxTwo">
                                                <span>Зміна кольору/композиції + 10 %</span>
                                                <span>(попередньо виконується ескіз)</span>
                                            </label>
                                        </div>
                                        <div class="checkout__block_checkbox" data-p="15">
                                            <input id="checkboxThree" type="checkbox" value="Високий підрамник + 15%">
                                            <label for="checkboxThree">Високий підрамник + 15%</label>
                                        </div>
                                        <div class="checkout__block_checkbox" data-p="5">
                                            <input id="checkboxFour" type="checkbox" value="Подарункова упаковка + 5%">
                                            <label for="checkboxFour">Подарункова упаковка + 5%</label>
                                        </div>
                                        <div class="checkout__block_checkbox" data-p="0">
                                            <input id="checkboxFive" type="checkbox" value="Підпис автора + 0%">
                                            <label for="checkboxFive">Підпис автора + 0%</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__block bg-gray">
                                <p class="checkout__block_number">2</p>
                                <h3 class="checkout__block_title">Доставка</h3>
                                <div class="checkout__block_case">
                                    <div class="checkout__select checkout__select--city">
                                        <p class="checkout__select_title">Місто</p>
                                        <div class="checkout__select_panel" data-content="">
                                            <span>Оберіть місто</span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </div>
                                        <ul class="checkout__select_list" id="cities-list">
                                            <!-- <li class="checkout__select_item">
                                                <p>Київ</p>
                                            </li>
                                            <li class="checkout__select_item">
                                                <p>Львів</p>
                                            </li>
                                            <li class="checkout__select_item">
                                                <p>Одеса</p>
                                            </li>
                                            <li class="checkout__select_item">
                                                <p>Полтава</p>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <script>
                                        (() => {
                                            const apiKey = 'f31abcb70c6a17c326432096849a01c5';
                                            const url = 'https://api.novaposhta.ua/v2.0/json/';

                                            const createCities = (cities) => {
                                                const citiesList = document.querySelector('#cities-list');
                                                cities.forEach(city => {
                                                    const li = document.createElement('li');
                                                    const p = document.createElement('p');

                                                    li.classList.add('checkout__select_item');
                                                    p.innerText = city.SettlementTypeDescription + " " + city.Description;

                                                    li.append(p);
                                                    citiesList.append(li);

                                                    // console.log(city);
                                                    // console.log(city.SettlementTypeDescription + " " + city.Description);
                                                });
                                            };

                                            const requestData = {
                                                apiKey: apiKey,
                                                modelName: 'AddressGeneral',
                                                calledMethod: 'getCities',
                                                methodProperties: {
                                                    "Warehouse": "1"
                                                }
                                            };

                                            fetch(url, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json'
                                                    },
                                                    body: JSON.stringify(requestData)
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    // console.log('Response from Nova Poshta API:', data);
                                                    createCities(data.data);
                                                })
                                                .catch(error => {
                                                    console.error('Error fetching data:', error);
                                                });
                                        })()
                                    </script>
                                    <div class="checkout__delivery">
                                        <ul class="checkout__delivery_list">
                                            <li class="checkout__delivery_item checked">
                                                <div class="checkout__delivery_case">
                                                    <div class="checkout__delivery_radio">
                                                        <input id="deliveryOne" type="radio" name="delivery" checked="" value="Нова Пошта">
                                                        <label for="deliveryOne">Нова Пошта</label>
                                                    </div>
                                                    <p>За тарифами перевізника</p>
                                                </div>
                                                <div class="checkout__delivery_selects delivery-method department">
                                                    <div class="checkout__select">
                                                        <p class="checkout__select_title">Спосіб доставки</p>
                                                        <div class="checkout__select_panel delivery-method-value" data-content="Відділення">
                                                            <span>Відділення</span>
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <ul class="checkout__select_list">
                                                            <li class="checkout__select_item">
                                                                <p>Відділення</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>Адресна доставка</p>
                                                            </li>
                                                        </ul>
                                                        <p class="checkout__select_subtext">*Якщо ваш товар перевищує розмір 70х110 см, будь ласка, оберіть
                                                            вантажне відділення</p>
                                                    </div>
                                                    <div class="checkout__select delivery-department --required">
                                                        <div class="checkout__select_panel" data-content="Оберіть відділення">
                                                            <span class="--default">Оберіть відділення</span>
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <ul class="checkout__select_list" id="np-waerehouses">
                                                            <li class="checkout__select_item">
                                                                <p>Відділення №1: вул. Пирогівський шлях, 135</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>Одеса</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>Полтава</p>
                                                            </li>
                                                        </ul>
                                                        <p class="checkout__select_error">Будь-ласка, оберіть відділення</p>
                                                        <script defer>
                                                            (() => {
                                                                function removeWordsAndTrim(str) {
                                                                    let result = new String(str);
                                                                    result = result.toString();
                                                                    result = str.replace('село', '');
                                                                    result = result.replace('місто', '');
                                                                    result = result.trim();

                                                                    return result;
                                                                }

                                                                const getWarehouses = (city) => {
                                                                    const apiKey = 'f31abcb70c6a17c326432096849a01c5';
                                                                    const url = 'https://api.novaposhta.ua/v2.0/json/';

                                                                    const requestData = {
                                                                        "apiKey": apiKey,
                                                                        "modelName": "AddressGeneral",
                                                                        "calledMethod": "getWarehouses",
                                                                        "methodProperties": {
                                                                            "TypeOfWarehouseRef": "841339c7-591a-42e2-8233-7a0a00f0ed6f",
                                                                            "CityName": `${city}`
                                                                        }
                                                                    };

                                                                    fetch(url, {
                                                                            method: 'POST',
                                                                            headers: {
                                                                                'Content-Type': 'application/json'
                                                                            },
                                                                            body: JSON.stringify(requestData)
                                                                        })
                                                                        .then(response => response.json())
                                                                        .then(data => {
                                                                            // console.log('Response from Nova Poshta API:', data);
                                                                            setWarehouses(data.data);
                                                                        })
                                                                        .catch(error => {
                                                                            console.error('Error fetching data:', error);
                                                                        });
                                                                }
                                                                const setWarehouses = (warehouses) => {
                                                                    const npWaerehouses = document.querySelector('#np-waerehouses');
                                                                    npWaerehouses.innerHTML = "";

                                                                    warehouses.forEach(warehouse => {
                                                                        const li = document.createElement('li');
                                                                        const p = document.createElement('p');

                                                                        li.classList.add('checkout__select_item');
                                                                        p.innerText = warehouse.Description;

                                                                        li.append(p);
                                                                        npWaerehouses.append(li);

                                                                        console.log(warehouse);
                                                                    });
                                                                };


                                                                const targetNode = document.querySelector('.checkout__select_panel');
                                                                const config = {
                                                                    attributes: true
                                                                };

                                                                // Функция обратного вызова при изменении
                                                                const callback = function(mutationsList, observer) {
                                                                    for (let mutation of mutationsList) {
                                                                        if (mutation.type === 'attributes' && mutation.attributeName === 'data-content') {
                                                                            const city = targetNode.getAttribute(mutation.attributeName);
                                                                            const onlyName = removeWordsAndTrim(city);
                                                                            getWarehouses(onlyName);
                                                                        }
                                                                    }
                                                                };

                                                                const observer = new MutationObserver(callback);
                                                                observer.observe(targetNode, config);
                                                            })()
                                                        </script>
                                                    </div>
                                                    <div class="checkout__address-delivery">
                                                        <div class="checkout__address-delivery_field --required">
                                                            <input id="street" type="text" placeholder="Вулиця*">
                                                            <label for="street">Вулиця*</label>
                                                            <p class="checkout__address-delivery_error">Будь-ласка, введіть назву вулиці</p>
                                                        </div>
                                                        <div class="checkout__address-delivery_case">
                                                            <div class="checkout__address-delivery_field --required">
                                                                <input id="home" type="text" placeholder="Будинок*">
                                                                <label for="home">Будинок*</label>
                                                                <p class="checkout__address-delivery_error">Будь-ласка, введіть номер будинку</p>
                                                            </div>
                                                            <div class="checkout__address-delivery_field">
                                                                <input id="apartmnet" type="text" placeholder="Квартира">
                                                                <label for="apartmnet">Квартира</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="checkout__delivery_item checkout__delivery_item--city disabled">
                                                <div class="checkout__delivery_case">
                                                    <div class="checkout__delivery_radio">
                                                        <input id="deliveryTwo" type="radio" name="delivery" value="Самовивіз">
                                                        <label for="deliveryTwo">Самовивіз</label>
                                                    </div>
                                                    <p class="green">Безкоштовно</p>
                                                </div>
                                                <div class="checkout__delivery_selects">
                                                    <div class="checkout__select">
                                                        <div class="checkout__select_panel selfdelivery" data-content="Майстерня, Київ, вул. Генерала Шаповала, 2, офіс 555">
                                                            <span>Майстерня, Київ, вул. Генерала Шаповала, 2, офіс 555</span>
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <ul class="checkout__select_list">
                                                            <li class="checkout__select_item">
                                                                <p>Майстерня, Київ, вул. Генерала Шаповала, 2, офіс 555</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>ТЦ Аракс, Київ, вул. Кільцева дорога, 110</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>ТЦ 4room, Київ, Петропавлівська Борщагівка, вул. Петропавлівська, 6</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>ТЦ Три Слони, Львів, вул. Яворівська, 22</p>
                                                            </li>
                                                            <!-- <li class="checkout__select_item">
                                                                <p>Майстерня, Київ</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>Одеса</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>Полтава</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>Полтава</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>Полтава</p>
                                                            </li>
                                                            <li class="checkout__select_item">
                                                                <p>Полтава</p>
                                                            </li> -->
                                                        </ul>
                                                        <div class="checkout__select_pack">
                                                            <p class="checkout__select_work">Пн - Пт : 10:00-19:00</p>
                                                            <!-- <div class="checkout__select_image">
                                                                <img src="images/checkout-map.png" alt="map">
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__block bg-gray">
                                <p class="checkout__block_number">3</p>
                                <h3 class="checkout__block_title">Оплата</h3>
                                <div class="checkout__block_case">
                                    <div class="checkout__block_radios">
                                        <?php do_action('woocommerce_before_checkout_form', $checkout);

                                        // If checkout registration is disabled and not logged in, the user cannot checkout.
                                        if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
                                            echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
                                            return;
                                        }

                                        ?>

                                        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

                                            <?php if ($checkout->get_checkout_fields()) : ?>

                                                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                                                <div class="col2-set" id="customer_details">
                                                    <div class="col-1">
                                                        <?php do_action('woocommerce_checkout_billing'); ?>
                                                    </div>

                                                    <div class="col-2">
                                                        <?php do_action('woocommerce_checkout_shipping'); ?>
                                                    </div>
                                                </div>

                                                <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                                            <?php endif; ?>

                                            <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                                            <h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

                                            <?php do_action('woocommerce_checkout_before_order_review'); ?>

                                            <div id="order_review" class="woocommerce-checkout-review-order">
                                                <?php do_action('woocommerce_checkout_order_review'); ?>
                                            </div>

                                            <?php do_action('woocommerce_checkout_after_order_review'); ?>

                                        </form>

                                        <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
                                        <?php
                                        // $available_gateways = WC()->payment_gateways->get_available_payment_gateways();

                                        // if (!empty($available_gateways)) {
                                        //     foreach ($available_gateways as $key => $gateway) { 
                                        ?>
                                        <!-- <div class="checkout__block_radio">
                                                     <input type="radio" name="pay" id="<?= $key ?>" value="<?= $gateway->title ?>">
                                                     <label for="<?= $key ?>"><?= $gateway->title ?></label>
                                                 </div> -->
                                        <?php //  }
                                        // } 
                                        ?>

                                        <!-- <div class="checkout__block_radio">
                                            <input type="radio" name="pay" id="radioOne" value="Оплата онлайн" checked="">
                                            <label for="radioOne">Оплата онлайн</label>
                                        </div>
                                        <div class="checkout__block_radio">
                                            <input type="radio" name="pay" id="radioTwo" value="Оплата онлайн">
                                            <label for="radioTwo">Оплата готівкою</label>
                                        </div>
                                        <div class="checkout__block_radio">
                                            <input type="radio" name="pay" id="radioThree" value="Оплата онлайн">
                                            <label for="radioThree">Накладений платіж (оплата при отриманні)</label>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__wrap">
                            <div class="checkout__certificate">
                                <button type="button" class="checkout__certificate_button">
                                    <span>Сертифікат</span>
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M26.6665 10.666L16.6665 20.666L6.6665 10.666" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <div class="checkout__certificate_wrap">
                                    <div class="checkout__certificate_case">
                                        <div class="checkout__certificate_field">
                                            <input id="certificate" type="text" placeholder="Код сертифікату">
                                            <label for="certificate">Код сертифікату</label>
                                        </div>
                                        <button type="button" class="checkout__certificate_submit button__primary">Застосувати</button>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__order">
                                <div class="checkout__order_case">
                                    <h5 class="checkout__order_title">Ваше замовлення</h5>
                                    <a href="#" class="checkout__order_link" onclick="document.querySelector('.header__cart').click()">Редагувати</a>
                                </div>
                                <ul class="checkout__order_list">
                                    <?php foreach ($cart_products as $key => $product) : ?>
                                        <script>
                                            // console.log(<?php print_r(json_encode($product)) ?>)
                                        </script>
                                        <?php
                                        $_product = wc_get_product($product['product_id']);
                                        ?>

                                        <li class="checkout__order_item">
                                            <div class="checkout__order_image">
                                                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($product['product_id']), 'single-post-thumbnail'); ?>
                                                <img src="<?= $image[0] ?>" alt="image of <?= $_product->get_title() ?>">
                                            </div>
                                            <div class="checkout__order_info">
                                                <h3 class="checkout__order_heading"><?= $_product->get_title() ?></h3>
                                                <!-- <p>Розмір: <span>80х120 см</span></p>
                                                <p>Рама: <span>без рами</span></p> -->
                                                <p class="checkout__order_quantity">Кількість: <span><?= $product['quantity'] ?></span></p>
                                            </div>
                                            <p class="checkout__order_price">
                                                <?php if ($_product->is_on_sale() && $_product->get_sale_price()) {
                                                    echo get_woocommerce_currency_symbol() . $_product->get_sale_price();
                                                } else {
                                                    echo get_woocommerce_currency_symbol() . $product['line_total'];
                                                } ?>
                                            </p>
                                            <button type="button" class="checkout__order_remove">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 12L12 4M4 4L12 12" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </button>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="checkout__order_footer">
                                    <div class="checkout__order_pack">
                                        <p>Сума <span>$<?= $woocommerce->cart->cart_contents_total ?></span></p>
                                        <p class="checkout__order_checkbox">Додатково <span>$0</span></p>
                                        <p>Знижка <span class="checkout__order_discount red">$<?= WC()->cart->get_discount_tax(); ?></span></p>
                                    </div>
                                    <script>
                                        // console.log(<?php print_r(json_encode($woocommerce->cart)) ?>)
                                    </script>
                                    <?php

                                    function getUah()
                                    {
                                        $api_url = 'https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=11';
                                        $response = file_get_contents($api_url);
                                        $exchange_rates = json_decode($response, true);
                                        $usd_to_uah_rate = $exchange_rates[1]['sale'];

                                        $usd = WC()->cart->total;
                                        $uah = $usd * $usd_to_uah_rate;

                                        $prety_cur = number_format($uah, 0, ',', ' ');

                                        return "(" . $prety_cur . " грн.)";
                                    }

                                    ?>
                                    <p class="checkout__order_total">Всього <span id="usd"><span id="original" data-initial-price="<?= $woocommerce->cart->total ?>">$<?= $woocommerce->cart->total ?></span><span id="uah"> <?= getUah() ?></span></span></p>
                                    <input type="submit" class="checkout__order_button button__primary" value="підтвердити замовлення">
                                    <p class="checkout__order_subtext text-center">Я згоден на обробку персональних даних</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutOrderButton = document.querySelector('.checkout__order_button');
        const checkoutBlockCheckboxes = document.querySelector('.checkout__block_checkboxes');
        const couponCode = document.querySelector('[name="coupon_code"]');
        const applyCoupon = document.querySelector('[name="apply_coupon"]');
        const certificate = document.querySelector('#certificate');
        const checkoutCertificateSubmit = document.querySelector('.checkout__certificate_submit');

        const handleShipping = () => {
            const checkoutBlockCase = document.querySelector('.checkout__block_case');
            const shippingContainer = document.querySelector('.checkout__delivery_selects');
            const method = shippingContainer.querySelector('.delivery-method-value').dataset.content;
            const city = document.querySelector('.checkout__select--city').querySelector('.checkout__select_panel').dataset.content;
            const deliveryType = document.querySelector('[name="delivery"]:checked').value;

            let shippingMessage = '';

            if (deliveryType == 'Нова Пошта') {
                if (method == 'Відділення') {
                    const department = document.querySelector('.delivery-department').querySelector('.checkout__select_panel').dataset.content;

                    shippingMessage = `Доставка Нова Пошта: ${city}, ${department}`;
                } else if (method == 'Адресна доставка') {
                    const steet = document.querySelector('.delivery-department').querySelector('#street').value;
                    const build = document.querySelector('.delivery-department').querySelector('#home').value;
                    const apart = document.querySelector('.delivery-department').querySelector('#apartmnet').value;

                    shippingMessage = `Адресна доставка Новою Поштою: ${city}, ${build} ${apart ? ',' + apart : ''}`
                }
            } else if (deliveryType == 'Самовивіз') {
                const selfdelivery = document.querySelector('.selfdelivery').dataset.content;
                shippingMessage = `Самовивіз ${selfdelivery}`;
            }

            return shippingMessage;
        }

        checkoutCertificateSubmit.addEventListener('click', () => {
            couponCode.value = certificate.value;
            setTimeout(() => {
                applyCoupon.click();
            }, 700)
        })

        checkoutOrderButton.addEventListener('click', function(event) {
            const name = document.querySelector('#name');
            const phone = document.querySelector('#phone');
            const email = document.querySelector('#email');
            const city = document.querySelector('.checkout__select--city').querySelector('.checkout__select_panel');
            const message = document.querySelector('#message');

            const mainSubmitBtn = document.querySelector('[name="woocommerce_checkout_place_order"]');

            const billing_name = document.querySelector('[name="billing_first_name"]');
            const billing_phone = document.querySelector('#billing_phone');
            const billing_email = document.querySelector('#billing_email');
            const billing_sity = document.querySelector('#billing_sity');
            const billing_note = document.querySelector('#billing_note');
            const billing_shipping_method = document.querySelector('#billing_shipping_method');

            billing_name.value = name.value;
            billing_phone.value = phone.value;
            billing_email.value = email.value;
            billing_sity.value = city.dataset.content;
            billing_note.value = message.value;
            billing_shipping_method.value = handleShipping();

            mainSubmitBtn.click();
        });

        checkoutBlockCheckboxes.addEventListener('change', function(evt) {
            const element = evt.target;
            if (!element.matches('input')) {
                return
            };

            const id = element.id;
            // const billingAddOpt1 = document.querySelector('[name="billing_add_opt_1"]');
            // const billingAddOpt2 = document.querySelector('[name="billing_add_opt_2"]');
            // const billingAddOpt3 = document.querySelector('[name="billing_add_opt_3"]');
            // const billingAddOpt4 = document.querySelector('[name="billing_add_opt_4"]');
            // const billingAddOpt5 = document.querySelector('[name="billing_add_opt_5"]');
            // const billingAddOpt6 = document.querySelector('[name="billing_add_opt_6"]');

            // if (id == 'checkboxOne') {
            //     if (element.checked) {
            //         billingAddOpt1.checked = true;
            //     } else {
            //         billingAddOpt1.checked = false;
            //     }
            // } else if (id == 'checkboxTwo') {
            //     if (element.checked) {
            //         billingAddOpt2.checked = true;
            //     } else {
            //         billingAddOpt2.checked = false;
            //     }
            // } else if (id == 'checkboxThree') {
            //     if (element.checked) {
            //         billingAddOpt3.checked = true;
            //     } else {
            //         billingAddOpt3.checked = false;
            //     }
            // } else if (id == 'checkboxFour') {
            //     if (element.checked) {
            //         billingAddOpt4.checked = true;
            //     } else {
            //         billingAddOpt4.checked = false;
            //     }
            // } else if (id == 'checkboxFive') {
            //     if (element.checked) {
            //         billingAddOpt5.checked = true;
            //     } else {
            //         billingAddOpt5.checked = false;
            //     }
            // }
        })
    });
</script>

<?php get_footer();
