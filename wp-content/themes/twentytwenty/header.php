<?php

/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Raleway:wght@100..900&display=swap" rel="stylesheet">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> id="scroll-top">

	<?php
	wp_body_open();
	?>

	<div class="button__sticky">
		<a href="#scroll-top" class="button__sticky_top">
			<img src="<?= home_url(); ?>/images/icons/icon-arrow-long-top.svg" alt="arrow">
		</a>
		<a href="#" class="button__sticky_chat">
			<img src="<?= home_url(); ?>/images/icons/icon-chat.svg" alt="chat">
		</a>
	</div>

	<?php
	$header_menu_obj = wp_get_nav_menu_items(20);
	$result_array = array();

	foreach ($header_menu_obj as $menu_item) {
		if ($menu_item->menu_item_parent == 0) {
			$parent_array = array(
				'parent' => $menu_item,
				'children' => array()
			);

			foreach ($header_menu_obj as $child_menu_item) {
				if ($child_menu_item->menu_item_parent == $menu_item->ID) {
					$parent_array['children'][] = $child_menu_item;
				}
			}

			$result_array[] = $parent_array;
		}
	}

	?>

	<header class="header">
		<div class="header__wrapper">
			<div class="container">
				<div class="header__inner">
					<div class="header__block">
						<a href="<?= home_url(); ?>" class="header__logo">
							<img src="<?= home_url(); ?>/images/logo.svg" alt="logo">
						</a>
						<nav class="header__menu tablet-none">
							<ul class="header__list">
								<?php

								foreach ($result_array as $item) {
									if (empty($item['children'])) { ?>
										<li class="header__list_item">
											<a href="<?= $item['parent']->url ?>" class="header__list_link fw-600"><?= $item['parent']->title ?></a>
										</li>
									<?php
									} else { ?>
										<li class="header__list_item header__drop-down">
											<a href="<?= $item['parent']->url ?>" class="header__list_link fw-600 with-arrow"><?= $item['parent']->title ?>
												<img src="<?= home_url(); ?>/images/icons/header-drop-icon.svg" alt="arrow">
											</a>
											<ul class="header__drop-down_list">
												<?php foreach ($item['children'] as $child) { ?>
													<li class="header__drop-down_item">
														<a href="<?= $child->url ?>" class="header__drop-down_link fw-600"><?= $child->title ?></a>
													</li>
												<?php } ?>
											</ul>
										</li>
								<?php }
								}
								?>
							</ul>
						</nav>
					</div>
					<div class="header__pack tablet-none">
						<div class="header__case">
							<a href="tel:+380989940794" class="header__tel fw-600">+380 (98) 994 0794</a>
						</div>
						<div class="header__localization">
							<button class="header__localization_button active fw-600">UA</button>
							<button class="header__localization_button fw-600">EN</button>
						</div>
						<div class="header__icons tablet-none">
							<div class="header__search">
								<img src="<?= home_url(); ?>/images/icons/icon-search.svg" alt="search">
							</div>
							<a href="/wishlist" class="header__wishlist">
								<img src="<?= home_url(); ?>/images/icons/icon-wishlist.svg" alt="wishlist">
							</a>
							<a href="#" class="header__cart">
								<img src="<?= home_url(); ?>/images/icons/icon-cart.svg" alt="cart">
							</a>
						</div>
					</div>
					<div class="header__icons tablet-up-none">
						<div class="header__wishlist">
							<img src="<?= home_url(); ?>/images/icons/icon-wishlist.svg" alt="wishlist">
						</div>
						<a href="#" class="header__search">
							<img src="<?= home_url(); ?>/images/icons/icon-search.svg" alt="search">
						</a>
					</div>
					<div class="header__icons tablet-up-none">
						<a href="#" class="header__cart">
							<img src="<?= home_url(); ?>/images/icons/icon-cart.svg" alt="cart">
						</a>
						<div class="header__burger">
							<img src="<?= home_url(); ?>/images/icons/icon-burger.svg" alt="burger">
						</div>
					</div>
				</div>
				<div class="header-mobile">
					<div class="header-mobile__wrapper">
						<div class="container">
							<div class="header-mobile__inner">
								<div class="header-mobile__close">
									<img src="<?= home_url(); ?>/images/icons/icon-close.svg" alt="close">
								</div>
								<h3 class="header-mobile__title fw-500 open-sans">Меню</h3>
								<nav class="header-mobile__menu">
									<ul class="header-mobile__menu_list">
										<li class="header-mobile__menu_item header-mobile__drop-down">
											<div class="header-mobile__menu_link fw-500 with-arrow">Каталог
												<img src="<?= home_url(); ?>/images/icons/button-arrow-right.svg" alt="arrow">
											</div>
											<ul class="header-mobile__drop-down_list">
												<li class="header-mobile__drop-down_item">
													<a href="#" class="header-mobile__drop-down_link fw-400">Картини</a>
												</li>
												<li class="header-mobile__drop-down_item">
													<a href="#" class="header-mobile__drop-down_link fw-400">Постери</a>
												</li>
												<li class="header-mobile__drop-down_item">
													<a href="#" class="header-mobile__drop-down_link fw-400">Рами</a>
												</li>
												<li class="header-mobile__drop-down_item">
													<a href="#" class="header-mobile__drop-down_link fw-400">Розпис</a>
												</li>
											</ul>
										</li>
										<li class="header-mobile__menu_item header-mobile__drop-down">
											<div href="#" class="header-mobile__menu_link fw-500 with-arrow">Інформація
												<img src="<?= home_url(); ?>/images/icons/button-arrow-right.svg" alt="arrow">
											</div>
											<ul class="header-mobile__drop-down_list">
												<li class="header-mobile__drop-down_item">
													<a href="#" class="header-mobile__drop-down_link fw-400">Картини</a>
												</li>
												<li class="header-mobile__drop-down_item">
													<a href="#" class="header-mobile__drop-down_link fw-400">Постери</a>
												</li>
												<li class="header-mobile__drop-down_item">
													<a href="#" class="header-mobile__drop-down_link fw-400">Рами</a>
												</li>
												<li class="header-mobile__drop-down_item">
													<a href="#" class="header-mobile__drop-down_link fw-400">Розпис</a>
												</li>
											</ul>
										</li>
										<li class="header-mobile__menu_item">
											<a href="#" class="header-mobile__menu_link fw-500">Блог</a>
										</li>
										<li class="header-mobile__menu_item">
											<a href="#" class="header-mobile__menu_link fw-500">Контакти</a>
										</li>
									</ul>
								</nav>
								<div class="header__localization">
									<button class="header__localization_button active fw-600">UA</button>
									<button class="header__localization_button fw-600">EN</button>
								</div>
								<div class="header__case">
									<img src="<?= home_url(); ?>/images/icons/icon-viber.svg" alt="viber">
									<a href="tel:+380989940794" class="header__tel fw-600">+380 (98) 994 0794</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="search-modal">
			<div class="search-modal__wrapper bg-gray">
				<div class="container">
					<div class="search-modal__inner">
						<div class="search-modal__field">
							<button class="search-modal__button_search">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16.125 16.625L20.5 21" stroke="black" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M3 11C3 15.1421 6.35786 18.5 10.5 18.5C12.5746 18.5 14.4526 17.6576 15.8104 16.2963C17.1635 14.9396 18 13.0675 18 11C18 6.85786 14.6421 3.5 10.5 3.5C6.35786 3.5 3 6.85786 3 11Z" stroke="black" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
							</button>
							<input type="text" placeholder="Шукати товар">
							<button class="search-modal__button_close">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M6 18L18 6M6 6L18 18" stroke="black" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
							</button>
						</div>
						<div class="search-modal__case">
							<p>Пропозиції</p>
							<ul class="search-modal__list">
								<li class="search-modal__item">
									<p>Картини абстрікції</p>
								</li>
								<li class="search-modal__item">
									<p>Картини з квітами</p>
								</li>
								<li class="search-modal__item">
									<p>Постери</p>
								</li>
								<li class="search-modal__item">
									<p>Розпис стін</p>
								</li>
							</ul>
						</div>
					</div>
					<form class="serach-form-hidden" id="header-search" role="search" <?php echo $twentytwenty_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. 
																						?> method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
						<label for="<?php echo esc_attr($twentytwenty_unique_id); ?>">
							<span class="screen-reader-text">
								<?php
								/* translators: Hidden accessibility text. */
								_e('Search for:', 'twentytwenty'); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations
								?>
							</span>
							<input type="search" id="<?php echo esc_attr($twentytwenty_unique_id); ?>" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'twentytwenty'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
						</label>
						<input type="submit" class="search-submit" value="<?php echo esc_attr_x('Search', 'submit button', 'twentytwenty'); ?>" />
					</form>

				</div>
			</div>
		</div>
		<div class="cart-modal">
			<div class="cart-modal__wrapper">
				<div class="cart-modal__inner">
					<div class="cart-modal__case">
						<h5 class="cart-modal__title">КОШИК</h5>
						<p class="cart-modal__count"><span>3</span>товари</p>
						<button class="cart-modal__close">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6 18L18 6M6 6L18 18" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</button>
					</div>
					<!-- <p class="cart-modal__empty">Ваш кошик порожній.</p> -->
					<div class="cart-modal__content">
						<ul class="cart-modal__list">
							<li class="cart-modal__item">
								<div class="cart-modal__item_image">
									<img src="images/product-card/product-two.jpg" alt="product">
								</div>
								<div class="cart-modal__item_info">
									<h3 class="cart-modal__item_title">Impression</h3>
									<p>Розмір: 80х120 см</p>
									<p>Рама: біла деревʼяна</p>
									<div class="cart-modal__quantity">
										<button class="cart-modal__quantity_minus">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M18 12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="black" />
											</svg>
										</button>
										<input class="cart-modal__quantity_input" min="1" max="99" type="number" min="1" value="1">
										<button class="cart-modal__quantity_plus">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M18 12.998H13V17.998C13 18.2633 12.8946 18.5176 12.7071 18.7052C12.5196 18.8927 12.2652 18.998 12 18.998C11.7348 18.998 11.4804 18.8927 11.2929 18.7052C11.1054 18.5176 11 18.2633 11 17.998V12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H11V5.99805C11 5.73283 11.1054 5.47848 11.2929 5.29094C11.4804 5.1034 11.7348 4.99805 12 4.99805C12.2652 4.99805 12.5196 5.1034 12.7071 5.29094C12.8946 5.47848 13 5.73283 13 5.99805V10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="black" />
											</svg>
										</button>
									</div>
								</div>
								<p class="cart-modal__item_price">$195</p>
								<button class="cart-modal__item_remove">
									<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4 12L12 4M4 4L12 12" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</button>
							</li>
							<li class="cart-modal__item">
								<div class="cart-modal__item_image">
									<img src="images/product-card/product-two.jpg" alt="product">
								</div>
								<div class="cart-modal__item_info">
									<h3 class="cart-modal__item_title">Rime</h3>
									<p>Розмір: 80х120 см</p>
									<p>Рама: без рами</p>
									<div class="cart-modal__quantity">
										<button class="cart-modal__quantity_minus">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M18 12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="black" />
											</svg>
										</button>
										<input class="cart-modal__quantity_input" min="1" max="99" type="number" min="1" value="1">
										<button class="cart-modal__quantity_plus">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M18 12.998H13V17.998C13 18.2633 12.8946 18.5176 12.7071 18.7052C12.5196 18.8927 12.2652 18.998 12 18.998C11.7348 18.998 11.4804 18.8927 11.2929 18.7052C11.1054 18.5176 11 18.2633 11 17.998V12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H11V5.99805C11 5.73283 11.1054 5.47848 11.2929 5.29094C11.4804 5.1034 11.7348 4.99805 12 4.99805C12.2652 4.99805 12.5196 5.1034 12.7071 5.29094C12.8946 5.47848 13 5.73283 13 5.99805V10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="black" />
											</svg>
										</button>
									</div>
								</div>
								<p class="cart-modal__item_price">$300</p>
								<button class="cart-modal__item_remove">
									<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4 12L12 4M4 4L12 12" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</button>
							</li>
							<li class="cart-modal__item">
								<div class="cart-modal__item_image">
									<img src="images/product-card/product-two.jpg" alt="product">
								</div>
								<div class="cart-modal__item_info">
									<h3 class="cart-modal__item_title">Rime 2</h3>
									<p>Розмір: 80х120 см</p>
									<p>Рама: без рами</p>
									<div class="cart-modal__quantity">
										<button class="cart-modal__quantity_minus">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M18 12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="black" />
											</svg>
										</button>
										<input class="cart-modal__quantity_input" min="1" max="99" type="number" min="1" value="1">
										<button class="cart-modal__quantity_plus">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M18 12.998H13V17.998C13 18.2633 12.8946 18.5176 12.7071 18.7052C12.5196 18.8927 12.2652 18.998 12 18.998C11.7348 18.998 11.4804 18.8927 11.2929 18.7052C11.1054 18.5176 11 18.2633 11 17.998V12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H11V5.99805C11 5.73283 11.1054 5.47848 11.2929 5.29094C11.4804 5.1034 11.7348 4.99805 12 4.99805C12.2652 4.99805 12.5196 5.1034 12.7071 5.29094C12.8946 5.47848 13 5.73283 13 5.99805V10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="black" />
											</svg>
										</button>
									</div>
								</div>
								<p class="cart-modal__item_price">$90</p>
								<button class="cart-modal__item_remove">
									<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4 12L12 4M4 4L12 12" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</button>
							</li>
						</ul>
					</div>
					<div class="cart-modal__footer">
						<div class="cart-modal__footer_case">
							<p>Сума</p>
							<p>$585</p>
						</div>
						<div class="cart-modal__footer_case">
							<p>Знижка</p>
							<p class="cart-modal__footer_text cart-modal__footer_text--red">$0</p>
						</div>
						<div class="cart-modal__footer_total">
							<h4>Всього</h4>
							<p>$585</p>
						</div>
						<a href="#" class="cart-modal__footer_button button__primary">ОФОРМИТИ ЗАМОВЛЕННЯ</a>
					</div>
				</div>
			</div>
		</div>
	</header>

	<main class="main">


		<?php
		// Output the menu modal.
		// get_template_part('template-parts/modal-menu');
		if (!is_front_page() && !is_search()) {
			custom_breadcrumbs();
		};
