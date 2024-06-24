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
		} elseif ($categorie_name == "Картини" || $categorie_name == "Постери") {
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
							$current_category = get_queried_object();

							if (!empty($_GET)) {
								$args = array(
									'post_type' => 'product',
									'posts_per_page' => -1,
									'tax_query' => array(
										array(
											'taxonomy' => 'product_cat',
											'field' => 'slug',
											'terms' => $current_category->slug,
										),
									),
								);

								$parameters = $_GET;
								$par_arr    = array();

								foreach ($parameters as $key => $value) {
									if ($key == 'min_price' || $key == 'max_price') {
										$args['meta_query'][] = array(
											'key'     => '_price',
											'value'   => $value,
											'compare' => $key == 'min_price' ? '>=' : '<=',
											'type'    => 'NUMERIC'
										);
									} elseif ($key == 'orderby') {
										if ($value == 'price-desc') {
											$args['orderby']  = 'meta_value_num';
											$args['order']    = 'DESC';
											$args['meta_key'] = '_price';
										} elseif ($value == 'price') {
											$args['orderby']  = 'meta_value_num';
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

<!-- description -->
<?php

$term = get_queried_object();
$description_cat = get_field('description_cat', $term);

?>
<section class="description" style="--min-height: <?= $description_cat['min-height'] ?>px; --min-height-mob: <?= $description_cat['min-height-mob'] ?>px;">
	<div class="description__wrapper space-sections">
		<button class="description__button">
			<div class="arrow-primary">
				<img src="<?= home_url(); ?>/images/icons/button-arrow-down.svg" alt="button">
			</div>
		</button>
		<div class="container">
			<div class="description__inner">
				<?php echo ($description_cat['content']) ?>
			</div>
		</div>
	</div>
</section>

<script>
	console.log(<?php print_r(json_encode($description)) ?>)
</script>

<?php

wp_enqueue_script('archive', get_template_directory_uri() . '/assets/js/archive.js', array(), $theme_version);
wp_script_add_data('archive', 'strategy', 'defer');

get_footer();
