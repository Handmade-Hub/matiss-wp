<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template overrie plugins/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/css/fancybox.css');

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

?>

<div class="filters">
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
								<button>Застосувати</button>
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
							<ul class="filters__item_options">
								<li class="filters__item_option">Прямокутник</li>
								<li class="filters__item_option">Горизонтальна</li>
								<li class="filters__item_option">Квадрат</li>
								<li class="filters__item_option">Триптих</li>
								<li class="filters__item_option">Пара</li>
								<li class="filters__item_option">Круг</li>
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
							<ul class="filters__item_options">
								<li class="filters__item_option">Золото</li>
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
								<li class="filters__item_option">Сірий</li>
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
							<ul class="filters__item_options">
								<li class="filters__item_option">Сучасна класика</li>
								<li class="filters__item_option">Арт-деко</li>
								<li class="filters__item_option">Мінімалізм</li>
								<li class="filters__item_option">Хай-тек</li>
								<li class="filters__item_option">Лофт</li>
								<li class="filters__item_option">Функціоналізм</li>
								<li class="filters__item_option">Фьюжн</li>
								<li class="filters__item_option">Скандинавський</li>
								<li class="filters__item_option">Кантрі</li>
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
							<ul class="filters__item_options">
								<li class="filters__item_option">Абстракції</li>
								<li class="filters__item_option">Сюжетні</li>
								<li class="filters__item_option">Флористичні мотиви</li>
								<li class="filters__item_option">Пейзажі</li>
								<li class="filters__item_option">Мінімалістичні</li>
								<li class="filters__item_option">Фактурні</li>
								<li class="filters__item_option">Портретні</li>
								<li class="filters__item_option">Графіка</li>
								<li class="filters__item_option">Космос</li>
								<li class="filters__item_option">Архітектура</li>
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
							<ul class="filters__item_options">
								<li class="filters__item_option">Олія</li>
								<li class="filters__item_option">Акрил</li>
								<li class="filters__item_option">Чорнила</li>
								<li class="filters__item_option">Текстурна паста</li>
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
							<ul class="filters__item_options">
								<li class="filters__item_option">Кухня</li>
								<li class="filters__item_option">Вітальня</li>
								<li class="filters__item_option">Спальня</li>
								<li class="filters__item_option">Коридор</li>
								<li class="filters__item_option">Кабінет</li>
								<li class="filters__item_option">Ванна кімната</li>
								<li class="filters__item_option">Дитяча кімната</li>
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
</div>

<!-- <header class="woocommerce-products-header">
	<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action('woocommerce_archive_description');
	?>
</header> -->
<?php
if (woocommerce_product_loop()) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	// do_action('woocommerce_before_shop_loop');
	woocommerce_catalog_ordering();
	woocommerce_product_loop_start();

	if (wc_get_loop_prop('total')) {
		while (have_posts()) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action('woocommerce_shop_loop');

			wc_get_template_part('content', 'product');
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action('woocommerce_after_shop_loop');
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action('woocommerce_no_products_found');
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');
?>

<script defer>
	(() => {
		const filtersItemOptions = document.querySelector('.filters__item_options');
		const woocommerceOrdering = document.querySelector('.woocommerce-ordering');

		const getSort = (element) => {
			const dataValue = element.dataset.value;
			if (element.closest('.filters__item_option') && dataValue) {
				updSort(dataValue);
			}
		};

		const updSort = (value) => {
			const option = woocommerceOrdering.querySelector(`[value=${value}]`);

			option.selected = true;

			woocommerceOrdering.submit();
		};

		filtersItemOptions.addEventListener('click', evt => {
			getSort(evt.target);
		})
	})()
</script>

<?php
get_footer();
