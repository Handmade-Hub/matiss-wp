<div class="filters__wrapper bg-gray">


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
                            <li class="filters__item_option">Знижка</li>
                            <li class="filters__item_option">Доступна примірка</li>
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
                            <?php showItems('form') ?>
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
                            <?php showItems('color') ?>
                            <!-- <li class="filters__item_option">Золото</li>
								<li class="filters__item_option">Срібло</li>
								<li class="filters__item_option">Чорний</li>
								<li class="filters__item_option">Білий</li>
								<li class="filters__item_option">Коричневий</li>
								<li class="filters__item_option">Бежевий</li>
								<li class="filters__item_option">Жовтий</li>
								<li class="filters__item_option">Зелений</li>
								<li class="filters__item_option">Смарагдовий</li>
								<li class="filters__item_option">Бірюзовий</li>
								<li class="filters__item_option">Червоний</li>
								<li class="filters__item_option">Бордовий</li>
								<li class="filters__item_option">Рожевий</li>
								<li class="filters__item_option">Синій</li>
								<li class="filters__item_option">Блакинтий</li>
								<li class="filters__item_option">Фіолетовий</li>
								<li class="filters__item_option">Сірий</li> -->
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
                            <?php showItems('style') ?>

                            <!-- <li class="filters__item_option">Сучасна класика</li>
								<li class="filters__item_option">Арт-деко</li>
								<li class="filters__item_option">Мінімалізм</li>
								<li class="filters__item_option">Хай-тек</li>
								<li class="filters__item_option">Лофт</li>
								<li class="filters__item_option">Функціоналізм</li>
								<li class="filters__item_option">Фьюжн</li>
								<li class="filters__item_option">Скандинавський</li>
								<li class="filters__item_option">Кантрі</li> -->
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
                            <?php showItems('category') ?>

                            <!-- <li class="filters__item_option">Абстракції</li>
								<li class="filters__item_option">Сюжетні</li>
								<li class="filters__item_option">Флористичні мотиви</li>
								<li class="filters__item_option">Пейзажі</li>
								<li class="filters__item_option">Мінімалістичні</li>
								<li class="filters__item_option">Фактурні</li>
								<li class="filters__item_option">Портретні</li>
								<li class="filters__item_option">Графіка</li>
								<li class="filters__item_option">Космос</li>
								<li class="filters__item_option">Архітектура</li> -->
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
                            <?php showItems('matherials') ?>

                            <!-- <li class="filters__item_option">Олія</li>
								<li class="filters__item_option">Акрил</li>
								<li class="filters__item_option">Чорнила</li>
								<li class="filters__item_option">Текстурна паста</li> -->
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
                            <?php showItems('rooms') ?>

                            <!-- <li class="filters__item_option">Кухня</li>
								<li class="filters__item_option">Вітальня</li>
								<li class="filters__item_option">Спальня</li>
								<li class="filters__item_option">Коридор</li>
								<li class="filters__item_option">Кабінет</li>
								<li class="filters__item_option">Ванна кімната</li>
								<li class="filters__item_option">Дитяча кімната</li> -->
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="filters__list filters__list_mobile">
                <li class="filters__item">
                    <button class="filters__item_select">
                        <span>СОРТУВАННЯ</span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 8L12.5 15.5L5 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
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
        <div class="filters__choosed empty">
            <ul class="filters__choosed_list">
            </ul>
            <button class="filters__choosed_clear">Очистити фільтри</button>
        </div>
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
                            <ul class="filters-mobile__sublist">
                                <li class="filters-mobile__sublist_item">Прямокутник</li>
                                <li class="filters-mobile__sublist_item">Горизонтальна</li>
                                <li class="filters-mobile__sublist_item">Квадрат</li>
                                <li class="filters-mobile__sublist_item">Триптих</li>
                                <li class="filters-mobile__sublist_item">Пара</li>
                                <li class="filters-mobile__sublist_item">Круг</li>
                            </ul>
                        </li>
                        <li class="filters-mobile__item">
                            <h5 class="filters-mobile__item_title">Колір</h5>
                            <ul class="filters-mobile__sublist">
                                <li class="filters-mobile__sublist_item">Золото</li>
                                <li class="filters-mobile__sublist_item">Срібло</li>
                                <li class="filters-mobile__sublist_item">Чорний</li>
                                <li class="filters-mobile__sublist_item">Білий</li>
                                <li class="filters-mobile__sublist_item">Коричневий</li>
                                <li class="filters-mobile__sublist_item">Бежевий</li>
                                <li class="filters-mobile__sublist_item">Жовтий</li>
                                <li class="filters-mobile__sublist_item">Зелений</li>
                                <li class="filters-mobile__sublist_item">Смарагдовий</li>
                                <li class="filters-mobile__sublist_item">Бірюзовий</li>
                                <li class="filters-mobile__sublist_item">Червоний</li>
                                <li class="filters-mobile__sublist_item">Бордовий</li>
                                <li class="filters-mobile__sublist_item">Рожевий</li>
                                <li class="filters-mobile__sublist_item">Синій</li>
                                <li class="filters-mobile__sublist_item">Блакинтий</li>
                                <li class="filters-mobile__sublist_item">Фіолетовий</li>
                                <li class="filters-mobile__sublist_item">Сірий</li>
                            </ul>
                        </li>
                        <li class="filters-mobile__item">
                            <h5 class="filters-mobile__item_title">Стиль</h5>
                            <ul class="filters-mobile__sublist">
                                <li class="filters-mobile__sublist_item">Сучасна класика</li>
                                <li class="filters-mobile__sublist_item">Арт-деко</li>
                                <li class="filters-mobile__sublist_item">Хай-тек</li>
                                <li class="filters-mobile__sublist_item">Мінімалізм</li>
                                <li class="filters-mobile__sublist_item">Лофт</li>
                                <li class="filters-mobile__sublist_item">Фьюжн</li>
                                <li class="filters-mobile__sublist_item">Кантрі</li>
                                <li class="filters-mobile__sublist_item">Функціоналізм</li>
                                <li class="filters-mobile__sublist_item">Скандинавський</li>
                            </ul>
                        </li>
                        <li class="filters-mobile__item">
                            <h5 class="filters-mobile__item_title">Категорія</h5>
                            <ul class="filters-mobile__sublist">
                                <li class="filters-mobile__sublist_item">Абстракції</li>
                                <li class="filters-mobile__sublist_item">Сюжетні</li>
                                <li class="filters-mobile__sublist_item">Фактурні</li>
                                <li class="filters-mobile__sublist_item">Флористичні мотиви</li>
                                <li class="filters-mobile__sublist_item">Пейзажі</li>
                                <li class="filters-mobile__sublist_item">Мінімалістичні</li>
                                <li class="filters-mobile__sublist_item">Портретні</li>
                                <li class="filters-mobile__sublist_item">Графіка</li>
                                <li class="filters-mobile__sublist_item">Космос</li>
                                <li class="filters-mobile__sublist_item">Архітектура</li>
                            </ul>
                        </li>
                        <li class="filters-mobile__item">
                            <h5 class="filters-mobile__item_title">Матеріали</h5>
                            <ul class="filters-mobile__sublist">
                                <li class="filters-mobile__sublist_item">Олія</li>
                                <li class="filters-mobile__sublist_item">Акрил</li>
                                <li class="filters-mobile__sublist_item">Текстурна паста</li>
                                <li class="filters-mobile__sublist_item">Чорнила</li>
                            </ul>
                        </li>
                        <li class="filters-mobile__item">
                            <h5 class="filters-mobile__item_title">Кімнати</h5>
                            <ul class="filters-mobile__sublist">
                                <li class="filters-mobile__sublist_item">Кухня</li>
                                <li class="filters-mobile__sublist_item">Вітальня</li>
                                <li class="filters-mobile__sublist_item">Спальня</li>
                                <li class="filters-mobile__sublist_item">Кабінет</li>
                                <li class="filters-mobile__sublist_item">Ванна кімната</li>
                                <li class="filters-mobile__sublist_item">Коридор</li>
                                <li class="filters-mobile__sublist_item">Дитяча кімната</li>
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

</div>