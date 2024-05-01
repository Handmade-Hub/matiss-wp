<?php
$archive_title = get_search_query();
?>

<?php if ($archive_title && have_posts()) : ?>
    <div class="search-request">
        <div class="search-request__wrapper">
            <div class="container">
                <div class="search-request__inner">
                    <ul class="search-request__list">
                        <p class="search-request__text">Результат пошуку:</p>
                        <li class="search-request__item">
                            <p><?= $archive_title ?></p>
                            <button class="search-request__item_remove" onclick="window.location.href = '/'">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 18L18 6M6 6L18 18" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (!have_posts() && is_search()) : ?>

    <div class="search-request not-found">
        <div class="search-request__wrapper">
            <div class="container">
                <div class="search-request__inner">
                    <p class="search-request__text">За результатом пошуку не знайдено жодного товару. Вас можуть зацікавити ці позиції
                    </p>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php get_template_part('template-parts/filter-search'); ?>

<section class="search">
    <div class="search__wrapper">
        <div class="container">
            <div class="search__inner">
                <ul class="collection__list" style="--per-col: <?php echo esc_attr(wc_get_loop_prop('columns')); ?>">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();

                            do_action('woocommerce_shop_loop');

                            wc_get_template_part('content', 'product');
                        };
                    } elseif (is_search()) {
                        $args = array(
                            'post_type' => 'product',
                            'orderby'   => 'rand',
                            'posts_per_page' => 6,
                        );

                        $random_products = get_posts($args);

                        foreach ($random_products as $post) : setup_postdata($post);
                            do_action('woocommerce_shop_loop');
                            wc_get_template_part('content', 'product');
                        endforeach;

                        wp_reset_postdata();
                    };
                    ?>
                </ul>
                <div class="collection__pagination mobile-up-none">
                    <div class="collection__pagination_wrapper">
                        <a href="#" class="collection__pagination_button button__outline">показати всі</a>
                        <nav class="collection__pagination_nav">
                            <a href="#" class="collection__pagination_prev disabled">
                                <svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 1.00195L1 9.37796L11 17.754" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                            <ul class="collection__pagination_list">
                                <li class="collection__pagination_item active"><span>1</span></li>
                                <li class="collection__pagination_item"><span>2</span></li>
                                <li class="collection__pagination_item"><span>...</span></li>
                                <li class="collection__pagination_item"><span>9</span></li>
                                <li class="collection__pagination_item"><span>10</span></li>
                            </ul>
                            <a href="#" class="collection__pagination_next">
                                <svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 17.998L11 9.62204L1 1.24604" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>