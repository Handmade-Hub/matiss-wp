<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header(); ?>

<?php if (is_home() && !is_front_page() && !empty(single_post_title('', false))) : ?>
	<!-- <header class="page-header alignwide">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header> -->
	<!-- .page-header -->
<?php endif; ?>

<?php
// if (have_posts()) {

// 	// Load posts loop.
// 	while (have_posts()) {
// 		the_post();

// 		get_template_part('template-parts/content/content', get_theme_mod('display_excerpt_or_full_post', 'excerpt'));
// 	}

// 	// Previous/next page navigation.
// 	twenty_twenty_one_the_posts_navigation();
// } else {

// 	// If no content, include the "No posts found" template.
// 	get_template_part('template-parts/content/content-none');
// }

?>

<!-- banner -->
<section class="banner">
	<div class="banner__wrapper">
		<div class="banner__swiper swiper">
			<div class="banner__swiper-wrapper swiper-wrapper">
				<div class="banner__swiper-slide swiper-slide">
					<div class="banner__image">
						<img src="images/banner/banner-one.jpg" alt="image">
					</div>
					<div class="banner__content">
						<div class="container">
							<div class="banner__inner">
								<h1 class="banner__title uppercase fw-600 h1">Майстерня сучасного живопису</h1>
								<a href="#" class="banner__button button__secondary">каталог</a>
							</div>
						</div>
					</div>
				</div>
				<div class="banner__swiper-slide swiper-slide">
					<div class="banner__image">
						<img src="images/banner/banner-two.jpg" alt="image">
					</div>
					<div class="banner__content">
						<div class="container">
							<div class="banner__inner">
								<h2 class="banner__title uppercase fw-600 h1">повністю ручна робота</h2>
								<a href="#" class="banner__button button__secondary">каталог</a>
							</div>
						</div>
					</div>
				</div>
				<div class="banner__swiper-slide swiper-slide">
					<div class="banner__image">
						<img src="images/banner/banner-three.jpg" alt="image">
					</div>
					<div class="banner__content">
						<div class="container">
							<div class="banner__inner">
								<h2 class="banner__title uppercase fw-600 h1">авторські картини</h2>
								<a href="#" class="banner__button button__secondary">каталог</a>
							</div>
						</div>
					</div>
				</div>
				<div class="banner__swiper-slide swiper-slide">
					<div class="banner__image">
						<img src="images/banner/banner-four.jpg" alt="image">
					</div>
					<div class="banner__content">
						<div class="container">
							<div class="banner__inner">
								<h2 class="banner__title uppercase fw-600 h1">стильні сюжети</h2>
								<a href="#" class="banner__button button__secondary">каталог</a>
							</div>
						</div>
					</div>
				</div>
				<div class="banner__swiper-slide swiper-slide">
					<div class="banner__image">
						<img src="images/banner/banner-five.jpg" alt="image">
					</div>
					<div class="banner__content">
						<div class="container">
							<div class="banner__inner">
								<h2 class="banner__title uppercase fw-600 h1">оригінальні рішення</h2>
								<a href="#" class="banner__button button__secondary">каталог</a>
							</div>
						</div>
					</div>
				</div>
				<div class="banner__swiper-slide swiper-slide">
					<div class="banner__image">
						<img src="images/banner/banner-six.jpg" alt="image">
					</div>
					<div class="banner__content">
						<div class="container">
							<div class="banner__inner">
								<h2 class="banner__title uppercase fw-600 h1">сучасні тенденції</h2>
								<a href="#" class="banner__button button__secondary">каталог</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="banner__swiper-pagination swiper-pagination"></div>
		</div>
	</div>
</section>

<?
get_footer();
