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
		<?php

		$str = strip_tags(get_the_archive_title());
		$categorie_name = str_replace("Категорія:", "", $str);
		$categorie_name = trim($categorie_name);

		if ($categorie_name == "Рами") {
			get_template_part('template-parts/filter-frames');
		} elseif ($categorie_name == "Картини") {
			get_template_part('template-parts/filter-paintings');
		} elseif ($categorie_name == "Розпис") {
			get_template_part('template-parts/filter-painting-wall');
		};

		?>
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

<section class="collection">
	<div class="collection__wrapper">
		<div class="container">
			<div class="collection__inner">
				<ul class="collection__list" style="--per-col: <?php echo esc_attr(wc_get_loop_prop('columns')); ?>">
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
						// woocommerce_product_loop_start();

						if (wc_get_loop_prop('total')) {
							$posts = have_posts();

							if (!empty($_GET)) {
								$args = array(
									'post_type'      => 'product',
									'posts_per_page' => -1,
								);

								$parameters = $_GET;
								$par_arr    = array();

								foreach ($parameters as $key => $value) {
									if ($key == 'min_price' || $key == 'max_price') {
										$args['meta_query'][] = array(
											'key'     => '_price', // Используем '_price' для сравнения с ценой товара.
											'value'   => $value,
											'compare' => $key == 'min_price' ? '>=' : '<=', // Устанавливаем соответствующий оператор сравнения.
											'type'    => 'NUMERIC' // Указываем тип значения.
										);
									} elseif ($key == 'orderby') {
										if ($value == 'price-desc') {
											$args['orderby']  = 'meta_value_num'; // Сортировка по убыванию цены.
											$args['order']    = 'DESC';
											$args['meta_key'] = '_price';
										} elseif ($value == 'price') {
											$args['orderby']  = 'meta_value_num'; // Сортировка по возрастанию цены.
											$args['order']    = 'ASC';
											$args['meta_key'] = '_price';
										}
									} else {
										$par_arr[] = array(
											'key'     => $key,
											'value'   => $value,
											'compare' => 'LIKE'
										);
									}
								}

								if (!empty($par_arr)) {
									$args['meta_query'][] = array(
										'relation' => 'AND',
										$par_arr
									);
								}

								$query = new WP_Query($args);

								if ($query->have_posts()) {
									while ($query->have_posts()) {
										$query->the_post();

										do_action('woocommerce_shop_loop');

										wc_get_template_part('content', 'product');
									}
								}
							} else {
								while (have_posts()) {
									the_post();

									do_action('woocommerce_shop_loop');

									wc_get_template_part('content', 'product');
								}
							}
						}

						// woocommerce_product_loop_end();

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
				</ul>
			</div>
		</div>
	</div>
