<?php

/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$url = get_template_directory_uri() . '/assets/css/';


?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Raleway:wght@100..900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= $url; ?>/reset.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

	<!-- <link rel="preload" as="stylesheet" href="<?= $url; ?>styles.css"> -->

	<link rel="stylesheet" href="<?= $url; ?>styles.css?v=<?= rand(); ?>">

	<?php wp_head(); ?>
</head>

<body id="scroll-top" <?php body_class(); ?>>
	<div class="button__sticky">
		<a href="#scroll-top" class="button__sticky_top">
			<img src="images/icons/icon-arrow-long-top.svg" alt="arrow">
		</a>
		<a href="#" class="button__sticky_chat">
			<img src="images/icons/icon-chat.svg" alt="chat">
		</a>
	</div>

	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content">
			<?php
			/* translators: Hidden accessibility text. */
			esc_html_e('Skip to content', 'twentytwentyone');
			?>
		</a>

		<?php get_template_part('template-parts/header/site-header'); ?>

		<!-- <div id="content" class="site-content">
			<div id="primary" class="content-area"> -->
		<main id="main" class="site-main main">