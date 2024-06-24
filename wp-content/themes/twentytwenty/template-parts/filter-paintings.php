<div class="container">
    <div class="filters__inner filters-desktop">
        <ul class="filters__list filters__list_desktop">
            <li class="filters__item">
                <div class="filters__item_select">
                    <span>СОРТУВАННЯ</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="filters__item_list">
                    <ul class="filters__item_options">
                        <li class="filters__item_option" data-value="date">Нові</li>
                        <li class="filters__item_option" data-value="popularity">Популярні</li>
                        <li class="filters__item_option" data-value="price">Ціна від найнижчої</li>
                        <li class="filters__item_option" data-value="price-desc">Ціна від найвижчої</li>
                    </ul>
                </div>
            </li>
            <li class="filters__item filters__item--range">
                <div class="filters__item_select">
                    <span>ЦІНА</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="filters__item_list filters__item_list--range">
                    <div class="filters__item_price">
                        <div class="sliders_control">
                            <input id="fromSlider" type="range" value="0" min="0" max="600" />
                            <input id="toSlider" type="range" value="450" min="0" max="600" />
                        </div>
                    </div>
                    <div class="filters__item_case">
                        <p>$<span class="filters__item_min"></span> - $ <span class="filters__item_max"></span></p>
                        <button id="filter_pridce_btn">Застосувати</button>
                    </div>
                </div>
            </li>
            <li class="filters__item">
                <div class="filters__item_select">
                    <span>ФОРМА</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="filters__item_list">
                    <ul class="filters__item_options" data-key="form">
                        <?php showItems('form', 'desktop') ?>
                    </ul>
                </div>
            </li>
            <li class="filters__item">
                <div class="filters__item_select">
                    <span>КОЛІР</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="filters__item_list">
                    <ul class="filters__item_options" data-key="color">
                        <?php showItems('color', 'desktop') ?>
                    </ul>
                </div>
            </li>
            <li class="filters__item">
                <div class="filters__item_select">
                    <span>СТИЛЬ</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="filters__item_list">
                    <ul class="filters__item_options" data-key="style">
                        <?php showItems('style', 'desktop') ?>
                    </ul>
                </div>
            </li>
            <li class="filters__item">
                <div class="filters__item_select">
                    <span>КАТЕГОРІЯ</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="filters__item_list">
                    <ul class="filters__item_options" data-key="category">
                        <?php showItems('category', 'desktop') ?>
                    </ul>
                </div>
            </li>
            <li class="filters__item">
                <div class="filters__item_select">
                    <span>МАТЕРІАЛИ</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="filters__item_list">
                    <ul class="filters__item_options" data-key="category">
                        <?php showItems('matherials', 'desktop') ?>
                    </ul>
                </div>
            </li>
            <li class="filters__item">
                <div class="filters__item_select">
                    <span>КІМНАТИ</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="filters__item_list">
                    <ul class="filters__item_options" data-key="rooms">
                        <?php showItems('rooms', 'desktop') ?>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="filters__list filters__list_mobile">
            <li class="filters__item mobile__orderby">
                <div class="filters__item_select">
                    <span>СОРТУВАННЯ</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="filters__item_list">
                    <ul class="filters__item_options">
                        <li class="filters__item_option" data-value="date">Нові</li>
                        <li class="filters__item_option" data-value="popularity">Популярні</li>
                        <li class="filters__item_option" data-value="price">Ціна від найнижчої</li>
                        <li class="filters__item_option" data-value="price-desc">Ціна від найвижчої</li>
                    </ul>
                </div>
            </li>
            <li class="filters__item">
                <button class="filters__item_select filters__item_trigger">
                    <span>ФІЛЬТРИ</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 4L15.5 11.5L8 19" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </li>
        </ul>
    </div>
    <?php $is_empty_filters = 'empty';

    $keys_to_check = array('materials', 'mod', 'color', 'form', 'style', 'category');

    foreach ($_GET as $key => $value) {
        if (in_array($key, $keys_to_check)) {
            $is_empty_filters = 'true';
        }
    }

    ?>
    <div class="filters__choosed <?= $is_empty_filters; ?>">
        <ul class="filters__choosed_list">
            <?php

            $keys_to_check = array('materials', 'mod', 'color', 'form', 'style', 'category');

            foreach ($_GET as $key => $value) {
                if (in_array($key, $keys_to_check)) { ?>
                    <li class="filters__choosed_item" data-key="<?= $key; ?>">
                        <span><?= esc_html($value) ?></span>
                        <button></button>
                    </li>
            <?php
                    $is_empty_filters = 'true';
                }
            }

            ?>
        </ul>
        <button class="filters__choosed_clear">Очистити фільтри</button>
    </div>
    <script>
        function removeURLParameter(url, parameter) {
            var urlparts = url.split('?');
            if (urlparts.length >= 2) {
                var prefix = encodeURIComponent(parameter) + '=';
                var pars = urlparts[1].split(/[&;]/g);

                for (var i = pars.length; i-- > 0;) {
                    if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                        pars.splice(i, 1);
                    }
                }

                url = urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
                return url;
            } else {
                return url;
            }
        }

        document.querySelectorAll('.filters__choosed_item button').forEach(function(button) {
            button.addEventListener('click', function() {
                var item = button.closest('.filters__choosed_item');
                var key = item.getAttribute('data-key');
                var currentUrl = window.location.href;
                var newUrl = removeURLParameter(currentUrl, key);

                window.location.href = newUrl;
            });
        });

        document.querySelector('.filters__choosed_clear').addEventListener('click', function() {
            var urlparts = window.location.href.split('?');
            var newUrl = urlparts[0];
            window.location.href = newUrl;
        });
    </script>