</section>

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
	})();
	(() => {
		const filterPridceBtn = document.querySelector('#filter_pridce_btn');

		const queryFilterByPrice = () => {
			const min = document.querySelector('.filters__item_min').innerText;
			const max = document.querySelector('.filters__item_max').innerText;
			const url = window.location.href;
			const search = window.location.search;

			let newUrl = "";

			if (search.includes('min_price') || search.includes('max_price')) {
				newUrl = url.replace(/([?&])min_price=(\d+)+/g, `$1min_price=${min}`);
				newUrl = newUrl.replace(/([?&])max_price=(\d+)+/g, `$1max_price=${max}`);
			} else {
				const perf = window.location.search != "" ? "&" : "?";

				newUrl = `${url + perf}min_price=${min}&max_price=${max}`;
			}

			window.location.href = newUrl;
		}

		filterPridceBtn && filterPridceBtn.addEventListener('click', queryFilterByPrice)
	})();
	(() => {
		const filtersList = document.querySelector('.filters__list_desktop');

		const filterHandler = (element) => {
            console.log('filtersList element', element)
			if (!element.closest('[data-value]')) {
				return;
			}

			let dataValue = element.closest('[data-value]').dataset.value;
			let newUrl = "";

			const dataKey = element.closest('[data-key]').dataset.key;
			const searchParams = new URLSearchParams(window.location.search);
			const url = window.location.href;

			if (searchParams.has(dataKey)) {
				searchParams.set(dataKey, dataValue);
				newUrl = `${url.split('?')[0]}?${searchParams.toString()}`;
			} else {
				const perf = window.location.search !== "" ? "&" : "?";
				newUrl = `${url + perf}${dataKey}=${dataValue}`;
			}

			console.log(dataKey + " - " + dataValue);
			console.log(newUrl);

			const decodedUrl = decodeURIComponent(newUrl);

			window.location.href = decodedUrl;
		};



		filtersList.addEventListener('click', evt => filterHandler(evt.target))
	})();

    /// mobile filters
    (() => {
        const filtersList = document.querySelector('.filters-mobile__list');
        const mobileSubmitFilter = document.querySelector('.filters-mobile__buttons_submit');
        const mobileClearFilter = document.querySelector('.filters-mobile__buttons_remove');
        const searchParams = new URLSearchParams(window.location.search);
        let fromMobileSlider = document.getElementById('fromMobileSlider');
        let toMobileSlider = document.getElementById('toMobileSlider');
        let searchParamsArray = Array.from(searchParams.entries());
        let choosedOption = {};

        //get search params
        if (searchParamsArray.length > 0) {
            searchParamsArray.forEach(function (item) {
                let key = item[0];
                let values = item[1].split(',');
                choosedOption[key] = values;

                values.forEach(function (item) {
                    // set min price range
                    if (key === 'min_price') {
                        fromMobileSlider.value = item;
                    }
                    // set max price range
                    if (key === 'max_price') {
                        toMobileSlider.value = item;
                    }

                    /// add active class in filter button
                    if (key !== 'min_price' && key !== 'max_price' && key !== 'orderby') {
                        let selector = `.filters-mobile__sublist[data-key="${key}"] .filters-mobile__sublist_item[data-value="${item}"]`;
                        document.querySelector(selector).classList.add('choosed');
                    }
                })
            })
        }

        // filter handler
        const filterHandler = (element) => {
            if (!element.closest('[data-value]')) {
                return;
            }

            let dataValue = element.closest('[data-value]').dataset.value;
            const dataKey = element.closest('[data-key]').dataset.key;

            if (choosedOption[dataKey]) {
                if (!choosedOption[dataKey].includes(dataValue)) {
                    choosedOption[dataKey].push(dataValue);
                } else {
                    // remove if was second picked
                    choosedOption[dataKey] = choosedOption[dataKey].filter(function (item) {
                        return item !== dataValue;
                    });

                    if (choosedOption[dataKey].length === 0) delete choosedOption[dataKey];
                }
            } else {
                choosedOption[dataKey] = []
                choosedOption[dataKey].push(dataValue);
            }

            for (let key in choosedOption) {
                choosedOption[key].forEach(function (childItem) {
                })
            }
        };

        filtersList.addEventListener('click', evt => filterHandler(evt.target))

        // min price range
        fromMobileSlider.addEventListener('change', function (event) {
            choosedOption['min_price'] = [event.target.value];
        });


        // max price range
        toMobileSlider.addEventListener('change', function (event) {
            choosedOption['max_price'] = [event.target.value];
        });

        // submit filters
        mobileSubmitFilter.addEventListener('click', function () {
            setFilter();
        })

        // clear all filters
        mobileClearFilter.addEventListener('click', function () {
            let url = window.location.origin + window.location.pathname;
            const decodedUrl = decodeURIComponent(url);
            window.location.href = decodedUrl;
        })

        //orderby mobile filter
        const mobileSortBy = document.querySelector('.mobile__orderby');

        mobileSortBy.querySelectorAll('.filters__item_option').forEach(function (item) {
            item.addEventListener('click', function (event) {
                if (event.target.dataset.value) {
                    choosedOption['orderby'] = [event.target.dataset.value];
                    setFilter()
                }
            })
        });

        // set filter and reload page
        function setFilter() {
            let url = window.location.origin + window.location.pathname;
            let params = '?';
            let newUrl = "";
            for (let key in choosedOption) {
                let values = '';
                choosedOption[key].forEach(function (value) {
                    if (values !== '') values += ',';
                    values += value
                })
                params += `${key}=${values}&`;
            }
            newUrl = `${url + params}`;
            const decodedUrl = decodeURIComponent(newUrl);
            window.location.href = decodedUrl;
        }
    })();
</script>

<?php
get_footer();
