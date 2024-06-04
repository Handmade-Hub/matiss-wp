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

	<?php if (is_product()) : ?>
		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail'); ?>

		<meta name="description" content="<?= wp_strip_all_tags(get_the_content()); ?>">
		<meta property="og:title" content="Product - <?= get_the_title(); ?>">
		<meta property="og:description" content="<?= wp_strip_all_tags(get_the_content()); ?>">
		<meta property="og:image" content="<?= $image[0]; ?>">
		<meta property="og:url" content="<?= get_permalink(); ?>">
		<meta name="twitter:title" content="Product - <?= get_the_title(); ?>">
		<meta name="twitter:description" content="<?= wp_strip_all_tags(get_the_content()); ?>">
		<meta name="twitter:image" content="<?= $image[0]; ?>">
		<meta name="twitter:card" content="<?= $image[0]; ?>">

	<?php else : ?>
		<?

		$image = get_field('meta_image');
		$description = get_field('meta_description');
		$title = get_field('meta_title');

		?>
		<meta name="description" content="<?= $description; ?>">
		<meta property="og:title" content="<?= $title; ?>">
		<meta property="og:description" content="<?= $description; ?>">
		<meta property="og:image" content="<?= $image; ?>">
		<meta property="og:url" content="<?= get_permalink(); ?>">
		<meta name="twitter:title" content="<?= $title; ?>">
		<meta name="twitter:description" content="<?= $description; ?>">
		<meta name="twitter:image" content="<?= $image; ?>">
		<meta name="twitter:card" content="<?= $image; ?>">
	<?php endif; ?>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> id="scroll-top">

	<?php
	wp_body_open();
	?>

	<div class="button__sticky">
		<div class="button__sticky_chat">
			<img src="<?= home_url(); ?>/images/icons/icon-chat.svg" alt="chat">
		</div>
		<div class="contactWidgetButtons">
			<a href="https://t.me/#" id="contactWidgetTelegram" title="Telegram" target="_blank"><img src="/images/social/telegram.png"></a>
			<a href="viber://chat?service=#" id="contactWidgetViber" title="Viber" target="_blank"><img src="/images/social/viber.png"></a>
			<a href="https://wa.me/#" id="contactWidgetWhatsapp" title="WhatsApp" target="_blank"><img src="/images/social/whatsapp.png"></a>
			<!-- <a href="#" id="contactWidgetFeedback" title="Зворотній зв'язок" data-toggle="feedbackModal">
				<i class="fas fa-comment-dots"></i>
			</a> -->
		</div>
		<a href="#scroll-top" class="button__sticky_top">
			<img src="<?= home_url(); ?>/images/icons/icon-arrow-long-top.svg" alt="arrow">
		</a>
	</div>
	<script defer>
		(() => {
			const buttonStickyChat = document.querySelector('.button__sticky_chat');

			buttonStickyChat.addEventListener('click', () => {
				buttonStickyChat.classList.toggle('active');
			})
		})()
	</script>

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
						<?php
						if (has_custom_logo()) {
							the_custom_logo();
						} else {
						?>
							<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
						<?php
						}
						?>
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
							<<<<<<< HEAD <?php
											$phone = get_field('phone_numb', 'option');
											$phone_clear = preg_replace('/\D/', '', $phone);
											?>=======<?php
										$phone = get_field('phone_numb', 'option');
										$phone_clear = preg_replace('/\D/', '', $phone);
										?>>>>>>>> sp-glag
								<a href="tel:+<?php echo $phone_clear; ?>" class="header__tel fw-600"><?php echo $phone; ?></a>
						</div>
						<div class="header__localization">
							<div class="hidden">
								<?php
								// Use the do_shortcode() function to call a shortcode in PHP
								$shortcode_output = do_shortcode('[gt-link lang="en" label="English" widget_look="flags_name"]');
								echo $shortcode_output;
								?>
							</div>
							<a href="#" class="header__localization_button fw-600 notranslate glink nturl gt_raw_link-xxjexk" data-gt-lang="uk"><span>Ukrainian</span>UK</a>
							<a href="#" class="header__localization_button fw-600 notranslate glink nturl gt_raw_link-xxjexk" data-gt-lang="en"><span>English</span>EN</a>
							<a href="#" class="header__localization_button fw-600 notranslate glink nturl gt_raw_link-xxjexk" data-gt-lang="de"><span>German</span>DE</a>
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
									<button class="header__localization_button active fw-600" data-lang="uk">UK</button>
									<button class="header__localization_button fw-600" data-lang="en">EN</button>
									<button class="header__localization_button fw-600" data-lang="de">DE</button>
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
		<script defer>
			setTimeout(() => {
				const header = document.querySelector('header');
				const currentLocale = document.documentElement.lang;
				const gtCurrent = document.querySelector(`.gt-current`).dataset.gtLang;

				const targetBtns = document.querySelectorAll(`[data-lang="${currentLocale}"]`);
				const activesBtns = document.querySelectorAll('.header__localization_button.active');

				activesBtns.forEach(element => {
					element.classList.remove('active');
				});

				targetBtns.forEach(element => {
					element.classList.add('active');
				});

				// while (currentLocale != gtCurrent) {
				// 	console.log(currentLocale, gtCurrent);
				// };

				header.addEventListener('click', e => {
					const element = e.target;

					if (!element.closest('.header__localization_button')) {
						return
					}

					const btn = element.closest('.header__localization_button');
					const locale = btn.dataset.lang;
					const langBtn = document.querySelector(`[data-gt-lang="${locale}"]`);

					langBtn.click();
					// setTimeout(() => {
					// 	location.reload()
					// }, 1000)
				})
			}, 2000)
		</script>
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
						<p class="cart-modal__count"><span>0</span>товари</p>
						<button class="cart-modal__close">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6 18L18 6M6 6L18 18" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</button>
					</div>
					<!-- <p class="cart-modal__empty">Ваш кошик порожній.</p> -->
					<div class="cart-modal__content">
						<ul class="cart-modal__list">
						</ul>
					</div>
					<div class="cart-modal__footer">
						<div class="cart-modal__footer_case total_price">
							<p>Сума</p>
							<p class="total_price_value">$0</p>
						</div>
						<div class="cart-modal__footer_case">
							<p>Знижка</p>
							<p class="discount_price_value cart-modal__footer_text cart-modal__footer_text--red">$0</p>
						</div>
						<div class="cart-modal__footer_total subtotal_price">
							<h4>Всього</h4>
							<p class="subtotal_price_value">$0</p>
						</div>
						<a href="/checkout" class="cart-modal__footer_button button__primary">ОФОРМИТИ ЗАМОВЛЕННЯ</a>
					</div>
				</div>
			</div>
		</div>
	</header>

	<main class="main">


		<?php
		// Output the menu modal
		if (
			!is_front_page() && !is_page_template('templates/information-template.php')
			&& !is_page_template('templates/our-team-template.php') && !is_page_template('templates/partners-template.php') && !is_page_template('templates/services-template.php')
			&& !is_page_template('templates/privacy-policy-template.php') && !is_page_template('templates/video-template.php') && !is_search()
		) {
			custom_breadcrumbs();
		}
		?>