</div>
<div class="filters-mobile">
    <div class="filters-mobile__wrapper">
        <div class="container">
            <div class="filters-mobile__inner">
                <div class="filters-mobile__case">
                    <h3 class="filters-mobile__title">Фільтри</h3>
                    <button class="filters-mobile__close">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 18L18 6M6 6L18 18" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <ul class="filters-mobile__list">

                    <li class="filters-mobile__item filters-mobile__item--range">
                        <div class="filters-mobile__item_case">
                            <h5 class="filters-mobile__item_title">Ціна</h5>
                            <p>$<span class="filters-mobile__item_min"></span> - $ <span class="filters-mobile__item_max"></span></p>
                        </div>
                        <div class="sliders_control">
                            <input id="fromMobileSlider" type="range" value="0" min="0" max="600" />
                            <input id="toMobileSlider" type="range" value="600" min="0" max="600" />
                        </div>
                    </li>
                    <li class="filters-mobile__item">
                        <h5 class="filters-mobile__item_title">Форма</h5>
                        <ul class="filters-mobile__sublist" data-key="form">
                            <?php showItems('form', 'mobile') ?>
                        </ul>
                    </li>
                    <li class="filters-mobile__item">
                        <h5 class="filters-mobile__item_title">Колір</h5>
                        <ul class="filters-mobile__sublist" data-key="color">
                            <?php showItems('color', 'mobile') ?>
                        </ul>
                    </li>
                    <li class="filters-mobile__item">
                        <h5 class="filters-mobile__item_title">Стиль</h5>
                        <ul class="filters-mobile__sublist" data-key="style">
                            <?php showItems('style', 'mobile') ?>
                        </ul>
                    </li>
                    <li class="filters-mobile__item">
                        <h5 class="filters-mobile__item_title">Категорія</h5>
                        <ul class="filters-mobile__sublist" data-key="category">
                            <?php showItems('category', 'mobile') ?>
                        </ul>
                    </li>
                    <li class="filters-mobile__item">
                        <h5 class="filters-mobile__item_title">Матеріали</h5>
                        <ul class="filters-mobile__sublist" data-key="category">
                            <?php showItems('matherials', 'mobile') ?>
                        </ul>
                    </li>
                    <li class="filters-mobile__item">
                        <h5 class="filters-mobile__item_title">Кімнати</h5>
                        <ul class="filters-mobile__sublist" data-key="rooms">
                            <?php showItems('rooms', 'mobile') ?>
                        </ul>
                    </li>
                </ul>
                <div class="filters-mobile__buttons">
                    <button class="filters-mobile__buttons_submit button__primary">ЗАСТОСУВАТИ</button>
                    <button class="filters-mobile__buttons_remove button__outline">СКИНУТИ</button>
                </div>
            </div>
        </div>
    </div>
</div>