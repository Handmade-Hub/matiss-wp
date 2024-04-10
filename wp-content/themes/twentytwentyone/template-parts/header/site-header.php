<?php

/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= (true === get_theme_mod('display_title_and_tagline', true)) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu('primary') ? ' has-menu' : '';
?>
<!-- 
<header id="masthead" class="<?php // echo esc_attr($wrapper_classes); 
								?>">

	<?php // get_template_part('template-parts/header/site-branding'); 
	?>
	<?php // get_template_part('template-parts/header/site-nav'); 
	?>

</header> #masthead -->

<header class="header">
	<div class="header__wrapper">
		<div class="container">
			<div class="header__inner">
				<div class="header__block">
					<a href="/" class="header__logo">
						<img src="images/logo.svg" alt="logo">
					</a>
					<nav class="header__menu tablet-none">
						<ul class="header__list">
							<li class="header__list_item header__drop-down">
								<div class="header__list_link fw-600 with-arrow">Каталог
									<img src="images/icons/header-drop-icon.svg" alt="arrow">
								</div>
								<ul class="header__drop-down_list">
									<li class="header__drop-down_item">
										<a href="#" class="header__drop-down_link fw-600">Картини</a>
									</li>
									<li class="header__drop-down_item">
										<a href="#" class="header__drop-down_link fw-600">Постери</a>
									</li>
									<li class="header__drop-down_item">
										<a href="#" class="header__drop-down_link fw-600">Рами</a>
									</li>
									<li class="header__drop-down_item">
										<a href="#" class="header__drop-down_link fw-600">Розпис</a>
									</li>
								</ul>
							</li>
							<li class="header__list_item header__drop-down">
								<div class="header__list_link fw-600 with-arrow">Інформація
									<img src="images/icons/header-drop-icon.svg" alt="arrow">
								</div>
								<ul class="header__drop-down_list">
									<li class="header__drop-down_item">
										<a href="#" class="header__drop-down_link fw-600">Загальна інформація</a>
									</li>
									<li class="header__drop-down_item">
										<a href="#" class="header__drop-down_link fw-600">Послуги</a>
									</li>
									<li class="header__drop-down_item">
										<a href="#" class="header__drop-down_link fw-600">Наша команда</a>
									</li>
									<li class="header__drop-down_item">
										<a href="#" class="header__drop-down_link fw-600">Відео</a>
									</li>
									<li class="header__drop-down_item">
										<a href="#" class="header__drop-down_link fw-600">Партнери</a>
									</li>
								</ul>
							</li>
							<li class="header__list_item">
								<a href="#" class="header__list_link fw-600">Блог</a>
							</li>
							<li class="header__list_item">
								<a href="#" class="header__list_link fw-600">Контакти</a>
							</li>
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
							<img src="images/icons/icon-search.svg" alt="search">
						</div>
						<a href="#" class="header__wishlist">
							<img src="images/icons/icon-wishlist.svg" alt="wishlist">
						</a>
						<a href="#" class="header__cart">
							<img src="images/icons/icon-cart.svg" alt="cart">
						</a>
					</div>
				</div>
				<div class="header__icons tablet-up-none">
					<div class="header__wishlist">
						<img src="images/icons/icon-wishlist.svg" alt="wishlist">
					</div>
					<a href="#" class="header__search">
						<img src="images/icons/icon-search.svg" alt="search">
					</a>
				</div>
				<div class="header__icons tablet-up-none">
					<a href="#" class="header__cart">
						<img src="images/icons/icon-cart.svg" alt="cart">
					</a>
					<div class="header__burger">
						<img src="images/icons/icon-burger.svg" alt="burger">
					</div>
				</div>
			</div>
			<div class="header-mobile">
				<div class="header-mobile__wrapper">
					<div class="container">
						<div class="header-mobile__inner">
							<div class="header-mobile__close">
								<img src="images/icons/icon-close.svg" alt="close">
							</div>
							<h3 class="header-mobile__title fw-500 open-sans">Меню</h3>
							<nav class="header-mobile__menu">
								<ul class="header-mobile__menu_list">
									<li class="header-mobile__menu_item header-mobile__drop-down">
										<div class="header-mobile__menu_link fw-500 with-arrow">Каталог
											<img src="images/icons/button-arrow-right.svg" alt="arrow">
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
											<img src="images/icons/button-arrow-right.svg" alt="arrow">
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
								<img src="images/icons/icon-viber.svg" alt="viber">
								<a href="tel:+380989940794" class="header__tel fw-600">+380 (98) 994 0794</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>