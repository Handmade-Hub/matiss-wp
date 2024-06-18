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

	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-N374F4ZH');
	</script>
	<!-- End Google Tag Manager -->

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<meta property="og:title" content="Etsy expert">
	<meta property="og:type" content="website">
	<meta property="og:image" content="./images/Rectangle 61 (2).webp">
	<meta property="og:url" content="hhttps://etsy-expert.com.ua/">
	<meta property="og:description" content="Навчимо продавати ваші товари на ринку США та Європи">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<link rel="preload" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" as="font">
	<link rel="preload" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap" as="font">

	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<meta name="description" content="Навчимо продавати ваші товари на ринку США та Європи Микола Серветник Співзасновник компанії Handmade-Hub UA, Професіонал E-Commerce з 8-річним досвідом на Etsy, Amazon, eBay та Shopify, Спікер ДІЯ.Бізнес">
</head>

<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N374F4ZH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<header>
		<div class="header_container mobile container">
			<div class="header_container--logo">
				<a href="#" aria-label="link with main logo for scroll to top">
					<picture>
						<source srcset="https://etsy-expert.com.ua/wp-content/uploads/2024/06/logo_2.webp" type="image/webp">
						<source srcset="./images/old/logo_2.png" type="image/jpeg">
						<img class="desctop" src="./images/old/logo_2.png" alt="Найважливіші вміння для розвитку онлайн-магазинів" alt="Mobile logo">
					</picture>
					<!-- <img src="https://etsy-expert.com.ua/wp-content/uploads/2024/06/logo_2.webp" alt="Mobile logo"> -->
				</a>
			</div>
			<button type="button" class="btn btn-primary" data-id="form-main">
				Записатися
			</button>
			<button type="button" class="header_container--nav-btn btn" id="nav-btn" aria-label="Burger menu">
				<svg width="25" height="14" viewBox="0 0 25 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L24 1" stroke="black" id="1" stroke-width="2" stroke-linecap="round" />
					<path d="M1 7L24 7" stroke="black" id="2" stroke-width="2" stroke-linecap="round" />
					<path d="M1 13L24 13" stroke="black" id="3" stroke-width="2" stroke-linecap="round" />
				</svg>
			</button>
			<button class="header_container--nav-close" id="nav-close" aria-label="Close burger menu">
				<svg fill="#000000" width="800px" height="800px" viewBox="0 0 256 256" id="Flat" xmlns="http://www.w3.org/2000/svg">
					<path d="M202.82861,197.17188a3.99991,3.99991,0,1,1-5.65722,5.65624L128,133.65723,58.82861,202.82812a3.99991,3.99991,0,0,1-5.65722-5.65624L122.343,128,53.17139,58.82812a3.99991,3.99991,0,0,1,5.65722-5.65624L128,122.34277l69.17139-69.17089a3.99991,3.99991,0,0,1,5.65722,5.65624L133.657,128Z" />
				</svg>
			</button>
		</div>
		<div class="header_container desctop container">
			<div class="header_container--logo">
				<a href="#" aria-label="link with main logo for scroll to top">
					<picture>
						<source srcset="https://etsy-expert.com.ua/wp-content/uploads/2024/06/logo_2.webp" type="image/webp">
						<source srcset="./images/old/logo_2.png" type="image/jpeg">
						<img class="desctop" src="./images/old/logo_2.png" alt="Найважливіші вміння для розвитку онлайн-магазинів" alt="Desctop logo">
					</picture>
				</a>
			</div>
			<div class="header_container--nav">
				<ul>
					<li class="header-container--item"><a href="#" data-id="target" class="scroll">Аудиторія</a></li>
					<li class="header-container--item"><a href="#" class="scroll" data-id="advantages">Про курс</a></li>
					<li class="header-container--item"><a href="#" class="scroll" data-id="image_with_text">Викладачі</a></li>
					<li class="header-container--item"><a href="#" class="scroll" data-id="courses">Програма</a></li>
				</ul>
			</div>
			<a href="tel:+380734198509">+38(073)419-85-09</a>
			<div class="header_container--btn">
				<button type="button" class="btn btn-primary" data-id="form-main">
					Записатися
				</button>
			</div>
		</div>
		<div>

		</div>
	</header>
	<div class="social_dropdown">
		<div class="social_bropdown_btn">
			<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
				<path d="M12 16.1054L14.6667 18.6654L20 13.332" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				<path d="M22.667 4.45003C20.641 3.2779 18.341 2.66242 16.0003 2.66603C8.63633 2.66603 2.66699 8.63536 2.66699 15.9994C2.66699 18.1327 3.16833 20.1487 4.05766 21.9367C4.29499 22.4114 4.37366 22.954 4.23633 23.4674L3.44299 26.4354C3.36471 26.729 3.36501 27.0381 3.44385 27.3315C3.52268 27.625 3.6773 27.8926 3.89218 28.1075C4.10706 28.3224 4.37466 28.477 4.66815 28.5558C4.96163 28.6347 5.27069 28.635 5.56433 28.5567L8.53233 27.7634C9.04753 27.6337 9.59236 27.6968 10.0643 27.9407C11.9082 28.8589 13.9405 29.3354 16.0003 29.3327C23.3643 29.3327 29.3337 23.3634 29.3337 15.9994C29.3337 13.5714 28.6843 11.2927 27.5497 9.3327" stroke="white" stroke-width="1.5" stroke-linecap="round" />
			</svg>
		</div>
		<div class="social_items">
			<a href="mailto:etsyexpert@handmade-hub.com.ua" id="mail_to_btn" data-id="mail_to_btn" aria-label="Mail to etsyexpert@handmade-hub.com.ua" class="social_item" rel="noopener nofollow noreferrer" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" viewBox="0 0 330.001 330.001" xml:space="preserve">
					<g id="XMLID_348_">
						<path id="XMLID_350_" d="M173.871,177.097c-2.641,1.936-5.756,2.903-8.87,2.903c-3.116,0-6.23-0.967-8.871-2.903L30,84.602   L0.001,62.603L0,275.001c0.001,8.284,6.716,15,15,15L315.001,290c8.285,0,15-6.716,15-14.999V62.602l-30.001,22L173.871,177.097z" />
						<polygon id="XMLID_351_" points="165.001,146.4 310.087,40.001 19.911,40  " />
					</g>
				</svg>
			</a>
			<a href="viber://chat?number=380958881843" aria-label="To viber" class="social_item" rel="noopener nofollow noreferrer" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none">
					<path d="M12.743 13.455s.356.03.547-.206l.374-.47c.18-.232.614-.38 1.04-.144a11.005 11.005 0 0 1 .928.593c.282.207.86.69.862.69.276.233.34.574.152.934l-.002.008a3.896 3.896 0 0 1-.777.957l-.007.005q-.401.335-.789.381a.522.522 0 0 1-.115.008 1.05 1.05 0 0 1-.335-.052l-.009-.012c-.398-.113-1.062-.394-2.169-1.004a12.917 12.917 0 0 1-1.822-1.204 9.553 9.553 0 0 1-.82-.727l-.027-.027-.028-.028-.028-.027-.027-.028a9.553 9.553 0 0 1-.727-.82A12.93 12.93 0 0 1 7.76 10.46c-.61-1.107-.891-1.77-1.004-2.17l-.012-.008a1.05 1.05 0 0 1-.051-.335.506.506 0 0 1 .007-.115q.048-.387.382-.79l.005-.007a3.888 3.888 0 0 1 .957-.777l.007-.001c.36-.188.702-.124.934.15.002.001.484.58.69.862a11.005 11.005 0 0 1 .593.929c.237.425.089.86-.144 1.04l-.47.373c-.237.192-.206.548-.206.548s.696 2.633 3.295 3.296zm-.878-7.875a.253.253 0 0 0-.256.252.253.253 0 0 0 .252.254c1.353.01 2.454.447 3.356 1.326.894.872 1.351 2.057 1.363 3.611a.253.253 0 0 0 .254.252.253.253 0 0 0 .252-.255c-.013-1.654-.517-2.996-1.516-3.97-.99-.965-2.242-1.46-3.705-1.47Zm.463 1.313a.253.253 0 0 0-.271.234.253.253 0 0 0 .234.271c.966.071 1.682.387 2.205.957.524.573.773 1.27.754 2.141a.253.253 0 0 0 .248.258.253.253 0 0 0 .258-.246c.021-.978-.276-1.827-.887-2.494-.617-.674-1.48-1.044-2.54-1.121Zm.379 1.357a.253.253 0 0 0-.266.24.253.253 0 0 0 .239.266c.436.023.73.146.93.351.198.206.32.516.343.971a.253.253 0 0 0 .264.24.253.253 0 0 0 .24-.263c-.027-.537-.18-.984-.484-1.3-.305-.314-.743-.478-1.266-.505Zm6.636-4.3c-.497-.458-2.506-1.916-6.98-1.936 0 0-5.275-.318-7.847 2.041-1.431 1.432-1.935 3.527-1.988 6.125-.053 2.597-.122 7.465 4.57 8.785h.005L7.1 20.98s-.03.815.507.981c.65.202 1.03-.418 1.65-1.086.341-.367.811-.905 1.165-1.317 3.21.27 5.678-.347 5.958-.439.648-.21 4.315-.68 4.91-5.547.616-5.017-.297-8.19-1.947-9.621Zm.544 9.262c-.504 4.064-3.478 4.32-4.026 4.496-.233.075-2.401.614-5.127.436 0 0-2.031 2.45-2.666 3.088-.099.1-.215.14-.293.12-.11-.027-.14-.156-.138-.345l.017-3.347s-.002 0 0 0c-3.97-1.102-3.738-5.246-3.693-7.415.045-2.17.453-3.947 1.664-5.143C7.8 3.132 12.28 3.426 12.28 3.426c3.784.017 5.598 1.157 6.018 1.538 1.396 1.196 2.108 4.056 1.588 8.247z" class="cls-1" style="stroke-width:.0300125" />
				</svg>
			</a>
			<a href="https://t.me/etsy_expert_support" aria-label="To telegram" class="social_item" rel="noopener nofollow noreferrer" target="_blank">
				<svg width="24" height="24" viewBox="0 0 128 128" version="1.1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
					<path d="M28.9700376,63.3244248 C47.6273373,55.1957357 60.0684594,49.8368063 66.2934036,47.2476366 C84.0668845,39.855031 87.7600616,38.5708563 90.1672227,38.528 C90.6966555,38.5191258 91.8804274,38.6503351 92.6472251,39.2725385 C93.294694,39.7979149 93.4728387,40.5076237 93.5580865,41.0057381 C93.6433345,41.5038525 93.7494885,42.63857 93.6651041,43.5252052 C92.7019529,53.6451182 88.5344133,78.2034783 86.4142057,89.5379542 C85.5170662,94.3339958 83.750571,95.9420841 82.0403991,96.0994568 C78.3237996,96.4414641 75.5015827,93.6432685 71.9018743,91.2836143 C66.2690414,87.5912212 63.0868492,85.2926952 57.6192095,81.6896017 C51.3004058,77.5256038 55.3966232,75.2369981 58.9976911,71.4967761 C59.9401076,70.5179421 76.3155302,55.6232293 76.6324771,54.2720454 C76.6721165,54.1030573 76.7089039,53.4731496 76.3346867,53.1405352 C75.9604695,52.8079208 75.4081573,52.921662 75.0095933,53.0121213 C74.444641,53.1403447 65.4461175,59.0880351 48.0140228,70.8551922 C45.4598218,72.6091037 43.1463059,73.4636682 41.0734751,73.4188859 C38.7883453,73.3695169 34.3926725,72.1268388 31.1249416,71.0646282 C27.1169366,69.7617838 23.931454,69.0729605 24.208838,66.8603276 C24.3533167,65.7078514 25.9403832,64.5292172 28.9700376,63.3244248 Z"></path>
				</svg>
			</a>
			<a href="https://api.whatsapp.com/send/?phone=380958881843&text&type=phone_number&app_absent=0" aria-label="To whatsapp" class="social_item" rel="noopener nofollow noreferrer" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#BE2B27" height="30px" width="30px" version="1.1" id="Layer_1" viewBox="0 0 308 308" xml:space="preserve">
					<g id="XMLID_468_">
						<path id="XMLID_469_" d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156   c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687   c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887   c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153   c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348   c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802   c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922   c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0   c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458   C233.168,179.508,230.845,178.393,227.904,176.981z" />
						<path id="XMLID_470_" d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716   c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396   c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z    M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188   l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677   c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867   C276.546,215.678,222.799,268.994,156.734,268.994z" />
					</g>
				</svg>
			</a>
		</div>
	</div>
	<a href="#" class="scroll_to_top_btn" aria-label="scroll to top">
		<svg xmlns="http://www.w3.org/2000/svg" width="8" height="19" viewBox="0 0 8 19" fill="none">
			<path d="M4.35355 0.646446C4.15829 0.451185 3.84171 0.451185 3.64645 0.646446L0.464467 3.82843C0.269205 4.02369 0.269205 4.34027 0.464467 4.53553C0.659729 4.7308 0.976311 4.7308 1.17157 4.53553L4 1.70711L6.82843 4.53553C7.02369 4.7308 7.34027 4.7308 7.53553 4.53553C7.7308 4.34027 7.7308 4.02369 7.53553 3.82843L4.35355 0.646446ZM4.5 19L4.5 1L3.5 1L3.5 19L4.5 19Z" fill="black" />
		</svg>
	</a>
	<!-- #site-header -->
	<main>