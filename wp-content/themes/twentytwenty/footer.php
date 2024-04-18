<?php

/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
</main>
<footer class="footer">
	<div class="footer__wrapper space-sections">
		<div class="container">
			<div class="footer__inner">
				<div class="footer__block">
					<a href="/" class="footer__logo footer__logo_mobile">
						<img src="images/footer-logo.svg" alt="logo">
					</a>
					<div class="footer__content">
						<div class="footer__wrap">
							<a href="/" class="footer__logo">
								<img src="images/footer-logo.svg" alt="logo">
							</a>
							<div class="footer__info">
								<p class="footer__info_title fw-600">Салони</p>
								<ul class="footer__info_list">
									<li class="footer__info_item">
										<p class="footer__info_adress">ТЦ 4room, Петропавлівська Борщагівка, вул. Петропавлівська, 6</p>
										<p class="footer__info_time">Пн-Нд. 10.00-20.00</p>
									</li>
									<li class="footer__info_item">
										<p class="footer__info_adress">ТЦ Аракс, Київ, вул. Кільцева дорога, 110</p>
										<p class="footer__info_time">Пн-Нд. 10.00-20.00</p>
									</li>
									<li class="footer__info_item">
										<p class="footer__info_adress">ТЦ Три Слони, Львів, вул. Яворівська, 22</p>
										<p class="footer__info_time">Пн-Нд. 11.00-19.00</p>
									</li>
								</ul>
							</div>
							<div class="footer__info">
								<p class="footer__info_title fw-600">Майстерня</p>
								<ul class="footer__info_list">
									<li class="footer__info_item">
										<p class="footer__info_adress">Київ, вул. Генерала Шаповала, 2, офіс 555</p>
										<p class="footer__info_time">Пн-Пт. 10.00-19.00</p>
									</li>
								</ul>
							</div>
						</div>
						<div class="footer__menu">
							<p class="footer__menu_title fw-600">Каталог</p>
							<nav class="footer__menu_nav">
								<ul class="footer__menu_list">
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Картини</a>
									</li>
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Постери</a>
									</li>
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Рами</a>
									</li>
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Індивідуальне замовлення</a>
									</li>
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Подарунковий сертифікат</a>
									</li>
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Розпис</a>
									</li>
								</ul>
							</nav>
						</div>
						<div class="footer__menu">
							<p class="footer__menu_title fw-600">Інформація</p>
							<nav class="footer__menu_nav">
								<ul class="footer__menu_list">
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Загальна інформація</a>
									</li>
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Послуги</a>
									</li>
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Наша команда</a>
									</li>
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Відео</a>
									</li>
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Партнери</a>
									</li>
								</ul>
							</nav>
						</div>
						<div class="footer__menu">
							<p class="footer__menu_title fw-600">Блог</p>
							<nav class="footer__menu_nav">
								<ul class="footer__menu_list">
									<li class="footer__menu_item">
										<a href="#" class="footer__menu_link">Контакти</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="footer__icons">
						<ul class="footer__social">
							<li class="footer__social_item">
								<a href="#" class="footer__social_link">
									<img src="images/icons/footer-instagram.svg" alt="instagram">
								</a>
							</li>
							<li class="footer__social_item">
								<a href="#" class="footer__social_link">
									<img src="images/icons/footer-facebook.svg" alt="facebook">
								</a>
							</li>
							<li class="footer__social_item">
								<a href="#" class="footer__social_link">
									<img src="images/icons/footer-youtube.svg" alt="youtube">
								</a>
							</li>
							<li class="footer__social_item">
								<a href="#" class="footer__social_link">
									<img src="images/icons/footer-pinterest.svg" alt="pinterest">
								</a>
							</li>
							<li class="footer__social_item">
								<a href="#" class="footer__social_link">
									<img src="images/icons/footer-etsy.svg" alt="etsy">
								</a>
							</li>
						</ul>
						<ul class="footer__payments">
							<li class="footer__payments_item">
								<img src="images/icons/footer-paypal.svg" alt="paypal">
							</li>
							<li class="footer__payments_item">
								<img src="images/icons/footer-mastercard.svg" alt="mastercard">
							</li>
							<li class="footer__payments_item">
								<img src="images/icons/footer-visa.svg" alt="visa">
							</li>
						</ul>
					</div>
				</div>
				<div class="footer__copyright">
					<p>© 2023. All rights reserved.</p>
					<a href="#">Політка конфіденційності</a>
				</div>
			</div>
		</div>
	</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="./wp-content/themes/twentytwenty/assets/js/global.js" defer></script>

<?php wp_footer(); ?>

</body>

</html>